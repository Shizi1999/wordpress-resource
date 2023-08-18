<?php
if( !class_exists('wpshare247_basic_fields') ):
	class wpshare247_basic_fields extends WP_Widget {
		function __construct() {
			parent::__construct(
				'wpshare247_basic_fields', esc_html_x('* [WP247] Basic fields', 'widget name', 'wpshare247'),
				array(
					'classname' => 'wpshare247_basic_fields',
					'description' => esc_html__('Các trường cơ bản của Widget', 'wpshare247'),
					'customize_selective_refresh' => true
				)
			);
		}
		
		//Hiển thị nội dung Widget
		function widget($args, $instance) {
			$defaults = array('title' => '', 'description' => '', 'select_field' => '', 'ws247_checkbox_field' => '',
								'checkbox_list' => '', 'ws247_radio_field' => '');
			
			$title = $instance['title'];
			$description = $instance['description'];
			$select_field = $instance['select_field'];
			$ws247_checkbox_field = $instance['ws247_checkbox_field'];
			$checkbox_list = $instance['checkbox_list'];
			$ws247_radio_field = $instance['ws247_radio_field'];
			
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
			
			return $instance;
		}
		
		//Khai báo các field của Widget
		function form($instance) {
			$defaults = array('title' => '', 'description' => '', 'select_field' => '', 'ws247_checkbox_field' => '',
								'checkbox_list' => '', 'ws247_radio_field' => '');
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
			
		<?php
		}
	}
endif;