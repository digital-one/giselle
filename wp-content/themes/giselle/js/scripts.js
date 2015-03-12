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

//About Us Carousel

if($('#carousel').length){
$('#carousel').slick({
  		dots: false,
  		arrows: true,
  		infinite: true,
  		speed: 300,
  		slidesToShow: 3,
  		slidesToScroll: 1,
  		responsive: [
    	{
      		breakpoint: 1024,
      		settings: {
        	slidesToShow: 2,
        	slidesToScroll: 1,
        	infinite: true,
        	dots: false
      	}
    },
    	
    	{
      	breakpoint: 660,
      	settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    	}
 	 ]
	});
}

//minimise header

minimise_header = function(_scroll){
	var _scrollPoint = $(window).height() - $('#header').height() - 20;
	if(_scroll > _scrollPoint){
		$('body').addClass('minimise-header');
	} else {
		$('body').removeClass('minimise-header');
	}
	
}

show_hide_handle = function(_scroll){
	if(_scroll >1){
		 if(!$('.handle a').hasClass('hide')){
		 	$('.handle a').addClass('hide');
}
	} else {
		if($('.handle a').hasClass('hide')){
			$('.handle a').removeClass('hide');
		}
	}
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

//gallery

if($('#gallery').length){
	$('#gallery').on('mouseenter',function(){
		$(this).addClass('show');
	})
	$('#gallery').on('mouseleave',function(){
		$(this).removeClass('show');
	})
}

//google map

init_map = function(){

if($('#map').length){
	$('#map').html('');
		var _lat = Map.lat,
			_lng = Map.lng,
			_marker = Map.marker;
$('#map').gmap({
        markers: [{'latitude': _lat,'longitude': _lng}],
        markerFile: _marker,
        markerWidth:44,
        markerHeight:67,
        markerAnchorX:22,
        markerAnchorY:67
    });
}
}

set_image_height = function(){
	//set height of images on final section of brand page
	if($('.section.last .section-inner').length){
	var _headerHeight = $('#header').height(),
		_windowHeight = $(window).height()-15,
		_imageHeight = _windowHeight - _headerHeight;
	$('.section.last .section-inner').height(_imageHeight);
	}
}

reposition = function(){
	if($('.home').length){
	//var _windowHeight = $(window).height()-15;
	var _ypos = $('#slider').outerHeight()-15;
	$('.home #main').css({
		marginTop: _ypos+'px'
	})
	}
}

$(window).on('resize',function(){
	reposition();
	set_image_height();
	init_map();
})

$(window).on('scroll',function(){
	var _scroll = $(this).scrollTop();
	//minimise_header(_scroll);
	show_hide_handle(_scroll);
})

//on load
reposition();
set_image_height();
init_map();
});