<?php
namespace WPSHARE247_Elementor_Addon;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Plugin class.
 *
 * The main class that initiates and runs the addon.
 *
 * @since 1.0.0
 */
final class Plugin {

	/**
	 * Addon Version
	 *
	 * @since 1.0.0
	 * @var string The addon version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.7.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
	const MINIMUM_PHP_VERSION = '7.3';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \WPSHARE247_Elementor_Addon\Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \WPSHARE247_Elementor_Addon\Plugin An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() { 
		if ( $this->is_compatible() ) { 
			add_action( 'elementor/elements/categories_registered', [ $this, 'register_categories' ] );
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

	}

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor' ),
			'<strong>' . esc_html__( 'WPSHARE247 Elementor Addon', 'elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor' ),
			'<strong>' . esc_html__( 'WPSHARE247 Elementor Addon', 'elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor' ),
			'<strong>' . esc_html__( 'WPSHARE247 Elementor Addon', 'elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() { 
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] ); 
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'frontend_styles' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'frontend_scripts' ] );
	}

	/**
	 * Register Categories
	 *
	 * Fired by `elementor/elements/categories_registered` action hook.
	 *
	 */
	public function register_categories( $elements_manager  ) {
		$elements_manager->add_category(
			'wpshare247',
			[
				'title' => esc_html__( 'WPSHARE247.COM', 'wpshare247-elementor-addon' ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	/**
	 * Register Widgets
	 *
	 * Load widgets files and register new Elementor widgets.
	 *
	 * Fired by `elementor/widgets/register` action hook.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) { 

		$arr_widgets = array(
							'wpshare247_posts_widget',
							'wpshare247_products_widget',
							'wpshare247_product_categories_widget',
							'wpshare247_contact_form7'
							//'wpshare247_new_widget'
						);

		if($arr_widgets){
			foreach ($arr_widgets as $widget) {
				require_once( __DIR__ . '/widgets/'.$widget.'.php' );
				$widgets_manager->register( new $widget() );
			}
		}
	}

	/**
	 * Register styles
	 *
	 * Fired by `elementor/frontend/after_enqueue_styles` action hook.
	 *
	 */
	public function frontend_styles() {
		wp_register_style( WPSHARE247_ELEMENTOR_ADDON_PREFIX.'swiper-bundle.min.css', plugins_url( 'assets/js/swiper/swiper-bundle.min.css', WPSHARE247_ELEMENTOR_ADDON_MAIN_FILE ) );
		wp_enqueue_style( WPSHARE247_ELEMENTOR_ADDON_PREFIX.'swiper-bundle.min.css' );

		wp_register_style( WPSHARE247_ELEMENTOR_ADDON_PREFIX.'styles', plugins_url( 'assets/css/styles.css', WPSHARE247_ELEMENTOR_ADDON_MAIN_FILE ), array(), '1.0.5', false );
		wp_enqueue_style( WPSHARE247_ELEMENTOR_ADDON_PREFIX.'styles' );
	}

	/**
	 * Register scripts
	 *
	 * Fired by `elementor/frontend/after_register_scripts` action hook.
	 *
	 */
	public function frontend_scripts() {
		wp_register_script( WPSHARE247_ELEMENTOR_ADDON_PREFIX.'swiper-bundle.min.js', plugins_url( 'assets/js/swiper/swiper-bundle.min.js', WPSHARE247_ELEMENTOR_ADDON_MAIN_FILE ), array(), false, true );
		wp_enqueue_script( WPSHARE247_ELEMENTOR_ADDON_PREFIX.'swiper-bundle.min.js' );
	}

}