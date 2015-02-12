<h4><?php _e('Latest', 'wrockmetro'); ?></h4>

<?php $the_query = new WP_Query('showposts=5&orderby=post_date&order=desc');
							while ($the_query->have_posts()) : $the_query->the_post(); ?>
								<div class="latest-post">
									<?php if ( has_post_thumbnail() ) {the_post_thumbnail();} else { ?><img src="<?php echo get_template_directory_uri(); ?>/images/thumb.jpg" />
<?php } ?> 
									 <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a><br />
									 <div class="clear"></div>
								</div>			
							<?php endwhile; ?><?php wp_reset_postdata(); ?>
	<div style="clear:both;"></div>