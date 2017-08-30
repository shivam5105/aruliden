$ = jQuery.noConflict();
$(document).ready(function(){
	$(".page-banner").css({"height":$(window).height()+"px"});

	slider = $('.post-slider').bxSlider({ 
    nextSelector: '#slider-next',
    nextText: '&rarr;',  
    prevSelector: '#slider-prev',
    prevText: '&larr;',
    touchEnabled: true,
    pager: false,
    auto: false,
    autoControls: false,
    onSliderLoad: function(currentIndex){
    	$('.slide-number').text((slider.getCurrentSlide()+1)+'/'+slider.getSlideCount());
	},
    onSlideAfter: function(){    
        $('.slide-number').text((slider.getCurrentSlide()+1)+'/'+slider.getSlideCount());   
    }
});

$(".info-accordion .info").hide();
$(".info-accordion .acc:eq(0) .info").slideDown();
$(".info-accordion .head").click(function(){
	//$("#accordion1 .acc").removeClass("active");
	if($(this).parent(".acc").hasClass("active"))
	{
		$(this).next(".info").slideToggle();
		$(this).parent(".acc").removeClass("active");
		$(this).children("span").toggleClass("ion-plus ion-android-close");
	}
	else 
	{
		$(this).next(".info").slideToggle();
		$(this).parent(".acc").addClass("active");
		$(this).children("span").toggleClass("ion-plus ion-android-close");
		
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


$("table.dataTable .expand-info").click(function(){
	$(this).parent().parent().next("tr").fadeToggle();
	$(this).toggleClass("ion-plus ion-android-close");
	$(this).parent().parent("tr").toggleClass("active");
});

	if($("#awards-table").length > 0)
	{
    	$('#awards-table').DataTable({
    		"info": false,
    		"paging": false,
    		"searching": false
    	});
    }

});


$(window).resize(function(){
	$(".page-banner").css({"height":$(window).height()+"px"});
});

