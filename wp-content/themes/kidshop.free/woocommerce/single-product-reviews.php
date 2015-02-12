<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */
global $woocommerce, $product;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$count = $product->get_rating_count();
?>
<?php if ( comments_open() ) : ?><div id="reviews" class="<?php if( $count > 0 ) echo 'with_reviews'?>"><?php

	echo '<div id="comments">';

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

		$count = $product->get_rating_count();

		if ( $count > 0 ) {

			$average = $product->get_average_rating();

			echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

			echo '<h2>'.sprintf( _n('<span class="highlight">%s review</span> for this item', '<span class="highlight">%s reviews</span> for this item', $count, 'yit'), '<span itemprop="ratingCount" class="count">'.$count.'</span>', wptexturize($post->post_title) ).'</h2>';

			echo '</div>';

		} else {

			echo '<h2>'.__( 'Be the first to review this items', 'yit' ).'</h2>';

		}

	} else {

		echo '<h2>'.__( 'Reviews', 'yit' ).'</h2>';

	}

	$title_reply = '';

	if ( have_comments() ) :

		echo '<ol class="commentlist">';

		wp_list_comments( array( 'callback' => 'woocommerce_comments' ) );

		echo '</ol>';

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'yit' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'yit' ) ); ?></div>
			</div>
		<?php endif;

        echo '<p class="add_review"><a href="#review_form" class="inline show_review_form button" title="' . __( 'Add Your Review', 'woocommerce' ) . '">' . __( 'Add Review', 'woocommerce' ) . '</a></p>';

        $title_reply = __( 'Add a review', 'yit' );

    else :

        $title_reply = __( 'Be the first to review', 'woocommerce' ).' &ldquo;'.$post->post_title.'&rdquo;';

        echo '<p class="noreviews">'.__( 'There are no reviews yet, would you like to <a href="#review_form" class="inline show_review_form">submit yours</a>?', 'woocommerce' ).'</p>';

    endif;

	$commenter = wp_get_current_commenter(); ?>

	</div><div id="review_form_wrapper" class="<?php if( $count > 0) echo 'with_reviews'; ?>"><div id="review_form">

<?php
	$comment_form = array(
		'title_reply' => $title_reply,
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'fields' => array(
			'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'yit' ) . '</label> ' . '<span class="required">*</span>' .
			            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
			'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'yit' ) . '</label> ' . '<span class="required">*</span>' .
			            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
		),
		'label_submit' => __( 'Submit Review', 'yit' ),
		'logged_in_as' => '',
		'comment_field' => '',
	);

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

		$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Rating', 'yit' ) .'</label><select name="rating" id="rating">
			<option value="">'.__( 'Rate&hellip;', 'yit' ).'</option>
			<option value="5">'.__( 'Perfect', 'yit' ).'</option>
			<option value="4">'.__( 'Good', 'yit' ).'</option>
			<option value="3">'.__( 'Average', 'yit' ).'</option>
			<option value="2">'.__( 'Not that bad', 'yit' ).'</option>
			<option value="1">'.__( 'Very Poor', 'yit' ).'</option>
		</select></p>';

	}

	$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Add Review', 'yit' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>' . $woocommerce->nonce_field('comment_rating', true, false);

	comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

	echo '</div></div>';

?><div class="clear"></div></div>
<?php endif; ?>