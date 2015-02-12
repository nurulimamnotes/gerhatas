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
?>

<?php if ( $has_thumbnail ): ?>
    <div class="thumbnail">

        <div class="thumbnail-wrapper ">

            <?php
            if( $has_thumbnail ) {

                $yit_blog_size="blog_big";

                if(yit_get_sidebar_layout()){$yit_blog_size="blog_big";}else{$yit_blog_size="blog_very_big";}
                yit_image( "size={$yit_blog_size}&alt=blogimage" );

                $post_format = get_post_format() == '' ? 'standard' : get_post_format();

                if( yit_get_option( 'blog-show-icon-wrapper' ) && $post_format == 'standard' ) : ?>
                    <div class="thumb-icon-wrapper"></div>
                <?php endif;

                if( yit_get_option( 'blog-show-icon-wrapper' ) && $post_format == 'gallery' ) : ?>
                    <div class="thumb-icon-wrapper-gallery"></div>
                <?php endif;

                if( yit_get_option( 'blog-show-icon-wrapper' ) && $post_format != 'standard' && $post_format != 'gallery' ) : ?>
                    <div class="thumb-icon-wrapper"></div>
                <?php endif;
            }
            ?>
        </div>
    </div>
<?php endif ?>