<?php
if( !class_exists('wpshare247_repeat_sortable') ){
	class wpshare247_repeat_sortable{
		function __construct() {
			if(is_admin()){
				global $pagenow;
				if($pagenow  === 'widgets.php'){
					add_action( 'admin_head', array( $this, 'repeat_sortable_register_assets' ) );
				}
			}
		}
		
		public function repeat_sortable_register_assets(){
			get_template_part( Ws247_M_WG::get_current_dir().'/widget_helper/widget_register_assets','' );
		}
		
		static function get_arr_field_type(){
			$arr_ = array('text', 'textarea', 'select', 'image', 'page', 'post', 'contact_form_7', 'post_type');
			return $arr_;
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
		
		static function get_post_type_options( $post_type = 'page' ){ 
			$arr_ = self::get_post_types( $post_type );
			$options = array('0' => '--Chọn--');
			if($arr_){
				foreach( $arr_ as $op ){
					$options[$op->ID] = $op->post_title; 
				}
			}
			return $options;
		}
		
		static function get_field_by_key( $key, $arr_fields ){
			return ($arr_fields[$key]) ? $arr_fields[$key] : false;
		}
	
		
		static function the_item_html( $item, $k, $arr_fields ){
			$class = '';
			if($k==0){
				$class = 'default';
			}
		?>
			<li class="sortable-item <?php echo $class; ?>">
				<span class="dashicons dashicons-arrow-up-alt2" title="Thu gọn lại" onClick="hide_this_block(this);"></span>
				<a href="#" class="remove" onClick="wle_repeat_sortable_remove_me(this); return false;"><span class="dashicons dashicons-no-alt"></span></a>
				<?php 
				if($arr_fields){
					foreach($arr_fields as $field_key => $f){
						$type = $f['type']; 
						if( !in_array($type, self::get_arr_field_type()) ) continue;
	
						if(isset($item[$field_key])){
							$arr_f_ = $item[$field_key];
						}else{
							$arr_f_ = $f;
						}
						
						switch( $type ){
							case "textarea":
								self::the_textarea_field($field_key, $arr_f_); 
								break;
							
							case "select":
								self::the_select_field($field_key, $arr_f_, $arr_fields); 
								break;
							
							case "page":
								$post_type = 'page';
								self::the_post_type_field($field_key, $arr_f_, $post_type); 
								break;
							
							case "post":
								$post_type = 'post';
								self::the_post_type_field($field_key, $arr_f_, $post_type); 
								break;
							
							case "contact_form_7":
								$post_type = 'wpcf7_contact_form';
								self::the_post_type_field($field_key, $arr_f_, $post_type); 
								break;
								
							case "post_type":
								$post_type = isset($f['post_type']) ? $f['post_type'] : 'page';
								self::the_post_type_field($field_key, $arr_f_, $post_type); 
								break;
								
							case "image":
								self::the_image_field($field_key, $arr_f_); 
								break;
							
							default:
								self::the_text_field($field_key, $arr_f_);	
								break;
						}
					}
				}
				?>
			</li>
		<?php
		}
		
		static function the_text_field($field_name, $arr_data){
			$val = isset($arr_data['val']) ? $arr_data['val'] : '';
			$label = isset($arr_data['label']) ? $arr_data['label'] : '';
		?>
			<p>
				<label for=""><?php esc_html_e($label, 'wpshare247'); ?></label>
				<input data-type="text" data-label="<?php echo $label;?>" value="<?php echo $val;?>" onkeyup="wle_repeat_sortable_update_data(this);" name="<?php echo $field_name; ?>" class="widefat reset_data f_save_data" type="text"/>
			</p>
		<?php
		}
		
		static function the_textarea_field($field_name, $arr_data){
			$val = isset($arr_data['val']) ? $arr_data['val'] : '';
			$label = isset($arr_data['label']) ? $arr_data['label'] : '';
		?>
			<p>
				<label for=""><?php esc_html_e($label, 'wpshare247'); ?></label>
				<textarea data-type="textarea" data-label="<?php echo $label;?>" onkeyup="wle_repeat_sortable_update_data(this);" name="<?php echo $field_name; ?>" class="widefat reset_data f_save_data"><?php echo $val;?></textarea>
			</p>
		<?php
		}
		
		static function the_select_field($field_name, $arr_data, $arr_fields){
			$val = isset($arr_data['val']) ? $arr_data['val'] : '';
			$label = isset($arr_data['label']) ? $arr_data['label'] : '';
			
			$select_field = self::get_field_by_key($field_name, $arr_fields); 
			$options = $select_field['options'];
		?>
			<p>
				<label for=""><?php esc_html_e($label, 'wpshare247'); ?></label>
				<select onChange="wle_repeat_sortable_update_data(this);" data-type="select" data-label="<?php echo $label;?>" name="<?php echo $field_name; ?>" class="reset_data f_save_data">
					<?php 
					if($options){
						foreach( $options as $v => $text ){
						?>
							<option <?php if($val==$v) echo 'selected'; ?> value="<?php echo $v;?>"><?php echo $text;?></option>
						<?php
						}
					}
					?>
				</select>
			</p>
		<?php
		}
		
		static function the_post_type_field($field_name, $arr_data, $post_type){
			$val = isset($arr_data['val']) ? $arr_data['val'] : '';
			$label = isset($arr_data['label']) ? $arr_data['label'] : '';
			$options = self::get_post_type_options( $post_type );
		?>
			<p>
				<label for=""><?php esc_html_e($label, 'wpshare247'); ?></label>
				<select onChange="wle_repeat_sortable_update_data(this);" data-type="select" data-label="<?php echo $label;?>" name="<?php echo $field_name; ?>" class="reset_data f_save_data">
					<?php 
					if($options){
						foreach( $options as $v => $text ){
						?>
							<option <?php if($val==$v) echo 'selected'; ?> value="<?php echo $v;?>"><?php echo $text;?></option>
						<?php
						}
					}
					?>
				</select>
			</p>
		<?php
		}
		
		static function the_image_field($field_name, $arr_data){
			$val = isset($arr_data['val']) ? $arr_data['val'] : '';
			$label = isset($arr_data['label']) ? $arr_data['label'] : '';
			
			$input_id = uniqid($field_name);
			$btn_id = uniqid($field_name);
		?>
			<p>
				<label for=""><?php esc_html_e($label, 'wpshare247'); ?></label><br/>
				<?php 
				if($val){
					$url_img = $val;
					$id_attachment = attachment_url_to_postid($url_img);
					$arr_thumb_url = wp_get_attachment_image_src($id_attachment, 'thumbnail');
					?>
					<span id="div_<?php echo $btn_id; ?>" class="repeat-image-container">
						<img src="<?php echo $arr_thumb_url[0]; ?>">
					</span>
					<?php
				}
				?>
				<input id="<?php echo $input_id;?>" data-type="image" data-label="<?php echo $label;?>" value="<?php echo $val;?>" name="<?php echo $field_name; ?>" class="reset_data f_save_data" type="hidden"/>
				<button type="button" onClick="wle_init_repeat_click_media(this);" id="<?php echo $btn_id; ?>" data-input='<?php echo $input_id;?>' class="button btn_image">Chọn hình</button>
			</p>
		<?php
		}
		
		static function register_field($id_field, $esc_attr_field, $title, $instance, $arr_fields){
		?>
		<div class="big_container_block">
			<?php 
			if($title){
			?>
			<label><?php echo $title;?></label>
			<?php 
			}
			?>
			<?php 
			$data_field = isset($instance[$id_field]) ? $instance[$id_field] : '';
			$arr_data = array();
			if($data_field){
				$arr_data = json_decode($data_field,true);
			}
			?>
			<textarea 	style="display:none"
						class="widefat repeat_sortable_data" 
						name="<?php echo $esc_attr_field; ?>" 
						id="<?php echo $esc_attr_field; ?>"><?php echo $data_field; ?></textarea>
			
			<ul class="wle-sortable repeat-sortable-container">
				<?php 
				if($arr_data){
					foreach($arr_data as $k=>$item){
						self::the_item_html( $item, $k, $arr_fields);
					}
				}else{
					self::the_item_html( NULL, 0, $arr_fields);
				}
				?>
			</ul>
			
			<button type="button" onClick="wle_repeat_sortable_add_new(this);" class="button repeat_sortable_add_new">Thêm mới</button>
			<script> wle_init_repeat_sortable();</script>
		</div>
		<?php
		}
	}
	
	new wpshare247_repeat_sortable();
}