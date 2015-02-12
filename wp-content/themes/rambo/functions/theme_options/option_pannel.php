<?php
add_action('admin_menu', 'rambo_admin_menu_pannel');  
function rambo_admin_menu_pannel()
 {	$page=add_theme_page( __('theme','rambo'), __('Option Panel','rambo'), 'edit_theme_options', 'rambo', 'rambo_option_panal_function' ); 
 	$page2=add_theme_page( __('Webriti Themes','rambo'), __('Webriti Themes','rambo'), 'edit_theme_options', 'webriti_themes', 'webriti_themes_function' );
	add_action('admin_print_styles-'.$page, 'rambo_admin_enqueue_script');
	add_action('admin_print_styles-'.$page2, 'webriti_theme_admin_enqueue_script');
 }
function rambo_admin_enqueue_script()
{	
	wp_enqueue_script('rambo-tab',get_template_directory_uri().'/functions/theme_options/js/option-panel-js.js',array('media-upload','thickbox'));
	wp_enqueue_style('thickbox');
	wp_enqueue_style('rambo-option',get_template_directory_uri().'/functions/theme_options/css/style-option.css');
	wp_enqueue_style('rambo-comp-chart',get_template_directory_uri().'/functions/theme_options/css/comp-chart.css');
	//upgrade to pro css and js	
	wp_enqueue_script( 'rambo-bootstrap-modal', get_template_directory_uri() . '/functions/theme_options/js/bootstrap-modal.js');
	wp_enqueue_style('rambo-upgrade',get_template_directory_uri().'/functions/theme_options/css/upgrade-pro.css');
}
function rambo_option_panal_function()
{	
	// option panel
	require_once('webriti_option_pannel.php');
}

function webriti_themes_function ()
	{	
		require_once('webriti_theme.php');
	}
//Theme pages css and js
	function webriti_theme_admin_enqueue_script()
	{ 	
		
		wp_enqueue_style('rambo-responsive',get_template_directory_uri().'/css/bootstrap-responsive.css'); 
		wp_enqueue_style('rambo-bootstrap',get_template_directory_uri().'/functions/theme_options/css/webriti_theme.css'); 
		
	}
?>