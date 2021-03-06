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
	_isDesktop,
	_container,
	_scrollDirection,
	_currentPathName;

//Homepage slider

if($('#slider').length){

$('#slick').on('init', function(event, slick){
	$('.slick-dots').wrap('<div class="slick-dots-wrap" />').wrap('<div class="inner" />').wrap('<div />');

});
$('#slick').on('beforeChange', function(event, slick, currentSlide, nextSlide){
	var _nextSlide = $('.slide[data-slick-index="'+currentSlide+'"]');
		$('.caption',_nextSlide).removeClass('move');
	})
$('#slick').on('afterChange', function(event, slick, currentSlide){

	var _nextSlide = $('.slide[data-slick-index="'+currentSlide+'"]');
	$('.caption',_nextSlide).addClass('move');
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

//Collection slider
if($('.single-cpt_collection #gallery').length){
$('.single-cpt_collection #gallery').slick({
	dots: false,
    autoplay: true,
    fade: false,
    autoplaySpeed: 4000,
    speed: 600,
    pauseOnHover: true,
    arrows: true
})
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
      		breakpoint: 767,
      		settings: {
        	slidesToShow: 2,
        	slidesToScroll: 1,
        	infinite: true,
        	dots: false
      	}
    },
    	
    	{
      	breakpoint: 379,
      	settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    	}
 	 ]
	});
}

//Double click signposts for touch devices

show_overlay = function(e){
	e.preventDefault();
	var _this = e.currentTarget;
	$('.signpost.overlay a').removeClass('active').off('click',show_overlay);
	$(_this).addClass('active').on('click',goto_link);

}
goto_link = function(e){
	var _this = e.currentTarget;
	location.href=$(_this).attr('href');
}
if(isTouchDevice.any()){

	$('.signpost.overlay a').on('click',show_overlay);
}

show_overlay = function(){
	if($.cookie('show_overlay')!=1){
	setTimeout(function() {
     $('#overlay').show();
}, 4000);
	}
	$('#overlay a.close').on('click',function(e){
		e.preventDefault();
		$('#overlay').hide();
		$.cookie('show_overlay', 1, { expires: 1 });

	})
}
//Visibility of homepage scroll handle

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

init_masonry = function(){

$('a.load-posts').on('click',load_posts_click);
	//$('.scroll-area').on('scroll',loadNewPosts);
	if($('.posts').length){
 	_container = $('.posts');
    
    _container.masonry({
        itemSelector: 'article'//,
        //columnWidth: 100
      });
  }

}

init_twitter_feeds = function(){
if($('#giselle-feed').length){ 
    var giselle_feed = {
    "id": '577481142665900032',
    "domId": 'giselle-feed',
    "maxTweets": 1,
    "enableLinks": true
    };
 twitterFetcher.fetch(giselle_feed);
}
if($('#marccain-feed').length){ 
    var marccain_feed = {
    "id": '577481800555098112',
    "domId": 'marccain-feed',
    "maxTweets": 1,
    "enableLinks": true
    };
twitterFetcher.fetch(marccain_feed);
}
}

load_posts = function(){

var _windowMiddle = $(window).height()/2,
	_offset = $('.posts').offset(),
	_postsHeight = $('.posts').height(),
	_scrollTop = $(window).scrollTop(),
	_postsBottom = _offset.top + _postsHeight,
	_scrollAmount  = _postsBottom - _windowMiddle;
if(_scrollTop > _scrollAmount && _scrollDirection=='down'){
	$('a.load-posts').trigger('click');
}
}

load_posts_click = function(e){
	e.preventDefault();
	var _this = e.currentTarget,
		_url = $(_this).attr('href'),
		_loadElement =  '.posts',
		_btnElement = 'a.load-posts';
	$(_this).data("label",$(_this).text());
	$(window).off('scroll',load_posts); //stop the scroll action
	$('a.load-posts').off('click', load_posts_click); //stop the click action
	$(_this).addClass('loading');

	$.get(_url).done(function(data){
	$('a.load-posts').on('click', load_posts_click);	
	$(window).on('scroll',load_posts);
	$('a.load-posts').removeClass('loading');
	var _obj = $(data).find(_loadElement),
	 	_btn = $(data).find(_btnElement);
	 	_items = _obj.children();
	$(_this).attr('href',_btn.attr('href')); //update the paging link
	$(_this).attr('class',_btn.attr('class'));
	_container.append(_items).masonry('appended',_items);
	});
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
		_yPos = (((_pageHeight - _navHeight)/2) + _headerHeight) + _navHeight/2;

	$('#fp-nav').css({
		'top': _yPos+'px'
	}).show();

	$('.fullpage .handle a').on('click',function(e){
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
	if(_imageTotal==0){
		_callback();
		return;
	}
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
	setTimeout(function() {
      var _nextSlide = $('.slide.slick-active');
	$('.caption',_nextSlide).addClass('move');
}, 500);
	
	$('body').addClass('loaded');
	
	$('#slider,#main,#footer').animate({
		'opacity':1
	},500,'easeInOutExpo',function(){
		//done;	
	})
	init_masonry();
	load_posts();
}

init_pop_state = function(){
 window.onpopstate = function (event){ 
    if(location.pathname != currentPathname){
 	 if ($firstLoad){
		//$firstLoad = false;
	} else {
	if (event.state != null){
	//console.log('not null')
// there is something in the history state for this entry, so we go ahead and load it
// but we pass in false so that it doesn't write another entry over it...
loadContent(location.href,false);
}else{
	//console.log('null')
// if there is nothing in the state (either first load or returning to a page that was a first load)
// then we tell it not to load the ajax, but instead just load the default content
loadContent(null,false);
}
} 
}
}
}

load_history_content = function(_url){

	history.pushState({}, '', _url); //push the url
	 _currentPathname = location.pathname;
	$.get(_url).done(function(data){
		var _page = $(data).find('#content');
	});
}

send_push_link = function(e){
	e.preventDefault();
  var _this = $(e.currentTarget),
  	  _url = _this.attr('href');
	console.log(url);
hideContent(function(){
	loadContent(url,true);
})
  
}

init_history = function(){
	$('body').on('click','.push-link',send_push_link);
}


$(window).on( 'DOMMouseScroll mousewheel', function ( event ) {
  if( event.originalEvent.detail > 0 || event.originalEvent.wheelDelta < 0 ) { 
    //scroll down
    _scrollDirection = 'down';
  } else {
    //scroll up
   	_scrollDirection = 'up';
  }
});


$(window).on('resize',function(){
	get_viewport_size();
	refresh_page();
	if(_fullpageActive) $.fn.fullpage.setScrollingSpeed(0); //set fullpage animation speed to zero
	init_map();
	if(_isDesktop){
		on_fullpage_init();
	}
})

$(window).on('scroll',load_posts);

$(window).on('scroll',function(){
	var _scroll = $(this).scrollTop();
	show_hide_handle(_scroll);
})

//on load
get_viewport_size();
//init_fullpage();
refresh_page();
show_overlay();
init_map();
init_twitter_feeds();
preload_images(show_content);

});