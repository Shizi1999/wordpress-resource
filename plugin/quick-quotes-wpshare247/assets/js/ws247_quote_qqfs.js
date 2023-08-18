jQuery(document).ready(function(e) {
	ws247_quote_qqfs_start();
	ws247_quote_qqfs_reset();
	ws247_quote_qqfs_checkbox();
});

function ws247_quote_qqfs_validate_email(email) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	return emailReg.test( email );
}

function ws247_quote_qqfs_checkbox(){
	jQuery(document).on('click', '.ws247-quote-qqfs-content .form-check-input', function(){
		var is_choose_one = false; var amount_diff = 0;
		var checkbox_id = jQuery(this).attr('id');
		if( jQuery(this).hasClass('quote-qqfs-choose-one') ){
			var is_choose_one = true;
			var group = jQuery(this).data('group');
			if(jQuery('input.is-active[data-group="'+group+'"]').length){
				var first_checked = jQuery('input.is-active[data-group="'+group+'"]').get(0);
				var amount_diff =  1*jQuery(first_checked).data('amount'); 
			}
			jQuery('input.is-active[data-group="'+group+'"]').removeClass("is-active");
			jQuery('input[data-group="'+group+'"]').not( "#"+checkbox_id ).prop('checked', false);
		}
		
		var amount = 1*jQuery(this).data('amount'); 
		var container_id = jQuery(jQuery(this).parents('.ws247-quote-qqfs-shortcode').get(0)).attr('id');
		
		var new_amount = amount - amount_diff; 
		
		if( jQuery("#"+checkbox_id).is(":checked")){
			jQuery("#"+checkbox_id).addClass("is-active");
		}else{
			new_amount = -amount;
		}
		
		ws247_quote_qqfs_update_total(container_id, new_amount);
	});
}

function ws247_quote_qqfs_update_total(container_id, amount){
	var total = jQuery("#"+container_id +" .quote-qqfs-total .amount").data('amount'); 
	var new_total = total*1 + amount*1; 
	//----------
	var new_total_format = ws247_quote_qqfs_format_money(new_total, ws247_price_thousand_sep, ws247_price_num_decimals);
	jQuery("#"+container_id +" .quote-qqfs-total .amount").data('amount', new_total);
	jQuery("#"+container_id +" .quote-qqfs-total .amount").html(new_total_format);
}

function ws247_quote_qqfs_reset(){
	jQuery(document).on('click', '.js-ws247-quote-qqfs-reset', function(){
		var btn_next = jQuery(this).next();
		var i_step = jQuery(btn_next).data('step'); 
		if(i_step>1 || i_step==-1){
			jQuery(btn_next).data('step', 0); 
			jQuery(btn_next).click();
			
			var container_id = '#'+jQuery(btn_next).data('container'); 
			jQuery(container_id +" .quote-qqfs-total .amount").data('amount', 0);
			jQuery(container_id +" .quote-qqfs-total .amount").html(0);
		}
	});
}

//Validate Quote Form
function ws247_quote_qqfs_validate_form(container_id){
	var err = 0;
	jQuery(container_id+" .steps-res .form-control").each(function(index, element) {
        var val = jQuery(this).val();
		var e_type = jQuery(this).attr("type");
		if(jQuery(this).hasClass('req')){
			if(val.length < 5){
				jQuery(this).addClass('is-invalid');	
				err++;	
			}else{
				if(e_type=='email'){
					if(!ws247_quote_qqfs_validate_email(val)){
						jQuery(this).addClass('is-invalid');	
						err++;
					}else{
						jQuery(this).removeClass('is-invalid').addClass('is-valid');
					}
				}else{
					jQuery(this).removeClass('is-invalid').addClass('is-valid');
				}
			}
		}else{
			if(val.length){
				jQuery(this).addClass('is-valid');
			}else{
				jQuery(this).removeClass('is-valid');
			}
		}
    });
	return err;
}

