<?php
class Wle_Helper_Get {
	function __construct() {
	}
	
	/*
		Get all custom post
	 */
	public static function get_post_options( $post_type = 'page' ){
		$options = array('0'=>'--Chọn--');
		$args = array( 
						'post_type' => $post_type, 
						'order' => 'DESC',
						'post_status' => 'publish',
						'posts_per_page' => '-1');
		$posts_array = get_posts( $args );
		if($posts_array):
			foreach ( $posts_array as $obj ) {
				$options[$obj->ID] = $obj->post_title;
			}
		endif;
		return $options;
	}
	
	/*
		Get all contact form 7 plugin
	 */
	public static function get_cf7_options(){
		$post_type = 'wpcf7_contact_form';
		return self::get_post_options( $post_type );
	}
	
	/*
		Get all meta slider plugin
	 */
	public static function get_meta_slider_options(){
		$post_type = 'ml-slider';
		return self::get_post_options( $post_type );
	}
	
	/*
		Get all Nav menu
	 */
	public static function get_nav_options(){
		$all_nav_menu = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		$options = array('0'=>'--Chọn--');
		if($all_nav_menu):
			foreach ( $all_nav_menu as $obj ) {
				$options[$obj->term_id] = $obj->name;
			}
		endif;
		return $options;
	}
}