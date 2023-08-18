<?php
if( !class_exists('Ws247_M_WG') ){
	require_once ( WPSHARE247_WG_DIR . '/widget_helper/wpshare247_helper.php' );
	
	class Ws247_M_WG{
		
		//__construct
		function __construct() {
			$this->ver = '1.0';
			$this->prefix_ = 'wpshare247.com_ws247_';
			$this->js_lib_url = get_theme_file_uri(self::get_current_dir().'/widget_helper/assets/js');
			$this->css_lib_url = get_theme_file_uri(self::get_current_dir().'/widget_helper/assets/css');
			
			add_action( 'after_setup_theme',  array($this, 'after_setup_theme') );
			
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ));
			add_action('widgets_init', array($this, 'register_widgets') );
			
			//Register lib for front page
			add_action( 'wp_enqueue_scripts', array( $this, 'register_frontend_css_js' ) );
			
		}
		
		
		public function after_setup_theme(){
			remove_theme_support( 'widgets-block-editor' );
		}
		
		static function get_current_dir(){
			$arr_ = explode(basename(get_template_directory()), WPSHARE247_WG_DIR);
			$s_dir = $arr_[ count($arr_) - 1];
			$s_dir = str_replace("\\", "/", $s_dir);
			return $s_dir;
		}
		
		public function register_frontend_css_js(){
			//Fancybox lib
			if(Ws247_M_WG_Fancybox_ON){
				wp_enqueue_style( $this->prefix_.'fancybox.css', $this->js_lib_url . '/fancybox/dist/jquery.fancybox.min.css', false, '3.5.7' );
				wp_enqueue_script( $this->prefix_.'fancybox.js', $this->js_lib_url . '/fancybox/dist/jquery.fancybox.min.js', array( 'jquery' ), '3.5.7', true );
			}
			
			//Bootstrap v5.0.1
			wp_enqueue_style( $this->prefix_.'bootstrap.wpshare247.css_5.0.1', $this->css_lib_url . '/bootstrap/5.0.1/bootstrap.wpshare247.css', false, '5.0.2' );
		
			//Font awsome 470
			wp_enqueue_style( $this->prefix_.'font-awesome.min.css_4.7.0', $this->css_lib_url . '/font-awesome/4.7.0/css/font-awesome.min.css', false, '4.7.0' );
		
			//Font awsome 5.6.1
			//wp_enqueue_style( $this->prefix_.'font-awesome.min.css_5.6.1', $this->css_lib_url . '/font-awesome/5.6.1/css/all.min.css', false, '5.6.1' );
			
		}
		
		public function admin_enqueue_scripts(){
			wp_enqueue_style( 'wp-color-picker' );
    		wp_enqueue_script( 'wp-color-picker');
			wp_enqueue_script( 'jquery-ui-datepicker' );
			wp_enqueue_media();
			
			global $pagenow;
			if($pagenow  === 'widgets.php'){
				wp_enqueue_style( 'jquery-ui-datepicker-style' , '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css');
			}
			
			wp_enqueue_style( $this->prefix_.'fancybox.css', $this->js_lib_url . '/fancybox/dist/jquery.fancybox.min.css', false, '3.5.7' );
			wp_enqueue_script( $this->prefix_.'fancybox.js', $this->js_lib_url . '/fancybox/dist/jquery.fancybox.min.js', array( 'jquery' ), '3.5.7', true );
		}
		
		public function wg_setup( $wg_class ){
			$this->wg_class = $wg_class;
			
			//backend
			add_action('admin_head', array($this, 'admin_head_css_js'));
		}
		
		public function admin_head_css_js(){ 
			$wg_class = $this->wg_class;
			$wg_thumb_src = get_theme_file_uri( Ws247_M_WG::get_current_dir() . '/pro/'.$wg_class.'.png' ) ;
			$wg_thumb_src_dir = get_parent_theme_file_path( Ws247_M_WG::get_current_dir() . '/pro/'.$wg_class.'.png' ); 
			
			if( !file_exists($wg_thumb_src_dir) ){
				$wg_thumb_src_dir = get_parent_theme_file_path( Ws247_M_WG::get_current_dir() . '/pro/'.$wg_class.'/'.$wg_class.'.png' ); 
				$wg_thumb_src = get_theme_file_uri( Ws247_M_WG::get_current_dir() . '/pro/'.$wg_class.'/'.$wg_class.'.png' ) ;
			}
			
			if( file_exists($wg_thumb_src_dir) ){
		?>
        	<script>
            	jQuery(document).ready(function(e) { 
					jQuery("#widgets-left #available-widgets #widget-list>.widget").each(function(index, element) {
                        var widgetid = jQuery(this).attr("id");
						var caption = jQuery("#available-widgets #"+widgetid+" .widget-description").text();
						if( widgetid.indexOf('<?php echo $wg_class;?>') > -1 ){
							jQuery("#available-widgets #"+widgetid+" .widget-description").prepend('<div class="wpshare247-pro-thumb"><a data-caption="'+caption+'" title="Xem" target="_blank" data-fancybox="wpshare247-pro-thumb" href="<?php echo $wg_thumb_src;?>"><img src="<?php echo $wg_thumb_src;?>" /></a></div>');
						}
                    });
                });
            </script>
        <?php
			}
		}
		
		//Widgets load
		public function register_widgets(){
			global $arr_init_wg;
			if($arr_init_wg):
				foreach($arr_init_wg as $file_name){
					$file = WPSHARE247_WG_DIR.'/'.$file_name.'.php'; 
					if( file_exists($file) ){
						require_once($file);
						register_widget($file_name);
					}
				}
			endif;	//end if arr_init
			
			
			//update pro version-----------------------
			global $arr_init_wg_pro;
			if($arr_init_wg_pro):
				foreach($arr_init_wg_pro as $file_name){
					$file = WPSHARE247_WG_DIR.'/pro/'.$file_name.'.php'; 
					
					if( !file_exists($file) ){
						$file = WPSHARE247_WG_DIR.'/pro/'.$file_name.'/'.$file_name.'.php';
					}
					
					if( file_exists($file) ){
						require_once($file);
						register_widget($file_name);
					}
				}
			endif;	//end if arr_init_wg_pro
			
		}
		
		static function get_post_types( $post_type = 'page' ){
			$args = array( 
						'post_type' => $post_type, 
						'order' => 'DESC',
						'post_status' => 'publish',
						'posts_per_page' => '-1');
			$arr = get_posts( $args );
			return $arr;
		}
		
		//Get html functions
		static function the_html_gallery_field($raw_val, $size_gallery){
			if(!$raw_val) return '';
			$arr_gallery = json_decode($raw_val, true);
			if($arr_gallery){
				$args['arr_gallery'] = $arr_gallery;
				$args['size_gallery'] = $size_gallery;
				get_template_part( self::get_current_dir().'/widget_helper/template/gallery', 'field', $args );
			}
		}
		
		//Helper functions
		static function helper_text_field($id_field, $title, $wg, $instance){
		?>
        	<p>
				<label for="<?php echo esc_attr($wg->get_field_id($id_field)); ?>"><?php esc_html_e($title, 'wpshare247'); ?></label>
				<input class="widefat" type="text" value="<?php echo esc_attr($instance[$id_field]); ?>" name="<?php echo esc_attr($wg->get_field_name($id_field)); ?>" id="<?php echo esc_attr($wg->get_field_id($id_field)); ?>" />
			</p>
        <?php
		}
		
		static function helper_textarea_field($id_field, $title, $wg, $instance){
		?>
        	<p>
				<label for="<?php echo esc_attr($wg->get_field_id($id_field)); ?>"><?php esc_html_e($title, 'wpshare247'); ?></label>
				<textarea name="<?php echo esc_attr($wg->get_field_name($id_field)); ?>" id="<?php echo esc_attr($wg->get_field_id($id_field)); ?>" class="widefat"><?php echo esc_attr($instance[$id_field]); ?></textarea>
			</p>
        <?php
		}
		
		static function helper_post_type_field($id_field, $title, $wg, $instance, $post_type){
			$arr = self::get_post_types( $post_type );
		?>
        	<p>
                <label for="<?php echo esc_attr($wg->get_field_id($id_field)); ?>"><?php esc_html_e($title, 'wpshare247'); ?></label>
                <select id="<?php echo esc_attr($wg->get_field_id($id_field)); ?>" class="widefat" name="<?php echo esc_attr($wg->get_field_name($id_field)); ?>">
                    <option value="" <?php selected("", $instance[$id_field]); ?>><?php esc_html_e('--Chọn--', 'wpshare247'); ?></option>
                    <?php
					if($arr){ 
						foreach($arr as $f){
							$id = $f->ID;
						?>
							<option value="<?php echo $id;?>" <?php selected($id, $instance[$id_field]); ?>><?php esc_html_e($f->post_title, 'wpshare247'); ?></option>
						<?php
						}
					}
                    ?>
                </select>
            </p>
        <?php
		}
		
		static function helper_contact_form7_field($id_field, $title, $wg, $instance){
			self::helper_post_type_field($id_field, $title, $wg, $instance, 'wpcf7_contact_form');
		}
		
		static function helper_page_field($id_field, $title, $wg, $instance){
			self::helper_post_type_field($id_field, $title, $wg, $instance, 'page');
		}
		
		static function helper_post_field($id_field, $title, $wg, $instance){
			self::helper_post_type_field($id_field, $title, $wg, $instance, 'post');
		}
		
		static function helper_product_field($id_field, $title, $wg, $instance){
			self::helper_post_type_field($id_field, $title, $wg, $instance, 'product');
		}
		
		static function helper_wp_nav_field($id_field, $title, $wg, $instance){
			$all_nav_menu = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
			$current_nav_id = $instance[$id_field];
		?>
        	<p>
                <label for="<?php echo esc_attr($wg->get_field_id($id_field)); ?>"><?php esc_html_e($title, 'wpshare247'); ?></label>
                <select id="<?php echo esc_attr($wg->get_field_id($id_field)); ?>" class="widefat" name="<?php echo esc_attr($wg->get_field_name($id_field)); ?>">
                    <option value="" <?php selected("", $instance[$id_field]); ?>><?php esc_html_e('--Chọn--', 'wpshare247'); ?></option>
                    <?php
					if($all_nav_menu){ 
						foreach($all_nav_menu as $f){
							$id = $f->term_id;
						?>
							<option value="<?php echo $id;?>" <?php selected($id, $instance[$id_field]); ?>><?php esc_html_e($f->name, 'wpshare247'); ?></option>
						<?php
						}
					}
                    ?>
                </select>
                <span class="w366-note-group">
					<?php 
                    if($current_nav_id){
                    ?>
                    <span>Sửa menu <a href="<?php echo admin_url('nav-menus.php?menu='.$current_nav_id);?>" target="_blank"><span class="dashicons dashicons-edit"></span></a></span><br/>
                    <?php
                    }
                    ?>
                	<span>Bạn có thể thêm mới 1 menu <a href="<?php echo admin_url('nav-menus.php?action=edit&menu=0');?>" target="_blank"><span class="dashicons dashicons-plus"></span></a></span>
            	</span>
            </p>
        <?php
		}
		
		static function helper_image_field($id_field, $title, $wg, $instance){ 
			$id = 'w366_click_img_'.uniqid();
		?>
        <p>
            <label for="<?php echo esc_attr($wg->get_field_id($id_field)); ?>"><?php esc_html_e($title, 'wpshare247'); ?></label>
            <?php 
                $url_img = isset($instance[$id_field]) ? $instance[$id_field] : '';
                if($url_img){
                    $id_attachment = attachment_url_to_postid($url_img);
                    $arr_thumb_url = wp_get_attachment_image_src($id_attachment, 'thumbnail');
                ?>
                    <span id="div_<?php echo $id; ?>" class="wle_widget_media">
                    	<a class="nremove" onClick="wle_widget_media_remove(this,'<?php echo esc_attr($wg->get_field_id($id_field)); ?>');"><span class="dashicons dashicons-no-alt"></span></a>
                        <img src="<?php echo $arr_thumb_url[0]; ?>">
                    </span>
                <?php
                }
            ?>
                
            <input style="display:none;" class="widefat url-hide" type="text" value="<?php echo esc_attr($instance[$id_field]); ?>" name="<?php echo esc_attr($wg->get_field_name($id_field)); ?>" id="<?php echo esc_attr($wg->get_field_id($id_field)); ?>" />
            <br/>
            <button id="<?php echo $id; ?>" data-input='<?php echo esc_attr($wg->get_field_id($id_field)); ?>' class="button w366_click_img">Chọn hình</button>
            <script>
                initClickMedia('<?php echo $id; ?>');
            </script>
        </p>
        <?php
		}
		
		static function helper_gallery_field($id_field, $title, $wg, $instance){ 
			$id = 'w366_click_img_'.uniqid();
		?>
        <p>
            <label for="<?php echo esc_attr($wg->get_field_id($id_field)); ?>"><?php esc_html_e($title, 'wpshare247'); ?> (Kéo thả sắp xếp lại thứ tự)</label> 
            <?php 
			 $arr_val = isset($instance[$id_field]) ? $instance[$id_field] : '';
			 $arr_val = json_decode($arr_val, true);
			 if($arr_val){
				 echo '<ul id="div_'.$id.'" class="wle_widget_media wpshare247-gallery wle-sortable">';
				foreach($arr_val as $key => $id_attachment){
					 $arr_thumb_url = wp_get_attachment_image_src($id_attachment, 'thumbnail');
					 echo '<li data-id="'.$id_attachment.'" class="sortable-item">
					 			<a href="#" class="remove nremove" onclick="wle_gallery_remove_me(this); return false;"><span class="dashicons dashicons-no-alt"></span></a>
								<img src="'.$arr_thumb_url[0].'">
							</li>';
				}
				echo '</ul>';
			}
			?>
            <input style="display:none;" class="widefat url-hide" type="text" value="<?php echo esc_attr($instance[$id_field]); ?>" name="<?php echo esc_attr($wg->get_field_name($id_field)); ?>" id="<?php echo esc_attr($wg->get_field_id($id_field)); ?>" />
            <br/>
            <button id="<?php echo $id; ?>" data-input='<?php echo esc_attr($wg->get_field_id($id_field)); ?>' class="button w366_click_img">Chọn hình</button>
            <script>
                initClickGallery('<?php echo $id; ?>');
				wle_init_gallery_sortable();
            </script>
        </p>
        <?php
		}
		
		static function helper_color_picker_field($id_field, $title, $wg, $instance){ 
		?>
        <p>
        	<label for="<?php echo esc_attr($wg->get_field_id($id_field)); ?>"><?php esc_html_e($title, 'wpshare247'); ?></label><br>
			<input class="widefat colorpicker" type="text" value="<?php echo esc_attr($instance[$id_field]); ?>" name="<?php echo esc_attr($wg->get_field_name($id_field)); ?>" id="<?php echo esc_attr($wg->get_field_id($id_field)); ?>" />
        </p>
        	<script>
            	jQuery(document).ready(function($){
					jQuery('.colorpicker').wpColorPicker({
						change: function(event, ui){
							 jQuery("#widgets-right").find("input.widget-control-save").removeAttr('disabled');
						},
						clear: function(event, ui){
							 jQuery("#widgets-right").find("input.widget-control-save").removeAttr('disabled');
						}
					});
				});
            </script>
        <?php
		}
		
		static function helper_datepicker_field($id_field, $title, $wg, $instance, $format = 'dd/mm/yy'){ 
		?>
        <p>
        	<label for="<?php echo esc_attr($wg->get_field_id($id_field)); ?>"><?php esc_html_e($title, 'wpshare247'); ?></label><br>
			<input class="widefat datepicker" type="text" value="<?php echo esc_attr($instance[$id_field]); ?>" name="<?php echo esc_attr($wg->get_field_name($id_field)); ?>" id="<?php echo esc_attr($wg->get_field_id($id_field)); ?>" />
        	<script>
            	jQuery(document).ready(function($){
					jQuery('.datepicker').datepicker({ dateFormat: '<?php echo $format;?>' });
				});
            </script>
        </p>
        <?php
		}
		
		static function helper_autocomplete_field($id_field, $title, $wg, $instance, $post_type = 'page'){ 
			if(!$post_type) $post_type = 'page';
			
			$pid = $instance[$id_field];
		?>
        <p style="position:relative;">
        	<label for="<?php echo esc_attr($wg->get_field_id($id_field)); ?>"><?php esc_html_e($title, 'wpshare247'); ?></label><br>
            <input value="<?php echo get_the_title($pid); ?>" rel="<?php echo esc_attr($wg->get_field_id($id_field)); ?>" data-post="<?php echo $post_type;?>" placeholder="Nhập dữ liệu cần tìm" class="widefat wpshare247-autocomplete" type="text"/>
			<input style="display:none;" class="widefat" type="text" value="<?php echo esc_attr($instance[$id_field]); ?>" name="<?php echo esc_attr($wg->get_field_name($id_field)); ?>" id="<?php echo esc_attr($wg->get_field_id($id_field)); ?>" />
        	<?php 
			if($pid){
				$post_edit_url = admin_url('post.php?post='.$pid.'&action=edit');
				if($post_type=='wpcf7_contact_form'){
					$post_edit_url = admin_url('admin.php?page=wpcf7&post='.$pid.'&action=edit');
				}
			?>
            	<a href="<?php echo $post_edit_url;?>" target="_blank"><?php echo get_the_title($pid); ?></a>
            <?php 
			}
			?>
			<script>
            	ws247_init_autocomplete_field();
            </script>
        </p>
        <?php
		}

		static function helper_video_field($id_field, $title, $wg, $instance){ 
			self::helper_file_field('video', $id_field, $title, $wg, $instance);
		}
		
		static function helper_documents_field($id_field, $title, $wg, $instance){
			self::helper_file_field('application', $id_field, $title, $wg, $instance);
		}
		
		static function helper_file_field($type = 'video', $id_field, $title, $wg, $instance){ 
			$id = 'w366_click_file_'.uniqid();
		?>
        <p>
            <label for="<?php echo esc_attr($wg->get_field_id($id_field)); ?>"><?php esc_html_e($title, 'wpshare247'); ?></label>
            <?php 
                $file_url = isset($instance[$id_field]) ? $instance[$id_field] : '';
                if($file_url){
					$id_attachment = attachment_url_to_postid($file_url);
					$filename = basename ( get_attached_file( $id_attachment ) );
					$size = size_format ( filesize( get_attached_file( $id_attachment ) ) );
					 
					switch($type){
						case "application":
							$file_html = '<a href="'.$file_url.'" target="_blank">'.  wp_get_attachment_image($id_attachment, '', true) . '<span class="wp247-file-size">'. $filename.'('.$size.')</span></a>';
							break;
						
						default:
							$file_html = '<video class="wpshare247-100" width="100" height="150" preload="metadata" controls><source type="video/mp4" src="'.$file_url.'" /><a href="'.$file_url.'">'.$file_url.'</a></video>';
							break;
					}
                ?>
                    <span id="div_<?php echo $id; ?>" class="wle_widget_media">
                        <a class="nremove" onClick="wle_widget_media_remove(this,'<?php echo esc_attr($wg->get_field_id($id_field)); ?>');"><span class="dashicons dashicons-no-alt"></span></a>
                        <?php echo $file_html;?>
                    </span>
				<?php
                }
            ?>  
            <input style="display:none;" class="widefat url-hide" type="text" value="<?php echo esc_attr($instance[$id_field]); ?>" name="<?php echo esc_attr($wg->get_field_name($id_field)); ?>" id="<?php echo esc_attr($wg->get_field_id($id_field)); ?>" />
            <span style="display:block;">
            <button id="<?php echo $id; ?>" data-input='<?php echo esc_attr($wg->get_field_id($id_field)); ?>' class="button w366_click_img">Tải lên</button>
            </span>
			<script>
                init_Click_file('<?php echo $id; ?>', '<?php echo $type;?>');
            </script>
        </p>
        <?php
		}
	} // End class
	
	new Ws247_M_WG();
}