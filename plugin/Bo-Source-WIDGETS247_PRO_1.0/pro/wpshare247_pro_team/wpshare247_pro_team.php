<?php
if( !class_exists('wpshare247_pro_team') ):
	class wpshare247_pro_team extends WP_Widget {
		function __construct() {
			$this->ver = '1.0';
			$this->wg_class = basename(__FILE__, '.php');
			$this->wg_class_group = 'content-wg-'.$this->wg_class;
			$Ws247_M_WG = new Ws247_M_WG(); $Ws247_M_WG->wg_setup( $this->wg_class );
			
			parent::__construct(
				'wpshare247_pro_team', esc_html_x('[B-T01] Team', 'widget name', 'wpshare247'),
				array(
					'classname' => $this->wg_class.' wpshare247.com tbay.vn website366.com waoweb.vn',
					'description' => esc_html__('Team', 'wpshare247'),
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
                        <div class="section-header heading_style2">
                          <h2>Team Members</h2>
                        </div>
                        <div class="row">
                        	<?php 
							if($arr_data){
								foreach($arr_data as $k => $arr_item){ 
									$f_img = $arr_item['f_img']['val'];
									$f_name = $arr_item['f_name']['val'];
									$f_role = $arr_item['f_role']['val'];
									$f_social_fb = $arr_item['f_social_fb']['val'];
									$f_social_tw = $arr_item['f_social_tw']['val'];
									$f_social_in = $arr_item['f_social_in']['val'];
						
							?>
								<div class="col-sm-<?php echo $icol;?>">
									<div class="team_wrap">
                                      <div class="member_img"> <img src="<?php echo $f_img;?>" alt="<?php echo $f_img;?>">
                                        <div class="member_social_info">
                                          <ul>
                                            <li><a target="_blank" href="<?php echo $f_social_fb;?>"><i class="fa fa-facebook-f"></i></a></li>
                                            <li><a target="_blank" href="<?php echo $f_social_tw;?>"><i class="fa fa-twitter"></i></a></li>
                                            <li><a target="_blank" href="<?php echo $f_social_in;?>"><i class="fa fa-linkedin"></i></a></li>
                                          </ul>
                                        </div>
                                      </div>
                                      <div class="member_info">
                                        <h5><?php echo $f_name;?></h5>
                                        <p><?php echo $f_role;?></p>
                                      </div>
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
				'f_name' => array('type'=>'text', 'label' => 'Tên'),
				'f_role' => array('type'=>'text', 'label' => 'Vai trò'),
				
				'f_social_fb' => array('type'=>'text', 'label' => 'Facebook https://'),
				'f_social_tw' => array('type'=>'text', 'label' => 'Twitter https://'),
				'f_social_in' => array('type'=>'text', 'label' => 'Linkedin https://'),
						
			);
			return $arr_fields;
		}
		//End Chỉ cần khai báo các field tại đây và không cần làm gì thêm----------------------------------------
	}
endif;