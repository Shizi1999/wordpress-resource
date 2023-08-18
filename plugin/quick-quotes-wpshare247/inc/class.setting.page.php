<?php
if( !class_exists('Ws247_quote_qqfs') ):
	class Ws247_quote_qqfs{
		 const FIELDS_GROUP = 'Ws247_quote_qqfs-fields-group'; 
		 
		/**
		 * Constructor
		 */
		function __construct() {
			$this->position = 50;
			$this->slug = WS247_QUOTE_QQFS_SETTING_PAGE_SLUG;
			$this->option_group = self::FIELDS_GROUP;
			add_action('admin_menu',  array( $this, 'add_setting_page' ) );
			add_action('admin_init', array( $this, 'register_plugin_settings_option_fields' ) );
			add_action('admin_enqueue_scripts', array( $this, 'register_admin_css_js' ));
			add_action('admin_head',  array( $this, 'admin_head' ) );
			//add_action('admin_footer',  array( $this, 'admin_footer_script' ) );
			add_filter('plugin_action_links', array( $this, 'add_action_link' ), 999, 2 );
			//add_action( 'wp_enqueue_scripts', array($this, 'register_scripts') );
			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
			$this->Helper = new Wp247_quote_qqfs_Helper();
			add_action('init', array($this,'register_session'));
		}
		
		public function admin_head(){
		?>
        <script>
        	var qqfs_admin_url = '<?php echo admin_url('admin-ajax.php');?>';
			var qqfs_confirm_del = '<?php esc_html_e("You should be careful before deleting this option, as it may involve other data. Do you want to continue deleting or not?", WS247_QUOTE_QQFS_TEXTDOMAIN); ?>';
        	var qqfs_copied = '<?php esc_html_e("Copied", WS247_QUOTE_QQFS_TEXTDOMAIN); ?>';
        </script>
        <?php
		}
		
		public function register_session(){
			if( !session_id() ){
				session_start();
			}
		}
		
		public function add_action_link( $links, $file  ){
			$plugin_file = basename ( dirname ( WS247_QUOTE_QQFS ) ) . '/'. basename(WS247_QUOTE_QQFS, '');
			if($file == $plugin_file){
				$setting_link = '<a href="' . admin_url('admin.php?page='.WS247_QUOTE_QQFS_SETTING_PAGE_SLUG) . '">'.__( 'Settings' ).'</a>';
				array_unshift( $links, $setting_link );
			}
			return $links;
		}
		
		public function register_admin_css_js(){
			wp_enqueue_style( 'wpshare247.com_ws247_quote_qqfs_admin.css', WS247_QUOTE_QQFS_PLUGIN_INC_ASSETS_URL . '/ws247_quote_qqfs_admin.css', false, '1.0' );
			wp_enqueue_script( 'wpshare247.com_ws247_quote_qqfs_admin.js', WS247_QUOTE_QQFS_PLUGIN_INC_ASSETS_URL . '/js/ws247_quote_qqfs_admin.js', array('jquery'), '1.0' );
		}
		
		public function add_setting_page() {
			//add menu
			$menu_title = __("Configure QQFS", WS247_QUOTE_QQFS_TEXTDOMAIN);
			$page_title = $menu_title;
			$capability = 'manage_options';
			$menu_slug = $this->slug;
			$function_callback = array($this, 'the_content_setting_page');
			$icon_url = '';
			$position = isset($this->position) ? $this->position : '';
			add_menu_page($page_title, $menu_title, $capability, $menu_slug , $function_callback, $icon_url, $position);
		}
		
		public function load_textdomain(){
			load_plugin_textdomain( WS247_QUOTE_QQFS_TEXTDOMAIN, false, dirname( plugin_basename( WS247_QUOTE_QQFS ) ) . '/languages/' ); 
		}
		
		static function create_option_prefix($field_name){
			return WS247_QUOTE_QQFS_PREFIX.$field_name;
		}
		
		public function get_option($field_name){
			return get_option(WS247_QUOTE_QQFS_PREFIX.$field_name);
		}
		
		static function class_get_option($field_name){
			return get_option(WS247_QUOTE_QQFS_PREFIX.$field_name);
		}
		
		public function register_field($field_name){
			register_setting( $this->option_group, WS247_QUOTE_QQFS_PREFIX.$field_name);
		}
		
		public function register_plugin_settings_option_fields() {
			/***
			****register list fields
			****/
			$arr_register_fields = array(
											//-------------------------------general tab
											'option_new', 'currency', 'currency_pos', 'price_thousand_sep',
											'price_decimal_sep', 'price_num_decimals', 'receive_email'
											//'qqfs_options'
										);
			
			if($arr_register_fields){
				foreach($arr_register_fields as $key){
					$this->register_field($key);
				}
			}
		}
		
		public function the_content_setting_page(){
			require_once WS247_QUOTE_QQFS_PLUGIN_INC_DIR . '/option-form-template.php';
		}
		
		public function admin_footer_script(){
			require_once WS247_QUOTE_QQFS_PLUGIN_INC_ASSETS . '/addmin_footer_js.php';
		}
		
		static function get_qqfs_options_field(){
			return self::create_option_prefix('qqfs_options');
		}
		
		static function get_qqfs_options(){
			return self::class_get_option('qqfs_options');
		}

	//End class--------------	
	}
	
	new Ws247_quote_qqfs();
endif;
