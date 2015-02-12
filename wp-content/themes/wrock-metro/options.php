<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}


function optionsframework_options() {

	// Test data
	$test_array = array(
		'3' => __('3', 'wrockmetro'),
		'5' => __('5', 'wrockmetro'),
		'6' => __('6', 'wrockmetro'),
		'8' => __('8', 'wrockmetro'),
		'10' => __('10', 'wrockmetro')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'wrockmetro'),
		'two' => __('Pancake', 'wrockmetro'),
		'three' => __('Omelette', 'wrockmetro'),
		'four' => __('Crepe', 'wrockmetro'),
		'five' => __('Waffle', 'wrockmetro')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);
	


	// Typography Defaults
	$typography_defaults = array(
		'size' => '13px',
		'face' => 'false',
		'style' => 'normal',
		'color' => '#555555' );
	$typography_entrytitle = array(
		'size' => '28px',
		'face' => 'false',
		'style' => 'normal',
		'color' => '#555555' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => false,
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();
$options[] = array(
            'desc' => '<h2 style="color: #FFF !important;">' . esc_attr__( 'Upgrade to Premium Theme & Enable Full Features!', 'wrockmetro' ) . '</h2>
            <li>' . esc_attr__( 'SEO Optimized WordPress Theme.', 'wrockmetro' ) . '</li>
            <li>' . esc_attr__( 'More Slides for your slider.', 'wrockmetro' ) . '</li>
            <li>' . esc_attr__( 'Theme Customization help & Support Forum.', 'wrockmetro' ) . '</li>
            <li>' . esc_attr__( 'Page Speed Optimize for better result.', 'wrockmetro' ) . '</li>
            <li>' . esc_attr__( 'Color Customize of theme.', 'wrockmetro' ) . '</li>
            <li>' . esc_attr__( 'Custom Widgets and Functions.', 'wrockmetro' ) . '</li>
            <li>' . esc_attr__( 'Social Media Integration.', 'wrockmetro' ) . '</li>
            <li>' . esc_attr__( 'Responsive Website Design.', 'wrockmetro' ) . '</li>
            <li>' . esc_attr__( 'Different Website Layout to Select.', 'wrockmetro' ) . '</li>
            <li>' . esc_attr__( 'Many of Other customize feature for your blog or website.', 'wrockmetro' ) . '</li>
            <p><span class="buypre"><a href="' . esc_url(__('http://www.insertcart.com/wrock-metro','wrockmetro')) . '" target="_blank">' . esc_attr__( 'Upgrade Now', 'wrockmetro' ) . '</a></span><span class="buypred"><a href="' . esc_url(__('http://forum.insertcart.com/','wrockmetro')) . '" target="_blank">' . esc_attr__( 'Support Forum !', 'wrockmetro' ) . '</a></span></p>',
            'class' => 'tesingh',
            'type' => 'info');
	$options[] = array(
		'name' => __('Basic Settings', 'wrockmetro'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Custom Favicon URL', 'wrockmetro'),
		'desc' => __('Enter Favicon Image URL Specify a 16px x 16px image in .ico format .', 'wrockmetro'),
		'id' => 'wrockmetro_favicon',
		'std' => '',
		'type' => 'upload');
	$options[] = array(
		'name' => __('Upload Site Logo', 'wrockmetro'),
		'desc' => __('Upload Website Logo wide: 470px Height: 80px here. Note you can upload any size it will automatic resize .', 'wrockmetro'),
		'id' => 'wrockmetro_logo',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Show Author Profile', 'wrockmetro'),
		'desc' => __('Check the box to show Author Profile Below the Post and Pages.', 'wrockmetro'),
		'id' => 'wrockmetro_author',
		'std' => '',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Show Latest Posts in Sidebar', 'wrockmetro'),
		'desc' => __('Show 5 Latest Posts with Thumbnail in Sidebar.', 'wrockmetro'),
		'id' => 'wrockmetro_activate_ltposts',
		'std' => '1',
		'type' => 'checkbox');
	$options[] = array(
		'name' => __('Show Search on top navigation', 'wrockmetro'),
		'desc' => __('Check or Uncheck Box to show or hide search', 'wrockmetro'),
		'id' => 'wrockmetro_topsearch',
		'std' => '1',
		'type' => 'checkbox');
	
		
$options[] = array(
		'name' => __('Social Media', 'wrockmetro'),
		'type' => 'heading');
		$options[] = array(
		'name' => __('Show share buttons on Top Navigation', 'wrockmetro'),
		'desc' => __('Check or uncheck Box to show and hide share buttons', 'wrockmetro'),
		'id' => 'wrockmetro_sharebut',
		'std' => '',
		'type' => 'checkbox');
		$options[] = array(
		'name' => __('Facebook Link', 'wrockmetro'),
		'desc' => __('Enter your Facebook URL if you have one.', 'wrockmetro'),
		'id' => 'wrockmetro_fb',
		'std' => '',
		'type' => 'text');
		$options[] = array(
		'name' => __('Twitter Follow Link', 'wrockmetro'),
		'desc' => __('Enter your Twitter URL if you have one.', 'wrockmetro'),
		'id' => 'wrockmetro_tw',
		'std' => '',
		'type' => 'text');
		$options[] = array(
		'name' => __('YouTube Channel Link', 'wrockmetro'),
		'desc' => __('Enter your YouTube URL if you have one.', 'wrockmetro'),
		'id' => 'wrockmetro_youtube',
		'std' => '',
		'type' => 'text');
		$options[] = array(
		'name' => __('Google+ URL', 'wrockmetro'),
		'desc' => __('Enter your Google+ Link if you have one.', 'wrockmetro'),
		'id' => 'wrockmetro_gp',
		'std' => '',
		'type' => 'text');
		$options[] = array(
		'name' => __('RSS Feed URL', 'wrockmetro'),
		'desc' => __('Enter your RSS Feed URL if you have one', 'wrockmetro'),
		'id' => 'wrockmetro_rss',
		'std' => '',
		'type' => 'text');
		$options[] = array(
		'name' => __('Linked In URL', 'wrockmetro'),
		'desc' => __('Enter your Linkedin URL if you have one.', 'wrockmetro'),
		'id' => 'wrockmetro_in',
		'std' => '',
		'type' => 'text');
		$options[] = array(
		'name' => __('Pinterest In URL', 'wrockmetro'),
		'desc' => __('Enter your Pinterest URL if you have one.', 'wrockmetro'),
		'id' => 'wrockmetro_pinterest',
		'std' => '',
		'type' => 'text');
		$options[] = array(
		'name' => __('Email Address to Contact', 'wrockmetro'),
		'desc' => __('Enter your email address if you have one', 'wrockmetro'),
		'id' => 'wrockmetro_email',
		'std' => '',
		'type' => 'text');
		$options[] = array(
		'name' => __('Stumbleupon In URL', 'wrockmetro'),
		'desc' => __('Enter your Stumbleupon  address if you have one', 'wrockmetro'),
		'id' => 'wrockmetro_stumbleupon',
		'std' => '',
		'type' => 'text');
		
		

		
$options[] = array(
		'name' => __('Custom Styling', 'wrockmetro'),
		'type' => 'heading');
	$options[] = array(
		'name' => __('Custom CSS', 'wrockmetro'),
		'desc' => __('Quickly add some CSS to your theme by adding it to this block.', 'wrockmetro'),
		'id' => 'wrockmetro_customcss',
		'std' => '',
		'type' => 'textarea');
		
$options[] = array(
		'name' => __('Ads Management', 'wrockmetro'),
		'type' => 'heading');
	$options[] = array(
		'name' => __('Paste Ads code below navigation', 'wrockmetro'),
		'desc' => __('Activate Ads Space Below Navigation and put code in below test field.', 'wrockmetro'),
		'id' => 'wrockmetro_banner_top',
		'std' => '',
		'type' => 'textarea');
	$options[] = array(
		 'name' => __( 'AD Code For Single Post', 'wrockmetro' ),
            'desc' => 'Paste Ad code for single post it show ads below post title and before content.',
            'id' => 'wrockmetro_ad2',
            'std' => '',
            'type' => 'textarea');
     $options[] = array(
		'name' => __( 'AD Code For Footer', 'wrockmetro' ),
		'desc' => __('Paste Ad Code for Footer Area.', 'wrockmetro'),
            'id' => 'wrockmetro_ad1',
            'std' => '',
            'type' => 'textarea');	
		
$options[] = array(
		'name' => __('Premium Features', 'wrockmetro'),
		'type' => 'heading');
	
				
		$options[] = array(
		'desc' => '<span class="pre-title">New Features</span>', 
		'type' => 'info');
		
		$options[] = array(
		'name' => __('Popular Posts in Sidebar', 'wrockmetro'),
		'desc' => __('Display Popular Post Sidebar Widget.', 'wrockmetro'),
		'id' => 'wrockmetro_popular',
		'std' => '',
		'type' => 'checkbox');
		$options[] = array(
		'name' => __('Floating Share Buttons', 'wrockmetro'),
		'desc' => __('Display Floating Share widget with count.', 'wrockmetro'),
		'id' => 'wrockmetro_flowshare',
		'std' => '',
		'type' => 'checkbox');
		
		$options[] = array(
		'name' => __('Responsive Website Design', 'wrockmetro'),
		'desc' => __('Enable Responsive Design for you website to increase exprience on Mobile Devices', 'wrockmetro'),
		'id' => 'wrockmetro_responsive',
		'std' => '',
		'type' => 'checkbox');
		$options[] = array(
		'name' => __('Excerpt Length (Number of words display in post description)', 'wrockmetro'),
		'desc' => __('Number of words display in every post description Default is 45.', 'wrockmetro'),
		'id' => 'wrockmetro_excerp',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

		$options[] = array(
		'name' => __('Home Icon from Top and Main Navigation', 'wrockmetro'),
		'desc' => __('Show or Hide Home Icon.', 'wrockmetro'),
		'id' => 'wrockmetro_homeicon',
		'std' => 'on',
		'type' => 'radio',
		'options' => array(
						'on' => 'Show',
						'off' => 'Hide'
						));
		$options[] = array(
		'name' => __('Change Link Color', 'wrockmetro'),
		'desc' => __('Select Links Color.', 'wrockmetro'),
		'id' => 'wrockmetro_linkcolor',
		'std' => '#2D89A7',
		'type' => 'color' 
);
		$options[] = array(
		'desc' => __('Change Link Hover Color.', 'wrockmetro'),
		'id' => 'wrockmetro_linkhover',
		'std' => '#359BED',
		'type' => 'color' );
		$options[] = array(
		'name' => __('Top Menu & Main Navigation Colors', 'wrockmetro'),
		'desc' => __('Top Menu Background Color.', 'wrockmetro'),
		'id' => 'wrockmetro_topnavibgcolor',
		'std' => '#2693BA',
		'type' => 'color' );
		$options[] = array(
		'desc' => __('Top Menu Hover Background Color.', 'wrockmetro'),
		'id' => 'wrockmetro_topnavibgcolorh',
		'std' => '#359BED',
		'type' => 'color' );
		$options[] = array(
		'desc' => __('Main Naigation Background.', 'wrockmetro'),
		'id' => 'wrockmetro_mainnavibg',
		'std' => '#333',
		'type' => 'color' );
		
		$options[] = array(
		'desc' => __('Main Navigation hover Color.', 'wrockmetro'),
		'id' => 'wrockmetro_mainnavilinkcolor',
		'std' => '#359BED',
		'type' => 'color' );
		
		
		$options[] = array(
		'name' => __('Page Number Navigation Color Chnage ', 'wrockmetro'),
		'desc' => __('Change Current Page Background.', 'wrockmetro'),
		'id' => 'wrockmetro_pageanvibg',
		'std' => '#333',
		'type' => 'color' );
		$options[] = array(
			'desc' => __('Change background color of other pages.', 'wrockmetro'),
		'id' => 'wrockmetro_pageanvia',
		'std' => '#359BED',
		'type' => 'color' );
		$options[] = array(
		'desc' => __('Numbers text Color Change.', 'wrockmetro'),
		'id' => 'wrockmetro_pageanvilink',
		'std' => '#ffffff',
		'type' => 'color' );
		
		$options[] = array(
		'name' => __('Sidebar Color Customize ', 'wrockmetro'),
		'desc' => __('Change Sidebar 1 (left) heading background color.', 'wrockmetro'),
		'id' => 'wrockmetro_sidebarhead',
		'std' => '#2693BA',
		'type' => 'color' );
		$options[] = array(
		'desc' => __('Change Sidebar 2 (Right) heading background color.', 'wrockmetro'),
		'id' => 'wrockmetro_sidebarhead2',
		'std' => '#2693BA',
		'type' => 'color' );
		
		$options[] = array( 'name' => __('Customize Theme Fonts', 'wrockmetro'),
		'desc' => __('Change <b>Body (Theme) Font</b> color and Size.', 'wrockmetro'),
		'id' => "wrockmetro_bodyfonts",
		'std' => $typography_defaults,
		'type' => 'typography' );
		$options[] = array( 
		'desc' => __('Change <b>H1 Posts and Pages Title </b>Font color or Size.', 'wrockmetro'),
		'id' => "wrockmetro_entrytitle",
		'std' => $typography_entrytitle,
		'type' => 'typography' );
		$options[] = array(
		'name' => __('Footer Widget Area Settings', 'wrockmetro'),
		'desc' => __('Show or Hide Footer Widget Area.', 'wrockmetro'),
		'id' => 'wrockmetro_footerwidget',
		'std' => 'on',
		'type' => 'radio',
		'options' => array(
						'on' => 'Show',
						'off' => 'Hide'
						));
				
		$options[] = array(
		'name' => __('Edit "Read More" Button', 'wrockmetro'),
		'desc' => __('Show or Hide "Continue reading" or read more Button  Button .', 'wrockmetro'),
		'id' => 'wrockmetro_countinue',
		'std' => 'on',
		'type' => 'radio',
		'options' => array(
						'on' => 'Show',
						'off' => 'Hide'
						));
		$options[] = array(
		'desc' => __('Read More Button Color Change.', 'wrockmetro'),
		'id' => 'wrockmetro_readmorecolor',
		'std' => '#359BED',
		'type' => 'color' );					
		$options[] = array(
		    'desc' => 'Paste You Custom text for Continue reading <b>Default: Continue reading &raquo; </b>.',
            'id' => 'wrockmetro_fullstory',
            'std' => 'Read More &raquo;',
            'type' => 'text');				

		$options[] = array(
		'name' => "Website layout",
		'desc' => "Select Images for Website layout.",
		'id' => "wrockmetro_layout",
		'std' => "s2",
		'type' => "images",
		'options' => array(
			's2' => $imagepath . 's2.png',
			's1' => $imagepath . 's1.png',
			'sl' => $imagepath . 'sl.png',
			'fc' => $imagepath . 'fc.png')
	);
		$options[] = array(
		'desc' => '<span class="pre-titleseo">SEO & Meta Options</span>', 
		'type' => 'info');
		$options[] = array(
		'name' => __('Google+ Publisher URL', 'wrockmetro'),
		'desc' => __('Paste Your Google Publisher URL https://plus.google.com/YOUR-GOOGLE+ID/posts.', 'wrockmetro'),
		'id' => 'wrockmetro_googlepub',
		'std' => '',
		'type' => 'text');
		$options[] = array(
		'name' => __('Bing Site Verification', 'wrockmetro'),
		'desc' => __('Enter the ID only. It will be verified by Yahoo as well.', 'wrockmetro'),
		'id' => 'wrockmetro_bingvari',
		'std' => '',
		'type' => 'text');
		$options[] = array(
		'name' => __('Google Site verification', 'wrockmetro'),
		'desc' => __('Enter your ID only.', 'wrockmetro'),
		'id' => 'wrockmetro_googlevari',
		'std' => '',
		'type' => 'text');
		
		
		$options[] = array(
		'desc' => '<span class="pre-titlecus">Customization</span>', 
		'type' => 'info');
		$options[] = array(
		'name' => __('Breadcrumbs Options', 'wrockmetro'),
		'desc' => __('Check Box to Enable or Disable Breadcrumbs.', 'wrockmetro'),
		'id' => 'wrockmetro_bread',
		'std' => '1',
		'type' => 'checkbox');
		$options[] = array(
		'name' => __('Enable Post Meta Info.', 'wrockmetro'),
		'desc' => __('Check Box to Show or Hide Tags ', 'wrockmetro'),
		'id' => 'wrockmetro_tags',
		'std' => '1',
		'type' => 'checkbox');
		$options[] = array(
		'desc' => __('Check Box to Show or Hide Comments ', 'wrockmetro'),
		'id' => 'wrockmetro_comments',
		'std' => '1',
		'type' => 'checkbox');
		$options[] = array(
		'desc' => __('Check Box to Show or Hide Categories ', 'wrockmetro'),
		'id' => 'wrockmetro_categrious',
		'std' => '1',
		'type' => 'checkbox');
		$options[] = array(
		'desc' => __('Check Box to Show or Hide Author and date ', 'wrockmetro'),
		'id' => 'wrockmetro_autodate',
		'std' => '1',
		'type' => 'checkbox');
			
		$options[] = array(
		'name' => __('Next and Previous Post Link', 'wrockmetro'),
		'desc' => __('Show or Hide Next and Previous Post Link below every post.', 'wrockmetro'),
		'id' => 'wrockmetro_links',
		'std' => 'on',
		'type' => 'radio',
		'options' => array(
						'on' => 'Show',
						'off' => 'Hide'
						));
		$options[] = array(
		'name' => __('Show or Hide Copy Right Text', 'wrockmetro'),
		'desc' => __('Show or Hide Copyright Text and Link.', 'wrockmetro'),
		'id' => 'wrockmetro_copyright',
		'std' => 'on',
		'type' => 'radio',
		'options' => array(
						'on' => 'Show',
						'off' => 'Hide'
						));
		$options[] = array(
		    'desc' => 'Paste Ad code for single post it show ads below post title and before content.',
            'id' => 'wrockmetro_ftarea',
            'std' => '&#169; 2013 Theme by: <a href="http://www.insertcart.com/wrock-metro" title="wRock.Org">InsertCart</a> | Powered by <a href="http://wordpress.org/">WordPress</a>',
            'type' => 'textarea');				

	return $options;
}