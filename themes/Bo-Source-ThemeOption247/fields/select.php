<?php
$id = $field['id']; 
$val = get_option($id);
if($val==""){
	$val = $field['default'];
}
$options = $field['options'];
?>
<select id="<?php echo $id; ?>" name="<?php echo $id; ?>" class="w366-select">
	<?php 
	if($options){
		foreach($options as $k=>$v){
		?>
        	<option <?php if($val==$k){ ?>selected<?php } ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
        <?php
		}
	}
	?>
</select>
<?php 
$note = $field['note'];
if($note){
?>
<span class="wnote"><?php echo $note; ?></span>
<?php
}