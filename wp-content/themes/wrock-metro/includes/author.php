<div id="author-bio">
	<h3><?php _e('About', 'wrockmetro'); ?> <?php the_author_posts_link(); ?></h3>
<?php echo get_avatar( get_the_author_meta('ID'), 64 ); ?>
       <?php the_author_meta('description'); ?>                        
</div>
