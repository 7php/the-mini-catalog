<?php
/**
 * The Mini Catalog (TMC)
 * @package the_mini_catalog
 * @author Khayrattee Wasseem <wasseem@khayrattee.com>
 * @copyright Copyright (c) 2020 Wasseem Khayrattee
 * @license GPL-3.0
 * @link https://7php.com (website)
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
 * License:           GPL-3.0
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       the-mini-catalog
 * Domain Path:       /languages
 *
 * ref: https://developer.wordpress.org/plugins
 */

use SavantPHP\SavantPHP;
use TMC_MiniCatalog\ActivatePlugin;
use TMC_MiniCatalog\DeActivatePlugin;
use TMC_MiniCatalog\PermalinkSettings;
use TMC_MiniCatalog\PostTypeEnum;
use TMC_MiniCatalog\ProductPostType;

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
add_action('admin_init', 'initPermalinks');
add_action('admin_enqueue_scripts', 'tmc_enqueue_admin_script');
add_action('init', 'initCustomPostType');
add_filter('single_template', 'set_custom_template');
applyPageTemplateOverride();

/**
 * The code that runs during plugin activation.
 */
function activate_the_mini_catalog_tmc()
{
    new ActivatePlugin();
}

/**
 * The code that runs during plugin deactivation.
 * ref: https://developer.wordpress.org/plugins/plugin-basics/activation-deactivation-hooks/
 */
function deactivate_the_mini_catalog_tmc()
{
    new DeActivatePlugin();
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
    $productObject = ProductPostType::getInstance();
    $productObject->register();
}

/**
 * Handles custom permalink structure in Permalink Settings for dynamic slug
 * We need to call this before we initCustomFields as we want the slug to be dynamic, so we fetch from DB first
 */
function initPermalinks()
{
    $permalinkObject = PermalinkSettings::getInstance();
    $permalinkObject->initPermalinks();
}
/**
 * Enqueue a script in the WordPress admin, just for post.php
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function tmc_enqueue_admin_script($hook)
{
    if (in_array($hook, ['post-new.php', 'post.php'])) {
        //css
        wp_enqueue_style('tmc-bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css');
        wp_enqueue_style('tmc-bootstrap-css', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
        wp_enqueue_style('tmc-datepicker-css', TMC_WEB_ROOT . 'admin/assets/css/bootstrap-datetimepicker.css');

        //js in footer
        wp_enqueue_script( 'tmc-bootstrap-script', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js', ['jquery'], false, true );
        wp_enqueue_script( 'tmc-moments-script', '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js', ['jquery'], false, true );
        wp_enqueue_script( 'tmc-datepicker-script', TMC_WEB_ROOT . 'admin/assets/js/bootstrap-datetimepicker.js', ['jquery'], false, true );
    }
}

/**
 * prepare the Savant tpl object
 * @return SavantPHP
 */
function tplObject()
{
    $configBag = [
        SavantPHP::TPL_PATH_LIST => [ TMC_ADMIN_TPL,],
    ];
    return new SavantPHP($configBag);
}

/**
 * Set a custom tpl for all tmc_product custom post
 * @return string
 */
function set_custom_template()
{
    if (PostTypeEnum::CUSTOM_POST_TYPE == get_post_type()) {
        return TMC_PLUGIN_ROOT . 'public/views/single-tmc_product.php';
    }
}

/**
 * Add filter to override our custom created pages
 */
function applyPageTemplateOverride()
{
    add_filter('template_include', 'tmc_page_template_override', 99);
}

/**
 * @param $template
 * @return string
 */
function tmc_page_template_override($template)
{
    if (is_page('store')) {
        $template = TMC_PLUGIN_ROOT . '/public/views/store-page.php';
    }
    if (is_page('mass-promo')) {
        $template = TMC_PLUGIN_ROOT . '/public/views/mass-promo-page.php';
    }
    return $template;
}
