<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

add_action('wp_enqueue_scripts', 'add_shortcodes_theme_css');
if( !function_exists( 'add_shortcodes_theme_css' ) ) {
	/*
	 * Add style of widgets in theme
	 */
	function add_shortcodes_theme_css(){
		$url = YIT_THEME_ASSETS_URL . '/css/shortcodes.css';
		//wp_register_style('shortcodes_theme_css', $url);
		yit_enqueue_style(1201, 'shortcodes_theme_css', $url);
	}
}