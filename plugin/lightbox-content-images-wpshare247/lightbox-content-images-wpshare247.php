<?php
/**
 * Plugin Name: Lightbox content images - WPSHARE247
 * Plugin URI: https://wpshare247.com/
 * Description: Zoom content images, photos in article content (post, page, custom post type)
 * Version: 1.0
 * Author: Wpshare247.com
 * Author URI: https://wpshare247.com
 * Text Domain: ws247-lcimages
 * Domain Path: /languages/
 * Requires at least: 4.9
 * Requires PHP: 5.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WS247_LCIMAGES', __FILE__ );
define( 'WS247_LCIMAGES_PLUGIN_DIR', untrailingslashit( dirname( WS247_LCIMAGES ) ) );
define( 'WS247_LCIMAGES_PLUGIN_INC_DIR', WS247_LCIMAGES_PLUGIN_DIR . '/inc' );  
define( 'WS247_LCIMAGES_PLUGIN_INC_ASSETS', WS247_LCIMAGES_PLUGIN_DIR . '/assets' );
require_once WS247_LCIMAGES_PLUGIN_INC_DIR . '/define.php';
require_once WS247_LCIMAGES_PLUGIN_INC_DIR . '/class.helper.php';
require_once WS247_LCIMAGES_PLUGIN_INC_DIR . '/class.setting.page.php';
require_once WS247_LCIMAGES_PLUGIN_INC_DIR . '/theme_functions.php';

