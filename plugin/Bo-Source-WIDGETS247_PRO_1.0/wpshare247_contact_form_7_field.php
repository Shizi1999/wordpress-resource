<?php
if( !class_exists('wpshare247_contact_form_7_field') ):
	class wpshare247_contact_form_7_field extends WP_Widget {
		function __construct() {
			parent::__construct(
				'wpshare247_contact_form_7_field', esc_html_x('* [WP247] Contact form 7 field', 'widget name', 'wpshare247'),
				array(
					'classname' => 'wpshare247_contact_form_7_field',
					'description' => esc_html__('Trường Contact form 7 liên hệ của Widget', 'wpshare247'),
					'customize_selective_refresh' => true
				)
			);
		}
		
		//Hiển thị nội dung Widget
		function widget($args, $instance) {
			$defaults = array('title'=>'', 'contact_form_id' => '');
			
			$title = $instance['title'];
			$contact_form_id = $instance['contact_form_id'];
			
			echo $args['before_widget'];
				?>
                <style>
                	.ws247-field{ background:#eaeaea; margin-bottom: 10px; padding:10px; }
                </style>
				<?php echo $args['before_title'] . $title . $args['after_title']; ?>
                <section class="fields-content">
                    <!-- Contact form 7 -->
                    <div class="ws247-field">
                    	<?php 
						if($contact_form_id){
							echo do_shortcode('[contact-form-7 id="'.$contact_form_id.'" title="Form liên hệ"]');
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
			
			if (!empty($new_instance['contact_form_id'])) {
				$instance['contact_form_id'] = ($new_instance['contact_form_id']);
			}
			
			return $instance;
		}
		
		
		//Khai báo các field của Widget
		function form($instance) {
			$defaults = array('title'=>'', 'contact_form_id' => '');
			$instance = wp_parse_args($instance, $defaults); ?>
            
            <!-- text field -->
            <p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Text', 'wpshare247'); ?></label>
				<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
			</p>
            
            <!-- Contact Form 7 field -->
			<?php Ws247_M_WG::helper_contact_form7_field('contact_form_id', 'Form liên hệ', $this, $instance); ?>
			
		<?php
		}
	}
endif;