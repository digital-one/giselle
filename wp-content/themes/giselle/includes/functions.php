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

	}
}

// enqueue base scripts and styles
add_action('wp_enqueue_scripts', 'init_scripts_styles');



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

