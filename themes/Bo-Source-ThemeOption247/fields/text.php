<?php 
$id = $field['id'];
$val = get_option($id);
if(!$val){
	$val = $field['default'];
}
$note = $field['note'];
?>
<input placeholder="<?php echo $field['placeholder']; ?>" type="text" class="widefat" name="<?php echo $id; ?>" id="<?php echo $id; ?>" value="<?php echo $val ; ?>" />
<?php 
if($note){
?>
<span class="wnote"><?php echo $note; ?></span>
<?php
}