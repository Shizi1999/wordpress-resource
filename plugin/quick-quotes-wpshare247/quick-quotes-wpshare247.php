<?php
/**
 * Plugin Name: Quick quotes - WPSHARE247
 * Plugin URI: https://wpshare247.com/
 * Description: Create quick quotes for all careers and services
 * Version: 1.0.0
 * Author: Wpshare247.com
 * Author URI: https://wpshare247.com
 * Text Domain: ws247-quick-quote
 * Domain Path: /languages/
 * Requires at least: 4.9
 * Requires PHP: 5.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WS247_QUOTE_QQFS', __FILE__ );
define( 'WS247_QUOTE_QQFS_PLUGIN_DIR', untrailingslashit( dirname( WS247_QUOTE_QQFS ) ) );
define( 'WS247_QUOTE_QQFS_PLUGIN_INC_DIR', WS247_QUOTE_QQFS_PLUGIN_DIR . '/inc' );  
define( 'WS247_QUOTE_QQFS_PLUGIN_INC_ASSETS', WS247_QUOTE_QQFS_PLUGIN_DIR . '/assets' );
require_once WS247_QUOTE_QQFS_PLUGIN_INC_DIR . '/define.php';
require_once WS247_QUOTE_QQFS_PLUGIN_INC_DIR . '/class.helper.php';
require_once WS247_QUOTE_QQFS_PLUGIN_INC_DIR . '/class.setting.page.php';
require_once WS247_QUOTE_QQFS_PLUGIN_INC_DIR . '/posttype/posttype_index.php';
require_once WS247_QUOTE_QQFS_PLUGIN_INC_DIR . '/metabox/metabox_index.php';
require_once WS247_QUOTE_QQFS_PLUGIN_INC_DIR . '/shortcode/shortcode_index.php';
require_once WS247_QUOTE_QQFS_PLUGIN_INC_DIR . '/theme_functions.php';