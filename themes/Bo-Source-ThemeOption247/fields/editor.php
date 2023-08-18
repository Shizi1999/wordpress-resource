<?php 
$editor_id = $field['id'];
$val = get_option( $editor_id );
if(!$val){
	$val = $field['default'];
}
$note = $field['note'];
?>

<div class="w366-editor">
	<?php 
		$settings = array( 'media_buttons' => true, 'editor_height'=> ($field['height']) ? $field['height'] : 300 );
		wp_editor( $val, $editor_id, $settings );
	?>
</div>

<?php 
if($note){
?>
<span class="wnote"><?php echo $note; ?></span>
<?php
}