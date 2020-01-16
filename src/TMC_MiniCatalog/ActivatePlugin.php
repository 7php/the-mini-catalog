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
        initCustomPostType();
        flush_rewrite_rules();
    }
}
