jQuery(document).ready(function(e) {
	ws247_quote_qqfs_add_option();
	ws247_quote_qqfs_del_option();
	ws247_create_quote_qqfs_sortable();
	ws247_quote_qqfs_checkbox_req();
	ws247_quote_qqfs_checkbox_sortcontainer();
});

function ws247_quote_qqfs_copy_clipboard(obj_e) {
	var id_obj_e = jQuery(obj_e).attr('id');
	var r = document.createRange();
	r.selectNode(document.getElementById(id_obj_e));
	window.getSelection().removeAllRanges();
	window.getSelection().addRange(r);
	document.execCommand('copy');
	window.getSelection().removeAllRanges();

	alert(qqfs_copied);
}

function ws247_quote_qqfs_checkbox_req(){
	jQuery("#arr_qqfs_options span.checkbox-req input[type='checkbox']").click(function(){
		var pt_type = jQuery(this).data('type');
		var is_check = 0;
		if( jQuery(this).is(":checked")){
			var is_check = 1;
		}
		jQuery("#arr_qqfs_options-spinner").addClass("is-active");
		jQuery.ajax({
			url: qqfs_admin_url,
			type: 'POST',
			data:  {
						action: "ws247_quote_qqfs_checkbox_req",
						pt_type : pt_type,
						is_check : is_check
					},
			dataType: 'json',
			success: function(data, textStatus, jqXHR){ //console.log(data); //return false;
				jQuery("#arr_qqfs_options-spinner").removeClass("is-active");
			},
			error: function(jqXHR, textStatus, errorThrown){
			
			}          
		});
	});
}

function ws247_quote_qqfs_checkbox_sortcontainer(){
	jQuery("#arr_qqfs_options span.checkbox-type input[type='checkbox']").click(function(){
		var pt_type = jQuery(this).data('type');
		var is_check = 0;
		if( jQuery(this).is(":checked")){
			var is_check = 1;
		}
		jQuery("#arr_qqfs_options-spinner").addClass("is-active");
		jQuery.ajax({
			url: qqfs_admin_url,
			type: 'POST',
			data:  {
						action: "ws247_quote_qqfs_checkbox_sortcontainer",
						pt_type : pt_type,
						is_check : is_check
					},
			dataType: 'json',
			success: function(data, textStatus, jqXHR){ //console.log(data); //return false;
				jQuery("#arr_qqfs_options-spinner").removeClass("is-active");
			},
			error: function(jqXHR, textStatus, errorThrown){
			
			}          
		});
	});
}

function ws247_create_quote_qqfs_sortable(){
	jQuery( "#qqfs-option-bx, #qqfs-option-bx-rel" ).sortable({
			connectWith: ".connectedSortable",
			update: function(e, ui) {
				var sortable_id = jQuery(this).attr("id");
				if( sortable_id =='qqfs-option-bx-rel'){ 
					var postid = jQuery('#'+sortable_id).data('postid');
					var hdn_postmeta_id = jQuery('#'+sortable_id).data('postmeta');
					var s_order = jQuery('#'+sortable_id).sortable('toArray').toString();
					jQuery("#"+hdn_postmeta_id).val(s_order);
					if(postid>0){
						jQuery("#quote_qqfs_steps .spinner").addClass("is-active");
						jQuery.ajax({
							url: qqfs_admin_url,
							type: 'POST',
							data:  {
										action: "ws247_create_quote_qqfs_sortable",
										s_order : s_order,
										postid : postid
									},
							dataType: 'json',
							success: function(data, textStatus, jqXHR){ //console.log(data); //return false;
								jQuery("#quote_qqfs_steps .spinner").removeClass("is-active");
							},
							error: function(jqXHR, textStatus, errorThrown){
							
							}          
						});
					}
				}
			}
		}).disableSelection();
}

function ws247_quote_qqfs_add_option(){
	jQuery("#js_ws247_quote_qqfs_add_option").click(function(e) {
		var qqfs_input_id = jQuery(this).data('input');
		var option_title = jQuery(qqfs_input_id).val();
		if(option_title.length>0){
			jQuery("#quote_qqfs-spinner.spinner").addClass("is-active");
			jQuery.ajax({
				url: qqfs_admin_url,
				type: 'POST',
				data:  {
							action: "ws247_quote_qqfs_add_option",
							option_title : option_title
						},
				dataType: 'json',
				success: function(data, textStatus, jqXHR){ //console.log(data); //return false;
					jQuery("#quote_qqfs-spinner.spinner").removeClass("is-active");
					window.location.reload();
				},
				error: function(jqXHR, textStatus, errorThrown){
				
				}          
			});
		}
	});
}

function ws247_quote_qqfs_del_option(){
	jQuery(".js_ws247_quote_qqfs_del_option").click(function(e) {
		if( confirm(qqfs_confirm_del) ){
			 var qqfs_id = jQuery(this).data('id');
				if(qqfs_id){
					jQuery.ajax({
						url: qqfs_admin_url,
						type: 'POST',
						data:  {
									action: "ws247_quote_qqfs_del_option",
									qqfs_id : qqfs_id
								},
						dataType: 'json',
						success: function(data, textStatus, jqXHR){ //console.log(data); //return false;
							window.location.reload();
						},
						error: function(jqXHR, textStatus, errorThrown){
						
						}          
					});
				}
		}
		return false;
	});
}