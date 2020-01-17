<?php


namespace TMC_MiniCatalog;


class PermalinkSettings
{
    public $permalinks = [];

    private static $_instance = null; //for singleton

    /**
     * Prevent any copy of this object
     */
    private function __clone() { }

    /**
     * Private to prevent direct instantiation
     */
    private function __construct() {}

    /**
     * @return PermalinkSettings|null
     */
    public static function getInstance()
    {
        if(! is_object(self::$_instance)) { //or if( is_null(self::$_instance) ) or if( self::$_instance == null )
            self::$_instance = new PermalinkSettings();
        }
        return self::$_instance;
    }

    /**
     *
     */
    public function initPermalinks()
    {
        $this->settings_init();
        $this->save_settings();
    }

    /**
     * Display the custom section on Permalink Settings Page
     */
    public function settings_init()
    {
        add_settings_section('tmc-permalink', 'TMC Product permalinks', [$this, 'settings'], 'permalink');
        $this->permalinks = $this->tmc_get_permalink_structure();
    }

    /**
     * prepping TPL for custom Permalink Settings Section
     */
    public function settings()
    {
        $tpl               = tplObject();
        $tpl->permalinks   = $this->permalinks;
        $tpl->product_base =  $product_base = PostTypeEnum::REWRITE_SLUG;
        $tpl->structures   = [0 => '', ];

        $tpl->display('permalink-settings.tpl.php');
    }

    /**
     * On Submit on page Permalink Settings, SAVE entry
     */
    public function save_settings()
    {
        if (! is_admin()) {
            return;
        }

        /**
         * Save the options; settings api does not trigger save for the permalinks page.
         */
        if (isset($_POST['permalink_structure'], $_POST['tmc-permalinks-nonce']) && wp_verify_nonce(wp_unslash( $_POST['tmc-permalinks-nonce']), 'tmc-permalinks') ) {

            $permalinks     = (array) get_option(PostTypeEnum::TMC_PERMALINKS_KEY, []);
            $product_base   = isset($_POST['product_permalink']) ? sanitize_text_field(wp_unslash( $_POST['product_permalink']) ) : '';

            if ('custom' === $product_base) {
                if (isset( $_POST['product_permalink_structure']) ) {
                    $product_base = preg_replace( '#/+#', '/', '/' . str_replace( '#', '', trim(wp_unslash($_POST['product_permalink_structure']))) );
                } else {
                    $product_base = '/';
                }
            } else {
                $product_base = 'product';
            }

            $permalinks['product_base'] = sanitize_title($product_base);
            update_option(PostTypeEnum::TMC_PERMALINKS_KEY, $permalinks);
        }
    }

    /**
     * Fetch permalink for our custom post type
     * @return array
     */
    public function tmc_get_permalink_structure()
    {
        $permalinks_from_db = (array) get_option(PostTypeEnum::TMC_PERMALINKS_KEY, []);
        $permalinks         = wp_parse_args( array_filter($permalinks_from_db), ['product_base' => PostTypeEnum::REWRITE_SLUG]);

        if ($permalinks_from_db !== $permalinks) {
            update_option(PostTypeEnum::TMC_PERMALINKS_KEY, $permalinks);
        }

        $permalinks[PostTypeEnum::TMC_REWRITE_SLUG] = untrailingslashit($permalinks['product_base']);

        return $permalinks;
    }
}
