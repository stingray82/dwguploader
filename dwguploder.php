<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              wordpressninja.co.uk
 * @since             1.0.0
 * @package           Dwguploder
 *
 * @wordpress-plugin
 * Plugin Name:       DWG Uploader
 * Plugin URI:        https://wordpressninja.co.uk
 * Description:       A plugin designed to allow you to upload DWG file and DXF files to your wordpress dashboard
 * Version:           1.0.0
 * Author:            wordpressninja.co.uk
 * Author URI:        wordpressninja.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dwguploder
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DWGUPLODER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dwguploder-activator.php
 */
function activate_dwguploder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dwguploder-activator.php';
	Dwguploder_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dwguploder-deactivator.php
 */
function deactivate_dwguploder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dwguploder-deactivator.php';
	Dwguploder_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dwguploder' );
register_deactivation_hook( __FILE__, 'deactivate_dwguploder' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dwguploder.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function my_myme_types($mime_types){
    $mime_types['dwg'] = 'image/vnd.dwg'; //Adding dwg extension
	$mime_types['dxf'] = 'image/vnd.dxf'; //Adding dxf extension
	return $mime_types;
}

function run_dwguploder() {

	$plugin = new Dwguploder();
	$plugin->run();
	add_filter('upload_mimes', 'my_myme_types', 1, 1);
	

}
run_dwguploder();
