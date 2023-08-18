<?php
if( !class_exists('wpshare247_pro_header03') ):
	class wpshare247_pro_header03 extends WP_Widget {
		function __construct() {
			$this->ver = '1.2';
			$this->wg_class = basename(__FILE__, '.php');
			$this->wg_class_group = 'content-wg-'.$this->wg_class;
			$Ws247_M_WG = new Ws247_M_WG(); $Ws247_M_WG->wg_setup( $this->wg_class );
			
			parent::__construct(
				$this->wg_class, esc_html_x('[H03] Header 03', 'widget name', 'wpshare247'),
				array(
					'classname' => $this->wg_class.' wpshare247.com tbay.vn website366.com waoweb.vn',
					'description' => esc_html__('Header 03', 'wpshare247'),
					'customize_selective_refresh' => true
				)
			);
		}
		
		//Hiển thị nội dung Widget
		function widget($args, $instance) {
			$defaults = array('title' => '');
			 
			$arr_data = json_decode($instance['wle_repeat_sortable_data_1'],true);
			
			$arr_data2 = json_decode($instance['wle_repeat_sortable_data_2'],true);
			
			$top_bar_menu_id = $instance['top_bar_menu_id']; 
			
			$menu_id = $instance['menu_id']; 
			
			$menu_id_center = $instance['menu_id_center']; 
			
			$menu_id_fixed = $instance['menu_id_fixed']; 
			
			$logo = $instance['logo']; 
			
			$background_color = $instance['background_color']; 
			
			$color = $instance['color']; 
			
			$background_main_menu = $instance['background_main_menu']; 
			
			echo $args['before_widget'];
				$container_wg_id = "content-".$this->id;
				echo '<div id="'.$container_wg_id.'" class="'.$this->wg_class_group.' wpshare247-pro-module">';
				?>
                <style>
                <?php 
					if($color){
					?>
						#<?php echo $container_wg_id;?> .container-out *{
							color:<?php echo $color;?>;
						}
						
					<?php
					}
					
					if($background_color){
					?>
						#<?php echo $container_wg_id;?> .container-out{
							background:<?php echo $background_color;?>;
						}
						
					<?php
					}
					
					if($background_main_menu){
					?>
						#<?php echo $container_wg_id;?> #header-wrap{
							background:<?php echo $background_main_menu;?>;
						}
					<?php
					}
					
				?>
				</style>
                
                <div id="top-bar">
                  <div class="container clearfix">
                    <div class="row justify-content-between">
                      <div class="col-12 col-md-auto">
                      	<?php 
						if($arr_data){
							echo '<ul id="top-social">';
							foreach($arr_data as $k => $arr_item){ 
								$social_fa = $arr_item['social_fa']['val'];
								$social_link = $arr_item['social_link']['val'];
						?>
                        		<li><a href="<?php echo $social_link;?>" class="si-<?php echo $social_fa;?>"><span class="ts-icon"><i class="fa fa-<?php echo $social_fa;?>"></i></span><span class="ts-text"><?php echo $social_fa;?></span></a></li>
                        <?php
							}
							echo '</ul>';
						}
						?>
                      </div>
                      <div class="col-12 col-md-auto">
                        <div class="top-links">
                         <?php 
							if($top_bar_menu_id){
								wp_nav_menu( array( 'menu' => $top_bar_menu_id, 
													'menu_class' => 'top-links-container', 
													'container' => false,
													$this->wg_class.'_top_bar_li' => true,
													$this->wg_class.'_top_bar_submenu' => true
													) );
							}else{ echo '<div style="color:#f00;">Chưa cấu hình [Menu top bar] cho Widget</div>';}
							?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <header id="header" class="header-size-sm <?php if($menu_id_fixed=='on') echo 'header-fixed-scroll'; ?>" data-sticky-shrink="false">
                  <div class="container-out">
                      <div class="container">
                        <div class="header-row">
                          <div id="logo" class="ms-auto ms-lg-0 me-lg-auto"> 
                          <a href="<?php echo get_site_url();?>" class="standard-logo"><img src="<?php echo $logo;?>" alt="wpshare247 pro Logo"></a> 
                          <a href="<?php echo get_site_url();?>" class="retina-logo"><img src="<?php echo $logo;?>" alt="wpshare247 pro Logo"></a> </div>
                          <div class="header-misc d-none d-lg-flex">
                            <?php 
                            if($arr_data2){
                                echo '<ul class="header-extras">';
                                foreach($arr_data2 as $k => $arr_item){ 
                                    $icon = $arr_item['icon']['val'];
                                    $text = $arr_item['text']['val'];
                                    $text_info = $arr_item['text_info']['val'];
                            ?>
                                     <li> <i class="i-plain icon-call fa fa-<?php echo $icon;?> m-0"></i>
                                        <div class="he-text"> <?php echo $text;?> <span><?php echo $text_info;?></span> </div>
                                      </li>
                            <?php
                                }
                                echo '</ul>';
                            }
                            ?>
                          </div>
                        </div>
                      </div>
                  </div>
                  
                  <div id="header-wrap" class="">
                    <div class="container">
                      <div class="header-row justify-content-between flex-row-reverse flex-lg-row <?php if($menu_id_center=='on'){ ?>justify-content-lg-center<?php } ?> top-search-parent">
                        <div class="header-misc">
                          <div id="top-search" class="header-misc-icon"> <a data-container="#<?php echo $container_wg_id;?>" href="#" id="top-search-trigger"><i class="fa fa-search"></i><i class="fa fa-times"></i></a> </div>
                        </div>
                        <div id="primary-menu-trigger" class="primary-menu-trigger" data-container="#<?php echo $container_wg_id;?>" > <svg class="svg-trigger" viewBox="0 0 100 100">
                          <path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path>
                          <path d="m 30,50 h 40"></path>
                          <path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path>
                          </svg> </div>
                        <nav class="primary-menu with-arrows">
                        	 <?php 
							if($menu_id){
								wp_nav_menu( array( 'menu' => $menu_id, 
													'menu_class' => 'menu-container', 
													'container' => false,
													'link_before' => '<div>',
													'link_after' => '</div>',
													$this->wg_class.'_li' => true,
													$this->wg_class.'_submenu' => true,
													$this->wg_class.'_link' => true
													) );
							}else{ echo '<div style="color:#f00;">Chưa cấu hình [Menu chính] cho Widget</div>';}
							?>
                        </nav>
                        <form role="search" method="get" class="top-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                           <input type="search" class="form-control" placeholder="<?php echo __( 'Tìm kiếm....', 'wpshare247' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="header-wrap-clone" style="height: 22px;"></div>
                </header>


				<?php
				echo '</div>';
			echo $args['after_widget'];
		}
		
		//Cập nhật dữ liệu các field của Widget
		function update($new_instance, $old_instance) {
			$instance = array();
			if (!empty($new_instance['wle_repeat_sortable_data_1'])) {
				$instance['wle_repeat_sortable_data_1'] = ($new_instance['wle_repeat_sortable_data_1']);
			}
			
			if (!empty($new_instance['top_bar_menu_id'])) {
				$instance['top_bar_menu_id'] = ($new_instance['top_bar_menu_id']);
			}
			
			if (!empty($new_instance['menu_id'])) {
				$instance['menu_id'] = ($new_instance['menu_id']);
			}
			
			if (!empty($new_instance['menu_id_center'])) {
				$instance['menu_id_center'] = ($new_instance['menu_id_center']);
			}
			
			if (!empty($new_instance['menu_id_fixed'])) {
				$instance['menu_id_fixed'] = ($new_instance['menu_id_fixed']);
			}
			
			
			
			if (!empty($new_instance['logo'])) {
				$instance['logo'] = ($new_instance['logo']);
			}
			
			if (!empty($new_instance['wle_repeat_sortable_data_2'])) {
				$instance['wle_repeat_sortable_data_2'] = ($new_instance['wle_repeat_sortable_data_2']);
			}
			
			if (!empty($new_instance['background_color'])) {
				$instance['background_color'] = ($new_instance['background_color']);
			}
			
			if (!empty($new_instance['color'])) {
				$instance['color'] = ($new_instance['color']);
			}
			
			if (!empty($new_instance['background_main_menu'])) {
				$instance['background_main_menu'] = ($new_instance['background_main_menu']);
			}
			
			
			return $instance;
		}
		
		
		//Khai báo các field của Widget
		function form($instance) {
			$defaults = array('title' => '');
			$instance = wp_parse_args($instance, $defaults); ?>
            
            <?php 
			$id_field = 'wle_repeat_sortable_data_1'; 
			wpshare247_repeat_sortable::register_field($id_field, esc_attr($this->get_field_name($id_field)), 'Mạng xã hội', $instance, $this->init_repeat_sortable_fields());
			?>
            <?php Ws247_M_WG::helper_wp_nav_field('top_bar_menu_id', 'Menu top bar', $this, $instance); ?>
           	<?php Ws247_M_WG::helper_image_field('logo', 'Logo', $this, $instance); ?>
           
           	<?php 
			$id_field = 'wle_repeat_sortable_data_2'; 
			wpshare247_repeat_sortable::register_field($id_field, esc_attr($this->get_field_name($id_field)), 'Liên hệ', $instance, $this->init_repeat_sortable_fields2());
			?>  
            <?php Ws247_M_WG::helper_wp_nav_field('menu_id', 'Menu chính', $this, $instance); ?>
            <p>
            	<input class="checkbox" type="checkbox" <?php checked( $instance[ 'menu_id_center' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'menu_id_center' ); ?>" name="<?php echo $this->get_field_name( 'menu_id_center' ); ?>" /> 
                <label for="<?php echo $this->get_field_id( 'menu_id_center' ); ?>"><?php esc_html_e('Canh giữa menu chính'); ?></label>
            </p>
            
            <p>
            	<input class="checkbox" type="checkbox" <?php checked( $instance[ 'menu_id_fixed' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'menu_id_fixed' ); ?>" name="<?php echo $this->get_field_name( 'menu_id_fixed' ); ?>" /> 
                <label for="<?php echo $this->get_field_id( 'menu_id_fixed' ); ?>"><?php esc_html_e('Fixed menu chính'); ?></label>
            </p>
             
            <p style="color: #ff9800;"><strong>Cấu hình Header:</strong></p>
            <?php Ws247_M_WG::helper_color_picker_field('background_color', 'Màu Nền', $this, $instance); ?>
            <?php Ws247_M_WG::helper_color_picker_field('color', 'Màu chữ', $this, $instance); ?>
            
            <?php Ws247_M_WG::helper_color_picker_field('background_main_menu', 'Màu Nền Menu Chính', $this, $instance); ?>
			
		<?php
		}
		
		function init_repeat_sortable_fields(){
			$arr_fields = array(
				'social_fa' => array( 'type'=>'select', 
											'label' => 'Kiểu MXH',
											'options' => array('facebook' => 'Facebook', 
																'twitter' => 'Twitter',
																'pinterest' => 'Pinterest',
																'instagram' => 'Instagram',
																'dribbble' => 'Dribbble',
																'youtube' => 'Youtube',
																)
										),
										
				'social_link' => array('type'=>'text', 'label' => 'Link https://'),								
				
			);
			return $arr_fields;
		}
		
		function init_repeat_sortable_fields2(){
			$arr_fields = array(
				'icon' => array( 'type'=>'select', 
											'label' => 'Icon',
											'options' => array('phone' => 'Điện thoại', 
																'envelope-o' => 'Email',
																'clock-o' => 'Giờ',
																)
										),
										
				'text' => array('type'=>'text', 'label' => 'Chữ'),	
				'text_info' => array('type'=>'text', 'label' => 'Thông tin'),								
				
			);
			return $arr_fields;
		}

		
		//Add class to ul submenu
		public function nav_menu_submenu_css_class( $classes, $args, $depth ) {
			$check_submenu = $this->wg_class.'_top_bar_submenu'; 
			if ( true === $args->$check_submenu ) {
				$classes[] = 'top-links-sub-menu';
			}
			
			$submenu = $this->wg_class.'_submenu'; 
			if ( true === $args->$submenu ) {
				$classes[] = 'sub-menu-container';
			}
			return $classes;
		}
		
		//Add class to li ( item )
		public function nav_menu_css_class( $classes, $item, $args ) {
			$tb_check_li = $this->wg_class.'_top_bar_li';
			if ( true === $args->$tb_check_li ) {
				$classes[] = 'top-links-item';
			}
			
			$check_li = $this->wg_class.'_li';
			if ( true === $args->$check_li ) {
				$classes[] = 'menu-item';
			}
			return $classes;	
		}
		
		//Add class to a ( link )
		public function nav_menu_link_attributes( $atts, $item, $args ) { 
			$check_link = $this->wg_class.'_link';
			if ( true === $args->$check_link ) {
				$atts['class'] = 'menu-link';
			}
			
			return $atts;
		}
	}
endif;