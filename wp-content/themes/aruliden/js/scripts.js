$ = jQuery.noConflict();
$(document).ready(function(){
	$(".page-banner").css({"height":$(window).height()+"px"});


$(".info-accordion .info").hide();
$(".info-accordion .acc:eq(0) .info").slideDown();
$(".info-accordion .head").click(function(){
	//$("#accordion1 .acc").removeClass("active");
	if($(this).parent(".acc").hasClass("active"))
	{
		$(this).next(".info").slideToggle();
		$(this).parent(".acc").removeClass("active");
		
	}
	else 
	{
		$(this).next(".info").slideToggle();
		$(this).parent(".acc").addClass("active");
		
	}
});
$(".home-listing-leadership .lead-list").click(function(){ 
	if($(this).parent(".grid-small").hasClass("active"))
	{
		$(this).parent(".grid-small").removeClass("active");
		var data_ref = $(this).attr("data-ref");
		$("."+data_ref).slideUp();
		//$(this).next().slideToggle();
	}
	else
	{
		$(".home-listing-leadership .grid-small").removeClass("active");
		$(".home-listing-leadership .leader-info").slideUp();
		$(this).parent(".grid-small").addClass("active");
		var data_ref = $(this).attr("data-ref");
		$("."+data_ref).slideDown();
		//$(this).next().slideToggle();	
	}
});
$(".leader-info .close-bio").click(function(){
	$(".home-listing-leadership .grid-small").removeClass("active");
	$(this).parent(".leader-info").slideUp();
});


});


$(window).resize(function(){
	$(".page-banner").css({"height":$(window).height()+"px"});
});

