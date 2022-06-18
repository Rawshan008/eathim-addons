<?php 
/**
 * Plugin Name: Eathim Addons
 * Description: This is Elementor Custom Addons
 * Plugin URI: #
 * Version: 1.0.0
 * Author: Rawshan
 * Author URI: #
 * Text Domain: eathim-addons
 * 
 * Elementor tested up to:     3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'EATHIM_ADDONS_VERSION', '1.0.0' );

/**
 * Define
 */
define('EATHIM_ADDONS__FILE__', __FILE__);
define('EATHIM_ADDONS_DIR_PATH', plugin_dir_path(EATHIM_ADDONS__FILE__));
define('EATHIM_ADDONS_DIR_URL', plugin_dir_url(EATHIM_ADDONS__FILE__));
define('EATHIM_ADDONS_ASSETS', trailingslashit(EATHIM_ADDONS_DIR_URL . 'assets'));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-eathim-addons-activator.php
 */
function activate_eathim_addons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/admin/class-eathim-addons-activator.php';
	Eathim_Addons_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-eathim-addons-deactivator.php
 */
function deactivate_eathim_addons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/admin/class-eathim-addons-deactivator.php';
	Eathim_Addons_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_eathim_addons' );
register_deactivation_hook( __FILE__, 'deactivate_eathim_addons' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/admin/class-eathim-addons.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_eathim_addons() {

	$plugin = new Eathim_Addons();
	$plugin->run();

}
run_eathim_addons();

function eathim_addons() {
  // load plugin file
  require_once(__DIR__ . '/includes/plugin.php');

  // Run the plugin file
  \Eathim_Addon\Plugin::instance();
}
add_action('plugins_loaded', 'eathim_addons');