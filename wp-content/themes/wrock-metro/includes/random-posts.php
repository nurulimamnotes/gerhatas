<ul>
<?php 
$wrockmetro_arg = array( 
 'ignore_sticky_posts' => true,
 'showposts' => 5,
 'orderby' => 'rand',  );
$the_query = new WP_Query( $wrockmetro_arg );
 if ( $the_query->have_posts() ) :
while ( $the_query->have_posts() ) : $the_query->the_post();
?>
<li> <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>									
							<?php endwhile; ?>
							<?php endif; ?>			 <?php wp_reset_postdata(); ?>
</ul>
