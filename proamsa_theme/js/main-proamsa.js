
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
			
		var current = location.protocol + '//' + location.hostname +':'+location.port+ location.pathname;
		
		if (event.value){
			$mainContent.slideUp('fast', function(){
				$mainContent.empty().load(base + event.value + ' .inner', function(){
					$mainContent.slideDown('fast');
				});
			})
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
		slides  :  	[ {image : base + "/wp-content/themes/proamsa_theme/img/bg-1.JPG", title : 'Image Credit: Maria Kazvan'} ,
					  {image : base + "/wp-content/themes/proamsa_theme/img/bg-4.JPG", title : 'Image Credit: Maria Kazvan'} ,
					  {image : base + "/wp-content/themes/proamsa_theme/img/bg-2.JPG", title : 'Image Credit: Maria Kazvan'} ,
					  {image : base + "/wp-content/themes/proamsa_theme/img/bg-3.JPG", title : 'Image Credit: Maria Kazvan'} 
					   
					  
					   ]
	});	
	

	
		
})