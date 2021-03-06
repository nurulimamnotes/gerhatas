<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option( 'woocommerce_enable_sku' ) == 'yes' && $product->get_sku() ) : ?>
		<span itemprop="productID" class="sku_wrapper"><?php _e( 'SKU:', 'yit' ); ?> <span class="sku"><?php echo $product->get_sku(); ?></span>.</span>
	<?php endif; ?>

	<?php
        $yit_product_cat =  get_the_terms( $product->id, 'product_cat' );
        $yit_product_tag =  get_the_terms( $post->ID, 'product_tag' );

        if( $yit_product_cat!="" ){}
    ?>

    <?php
    if( $yit_product_cat!="" ){
		$size = sizeof( get_the_terms( $product->id, 'product_cat' ) );
		// echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $size, 'yit' ) . ' ', '.</span>' );
    }
    ?>
    <?php     // if we have the categories and the tags we show the border
    if( $yit_product_tag!="" && $yit_product_cat!="" ){ echo "<hr>"; }
    ?>

	<?php
    if( $yit_product_tag!="" ){
		$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
		echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $size, 'yit' ) . ' ', '.</span>' );
    }
    ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>