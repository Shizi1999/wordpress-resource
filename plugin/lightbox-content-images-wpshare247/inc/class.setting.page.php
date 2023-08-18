<?php
if( !class_exists('Ws247_lcimages_Setting') ):
	class Ws247_lcimages_Setting{
		 const FIELDS_GROUP = 'Ws247_lcimages_Setting-fields-group'; 
		 
		/**
		 * Constructor
		 */
		function __construct() {
			$this->slug = WS247_LCIMAGES_SETTING_PAGE_SLUG;
			$this->option_group = self::FIELDS_GROUP;
			add_action('admin_menu',  array( $this, 'add_setting_page' ) );
			add_action('admin_init', array( $this, 'register_plugin_settings_option_fields' ) );
			add_action('admin_footer',  array( $this, 'admin_footer_script' ) );
			add_filter('plugin_action_links', array( $this, 'add_action_link' ), 999, 2 );
			add_action( 'wp_enqueue_scripts', array($this, 'register_scripts') );
			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
			
			add_action( 'wp_ajax_ws247_lcimages_init_load_post_types', array( 'Ws247_lcimages_Helper', 'ws247_lcimages_init_load_post_types' ) ); 
        	add_action( 'wp_ajax_nopriv_ws247_lcimages_init_load_post_types', array( 'Ws247_lcimages_Helper', 'ws247_lcimages_init_load_post_types' ) );
		}
		
		public function add_action_link( $links, $file  ){
			$plugin_file = basename ( dirname ( WS247_LCIMAGES ) ) . '/'. basename(WS247_LCIMAGES, '');
			if($file == $plugin_file){
				$setting_link = '<a href="' . admin_url('admin.php?page='.WS247_LCIMAGES_SETTING_PAGE_SLUG) . '">'.__( 'Settings' ).'</a>';
				array_unshift( $links, $setting_link );
			}
			return $links;
		}
		
		public function add_setting_page() {
			add_submenu_page( 
				'options-general.php',
				__("Setting", WS247_LCIMAGES_TEXTDOMAIN),
				__("Configure Lightbox Images", WS247_LCIMAGES_TEXTDOMAIN),
				'manage_options',
				$this->slug,
				array($this, 'the_content_setting_page')
			);
		}
		
		public function load_textdomain(){
			load_plugin_textdomain( WS247_LCIMAGES_TEXTDOMAIN, false, dirname( plugin_basename( WS247_LCIMAGES ) ) . '/languages/' ); 
		}
		
		static function create_option_prefix($field_name){
			return WS247_LCIMAGES_PREFIX.$field_name;
		}
		
		public function get_option($field_name){
			return get_option(WS247_LCIMAGES_PREFIX.$field_name);
		}
		
		static function class_get_option($field_name){
			return get_option(WS247_LCIMAGES_PREFIX.$field_name);
		}
		
		public function register_field($field_name){
			register_setting( $this->option_group, WS247_LCIMAGES_PREFIX.$field_name);
		}
		
		public function admin_footer_script(){
			require_once WS247_LCIMAGES_PLUGIN_INC_ASSETS . '/addmin_footer_js.php';
		}

		/*
		** Register list field options
		*/
		public function register_plugin_settings_option_fields() {
			
			$arr_register_fields = array(
											//-------------------------------general tab
											'post_type', 'disable', 'zoom_icon_pos'
										);
			
			if($arr_register_fields){
				foreach($arr_register_fields as $key){
					$this->register_field($key);
				}
			}
		}
		
		/*
		** Include Field options
		*/
		public function the_content_setting_page(){
			require_once WS247_LCIMAGES_PLUGIN_INC_DIR . '/option-form-template.php';
		}
		
		/*
		** Register Asset Js and Css for Front-end
		*/
		function register_scripts() {
			wp_enqueue_style( 'wpshare247.com_ws247_lcimages_jquery.fancybox.min.css', WS247_LCIMAGES_PLUGIN_INC_ASSETS_URL . '/js/fancybox/dist/jquery.fancybox.min.css', false, '3.5.7' );
			wp_enqueue_script( 'wpshare247.com_ws247_lcimages_jquery.fancybox.min.js', WS247_LCIMAGES_PLUGIN_INC_ASSETS_URL . '/js/fancybox/dist/jquery.fancybox.min.js', array('jquery'), '3.5.7' );
			wp_enqueue_script( 'wpshare247.com_ws247_lcimages.js', WS247_LCIMAGES_PLUGIN_INC_ASSETS_URL . '/js/ws247_lcimages.js', array('jquery'), '1.0' );
			wp_enqueue_style( 'wpshare247.com_ws247_lcimages_ws247_lcimages.css', WS247_LCIMAGES_PLUGIN_INC_ASSETS_URL . '/css/ws247_lcimages.css', false, '1.0' );
			if( !is_user_logged_in() ){
				wp_enqueue_style( 'wpshare247.com_dashicons-css', includes_url().'/css/dashicons.min.css', false, get_bloginfo('version') );
			}
		}

	//End class--------------	
	}
	
	new Ws247_lcimages_Setting();
endif;
