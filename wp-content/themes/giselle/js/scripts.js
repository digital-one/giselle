var isTouchDevice = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isTouchDevice.Android() || isTouchDevice.BlackBerry() || isTouchDevice.iOS() || isTouchDevice.Opera() || isTouchDevice.Windows());
    }
};



$(function(){

var _handleShown = true,
	_fullpageActive = false,
	_isTablet,
	_isMobile,
	_isDesktop;

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
  		autoplay: true,
  		 autoplaySpeed: 4000,
  		speed: 600,
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
	$('#nav').show();
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
	if(_fullpageActive){
	//set height of images on final section of brand page
		if($('.section.last .section-inner').length){
			var _headerHeight = $('#header').height(),
			_windowHeight = $(window).height()-15,
			_imageHeight = _windowHeight - _headerHeight;
			$('.section.last .section-inner').height(_imageHeight);
		}
	} else {
		$('.section.last .section-inner').height('auto');
	}
}


reposition = function(){
	if($('.home').length){
	var _ypos = $('#slider').outerHeight()-15;
	$('.home #main').css({
		marginTop: _ypos+'px'
	})
	}
}

init_fullpage = function(){

	if($('.fullpage').length){
	
		_fullpageActive = true;
		set_image_height();
		var _totalSections = $('.section').length,
			_anchors = Array(),
			_tooltips = Array();

		for(var i=1; i<=_totalSections; i++){
			_anchors.push('page-'+i);
			_tooltips.push('Page '+i);
		}

		$('.fullpage').fullpage({
			verticalCentered: false,
			resize : false,
			scrollingSpeed: 900,
			easing: 'easeInOutExpo',
			keyboardScrolling: true,
			touchSensitivity: 10,
			continuousVertical: false,
			scrollOverflow: true,
			anchors: _anchors,
			navigation: true,
			navigationPosition: 'right',
			navigationTooltips: _tooltips,
			afterRender: function(){
				on_fullpage_init();
			},
			afterResize: function(){
            	$.fn.fullpage.setScrollingSpeed(900);
        	}
		});
	}	
}

on_fullpage_init = function(){
	var _headerHeight = $('#header').outerHeight(),
		_windowHeight = $(window).height(),
		_pageHeight = _windowHeight-_headerHeight,
		_navHeight = $('#fp-nav').outerHeight(),
		_yPos = ((_windowHeight/2) + _headerHeight) - _navHeight/2;

	$('#fp-nav').css({
		'top': _yPos+'px'
	}).show();

	$('#fullpage .handle a').on('click',function(e){
		e.preventDefault();
		$.fn.fullpage.moveTo(2, 0);
	})
}

refresh_page = function(){
	reposition();
	if(_isDesktop){
		if(!_fullpageActive) init_fullpage();
	} else {
		if(_fullpageActive) destroy_fullpage();
	}
}

destroy_fullpage = function(){
	if(_fullpageActive){
		
		//$(".slimScrollDiv").slimscroll({destroy: true});
		$(".fp-scrollable").slimscroll("destroy");
		$.fn.fullpage.destroy('all');
		_fullpageActive=false;
		set_image_height();
	}
}

get_viewport_size = function(){
	_isTablet = $(window).width() > 660 && $(window).width < 769;
	_isMobile = $(window).width() > 661;
	_isDesktop = $(window).width() > 768;
}

preload_images = function(callback) {
var _images = [],
	_loaded = 0,
	_elm = $('.preload'),
	_imageTotal = 0,
	_loaded = 0,
	_callback = callback;
	_elm.each(function(index) { 
		if($(this).attr('src')){
			 _images.push($(this).attr('src'));
		} else {
			_images.push(this.style.backgroundImage.replace(/.*\s?url\([\'\"]?/, '').replace(/[\'\"]?\).*/, ''));
		}
	});
	_imageTotal = _images.length;
	for (var i = 0; i < _imageTotal; i++) {
		var _image = new Image();
		_image.onload = function(){ 
   			if(++_loaded == _imageTotal){
    			if(_callback) _callback();
    		}
		}
		_image.src = _images[i];  
	}
}

show_content = function(){
	$('body').addClass('loaded');
	
	$('#slider,#main,#footer').animate({
		'opacity':1
	},500,'easeInOutExpo',function(){
		//done;	
	})

}

function remove_style(all) {
  var i = all.length;
  var j, is_hidden;

  // Presentational attributes.
  var attr = [
    'align',
    'background',
    'bgcolor',
    'border',
    'cellpadding',
    'cellspacing',
    'color',
    'face',
    'height',
    'hspace',
    'marginheight',
    'marginwidth',
    'noshade',
    'nowrap',
    'valign',
    'vspace',
    'width',
    'vlink',
    'alink',
    'text',
    'link',
    'frame',
    'frameborder',
    'clear',
    'scrolling',
    'style'
  ];

  var attr_len = attr.length;

  while (i--) {
    is_hidden = (all[i].style.display === 'none');

    j = attr_len;

    while (j--) {
      all[i].removeAttribute(attr[j]);
    }

    // Re-hide display:none elements,
    // so they can be toggled via JS.
    if (is_hidden) {
      all[i].style.display = 'none';
      is_hidden = false;
    }
  }
}




$(window).on('resize',function(){
	get_viewport_size();
	refresh_page();
	if(_fullpageActive) $.fn.fullpage.setScrollingSpeed(0); //set fullpage animation speed to zero
	init_map();
})

$(window).on('scroll',function(){
	var _scroll = $(this).scrollTop();
	show_hide_handle(_scroll);
})

//on load
get_viewport_size();
//init_fullpage();
refresh_page();
init_map();
preload_images(show_content);

});