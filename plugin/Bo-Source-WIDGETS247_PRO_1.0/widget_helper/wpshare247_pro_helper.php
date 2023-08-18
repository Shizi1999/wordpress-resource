<?php
if(!is_admin()){
	$sidebars_widgets = get_option( 'sidebars_widgets' );
	$arr_wg_res_asset = array();
	if($sidebars_widgets){
		foreach($sidebars_widgets as $sidebar => $arr_wg){
			if(is_array($arr_wg)){
				foreach($arr_wg as $s_wg_id){
					
					$arr_wg_obj = wp_parse_widget_id( $s_wg_id ) ;
					$wg_class = $arr_wg_obj['id_base'];
					
					if(in_array($wg_class, $arr_init_wg_pro) && !in_array($wg_class, $arr_wg_res_asset) ){
						$arr_wg_res_asset[] = $wg_class;
					}
				}
			}
		}
	}
	
	if(!empty($arr_wg_res_asset)){
		add_action('wp_head', 'wpshare247_pro_wp_head');
	}
	
	function wpshare247_pro_wp_head(){
		global $arr_wg_res_asset;
		if($arr_wg_res_asset){
			foreach($arr_wg_res_asset as $wg_class){
				//Custom your widget css-----------------------
				$file = WPSHARE247_WG_DIR.'/pro/'.$wg_class.'/'.$wg_class.'.php';
				if( file_exists($file) ){
					require_once($file);
					$new_class = new $wg_class();
					
					if( method_exists($new_class,'wp_head_css_js') ){
						$new_class->wp_head_css_js();
					}
					
					if( method_exists($new_class,'nav_menu_submenu_css_class') ){
						add_filter( 'nav_menu_submenu_css_class', array($new_class, 'nav_menu_submenu_css_class'), 10, 3 );
					}
					
					if( method_exists($new_class,'nav_menu_css_class') ){
						add_filter( 'nav_menu_css_class', array($new_class, 'nav_menu_css_class'), 1, 3);
					}
					
					if( method_exists($new_class,'nav_menu_link_attributes') ){
						add_filter( 'nav_menu_link_attributes',  array($new_class, 'nav_menu_link_attributes'), 1, 3 );
					}
				}
				
				$ver = '1.0';
				if($new_class->ver) $ver = $new_class->ver;
				
				//css-----------------------
				$wg_css_dir = get_parent_theme_file_path( Ws247_M_WG::get_current_dir() . '/pro/'.$wg_class.'/'.$wg_class.'.css' ); 
				if( file_exists($wg_css_dir) ){
					$wg_css_url = get_theme_file_uri( Ws247_M_WG::get_current_dir() . '/pro/'.$wg_class.'/'.$wg_class.'.css' ); 
				?>
					<link id="<?php echo $wg_class;?>-css" rel="stylesheet" href="<?php echo $wg_css_url; ?>?ver=<?php echo $ver; ?>">
				<?php
				}
				
				//Js-----------------------
				$wg_js_dir = get_parent_theme_file_path( Ws247_M_WG::get_current_dir() . '/pro/'.$wg_class.'/'.$wg_class.'.js' );
				if( file_exists($wg_js_dir) ){
					$wg_js_url = get_theme_file_uri( Ws247_M_WG::get_current_dir() . '/pro/'.$wg_class.'/'.$wg_class.'.js' ); 
					?>
					<script id='<?php echo $wg_class;?>-js' src='<?php echo $wg_js_url; ?>?ver=<?php echo $ver; ?>'></script>
					<?php
				}
				
				
				
			}
		}
	}
}