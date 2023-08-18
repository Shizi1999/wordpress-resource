<?php
if( !class_exists('Ws247_M_WG_Helper') ){
	class Ws247_M_WG_Helper{
		
		//__construct
		function __construct() {
			add_action('wp_ajax_ws247_init_autocomplete_field', array($this, 'ajax_ws247_init_autocomplete_field'));
			add_action('wp_ajax_nopriv_ws247_init_autocomplete_field', array($this, 'ajax_ws247_init_autocomplete_field'));
		}
		
		public function ajax_ws247_init_autocomplete_field(){
			$html = '<li>Không tìm thấy</li>';
			
			//_REQUEST
			$text_enter = $_REQUEST['text_enter']; 
			$inp_rel = $_REQUEST['inp_rel']; 
			$inp_id = $_REQUEST['inp_id'];  
			$post_type = $_REQUEST['post_type'];
			
			//_DO ACTION
			if($text_enter){
				global $wpdb;
				$sql = " 
						SELECT *
	
						FROM $wpdb->posts
						
						WHERE post_title like '".$text_enter."%' AND post_status = %s AND post_type = %s
						
						ORDER BY post_title ASC
						
						LIMIT 0,5
					
					";
				
				$arr_prepare = array('publish', $post_type);
				$sql = $wpdb->prepare( $sql, $arr_prepare );
				
				if($sql){
					$results =  $wpdb->get_results($sql);
					//wp_send_json(array('html' => $sql));
					if($results){
						$html = '';
						foreach($results as $obj){
							$html .= '<li onClick="wpshare247_auto_complete_click(this, \''.$inp_rel.'\', '.$obj->ID.', \''.$inp_id.'\');"><a>'.$obj->post_title.'</a></li>';
						}
					}
				}
			}
			
			$html .= '<li class="li-close" onClick="wpshare247_autocomplete_close();"><a class="autocomplete-close">Đóng</a></li>';
			
						
			//_RESPONSE
			$return = array(
					'html' => $html
			);
				
			wp_send_json($return);
		}
		
	} // End class
	
	new Ws247_M_WG_Helper();
}