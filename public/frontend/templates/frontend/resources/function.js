$(document).ready(function() {
	var wd_width = $(window).width();
	if(wd_width < 1220 && $('.subcategories-bar')) {
		$('.subcategories-bar').click(function(event) {
			$(this).parents('.homepage-category').find('.subcategories-list').slideToggle();
			event.preventDefault();
		});
	}
	$('.subcategories-list, .subcategories-bar').click(function(e) { 
		var e = window.event || e; 
		e.stopPropagation(); 
	});
	// $(document).click(function(e) { 
		// $('.homepage-category .subcategories-list').hide(); 
	// });
});