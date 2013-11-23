
jQuery(document).ready(function($){
	
		
	var 
	$mainContent = $('.main-content'),
	$newsContainer = $('#news-container'),
	totalSlides = $('#news-container > div').length;
	currentSlide = 0;


	/* = Supersized Initialization
	---------------------------------- */
	$.supersized({
		autoplay				:   0,
		slide_interval          :   3000,		
		transition              :   1, 	
		slides  :  	[ {image : IMG_DIR + "/bg-1.jpg"} ,
					  {image : IMG_DIR + "/bg-2.jpg"} ,
					  {image : IMG_DIR + "/bg-3.jpg"} ,
					  {image : IMG_DIR + "/bg-4.jpg"} ,
					  {image : IMG_DIR + "/bg-5.jpg"} ,
					  {image : IMG_DIR + "/bg-6.jpg"} ,
					  {image : IMG_DIR + "/bg-7.jpg"} ,
					  {image : IMG_DIR + "/bg-8.jpg"} ,
					  {image : IMG_DIR + "/bg-9.jpg"} 
					]
	});	
	
	
	
	/* = AjaxLoading and deeplink
	---------------------------------- */
	$('.nav ul.menu a').click(function() {
		
		api.nextSlide();
		
		$(this).parent().siblings().removeClass("current-menu-item");
		$(this).parent().addClass("current-menu-item");
		
		var path = $(this).attr('href').replace(base, '');
		$.address.value(path);
		return false;
		
	});
	
	$('body').on('click','h2.entry-title a',function() {
		
		var path = $(this).attr('href').replace(base, '');
		$.address.value(path);
		return false;
		
	});
	
	
	$.address.change(function(event) {
			
		var current = location.protocol + '//' + location.hostname + ((location.port)?':'+location.port:'')+ location.pathname;
		if (event.value){
			if(event.value != '/'+location.hash){
				$mainContent.slideUp('fast', function(){
					$mainContent.empty().load(base + event.value + ' .inner', function(response){
						$.get('/wp-content/plugins/contact-form-7/includes/js/scripts.js', function(data) { eval(data); });
						var $dom = $(document.createElement("html"));
						$dom[0].innerHTML = response;
						
						$('body').attr('class',$dom.find('body').attr('class'));
	
						$mainContent.slideDown('fast');
						
					});
				})
			}
		}
					
		if (base != current) {		
		
			var diff = current.replace(base, '');
			location = base + '#' + diff;
		}	
				
	});
	
	
	
	/* = Arrow News Animation
	---------------------------------- */	
	$('.arrow-next').click(function(){
		currentSlide += (currentSlide+1 < totalSlides) ? 1 : 0;
		$newsContainer.animate({ 'margin-left':-(currentSlide*380) });
	})
	
	$('.arrow-prev').click(function(){
		currentSlide -= (currentSlide) ? 1 : 0;
		$newsContainer.animate({ 'margin-left':-(currentSlide*380) });
	})
	

		
	
	
		
})