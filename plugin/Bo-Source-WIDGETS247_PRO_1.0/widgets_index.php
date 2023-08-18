<?php
define( 'Ws247_M_WG_Fancybox_ON', true ); // Off if you don't use
define('WPSHARE247_WG_DIR', dirname(__FILE__));

require_once ( WPSHARE247_WG_DIR.'/widget_helper/wpshare247_repeat_sortable.php' );

$arr_init_wg = array(	
				'wpshare247_all_fields',
				'wpshare247_autocomplete_field',
				'wpshare247_basic_fields',
				'wpshare247_color_picker_field',
				'wpshare247_contact_form_7_field',
				'wpshare247_datepicker_field',
				'wpshare247_gallery_field',
				'wpshare247_image_field',
				'wpshare247_navigation_menu_field',
				'wpshare247_post_type_id_field',
				'wpshare247_repeat_field'
				//'add_new_here', //file exist : add_new_here.php
			);

//For Pro
$arr_init_wg_pro = array(
				'wpshare247_pro_header01',
				'wpshare247_pro_header02',
				'wpshare247_pro_header03',
				'wpshare247_pro_services',
				'wpshare247_pro_team'
				//'add_new_here_for_pro',
			);
			
require_once ( WPSHARE247_WG_DIR . '/widget_helper/wpshare247_module_widget.php' );

include ( WPSHARE247_WG_DIR . '/widget_helper/wpshare247_pro_helper.php' );