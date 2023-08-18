jQuery(document).ready(function(e) {
	//---------------------------------
	jQuery(".menu-btn.mobile-nav-toggler").click(function(e) {
		var container_wg_id = jQuery(this).data('ctid');
		
		if( jQuery(container_wg_id + " .header-main-nav").hasClass('open') ){
			jQuery(container_wg_id + " .header-main-nav, body").removeClass('open');
			jQuery(container_wg_id + " .header-navbar .closeMask").hide();
		}else{
			jQuery(container_wg_id + " .header-main-nav, body").addClass('open');
			jQuery(container_wg_id + " .header-navbar .closeMask").show();
		}
	});
	
	//----------------------------------
	jQuery(".mobile-close-btn.mobile-nav-toggler, .closeMask").click(function(e) {
		 jQuery(".menu-btn.mobile-nav-toggler").click();
	});
	
	jQuery(".header-main-nav .mainmenu-nav .mainmenu>li.menu-item-has-children a").click(function(e) {
		var li_parent = jQuery(this).parent();
		if( jQuery(li_parent).hasClass('open') ){
			jQuery(li_parent).removeClass('open');
			jQuery(li_parent).find(".axil-submenu").slideToggle(400);
		}else{
			jQuery(li_parent).addClass('open');
			jQuery(li_parent).find(".axil-submenu").slideToggle(400);
		}
		return false;
	});
	
});