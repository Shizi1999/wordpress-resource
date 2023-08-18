<?php
if( !class_exists('wpshare247_gallery_field') ):
	class wpshare247_gallery_field extends WP_Widget {
		function __construct() {
			parent::__construct(
				'wpshare247_gallery_field', esc_html_x('* [WP247] Gallery Image field', 'widget name', 'wpshare247'),
				array(
					'classname' => 'wpshare247_image_field',
					'description' => esc_html__('Trường thư viện ảnh của Widget', 'wpshare247'),
					'customize_selective_refresh' => true
				)
			);
		}
		
		//Hiển thị nội dung Widget
		function widget($args, $instance) {
			$defaults = array('title'=>'', 'my_gallery' => '');
			
			$title = $instance['title'];
			$my_gallery = $instance['my_gallery'];
			//$arr_gallery = json_decode($my_gallery, true);
			
			echo $args['before_widget'];
				?>
				<?php echo $args['before_title'] . $title . $args['after_title']; ?>
                <section class="fields-content">
                    <!-- Gallery Image -->
                    <div class="ws247-field">
                    	<?php Ws247_M_WG::the_html_gallery_field($my_gallery, 'thumb_310x310'); ?>
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
			
			if (!empty($new_instance['my_gallery'])) {
				$instance['my_gallery'] = ($new_instance['my_gallery']);
			}
			
			return $instance;
		}
		
		
		//Khai báo các field của Widget
		function form($instance) {
			$defaults = array('title'=>'', 'my_img_url' => '');
			$instance = wp_parse_args($instance, $defaults); ?>
            
            <!-- text field -->
            <p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Text', 'wpshare247'); ?></label>
				<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
			</p>
            
            <!-- Gallery field -->
			<?php Ws247_M_WG::helper_gallery_field('my_gallery', 'Thư viện ảnh', $this, $instance); ?>
			
		<?php
		}
	}
endif;