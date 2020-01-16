<?php
/**
 * This class will be out custom post typ
 *
 * NOTE: This Class implements the Singleton Pattern, as we will need:
 *      1) to ensure onluy one instance of the object exist in memory
 *      2) as we will often need to use action & filters, better to use singleton VS Static methods
 *
 * ref: https://7php.com/how-to-code-a-singleton-design-pattern-in-php-5/
 */

namespace TMC_MiniCatalog;


class ProductPostType
{
    public $text_domain;
    private static $_instance = null; //for singleton

    /**
     * Prevent any copy of this object
     */
    private function __clone() { }

    /**
     * single globally accessible static method
     *
     * @return ProductPostType|null
     * @throws \Exception
     */
    public static function getInstance()
    {
        if(! is_object(self::$_instance)) { //or if( is_null(self::$_instance) ) or if( self::$_instance == null )
            self::$_instance = new ProductPostType();
        }
        return self::$_instance;
    }

    /**
     * Prevent any oustide instantiation of this class
     * ProductPostType constructor.
     * @throws \Exception
     */
    private function __construct()
    {
        if (! defined("TMC_TEXT_DOMAIN")) {
            throw new \Exception('Check why TMC_TEXT_DOMAIN is not defined');
        }
        $this->text_domain = TMC_TEXT_DOMAIN;

        add_action('add_meta_boxes', [$this, 'add_meta_box']);
        add_action('save_post',      [$this, 'save']);
    }

