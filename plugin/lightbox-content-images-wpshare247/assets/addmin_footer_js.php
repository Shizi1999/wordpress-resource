<script>
	
	jQuery(document).ready(function(e) {
        ws247_lcimages_init_load_post_types();
    });
	
	function ws247_lcimages_init_load_post_types(){
		jQuery.ajax({
			url: '<?php echo admin_url('admin-ajax.php'); ?>',
			type: 'POST',
			data:  {
						action: "ws247_lcimages_init_load_post_types"
					},
			dataType: 'json',
			success: function(data, textStatus, jqXHR){ //console.log(data); //return false;
				if(data.html){
					jQuery("#Ws247_lcimages_post_type_td ul").append(data.html);
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
			
			}          
		});
	}
</script>