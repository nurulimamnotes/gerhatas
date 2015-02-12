<?php
/**
 * Other actions (Compare, Wishlist, Share)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop;

$actions = array();

if (  isset( $woocommerce_loop ) && ((is_product() && yit_get_option('shop-single-show-share')) || yit_get_option('shop-share-lite-style') ) ) {
    //$actions['share']  = '<div class="action share"><a href="#" class="yit_share">' . __( 'Share it', 'yit' ) . '</a></div>';
    //$actions['share'] .= '<div class="product-share">' . do_shortcode('[share title="' . __('Share on:', 'yit') . ' " icon_type="round" socials="facebook, twitter, google, pinterest, bookmark"]') . '</div>';
}

if ( empty( $actions ) ) return;

// add first class in the first item
$actions = array_values( $actions );
$actions[0] = str_replace( '<div class="action ', '<div class="action first ', $actions[0] );
?>

<div class="product-actions<?php if( isset( $woocommerce_loop ) ) echo "-loop"; ?> buttons_<?php echo count( $actions ); ?> group" >
    <?php echo implode( array_values( $actions ), ' <div class="sep">/</div> ' ); ?>
</div>

<?php if( !yit_get_option( 'shop-enabled' ) && ! isset( $woocommerce_loop ) ) : ?><div class="clear"></div><?php endif ?>