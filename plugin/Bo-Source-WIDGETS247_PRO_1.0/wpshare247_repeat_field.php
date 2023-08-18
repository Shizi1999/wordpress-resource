<?php
if( !class_exists('wpshare247_repeat_field') ):
	class wpshare247_repeat_field extends WP_Widget {
		function __construct() {
			parent::__construct(
				'wpshare247_repeat_field', esc_html_x('* [WP247] Repeat field', 'widget name', 'wpshare247'),
				array(
					'classname' => 'wpshare247_repeat_field',
					'description' => esc_html__('Trường lặp lại, có thể sắp xếp của Widget', 'wpshare247'),
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
			$defaults = array('title'=>'', 'wle_repeat_sortable_data_1' => '');
			
			$title = $instance['title'];
			$data_field = $instance['wle_repeat_sortable_data_1']; 
			$arr_data = json_decode($data_field,true);
			
			echo $args['before_widget'];
				?>
                <style>
                	.ws247-field{ background:#eaeaea; margin-bottom: 10px; padding:10px; }
                </style>
				<?php echo $args['before_title'] . $title . $args['after_title']; ?>
                <section class="fields-content">
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
			
			if (!empty($new_instance['wle_repeat_sortable_data_1'])) {
				$instance['wle_repeat_sortable_data_1'] = ($new_instance['wle_repeat_sortable_data_1']);
			}
			
			return $instance;
		}
		
		//Khai báo các field của Widget
		function form($instance) {
			$defaults = array('title'=>'', 'wle_repeat_sortable_data_1' => '');
			$instance = wp_parse_args($instance, $defaults); ?>
			
            <!-- text field -->
            <p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Text', 'wpshare247'); ?></label>
				<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
			</p>
            
            <!-- Repeat field -->
            <?php 
			$id_field = 'wle_repeat_sortable_data_1'; 
			wpshare247_repeat_sortable::register_field($id_field, esc_attr($this->get_field_name($id_field)), 'Lặp lại và Sắp xếp thứ tự', $instance, $this->init_repeat_sortable_fields());
			?>
			
		<?php
		}
	}
endif;