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

/* === HEADER */
if( !function_exists( 'yit_head' ) ) {
    function yit_head() {
        yit_get_template( '/header/head.php' );
    }
}

if( !function_exists( 'yit_add_custom_styles' ) ) {
    function yit_add_custom_styles() {        
        if( yit_get_option( 'responsive-enabled' ) ) {
            yit_enqueue_style( 9994, 'responsive', YIT_CORE_ASSETS_URL . '/css/responsive.css', array(), '1.0.0', 'all' );
            yit_enqueue_style( 9995, 'theme-responsive', get_template_directory_uri() . '/css/responsive.css', false, '2.0', 'all' );
        }
        yit_enqueue_style( 9996, 'theme-responsive-1200', get_template_directory_uri() . '/css/responsive-1200.css', false, '2.0', 'all' );
        $custom_css = locate_template( 'custom.css' );
        $custom_css = str_replace( array( get_stylesheet_directory(), get_template_directory() ), array( get_stylesheet_directory_uri(), get_template_directory_uri() ), $custom_css );
        
        yit_enqueue_style( 99998, 'custom', $custom_css, array(), false, 'all', true );
		yit_enqueue_style( 99999, 'custom-free', YIT_THEME_ASSETS_URL . '/css/custom-free.css', array(), false, 'all', true );
    }
}

if( !function_exists( 'yit_add_custom_scripts' ) ) {
    function yit_add_custom_scripts() {
    	if( yit_get_option( 'responsive-enabled' ) ) {

            if( is_child_theme() && file_exists( get_stylesheet_directory() . '/js/responsive.js' ) ) {
                wp_enqueue_script( 'responsive-theme', get_stylesheet_directory_uri() . '/js/responsive.js' , array( 'jquery' ), '1.0', true );
            } else {
                wp_enqueue_script( 'responsive-theme', get_template_directory_uri() . '/js/responsive.js' , array( 'jquery' ), '1.0', true );
            }

            wp_enqueue_script( 'retina-js', get_template_directory_uri() . '/theme/assets/js/retina.js' , array( 'jquery' ), '1.0', true );
    	}
    }
}

if( !function_exists( 'yit_topbar' ) ) {
    function yit_topbar( $span ) {
        yit_get_template( '/header/topbar.php', array('span' => $span) );
    }
}

if( !function_exists( 'yit_topbar_login' ) ) {
    function yit_topbar_login() {
        yit_get_template( '/header/login.php' );
    }
}

if( !function_exists( 'yit_header' ) ) {
    function yit_header() {
        yit_get_template( '/header/header.php' );
    }
}

if( !function_exists( 'yit_header_search_box' ) ) {
    function yit_header_search_box() {
        yit_get_template( '/header/search.php' );
    }
}

if( !function_exists( 'yit_header_skin' ) ) {
    function yit_header_skin( $skin = 'skin1' ) {
        yit_get_template( '/header/skins/' . $skin . '.php' );
    }
}

if( !function_exists( 'yit_logo' ) ) {
    function yit_logo() {
        yit_get_template( '/header/logo.php' );
    }
}

if( !function_exists( 'yit_header_sidebar' ) ) {
    function yit_header_sidebar() {
        yit_get_template( '/header/header-sidebar.php' );
    }
}

if( !function_exists( 'yit_header_cartsearch' ) ) {
    function yit_header_cartsearch() {
        yit_get_template( '/header/cart-search.php' );
    }
}

if( !function_exists( 'yit_main_navigation' ) ) {
    function yit_main_navigation() {
        yit_get_template( '/header/main-navigation.php' );
    }
}

if( !function_exists( 'yit_map' ) ) {
    function yit_map() {
        yit_get_template( '/header/map.php' );
    }
}

if( !function_exists( 'yit_page_meta' ) ) {
    function yit_page_meta() {
        yit_get_template( '/header/page-meta.php' );
    }
}

if( !function_exists( 'yit_slogan' ) ) {
    function yit_slogan() {
        yit_get_template( '/header/slogan.php' );
    }
}
/*
if( !function_exists( 'yit_slider_section' ) ) {
    function yit_slider_section() {
        yit_get_template( '/header/slider.php' );
    }
}*/

/* === SERVICES */
if( !function_exists( 'yit_single_service' ) ) {
	function yit_single_service() {
		yit_get_template( '/services/service.php' );
	}
}

