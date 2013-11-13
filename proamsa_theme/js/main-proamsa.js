
jQuery(document).ready(function($){
	
	var $mainContent = $('.main-content');

	
	
	/* = AjaxLoading and deeplink
	---------------------------------- */
	
	
	$('.nav ul.menu a').click(function() {
		
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
					
		if (base + '/' != current) {		
		
			var diff = current.replace(base, '');
			location = base + '/#' + diff;
		}	
				
	});
	
	
	
			
	/* = Supersized Initialization
	---------------------------------- */
	$.supersized({
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
	

		
	
	
		
})