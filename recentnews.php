<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://alex.stocker.info
 * @since             1.0.0
 * @package           Recentnews
 *
 * @wordpress-plugin
 * Plugin Name:       RecentNews ShortCode
 * Plugin URI:        https://alex.stocker.info/category/wordpress/
 * Description:       Enables a shortcode to list recent posts [recentnews /]
 * Version:           1.0.2
 * Author:            Alexander Stocker
 * Author URI:        https://alex.stocker.info
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       recentnews
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-recentnews-activator.php
 */
function activate_recentnews() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-recentnews-activator.php';
	Recentnews_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-recentnews-deactivator.php
 */
function deactivate_recentnews() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-recentnews-deactivator.php';
	Recentnews_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_recentnews' );
register_deactivation_hook( __FILE__, 'deactivate_recentnews' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-recentnews.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_recentnews() {

	$plugin = new Recentnews();
	$plugin->run();

}
run_recentnews();
