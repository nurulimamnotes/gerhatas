<?php
	wp_reset_query();

    $args = array(
        'post_type' => 'testimonial'
    );

	$args['posts_per_page'] = (isset($items) && $items != '') ? $items : -1;

	if ( isset( $cat ) && ! empty( $cat ) ) {
	    $cat = array_map( 'trim', explode( ',', $cat ) );
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category-testimonial',
                'field' => 'id',
                'terms' => $cat
            )
        );
    }

	$tests = new WP_Query( $args );

    if( !$tests->have_posts() ) return false ?>
		<?php
        $i = 0;
		$row = ( yit_get_sidebar_layout() == 'sidebar-no' ) ? 3 : 3 ;

        while( $tests->have_posts() ) : $tests->the_post();
			if ( $i == 0 || $i % $row == 0 ) echo '<div class="row-fluid">';
			$fulltext = '';
			$text = (strcmp(yit_get_option('text-type-testimonials'), 'content') == 0) ? get_the_content() : get_the_excerpt();
			$title = the_title('<p class="name">', '</p>',false);
			$label = yit_get_post_meta( get_the_ID(), '_site-label' );
			$siteurl = yit_get_post_meta( get_the_ID(), '_site-url' );
			$smallquote = yit_get_post_meta( get_the_ID(), '_small-quote' );
			$website = '';
			if ($siteurl != ''):
				if ($label != ''):
					$website = '<p class="website">' . $label . '</p>';
				else:
					$website = '<p class="website">' . $siteurl . '</p>';
				endif;
			else:
				$website = '<span class="website">' . $label . '</span>';
			endif; ?>

			<div class="span4 testimonial-item-comic">
                <div class="testimonial testimonial-comic">
                    <div class="testimonial-box">
                        <?php if (isset($smallquote) && $smallquote != '') : ?>
                            <blockquote><?php echo $smallquote ?></blockquote>
                        <?php endif ?>
                        <div class="testimonial-text"><?php echo wpautop( $text ); ?></div>
                    </div>
                    <div class="testimonial-meta">
                        <?php if (yit_get_option('thumbnail-testimonials') && get_the_post_thumbnail( null, 'thumb-testimonial-quote' )) :  ?>
                            <div class="testimonial-arrow"></div>
                            <div class="thumbnail-comic">
                                <?php echo get_the_post_thumbnail( null, 'thumb-testimonial-quote' ); ?>
                            </div>
                        <?php endif ?>
                        <div class="testimonial-info">
                            <div class="testimonial-name <?php if (!yit_get_option('thumbnail-testimonials') || !get_the_post_thumbnail( null, 'thumb-testimonial-quote' )) :  ?>nothumb<?php endif ?>"><?php echo $title?></div>
                            <div class="testimonial-site"><?php echo $website; ?></div>
                        </div>
                    </div>
                </div>
            </div>
	        <?php $i++;
	        if ( $i % $row == 0 ) echo '</div>'; ?>
		<?php endwhile; ?>

<?php if ( $i % $row != 0 ) echo '</div>'; ?>