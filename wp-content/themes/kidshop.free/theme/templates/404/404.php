<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files there is a collection of a functions useful for the core
 * of the framework.   
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

$span_image = yit_get_sidebar_layout() == 'sidebar-no' ? 5 : 4;
$span_text = yit_get_sidebar_layout() == 'sidebar-no' ? 6 : 5;
if( !yit_get_option( '404-custom' ) ) : ?>
    <div class="span5 ">
        <img class="error-404-image group" src="<?php echo get_template_directory_uri() ?>/images/404.png" title="<?php _e( 'Error 404', 'yit' ); ?>" alt="404" />
    </div>
    <div class="error-404-text group span6">
        <h2><?php _e('OPS! It seems you missed a page', 'yit'); ?></h2>
        <p><strong><?php _e('Here what you could do', 'yit')?></strong></p>
        <ul>
            <li><?php _e('1 . Go back to the previous page.', 'yit'); ?></li>
            <li><?php _e('2 .  Use the search form, to search for your products.', 'yit'); ?></li>
            <li><?php _e('3 . Follow these links to get you back on', 'yit'); ?></li>
        </ul>
        <p><?php printf( __( '<a href="%s" class="button">return home</a>', 'yit' ), home_url() ) ?>
        
    </div>

<?php
else : ?>

	<div class="border-img-bottom">
		<div class="border-img">		
			<img class="error-404-image group" src="<?php echo yit_get_option( '404-image' ); ?>" title="<?php _e( 'Error 404', 'yit' ); ?>" alt="<?php _e( '404 Error', 'yit' ) ?>" />
		</div>
	</div>
    <div class="error-404-text group">    	
    	<?php echo yit_convert_tags( yit_addp( do_shortcode( stripslashes( yit_get_option( '404-text' ) ) ) ) ) ?>
   </div>
   <div class="error-404-search group">
    	<?php get_search_form() ?>
    </div>   
<?php endif;
?>