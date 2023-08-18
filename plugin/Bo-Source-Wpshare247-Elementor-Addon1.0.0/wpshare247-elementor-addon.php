<?php
/**
 * Plugin Name: WPSHARE247 Elementor Addons
 * Plugin URI: https://wpshare247.com/
 * Description: Widgets (Wpshare247 Addons) for Elementor. Wpshare247 Addons for Elementor plugin includes widgets and addons like Blog Post, Products, Post, Page and Custom Post Type Grid or Carousel.
 * Version: 1.0.0
 * Author: Wpshare247.com
 * Author URI: https://wpshare247.com/chuyen-muc/elementor
 * Text Domain: wpshare247-elementor-addon
 * Domain Path: /languages/
 * Requires at least: 4.9
 * Requires PHP: 7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function wpshare247_elementor_addon() {
	define( 'WPSHARE247_ELEMENTOR_ADDON_MAIN_FILE', __FILE__ );
	define( 'WPSHARE247_ELEMENTOR_ADDON_PREFIX', 'ws247_ea_');

	require_once( __DIR__ . '/inc/helper.php' ); 
	require_once( __DIR__ . '/inc/woocommerce.php' );

	// Load plugin file
	require_once( __DIR__ . '/includes/plugin.php' ); 

	// Run the plugin
	\WPSHARE247_Elementor_Addon\Plugin::instance();

}
add_action( 'plugins_loaded', 'wpshare247_elementor_addon' );