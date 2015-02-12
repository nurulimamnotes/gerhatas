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

function yit_get_button_class( $status = 'normal', $style = 'default'  ){

    $button_style = apply_filters('yit_buttons_style', array(

        'default' => array(

            'normal' => '
                        .button,
                        .sidebar .button,
                        .pricing_box p.button a,
                        .price-table .body .more a,
                        .btn.btn-button,
                        .woocommerce ul.products li.product.grid .buttons-list-wrapper a.button,
                        .woocommerce div.product form.cart .button,
                        .woocommerce a.button,
                        .woocommerce button.button,
                        .woocommerce input.button,
                        .woocommerce #respond input#submit,
                        #respond #commentsubmit,
                        .woocommerce #content input.button,
                        .woocommerce-page a.button,
                        .woocommerce-page button.button,
                        .woocommerce-page input.button,
                        .woocommerce-page #respond input#submit,
                        .woocommerce-page #content input.button,
                        .woocommerce .wishlist_table .product-add-to-cart a.add_to_cart.button.alt,
                        .woocommerce ul.products li.product.grid .product-main-meta .grid-add-to-cart a.button,
                        .sidebar .widget_product_search #searchform #searchsubmit,
                        .error-404-text p a.button,
                        .cart-empty p a:hover,
                        #portfolio.columns .read-more,
                        .pricing_box p.button a,
                        #portfolio a.read-more,
                        .readmore-wrapper a.button',

            'hover' => '
                        .button:hover,
                        .sidebar .button:hover,
                        .pricing_box p.button a:hover,
                        .price-table .body .more a:hover,
                        .btn.btn-button:hover,
                        .woocommerce ul.products li.product.grid .buttons-list-wrapper a.button:hover,
                        .woocommerce div.product form.cart .button:hover,
                        .woocommerce a.button:hover,
                        .woocommerce button.button:hover,
                        .woocommerce input.button:hover,
                        .woocommerce #respond input#submit:hover,
                        .woocommerce #content input.button:hover,
                        .woocommerce-page a.button:hover,
                        .woocommerce-page button.button:hover,
                        .woocommerce-page input.button:hover,
                        .woocommerce-page #respond input#submit:hover,
                        .woocommerce-page #content input.button:hover,
                        .woocommerce .wishlist_table .product-add-to-cart a.add_to_cart.button.alt:hover,
                        #respond #commentsubmit:hover,
                        .error-404-text p a.button:hover,
                        .pricing_box p.button a:hover,
                        .sidebar .widget_product_search #searchform #searchsubmit:hover,
                        .newsletter-section .contact-form .submit-button input.sendmail:hover,
                        .woocommerce ul.products li.product.grid .product-main-meta .grid-add-to-cart a.button:hover,
                        #portfolio.columns .read-more:hover,
                        .cart-empty p a:hover,
                        #portfolio a.read-more:hover,
                        .readmore-wrapper a.button:hover',
        ),
        'alternative' => array(

            'normal' => ' .button.checkout,
                           .woocommerce-page a.button.checkout,
                           .woocommerce a.button.checkout,
                           .checkout-button.button.alt,
                           .btn.btn-alternative,
                           .woocommerce .cart-collaterals input[type=submit].button.checkout-button
                        ',
            'hover' => '
                        .button.button-alt:hover,
                        .button.checkout:hover,
                        .woocommerce-page a.button.checkout:hover,
                        .woocommerce a.button.checkout:hover,
                        .checkout-button.button.alt:hover,
                        .btn.btn-alternative:hover,
                        .woocommerce .cart-collaterals input[type=submit].button.checkout-button:hover
                        '

        )

    ));

    return $button_style[$style][$status];
}

function yit_header_background_images( $bgs ) {       
    return array_merge( $bgs, array( 
        YIT_THEME_IMG_URL . '/backgrounds/032.jpg' => __( 'Background 01', 'yit' ),
        YIT_THEME_IMG_URL . '/backgrounds/045.jpg' => __( 'Background 02', 'yit' ),
        'custom' => __( 'Custom background', 'yit' )
    ) );
}
add_filter( 'yit_header_backgrounds', 'yit_header_background_images' );

function yit_body_background_images( $bgs ) {       
    return array_merge( $bgs, array(                                             
        YIT_THEME_IMG_URL . '/backgrounds/032.jpg' => __( 'Background 01', 'yit' ),
        YIT_THEME_IMG_URL . '/backgrounds/045.jpg' => __( 'Background 02', 'yit' ),
        'custom' => __( 'Custom background', 'yit' ),
    ) );
}
add_filter( 'yit_body_backgrounds', 'yit_body_background_images' );