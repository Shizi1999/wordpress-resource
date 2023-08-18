<?php
if( !class_exists('wpshare247_image_field') ):
	class wpshare247_image_field extends WP_Widget {
		function __construct() {
			parent::__construct(
				'wpshare247_image_field', esc_html_x('* [WP247] Image field', 'widget name', 'wpshare247'),
				array(
					'classname' => 'wpshare247_image_field',
					'description' => esc_html__('Trường hình ảnh của Widget', 'wpshare247'),
					'customize_selective_refresh' => true
				)
			);
		}
		
		//Hiển thị nội dung Widget
		function widget($args, $instance) {
			$defaults = array('title'=>'', 'my_img_url' => '');
			
			$title = $instance['title'];
			$my_img_url = $instance['my_img_url'];
			
			echo $args['before_widget'];
				?>
                <style>
                	.ws247-field{ background:#eaeaea; margin-bottom: 10px; padding:10px; }
                </style>
				<?php echo $args['before_title'] . $title . $args['after_title']; ?>
                <section class="fields-content">
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
			
			if (!empty($new_instance['my_img_url'])) {
				$instance['my_img_url'] = ($new_instance['my_img_url']);
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
            
            <!-- Image field -->
			<?php Ws247_M_WG::helper_image_field('my_img_url', 'Image', $this, $instance); ?>
			
		<?php
		}
	}
endif;