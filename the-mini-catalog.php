<?php
/**
 * The Mini Catalog (TMC)
 * @package the_mini_catalog
 *
 * @wordpress-plugin
 * Plugin Name:       The Mini Catalog
 * Plugin URI:        https://theminucatalog.local
 * Description:       A minimal plugin to create Products and Showcase the catalog
 * Version:           1.0.0
 * Requires at least: 5.3.2
 * Requires PHP:      7.2
 * Author:            Khayrattee Wasseem
 * Author URI:        https://7php.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       the-mini-catalog
 * Domain Path:       /languages
 *
 * ref: https://developer.wordpress.org/plugins
 */
if ( ! defined( 'WPINC')) {
    die;
}
define( 'PLUGIN_NAME_VERSION', '1.0.0' );
define( 'TMC_TEXT_DOMAIN', 'the-mini-catalog' );
define('DS', DIRECTORY_SEPARATOR); //[NOTE: do not confuse with PATH_SEPARATOR == : ]
define('TMC_PLUGIN_ROOT', plugin_dir_path( __FILE__ ) ); //with trailing slash at end
define('TMC_SRC', plugin_dir_path( __FILE__ ) . 'src' . DS); //with trailing slash at end

/**
 * The code that runs during plugin activation.
 */
function activate_the_mini_catalog_tmc()
{
    new \MiniCatalog\ActivatePlugin();
}

/**
 * The code that runs during plugin deactivation.
 * ref: https://developer.wordpress.org/plugins/plugin-basics/activation-deactivation-hooks/
 */
function deactivate_the_mini_catalog_tmc()
{
    new \MiniCatalog\DeActivatePlugin();
}

/**
 * Allows us to dynamically include classes (PSR-4)
 */
function tmc_initAutoloading($plugin_dir)
{
    require_once $plugin_dir . 'src/UniversalClassLoader.php';

    $namespace_array = [
        'TMC_MiniCatalog' => SRC,
    ];
    $autoLoader = new UniversalClassLoader();
    $autoLoader->registerNamespaces($namespace_array);
    $autoLoader->register();
}

tmc_initAutoloading(TMC_PLUGIN_ROOT);
register_activation_hook(__FILE__, 'activate_the_mini_catalog_tmc');
register_deactivation_hook(__FILE__, 'deactivate_the_mini_catalog_tmc');
