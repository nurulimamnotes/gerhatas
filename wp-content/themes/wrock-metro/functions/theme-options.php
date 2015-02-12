<?php

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */
function optionsframework_option_name() {
    // This gets the theme name from the stylesheet (lowercase and without spaces)
    $themename = wp_get_theme();
    $themename = $themename['Name'];
    $themename = preg_replace("/\W/", "", strtolower($themename));
    $optionsframework_settings = get_option('optionsframework');
    $optionsframework_settings['id'] = $themename;
    update_option('optionsframework', $optionsframework_settings);
    // echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */
function optionsframework_options() {
    $themename = ( 'wp_get_theme' ) ? wp_get_theme() : wp_get_theme();
    $themename = $themename['Name'];
    $shortname = "of";
    //Stylesheet Reader
    $alt_stylesheets = array("black" =>
        "black", "brown" => "brown", "blue" => "blue", "green" => "green", "pink" => "pink", "purple" => "purple", "red" => "red", "yellow" => "yellow");
    // Test data
    $test_array = array("one" => "One", "two" => "Two", "three" => "Three", "four" => "Four", "five" => "Five");
    // Multicheck Array
    $multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
    // Multicheck Defaults
    $multicheck_defaults = array("one" => "1", "five" => "1");
    // Background Defaults
    $background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat', 'position' => 'top center', 'attachment' => 'scroll');
    // Pull all the categories into an array
    $options_categories = array();
    $options_categories_obj = get_categories();
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }
    // Pull all the pages into an array
    $options_pages = array();
    $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
    $options_pages[''] = 'Select a page:';
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }

    // If using image radio buttons, define a directory path
    $imagepath = get_stylesheet_directory_uri() . '/images/';

    $options = array(array("name" => __( "General Settings", "wrockmetro" ),
            "type" => "heading"),
         
		 array("name" => __( "Custom Favicon URL", "wrockmetro" ),
            "desc" => "Specify a 16px x 16px image that will represent your website's favicon.",
            "id" => "wrockmetro_favicon",
            "type" => "upload"),
        
		array("name" => __( "Latest Posts", "wrockmetro" ),
            "desc" => "Show 5 Latest Posts with Thumbnail in Sidebar.",
            "id" => "wrockmetro_activate_ltposts",
            "std" => "1",
            "type" => "checkbox"),	
        array("name" => __( "Show Author Profile", "wrockmetro" ),
            "desc" => "Check the box to show Author Profile Below the Post.",
            "id" => "wrockmetro_author",
            "std" => "",
			"type" => "checkbox"),
				
//****=============================================================================****//
//****-----------This code is used for creating slider settings--------------------****//							
//****=============================================================================****//						
        array("name" => __( "Ads Management", "wrockmetro" ),
            "type" => "heading"),
			
		array("name" => "Activate Ads Space Below Navigation",
            "desc" => "Activate Ads Space Below Navigation and put code in below test field.",
            "id" => "wrockmetro_banner",
            "std" => "",
			"type" => "checkbox"),
		array("name" => __( "Ads code Below Main Navigation.", "wrockmetro" ),
            "desc" => "Enter your ads code here, preferably a 728*15 link list unit, or a 728*90 lead-board ad.",
            "id" => "wrockmetro_banner_top",
            "std" => "",
            "type" => "textarea"),	
        array("name" => __( "AD Code For Single Post", "wrockmetro" ),
            "desc" => "Path of the image to be displayed in sidebar section.",
            "id" => "wrockmetro_ad2",
            "std" => "",
            "type" => "textarea"),	
        array("name" => __( "AD Code For Footer", "wrockmetro" ),
            "desc" => "Paste Ad Code for Footer Area below navigation.",
            "id" => "wrockmetro_ad1",
            "std" => "",
            "type" => "textarea"),	
//****=============================================================================****//
//****-----------This code is used for creating color styleshteet options----------****//							
//****=============================================================================****//				
        $options[] = array("name" => __( "Custom CSS", "wrockmetro" ),
    "type" => "heading"),
        array("name" => __( "Custom CSS", "wrockmetro" ),
            "desc" => "Quickly add some CSS to your theme by adding it to this block.",
            "id" => "wrockmetro_customcss",
            "std" => "",
            "type" => "textarea"),
			
        array("name" => __( "Social Media", "wrockmetro" ),
            "type" => "heading"),
			
		array("name" => __( "Show Social Follow ICONs", "wrockmetro" ),
            "desc" => "Check the box to show social sites Follows buttons in Sidebar.",
            "id" => "wrockmetro_sharebut",
            "std" => "",
			"type" => "checkbox"),		
        array("name" => __( "Facebook URL", "wrockmetro" ),
            "desc" => "Enter your Facebook URL if you have one",
            "id" => "wrockmetro_fb",
            "std" => "",
            "type" => "text"),
        array("name" => __( "Twitter URL", "wrockmetro" ),
            "desc" => "Enter your Twitter URL if you have one",
            "id" => "wrockmetro_tw",
            "std" => "",
            "type" => "text"),
        array("name" => __( "RSS Feed URL", "wrockmetro" ),
            "desc" => "Enter your RSS Feed URL if you have one",
            "id" => "wrockmetro_rss",
            "std" => "",
            "type" => "text"),
		array("name" => __( "Google+ URL", "wrockmetro" ),
            "desc" => "Enter your Google+ Link if you have one",
            "id" => "wrockmetro_gp",
            "std" => "",
            "type" => "text"),	
        array("name" => __( "Linked In URL", "wrockmetro" ),
            "desc" => "Enter your Linkedin URL if you have one",
            "id" => "wrockmetro_in",
            "std" => "",
            "type" => "text"),
		array("name" => __( "YouTube In URL", "wrockmetro" ),
            "desc" => "Enter your YouTube URL if you have one",
            "id" => "wrockmetro_youtube",
            "std" => "",
            "type" => "text"),
		array("name" => __( "Pinterest In URL", "wrockmetro" ),
            "desc" => "Enter your Pinterest URL if you have one",
            "id" => "wrockmetro_pinterest",
            "std" => "",
            "type" => "text"),
		array("name" => __( "Stumbleupon In URL", "wrockmetro" ),
            "desc" => "Enter your Stumbleupon URL if you have one",
            "id" => "wrockmetro_stumbleupon",
            "std" => "",
            "type" => "text"),
		array("name" => __( "Instagram In URL", "wrockmetro" ),
            "desc" => "Enter your Instagram URL if you have one",
            "id" => "wrockmetro_instagram",
            "std" => "",
            "type" => "text"),
		array("name" => __( "email In URL", "wrockmetro" ),
            "desc" => "Enter your email URL if you have one",
            "id" => "wrockmetro_email",
            "std" => "",
            "type" => "text")
    );

    update_option('of_themename', $themename);
    return $options;
}

