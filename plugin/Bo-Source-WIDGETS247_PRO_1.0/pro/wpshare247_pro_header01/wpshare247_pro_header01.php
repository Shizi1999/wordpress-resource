<?php
if( !class_exists('wpshare247_pro_header01') ):
	class wpshare247_pro_header01 extends WP_Widget {
		function __construct() {
			$this->ver = '1.0';
			$this->wg_class = basename(__FILE__, '.php');
			$this->wg_class_group = 'content-wg-'.$this->wg_class;
			$Ws247_M_WG = new Ws247_M_WG(); $Ws247_M_WG->wg_setup( $this->wg_class );
			
			parent::__construct(
				$this->wg_class, esc_html_x('[H01] Header 01', 'widget name', 'wpshare247'),
				array(
					'classname' => $this->wg_class.' wpshare247.com tbay.vn website366.com waoweb.vn',
					'description' => esc_html__('Header 01', 'wpshare247'),
					'customize_selective_refresh' => true
				)
			);
		}
		
		//Hiển thị nội dung Widget
		function widget($args, $instance) { //var_dump($this->id); exit;
			$defaults = array('title' => '');
			
			$phone = $instance['phone'];
			$logo = $instance['logo'];
			$menu_id_top = $instance['menu_id_top'];
			$menu_id = $instance['menu_id'];
			$cart_url = $instance['cart_url'];
			$user_url = $instance['user_url']; 
			$background_color = $instance['background_color'];
			
			echo $args['before_widget'];
				$container_wg_id = "content-".$this->id;
				echo '<div id="'.$container_wg_id.'" class="'.$this->wg_class_group.' wpshare247-pro-module">';
				?>
               
                <header class="header axil-header header-style-1" <?php if($background_color){?> style="background:<?php echo $background_color;?>" <?php } ?>>
                    <div class="axil-header-top">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <div class="header-top-dropdown">
										<ul class="ws247-left-menu">
                                        	<?php 
											if($phone){
											?>
                                        	<li><a href="tel:<?php echo $phone;?>"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> <span><?php echo $phone;?></span></a></li>
                                        	<?php 
											}
											?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="header-top-link">
                                    	<?php 
										if($menu_id_top){
											wp_nav_menu( array( 'menu' => $menu_id_top, 'menu_class' => 'quick-link', 'container' => false) );
										}
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start Mainmenu Area  -->
                    <div id="axil-sticky-placeholder" style="height: 0px;"></div>
                    <div class="axil-mainmenu">
                        <div class="container">
                            <div class="header-navbar">
                                <div class="header-brand">
                                    <a href="<?php echo get_site_url(); ?>" class="logo logo-dark">
                                        <img src="<?php echo $logo;?>" alt="logo">
                                    </a>
                                    <a href="<?php echo get_site_url(); ?>" class="logo logo-light">
                                        <img src="<?php echo $logo;?>" alt="logo">
                                    </a>
                                </div>
                                <div class="header-main-nav">
                                    <!-- Start Mainmanu Nav -->
                                    <nav class="mainmenu-nav">
                                        <button class="mobile-close-btn mobile-nav-toggler"><i class="fa fa-times"></i></button>
                                        <div class="mobile-nav-brand">
                                            <a href="<?php echo get_site_url(); ?>" class="logo">
                                                <img src="<?php echo $logo;?>" alt="Logo">
                                            </a>
                                        </div>
                                        
                                        <?php 
										if($menu_id){
											wp_nav_menu( array( 'menu' => $menu_id, 'menu_class' => 'mainmenu', 'container' => false, 'wpshare247_pro_header01' => true ) );
										}
										?>
                                        
                                    </nav>
                                    <!-- End Mainmanu Nav -->
                                </div>
                                
                                <div class="header-action">
                                    <ul class="action-list">
                                        <li class="axil-search">
                                            <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <?php 
										if($cart_url):
											$cart_count = 0;
											if( function_exists('WC') ){
												$cart_count = WC()->cart->get_cart_contents_count();
											}
										?>
                                        <li class="shopping-cart">
                                            <a href="<?php echo $cart_url;?>" class="cart-dropdown-btn">
                                            	<?php 
												if($cart_count){
												?>
                                                <span class="cart-count"><?php echo $cart_count;?></span>
                                                <?php 
												}
												?>
                                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <?php 
										endif;
										?>
                                        
                                        <?php 
										if($user_url):
										?>
                                        <li class="my-account">
                                            <a href="<?php echo $user_url;?>">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <?php 
										endif;
										?>
                                        
                                        <li class="axil-mobile-toggle">
                                            <button class="menu-btn mobile-nav-toggler" data-ctid="#<?php echo $container_wg_id;?>">
                                                <i class="fa fa-bars" aria-hidden="true"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                
                                <div class="closeMask" style="display:none;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End Mainmenu Area -->
                </header>
				<?php
				echo '</div>';
			echo $args['after_widget'];
		}
		
		//Cập nhật dữ liệu các field của Widget
		function update($new_instance, $old_instance) {
			$instance = array();
			
			if (!empty($new_instance['phone'])) {
				$instance['phone'] = ($new_instance['phone']);
			}
			
			if (!empty($new_instance['logo'])) {
				$instance['logo'] = ($new_instance['logo']);
			}
			
			if (!empty($new_instance['menu_id_top'])) {
				$instance['menu_id_top'] = ($new_instance['menu_id_top']);
			}
			
			if (!empty($new_instance['menu_id'])) {
				$instance['menu_id'] = ($new_instance['menu_id']);
			}
			
			if (!empty($new_instance['cart_url'])) {
				$instance['cart_url'] = ($new_instance['cart_url']);
			}
			
			if (!empty($new_instance['user_url'])) {
				$instance['user_url'] = ($new_instance['user_url']);
			}
			
			if (!empty($new_instance['background_color'])) {
				$instance['background_color'] = ($new_instance['background_color']);
			}
			return $instance;
		}
		
		
		//Khai báo các field của Widget
		function form($instance) {
			$defaults = array('title' => '');
			$instance = wp_parse_args($instance, $defaults); ?>
			
            <?php Ws247_M_WG::helper_text_field('phone', 'Điện thoại', $this, $instance); ?>
            <?php Ws247_M_WG::helper_image_field('logo', 'Logo', $this, $instance); ?>
            <?php Ws247_M_WG::helper_wp_nav_field('menu_id_top', 'Menu top', $this, $instance); ?>
            <?php Ws247_M_WG::helper_wp_nav_field('menu_id', 'Menu chính', $this, $instance); ?>
            <?php Ws247_M_WG::helper_text_field('cart_url', 'Đường dẫn giỏ hàng', $this, $instance); ?>
            <?php Ws247_M_WG::helper_text_field('user_url', 'Đường dẫn tài khoản', $this, $instance); ?>
            <?php Ws247_M_WG::helper_color_picker_field('background_color', 'Màu Nền', $this, $instance); ?>
  
		<?php
		}

		
		//Custom your widget css
		public function wp_head_css_js(){
		?>
        	<!-- wpshare247.com - <?php echo $this->wg_class;?> -->
        	<style type="text/css">
				.<?php echo $this->wg_class_group;?> {}
				.<?php echo $this->wg_class_group;?> ul.ws247-left-menu{ margin:0; }
				.<?php echo $this->wg_class_group;?> ul.ws247-left-menu a{  
					font-size: var(--h01-font-size-b2);
					color: var(--h01-color-body);
					line-height: var(--h01-line-height-b2);
					display: inline-block;
				}
				.<?php echo $this->wg_class_group;?> ul{ list-style:none; margin:0; padding:0; }
				.<?php echo $this->wg_class_group;?> ul li a{ text-decoration:none; }
				.<?php echo $this->wg_class_group;?> ul ul{ margin:0; }
				.<?php echo $this->wg_class_group;?> .mainmenu>.menu-item-has-children>a::after {
					content: "\f107";
					font-family: FontAwesome;
				}
				.<?php echo $this->wg_class_group;?> .mainmenu>.menu-item-has-children.current-menu-item>a:before {
					width: 100%;
					opacity: 1;
				}
				
				.<?php echo $this->wg_class;?> .mobile-close-btn{ padding:0; }
				
            	@media only screen and (max-width: 767px) {
					
				}

            </style>
            
            <script>
            	
            </script>
        <?php
		}
		
		public function nav_menu_submenu_css_class( $classes, $args, $depth ) { //var_dump($args); exit;
			if ( true === $args->wpshare247_pro_header01 ) {
				$classes[] = 'axil-submenu';
			}
		
			return $classes;
		}
	}
endif;