if( !function_exists( 'yit_page_menu_args' ) ) {
	function yit_page_menu_args( $args ) {
	    $args['show_home'] = true;
	    //$args['link_after'] = '<div style="position:absolute; left: 50%;"><span class="triangle">&nbsp;</span></div>';
		$args['menu_class'] = 'sf-menu';
	    return $args;
	}
}

if( !function_exists( 'yit_page_menu' ) ) {
	function yit_page_menu( $menu ) {
        $menu = str_replace( "<ul class='children'>", '<div class="submenu"><ul class=\'children\'>', $menu );
        $menu = str_replace( '<div class="sf-menu">', '', $menu );
        $menu = substr( $menu, 0, strlen($menu) - 7 );

        return force_balance_tags( $menu );
	}
}

if( !function_exists( 'yit_header_background' ) ) {
    /**
     * Define the body background for the page. 
     * 
     * First get the setting for the current page. If a setting is not defined 
     * in the current page, will be get the setting from the theme options.
     * All css will be shown in head tag, by the action 'wp_head'                    
     * 
     * @since 1.0.0
     */
    function yit_header_background() {
        global $post;
        
        $post_id = yit_post_id();

        if( !get_post_meta( $post_id, '_enable_custom_header', true ) ) {
            return;
        }

        $css        = array();
        //$height     = get_post_meta( $post_id, '_header-height', true );
        $color      = get_post_meta( $post_id, '_background-header', true );
        $image      = get_post_meta( $post_id, '_background-header-image', true );
        $repeat     = get_post_meta( $post_id, '_background-header-repeat', true );
        $position   = get_post_meta( $post_id, '_background-header-position', true );
        $attachment = get_post_meta( $post_id, '_background-header-attachment', true );

//        if( !empty( $height ) && $height > 0 ) {
//            $css[] = 'min-height: ' . $height . 'px;';
//        }

        if( !empty( $color ) ) {
            $css[] = 'background-color: ' . $color . ';';
        }

        if ( !empty( $image ) ) {
            $css[] = "background-image: url('$image');";

            if ( !empty( $repeat ) )     {
                $css[] = "background-repeat: $repeat;";
            }

            if ( !empty( $position ) )   {
                $css[] = "background-position: $position;";
            }

            if ( !empty( $attachment ) ) {
                $css[] = "background-attachment: $attachment;";
            }
        }

        if ( empty( $css ) ) return;

        ?>
        <style type="text/css">
            #header { <?php echo implode( ' ', $css ) ?> }
        </style>
        <?php
    }
}
if( !function_exists( 'yit_meta_bg' ) ) {
    function yit_meta_bg() {
        global $post;
        
        $post_id = isset( $post->ID ) ? $post->ID : 0;
        
        // get color and background from postmeta
        $color = get_post_meta( $post_id, '_bg_color', true );
        
        // get the color and background from theme options, if above are empty
        $background = yit_get_option('container-background');
        if ( empty( $color ) ) {
            $color = $background;
        }
                
        $css = array();
        
        if ( ! empty( $color ) ) { $css[] = "background-color: $color;"; }
        
        if ( empty( $css ) ) return;
        
        ?>
        <style type="text/css">
            .blog-big .meta, .blog-small .meta { <?php echo implode( ' ', $css ) ?> }      
        </style>
        <?php
    }
}
/* === PAGE */
if( !function_exists( 'yit_loop_page' ) ) {
    function yit_loop_page() {
        yit_get_template( '/loop/page/content.php' );
    }
}

if( !function_exists( 'yit_404' ) ) {
    function yit_404() {
        yit_get_template( '404/404.php' );
    }
}

if( !function_exists( 'yit_header_cart' ) ) {
    function yit_header_cart() {
        yit_get_template( 'header/cart.php' );
    }
}

if( !function_exists( 'yit_is_primary_start' ) ) {
    function yit_is_primary_start() {
        global $is_primary;
        $is_primary = true;
    }
}

if( !function_exists( 'yit_is_primary_end' ) ) {
    function yit_is_primary_end() {
        global $is_primary;
        $is_primary = false;
    }
}

/* === LOOP */
if( !function_exists( 'yit_loop' ) ) {
    function yit_loop() {
        yit_get_template( '/loop/loop.php' );
    }
}

if( !function_exists( 'yit_loop_internal' ) ) {
    function yit_loop_internal() {
        yit_get_template( '/loop/loop_internal.php' );
    }
}

