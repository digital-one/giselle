<?php

/**
 * Plugin Name: Giselle
 * Plugin URI: http://www.digital-one.co.uk
 * Description: Giselle Theme
 * Version: 0.1
 * Author: Digital One
 * Author URI: http://www.digital-one.co.uk
 * License: Private. Only Digital One customers are allowed to use this plugin
 */

    class giselle {

        function __construct() {

        	//register custom post types
        	add_action( 'init', array($this,'register_cpt_news'), 0 );
            add_action( 'init', array($this,'register_cpt_brand'), 0 );
            add_action( 'init', array($this,'register_cpt_collection'), 0 );
            //register custom taxonomies

            //columns
            add_filter('manage_edit-cpt_collection_columns', array($this,'add_cpt_collection_columns'));   
            add_action('manage_cpt_collection_posts_custom_column',  array($this,'add_cpt_collection_custom_columns'),10,2); 


//add_filter("manage_edit-enlightenment_columns", "add_cpt_enlightenment_columns");   
//add_action("manage_enlightenment_posts_custom_column",  "add_cpt_enlightenment_custom_columns",10,2); 



            //rewrites
            add_action('init', array($this,'add_cpt_news_rewrite_rules'),0);
			add_filter('query_vars',array($this, 'add_cpt_news_query_vars'),0);

			//image sizes
			add_filter('image_size_names_choose', array($this,'custom_image_sizes'),0);


			// Image sizes

			

            if( is_admin() ) {



            }

    }

     // Register Custom Post Type

    function register_cpt_news() {

        $labels = array(
           	'name'                => _x( 'News', 'Post Type General Name', 'text_domain' ),
            'singular_name'       => _x( 'News', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'           => __( 'News', 'text_domain' ),
            'parent_item_colon'   => __( 'Parent Article:', 'text_domain' ),
            'all_items'           => __( 'All News', 'text_domain' ),
            'view_item'           => __( 'View News', 'text_domain' ),
            'add_new_item'        => __( 'Add New Article', 'text_domain' ),
            'add_new'             => __( 'Add New Article', 'text_domain' ),
            'edit_item'           => __( 'Edit Article', 'text_domain' ),
            'update_item'         => __( 'Update Article', 'text_domain' ),
            'search_items'        => __( 'Search News', 'text_domain' ),
            'not_found'           => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
        );
        $args = array(
            'label'               => __( 'cpt_news', 'text_domain' ),
            'description'         => __( 'News', 'text_domain' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail','page-attributes' ),
            //'taxonomies'          => array( 'ciet_cuisine','ciet_allergen','ciet_diet' ),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        );
        register_post_type( 'cpt_news', $args );
    }


        function register_cpt_brand() {

        $labels = array(
           	'name'                => _x( 'Brands', 'Post Type General Name', 'text_domain' ),
            'singular_name'       => _x( 'Brand', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'           => __( 'Brands', 'text_domain' ),
            'parent_item_colon'   => __( 'Parent Brand:', 'text_domain' ),
            'all_items'           => __( 'All Brands', 'text_domain' ),
            'view_item'           => __( 'View Brand', 'text_domain' ),
            'add_new_item'        => __( 'Add New Brand', 'text_domain' ),
            'add_new'             => __( 'Add New', 'text_domain' ),
            'edit_item'           => __( 'Edit Brand', 'text_domain' ),
            'update_item'         => __( 'Update Brand', 'text_domain' ),
            'search_items'        => __( 'Search Brand', 'text_domain' ),
            'not_found'           => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
        );
        $args = array(
            'label'               => __( 'cpt_brand', 'text_domain' ),
            'description'         => __( 'Brands', 'text_domain' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail','page-attributes' ),
            //'taxonomies'          => array( 'ciet_cuisine','ciet_allergen','ciet_diet' ),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 10,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        );
        register_post_type( 'cpt_brand', $args );
    }

     function register_cpt_collection() {

        $labels = array(
            'name'                => _x( 'Collections', 'Post Type General Name', 'text_domain' ),
            'singular_name'       => _x( 'Collection', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'           => __( 'Collections', 'text_domain' ),
            'parent_item_colon'   => __( 'Parent Collection:', 'text_domain' ),
            'all_items'           => __( 'All Collections', 'text_domain' ),
            'view_item'           => __( 'View Collection', 'text_domain' ),
            'add_new_item'        => __( 'Add New Collection', 'text_domain' ),
            'add_new'             => __( 'Add New', 'text_domain' ),
            'edit_item'           => __( 'Edit Collection', 'text_domain' ),
            'update_item'         => __( 'Update Collection', 'text_domain' ),
            'search_items'        => __( 'Search Collection', 'text_domain' ),
            'not_found'           => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
        );
        $args = array(
            'label'               => __( 'cpt_collection', 'text_domain' ),
            'description'         => __( 'Collections', 'text_domain' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail','page-attributes' ),
            //'taxonomies'          => array( 'ciet_cuisine','ciet_allergen','ciet_diet' ),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 15,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        );
        register_post_type( 'cpt_collection', $args );
    }

// Register Custom Taxonomies

/*
        function register_cptax_cuisine() {

            $labels = array(
                'name'                       => _x( 'Cuisine', 'Taxonomy General Name', 'text_domain' ),
                'singular_name'              => _x( 'Cuisine', 'Taxonomy Singular Name', 'text_domain' ),
                'menu_name'                  => __( 'Cuisine', 'text_domain' ),
                'all_items'                  => __( 'All Cuisine', 'text_domain' ),
                'parent_item'                => __( 'Parent Cuisine', 'text_domain' ),
                'parent_item_colon'          => __( 'Parent Cuisine:', 'text_domain' ),
                'new_item_name'              => __( 'New Cuisine Name', 'text_domain' ),
                'add_new_item'               => __( 'Add Cuisine Item', 'text_domain' ),
                'edit_item'                  => __( 'Edit Cuisine', 'text_domain' ),
                'update_item'                => __( 'Update Cuisine', 'text_domain' ),
                'separate_items_with_commas' => __( 'Separate Cuisine with commas', 'text_domain' ),
                'search_items'               => __( 'Search Cuisine', 'text_domain' ),
                'add_or_remove_items'        => __( 'Add or remove Cuisine', 'text_domain' ),
                'choose_from_most_used'      => __( 'Choose from the most used Cuisine', 'text_domain' ),
                'not_found'                  => __( 'Not Found', 'text_domain' ),
            );
            $rewrite = array(
                'slug'                       => '',
                'with_front'                 => true,
                'hierarchical'               => true,
            );
            $args = array(
                'labels'                     => $labels,
                'hierarchical'               => false,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
                'rewrite'                    => $rewrite,
            );
            register_taxonomy( 'ciet_cuisine', array( 'ciet_company' ), $args );

        }
*/

        function add_cpt_collection_columns($columns){
        $columns = array(
           "cb" => "<input type=\"checkbox\" />",
           "title" => "Collection",
           "brand" => "Brand",
           "date" => "Publish Date"
        );  
         return $columns;
        }

function add_cpt_collection_custom_columns($column,$id){
        global $post;
        switch ($column){
            case "brand":
            $post = get_field('collection_brand',$id);
            echo $post->post_title;
            break;
               }
            } 



        function add_cpt_news_rewrite_rules(){ 
            add_rewrite_rule('^news/archive/pge/([^/]*)/?', 'index.php?pagename=news&pge=$matches[1]','top');
		}

function add_cpt_news_query_vars($public_query_vars) {
	  $public_query_vars[] = "pge";
	return $public_query_vars; 
}


function custom_image_sizes($sizes) {
	add_image_size('slide', 1920, 1200, true);
	add_image_size('news-tn',360,1000,false);
	add_image_size('brand',1000,2000,false);
    add_image_size('signpost',500,1000,false);
	set_post_thumbnail_size( 150, 100,true); 
    unset( $sizes['medium']);
    unset( $sizes['large']);
	$myimgsizes = array(
	"slide" => __("Slide"),
  	"news-tn" => __("News Thumbnail"),
  	"brand" => __("Brand")
  );
     
       $newimgsizes = array_merge($sizes, $myimgsizes);
	    return $newimgsizes;
}

//
}
     $giselle = new giselle();