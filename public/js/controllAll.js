$(document).ready(function() {
	var $container = $('#wrapper');
	$container.imagesLoaded(function(){
	  $container.masonry({
	    itemSelector : '.box',
		isAnimated: true
	  });
	});
	$(".popup").colorbox({
		transition:"none",
		width:"660px",		
		scrolling: false
	});
})