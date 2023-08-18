<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Ws247_EA_Woocommerce {

	public function __construct() { 
		$this->init();
	}

	public function init(){
		add_action( 'woocommerce_before_shop_loop_item_title', [$this, 'woocommerce_img_wrapper_begin'], 9 );
		add_action( 'woocommerce_shop_loop_item_title', [$this, 'woocommerce_img_wrapper_end'], 9 );
		add_action( 'woocommerce_after_shop_loop_item', [$this, 'loop_add_to_cart_wrapper_begin'], 9 );
		add_action( 'woocommerce_after_shop_loop_item', [$this, 'loop_add_to_cart_wrapper_end'], 11 );
	}

	public function woocommerce_img_wrapper_begin(){
		echo '<div class="ws247-ea-img-wrapper">';
	}

	public function woocommerce_img_wrapper_end(){
		echo '</div>';
	}

	public function loop_add_to_cart_wrapper_begin(){
		echo '<div class="ws247-ea-atc-wrapper">';
	}

	public function loop_add_to_cart_wrapper_end(){
		echo '</div>';
	}

	static function woo_remove_result_count($option){
		if($option){
			add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
		}else{
			remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
		}
	}

	static function woo_remove_ordering($option){
		if($option){
			add_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
		}else{
			remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
		}
	}

	static function woo_remove_thumbnail($option){
		if($option){
			add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		}else{
			remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		}
	}

	static function woo_remove_sale_flash($option){
		if($option){
			add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
		}else{
			remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
		}
	}

	static function woo_remove_title($option){
		if($option){
			add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
		}else{
			remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
		}
	}

	static function woo_remove_rating($option){
		if($option){
			add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
		}else{
			remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
		}
	}

	static function woo_remove_price($option){
		if($option){
			add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
		}else{
			remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
		}
	}

	static function woo_remove_addtocart($option){
		if($option){
			add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		}else{
			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
		}
	}

	static function woo_remove_category_title($option){
		if($option){
			add_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);
		}else{
			remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);
		}
	}
}

$Ws247_EA_Woocommerce = new Ws247_EA_Woocommerce();