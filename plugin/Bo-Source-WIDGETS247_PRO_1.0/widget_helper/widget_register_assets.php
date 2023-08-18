<style>
	#widgets-left [id*="wpshare247"] .widget-top{ background:#00bcd4 !important;}
	#widgets-left [id*="wpshare247_pro"] .widget-top{ background:#ff9800 !important;}
	#widgets-left [id*="wpshare247_pro"] .widget-description{ padding:0 !important;}
	
	.wpshare247-pro-thumb{ display:none; }
	#widgets-left [id*="wpshare247_pro"] .wpshare247-pro-thumb{ display:block; }
	
	#widgets-left .widget:not(.widget-in-question) .wpshare247-pro-thumb img{ width:100%; height:auto; }
	
	#widgets-left [id*="wpshare247"] .widget-top .widget-title h3{ color:#fff; }
	.widget-content [id^=div_]{
		display: block;
		text-align: center;
		background: #f1f1f1;
		margin-bottom: 8px;
		margin-top: 5px;
		padding: 9px;
		border: 1px dashed #c1c1c1;
		position:relative;
	}
	.repeat-sortable-container .sortable-item label{ font-weight:bold; }
	.repeat-sortable-container .sortable-item{
		border: 1px solid #ccd0d4;
		box-shadow: 0 1px 1px rgba(0,0,0,.04);
		padding: 0 15px;
		margin-bottom: 10px;
		background: #fafafa;
		position:relative;
		cursor:move;
		overflow:hidden;
		position:relative;
		max-height:2000px;
		/*transition:all .5s;*/
	}.repeat-sortable-container .sortable-item .remove, .nremove{
		position: absolute;
		right: 0;
		color: #f00;
		border: 0;
		text-decoration: unset;
		z-index:4;
	}.repeat-sortable-container .sortable-item.default .remove{
		display:none;
	}.repeat-image-container{ 
		display: block;
		text-align: center;
		background: #f1f1f1;
		margin-bottom: 8px;
		margin-top: 5px;
		padding: 9px;
		border: 1px dashed #c1c1c1;
	}.repeat_sortable_add_new{ margin-bottom: 10px; }
	
	.repeat-sortable-container .sortable-item.sortable-min{
		max-height:30px;
	}.repeat-sortable-container .sortable-item.sortable-min:before{
		content:"";
		position:absolute;
		z-index:1;
		top:0;
		bottom:0;
		left:0;
		width:100%;
		height:100%;
		background:#efefef;
	}.repeat-sortable-container .sortable-item .dashicons-arrow-up-alt2{
		position:absolute;
		top:6px;
		left:50%;
		transform:translateX(-50%);
		z-index:5;
		cursor:pointer;
		transition:all .5s;
	}.repeat-sortable-container .sortable-item.sortable-min .dashicons-arrow-up-alt2{
		transform:translateX(-50%) rotate(180deg);
	}
	.linearicons_class-container > span{ font-size:40px; }
	.wpshare247-gallery > li{ 
		width: 20%;
		display: inline-block;
		position: relative;
		border: 1px solid #ccc;
		margin-right: 5px;
		cursor: pointer;
		padding: 5px;
	}.wpshare247-gallery > li img{ width:100%; }
	
	.wpshare247_autocomplete_results{ 
		margin: 0;
		position: absolute;
		width: 100%;
		top: 52px;
	}
	.wpshare247_autocomplete_results li{ background:#00bcd4; padding:5px 10px; margin:0; }
	.wpshare247_autocomplete_results li a{ color:#fff; cursor:pointer; }
	.wpshare247-100{ width:100% !important; }
	.wp247-file-size{ display:block; }
</style>
	
<script>
	jQuery( document ).ajaxComplete(function( event, xhr, settings ) {
		var settings_data = settings.data; console.log(settings.data);
		if( settings_data.indexOf('action=widgets-order') > -1 && settings_data.indexOf('savewidgets') > -1){ 
			location.reload();
		}
	});
	
	jQuery(document).ready(function($){
		ws247_init_autocomplete_field();
		
		//ân widget mặc định
		//jQuery('#widgets-left #widget-list>div:not([id*="wpshare247_pro"])').hide();
	});
	
	
	function ws247_init_autocomplete_field(){
		jQuery( ".wpshare247-autocomplete" ).keyup(function() {
			var inp = jQuery(this);
			var inp_rel = jQuery(this).attr("rel");
			var inp_id = jQuery(inp).attr('id'); //alert(inp_id);
			if(inp_id=='' || inp_id == undefined){
				inp_id = 'return_text_'+inp_rel;
				jQuery(inp).attr('id', inp_id);
			}
			
			var parent = inp.parent();
			if(jQuery(parent).find(".wpshare247_autocomplete_results").length){
				jQuery(parent).find(".wpshare247_autocomplete_results").html('');
			}else{
				jQuery(parent).append('<ul class="wpshare247_autocomplete_results"></ul>');
			}
			
			jQuery("#"+inp_rel).val('');
			
			var text_enter = jQuery(this).val();
			var post_type = jQuery(this).data('post');
			if(text_enter.length>1){
				var data = {
							action: 'ws247_init_autocomplete_field', 
							text_enter: text_enter, 
							inp_rel : inp_rel, 
							inp_id : inp_id,
							post_type : post_type
							};
				jQuery.post(ajaxurl , data, function (response) {
					//console.log(response); //return false;
					var html = response.html;
					if(html.length>0){
						jQuery(parent).find(".wpshare247_autocomplete_results").html(html);
					}	
				});
			}else{
				jQuery(parent).find(".wpshare247_autocomplete_results").html('');
			}
			//console.log(  text_enter  );
		
		});
	}
	
	function wpshare247_autocomplete_close(){
		jQuery(".wpshare247_autocomplete_results").html("");
	}
	
	function wpshare247_auto_complete_click(li, field, post_id, inp_id){
		jQuery("#"+field).val(post_id);
		jQuery("#"+inp_id).val( jQuery(jQuery(li).find("a").get(0)).text() );
		wpshare247_autocomplete_close();
		return false;
	}

	
	/*jQuery(document).on('widget-added', function(e, widget){
		//console.log(widget);
		location.reload();
	});*/
	
	function hide_this_block(e){
		var li_parent = jQuery(e).parent();
		if( jQuery(li_parent).hasClass('sortable-min') ){
			jQuery(li_parent).removeClass('sortable-min');
		}else{
			jQuery(li_parent).addClass('sortable-min');
		}
	}
	
	function wle_repeat_sortable_add_new(e){
		var container_e = jQuery(e).parent();
		var sortable_e = jQuery(container_e).find(".repeat-sortable-container").get(0); 
		var default_it = jQuery(sortable_e).find(".default").get(0);
		var clone_it = jQuery(default_it).clone();
		
		jQuery(clone_it).removeClass('default sortable-min');
		jQuery(clone_it).find('.reset_data').val('');
		jQuery(clone_it).find('.repeat-image-container').remove();
		jQuery(clone_it).find('.linearicons_class-container').remove();
		
		//Image Input
		var rand_string = Math.random().toString(36).substring(7);
		var new_img_id = 'clone_image_'+rand_string;
		var img_e = jQuery(clone_it).find('[data-type="image"]').get(0);
		jQuery(img_e).attr("id", new_img_id);
		
		var new_btn_image_id = 'clone_btn_image_'+rand_string;
		var btn_image_e = jQuery(clone_it).find('.btn_image').get(0);
		jQuery(btn_image_e).attr("id", new_btn_image_id);
		jQuery(btn_image_e).attr("data-input", new_img_id);
		
		//linearicons Input
		var rand_string = Math.random().toString(36).substring(7);
		var new_linearicons_id = 'clone_linearicons_'+rand_string;
		var linearicons_e = jQuery(clone_it).find('[data-type="linearicons"]').get(0);
		jQuery(linearicons_e).attr("id", new_linearicons_id);
		
		var new_btn_linearicons_id = 'clone_btn_linearicons_'+rand_string;
		var btn_linearicons_e = jQuery(clone_it).find('.btn_linearicons').get(0);
		jQuery(btn_linearicons_e).attr("id", new_btn_linearicons_id);
		jQuery(btn_linearicons_e).attr("data-input", new_linearicons_id);
		
		
		jQuery(sortable_e).append(clone_it);
		
		return false;
	}
	
	function wle_repeat_sortable_remove_me(e){
		if(confirm('Bạn có chắc xóa phần tử này không?')){
			var parent_e = jQuery(e).parent();
			var eSortable = jQuery(parent_e).parent();
			
			jQuery(parent_e).remove();
			wle_repeat_sortable_save_data(eSortable);
		}
		return false;
	}
	
	
	function wle_repeat_sortable_update_data( e ){
		var pe = jQuery(e).parent();
		var lie = jQuery(pe).parent();
		var eSortable = jQuery(lie).parent();
		
		wle_repeat_sortable_save_data(eSortable);
	}
	
	//-------------------------MAIN FUNCTION--------------
	function wle_repeat_sortable_save_data(eSortable){ 
		var container_e = jQuery(eSortable).parent();
		var container_id = jQuery(container_e).attr("id");
		
		var arr = jQuery(eSortable).find(".sortable-item");
		var new_data_save = {};
		
		jQuery(arr).each(function(index, element) {
			var new_arr = {};
			
			var arr_f = jQuery(this).find('.f_save_data');
			jQuery(arr_f).each(function(index2, element2) {
				var type = jQuery(element2).data('type');
				var name = jQuery(element2).attr("name");
				var val = jQuery(element2).val();
				var label = jQuery(element2).data('label');
				
				//-------------------------------------------------
				new_arr[name] = {type:type, label: label, val:val};
				new_data_save[index] = new_arr;
			});
		});
		
		var s_data_save = JSON.stringify(new_data_save);
		jQuery("#"+container_id+" .repeat_sortable_data").val(s_data_save);
		//console.log(s_data_save);
		jQuery("input.widget-control-save").removeAttr('disabled');
	}
	
	function wle_init_repeat_sortable_stop(sortable_ele){ 
		jQuery(sortable_ele).sortable({
			stop: function (event, ui) {
				var eSortable = jQuery(this);
				wle_repeat_sortable_save_data(eSortable);
				
				//enable save
				jQuery("input.widget-control-save").removeAttr('disabled');
			}
		});
	}
	
	function wle_init_repeat_sortable(){
		var arr_blocks = jQuery("#widgets-right .big_container_block");
		if(arr_blocks.length){
			arr_blocks.each(function(index, element) {
				var big_container_block_id = jQuery(this).attr("id");
				if(big_container_block_id==undefined){
					big_container_block_id = 'big_container_block'+Math.random().toString(36).substring(7);
					jQuery(this).attr("id", big_container_block_id);
				}
				
				var sortable_ele = jQuery("#"+big_container_block_id +" .repeat-sortable-container").get(0);
				wle_init_repeat_sortable_stop( sortable_ele );
			});
		}
	}
	
	function wle_widget_media_remove(e, input_id){
		if(confirm('Bạn có chắc xóa hay không?')){
			jQuery(e).parent().remove();
			jQuery("#"+input_id).val('');
		}
		return false;
	}
	
	function wle_init_repeat_click_media( e){
		var id = jQuery(e).attr("id");
		
		var input_id = jQuery(e).attr('data-input'); 
		var div_id = 'div_'+id;
		
		//e.preventDefault();
		var frame_multiple_wop = false;
		
		if (frame_multiple_wop) {
			frame_multiple_wop.open();
			return;
		}
		
		//Select many photos
		var is_multiple = false;
		
		frame_multiple_wop = wp.media({
			multiple: is_multiple
		});

		// Register Event
		frame_multiple_wop.on( "select", function() {
			var selection = frame_multiple_wop.state().get('selection');
				selection.map( function( attachment ) {
					attachment = attachment.toJSON();
					//console.log(attachment);
					
					var bg_url = attachment.url;
					jQuery("#"+input_id).val(bg_url);
					if(attachment.sizes.thumbnail==undefined){
						var thumb_url = attachment.url;
					}else{	
						var thumb_url = attachment.sizes.thumbnail.url;
					}
					
					
					var div_id_count = 1*jQuery('#'+div_id).length;
					if(div_id_count==0){
						jQuery("#"+input_id).before('<div class="repeat-image-container" id="'+div_id+'"><img src="'+thumb_url+'" /></div>');
						
					}else{
						jQuery('#'+div_id + ' img').attr('src', thumb_url);
					}
					jQuery("input.widget-control-save").removeAttr('disabled');
					
					//console.log(input_id);
					wle_repeat_sortable_update_data( jQuery("#"+input_id) );
					
				});
				
				// Close the media frame_multiple_wop
				frame_multiple_wop.close();
		});
		
		// Show media frame_multiple_wop
		frame_multiple_wop.open();
		//------------------------------------------------------------------------
		
		return false;
	}
	
	function linearicons_popup_remove(){
		jQuery("#vbgr_linearicons_popup").hide();
		jQuery(".btn_linearicons.linearicons_selecting").removeClass("linearicons_selecting");
		return false;
	}
	
	function wle_init_repeat_show_linearicons_popup( e ){
		jQuery(e).addClass("linearicons_selecting");
		jQuery("#vbgr_linearicons_popup").show();
		return false;
	}
	
	function initClickMedia( id ){ //alert(id); return false;
		jQuery('#'+id).on('click',function(e){
			var input_id = jQuery(this).data('input'); 
			var div_id = 'div_'+id;
			
			e.preventDefault();
			var frame_multiple_wop = false;
			
			if (frame_multiple_wop) {
				frame_multiple_wop.open();
				return;
			}
			
			//Select many photos
			var is_multiple = false;
			
			frame_multiple_wop = wp.media({
				multiple: is_multiple
			});

			// Register Event
			frame_multiple_wop.on( "select", function() {
				var selection = frame_multiple_wop.state().get('selection');
					selection.map( function( attachment ) {
						attachment = attachment.toJSON();
						//console.log(attachment);
						
						var bg_url = attachment.url;
						jQuery("#"+input_id).val(bg_url);
						if(attachment.sizes.thumbnail==undefined){
							var thumb_url = attachment.url;
						}else{	
							var thumb_url = attachment.sizes.thumbnail.url;
						}
						
						var div_id_count = 1*jQuery('#'+div_id).length;
						if(div_id_count==0){
							jQuery("#"+input_id).before('<span id="'+div_id+'" class="wle_widget_media"><a class="nremove" onClick="wle_widget_media_remove(this,\''+input_id+'\');"><span class="dashicons dashicons-no-alt"></span></a><img src="'+thumb_url+'" /></span>');
						}else{
							jQuery('#'+div_id + ' img').attr('src', thumb_url);
						}
						jQuery("input.widget-control-save").removeAttr('disabled');
						
					});
					
					// Close the media frame_multiple_wop
					frame_multiple_wop.close();
			});
			
			// Show media frame_multiple_wop
			frame_multiple_wop.open();
		});//------------------------------------------------------------------------
		
		return false;
	}
	
	//-----------------------Gallery
	function wle_gallery_remove_me(e){
		if(confirm('Bạn có chắc xóa phần tử này không?')){
			var parent_e = jQuery(e).parent();
			var eSortable = jQuery(parent_e).parent();
			
			jQuery(parent_e).remove();
			wle_gallery_sortable_save_data(eSortable);
		}
		return false;
	}
	
	function wle_gallery_sortable_save_data(eSortable){ 
		var container_e = jQuery(eSortable).parent();
		var container_id = jQuery(container_e).attr("id");
		
		var arr = jQuery(eSortable).find(".sortable-item");
		var new_arr = {};
		
		jQuery(arr).each(function(index, element) {
			var attachment_id = jQuery(this).data('id');
			new_arr[index] = attachment_id;
		});
		
		//console.log(new_arr);
		var s_data_save = JSON.stringify(new_arr); 
		jQuery(jQuery(eSortable).next()).val(s_data_save);
		
		jQuery("input.widget-control-save").removeAttr('disabled');
	}
	
	function wle_init_gallery_sortable(){
		var arr_blocks = jQuery("#widgets-right .wpshare247-gallery");
		if(arr_blocks.length){
			arr_blocks.each(function(index, element) {
				var big_container_block_id = jQuery(this).attr("id");
				if(big_container_block_id==undefined){
					big_container_block_id = 'wpshare247_gallery'+Math.random().toString(36).substring(7);
					jQuery(this).attr("id", big_container_block_id);
				}
				
				var sortable_ele = jQuery("#"+big_container_block_id).get(0);
				wle_init_gallery_sortable_stop( sortable_ele );
			});
		}
	}
	
	function wle_init_gallery_sortable_stop(sortable_ele){ 
		jQuery(sortable_ele).sortable({
			stop: function (event, ui) {
				var eSortable = jQuery(this);
				wle_gallery_sortable_save_data(eSortable);
				
				//enable save
				jQuery("input.widget-control-save").removeAttr('disabled');
			}
		});
	}
	
	function initClickGallery( id ){ //alert(id); return false;
		jQuery('#'+id).on('click',function(e){
			var input_id = jQuery(this).data('input'); 
			var div_id = 'div_'+id;
			
			e.preventDefault();
			var frame_multiple_wop = false;
			
			if (frame_multiple_wop) {
				frame_multiple_wop.open();
				return;
			}
			
			//Select many photos
			var is_multiple = true;
			
			frame_multiple_wop = wp.media({
				multiple: is_multiple
			});
			
			var new_arr = {};
			
			// Register Event
			frame_multiple_wop.on( "select", function() {
				var selection = frame_multiple_wop.state().get('selection');
					selection.map( function( attachment ) {
						attachment = attachment.toJSON();
						//console.log(attachment);
						
						var attachment_id = attachment.id;
						new_arr[attachment_id] = attachment_id;
						
						//jQuery("#"+input_id).val(bg_url);
						if(attachment.sizes.thumbnail==undefined){
							var thumb_url = attachment.url;
						}else{	
							var thumb_url = attachment.sizes.thumbnail.url;
						}
						
						var div_id_count = 1*jQuery('#'+div_id).length;
						if(div_id_count==0){
							jQuery("#"+input_id).before('<ul id="'+div_id+'" class="wle_widget_media wpshare247-gallery wle-sortable"></ul>');
						}
						
						jQuery('#'+div_id).append('<li data-id="'+attachment_id+'" class="sortable-item"><a href="#" class="remove nremove" onclick="wle_gallery_remove_me(this); return false;"><span class="dashicons dashicons-no-alt"></span></a><img src="'+thumb_url+'" /></li>');
						
						wle_init_gallery_sortable_stop( jQuery('#'+div_id) );
						
						//----------
						jQuery("input.widget-control-save").removeAttr('disabled');
						
					});
					var eSortable = jQuery('#'+div_id);
					wle_gallery_sortable_save_data(eSortable);
					
					//alert(jQuery("#"+input_id).val());
					
					// Close the media frame_multiple_wop
					frame_multiple_wop.close();
			});
			
			// Show media frame_multiple_wop
			frame_multiple_wop.open();
		});//------------------------------------------------------------------------
		
		return false;
	}
	
	// type = [video, audio, application, image]
	function init_Click_file( id, type){ //alert(id); return false;
		jQuery('#widgets-right #'+id).on('click',function(e){  
			var input_id = jQuery(this).data('input'); 
			var div_id = 'div_'+id;
			
			e.preventDefault();
			var frame_multiple_wop = false;
			
			if (frame_multiple_wop) {
				frame_multiple_wop.open();
				return;
			}
			
			//Select many photos
			var is_multiple = false;
			
			if(!type) type = 'video';
			
			frame_multiple_wop = wp.media({
				multiple: is_multiple,
				library: { // https://wordpress.com/support/accepted-filetypes/
						type: [ type ]
				},
			});
			
			

			// Register Event
			frame_multiple_wop.on( "select", function() {
				var selection = frame_multiple_wop.state().get('selection');
					selection.map( function( attachment ) {
						attachment = attachment.toJSON();
						//console.log(attachment);
						
						var url = attachment.url;
						
						if(attachment.thumb!=undefined){
							var thumb_url = attachment.thumb.src;
						}
						
						jQuery("#"+input_id).val(url);
						
						var file_html = '<a class="nremove" onClick="wle_widget_media_remove(this,\''+input_id+'\');"><span class="dashicons dashicons-no-alt"></span></a>';
						
						switch(type){
							case "application":
								var icon = attachment.icon;
								var file_size = attachment.filesizeHumanReadable; 
								var filename = attachment.filename;
								file_html = file_html + '<a href="'+url+'" target="_blank"><img src="'+icon+'" /><span class="wp247-file-size">'+filename+'('+file_size+')</span></a>';
							break;
							
							default:
								file_html = file_html + '<video class="wpshare247-100" width="100" height="150" preload="metadata" controls="controls"><source type="video/mp4" src="'+url+'" /><a href="'+url+'">'+url+'</a></video>';
							break;
						}
						
						var div_id_count = 1*jQuery('#'+div_id).length;
						
						if(div_id_count==0){ 
							jQuery("#"+input_id).before('<span id="'+div_id+'" class="wle_widget_media">'+file_html+'</span>');
						}else{  
							jQuery('#'+div_id).html(file_html);
						}
						
						jQuery("input.widget-control-save").removeAttr('disabled');
						
					});
					
					// Close the media frame_multiple_wop
					frame_multiple_wop.close();
			});
			
			// Show media frame_multiple_wop
			frame_multiple_wop.open();
		});//------------------------------------------------------------------------
		
		return false;
	}
	
	
</script>