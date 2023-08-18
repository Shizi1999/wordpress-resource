<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Ws247_EA_Helper {

	public function __construct() { 
	}

	static function get_public_post_type(){
		$objects = get_post_types( $args, 'objects' );
		if(!$objects) return array();

		$arr = array();
		foreach( $objects as $type => $object ) {
			if( !$object->public || $object->name == 'attachment' ) continue;
			
			$arr[$type] = $object;
		}
		return $arr;
	}

	static function get_post_type_options(){
		$arr = self::get_public_post_type();
		if(empty($arr)){
			$arr[''] = esc_html__( 'Not found', 'wpshare247-elementor-addon' );
			return $arr;
		}else{
			foreach( $arr as $type => $object ) {
				$arr_labels = $object->labels;
				$arr[$type] = esc_html__( $arr_labels->singular_name, 'wpshare247-elementor-addon' );
			}
			return $arr;
		}
	}


	static function get_post_types( $post_type = 'page' ){
		$args = array( 
					'post_type' => $post_type, 
					'order' => 'DESC',
					'post_status' => 'publish',
					'posts_per_page' => '-1');
		$arr = get_posts( $args );
		return $arr;
	}

	static function get_contact_form_options(){
		$arr = self::get_post_types('wpcf7_contact_form');
		if(empty($arr)){
			$arr[''] = esc_html__( 'Not found', 'wpshare247-elementor-addon' );
			return $arr;
		}else{
			$options = array();
			$options[] = esc_html__( '--Select--', 'wpshare247-elementor-addon' );
			foreach( $arr as $ct ) {
				$options[$ct->ID] = esc_html__( $ct->post_title, 'wpshare247-elementor-addon' );
			}
			return $options;
		}
	}

	static function get_term_options($taxonomy){
		$arr = get_terms(  
			array(
			    'taxonomy' => $taxonomy,
			    'hide_empty' => false,
			)
		);

		if(empty($arr)){
			$arr[''] = esc_html__( 'Not found', 'wpshare247-elementor-addon' );
			return $arr;
		}else{
			$options = array();
			foreach( $arr as $t ) {
				$options[$t->slug] = esc_html__(  $t->name, 'wpshare247-elementor-addon' );
			}
			return $options;
		}
	}

	static function get_term_options_id_val($taxonomy, $hierarchy){
		$arr = get_terms(  
			array(
			    'taxonomy' => $taxonomy,
			    'hide_empty' => false,
			)
		);

		if(empty($arr)){
			$arr[''] = esc_html__( 'Not found', 'wpshare247-elementor-addon' );
			return $arr;
		}else{
			$options = array();
			$options[] = esc_html__( '--Select--', 'wpshare247-elementor-addon' );

			if($hierarchy){
				$arr_parents = get_terms(  
						array(
						    'taxonomy' => $taxonomy,
						    'hide_empty' => false,
						    'parent' => 0
						)
					);
				if($arr_parents){
					foreach( $arr_parents as $t ) {
						$options[$t->term_id] = esc_html__(  $t->name, 'wpshare247-elementor-addon' );
						$arr_child = get_terms(  
							array(
							    'taxonomy' => $taxonomy,
							    'hide_empty' => false,
							    'parent' => $t->term_id
							)
						);
						if($arr_child){
							foreach( $arr_child as $c ) {
								$options[$c->term_id] = '--'.esc_html__(  $c->name, 'wpshare247-elementor-addon' );
							}
						}
					}
				}
			}else{
				foreach( $arr as $t ) {
					$options[$t->term_id] = esc_html__(  $t->name, 'wpshare247-elementor-addon' );
				}
			}
			
			return $options;
		}
	}


	static function get_image_sizes_options(){
		$array = array();
		$arr_sizes = wp_get_registered_image_subsizes();
		if($arr_sizes){
			foreach ($arr_sizes as $s => $arr_size) {
				$arr[$s] = $s . ' - ' . $arr_size['width'] . 'x' . $arr_size['height'];
			}
		}

		return $arr;
	}

	static function get_current_page() {
		if( is_front_page() || is_home() ){
		    $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
		    set_query_var( 'paged', $paged );
		}else{
		    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		}

		return $paged;
	}
}

$Ws247_EA_Helper = new Ws247_EA_Helper();