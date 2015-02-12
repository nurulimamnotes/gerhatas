<?php get_header(); ?>
	<!-- BEGIN PAGE -->
	<div id="page">
    <div id="page-inner" class="clearfix">
<div id="banner-top"><?php echo of_get_option( 'wrockmetro_banner_top'); ?></div>
		<div id="pagecont">	
<?php wrockmetro_breadcrumbs(); ?>	
			<?php if(have_posts()) : ?><?php while(have_posts())  : the_post(); ?>
					<article id="pagepost-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/Article">				
					<h1 class="entry-title" itemprop="name headline"><a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
					<div class="entry" class="clearfix">
																
								<span itemprop="articleBody"><?php the_content(); ?></span>
								<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wrockmetro' ), 'after' => '</div>' ) ); ?>
							</div> <!-- end div .entry -->
					<span class="postmeta_box">
		<?php get_template_part('/includes/postmeta'); ?><?php edit_post_link('Edit', ' &#124; ', ''); ?>
	</span><!-- .entry-header -->
	<div class="gap"></div><?php if (of_get_option('wrockmetro_author' ) =='1' ) {load_template(get_template_directory() . '/includes/author.php'); } ?>
							<div class="comments">
								<?php comments_template(); ?>
							</div> <!-- end div .comments -->
			</article> 

			<?php endwhile; ?>
			<?php else : ?>
				<div class="post">
					<h3><?php _e('404 Error&#58; Not Found', 'wrockmetro'); ?></h3>
				</div>
			<?php endif; ?>
			      										
		</div> <!-- end div #content -->
			
<?php get_sidebar(); ?>
<?php get_footer(); ?>
