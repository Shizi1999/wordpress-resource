<?php
if( !class_exists('wpshare247_post_type_id_field') ):
	class wpshare247_post_type_id_field extends WP_Widget {
		function __construct() {
			parent::__construct(
				'wpshare247_post_type_id_field', esc_html_x('* [WP247] Post type field', 'widget name', 'wpshare247'),
				array(
					'classname' => 'wpshare247_post_type_id_field',
					'description' => esc_html__('Trường các loại post của Widget', 'wpshare247'),
					'customize_selective_refresh' => true
				)
			);
		}
		
		//Hiển thị nội dung Widget
		function widget($args, $instance) {
			$defaults = array('title'=>'', 'page_id' => '', 'post_id' => '', 'product_id' => '', 'your_custom_post_id' => '');
			
			$title = $instance['title'];
			$page_id = $instance['page_id'];
			$post_id = $instance['post_id'];
			$product_id = $instance['product_id'];
			$your_custom_post_id = $instance['your_custom_post_id'];
			
			echo $args['before_widget'];
				?>
                <style>
                	.ws247-field{ background:#eaeaea; margin-bottom: 10px; padding:10px; }
                </style>
				<?php echo $args['before_title'] . $title . $args['after_title']; ?>
                <section class="fields-content">
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
			
			return $instance;
		}
		
		
		//Khai báo các field của Widget
		function form($instance) {
			$defaults = array('title'=>'', 'page_id' => '', 'post_id' => '', 'product_id' => '', 'your_custom_post_id' => '');
			$instance = wp_parse_args($instance, $defaults); ?>
            
            <!-- text field -->
            <p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Text', 'wpshare247'); ?></label>
				<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
			</p>
            
            <!-- Page id field -->
			<?php Ws247_M_WG::helper_page_field('page_id', 'Trang', $this, $instance); ?>
            
            <!-- Post id field -->
			<?php Ws247_M_WG::helper_post_field('post_id', 'Bài viết', $this, $instance); ?>
            
            <!-- Product id field -->
			<?php Ws247_M_WG::helper_product_field('product_id', 'Sản phẩm WooCommerce', $this, $instance); ?>
            
            <!-- Custom Posttype id field -->
			<?php Ws247_M_WG::helper_post_type_field('your_custom_post_id', 'Your custom post type', $this, $instance, 'your-custom-post'); ?>
			
		<?php
		}
	}
endif;