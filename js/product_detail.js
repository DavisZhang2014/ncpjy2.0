$(document).ready(function(){
	$("li.cooking").click(function(){
		$("#comment").hide();
		$("#cooking").show();	
	});

	$("li.comment").click(function(){
		$("#cooking").hide();
		$("#comment").show();
	});
	
	$("span").click(function(){
		$(this).siblings(".reply").toggle();	
	});
});