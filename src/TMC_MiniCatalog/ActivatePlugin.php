<?php
/**
 * Execute during plugin activation
 */

namespace TMC_MiniCatalog;

/**
 * Class ActivatePlugin
 * @package TMC_MiniCatalog
 */
class ActivatePlugin
{
    public function __construct()
    {
        /**
         * order of execution matters
         * ref: https://developer.wordpress.org/reference/functions/register_post_type/#flushing-rewrite-on-activation
         */
        update_option(PostTypeEnum::TMC_PERMALINKS_KEY, ['product_base' => 'product']);
        $this->createPageStore();
        $this->createPagePromo();
        initCustomPostType();
        flush_rewrite_rules();
    }

    /**
     * To create PAGE Store
     */
    public function createPageStore()
    {
        $page = [
            'post_title'    => wp_strip_all_tags('Store'),
            'post_content'  => 'the store page to display list of products',
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type'     => 'page'
        ];
        wp_insert_post($page);
    }

    /**
     * TO create PAGE Mass Promo
     */
    public function createPagePromo()
    {
        $page = [
            'post_title'    => wp_strip_all_tags('Mass Promo'),
            'post_content'  => 'List all promo products',
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type'     => 'page'
        ];
        wp_insert_post($page);
    }
}