    /**
     * To save all custom fields in postmeta
     * @param $post_id
     * @return mixed
     */
    public function save($post_id)
    {
        //bail early if nonce fails
        if ($this->verifyNonce() !== true) {
            return $post_id;
        }

        //autosave - should not save anything
        if (defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) {
            return $post_id;
        }

        //Check user permission
        if ( PostTypeEnum::CUSTOM_POST_TYPE == $_POST['post_type']) {
            if (! current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } else if (! current_user_can('edit_post', $post_id)) {
                return $post_id;
        }

        $field_list = $this->fieldsProvider();
        foreach ($field_list as $field) {
            if (isset($_POST[$field['name']])) {
                update_post_meta(
                    $post_id,
                    $field['name'],
                    sanitize_text_field($_POST[$field['name']])
                );
            }
        }
    }

    /**
     * Before Saving/updating data, we make sure nonce is OK
     * @return bool
     */
    private function verifyNonce()
    {
        if (! isset($_POST['tmc_custom_box_nonce'])) {
            return false;
        }
        if (! wp_verify_nonce(trim($_POST['tmc_custom_box_nonce']), 'tmc_custom_box_nonce') ) {
            return false;
        }
        return true;
    }

    /**
     * To add all the custom fields of TMC Product in Admin dashboard
     * @param $post_type
     */
    public function add_meta_box($post_type)
    {
        // Limit meta box to certain post types.
        $post_types = [ 'post',
                        'page',
                        PostTypeEnum::CUSTOM_POST_TYPE
        ];

        if (in_array($post_type, $post_types)) {
            $custom_fields_list = $this->fieldsProvider();
            $meta_box_title     = "TMC Product Custom Fields List";
            $meta_box_id        = "tmc_custom_fields_group";
            add_meta_box(
                $meta_box_id,
                $meta_box_title,
                [$this, 'tmc_handle_html_meta_box'],
                \TMC_MiniCatalog\PostTypeEnum::CUSTOM_POST_TYPE,
                'advanced',
                'high'
            );
        }
    }

    /**
     * The HTML template for all the custom fields
     * @param $post
     */
    public function tmc_handle_html_meta_box($post)
    {
        global $post;
        //$value = get_post_meta( $post->ID, $fieldArray['args']['key'], true );

        $tpl = tplObject();
        $tpl->setTemplate('custom_fields.tpl.php');
        $tpl->display();
    }

    /**
     * Registers the new CPT into the WP system
     *
     * @throws \Exception
     */
    public function register()
    {
        register_post_type(PostTypeEnum::CUSTOM_POST_TYPE, $this->argsProvider());
        add_action('pre_get_posts', [$this, 'addCustomPostToPostQuery']);
    }

    /**
     * @param \WP_Query $query
     * @return mixed
     */
    public function addCustomPostToPostQuery($query)
    {
        if (is_home() && $query->is_main_query()) {
            $query->set('post_type', ['post', PostTypeEnum::CUSTOM_POST_TYPE]);
        }
        return $query;
    }

    /**
     * Args for the Custom Post type
     * @return array
     */
    private function argsProvider()
    {
        return [
            "label"                 => __(PostTypeEnum::CUSTOM_SINGULAR_LABEL, $this->text_domain),
            "labels"                => $this->labelsProvider(),
            "description"           => PostTypeEnum::POST_TYPE_DESCRIPTION,
            "public"                => PostTypeEnum::IS_PUBLIC,
            "publicly_queryable"    => PostTypeEnum::PUBLICLY_QUERYABLE,
            "show_ui"               => PostTypeEnum::SHOW_UI,
            "delete_with_user"      => PostTypeEnum::DELETE_WITH_USER,
            "show_in_rest"          => PostTypeEnum::SHOW_IN_REST_API,
            "rest_base"             => PostTypeEnum::REST_API_BASE_SLUG,
            "rest_controller_class" => PostTypeEnum::RES_API_CONTROLLER_CLASS,
            "has_archive"           => PostTypeEnum::HAS_ARCHIVE,
            "show_in_menu"          => PostTypeEnum::SHOW_IN_MENU,
            "show_in_nav_menus"     => PostTypeEnum::SHOW_IN_NAV_MENUS,
            "exclude_from_search"   => PostTypeEnum::EXCLUDE_FROM_SEARCH,
            "capability_type"       => PostTypeEnum::CAPABILITY_TYPE,
            "map_meta_cap"          => true,
            "hierarchical"          => PostTypeEnum::HIERARCHICAL,
            "rewrite"               => [    "slug" => PostTypeEnum::REWRITE_SLUG,
                                            "with_front" => PostTypeEnum::WITH_FRONT
                                        ],
            "query_var"             => PostTypeEnum::QUERY_VAR,
            "supports"              => [    "title",
                                            "editor",
                                            "thumbnail"
                                        ],
            "menu_icon"             => __(PostTypeEnum::MENU_ICON, $this->text_domain),
            "menu_position"         => __(PostTypeEnum::MENU_POSITION, $this->text_domain),
        ];
    }

    /**
     * Labels for the custom post type
     * @return array
     */
    private function labelsProvider()
    {
        return [
            "name"                      => __(PostTypeEnum::CUSTOM_PLURAL_LABEL, $this->text_domain),
            "singular_name"             => __(PostTypeEnum::CUSTOM_SINGULAR_LABEL, $this->text_domain),
            "menu_name"                 => __(PostTypeEnum::MENU_NAME, $this->text_domain),
            "all_items"                 => __(PostTypeEnum::ALL_ITEMS, $this->text_domain),
            "add_new"                   => __(PostTypeEnum::ADD_NEW, $this->text_domain),
            "add_new_item"              => __(PostTypeEnum::ADD_NEW_ITEM, $this->text_domain),
            "edit_item"                 => __(PostTypeEnum::EDIT_NEW_ITEM, $this->text_domain),
            "new_item"                  => __(PostTypeEnum::NEW_ITEM, $this->text_domain),
            "view_item"                 => __(PostTypeEnum::VIEW_ITEM, $this->text_domain),
            "view_items"                => __(PostTypeEnum::VIEW_ITEMS, $this->text_domain),
            "search_items"              => __(PostTypeEnum::SEARCH_ITEM, $this->text_domain),
            "not_found"                 => __(PostTypeEnum::NOT_FOUND, $this->text_domain),
            "not_found_in_trash"        => __("No Products found in trash", $this->text_domain),
            "parent"                    => __(PostTypeEnum::PARENT, $this->text_domain),
            "featured_image"            => __(PostTypeEnum::FEATURED_IMAGE, $this->text_domain),
            "set_featured_image"        => __(PostTypeEnum::SET_FEATURED_IMAGE, $this->text_domain),
            "remove_featured_image"     => __(PostTypeEnum::REMOVE_FEATURED_IMAGE, $this->text_domain),
            "use_featured_image"        => __(PostTypeEnum::USE_FEATURED_IMAGE, $this->text_domain),
            "archives"                  => __(PostTypeEnum::ARCHIVES, $this->text_domain),
            "insert_into_item"          => __(PostTypeEnum::INSERT_INTO_ITEM, $this->text_domain),
            "uploaded_to_this_item"     => __(PostTypeEnum::UPLOADED_TO_THIS_ITEM, $this->text_domain),
            "filter_items_list"         => __(PostTypeEnum::FILTER_ITEM_LIST, $this->text_domain),
            "items_list_navigation"     => __(PostTypeEnum::ITEMS_LIST_NAVIGATION, $this->text_domain),
            "items_list"                => __(PostTypeEnum::ITEMS_LIST, $this->text_domain),
            "attributes"                => __(PostTypeEnum::ATTRIBUTES, $this->text_domain),
            "name_admin_bar"            => __(PostTypeEnum::NEW_MENU_IN_ADMIN_BAR, $this->text_domain),
            "item_published"            => __(PostTypeEnum::ITEM_PUBLISHED, $this->text_domain),
            "item_published_privately"  => __(PostTypeEnum::ITEM_PUBLISHED_PRIVATELY, $this->text_domain),
            "item_reverted_to_draft"    => __(PostTypeEnum::ITEM_REVERTED_TO_DRAFT, $this->text_domain),
            "item_scheduled"            => __(PostTypeEnum::ITEM_SCHEDULED, $this->text_domain),
            "item_updated"              => __(PostTypeEnum::ITEM_UPDATED, $this->text_domain),
            "parent_item_colon"         => __(PostTypeEnum::PARENT, $this->text_domain),
        ];
    }

    /**
     * List of the custom fields for the custom post
     * @return array
     */
    public function fieldsProvider()
    {
        return [
            [
                'key'       => 'tmc_price',
                'label'     => 'Price',
                'name'      => 'tmc_price',
                'type'      => 'number',
                'required'  => 0,
            ],
            [
                'key'       => 'tmc_display_price',
                'label'     => 'Display price',
                'name'      => 'tmc_display_price',
                'type'      => 'true_false',
                'required'  => 0,
            ],
            [
                'key'       => 'tmc_quantity',
                'label'     => 'Quantity',
                'name'      => 'tmc_quantity',
                'type'      => 'number',
                'required'  => 0,
            ],
            [
                'key'       => 'tmc_display_quantity',
                'label'     => 'Display Quantity',
                'name'      => 'tmc_display_quantity',
                'type'      => 'true_false',
                'required'  => 0,
            ],
            [
                'key'       => 'tmc_stock',
                'label'     => 'Amount of stock',
                'name'      => 'tmc_stock',
                'type'      => 'number',
                'required'  => 0,
            ],
            [
                'key'       => 'tmc_promotional_price',
                'label'     => 'Promotional price',
                'name'      => 'tmc_promotional_price',
                'type'      => 'number',
                'required'  => 0,
            ],
            [
                'key'       => 'tmc_display_promo',
                'label'     => 'Display promo',
                'name'      => 'tmc_display_promo',
                'type'      => 'true_false',
                'required'  => 0,
            ],
            [
                'key'       => 'tmc_sales_start_date',
                'label'     => 'Sales start date',
                'name'      => 'tmc_sales_start_date',
                'type'      => 'date_time_picker',
                'required'  => 0,
            ],
            [
                'key'       => 'tmc_sales_end_date',
                'label'     => 'Sales end date',
                'name'      => 'tmc_sales_end_date',
                'type'      => 'date_time_picker',
                'required'  => 0,
            ],
            [
                'key'       => 'tmc_display_date',
                'label'     => 'Display date',
                'name'      => 'tmc_display_date',
                'type'      => 'true_false',
                'required'  => 0,
            ],
        ];
    }
}
