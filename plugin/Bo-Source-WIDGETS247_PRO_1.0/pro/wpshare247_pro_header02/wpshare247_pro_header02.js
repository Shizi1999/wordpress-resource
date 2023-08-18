jQuery(document).ready(function(e) {
	jQuery(".navbar-menu-button").click(function(e) {
		var container_e = jQuery(this).data("container");
		var primaryMenu_e = jQuery(this).data("target");
		
		if( jQuery(primaryMenu_e).hasClass('show') ){
			jQuery(primaryMenu_e).removeClass('show');
			jQuery(container_e).find(".offcanvas-backdrop").removeClass('show fade');
		}else{
			jQuery(primaryMenu_e).addClass('show');
			jQuery(container_e).find(".offcanvas-backdrop").addClass('fade show');
		}
	});
	
	jQuery(".btn-close.lead, .offcanvas-backdrop").click(function(e) {
		var container_e = jQuery(this).data("container");
		jQuery(container_e).find(".navbar-menu-button").click();
	});
	
	
	jQuery("header #primaryMenu li.menu-item-has-children>a").click(function(e) {
		var ul_next = jQuery(this).next();
		if( jQuery(ul_next).hasClass('show') ){
			jQuery(ul_next).removeClass('show');
		}else{
			jQuery(ul_next).addClass('show');
		}
		return false;
	});
});