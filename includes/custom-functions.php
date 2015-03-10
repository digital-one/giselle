<?php

function scripts_and_styles() {
   //only effect front-end of your website
	if (!is_admin() && $_SERVER['SCRIPT_NAME'] != '/wp-login.php') {
		
		// respond
		wp_register_script( 'respondjs', get_stylesheet_directory_uri() . '/library/js/libs/min/respond.min.js', array(), null, false );
		wp_enqueue_script( 'respondjs' );
		
		
		// modernizr (without media query polyfill)
		wp_register_script( 'modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );
		wp_enqueue_script( 'modernizr' );

		
		// register main stylesheet
		wp_register_style( 'stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '1.1', 'all' );
		wp_enqueue_style( 'stylesheet' );
		
		
		//register styles for our theme
		wp_register_style( 'respgrid', get_template_directory_uri() . '/library/css/foundation.css', array(), 'all' );
		wp_enqueue_style( 'respgrid' );
		

		//jquery
	  wp_deregister_script( 'jquery' );
	  wp_register_script( 'jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null );
	  wp_enqueue_script( 'jquery' );
	   

	  //Holding page Owl Carousel dependencies
		wp_register_style( 'owlcarouselcss', get_template_directory_uri() . '/library/css/owl.carousel.css', array(), 'all' );
		wp_enqueue_style( 'owlcarouselcss' );

		wp_register_script( 'owlcarouseljs', get_stylesheet_directory_uri() . '/library/js/libs/min/owl.carousel.js', array(), null, false );
		wp_enqueue_script( 'owlcarouseljs' );


		//Fancybox
		wp_register_style( 'fancyboxcss', get_template_directory_uri() . '/library/css/jquery.fancybox.css', array(), 'all' );
		wp_enqueue_style( 'fancyboxcss' );

		wp_register_script( 'fancyboxjs', get_stylesheet_directory_uri() . '/library/js/libs/jquery.fancybox.js', array(), null, false );
		wp_enqueue_script( 'fancyboxjs' );

		
		//register all scripts
		wp_register_script( 'allscripts', get_stylesheet_directory_uri() . '/library/js/scripts.js', array(), null, true );
		wp_enqueue_script( 'allscripts' );

	
		
		
		
	}
	
		
	
}

// enqueue base scripts and styles
add_action('wp_enqueue_scripts', 'scripts_and_styles', 999);

function load_custom_wp_admin_style() {
// register script for tabs
		wp_register_script( 'jquery_ui_js', get_stylesheet_directory_uri() . '/library/js/jquery-ui.min.js', array('jquery'), '1.3.4', true );
		wp_enqueue_script( 'jquery_ui_js' );
		
		// register style for tabs
		wp_register_style( 'jquery_ui_css', get_stylesheet_directory_uri() . '/library/css/jquery-ui.min.css', array(), '1.3.4', false );
		wp_enqueue_style( 'jquery_ui_css' );
}

add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

// enqueue google fonts
function google_fonts() {
  wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,900italic');
  wp_enqueue_style( 'googleFonts');
}

add_action('wp_print_styles', 'google_fonts');





//Removes admin access to non admin users
function no_admin_access(){
	if( !current_user_can( 'administrator' ) ) {
		wp_redirect( home_url() );
		die();
	}
}
add_action( 'admin_init', 'no_admin_access', 1 );



//Hide Admin Bar
show_admin_bar( false );





//My Profile Logged Out Redirect
function logged_out_redirect($page_id=0, $location='', $is_client=false) {
	if ($page_id > 0 && $location != '') {
		if (!is_user_logged_in()) {
			if (is_page($page_id)) {
				wp_redirect('/'.$location);
				exit;
			}
		} else{
			if ($is_client) {
				global $current_user;
				$user_client = get_user_meta($current_user->ID, 'is_client', true);
				if ($user_client!=1) {
					wp_redirect('/'.$location);
					exit;						
				}
			}
		}
	}
}



//Extra user fields
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>
	<h3>Extra profile information</h3>
	<table class="form-table">
		<tr>
			<th><label for="city">City</label></th>
			<td><input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>
		<tr>
			<th><label for="postcode">Postcode</label></th>
			<td><input type="text" name="postcode" id="postcode" value="<?php echo esc_attr( get_the_author_meta( 'postcode', $user->ID ) ); ?>" class="regular-text" /><br /></td>
		</tr>

		<tr>
			<th><label for="how_did">How Did You Hear About Us?</label></th>
			<td><input type="text" name="how_did" id="how_did" value="<?php echo esc_attr( get_the_author_meta( 'how_did_you_hear_about_us', $user->ID ) ); ?>" class="regular-text" disabled="disabled"/><br /></td>
		</tr>

		 <tr>
			<th><label for="allergens">Allegens</label></th>
			<td>
			
			<?php
				global $current_user;

				$allergens = get_user_meta($current_user->ID,'allergen_id');
				$args = array ('hide_empty' => false);
				$terms = get_terms('ciet_allergen',$args);

				foreach ($terms as $term) {
					echo '<p><input type="checkbox" name="allergens[]" value="'.$term->term_id.'" ';
					if (in_array($term->term_id, $allergens)) {
						echo ' checked ';
					}
					echo  '> '.$term->name.'</p>';
				}
      ?>
			</td>
		</tr>
	</table>

<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

		delete_user_meta($user_id,'allergen_id');

		foreach ($_POST['allergens'] as $allergen) {
			$all = (int)$allergen;
			if($all > 0) {
				add_user_meta($user_id,'allergen_id',$all);
			}
		}
}


//Gravity Form Images
//This needs to be updated to allow for an image to be uploaded and then resized. Currently the maximum file size is set to 2MB.

add_filter("gform_upload_path", "custom_upload_path", 10, 2); //this is a gf filter which changes the upload path
function custom_upload_path($path_info, $form_id){
	if($form_id==6){


		$server_root = $_SERVER['DOCUMENT_ROOT'];
					//Live
					if($server_root == '/nas/wp/www/sites/canieatthere')	{
						//$path_info["path"] = "/home/youruser/public_html/wp-content/uploads/customfolder/";
						//$path_info["url"] = "http://example.com/wp-content/uploads/customfolder/";
						echo 'shouldnt be here';
						exit;
					}
					else {
						$path_info["path"] = "/Applications/MAMP/htdocs/ciet/wp-content/uploads/avatars/";
						$path_info["url"] = "http://www.canieatthere.co.uk/wp-content/uploads/avatars/";
					}


			}
			return $path_info;
		}

add_action("gform_after_submission_6", "custom_after_submission_6", 10, 2); //this is a gf filter which lets us get an entry after it is done.  we will use this to automatically rename files (only form 9 in the example)
function custom_after_submission_6($entry, $form){
		global $current_user;
    foreach($form['fields'] as $key => $field){  //this will get all the fields that are a fileupload type
	    if($field['type'] == 'fileupload')
	    	$keys[] = $field['id'];
    }
    foreach($keys as $value){  //this will save the url info for all the fields which were submitted
    	$pathinfo = pathinfo($entry[$value]);
    	if(!empty($pathinfo['extension'])){
	    	$oldurls[$value] = $pathinfo;
	    	$pathinfo['filename'] = $entry['id'] . '_' . $form['id'] . '_' . $value;  //we are going to make the files look something like this entryid_formid_fieldid... so you may have something like 323_9_12 for the filename.   this system ensures all filenames are unique and sorted.  you can make the name anything you like.  remember it is the filename only (no path and no extension)
	    	$newurls[$value] = $pathinfo;
    	}
    }
    $uploadinfo = custom_upload_path('', 6); //this will get the upload path from our custom filter
    
    if (count($newurls) > 0 ) {
	    foreach($newurls as $key => $value){
	    	$oldpath = $uploadinfo['path'].$oldurls[$key]['filename'].'.'.$oldurls[$key]['extension'];
	    	$newpath = $uploadinfo['path'].$newurls[$key]['filename'].'.'.$newurls[$key]['extension'];
	    	$oldurl = $uploadinfo['url'].$oldurls[$key]['filename'].'.'.$oldurls[$key]['extension'];
	    	$newurl = $uploadinfo['url'].$newurls[$key]['filename'].'.'.$newurls[$key]['extension'];

	    	$is_success = rename($oldpath,$newpath); //this renames the file
	    	if($is_success && !empty($is_success)){
		    	global $wpdb;
		    	$wpdb->update(RGFormsModel::get_lead_details_table_name(), array("value" => $newurl), array("lead_id" => $entry["id"], "value" => $oldurl)); //this updates wordpress
		    	update_user_meta($current_user->ID, 'avatar_image', $newurl);
	    	}
	    }

    }
    return;
}






//Custom Theme Settings
add_action('admin_menu', 'add_gcf_interface');

function add_gcf_interface() {
	add_options_page('Global Fields', 'Global Fields', '8', 'functions', 'editglobalcustomfields');
}

function editglobalcustomfields() {
	?>
	<div class='wrap'>
	<h2>Global Fields</h2>
	<p>All information provided here will be displayed throughout the site where required.</p>

	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>

	<p><strong>Address:</strong><br />
	<textarea name="address" cols="100%" rows="7"><?php echo get_option('address'); ?></textarea></p>

	<p><strong>Phone Number:</strong><br />
	<input type="text" name="phone" size="45" value="<?php echo get_option('phone'); ?>" /></p>

	<p><strong>Email Address:</strong><br />
	<input type="text" name="email" size="45" value="<?php echo get_option('email'); ?>" /></p>

	<p><strong>Restaurants Email Address:</strong><br />
	<input type="text" name="restaurants-email" size="45" value="<?php echo get_option('restaurants-email'); ?>" /></p>

	<p><strong>Media & Advertising Email Address:</strong><br />
	<input type="text" name="media-ads-email" size="45" value="<?php echo get_option('media-ads-email'); ?>" /></p>


	<p><input type="submit" name="Submit" value="Update Options" /></p>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="address, phone, email, restaurants-email, media-ads-email" />

	</form>
	</div>
	<?php
}



//Maintain line breaks in textareas on Global Custom Fields page
function the_textarea_value( $textarea ){
	return str_replace("\r\n", '<br>', $textarea); 
}


//Check for http:// in supplied URL and add it if it doesn't exist
//http://stackoverflow.com/questions/2762061/how-to-add-http-if-its-not-exists-in-the-url
function addScheme($url, $scheme = 'http://'){
	return parse_url($url, PHP_URL_SCHEME) === null ?
	$scheme . $url : $url;
}


//Add fancybox class to write a review menu item
function add_menuclass($ulclass) {
	return preg_replace('/<a rel="fancybox"/', '<a class="fancybox"', $ulclass, 1);
}
add_filter('wp_nav_menu','add_menuclass');