<?php
/**
 * Execute during plugin deactivation
 *
 * Mainly used to do less important stuffs than Uninstall
 * for e.g: deleting plugin options and custom tables, etc
 * ref: https://developer.wordpress.org/plugins/plugin-basics/activation-deactivation-hooks/
 */

namespace MiniCatalog;

/**
 * Class DeActivatePlugin
 * @package MiniCatalog
 */
class DeActivatePlugin
{
    public function __construct()
    {
    }
}
