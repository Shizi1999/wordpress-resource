<?php 
$field_type = $field['type'];
$id = $field['id'];
$is_multiple = $field['is_multiple']; 
$hide_attribute = $field['hide_attribute'];
$btn_text = ($field['btn_text']) ? $field['btn_text'] : 'Chọn hình 1';
$list_attachment_id = get_option($id);
$note = $field['note'];
$arr_attachment_data = array();
if($list_attachment_id){
	$arr_attachment_id =  json_decode($list_attachment_id, true);
	$arr_attachment_data = $arr_attachment_id['val'];
}

$thumbnail = 'thumbnail';

$col = 3;
if($hide_attribute){
	$col = 8;
}
if($field_type=='slider'){
	$col = 12;
	$thumbnail = '';
}

$arr_attr_hide = (isset($field['arr_hide'])) ? $field['arr_hide']: '';
if(!is_array($arr_attr_hide)){
	$arr_attr_hide = array();
}

$arr_attribute_placeholder = (isset($field['attribute_placeholder'])) ? $field['attribute_placeholder']: '';


$title_placeholder = (isset($arr_attribute_placeholder['title'])) ? $arr_attribute_placeholder['title'] : "Tiêu đề slide";
$desciption_placeholder = (isset($arr_attribute_placeholder['desciption'])) ? $arr_attribute_placeholder['desciption'] : "Mô tả";
$link_placeholder = (isset($arr_attribute_placeholder['link'])) ? $arr_attribute_placeholder['link'] : "Đường dẫn http://";
$link_title_placeholder = (isset($arr_attribute_placeholder['link_title'])) ? $arr_attribute_placeholder['link_title'] : "Tiêu đề link";
$color_placeholder = (isset($arr_attribute_placeholder['color'])) ? $arr_attribute_placeholder['color'] : "#f00";
$target_placeholder = (isset($arr_attribute_placeholder['target'])) ? $arr_attribute_placeholder['target'] : "Mở cửa sổ mới";

?>
<div id="container-<?php echo $id; ?>" class="w366-image-type w366-field-<?php echo $field_type; ?> w366-item-<?php echo $col;?>">
	<input type="hidden" class="hdn" value='<?php echo $list_attachment_id;?>' name="<?php echo $id; ?>" />
    
    <?php $container = 'out-'.$id; ?>
	<ul id="<?php echo $container; ?>" data-title="<?=$title_placeholder?>" data-link_title="<?=$link_title_placeholder?>" data-link="<?=$link_placeholder?>" data-desciption="<?=$desciption_placeholder?>" data-target="<?=$target_placeholder?>" data-hideattribute="<?php if($hide_attribute) echo 1; else echo 0; ?>" data-image="1" class="attachments ui-sortable ui-sortable-disabled images w366-sortable" data-nophoto="<?php echo $field['no_photo_text']; ?>" data-type="<?php echo $field_type; ?>" >
    	<?php 
		if($arr_attachment_data){
			foreach($arr_attachment_data as $arr_attachment_it){ 
				$attachment_id = $arr_attachment_it['id'];
				
				$title_slide = (isset($arr_attachment_it['title'])) ? $arr_attachment_it['title']: '';
				$desciption_link = (isset($arr_attachment_it['desciption'])) ? $arr_attachment_it['desciption']: '';
				$img_link = (isset($arr_attachment_it['link'])) ? $arr_attachment_it['link']: '';
				$link_title = (isset($arr_attachment_it['link_title'])) ? $arr_attachment_it['link_title']: '';
				//$link_color = $arr_attachment_it['link_color'];
				$img_target = (isset($arr_attachment_it['arr_attachment_it'])) ? (int)$arr_attachment_it['arr_attachment_it']: 0;
				 
				$type = get_post_mime_type( $attachment_id );
				if( strpos($type, "video/") !== false ){
					$src_attachment = wp_get_attachment_image_url( $attachment_id, '', true );
					$img_link = wp_get_attachment_url($attachment_id);
				}else{
					$src_attachment = wp_get_attachment_image_url($attachment_id, $thumbnail);
				}
				
		?>
        		<li id="<?php echo $attachment_id;?>" data-id="<?php echo $attachment_id;?>" class="attachment save-ready">
                	<a class="dashicons dashicons-no removeit"></a>
                    <div class="attachment-preview js--select-attachment type-image subtype-png landscape">
                        <div class="thumbnail">
                            <div class="centered">
                                <img src="<?php echo $src_attachment; ?>" draggable="false">
                            </div>
                        </div>
                     </div>
                     <?php 
					 if(!$hide_attribute){
						 
					 ?>
                     <!-- attachment attribute -->
                    <div class="w366-attribute-list">
                        
                        <div class="attribute-it">
                        	<?php $title_id = $id.'_title_'.$attachment_id;  ?>
                            <input type="text" data-container="<?php echo $container; ?>" class="attr-title w366-auto-sort-text" id="<?php echo $title_id; ?>" name="<?php echo $title_id; ?>" placeholder="<?php echo $title_placeholder; ?>" value="<?php echo $title_slide;?>" />
                        </div>
                        
                        <div class="attribute-it">
                        	<?php $desciption_id = $id.'_desciption_'.$attachment_id;  ?>
                            <textarea data-container="<?php echo $container; ?>" class="attr-desciption w366-auto-sort-text" id="<?php echo $desciption_id; ?>" name="<?php echo $desciption_id; ?>" placeholder="<?php echo $desciption_placeholder; ?>"><?php echo $desciption_link;?></textarea>
                        </div>
                        
                        <div class="attribute-it">
                        	<?php $link_id = $id.'_link_'.$attachment_id;  ?>
                            <input type="text" data-container="<?php echo $container; ?>" class="attr-link w366-auto-sort-text" id="<?php echo $link_id; ?>" name="<?php echo $link_id; ?>" placeholder="<?php echo $link_placeholder; ?>" value="<?php echo $img_link;?>" />
                        </div>
                        
                        <div class="attribute-it">
                        	<?php $link_title_id = $id.'_link_title_'.$attachment_id;  ?>
                            <input type="text" data-container="<?php echo $container; ?>" class="attr-link_title w366-auto-sort-text" id="<?php echo $link_title_id; ?>" name="<?php echo $link_title_id; ?>" placeholder="<?php echo $link_title_placeholder; ?>" value="<?php echo $link_title;?>" />
                        </div>
                        
                        
                        
                        <div class="attribute-it">
                        	<?php $target_id = $id.'_target_'.$attachment_id;  ?>
                            <input data-container="<?php echo $container; ?>" id="<?php echo $target_id; ?>"  type="checkbox" class="attr-target widefat w366-checkbox w366-auto-sort-checkbox" name="<?php echo $target_id; ?>" <?php if($img_target) echo 'checked'; ?> /><label for="<?php echo $target_id; ?>" class="checkbox_label"><?php echo $target_placeholder; ?></label>
                        </div>
                    </div>
                    <?php 
					 }
					?>
            	</li>
        <?php
			}
		}else{
			echo '<span class="w366-no-photo">'.$field['no_photo_text'].'</span>';
		}
		?>
    </ul>
    <?php 
	if($note){
	?>
    <span class="wnote"><?php echo $note; ?></span>
    <?php
	}
	?>
	<button data-title="<?php echo $field['media_upload_title'];?>" data-btntext="<?php echo $field['media_upload_btn_text'];?>" type="button" class="button btn-img-field" data-number="<?php if($is_multiple)echo '*'; else echo '1'; ?>"><?php echo $btn_text; ?></button>
</div>