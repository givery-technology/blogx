$(document).ready(function(){
	$('tr').hover(
		function(){
			$(this).find('td').addClass('hovertr');
		},
		function(){
			$(this).find('td').removeClass('hovertr');
		}
	);
	//menu
	$('#sidebar-left .main-menu li').click(function(){
		var ul = $(this).find('>ul');
		if(ul.css('display')=='none'){
			$(this).find('>ul').slideDown('medium');
		}else{
			$(this).find('>ul').slideUp('medium');
		}
	})
	//set count menu child
	$('#sidebar-left .main-menu li ul').each(function(){
		$(this).prev().find('span').text($(this).find('li').size());
	})
	//check menu child active
	$('#sidebar-left .main-menu li ul .active').each(function(){
		$(this).parent().show();
	})
})