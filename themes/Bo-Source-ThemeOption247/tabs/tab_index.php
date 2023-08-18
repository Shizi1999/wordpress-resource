<?php
require_once ( str_replace("tabs", "inc", dirname(__FILE__)) .'/helper_get.php' );

define('OPTIONS_PREFIX', 'wpshare247_');
define('OPTIONS_TEXTDOMAIN', 'WPSHARE247_TEXT_DOMAIN');

$arr_section = array();
//Add new option tab
//require_once ( dirname(__FILE__) .'/tab_name.php' );

require_once ( dirname(__FILE__) .'/tab_option_1.php' );
require_once ( dirname(__FILE__) .'/tab_option_3.php' );
require_once ( dirname(__FILE__) .'/tab_option_2.php' );
require_once ( dirname(__FILE__) .'/tab_option_n.php' );