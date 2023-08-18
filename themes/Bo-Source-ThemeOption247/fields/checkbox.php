<?php 
$id = $field['id'];
$val = get_option($id);
if($val===false){
	$val = $field['default'];
}
$note = $field['note'];
?>
<input <?php if($val) echo 'checked'; ?> type="checkbox" class="widefat w366-checkbox" name="<?php echo $id; ?>" id="<?php echo $id; ?>" />
<?php 
if($note){
?>
<span class="wnote"><?php echo $note; ?></span>
<?php
}