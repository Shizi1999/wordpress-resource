<?php 
/*
Need call: 	wp_enqueue_style( 'wp-color-picker' );	 	// call in php
			wp_enqueue_script( 'wp-color-picker'); 		// call in php
			jQuery( '.colorpicker' ).wpColorPicker();	// call in js
*/
$val = get_option($field['id']);
if(!$val){
	$val = $field['default'];
}
$note = $field['note'];
?>
<input value="<?php echo $val; ?>" class="colorpicker" name="<?php echo $field['id']; ?>" id="<?php echo $field['id']; ?>" />
<?php 
if($note){
?>
<span class="wnote"><?php echo $note; ?></span>
<?php
}