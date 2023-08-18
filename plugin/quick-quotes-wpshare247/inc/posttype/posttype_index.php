<?php
if( !class_exists('Wp247_quote_qqfs_posttype') ):
	class Wp247_quote_qqfs_posttype{
		
		/**
		 * Constructor
		 */
		function __construct() {
			$this->quote_posttype = 'quote_qqfs_pt';
			$this->request_quote_posttype = 'req_quote_qqfs_pt';
			add_action('admin_init', 'flush_rewrite_rules');
			add_action('init', array($this, 'register_posttype'));
			add_action('admin_menu', array($this, 'register_posttype_menu')); 
			$this->add_column();
		}
		
		/**
		 * Register post types
		 */
		public function register_posttype(){
			$this->register_posttype_quote();
			$this->register_request_quote_posttype();
			$this->register_posttype_from_options();
		}
		
		/**
		 * Register post type from Quotes
		 */
		 public function register_posttype_quote(){
			$posttype = $this->quote_posttype;
			if( !post_type_exists( $posttype ) ){
				$labels = array(
								'name' => __( 'Quotes', WS247_QUOTE_QQFS_TEXTDOMAIN ),
								'singular_name' => __( 'Quotes', WS247_QUOTE_QQFS_TEXTDOMAIN ),
								'add_new' => __( 'Add new', '' ), 
							  );
								
				$pt_args = array(
							  'labels' => $labels,
							  'public' => false,
							  'publicly_queryable' => false,
							  'show_ui' => true,
							  'show_in_menu' => 'edit.php?post_type='.$posttype,
							  'query_var' => false,
							  'capability_type' => 'page',
							  'has_archive' => false,
							  'rewrite' => array( 'slug' => false, 'with_front' => false  ), 
							  'menu_icon'=>'dashicons-money-alt',
							  'supports' => array('title', 'editor') // title, editor, author, thumbnail, excerpt, trackbacks, custom-fields, comments, revisions
							);
							
				register_post_type( $posttype, $pt_args);
			}
		}
		
		/**
		 * Register request post type from Quotes
		 */
		 public function register_request_quote_posttype(){
			$posttype = $this->request_quote_posttype;
			if( !post_type_exists( $posttype ) ){
				$labels = array(
								'name' => __( 'Quote Requests', WS247_QUOTE_QQFS_TEXTDOMAIN ),
								'singular_name' => __( 'Quote Requests', WS247_QUOTE_QQFS_TEXTDOMAIN ),
								'add_new' => __( 'Add new', WS247_QUOTE_QQFS_TEXTDOMAIN ), 
							  );
								
				$pt_args = array(
							  'labels' => $labels,
							  'public' => false,
							  'publicly_queryable' => false,
							  'show_ui' => true,
							  'show_in_menu' => 'edit.php?post_type='.$posttype,
							  'query_var' => false,
							  'capability_type' => 'page',
							  'has_archive' => false,
							  'rewrite' => array( 'slug' => false, 'with_front' => false  ), 
							  'menu_icon'=>'dashicons-money-alt',
							  'supports' => array('title')
							);
							
				register_post_type( $posttype, $pt_args);
			}
		}
		
		/**
		 * Register post type from Quote options
		 */
		 public function register_posttype_from_options(){
			$arr_qqfs_options = Ws247_quote_qqfs::get_qqfs_options();
			if($arr_qqfs_options){
				foreach($arr_qqfs_options as $posttype => $name){
					if( !post_type_exists( $posttype ) ){
						$labels = array(
										'name' => __( $name, WS247_QUOTE_QQFS_TEXTDOMAIN ),
										'singular_name' => __( $name, WS247_QUOTE_QQFS_TEXTDOMAIN ),
										'add_new' => __( 'Add new', WS247_QUOTE_QQFS_TEXTDOMAIN ), 
									  );
									    
						$pt_args = array(
									  'labels' => $labels,
									  'public' => false,
									  'publicly_queryable' => false,
									  'show_ui' => true,
									  'show_in_menu' => 'edit.php?post_type='.$posttype,
									  'query_var' => false,
									  'capability_type' => 'page',
									  'has_archive' => false,
									  'rewrite' => array( 'slug' => false, 'with_front' => false  ), 
									  'menu_icon'=>'dashicons-money-alt',
									  'supports' => array('title') // title, editor, author, thumbnail, excerpt, trackbacks, custom-fields, comments, revisions
									);
									
						register_post_type( $posttype, $pt_args);
					}
				}
			}
		}

		
		/**
		 * Add menu posttype to setting plugin
		 */
		public function register_posttype_menu(){ 
			add_submenu_page(WS247_QUOTE_QQFS_SETTING_PAGE_SLUG, __( 'Quotes', WS247_QUOTE_QQFS_TEXTDOMAIN ), __( 'Quotes', WS247_QUOTE_QQFS_TEXTDOMAIN ), 'manage_options', 'edit.php?post_type='.$this->quote_posttype);
			add_submenu_page(WS247_QUOTE_QQFS_SETTING_PAGE_SLUG, __( 'Quote Requests', WS247_QUOTE_QQFS_TEXTDOMAIN ), __( 'Quote Requests', WS247_QUOTE_QQFS_TEXTDOMAIN ), 'manage_options', 'edit.php?post_type='.$this->request_quote_posttype);
			
			$arr_qqfs_options = Ws247_quote_qqfs::get_qqfs_options();
			if($arr_qqfs_options){
				foreach($arr_qqfs_options as $posttype => $name){
					add_submenu_page(WS247_QUOTE_QQFS_SETTING_PAGE_SLUG, $name, $name, 'manage_options', 'edit.php?post_type='.$posttype); 
				}
			}
		}
		
		public function add_column(){ 
			$arr_qqfs_options = Ws247_quote_qqfs::get_qqfs_options();
			if($arr_qqfs_options){
				foreach($arr_qqfs_options as $posttype => $name){
					add_filter('manage_'.$posttype.'_posts_columns', array($this, 'add_column_head'), 10); 
					add_action('manage_'.$posttype.'_posts_custom_column', array($this, 'get_column_content'), 10, 2);
				}
			}
			
			//Quote
			add_filter('manage_'.$this->quote_posttype.'_posts_columns', array($this, 'add_column_head'), 10); 
			add_action('manage_'.$this->quote_posttype.'_posts_custom_column', array($this, 'get_column_content'), 10, 2);
			
			//Quote Request
			add_filter('manage_'.$this->request_quote_posttype.'_posts_columns', array($this, 'add_column_head'), 10); 
			add_action('manage_'.$this->request_quote_posttype.'_posts_custom_column', array($this, 'get_column_content'), 10, 2);
		}
		
		public function add_column_head($defaults) {
			$post_type = wp_unslash( $_REQUEST['post_type'] );
			
			switch($post_type){
				case 'quote_qqfs_pt';
						$defaults['quote_shortcode']  = __( 'Shortcode', WS247_QUOTE_QQFS_TEXTDOMAIN );
						
						//Move date after
						$date = $defaults['date']; unset($defaults['date']); $defaults['date']  = $date;
					break;
					
				case 'req_quote_qqfs_pt';
						$defaults['quote_title']  = __( 'Quotation', WS247_QUOTE_QQFS_TEXTDOMAIN );
						$defaults['quote_total']  = __( 'Quotation total', WS247_QUOTE_QQFS_TEXTDOMAIN );
						$defaults['quote_status']  = __( 'Status', WS247_QUOTE_QQFS_TEXTDOMAIN );
						
						//Move date after
						$date = $defaults['date']; unset($defaults['date']); $defaults['date']  = $date;
					break;
					
				default:
					$defaults['quote_qqfs_price']  = __( 'Price', WS247_QUOTE_QQFS_TEXTDOMAIN);
					break;
			}
			return $defaults;
		}
		
		public function get_column_content($column_name, $post_ID) {
			if ($column_name == 'quote_qqfs_price') {
				echo Ws247_quote_qqfs_function::quote_format_money(esc_attr(get_post_meta($post_ID , $column_name, true)), true);
			}
			
			if ($column_name == 'quote_shortcode') {
				echo '<div onclick="ws247_quote_qqfs_copy_clipboard(this);" id="quote_qqfs_shortcode_'.esc_attr($post_ID).'" class="quote_qqfs_shortcode">[quote_qqfs_new id="'.esc_attr($post_ID).'"]</div>';
			}
			
			if ($column_name == 'quote_title') {
				$quoteid = get_post_meta($post_ID , 'quoteid', true);
				echo esc_attr(get_the_title($quoteid));
			}
			
			if ($column_name == 'quote_total') {
				$total = esc_attr( get_post_meta($post_ID , 'total', true) );
				echo Ws247_quote_qqfs_function::quote_format_money($total, true);
			}
			
			if ($column_name == 'quote_status') {
				$i_status = esc_attr(get_post_meta($post_ID , 'quote_qqfs_requests_status', true));
				switch($i_status){
					case 1:
						$status = __('Checked', WS247_QUOTE_QQFS_TEXTDOMAIN);
						break;
					
					case 2:
						$status = __('Contacted', WS247_QUOTE_QQFS_TEXTDOMAIN);
						break;
					
					case 3:
						$status = __('Complete', WS247_QUOTE_QQFS_TEXTDOMAIN);
						break;
						
					default:
						$status = __('New', WS247_QUOTE_QQFS_TEXTDOMAIN);
						break;
				}
				echo esc_attr($status);
			}
		}
		
		
	//End Class
	}
	
	new Wp247_quote_qqfs_posttype();

endif;