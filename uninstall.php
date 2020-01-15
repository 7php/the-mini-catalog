<?php
/**
 * When coding this page, consider checklist:
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * ref: https://github.com/DevinVinson/WordPress-Plugin-Boilerplate/blob/master/plugin-name/uninstall.php
 */
if (! defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}
