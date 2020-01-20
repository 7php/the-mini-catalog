<?php
/**
 * Execute during plugin deactivation
 *
 * Mainly used to do less important stuffs than Uninstall
 * for e.g: deleting plugin options and custom tables, etc
 * ref: https://developer.wordpress.org/plugins/plugin-basics/activation-deactivation-hooks/
 */

namespace TMC_MiniCatalog;

/**
 * Class DeActivatePlugin
 * @package TMC_MiniCatalog
 */
class DeActivatePlugin
{
    public function __construct()
    {
        delete_option(PostTypeEnum::TMC_PERMALINKS_KEY);
        $this->deletePageStore();
        $this->deletePagePromo();
        flush_rewrite_rules();
    }

    /**
     * To delete PAGE Store
     */
    public function deletePageStore()
    {
        $page_title = [
            'post_title' => wp_strip_all_tags('Store'),
        ];
        wp_delete_post(get_page_by_title($page_title['post_title'])->ID);
    }

    /**
     * TO delete PAGE Mass Promo
     */
    public function deletePagePromo()
    {
        $page_title = [
            'post_title' => wp_strip_all_tags('Mass Promo'),
        ];
        wp_delete_post(get_page_by_title($page_title['post_title'])->ID);
    }
}
