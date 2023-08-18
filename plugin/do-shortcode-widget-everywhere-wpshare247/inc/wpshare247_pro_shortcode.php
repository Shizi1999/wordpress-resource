<?php
if( !class_exists('Ws247_M_WG_Pro_Shortcode') ){
	class Ws247_M_WG_Pro_Shortcode{
		//__construct
		function __construct() {
			//Add fields to widget form
			add_action('in_widget_form', array($this, 'add_new_fields_widget_form'), 5, 3);
			
			//Update widget fields
			add_filter('widget_update_callback', array($this, 'update_new_fields_widget_form'), 5, 3);
			
			//shortcode
			add_shortcode( 'wpshare247_pro_widget_html', array($this, 'shortcode_widget_html') );
			
			if(is_admin()){
				global $pagenow;
				if($pagenow  === 'widgets.php'){
					add_action( 'admin_head', array( $this, 'admin_head' ));
				}
			}
			
			add_filter('plugin_action_links', array( $this, 'add_action_link' ), 999, 2 );
			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		}
		
		public function add_action_link( $links, $file  ){
			$plugin_file = basename ( dirname ( WS247_DSWEW ) ) . '/'. basename(WS247_DSWEW, '');
			if($file == $plugin_file){
				$setting_link = '<a href="' . admin_url('widgets.php') . '">'.__( 'Settings' ).'</a>';
				array_unshift( $links, $setting_link );
			}
			return $links;
		}
		
		public function load_textdomain(){
			load_plugin_textdomain( 'ws247-dswew', false, dirname( plugin_basename( WS247_DSWEW ) ) . '/languages/' ); 
		}
		
		public function add_new_fields_widget_form($wg_obj, $return, $instance){	
			$defaults = array(	
								//'your_new_field' => '',
								//'your_new_field_2' => '', 
								);
			$instance = wp_parse_args((array)$instance, $defaults); 
			
			$number = $wg_obj->number;
			
			if($number=='__i__'){
			?>
            	<p style="color:#f00;"><?php esc_html_e('You need to update first to receive shortcode', 'ws247-dswew');?></p>
            <?php
			}else{
			?>
                <strong>Shortcode</strong><br/>
                <small>(<?php esc_html_e('Click on below code to copy shortcode and insert to post content', 'ws247-dswew');?>)</small><br/>
                <?php 
                $wg_shortcode = '[wpshare247_pro_widget_html widget_id="'.$wg_obj->id.'"]';
                ?>
                <p onClick="wpshare247_copy_shortcode(this);" title="<?php esc_html_e('Click me to copy shortcode', 'ws247-dswew');?>" class="wp-pro-bg" style="display:inline-block; border:1px solid #ccc; padding: 5px; cursor: copy; background: #ff9800 !important;color: #fff !important;"><?php echo esc_attr($wg_shortcode);?></p>
                <br/>
                <small>(<?php esc_html_e('Or click on below code to copy shortcode and insert php template: header.php hoặc footer.php ...etc', 'ws247-dswew');?>)</small><br/>
                <pre onClick="wpshare247_copy_shortcode(this);" title="<?php esc_html_e('Click me to copy shortcode', 'ws247-dswew');?>" class="wp-pro-bg" style="display:inline-block; border:1px solid #ccc; padding: 5px; cursor: copy; background: #ff9800 !important;color: #fff !important;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap; word-wrap: break-word; display:block;">&lt;?php echo do_shortcode('[wpshare247_pro_widget_html id="<?php echo esc_attr($wg_obj->id); ?>"]'); ?&gt;</pre>
			<?php
			}
			$retrun = null;
			return array($wg_obj, $return, $instance);
		}
		
		public function update_new_fields_widget_form($instance, $new_instance, $old_instance){
			//$instance['your_new_field'] = $new_instance['your_new_field'];
			//$instance['your_new_field_2'] = $new_instance['your_new_field_2'];
			
			return $instance;
		}
		
		public function admin_head(){
			?>
            <script>
				function wpshare247_copy_shortcode(tag){ 
					var copyText = jQuery(tag).text();					
					 try {
						navigator.clipboard.writeText(copyText);
						alert("<?php esc_html_e('Copied', 'ws247-dswew');?>");
					  } catch (err) {
						alert("<?php esc_html_e('To copy shortcode, your website must install SSL (https)', 'ws247-dswew');?>");
					  }
					
					return false;
				}
            </script>
            <?php
		}
		
		//[wpshare247_pro_widget_html widget_id="text-2"]
		public function shortcode_widget_html($atts){
			extract(shortcode_atts(array(
				'widget_id'=>''
			), $atts));
			
			global $wp_registered_widgets;
			
			$wg_class_obj = $wp_registered_widgets[ $widget_id ]['callback'][0]; 
			if($wg_class_obj){
				ob_start();
				
				$number = $wg_class_obj->number;
				$arr_setting = $wg_class_obj->get_settings(); 
				the_widget( get_class($wg_class_obj) , $arr_setting[$number]);
				
				return ob_get_clean();
			}
			
			return '';
		}
	}
	
	$Ws247_M_WG_Pro_Shortcode = new Ws247_M_WG_Pro_Shortcode();
}