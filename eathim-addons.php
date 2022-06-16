<?php 
/**
 * Plugin Name: Eathim Addons
 * Description: This is Elementor Custom Addons
 * Plugin URI: #
 * Version: 1.0.0
 * Author: Rawshan
 * Author URI: #
 * Text Domain: eathim
 * 
 * Elementor tested up to:     3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


define('EATHIM_ADDONS__FILE__', __FILE__);
define('EATHIM_ADDONS_DIR_PATH', plugin_dir_path(EATHIM_ADDONS__FILE__));
define('EATHIM_ADDONS_DIR_URL', plugin_dir_url(EATHIM_ADDONS__FILE__));
define('EATHIM_ADDONS_ASSETS', trailingslashit(EATHIM_ADDONS_DIR_URL . 'assets'));

function eathim_addons() {
  // load plugin file
  require_once(__DIR__ . '/includes/plugin.php');

  // Run the plugin file
  \Eathim_Addon\Plugin::instance();
}
add_action('plugins_loaded', 'eathim_addons');