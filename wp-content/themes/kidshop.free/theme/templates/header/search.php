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

$responsive_header_search = yit_get_option('responsive-show-header-search');
global $yith_wcas;

?>
<?php if( isset($yith_wcas) ): ?>
    <?php if ( ! $responsive_header_search ) { ?><div class="hidden-phone"><?php } ?>
    <?php echo do_shortcode('[yith_woocommerce_ajax_search]') ?>
    <?php if ( ! $responsive_header_search ) { ?></div><?php } ?>
<?php else: ?>
    <?php if ( ! $responsive_header_search ) { ?><div class="hidden-phone"><?php } the_widget('search_mini'); if ( ! $responsive_header_search ) { ?></div><?php } ?>
<?php endif ?>
