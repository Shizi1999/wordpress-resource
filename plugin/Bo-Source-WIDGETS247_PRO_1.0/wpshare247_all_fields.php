<?php
if( !class_exists('wpshare247_all_fields') ):
	class wpshare247_all_fields extends WP_Widget {
		function __construct() {
			parent::__construct(
				'wpshare247_all_fields', esc_html_x('* [WP247] All fields', 'widget name', 'wpshare247'),
				array(
					'classname' => 'wpshare247-all-fields',
					'description' => esc_html__('Các trường thông dụng của Widget', 'wpshare247'),
					'customize_selective_refresh' => true
				)
			);
		}
		
		//Chỉ cần khai báo các field tại đây và không cần làm gì thêm----------------------------------------
		function init_repeat_sortable_fields(){
			$arr_fields = array(
				'f_repeat_text1' => array('type'=>'text', 'label' => 'Kiểu text 1'),
				'f_repeat_image' => array('type'=>'image', 'label' => 'Kiểu hình'),
				'f_repeat_text2' => array('type'=>'text', 'label' => 'Kiểu text 2'),
				'f_repeat_textarea' => array('type'=>'textarea', 'label' => 'Kiểu textarea'),
				
				'f_repeat_select' => array( 'type'=>'select', 
											'label' => 'Kiểu chọn',
											'options' => array('asc' => 'Tăng', 'desc' => 'Giảm', 'random' => 'Ngẫu nhiên', '10' => 'Cách 10 ngày')
										),
				
				'f_repeat_select_page_id' => array( 'type'=>'page', 
													'label' => 'Trang'),
				
				'f_repeat_select_post_id' => array( 'type'=>'post', 
													'label' => 'Bài viết'),
																				
				'f_repeat_select_cf7' => array( 'type'=>'contact_form_7', 
												'label' => 'Contact form 7'),
										
				'f_repeat_select_custom_post_type_id' => array( 'type'=>'post_type', 
																'post_type' => 'your-post-type',
																'label' => 'Your custom post type'),
												
				
			);
			return $arr_fields;
		}
		//End Chỉ cần khai báo các field tại đây và không cần làm gì thêm----------------------------------------
		
		//Hiển thị nội dung Widget
		function widget($args, $instance) {
			$defaults = array('title' => '', 'description' => '', 'select_field' => '', 'ws247_checkbox_field' => '',
								'checkbox_list' => '', 'ws247_radio_field' => '', 'wpshare247_text' => '', 'wpshare247_textarea' =>'',
								'my_img_url' => '', 'background_color' => '', 'contact_form_id' => '', 'page_id'=>'', 'post_id'=>'',
								'product_id'=>'', 'your_custom_post_id'=>'', 'menu_id'=>'', 'wle_repeat_sortable_data_1'=>'');
			
			$title = $instance['title'];
			$description = $instance['description'];
			$select_field = $instance['select_field'];
			$ws247_checkbox_field = $instance['ws247_checkbox_field'];
			$checkbox_list = $instance['checkbox_list'];
			$ws247_radio_field = $instance['ws247_radio_field'];
			$wpshare247_text = $instance['wpshare247_text'];
			$wpshare247_textarea = $instance['wpshare247_textarea'];
			$my_img_url = $instance['my_img_url'];
			$background_color = $instance['background_color'];
			$contact_form_id = $instance['contact_form_id'];
			$page_id = $instance['page_id'];
			$post_id = $instance['post_id'];
			$product_id = $instance['product_id'];
			$your_custom_post_id = $instance['your_custom_post_id'];
			$menu_id = $instance['menu_id'];
			
			$data_field = $instance['wle_repeat_sortable_data_1']; 
			$arr_data = json_decode($data_field,true);
			
			$my_gallery = $instance['my_gallery'];
			
			$my_autocomplete_post_id = $instance['my_autocomplete'];
			
			echo $args['before_widget'];
				?>
                <style>
                	.ws247-field{ background:#eaeaea; margin-bottom: 10px; padding:10px; }
                </style>
				<?php echo $args['before_title'] . $title . $args['after_title']; ?>
                <section class="fields-content">
                	<!-- textarea -->
                    <div class="ws247-field">
                    	<?php echo apply_filters('the_content', $description); ?>
                    </div>
                    
                    <!-- select -->
                    <div class="ws247-field">
                    	<?php echo $select_field; ?>
                    </div>
                    
                    <!-- checkbox -->
                    <div class="ws247-field">
                    	<?php echo ($ws247_checkbox_field=='on') ? 'Đang check' : 'Bỏ check'; ?>
                    </div>
                    
                    <!-- checkbox_list -->
                    <div class="ws247-field">
                    	<p>Danh sách</p>
                    	<ul>
                    	<?php 
						if($checkbox_list){
							foreach($checkbox_list as $val){
								echo '<li>'.$val.'</li>';
							}
						} ?>
                        </ul>
                    </div>
                    
                    <!-- radio -->
                    <div class="ws247-field">
                    	<?php echo ($ws247_radio_field); ?>
                    </div>
                    
                    <!-- Quick text -->
                    <div class="ws247-field">
                    	<?php echo $wpshare247_text; ?>
                    </div>
                    
                    <!-- Quick textarea -->
                    <div class="ws247-field">
                    	<?php echo apply_filters('the_content', $wpshare247_textarea); ?>
                    </div>
                    
                    <!-- Image -->
                    <div class="ws247-field">
                    	<?php 
						if($my_img_url){
						?>
                        <img src="<?php echo $my_img_url;?>" alt="wpshare247 img" />
                        <?php 
						}
						?>
                    </div>
                    
                    <!-- Color -->
                    <div class="ws247-field">
                    	<div style="background-color:<?php echo $background_color;?>">Đây là color picker</div>
                    </div>
                    
                    <!-- Contact form 7 -->
                    <div class="ws247-field">
                    	<?php 
						if($contact_form_id){
							echo do_shortcode('[contact-form-7 id="'.$contact_form_id.'" title="Form liên hệ"]');
						}
						?>
                    </div>
                    
                    <!-- page_id -->
                    <div class="ws247-field">
                    	<?php 
						if($page_id){
							$content = apply_filters('the_content', get_post_field('post_content', $page_id));
							echo $content;
						}
						?>
                    </div>
 
                    <!-- post_id -->
                    <div class="ws247-field">
                    	<?php 
						if($post_id){
							$content = apply_filters('the_content', get_post_field('post_content', $post_id));
							echo $content;
						}
						?>
                    </div>
                    
                    <!-- product_id -->
                    <div class="ws247-field">
                    	<?php 
						if($product_id){
							if(class_exists( 'WooCommerce' )){
								$_product = wc_get_product( $product_id );
								echo $_product->get_price_html();
							}
						}
						?>
                    </div>
                    
                    <!-- your_custom_post_id -->
                    <div class="ws247-field">
                    	<?php 
						if($your_custom_post_id){
							$content = apply_filters('the_content', get_post_field('post_content', $your_custom_post_id));
							echo $content;
						}
						?>
                    </div>
                    
                    <!-- Navigation Menu -->
                    <div class="ws247-field">
                    	<?php 
						if($menu_id){
							wp_nav_menu( array( 'menu' => $menu_id ) );
						}
						?>
                    </div>
                    
                    <!-- Ws247 Repeat Field -->
                    <div class="ws247-field">
                    	<?php 
						if($arr_data){
							echo '<ul>';
							foreach($arr_data as $k => $arr_item){ 
								$f_repeat_text1 = $arr_item['f_repeat_text1']['val'];
								$f_repeat_image_url = $arr_item['f_repeat_image']['val'];
								$f_repeat_text2 = $arr_item['f_repeat_text2']['val'];
								$f_repeat_textarea = $arr_item['f_repeat_textarea']['val'];
								$f_repeat_select = $arr_item['f_repeat_select']['val'];
								$f_repeat_select_cf7_id = $arr_item['f_repeat_select_cf7']['val'];
						?>
                        		<li>
                                	<p><?php echo $f_repeat_text1;?></p>
                                    <?php 
									if($f_repeat_image_url){
									?>
                                    <p><img src="<?php echo $f_repeat_image_url;?>" alt="img repeat field" /></p>
                                    <?php 
									}
									?>
                                    <p><?php echo $f_repeat_text2;?></p>
                                    <p><?php echo apply_filters('the_content', $f_repeat_textarea); ?></p>
                                    <p><?php echo $f_repeat_select;?></p>
                                    <p><?php echo $f_repeat_select_cf7_id;?></p>
                                </li>
                        <?php
							}
							echo '</ul>';
						}
						?>
                    </div>
                    
                    <!-- Ws247 Gallery Field -->
                    <div class="ws247-field">
                    	<?php Ws247_M_WG::the_html_gallery_field($my_gallery); ?>
                    </div>
                    
                    <!-- Ws247 Gallery Field -->
                    <div class="ws247-field">
                    	<div>Post ID: <?php echo $my_autocomplete_post_id;?></div>
                    </div>
                    
                </section>
				<?php
			echo $args['after_widget'];
		}
		
		//Cập nhật dữ liệu các field của Widget
		function update($new_instance, $old_instance) {
			$instance = array();
			if (!empty($new_instance['title'])) {
				$instance['title'] = ($new_instance['title']);
			}
			
			if (!empty($new_instance['description'])) {
				$instance['description'] = ($new_instance['description']);
			}
			
			if (!empty($new_instance['select_field'])) {
				$instance['select_field'] = ($new_instance['select_field']);
			}
			
			if (!empty($new_instance['ws247_checkbox_field'])) {
				$instance['ws247_checkbox_field'] = ($new_instance['ws247_checkbox_field']);
			}
			
			if (!empty($new_instance['checkbox_list'])) {
				$instance['checkbox_list'] = ($new_instance['checkbox_list']);
			}
			
			if (!empty($new_instance['ws247_radio_field'])) {
				$instance['ws247_radio_field'] = ($new_instance['ws247_radio_field']);
			}
			
			if (!empty($new_instance['wpshare247_text'])) {
				$instance['wpshare247_text'] = ($new_instance['wpshare247_text']);
			}
			
			if (!empty($new_instance['wpshare247_textarea'])) {
				$instance['wpshare247_textarea'] = ($new_instance['wpshare247_textarea']);
			}
			
			if (!empty($new_instance['my_img_url'])) {
				$instance['my_img_url'] = ($new_instance['my_img_url']);
			}
			
			if (!empty($new_instance['background_color'])) {
				$instance['background_color'] = ($new_instance['background_color']);
			}
			
			if (!empty($new_instance['contact_form_id'])) {
				$instance['contact_form_id'] = ($new_instance['contact_form_id']);
			}
			
			if (!empty($new_instance['page_id'])) {
				$instance['page_id'] = ($new_instance['page_id']);
			}
			
			if (!empty($new_instance['post_id'])) {
				$instance['post_id'] = ($new_instance['post_id']);
			}
			
			if (!empty($new_instance['product_id'])) {
				$instance['product_id'] = ($new_instance['product_id']);
			}
			
			if (!empty($new_instance['your_custom_post_id'])) {
				$instance['your_custom_post_id'] = ($new_instance['your_custom_post_id']);
			}
			
			if (!empty($new_instance['menu_id'])) {
				$instance['menu_id'] = ($new_instance['menu_id']);
			}
			
			if (!empty($new_instance['wle_repeat_sortable_data_1'])) {
				$instance['wle_repeat_sortable_data_1'] = ($new_instance['wle_repeat_sortable_data_1']);
			}
			
			if (!empty($new_instance['my_datepicker'])) {
				$instance['my_datepicker'] = ($new_instance['my_datepicker']);
			}
			
			if (!empty($new_instance['my_gallery'])) {
				$instance['my_gallery'] = ($new_instance['my_gallery']);
			}
			
			if (!empty($new_instance['my_autocomplete'])) {
				$instance['my_gallery'] = ($new_instance['my_autocomplete']);
			}
			
			
			return $instance;
		}
		
		
		//Khai báo các field của Widget
		function form($instance) {
			$defaults = array('title' => '', 'description' => '', 'select_field' => '', 'ws247_checkbox_field' => '',
								'checkbox_list' => '', 'ws247_radio_field' => '', 'wpshare247_text' => '', 'wpshare247_textarea' =>'',
								'my_img_url' => '', 'background_color' => '', 'contact_form_id' => '', 'page_id'=>'', 'post_id'=>'',
								'product_id'=>'', 'your_custom_post_id'=>'', 'menu_id'=>'', 'wle_repeat_sortable_data_1'=>''
								);
			$instance = wp_parse_args($instance, $defaults); ?>
			
            <!-- text field -->
            <p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Text', 'wpshare247'); ?></label>
				<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
			</p>
            
            <!-- textarea field -->
            <p>
				<label for="<?php echo esc_attr($this->get_field_id('description')); ?>"><?php esc_html_e('Textarea', 'wpshare247'); ?></label>
				<textarea name="<?php echo esc_attr($this->get_field_name('description')); ?>" id="<?php echo esc_attr($this->get_field_id('description')); ?>" class="widefat"><?php echo esc_attr($instance['description']); ?></textarea>
			</p>

            <!-- select field -->
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('select_field')); ?>"><?php esc_html_e('Select box', 'wpshare247'); ?></label>
                <select id="<?php echo esc_attr($this->get_field_id('select_field')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('select_field')); ?>">
                    <option value="" <?php selected("", $instance['select_field']); ?>><?php esc_html_e('--Chọn--', 'wpshare247'); ?></option>
  					<option value="asc" <?php selected("asc", $instance['select_field']); ?>><?php esc_html_e('Tăng', 'wpshare247'); ?></option>
                    <option value="desc" <?php selected("desc", $instance['select_field']); ?>><?php esc_html_e('Giảm', 'wpshare247'); ?></option>
                </select>
            </p>
            
            <!-- Checkbox field -->
            <p>
            	<input class="checkbox" type="checkbox" <?php checked( $instance[ 'ws247_checkbox_field' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'ws247_checkbox_field' ); ?>" name="<?php echo $this->get_field_name( 'ws247_checkbox_field' ); ?>" /> 
                <label for="<?php echo $this->get_field_id( 'ws247_checkbox_field' ); ?>"><?php esc_html_e('Checkbox'); ?></label>
            </p>
            
            <!-- Checkbox list field -->
            <?php $arr_checkbox_list = array('vn' => 'Checkbox 1', 'tl' => 'Checkbox 2', 'ml' => 'Checkbox 3', 'id' => 'Checkbox 4'); ?>
            <p>
        		<label for="<?php echo esc_attr($this->get_field_id('checkbox_list')); ?>"><?php esc_html_e('Checkbox List', 'wpshare247'); ?></label>
                <ul>
                <?php 
					$arr_checkbox_list_data = ($instance["checkbox_list"]) ? $instance["checkbox_list"] : array();
                    if($arr_checkbox_list):
                        foreach($arr_checkbox_list as $key => $val): 
                        ?>
                            <li>
                                <input class="checkbox" id="<?php echo $this->get_field_id("checkbox_list") . $key; ?>" name="<?php echo $this->get_field_name("checkbox_list"); ?>[]" type="checkbox" value="<?php echo $key; ?>" <?php checked("1", in_array($key, $arr_checkbox_list_data)); ?> /> 		
                                <label for="<?php echo $this->get_field_id("checkbox_list") . $key; ?>"><?php echo $val; ?></label>
                            </li>
                <?php
                        endforeach;
                    endif;
                ?>
                </ul>
            </p>
            
            <!-- Radio field -->
             <p>
             	<label for="<?php echo esc_attr($this->get_field_id('ws247_radio_field')); ?>"><?php esc_html_e('Radio', 'wpshare247'); ?></label>
             	<ul>
                	<li>
                    	<input class="checkbox" type="radio" id="<?php echo $this->get_field_id( 'ws247_radio_field' ); ?>" name="<?php echo $this->get_field_name( 'ws247_radio_field' ); ?>" value="nam" <?php checked( $instance[ 'ws247_radio_field' ], 'nam' ); ?> /> 
                		<label for="<?php echo $this->get_field_id( 'ws247_radio_field' ); ?>"><?php esc_html_e('Nam'); ?></label>
                    </li>
                    <li>
                    	<input class="checkbox" type="radio" id="<?php echo $this->get_field_id( 'ws247_radio_field_2' ); ?>" name="<?php echo $this->get_field_name( 'ws247_radio_field' ); ?>" value="nu" <?php checked( $instance[ 'ws247_radio_field' ], 'nu' ); ?> /> 
                		<label for="<?php echo $this->get_field_id( 'ws247_radio_field_2' ); ?>"><?php esc_html_e('Nữ'); ?></label>
                    </li>
                </ul>
            </p>
            
            <!-- text field -->
            <?php Ws247_M_WG::helper_text_field('wpshare247_text', 'Quick Text', $this, $instance); ?>
            
             <!-- textarea field -->
			<?php Ws247_M_WG::helper_textarea_field('wpshare247_textarea', 'Quick Textarea', $this, $instance); ?>
            
            <!-- Image field -->
			<?php Ws247_M_WG::helper_image_field('my_img_url', 'Image', $this, $instance); ?>
            
            <!-- Color field -->
			<?php Ws247_M_WG::helper_color_picker_field('background_color', 'Color', $this, $instance); ?>
            
            <!-- Contact Form 7 field -->
			<?php Ws247_M_WG::helper_contact_form7_field('contact_form_id', 'Form liên hệ', $this, $instance); ?>
            
            <!-- Page id field -->
			<?php Ws247_M_WG::helper_page_field('page_id', 'Trang', $this, $instance); ?>
            
            <!-- Post id field -->
			<?php Ws247_M_WG::helper_post_field('post_id', 'Bài viết', $this, $instance); ?>
            
            <!-- Product id field -->
			<?php Ws247_M_WG::helper_product_field('product_id', 'Sản phẩm WooCommerce', $this, $instance); ?>
            
            <!-- Custom Posttype id field -->
			<?php Ws247_M_WG::helper_post_type_field('your_custom_post_id', 'Your custom post type', $this, $instance, 'your-custom-post'); ?>
            
            <!-- Menu field -->
			<?php Ws247_M_WG::helper_wp_nav_field('menu_id', 'Menu', $this, $instance); ?>
            
            <!-- Repeat field -->
            <?php 
			$id_field = 'wle_repeat_sortable_data_1'; 
			wpshare247_repeat_sortable::register_field($id_field, esc_attr($this->get_field_name($id_field)), 'Lặp lại và Sắp xếp thứ tự', $instance, $this->init_repeat_sortable_fields());
			?>
            
            <!-- Datepicker field -->
			<?php 
			$format = 'yy-mm-dd'; // dd/mm/yy ; dd-mm-yy default => dd/mm/yy
			Ws247_M_WG::helper_datepicker_field('my_datepicker', 'Ngày:', $this, $instance, $format); 
			?>
            
            <!-- Gallery field -->
			<?php Ws247_M_WG::helper_gallery_field('my_gallery', 'Thư viện ảnh', $this, $instance); ?>
            
            <!-- Autocomplete field -->
			<?php 
			$post_type = 'page'; // {page, post, proudct, wpcf7_contact_form or custom post type}
			Ws247_M_WG::helper_autocomplete_field('my_autocomplete', 'Trang liên hệ:', $this, $instance, $post_type); 
			?>
			
		<?php
		}
	}
endif;