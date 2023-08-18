<?php
if( !class_exists('wpshare247_pro_header02') ):
	class wpshare247_pro_header02 extends WP_Widget {
		function __construct() {
			$this->ver = '1.0';
			$this->wg_class = basename(__FILE__, '.php');
			$this->wg_class_group = 'content-wg-'.$this->wg_class;
			$Ws247_M_WG = new Ws247_M_WG(); $Ws247_M_WG->wg_setup( $this->wg_class );
			
			parent::__construct(
				$this->wg_class, esc_html_x('[H01] Header 02', 'widget name', 'wpshare247'),
				array(
					'classname' => $this->wg_class.' wpshare247.com tbay.vn website366.com waoweb.vn',
					'description' => esc_html__('Header 02', 'wpshare247'),
					'customize_selective_refresh' => true
				)
			);
		}
		
		
		//Hiển thị nội dung Widget
		function widget($args, $instance) {
			$defaults = array('title' => '');
			
			$phone_text = $instance['phone_text'];
			$phone = $instance['phone']; 
			$logo = $instance['logo'];
			$menu_cat_text = $instance['menu_cat_text']; 
			$menu_id_cat = $instance['menu_id_cat']; 
			$menu_id = $instance['menu_id'];
			$cart_url = $instance['cart_url'];
			$user_url = $instance['user_url'];
			$background_color = $instance['background_color']; 
			$color = $instance['color']; 
			
			echo $args['before_widget'];
				$container_wg_id = "content-".$this->id;
				echo '<div id="'.$container_wg_id.'" class="'.$this->wg_class_group.' wpshare247-pro-module">';
				?>
                <style>
					<?php if($color){?>
							#<?php echo $container_wg_id;?> *:not(.dropdown-item, .category-item-sub){
								color:<?php echo $color;?>;
							}
							
							#<?php echo $container_wg_id;?> header .navbar-toggler-icon{ -webkit-text-fill-color: <?php echo $color;?>; }
						<?php }
						
							if($background_color){?>
								#<?php echo $container_wg_id;?>, #<?php echo $container_wg_id;?> .offcanvas, #<?php echo $container_wg_id;?> .offcanvas .dropdown-menu{
									background:<?php echo $background_color;?>;
								}
						<?php }?>
                </style>
                
               <header class="pb-md-4 pb-0">
                    <div class="top-nav top-header sticky-header">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="navbar-top">
                                        <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button" data-container="#<?php echo $container_wg_id;?>" data-target=".<?php echo $container_wg_id;?>-primaryMenu">
                                            <span class="navbar-toggler-icon">
                                                <i class="fa fa-bars"></i>
                                            </span>
                                        </button>
                                        <a href="<?php echo get_site_url(); ?>" class="web-logo nav-logo">
                                        	<?php 
											if($logo){
											?>
                                            <img src="<?php echo $logo;?>" class="img-fluid blur-up lazyloaded" alt="logo">
                                            <?php 
											}else{ echo 'Thêm logo vào widget'; }
											?>
                                        </a>
            
                                        <div class="middle-box">
                                            <div class="search-box">
                                                <form role="search" method="get" class="input-group" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                                    <input type="search" class="form-control" placeholder="<?php echo __( 'Tìm kiếm....', 'wpshare247' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                                                    <button class="btn" type="button" id="button-addon2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
            
                                        <div class="rightside-box">
                                            <div class="search-full">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search font-light"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                                    </span>
                                                    <input type="text" class="form-control search-type" placeholder="Search here..">
                                                    <span class="input-group-text close-search">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x font-light"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <ul class="right-side-menu">
                                                <li class="right-side">
                                                    <div class="delivery-login-box">
                                                        <div class="delivery-icon">
                                                            <div class="search-box">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="right-side">
                                                    <a href="tel:<?php echo $phone;?>" class="delivery-login-box">
                                                        <div class="delivery-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone-call"><path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                                        </div>
                                                        <div class="delivery-detail">
                                                            <h6><?php echo $phone_text;?></h6>
                                                            <h5><?php echo $phone;?></h5>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="right-side">
                                                    <div class="onhover-dropdown header-badge">
                                                    	<?php 
														$cart_count = 0;
														if( function_exists('WC') ){
															$cart_count = WC()->cart->get_cart_contents_count();
														}
														?>
                                                        <button type="button" class="btn p-0 position-relative header-wishlist">
                                                        	<a href="<?php echo $cart_url;?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                                           	</a>
                                                            <span class="position-absolute top-0 start-100 translate-middle badge"><?php echo $cart_count;?>
                                                                <span class="visually-hidden">unread messages</span>
                                                            </span>
                                                        </button>
            											
                                                        <?php 
														if( function_exists('woocommerce_mini_cart') ){?>
                                                        <div class="onhover-div">
                                                        	<?php woocommerce_mini_cart(); ?>
                                                        </div>
                                                        <?php 
														}
														?>
                                                    </div>
                                                </li>
                                                <li class="right-side onhover-dropdown">
                                                    <div class="delivery-login-box">
                                                        <div class="delivery-icon">
                                                        	<a href="<?php echo $user_url;?>">
                                                            	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                                        	</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="header-nav">
                                    <div class="header-nav-left">
                                        <button class="dropdown-category">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-left"><line x1="17" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="17" y1="18" x2="3" y2="18"></line></svg>
                                            <span><?php echo $menu_cat_text;?></span>
                                        </button>
            
                                        <div class="category-dropdown">
                                            <div class="category-title">
                                                <h5>Categories</h5>
                                                <button type="button" class="btn p-0 close-button text-content">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            
                                            <?php 
											if($menu_id_cat){
												wp_nav_menu( array( 'menu' => $menu_id_cat, 
																				'menu_class' => 'category-list', 
																				'container' => false,
																				$this->wg_class.'_cate_li' => true,
																				$this->wg_class.'_cate_submenu' => true,
																				$this->wg_class.'_cate_link' => true
																				) );
											}else{ echo '<div style="color:#f00;">Chưa cấu hình [Menu danh mục] cho Widget</div>';}
											?>
                                        </div>
                                    </div>
            
                                    <div class="header-nav-middle">
                                        <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                                            <div class="offcanvas offcanvas-collapse order-xl-2 <?php echo $container_wg_id;?>-primaryMenu" id="primaryMenu">
                                                <div class="offcanvas-header navbar-shadow">
                                                    <h5>Menu</h5>
                                                    <button class="btn-close lead" type="button" data-container="#<?php echo $container_wg_id;?>"  aria-label="Close"></button>
                                                </div>
                                                <div class="offcanvas-body">
                                                    <?php 
													if($menu_id){
														wp_nav_menu( array( 'menu' => $menu_id, 
																			'menu_class' => 'navbar-nav', 
																			'container' => false, 
																			$this->wg_class.'_submenu' => true,
																			$this->wg_class.'_li' => true,
																			$this->wg_class.'_link' => true
																			) );
													}else{ echo 'Chưa cấu hình [Menu chính] cho Widget';}
													?>
                                                </div>
                                            </div>
                                            <div class="offcanvas-backdrop" data-container="#<?php echo $container_wg_id;?>"></div>
                                        </div>
                                    </div>
            
                                    <div class="header-nav-right">
                                        <button class="btn deal-button" data-bs-toggle="modal" data-bs-target="#deal-box">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zap"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                                            <span>Deal Today</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                
				<?php
				echo '</div>';
			echo $args['after_widget'];
		}
		
		//Cập nhật dữ liệu các field của Widget
		function update($new_instance, $old_instance) {
			$instance = array();
			
			if (!empty($new_instance['phone_text'])) {
				$instance['phone_text'] = ($new_instance['phone_text']);
			}
			
			if (!empty($new_instance['phone'])) {
				$instance['phone'] = ($new_instance['phone']);
			}
			
			if (!empty($new_instance['logo'])) {
				$instance['logo'] = ($new_instance['logo']);
			}
			
			if (!empty($new_instance['menu_id_cat'])) {
				$instance['menu_id_cat'] = ($new_instance['menu_id_cat']);
			}
			
			if (!empty($new_instance['menu_cat_text'])) {
				$instance['menu_cat_text'] = ($new_instance['menu_cat_text']);
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
			
			if (!empty($new_instance['color'])) {
				$instance['color'] = ($new_instance['color']);
			}
			return $instance;
		}
		
		
		//Khai báo các field của Widget
		function form($instance) {
			$defaults = array(	'phone_text' => 'Giao hàng 247', 
								'phone' => '0852080383', 
								'logo' => '', 
								'menu_cat_text'=> 'Danh mục', 
								'menu_id_cat' => '', 
								'menu_id' => '', 
								'cart_url' => '/gio-hang',
								'user_url' => '/tai-khoan',
								);
			$instance = wp_parse_args($instance, $defaults); ?>
			
			<?php Ws247_M_WG::helper_text_field('phone_text', 'Tiêu đề', $this, $instance); ?>
            <?php Ws247_M_WG::helper_text_field('phone', 'Điện thoại', $this, $instance); ?>
            <?php Ws247_M_WG::helper_image_field('logo', 'Logo', $this, $instance); ?>
            <?php Ws247_M_WG::helper_text_field('menu_cat_text', 'Tiêu đề danh mục', $this, $instance); ?>
            <?php Ws247_M_WG::helper_wp_nav_field('menu_id_cat', 'Menu danh mục', $this, $instance); ?>
            <?php Ws247_M_WG::helper_wp_nav_field('menu_id', 'Menu chính', $this, $instance); ?>
            <?php Ws247_M_WG::helper_text_field('cart_url', 'Đường dẫn giỏ hàng', $this, $instance); ?>
            <?php Ws247_M_WG::helper_text_field('user_url', 'Đường dẫn tài khoản', $this, $instance); ?>
            <?php Ws247_M_WG::helper_color_picker_field('background_color', 'Màu Nền', $this, $instance); ?>
            <?php Ws247_M_WG::helper_color_picker_field('color', 'Màu chữ', $this, $instance); ?>
  
		<?php
		}

		//Add class to ul submenu
		public function nav_menu_submenu_css_class( $classes, $args, $depth ) {
			$check_submenu = $this->wg_class.'_submenu'; 
			if ( true === $args->$check_submenu ) {
				$classes[] = 'dropdown-menu';
			}
			
			$_cate_submenu = $this->wg_class.'_cate_submenu'; 
			if ( true === $args->$_cate_submenu ) {
				$classes[] = 'onhover-category-box w-100';
			}
		
			return $classes;
		}
		
		//Add class to li ( item )
		public function nav_menu_css_class( $classes, $item, $args ) {
			$check_li = $this->wg_class.'_li';
			if ( true === $args->$check_li ) {
				if(!$item->menu_item_parent){
					$classes[] = 'nav-item';
					if( in_array('menu-item-has-children', $classes) ) { // has child
						$classes[] = 'dropdown';
					}
				}
			}
			
			
			$check_cate_li = $this->wg_class.'_cate_li';
			if ( true === $args->$check_cate_li ) {
				if(!$item->menu_item_parent){
					if( in_array('menu-item-has-children', $classes) ) { // has child
						$classes[] = 'onhover-category-list';
					}
				}
			}
			
			return $classes;	
		}
		
		//Add class to a ( link )
		public function nav_menu_link_attributes( $atts, $item, $args ) { 
			$check_link = $this->wg_class.'_link';
			if ( true === $args->$check_link ) {
				if($item->menu_item_parent){
					$atts['class'] = 'dropdown-item';
				}else{
					if( in_array('menu-item-has-children', $item->classes) ) { // has child
						$atts['class'] = 'nav-link dropdown-toggle';
					}else{
						$atts['class'] = 'nav-link nav-link-2';
					}
				}
			}
			
			
			$cate_link = $this->wg_class.'_cate_link';
			if ( true === $args->$cate_link ) {
				$atts['class'] = 'category-item-sub';
			}
			return $atts;
		}
	}
	
	
endif;
