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
    }

    public function register()
    {
        register_post_type(PostTypeEnum::CUSTOM_POST_TYPE, $this->argsProvider());
    }

    public function addCustomPostToPostQuery()
    {

    }

    private function argsProvider()
    {
        return [
            "label"                 => __( PostTypeEnum::CUSTOM_SINGULAR_LABEL, $this->text_domain),
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
            "menu_icon"             => __( PostTypeEnum::MENU_ICON, $this->text_domain),
            "menu_position"         => __( PostTypeEnum::MENU_POSITION, $this->text_domain),
        ];
    }
    
    private function labelsProvider()
    {
        return [
            "name"                      => __( PostTypeEnum::CUSTOM_PLURAL_LABEL, $this->text_domain),
            "singular_name"             => __( PostTypeEnum::CUSTOM_SINGULAR_LABEL, $this->text_domain),
            "menu_name"                 => __( PostTypeEnum::MENU_NAME, $this->text_domain),
            "all_items"                 => __( PostTypeEnum::ALL_ITEMS, $this->text_domain),
            "add_new"                   => __( PostTypeEnum::ADD_NEW, $this->text_domain),
            "add_new_item"              => __( PostTypeEnum::ADD_NEW_ITEM, $this->text_domain),
            "edit_item"                 => __( PostTypeEnum::EDIT_NEW_ITEM, $this->text_domain),
            "new_item"                  => __( PostTypeEnum::NEW_ITEM, $this->text_domain),
            "view_item"                 => __( PostTypeEnum::VIEW_ITEM, $this->text_domain),
            "view_items"                => __( PostTypeEnum::VIEW_ITEMS, $this->text_domain),
            "search_items"              => __( PostTypeEnum::SEARCH_ITEM, $this->text_domain),
            "not_found"                 => __( PostTypeEnum::NOT_FOUND, $this->text_domain),
            "not_found_in_trash"        => __( "No Products found in trash", $this->text_domain),
            "parent"                    => __( PostTypeEnum::PARENT, $this->text_domain),
            "featured_image"            => __( PostTypeEnum::FEATURED_IMAGE, $this->text_domain),
            "set_featured_image"        => __( PostTypeEnum::SET_FEATURED_IMAGE, $this->text_domain),
            "remove_featured_image"     => __( PostTypeEnum::REMOVE_FEATURED_IMAGE, $this->text_domain),
            "use_featured_image"        => __( PostTypeEnum::USE_FEATURED_IMAGE, $this->text_domain),
            "archives"                  => __( PostTypeEnum::ARCHIVES, $this->text_domain),
            "insert_into_item"          => __( PostTypeEnum::INSERT_INTO_ITEM, $this->text_domain),
            "uploaded_to_this_item"     => __( PostTypeEnum::UPLOADED_TO_THIS_ITEM, $this->text_domain),
            "filter_items_list"         => __( PostTypeEnum::FILTER_ITEM_LIST, $this->text_domain),
            "items_list_navigation"     => __( PostTypeEnum::ITEMS_LIST_NAVIGATION, $this->text_domain),
            "items_list"                => __( PostTypeEnum::ITEMS_LIST, $this->text_domain),
            "attributes"                => __( PostTypeEnum::ATTRIBUTES, $this->text_domain),
            "name_admin_bar"            => __( PostTypeEnum::NEW_MENU_IN_ADMIN_BAR, $this->text_domain),
            "item_published"            => __( PostTypeEnum::ITEM_PUBLISHED, $this->text_domain),
            "item_published_privately"  => __( PostTypeEnum::ITEM_PUBLISHED_PRIVATELY, $this->text_domain),
            "item_reverted_to_draft"    => __( PostTypeEnum::ITEM_REVERTED_TO_DRAFT, $this->text_domain),
            "item_scheduled"            => __( PostTypeEnum::ITEM_SCHEDULED, $this->text_domain),
            "item_updated"              => __( PostTypeEnum::ITEM_UPDATED, $this->text_domain),
            "parent_item_colon"         => __( PostTypeEnum::PARENT, $this->text_domain),
        ];
    }
}
