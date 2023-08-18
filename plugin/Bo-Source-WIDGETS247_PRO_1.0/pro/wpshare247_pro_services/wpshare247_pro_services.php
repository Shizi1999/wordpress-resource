<?php
if( !class_exists('wpshare247_pro_services') ):
	class wpshare247_pro_services extends WP_Widget {
		function __construct() {
			$this->ver = '1.0';
			$this->wg_class = basename(__FILE__, '.php');
			$this->wg_class_group = 'content-wg-'.$this->wg_class;
			$Ws247_M_WG = new Ws247_M_WG(); $Ws247_M_WG->wg_setup( $this->wg_class );
			
			parent::__construct(
				'wpshare247_pro_services', esc_html_x('[B-S01] Dịch vụ', 'widget name', 'wpshare247'),
				array(
					'classname' => $this->wg_class.' wpshare247.com tbay.vn website366.com waoweb.vn',
					'description' => esc_html__('Dịch vụ', 'wpshare247'),
					'customize_selective_refresh' => true
				)
			);
		}
		
		//Hiển thị nội dung Widget
		function widget($args, $instance) {
			$defaults = array('title' => '');
			
			$title = $instance['title'];
			
			$data_field = $instance['wle_repeat_sortable_data_1']; 
			$arr_data = json_decode($data_field,true);
			
			$icol = ($instance['icol']) ? $instance['icol'] : 4; 
			
			$background_color = $instance['background_color']; 
			
			$color = $instance['color']; 
			
			echo $args['before_widget'];
				$container_wg_id = "content-".$this->id;
				echo '<div id="'.$container_wg_id.'" class="'.$this->wg_class_group.' wpshare247-pro-module">';
				?>
                <style>
                <?php 
					if($color){
					?>
						#<?php echo $container_wg_id;?> *{
							color:<?php echo $color;?>;
						}
						
						#<?php echo $container_wg_id;?> .section-header.heading_style2::after{
							background:<?php echo $color;?>;
						}
					<?php
					}
				?>
				</style>
                
                <section class="section-padding" <?php if($background_color){?> style="background-color:<?php echo $background_color;?>" <?php } ?>>
                  <div class="container">
                    <div class="section-header heading_style2"><h2><?php echo $title; ?></h2></div>
                    <div class="row">
                        <?php 
						if($arr_data){
							foreach($arr_data as $k => $arr_item){ 
								$f_img = $arr_item['f_img']['val'];
								$f_title = $arr_item['f_title']['val'];
								$f_title_link = $arr_item['f_title_link']['val'];
								$f_description = $arr_item['f_description']['val'];
								$f_rm = $arr_item['f_rm']['val'];
						?>
                            <div class="col-sm-<?php echo $icol;?>">
                                <div class="service_box service_style2"> <img src="<?php echo $f_img;?>" alt="<?php echo $f_title;?>"> 
                                    <a href="<?php echo $f_title_link;?>">
                                    	<h5><?php echo $f_title;?></h5>
                                    </a>
                                	<p><?php echo $f_description;?></p>
                                	<a href="<?php echo $f_title_link;?>" class="btn-link"><?php echo $f_rm;?> <i class="fa fa-long-arrow-right"></i></a> 
                              	</div>
                            </div>
                        <?php
							}
						}
						?>
                    </div>
                  </div>
                </section>
				<?php
				echo '</div>';
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
			
			if (!empty($new_instance['icol'])) {
				$instance['icol'] = ($new_instance['icol']);
			}
			
			if (!empty($new_instance['background_color'])) {
				$instance['background_color'] = ($new_instance['background_color']);
			}
			
			if (!empty($new_instance['color'])) {
				$instance['color'] = ($new_instance['color']);
			}
			return $instance;
		}
		
		
		//Khai báo các field của Widget
		function form($instance) {
			$defaults = array('title' => '');
			$instance = wp_parse_args($instance, $defaults); ?>

            <!-- text field -->
            <?php Ws247_M_WG::helper_text_field('title', 'Tiêu đề', $this, $instance); ?>
			
            <?php 
			$id_field = 'wle_repeat_sortable_data_1'; 
			wpshare247_repeat_sortable::register_field($id_field, esc_attr($this->get_field_name($id_field)), 'Danh sách dịch vụ', $instance, $this->init_repeat_sortable_fields());
			?>
            
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('icol')); ?>"><?php esc_html_e('Số cột', 'wpshare247'); ?></label>
                <select id="<?php echo esc_attr($this->get_field_id('icol')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('icol')); ?>">
                    <option value="4" <?php selected("4", $instance['icol']); ?>><?php esc_html_e('3 cột', 'wpshare247'); ?></option>
  					<option value="3" <?php selected("3", $instance['icol']); ?>><?php esc_html_e('4 cột', 'wpshare247'); ?></option>
                    <option value="6" <?php selected("6", $instance['icol']); ?>><?php esc_html_e('2 cột', 'wpshare247'); ?></option>
                </select>
            </p>
            
            <?php Ws247_M_WG::helper_color_picker_field('background_color', 'Màu Nền', $this, $instance); ?>
            
            <?php Ws247_M_WG::helper_color_picker_field('color', 'Màu chữ', $this, $instance); ?>
			
		<?php
		}
		
		//Chỉ cần khai báo các field tại đây và không cần làm gì thêm----------------------------------------
		function init_repeat_sortable_fields(){
			$arr_fields = array(
				'f_img' => array('type'=>'image', 'label' => 'Hình'),
				'f_title' => array('type'=>'text', 'label' => 'Tiêu đề'),
				'f_title_link' => array('type'=>'text', 'label' => 'Link https://'),
				'f_description' => array('type'=>'textarea', 'label' => 'Mô tả'),
				'f_rm' => array('type'=>'text', 'label' => 'Xem thêm text')					
			);
			return $arr_fields;
		}
		//End Chỉ cần khai báo các field tại đây và không cần làm gì thêm----------------------------------------
		
	}
endif;