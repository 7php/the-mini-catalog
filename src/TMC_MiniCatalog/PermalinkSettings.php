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
     * @return PermalinkSettings|null
     */
    public static function getInstance()
    {
        if(! is_object(self::$_instance)) { //or if( is_null(self::$_instance) ) or if( self::$_instance == null )
            self::$_instance = new PermalinkSettings();
        }
        return self::$_instance;
    }

    private function __construct() {}

    public function initPermalinks()
    {
        $this->settings_init();
        $this->settings();
    }

    public function settings_init()
    {
        add_settings_section('tmc-permalink', 'TMC Product permalinks', [$this, 'settings'], 'permalink');
        $this->permalinks = $this->tmc_get_permalink_structure();
    }

    /**
     * @return array
     */
    public function tmc_get_permalink_structure()
    {
        $permalinks_from_db = (array) get_option(PostTypeEnum::TMC_PERMALINKS_KEY, []);
        $permalinks         = wp_parse_args( array_filter($permalinks_from_db), [ 'product_base' => 'product'] );

        if ($permalinks_from_db !== $permalinks) {
            update_option(PostTypeEnum::TMC_PERMALINKS_KEY, $permalinks);
        }

        $permalinks[PostTypeEnum::TMC_REWRITE_SLUG] = untrailingslashit($permalinks['product_base']);

        return $permalinks;
    }

    public function settings()
    {
        echo wp_kses_post( __( 'Here you may change the TMC product URLs. This setting affects product URLs only.', PostTypeEnum::CUSTOM_TEXT_DOMAIN));

        $tpl               = tplObject();
        $tpl->permalinks   = $this->permalinks;
        $tpl->product_base =  $product_base = PostTypeEnum::REWRITE_SLUG;
        $tpl->description  = esc_html_e('Enter a custom base to use. A base must be set or WordPress will use default instead.', PostTypeEnum::CUSTOM_TEXT_DOMAIN );

        $tpl->structures   = [0 => '', ];


        //display tpl
        $tpl->setTemplate('permalink-settings.tpl.php');
        $tpl->display();
    }
}
