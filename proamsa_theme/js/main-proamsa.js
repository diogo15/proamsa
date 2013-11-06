
jQuery(document).ready(function($){
	
	$mainContent = $('.main-content');
	
	
	
	/* = AjaxLoading and deeplink
	---------------------------------- */
	
	
	$('.nav ul.menu a').click(function() {
		$(".nav li").removeClass("current-menu-item");
		$(this).parent().addClass("current-menu-item");
		var path = $(this).attr('href').replace(base, '');
		$.address.value(path);
		return false;
	});
	
	
//	$.address.change(function(event) {
//		if (event.value){
//			//$ajaxSpinner.fadeIn();
//			$mainContent.empty().load(base + event.value + ' .inner', function(){
//				//$ajaxSpinner.fadeOut('fast');
//				//$mainContent.show('fast');
//			});
//		}
		/*
		var current = location.protocol + '//' + location.hostname +':'+location.port+ location.pathname;
		if (base + '/' != current) {
			alert(current + '\n' + base + '/');
			var diff = current.replace(base, '');
			location = base + '/#' + diff;
			alert(current);
		}*/		
//	});
	
	
	
			
	/* = Supersized Initialization
	---------------------------------- */
	$.supersized({
		slide_interval          :   3000,		
		transition              :   1, 	
		slides  :  	[ {image : base + "/wp-content/themes/proamsa_theme/img/bg-1.JPG", title : 'Image Credit: Maria Kazvan'} ,
					  {image : base + "/wp-content/themes/proamsa_theme/img/bg-2.JPG", title : 'Image Credit: Maria Kazvan'}
					   ]
	});		
	
		
})