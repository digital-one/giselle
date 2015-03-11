$(function(){

var _handleShown = true;

//Homepage slider

if($('#slider').length){

$('#slick').on('init', function(event, slick){
	$('.slick-dots').wrap('<div class="slick-dots-wrap" />').wrap('<div class="inner" />').wrap('<div />');
});

$('#slick').slick({
    dots: true,
    autoplay: true,
    fade: false,
    autoplaySpeed: 4000,
    speed: 600,
    pauseOnHover: false,
    arrows: false
  });
}

$('#menu-toggle').on('click',function(e){
	e.preventDefault();
	if($(this).hasClass('open')){
		$(this).removeClass('open');
		$('body').removeClass('expanded');
	} else {
		$(this).addClass('open');
		$('body').addClass('expanded');
	}
})

$('.handle').on('click',function(e){

	var _headerHeight = $('#header').height(),
		_windowHeight = $(window).height()-15,
		_scrollHeight = _windowHeight - _headerHeight;
	 	e.preventDefault();

	  $('html, body').animate({
    scrollTop: _scrollHeight
}, 1000,'easeOutCubic');

})


reposition = function(){
	if($('.home').length){
	var _windowHeight = $(window).height()-15;
	$('.home #main').css({
		marginTop: _windowHeight+'px'
	})
	}
}

$(window).on('resize',function(){
	reposition();
})
reposition();

$(window).on('scroll',function(){
	var _scroll = $(this).scrollTop();
	if(_scroll >1){
		 if(!$('.handle a').hasClass('hide')){
		 	$('.handle a').addClass('hide');
}
	} else {
		if($('.handle a').hasClass('hide')){
			$('.handle a').removeClass('hide');
		}
	
	}
})
//
});