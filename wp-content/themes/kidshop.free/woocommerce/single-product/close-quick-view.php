<?php
/**
 * Close quick view
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product;

if( !yit_get_option('shop-use-quick-view') ) return;

$terms = get_the_terms( $product->id, 'product_cat' );
if ( empty( $terms ) ) return;

$terms = array_values( $terms );
$term = array_shift( $terms );
?>

<div class="og-close group">
    &lt; Go to <a href="<?php echo get_term_link( $term, 'product_cat' ); ?>"><?php echo $term->name ?></a>
</div>