<?php 
$arr_gallery = $args['arr_gallery'];
$size_gallery = ($args['size_gallery']) ? $args['size_gallery'] : "thumbnail";
if($arr_gallery){
	echo '<div class="wpshare247-gallery">';
	foreach($arr_gallery as $key => $id_attachment){
		$arr_thumb_url = wp_get_attachment_image_src($id_attachment, $size_gallery);
		$arr_full_url = wp_get_attachment_image_src($id_attachment, '');
		echo '<a data-fancybox="wpshare247-gallery" href="'.$arr_full_url[0].'"> <img src="'.$arr_thumb_url[0].'" alt="wpshare247 Gallery Widget" /></a>';
	}
	echo '</div>';
?>
<?php 
}
?>