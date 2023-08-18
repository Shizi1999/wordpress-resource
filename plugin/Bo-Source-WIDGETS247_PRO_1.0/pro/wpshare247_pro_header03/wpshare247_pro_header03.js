jQuery(document).ready(function(e) {
	//----------------------
	jQuery(".content-wg-wpshare247_pro_header03 #top-search-trigger").click(function(e) {
        var container_wg = jQuery(this).data('container');
		
		if( jQuery(container_wg + " .top-search-parent").hasClass('position-relative') ){
			jQuery(container_wg + " .top-search-parent").removeClass("position-relative");
			jQuery("body").removeClass("top-search-open");
		}else{
			jQuery(container_wg + " .top-search-parent").addClass("position-relative");
			jQuery("body").addClass("top-search-open");
		}
		
		return false;
    });
	
	//----------------------
	jQuery( window ).scroll(function() {
		var top = jQuery(window).scrollTop();
		if(top > 100){
			jQuery(".content-wg-wpshare247_pro_header03 header.header-fixed-scroll").addClass('sticky-header');
		}else{
			jQuery(".content-wg-wpshare247_pro_header03 header.header-fixed-scroll").removeClass('sticky-header');
		}
		//console.log(top);
	});
	
	//----------------------
	jQuery(".content-wg-wpshare247_pro_header03 .primary-menu-trigger").click(function(e) {
		 var container_wg = jQuery(this).data('container');
		 
		 if( jQuery(container_wg).hasClass('primary-menu-open') ){
			jQuery(container_wg + " .menu-container").slideToggle();
			jQuery(container_wg).removeClass("primary-menu-open");
		}else{
			jQuery(container_wg + " .menu-container").slideToggle();
			jQuery(container_wg).addClass("primary-menu-open");
		}
		
		
		jQuery(container_wg + " .sub-menu-container").hide();
		 
        return false;
    });
	
	
	jQuery(".content-wg-wpshare247_pro_header03 .menu-container .menu-item-has-children > a").click(function(e) {
		var ul_next = jQuery(this).next();
		jQuery(ul_next).slideToggle();
		return false;
	});
});