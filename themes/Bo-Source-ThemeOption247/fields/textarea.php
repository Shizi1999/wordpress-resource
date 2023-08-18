<?php
$id = $field['id']; 
$val = get_option($id);
if(!$val){
	$val = $field['default'];
}
$note = $field['note'];
?>
<div class="textarea-wrap">
	<textarea rows="<?php echo $field['rows']; ?>" class="w366-textarea" name="<?php echo $id; ?>" id="<?php echo $id; ?>"><?php echo $val ; ?></textarea>
</div>
<?php 
if($note){
?>
<span class="wnote"><?php echo $note; ?></span>
<?php
}