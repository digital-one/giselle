<?php

function init_scripts_styles() {
   //only effect front-end of your website
	if (!is_admin() && $_SERVER['SCRIPT_NAME'] != '/wp-login.php') {
	
		// register main stylesheet
		wp_register_style( 'stylesheet', get_stylesheet_directory_uri() . '/css/styles.css', array(), '1.1', 'all' );
		wp_enqueue_style( 'stylesheet' );
		
		//jquery
	  wp_deregister_script( 'jquery' );
	  wp_register_script( 'jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null );
	  wp_enqueue_script( 'jquery' );

	  //fullpage.js
	  
	//  wp_register_style( 'fullpage_css', get_stylesheet_directory_uri() . '/css/jquery.fullPage.css', array(), '1.1', 'all' );
	//	wp_enqueue_style( 'fullpage_css' );
	  wp_register_script( 'slimscroll', get_stylesheet_directory_uri() . '/js/jquery.slimscroll.min.js', array(), null, true );
		wp_enqueue_script( 'slimscroll' );
		wp_register_script( 'fullpage', get_stylesheet_directory_uri() . '/js/jquery.fullPage.min.js', array(), null, true );
		wp_enqueue_script( 'fullpage' );
		
	  //easing
	  wp_register_script(  'easing', get_stylesheet_directory_uri() . '/js/jquery.easing.min.js', array(), null, false  );
	  wp_enqueue_script( 'easing' );

	  //google maps api
	  wp_register_script( 'google_maps_api', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://maps.google.com/maps/api/js?sensor=true", false, null );
	  wp_enqueue_script( 'google_maps_api' );

	  wp_register_script(  'gmap', get_stylesheet_directory_uri() . '/js/jquery.gmap.js', array(), null, false  );
	  wp_enqueue_script( 'gmap' );


	  //slick slider
	  wp_register_script(  'slick', get_stylesheet_directory_uri() . '/js/slick/slick.min.js', array(), '1.4.1', false  );
	  wp_enqueue_script( 'slick' );

		// modernizr 
		wp_register_script( 'modernizr', get_stylesheet_directory_uri() . '/js/modernizr.js', array(), null, false );
		wp_enqueue_script( 'modernizr' );

		//register scripts
		wp_register_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), null, true );
		wp_enqueue_script( 'scripts' );


		wp_localize_script( 'scripts', 'Map', array('lat' => 53.96036,'lng' =>-1.0816329,'marker'=> get_template_directory_uri().'/images/marker.png'));

	}
}

// enqueue base scripts and styles
add_action('wp_enqueue_scripts', 'init_scripts_styles');

// menu support
add_theme_support('menus');


//Removes admin access to non admin users
function no_admin_access(){
	if( !current_user_can( 'administrator' ) ) {
		wp_redirect( home_url() );
		die();
	}
}
add_action( 'admin_init', 'no_admin_access', 1 );


//Hide Admin Bar
show_admin_bar(false);



?>