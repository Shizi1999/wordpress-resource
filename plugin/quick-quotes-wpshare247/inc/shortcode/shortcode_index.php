<?php
if( !class_exists('Wp247_quote_qqfs_shortcode') ):
	class Wp247_quote_qqfs_shortcode{
		
		/**
		 * Constructor
		 */
		function __construct() {
			add_shortcode( 'quote_qqfs_new', array($this, 'quote_qqfs_new_display') );
		}
		
		//[quote_qqfs_new id="4969"]
		public function quote_qqfs_new_display( $atts, $content = null  ){
			extract(shortcode_atts(array(
				'id'=>'',
			), $atts));
			
			if(get_post_status( $id )=='publish'){ 
				set_query_var( 'quote_id', $id );
				$content = Wp247_quote_qqfs_Helper::get_template_part('frontend/quote', '', false);
				$content = apply_filters( 'ws247_qqfs_quote_html', $content, $id );
			}
			
			return $content;
		}
		
	//End Class
	}
	
	new Wp247_quote_qqfs_shortcode();

endif;