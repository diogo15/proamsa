
jQuery(document).ready(function($){
	
		
	var 
	$animWrapper = $('#animation-wrapper'),
	$mainContent = $('.main-content'),
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
	$('.mainNav ul.menu a').click(function() {
		
		api.nextSlide();
		
		$(this).parent().siblings().removeClass("current-menu-item");
		$(this).parent().addClass("current-menu-item");
		
		var path = $(this).attr('href');
		path = addtrailingslash(path).replace(base, '');			
		$.address.value( path );
		
		return false;
		
	});
	$('.company-info a , .footer-logos a').click(function() {
		
		api.nextSlide();
		
		var path = $(this).attr('href').replace(base, '');
		$.address.value(path);
		return false;
		
	});
	
	$('body').on('click','h2.entry-title a , #breadcrumbs a , .wp-pagenavi a , .logo a',function() {
		
		var path = $(this).attr('href');
		path = addtrailingslash(path).replace(base, '');			
		$.address.value( path );
		
		return false;
		
	});
	
	

	$.address.change(function(event) {
		
		var current = location.protocol + '//' + location.hostname + ((location.port)?':'+location.port:'')+ location.pathname;
		if (event.value){
			if(event.value != '/'+location.hash){
				$animWrapper.height($mainContent.height());
				$mainContent.slideUp('fast', function(){
					$mainContent.empty().load(base + event.value + ' .inner', function(response){
						
						$.get('/wp-content/plugins/contact-form-7/includes/js/scripts.js', function(data) { eval(data); });
						
						var photos_per_page = 1;
						var $dom = $(document.createElement("html"));
						$dom[0].innerHTML = response;
						$('body').attr('class',$dom.find('body').attr('class'));
						
						$('.gllr_image_block a').nivoLightbox();
						
						if ($('body').hasClass('page-template-gallery-template-php'))
							photos_per_page = 3;							
						
						$('.entry-content').pajinate({item_container_id : '.gallery', items_per_page:photos_per_page,nav_label_first : '<<', nav_label_last : '>>',	nav_label_prev : '<', nav_label_next : '>'});
						trimTitlesAndExcerpts($('.front-page-post'));
						
						$animWrapper.height($mainContent.height());
						$mainContent.slideDown('fast',function(){
							$animWrapper.height('auto');
						});						
						
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
	$('body').on('click','.arrow-next',function() {
		var $newsContainer = $('#news-container'),
			totalSlides = $('#news-container > div').length;
		currentSlide += (currentSlide+1 < totalSlides) ? 1 : 0;
		$newsContainer.animate({ 'margin-left':-(currentSlide*380) });
	})
	$('body').on('click','.arrow-prev',function() {
		var $newsContainer = $('#news-container'),
			totalSlides = $('#news-container > div').length;
		currentSlide -= (currentSlide) ? 1 : 0;
		$newsContainer.animate({ 'margin-left':-(currentSlide*380) });
	})
	
	
	/* = HoverIntent
	---------------------------------- */
	function mostrarMenu(){
		$(this).addClass('hover');
	};
	
	function esconderMenu(){
		$(this).removeClass('hover');
	};
	
	$(".mainMenu li").hoverIntent({
		over: mostrarMenu,
		out: esconderMenu,
		timeout: 500
	});
	
	
	function trimTitlesAndExcerpts($posts){
		
		if($posts.length){
			$.each( $posts ,function(){ 
			
				var max_excerpt = 290;
				var excerpt = $( this ).find('div.news_excerpt').text();
				var title_length = $( this ).find('h3.news_title').text().length;
				
				var excerpt_cut = excerpt.substring(0, max_excerpt - ((title_length/32) * 50) );
				var e_lastIndex = excerpt_cut.lastIndexOf(" ");
				excerpt_cut = excerpt_cut.substring(0, e_lastIndex);
				
				$(this).find('div.news_excerpt').html(excerpt_cut+'[...]');
						
			});//end foreach
		}
	}
	
	
	trimTitlesAndExcerpts($('.front-page-post'));
	
	/* = Helpers
	---------------------------------- */
	function addtrailingslash(url){
		return (!url.match(/\/$/)) ? url += '/' : url;
	}	
	
	
		
})
	

