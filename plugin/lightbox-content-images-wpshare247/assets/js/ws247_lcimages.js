jQuery(document).ready(function(e) {
	var prefix_gallery = 'ws247-lcimages-gallery';
	//Single Image
	var arr_content_imgs = jQuery('.lightbox-lcimages img');
	if(arr_content_imgs.length){
		arr_content_imgs.each(function(index, element) {
			var img_parent = jQuery(this).parent();
			var tag_name = jQuery(img_parent).prop("tagName");
			if(tag_name != 'A'){
				var src = jQuery(this).attr("src");
				jQuery(this).wrap( "<a data-fancybox='"+prefix_gallery+"' href='"+src+"'></a>" );
			}else{
				jQuery(img_parent).attr('data-fancybox', prefix_gallery);
			}
		});
	}
	
	//WordPress Gallery Classic Editor
	if(jQuery('.lightbox-lcimages .gallery').length){
		jQuery('.lightbox-lcimages .gallery').each(function(index, element) {
			var gallery_id = jQuery(this).attr("id");
			jQuery(this).find(".gallery-item a").attr("data-fancybox", gallery_id );
		});
	}
	
	//WordPress Gutenberg Editor
	if(jQuery('.lightbox-lcimages .wp-block-gallery').length){
		jQuery('.lightbox-lcimages .wp-block-gallery').each(function(index, element) {
			var gallery_id = prefix_gallery +'-'+ Math.floor((Math.random() * 999999) + 1);
			jQuery(this).find("figure a").attr("data-fancybox", gallery_id );
		});
	}
	
	//Check a tag href if not image type
	jQuery(".lightbox-lcimages a").each(function(index, element) {
		var img_parent_href = jQuery(this).attr("href"); 
		if (!(/(jpg|gif|png|JPG|GIF|PNG|JPEG|jpeg)$/.test(img_parent_href))){
			var img_child = jQuery(this).find('img').get(0);
			var srcset = jQuery(img_child).attr('srcset'); 
			if (typeof srcset !== 'undefined' && srcset !== false) {
				var arr_srcset = srcset.split(',');
				if(arr_srcset[arr_srcset.length-1]){
					var last_srcset = arr_srcset[arr_srcset.length-1];
					var arr_src = last_srcset.split(' ');
				}
				jQuery(this).attr('href', arr_src[1]);
			}else{
				var src = jQuery(img_child).attr('src');
				jQuery(this).attr('href', src);
			}
		}
		
		//Add caption
		var figcaption_tag = jQuery(this).next();
		var figcaption_tag_name = jQuery(figcaption_tag).prop("tagName");
		if(figcaption_tag_name=='FIGCAPTION'){
			jQuery(this).data('caption', jQuery(figcaption_tag).html());
		}else{
			var parent_gallery = jQuery(this).parent();
			var figcaption_tag = jQuery(parent_gallery).next();
			var figcaption_tag_name = jQuery(figcaption_tag).prop("tagName");
			if(figcaption_tag_name=='FIGCAPTION'){
				jQuery(this).data('caption', jQuery(figcaption_tag).html());
			}
		}
	});	
});