if( !function_exists( 'yit_loop_blog_big' ) ) {
    function yit_loop_blog_big() {
        yit_get_template( '/blog/big/markup.php' );
    }
}

if( !function_exists( 'yit_archives' ) ) {
    function yit_archives() {
        yit_get_template( '/loop/archives.php' );
    }
}

/* === COMMENTS */
if( !function_exists( 'yit_comments' ) ) {
    function yit_comments() {
        yit_get_template( '/comments/markup.php' );
    }
}

if( !function_exists( 'yit_comments_password_required' ) ) {
    function yit_comments_password_required() {
        yit_get_template( '/comments/password-required.php' );
    }
}

if( !function_exists( 'yit_comments_navigation' ) ) {
    function yit_comments_navigation() {
        yit_get_template( '/comments/navigation.php' );
    }
}

if( !function_exists( 'yit_trackbacks' ) ) {
    function yit_trackbacks() {
        yit_get_template( '/comments/trackbacks.php' );
    }
}

/* === MISC */
if( !function_exists( 'yit_searchform' ) ) {
    function yit_searchform( $post_type ) {
        yit_get_template( '/searchform/' . $post_type . '.php' );
    }
}

if( !function_exists( 'yit_extra_content' ) ) {
    function yit_extra_content() {
        yit_get_template( '/loop/extra-content.php' );
    }
}

/* === FOOTER */
if( !function_exists( 'yit_footer' ) ) {
    function yit_footer() {
        yit_get_template( '/footer/footer.php' );
    }
}

if( !function_exists( 'yit_copyright' ) ) {
    function yit_copyright() {
        yit_get_template( '/footer/copyright.php' );
    }
}

/* === SIDEBAR */
if( !function_exists( 'yit_default_sidebar' ) ) {
    function yit_default_sidebar() {
        yit_get_template( '/sidebars/default.php' );
    }
}

/* === TESTIMONIALS */
if( !function_exists( 'yit_single_testimonial' ) ) {
    function yit_single_testimonial() {
        yit_get_template( '/testimonial/testimonial.php' );
    }
}

/* === COMMENTS */
if( !function_exists( 'yit_comment' ) ) {
    /**
     * Print comments
     * 
     * @param object $comment
     * @param array $args
     * @param int $depth
     * @return string
     * @since 1.0.0
     */
    function yit_comment( $comment, $args, $depth ) {
        yit_get_template('comments/comment.php', array( 'comment' => $comment, 'args' => $args, 'depth' => $depth ));
    }
}

if( !function_exists( 'yit_unregister_post_types' ) ) {
	function yit_unregister_post_types() {
		$post_types = array('services');
		
		foreach($post_types as $pt) {
			yit_unregister_post_type($pt);
		}
	}
}

if( !function_exists( 'yit_simple_read_more_classes' ) ) {
    /**
     * Add a class to the read more if it is not a button shortcode
     * 
     * @param string $link
     * @return string
     * @since 1.0.0
     */ 
    function yit_simple_read_more_classes( $link ) {        
        if( !strpos( $link, 'class="btn' ) ) {
            $link = '<br />' . $link;
            return str_replace( 'class="', 'class="not-btn alt-button buttons ', $link );
        }
        
        return $link;
    }
}



if( !function_exists('yit_remove_first_post_image') ) {
    /**
     * Add a class to the read more if it is not a button shortcode
     * 
	 * Currenctly disabled
	 * 
     * @param string $the_content
     * @return string
     * @since 1.0.0
     */
	function yit_remove_first_post_image( $the_content ) {
		if( yit_get_option('blog-show-first-content-image') ) {
			$output = preg_match_all('/^((<[a|span|p|div][^>]*>)*)<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $the_content, $matches);
			
			if( isset($matches[0][0]) && $matches[0][0]) {
				$the_content = str_replace($matches[0][0], '', $the_content);
			}
		}

		return $the_content;
	}
}

if( !function_exists('yit_contact_form_cols') ) {
    function yit_contact_form_cols( $cols, $form_name ) {
        if( $form_name == 'quick-contact' ) {
            return 20;
        } else {
            return $cols;
        }
    }
}

if( !function_exists( 'yit_decoration_header' ) ) {
    function yit_decoration_header() {

        if(yit_get_option('layout-type') == 'boxed'){
            echo '<div class="content-left-decoration"></div>';
            echo '<div class="content-right-decoration"></div>';
        }
    }
}