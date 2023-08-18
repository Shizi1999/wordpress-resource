<?php 
$id = $field['id'];
$val = get_option($id); 
$options = $field['options'];
if($val===false){
	$options = $options;
}else{
	$val = json_decode($val, true);
	$options_data = $val['val'];
	foreach($options as $t=>$c){
		$options[$t] = (isset($options_data[$t])) ? $options_data[$t] : $c;
	}
}
$val_data = json_encode(array('type'=>'checkbox_many','val'=>$options));

if($options){
?>
<div id="<?php echo $id;?>">
	<input type="hidden" name="<?php echo $id; ?>" value='<?php echo $val_data; ?>' />
<?php
	$i = 1;
	$group = $id;
	foreach($options as $label=>$checked){
	?>
    	<div class="item">
			<input data-group="<?php echo $group; ?>" <?php if($checked) echo 'checked'; ?> value="<?php echo $checked; ?>" type="checkbox" class="widefat checkbox_many <?php echo $group; ?>" id="<?php echo $id.'_'.$i; ?>"/>
	<?php
			echo '<label for="'.$id.'_'.$i.'">'.$label .'</label>'; 
			$i++;
	?>
    	</div>
    <?php
	}
?>
</div>
<?php
}
?>