<?php
/**
 * @class   Ws247_lcimages
 */
 
if( !class_exists('Ws247_lcimages') ):
	class Ws247_lcimages{
		/**
		 * Constructor
		 */
		function __construct() { 
			$disable = Ws247_lcimages_Setting::class_get_option('disable');
			if($disable != 'on'){
				$this->init();
			}
		}
		
		public function init(){
			add_filter( 'the_content', array($this, 'add_wraper_div'), 9999999, 1 );
			add_filter( 'body_class', array($this, 'add_body_class') );
		}
		
		public function add_wraper_div($content){ 
			global $post;
			
			$arr_post_type = Ws247_lcimages_Setting::class_get_option('post_type');
			if(!$arr_post_type) $arr_post_type = array();
		
			$post_id = $post->ID;
			$type = $post->post_type;
			
			if( $content ){
				if(in_array($type, $arr_post_type)){
					$i_pos = Ws247_lcimages_Setting::class_get_option('zoom_icon_pos');
					$zoom_icon_pos_class = '';
					if($i_pos){
						$zoom_icon_pos_class = 'zoom_icon_pos-'.$i_pos;
					}
					$content = '<div class="lightbox-lcimages '.$zoom_icon_pos_class.'">'.$content.'</div>';
				}
			}
		
			return $content;
		}
		
		public function add_body_class( $classes ) {
			$classes[] = 'wpshare247-lightbox-lcimages';
			return $classes;
		}

	
	//End class------------------------
	}
	
	//Init
	$Ws247_lcimages = new Ws247_lcimages();
	
endif;