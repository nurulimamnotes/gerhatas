<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $product, $woocommerce_loop;

$actions = array();

if ( ( get_option( 'yith_woocompare_compare_button_in_products_list' ) == 'yes' && !is_product() ) ||
    ( get_option( 'yith_woocompare_compare_button_in_product_page' ) == 'yes' && is_product() ) ) {
    $actions['compare']  = shortcode_exists( 'yith_compare_button' ) ? '<div class="action compare">' . do_shortcode('[yith_compare_button type="link"]') . '</div>' : '';
}

$actions['wishlist'] = '<div class="action wishlist">' . do_shortcode('[yith_wcwl_add_to_wishlist]') . '</div>';



/*if( ( yit_get_option('shop-view-show-share') && !is_product() ) ||
    ( yit_get_option('shop-single-show-share') && is_product() )) {
    if( yit_get_option('shop-share-lite-style') ) {
        $actions['share']    = '<a href="#" class="yit_share">' . __( 'Share', 'yit' ) . '</a>';
    } elseif ( isset( $woocommerce->integrations->integrations['sharethis'] ) && !empty( $woocommerce->integrations->integrations['sharethis']->publisher_id ) ) {
        $actions['share']    = sprintf('<a href="%s" rel="nofollow" title="%s" class="share" id="%s" onclick="return false;">%s</a>', '#', __( 'Share', 'yit' ), "share_$product->id", __( 'Share', 'yit' ));;
    }
}*/

if ( ! defined( 'YITH_WCWL' ) || get_option( 'yith_wcwl_enabled' ) != 'yes' || empty( $actions['wishlist'] ) ) { unset( $actions['wishlist'] ); }


foreach ( array( 'wishlist' ) as $button ) {



    if ( ! is_product() && ! yit_get_option('shop-view-show-'.$button) ||
        is_product() && ! yit_get_option('shop-single-show-'.$button) ||
        empty( $actions[$button] )
    ) {

        unset( $actions[$button] );
    }
}

if (  isset( $woocommerce_loop ) && ((is_product() && yit_get_option('shop-single-show-share')) || yit_get_option('shop-share-lite-style') ) ) {
    //$actions['share']  = '<div class="action share"><a href="#" class="yit_share">' . __( 'Share it', 'yit' ) . '</a></div>';
    //$actions['share'] .= '<div class="product-share">' . do_shortcode('[share title="' . __('Share on:', 'yit') . ' " icon_type="round" socials="facebook, twitter, google, pinterest, bookmark"]') . '</div>';
}

if ( empty( $actions ) ) return;

// add first class in the first item
$actions = array_values( $actions );
$actions[0] = str_replace( '<div class="action ', '<div class="action first ', $actions[0] );


    // add share for single product
    global $woocommerce_loop;
    if ( ! isset( $woocommerce_loop ) && yit_get_option('shop-single-show-share') ) {
    //echo '<div class="product-share"><span class="sharetext">'. implode( array_values( $actions ), ' / ' ) .' / <div class="action share">' . __( 'share on', 'yit' ) . '</div></span>' . do_shortcode('[share icon_type="round" socials="facebook, twitter, google, pinterest, bookmark"]') . '</div><div class="clearfix"></div>';
    }

?>
<?php do_action('woocommerce_share'); // Sharing plugins can hook into here ?>