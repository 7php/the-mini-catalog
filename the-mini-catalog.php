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
define( 'TMC_TEXT_DOMAIN',     'the-mini-catalog' );
if (! defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR); //[NOTE: do not confuse with PATH_SEPARATOR == : ]
}
define('TMC_WEB_ROOT',      plugin_dir_url(__FILE__));
define('TMC_PLUGIN_ROOT',   plugin_dir_path( __FILE__ ) ); //with trailing slash at end
define('TMC_SRC',           plugin_dir_path( __FILE__ ) . 'src' . DS);
define('TMC_VENDOR',        plugin_dir_path( __FILE__ ) . 'vendor' . DS);
define('TMC_ADMIN_TPL',     plugin_dir_path( __FILE__ ) . 'admin/views' . DS);

/**
 * Let's make a ruckus
 */
tmc_initAutoloading(TMC_PLUGIN_ROOT);
register_activation_hook(__FILE__, 'activate_the_mini_catalog_tmc');
register_deactivation_hook(__FILE__, 'deactivate_the_mini_catalog_tmc');
add_action('init', 'initCustomPostType');

/**
 * The code that runs during plugin activation.
 */
function activate_the_mini_catalog_tmc()
{
    new \TMC_MiniCatalog\ActivatePlugin();
}

/**
 * The code that runs during plugin deactivation.
 * ref: https://developer.wordpress.org/plugins/plugin-basics/activation-deactivation-hooks/
 */
function deactivate_the_mini_catalog_tmc()
{
    new \TMC_MiniCatalog\DeActivatePlugin();
}

/**
 * Allows us to dynamically include classes (PSR-4)
 */
function tmc_initAutoloading($plugin_dir)
{
    require_once $plugin_dir . 'src/UniversalClassLoader.php';

    $namespace_array = [
        'TMC_MiniCatalog' => TMC_SRC,
        'SavantPHP'       => TMC_VENDOR,
    ];
    $autoLoader = new UniversalClassLoader();
    $autoLoader->registerNamespaces($namespace_array);
    $autoLoader->register();
}

/**
 * CPTs don't get added to the DB
 * Hence we need our CPT object to be always present
 *
 * @throws Exception
 */
function initCustomPostType()
{
    add_action('admin_enqueue_scripts', 'tmc_enqueue_admin_script');
    $productObject = \TMC_MiniCatalog\ProductPostType::getInstance();
    $productObject->register();
}

/**
 * Enqueue a script in the WordPress admin, just for post.php
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function tmc_enqueue_admin_script($hook)
{
    if ('post.php' == $hook) {
        //css
        wp_enqueue_style('tmc-datepicker-css', TMC_WEB_ROOT . 'admin/assets/css/datepicker.css');
        wp_enqueue_style('tmc-timepicker-css', TMC_WEB_ROOT . 'admin/assets/css/timepicker.css');
        //js in footer
        wp_enqueue_script( 'tmc-datepicker-script', TMC_WEB_ROOT . 'admin/assets/js/datepicker.min.js', ['jquery'], false, true );
        wp_enqueue_script( 'tmc-timepicker-script', TMC_WEB_ROOT . 'admin/assets/js/jquery-ui-timepicker-addon.min.js', ['jquery', 'tmc-datepicker-script'], false, true );
    }
}

/**
 * prepare the Savant tpl object
 * @return \SavantPHP\SavantPHP
 */
function tplObject()
{
    $configBag = [
        \SavantPHP\SavantPHP::TPL_PATH_LIST => [ TMC_ADMIN_TPL,],
    ];
    return new \SavantPHP\SavantPHP($configBag);
}
