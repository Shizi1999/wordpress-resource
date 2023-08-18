<?php
if( !class_exists('wpshare247_autocomplete_field') ):
	class wpshare247_autocomplete_field extends WP_Widget {
		function __construct() {
			parent::__construct(
				'wpshare247_autocomplete_field', esc_html_x('* [WP247] Autocomplete field', 'widget name', 'wpshare247'),
				array(
					'classname' => 'wpshare247_autocomplete_field',
					'description' => esc_html__('Trường tự động load dữ liệu của Widget', 'wpshare247'),
					'customize_selective_refresh' => true
				)
			);
		}
		
		//Hiển thị nội dung Widget
		function widget($args, $instance) {
			$defaults = array('title'=>'', 'background_color' => '');
			
			$title = $instance['title'];
			$post_id = $instance['my_autocomplete'];
			
			echo $args['before_widget'];
				?>
				<?php echo $args['before_title'] . $title . $args['after_title']; ?>
                <!-- Color -->
                <div class="ws247-field">
                    <div>Post ID: <?php echo $post_id;?></div>
                </div>
				<?php
			echo $args['after_widget'];
		}
		
		//Cập nhật dữ liệu các field của Widget
		function update($new_instance, $old_instance) {
			$instance = array();
			
			if (!empty($new_instance['title'])) {
				$instance['title'] = ($new_instance['title']);
			}
			
			if (!empty($new_instance['my_autocomplete'])) {
				$instance['my_autocomplete'] = ($new_instance['my_autocomplete']);
			}
			
			return $instance;
		}
		
		
		//Khai báo các field của Widget
		function form($instance) {
			$defaults = array('title'=>'', 'my_autocomplete' => '');
			$instance = wp_parse_args($instance, $defaults); ?>
            
            <!-- text field -->
            <p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Text', 'wpshare247'); ?></label>
				<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
			</p>
            
            <!-- Autocomplete field -->
			<?php 
			$post_type = 'page'; // {page, post, proudct, wpcf7_contact_form or custom post type}
			Ws247_M_WG::helper_autocomplete_field('my_autocomplete', 'Trang liên hệ:', $this, $instance, $post_type); 
			?>
			
		<?php
		}
	}
endif;