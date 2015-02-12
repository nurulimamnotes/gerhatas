<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="wrapper">
<div id="top-menu">	
	<div id="top-menu-inner" class="clearfix">
<div class="first">
			<?php	if ('wp_nav_menu') {		wp_nav_menu(array('container' => '', 'theme_location' => 'wrockmetro-top-menu', 'fallback_cb' => 'wrockmetro_hdmenu'));
			}	else {	wrockmetro_hdmenu();}	
			?>
	</div></div>	</div> 
<!-- BEGIN HEADER -->
	<div id="header">
    <div id="header-inner" class="clearfix">
		<div id="logo">
			<?php if (of_get_option( 'wrockmetro_logo' )): ?>
                      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo of_get_option( 'wrockmetro_logo' ); ?>" alt="" /></a>
    	<?php else : ?> 
            <h1 class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
   <?php endif; ?>
		</div>
		<?php if ( of_get_option('wrockmetro_topsearch' ) =='1') { echo '<div id="search">'; get_search_form(); echo '</div>'; } ?>
				
	    </div> 	</div> 
	<!-- BEGIN TOP NAVIGATION -->		
	<div id="navigation" class="nav"> 
    <div id="navigation-inner" class="clearfix">
	<div class="secondary">		<?php
			if (('wp_nav_menu')) {
				wp_nav_menu(array('container' => '', 'theme_location' => 'wrockmetro-navigation', 'fallback_cb' => 'wrockmetro_hdmenu'));
			}
			else {
				wrockmetro_hdmenu();
			}
			?>
		</div></div></div> 
	<!-- END TOP NAVIGATION -->