function ws247_quote_qqfs_btn_save_form(container_id){
	var form_data_json = '';
	var err = ws247_quote_qqfs_validate_form(container_id);
	if(err==0){
		var quoteid = jQuery(container_id+" .js-ws247-quote-qqfs-start").data("quoteid");
		var form_data = {};
		jQuery(container_id+" .steps-res .form-control").each(function(index, element) {
			var e_id = jQuery(this).attr("id");
			var e_tag_name = jQuery(this).prop("tagName");
			var e_type = jQuery(this).attr("type");
			form_data[e_id] = jQuery(this).val();
		});
		
		var form_data_json = JSON.stringify(form_data);
		if(form_data_json){
			jQuery(container_id+" .js-ws247-quote-qqfs-start").find('.spinner-border').show();
			jQuery.ajax({
				url: ws247_quote_qqfs_ajax_url,
				type: 'POST',
				data:  {
							action: "ws247_quote_qqfs_btn_save_form",
							form_data_json : form_data_json,
							quoteid : quoteid
						},
				dataType: 'json',
				success: function(data, textStatus, jqXHR){ //console.log(data); //return false;
					jQuery(container_id+" .ws247-quote-qqfs-description").html(data.html);
					jQuery(container_id+" .ws247-quote-qqfs-content").remove();
					jQuery(container_id+" .js-ws247-quote-qqfs-start").find('.spinner-border').hide();
				},
				error: function(jqXHR, textStatus, errorThrown){
				
				}          
			});
		}
	}
}

function ws247_quote_qqfs_start(){
	jQuery(".js-ws247-quote-qqfs-start").click(function(e) {
		jQuery(".quote-qqfs-err").hide();
		var btn_e = jQuery(this);
        var quoteid = 1*jQuery(this).data('quoteid');
		var container_id = '#'+jQuery(this).data('container'); 
		var i_step = jQuery(this).data('step'); 
		var i_req = jQuery(this).data('req');
		
		var err = 0;
		if(i_req>0 && i_step>0){
			var is_checked_req = jQuery(container_id+' input:checkbox:checked').length;
			if(is_checked_req==0){
				jQuery(container_id+ " .quote-qqfs-mes.quote-qqfs-err").show();
				return false;
			}
		}
		
		// step = -1 => final step
		if(i_step==-1){
			ws247_quote_qqfs_btn_save_form(container_id);
			return false;
		}
		
		if(quoteid>0 && i_step > -1){ 
			jQuery(container_id+' .quote-qqfs-total').show();
			jQuery(btn_e).find('.spinner-border').show();
			jQuery(btn_e).prop('disabled', true);
			
			var list_ids = '';
			if(jQuery(container_id+" input.form-check-input:checked").length){
				var arr_checked = jQuery(container_id+" input.form-check-input:checked");
				jQuery(arr_checked).each(function(index, element) {
					if(list_ids==''){
						list_ids = jQuery(this).data('id');
					}else{
                    	list_ids = list_ids + ',' + jQuery(this).data('id');
					}
                });
			}
			 
			jQuery.ajax({
				url: ws247_quote_qqfs_ajax_url,
				type: 'POST',
				data:  {
							action: "ws247_quote_qqfs_start",
							quoteid : quoteid,
							i_step : i_step,
							list_ids : list_ids
						},
				dataType: 'json',
				success: function(data, textStatus, jqXHR){ //console.log(data); //return false;
					if(data.error==1){
						var html = data.mes;
					}else{
						var i_next_step = 1*data.i_step;
						jQuery(btn_e).data('step', i_next_step); 
						var html = data.html;
					}
					
					jQuery(container_id + ' .steps-res').html(html);
					
					
					var btn_next_text = data.btn_next_text;
					if(btn_next_text){
						jQuery(btn_e).find('.txt').text(btn_next_text);
					}
					
					var is_req = 1*data.is_req;
					jQuery(btn_e).data('req', is_req); 
					
					var btn_reset = data.btn_reset;
					if(btn_reset){
						if( jQuery(container_id + ' .js-ws247-quote-qqfs-reset').length == 0 ){
							jQuery(btn_e).before(btn_reset);
						}
					}
					jQuery(btn_e).find('.spinner-border').hide();
					jQuery(btn_e).prop('disabled', false);
				},
				error: function(jqXHR, textStatus, errorThrown){
				
				}          
			});
		}
    });
}