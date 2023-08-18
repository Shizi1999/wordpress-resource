<?php
if( !class_exists('Ws247_lcimages_Helper') ):

	class Ws247_lcimages_Helper{

		public function ws247_lcimages_init_load_post_types(){
			header("Content-Type: application/json", true);

			$html = '';
			//_REQUEST
			
			//_DO ACTION
			$args = array(
					'show_ui'	=> 1
				);
			$objects = get_post_types( $args, 'objects' );
			
			if($objects){
				$field_name = 'post_type';
				$arr_field_name_val = get_option(WS247_LCIMAGES_PREFIX.$field_name);
				if(!$arr_field_name_val) $arr_field_name_val = array();
				
				$field = WS247_LCIMAGES_PREFIX.$field_name;
		
				foreach( $objects as $type => $object ) {
					if( !$object->public || $object->name == 'attachment' ) continue;
					
					$checked = '';
					if( in_array($type, $arr_field_name_val) ){ 
						$checked = 'checked';
					}
					
					
					$arr_labels = $object->labels;
					// append
					
					$html .= '<li>
									<input '.$checked.' id="'.esc_html($field.'_'.$type).'" type="checkbox" value="'.esc_attr($type).'" name="'.esc_html($field).'[]"> 
									<label for="'.esc_html($field.'_'.$type).'">'.esc_html($arr_labels->singular_name).'</label>
								</li>';
				}
			}
			
			//_RESPONSE
			$response = array	(
									'html' => $html
								);
			wp_send_json($response);
		}
	
	// end class-------------------------------------------------------------------------
	}
endif;