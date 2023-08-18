<?php
require_once ( dirname(__FILE__) .'/tabs/tab_index.php' );

class Ws247_theme_option {
	private $page_title = 'Wpshare247 Options';
	private $menu_title = 'Wpshare247 Options';
	private $menu_slug = 'theme-options-wpshare247';
	private $position = 1;
	private $settings_fields = 'wpshare247-theme-option-8965569';
	private $is_tab = 'horizontal'; // '' | vertical | horizontal
	private $arr_types = array('text', 'select', 'image', 'editor', 'color-picker', 'textarea', 'checkbox', 'checkbox_many', 'radio', 'slider');
	
	
	//Construct
	function __construct() {
		add_action("admin_menu", array( $this, 'createMenuThemeOptionPage' ));
		add_action("admin_init", array( $this, 'displayThemePanelFields' ));
		add_action( 'admin_enqueue_scripts', array( $this, 'registerAdminCssJs' ));
   	}
	
	public function getCssUri(){
		$str_path = str_replace("\\","/", dirname(__FILE__) );
		$arr_path = explode("/themes/", $str_path); 
		$uri_css = get_theme_root_uri() . '/'. $arr_path[1] . '/css';
		return $uri_css;
	}
	
	public function getJsUri(){
		$str_path = str_replace("\\","/", dirname(__FILE__) );
		$arr_path = explode("/themes/", $str_path); 
		$uri_js = get_theme_root_uri() . '/'. $arr_path[1] . '/js';
		return $uri_js;
	}
	
	public function getFieldsPath(){
		return dirname(__FILE__) .'/fields';
	}
	
	public function getTemplateField(){
		$str_path = str_replace("\\","/", dirname(__FILE__) ); 
		$arr_path = explode("/themes/".get_template()."/", $str_path); 
		return $arr_path[1].'/fields';
	}
	
	public function registerAdminCssJs() { 
		// Css ---------------
		wp_register_style( 'hl_wp_admin_css', $this->getCssUri() . '/admin-styles.css', false, '1.0.0' );
		wp_enqueue_style( 'hl_wp_admin_css' );
		
		// Js ---------------
		wp_enqueue_style( 'wp-color-picker' );
    	wp_enqueue_script( 'wp-color-picker');
		wp_enqueue_media();
		wp_enqueue_script( 'hl_type_image', $this->getJsUri() . '/image.js' , array(), '1.0', true );
		wp_enqueue_script( 'hl_wp_admin_script', $this->getJsUri() . '/admin-script.js' , array(), '1.0', true );
	}

	
	public function createMenuThemeOptionPage(){
		$page_title = $this->page_title;
		$menu_title = $this->menu_title;
		$capability = 'manage_options';
		$menu_slug = $this->menu_slug;
		$function_callback = array($this, 'theContentThemeOptionPage');
		$icon_url = '';
		$position = $this->position;
		add_menu_page($page_title, $menu_title, $capability, $menu_slug , $function_callback, $icon_url, $position);
	}
	
	public function theFormOptions(){
		$is_tab = $this->is_tab;
		$clss = '';
		if($is_tab){
			$clss = 'is_tab';
		}
	?>
        <form method="post" action="options.php" <?php if($is_tab){?> class="has-tabs" <?php } ?>>
            <?php
                settings_fields( $this->settings_fields );
    
                global $arr_section;
                if($arr_section){
					$i = 0;
                    foreach($arr_section as $section => $arr_fields){
						$s_clss = '';
						if(!$i){
							$s_clss = 'first active';
						}
						echo '<section id="'.$section.'" class="section '.$clss.' '.$s_clss.'">';
                        do_settings_sections( $section.'-page' ); 
						echo '</section>';
						$i++;
                    }
                } 
                submit_button(); 
            ?>          
        </form>
    <?php
	}
	
