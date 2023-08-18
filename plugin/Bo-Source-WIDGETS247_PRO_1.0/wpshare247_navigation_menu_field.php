<?php
if( !class_exists('wpshare247_navigation_menu_field') ):
	class wpshare247_navigation_menu_field extends WP_Widget {
		function __construct() {
			parent::__construct(
				'wpshare247_navigation_menu_field', esc_html_x('* [WP247] Navigation menu field', 'widget name', 'wpshare247'),
				array(
					'classname' => 'wpshare247_navigation_menu_field',
					'description' => esc_html__('Trường Menu Navigation của Widget', 'wpshare247'),
					'customize_selective_refresh' => true
				)
			);
		}
		
		//Hiển thị nội dung Widget
		function widget($args, $instance) {
			$defaults = array('title'=>'', 'menu_id' => '');
			
			$title = $instance['title'];
			$menu_id = $instance['menu_id'];
			
			echo $args['before_widget'];
				?>
                <style>
                	.ws247-field{ background:#eaeaea; margin-bottom: 10px; padding:10px; }
                </style>
				<?php echo $args['before_title'] . $title . $args['after_title']; ?>
                <section class="fields-content">
                    <!-- Navigation Menu -->
                    <div class="ws247-field">
                    	<?php 
						if($menu_id){
							wp_nav_menu( array( 'menu' => $menu_id ) );
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
			
			if (!empty($new_instance['menu_id'])) {
				$instance['menu_id'] = ($new_instance['menu_id']);
			}
			
			return $instance;
		}
		
		
		//Khai báo các field của Widget
		function form($instance) {
			$defaults = array('title'=>'', 'menu_id' => '');
			$instance = wp_parse_args($instance, $defaults); ?>
            
            <!-- text field -->
            <p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Text', 'wpshare247'); ?></label>
				<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
			</p>
            
            <!-- Menu field -->
			<?php Ws247_M_WG::helper_wp_nav_field('menu_id', 'Menu', $this, $instance); ?>
			
		<?php
		}
	}
endif;