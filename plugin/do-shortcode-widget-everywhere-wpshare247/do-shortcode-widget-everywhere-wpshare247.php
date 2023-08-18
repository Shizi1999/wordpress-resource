<?php
/**
 * Plugin Name: Do Shortcode Widget EveryWhere - WPSHARE247
 * Plugin URI: https://wpshare247.com/
 * Description: Do shortcode widget everywhere you want, in  post, page constent, in content editor classic or Gutenberg hoac template wordpress as header.php, footer.php....
 * Version: 1.0.1
 * Author: Wpshare247.com
 * Author URI: https://wpshare247.com
 * Text Domain: ws247-dswew
 * Domain Path: /languages/
 * Requires at least: 4.9
 * Requires PHP: 5.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WS247_DSWEW', __FILE__ );
define( 'WS247_DSWEW_PLUGIN_DIR', untrailingslashit( dirname( WS247_DSWEW ) ) );
define( 'WS247_DSWEW_PLUGIN_INC_DIR', WS247_DSWEW_PLUGIN_DIR . '/inc' );  
require_once WS247_DSWEW_PLUGIN_INC_DIR . '/wpshare247_pro_shortcode.php';