	public function theContentThemeOptionPage(){
		?>
		<div id="poststuff" class="w366-options-area">
			<div class="postbox-container">
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox ">
						<h2 class="hndle ui-sortable-handle"><?php echo $this->page_title; ?></h2>
						<div class="inside <?php if($this->is_tab){?>options-tabs <?php echo $this->is_tab; ?> <?php } ?>">
                        	<?php $this->theCreateTabs(); ?>
                            <div class="wle-tab-content">
								<?php $this->theFormOptions(); ?>
                            </div>
						</div>
                        <div style="clear:both;"></div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	
	
	public function displayThemePanelFields(){
		global $arr_section;
		if($arr_section){
			foreach($arr_section as $section => $arr_item){
				$section_title = $arr_item['title'];
				$section_description = $arr_item['description'];
				$arr_fields = $arr_item['fields'];
				if($arr_fields){
					add_settings_section($this->settings_fields, $section_description, null, $section.'-page');
					foreach($arr_fields as $field){
						if( in_array($field['type'], $this->arr_types) ){
							$label = $field['label']; 
							$description = (isset($field['description'])) ? $field['description'] : '';
							if($description){
								$label .= '<br/><small class="wdescription"><i>('.$description.')</i></small>';
							}
							
							$field_id = OPTIONS_PREFIX . $field['id'];
							$field['id'] = $field_id;
							
							add_settings_field(	$field_id, 
												$label, 
												array($this, 'theHLDisplayField'), 
												$section.'-page', 
												$this->settings_fields, $field);
							register_setting($this->settings_fields, $field_id);
						}
					}
				}
			}
		}
	}
	
	public function theCreateTabs(){
		if($this->is_tab){
			global $arr_section;
			if($arr_section){
				echo '<h2 class="nav-tab-wrapper wp-clearfix">';
				$i = 0;
				foreach($arr_section as $section => $arr_item){
					$s_clss = '';
					if(!$i){
						$s_clss = 'nav-tab-active';
					}
					$section_title = $arr_item['title'];
					echo '<a id="tab_'.$section.'" class="nav-tab w366-tab-btn '.$s_clss.'" href="#'.$section.'"><span class="dashicons dashicons-arrow-right-alt2"></span>'.$section_title.'</a>';
					$i++;
				}
				echo '</h2>';
			} 
		}
	}
	
	public function theHLDisplayField($field){
		$type = $field['type'];
		if($type=='slider'){
			$type = 'image';
			$field['is_multiple'] = true;
			$field['hide_attribute'] = false;
		}
		set_query_var( 'field', $field );
		get_template_part( $this->getTemplateField() . '/' .$type, '' );
	}

//---------------End Class-------------------------------------	
}

// Run----------
new Ws247_theme_option();

// Danh sách các hàm lấy option----------------------------------
// Có thể dùng các hàm bên dưới đây
//--------------------------------------------------------------

// Test: wpshare247_get_option('twitter_url');
function wpshare247_get_option($field_id){
	$val = get_option(OPTIONS_PREFIX . $field_id); 
	$arr_json = json_decode($val, true);
	if(is_array($arr_json)){
		$type = $arr_json['type'];
		$arr_val = $arr_json['val'];
		return $arr_json;
	}
	return $val;
}

// Hàm lấy Url Hình ảnh: wpshare247_get_full_src('key_img'); @return: https://wpshare247.com/abc.jpg.....
function wpshare247_get_full_src($field_id){
	$arr_single_data = wpshare247_get_image_data($field_id);
	if(isset($arr_single_data['url'])){
		return $arr_single_data['url'];
	}
	return false;
}

// If single imgage @return more url attribute, if multiple images @return imgages
function wpshare247_get_image_data($field_id){
	$arr_field = wpshare247_get_option( $field_id ); 
	if(!$arr_field) return '';
	$type = $arr_field['type'];
	if($type=='image' || $type=='slider'){
		$arr_data = $arr_field['val']; 
		if(count($arr_data)==1){  
			$attachment_id = $arr_data[0]['id'];
			$arr_attachment_attr =  wp_get_attachment_image_src($attachment_id, '');
			$src_logo = $arr_attachment_attr[0];
			$arr_single_data = $arr_data[0];
			$arr_single_data['url'] = $src_logo; 
			return $arr_single_data; 
		}else{
			return $arr_data;
		}
	}
}


/* @return :
			array(1) {
			  [0]=>
			  array(4) {
				["id"]=>
				string(2) "37"
				["link"]=>
				string(8) "#slider2"
				["desciption"]=>
				string(10) "Mô tả 2"
				["target"]=>
				int(1)
			  }
			}
 */
function wpshare247_get_slider_data($field_id){
	$arr_field = wpshare247_get_option( $field_id ); 
	$type = $arr_field['type'];
	if($type=='slider'){
		$arr_data = $arr_field['val']; 
		if($arr_data){
			return $arr_data;
		}
	}
	return false;
}

/*
$args = array(  'size' => 'thumbnail',
				'id' => 'slider_id',
				'class' => array('slider' => 'clss1 clss2', 'item' => 'item1 item2', 'a' => 'link1 link2', 'img' => 'img1 img2' ),
				'before_slider' => '<div id="wrapper_my_id">',
				'after_slider' => '</div>',
				'before_item' => '<div class="item-wrapper">',
				'after_item' => '</div>',
				'before_a' => '<div class="a-wrapper">',
				'after_a' => '</div>',
				'before_img' => '<div class="img-wrapper">',
				'after_img' => '</div>',
				'slider_tag' => 'ul',
				'item_tag' => 'div',
				'desciption_open' => '<span class="desciption">',
				'desciption_close' => '</span>',
				'desciption_last' => true,
				'desciption_hide' => true,
			)
*/
function wpshare247_the_slider_html($field_id, $args ){
	$arr_slides = wpshare247_get_slider_data($field_id);
	if($arr_slides){
		$size = (isset($args['size'])) ? $args['size'] : "";
		$id = (isset($args['id'])) ? $args['id'] : uniqid( $field_id.'_' );
		$slider_tag = (isset($args['slider_tag'])) ? $args['slider_tag'] : "ul";
		$item_tag = (isset($args['item_tag'])) ? $args['item_tag'] : "li";
			
		$before_slider = (isset($args['before_slider'])) ? $args['before_slider'] : ""; 
		$after_slider = (isset($args['after_slider'])) ? $args['after_slider'] : ""; 
		$before_item = (isset($args['before_item'])) ? $args['before_item'] : ""; 
		$after_item = (isset($args['after_item'])) ? $args['after_item'] : "";
		$before_a = (isset($args['before_a'])) ? $args['before_a'] : ""; 
		$after_a = (isset($args['after_a'])) ? $args['after_a'] : ""; 
		$before_img = (isset($args['before_img'])) ? $args['before_img'] : ""; 
		$after_img = (isset($args['after_img'])) ? $args['after_img'] : ""; 
		$desciption_open = (isset($args['desciption_open'])) ? $args['desciption_open'] : '<span class="desciption">'; 
		$desciption_close = (isset($args['desciption_close'])) ? $args['desciption_close'] : '</span>';
		$desciption_last = (isset($args['desciption_last'])) ? true : false;
		$desciption_hide = (isset($args['desciption_hide'])) ? true : false;
		
		$slider_class = ''; $item_class = ''; $a_class = ''; $img_class = '';
		if(isset($args['class']['slider'])){
			$slider_class = $args['class']['slider'];
		}
		
		if(isset($args['class']['item'])){
			$item_class = $args['class']['item'];
		}
		
		if(isset($args['class']['a'])){
			$a_class = $args['class']['a'];
		}
		
		if(isset($args['class']['img'])){
			$img_class = $args['class']['img'];
		}
	?>
    	<?php if($before_slider) echo $before_slider; ?>
    	<?php echo '<'.$slider_tag; ?> <?php if($id){?> id="<?php echo $id;?>" <?php } ?> class="w366-collection-slider <?php echo $slider_class; ?>"<?php echo '>'; ?>
        	<?php 
			foreach($arr_slides as $slide){
				$attachment_id = $slide['id'];
				$arr_attachment_attr =  wp_get_attachment_image_src($attachment_id, $size);
				$attachment_url = $arr_attachment_attr[0];
				$link = $slide['link'];
				$slide_desciption = $slide['desciption'];
				$desciption = $desciption_open . $slide_desciption . $desciption_close;
				$target = $slide['target'];
				?>
                <?php if($before_item) echo $before_item; ?>
                <?php echo '<'.$item_tag; ?> class="slide-item <?php echo $item_class; ?>">
                	<?php if($before_a) echo $before_a; ?>
                	<a <?php if($a_class){?> class="<?php echo $a_class; ?>" <?php } if($link){ ?> href="<?php echo $link; ?>" <?php } if($target){ ?>target="_blank" <?php }?> >
                        <?php 
						if($desciption && !$desciption_last && $desciption_hide === false){
							echo $desciption;
						}?>
                    	<?php if($before_img) echo $before_img; ?>
                		<img class="<?php echo $img_class; ?>" src="<?php echo $attachment_url; ?>" alt="<?php echo $slide_desciption;?>" />
                        <?php if($after_img) echo $after_img; ?>
                        <?php 
						if($desciption && $desciption_last && $desciption_hide === false){
							echo $desciption;
						}?>
                    </a>
                    <?php if($after_a) echo $after_a; ?>
                </<?php echo $item_tag; ?>>
                <?php if($after_item) echo $after_item; ?>
                <?php
			}
			?>
        </<?php echo $slider_tag; ?>>
        <?php if($after_slider) echo $after_slider; ?>
    <?php
	}
}

function wpshare247_the_content_field($field_id){
	echo apply_filters('the_content', wpshare247_get_option($field_id) );
}
