<?php get_header(); ?><!-- BEGIN PAGE -->
<div id="page">	<div id="page-inner" class="clearfix">
<div id="banner-top"><?php echo of_get_option( 'wrockmetro_banner_top'); ?></div>
		<div id="content">
		<?php wrockmetro_breadcrumbs(); ?>	
			<?php if(have_posts()) : ?>
			<?php while(have_posts())  : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/Article">
			<header class="entry">
			<h1 class="entry-title" itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
			<?php if ( of_get_option('wrockmetro_ad2') <> "" ) { echo stripslashes(of_get_option('wrockmetro_ad2')); } ?>
			<span itemprop="articleBody"><?php the_content(); ?></span>  </header>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wrockmetro' ), 'after' => '</div>' ) ); ?>
		<span class="postmeta_box">
		<?php get_template_part('/includes/postmeta'); ?>
		<?php if ( of_get_option('wrockmetro_tags' ) =='1') { ?><?php  if (get_the_tags()) :?> <span class="tags"><?php if("the_tags") the_tags(''); ?></span><?php endif;?><?php } ?>			<?php edit_post_link('Edit', ' &#124; ', ''); ?>
	</span><!-- .entry-header -->
	<div class="gap"></div><?php if (of_get_option('wrockmetro_author' ) =='1' ) {load_template(get_template_directory() . '/includes/author.php'); } ?>
	
		<div id="single-nav" class="clearfix">
		<div id="single-nav-left"><?php previous_post_link('&laquo;<strong>%link</strong>'); ?></div>
		<div id="single-nav-right"><?php next_post_link('<strong>%link</strong>&raquo;'); ?></div>
        </div>	
		
        <!-- END single-nav -->
			<div class="comments">	<?php comments_template(); ?>	</div> <!-- end div .comments -->	</article> <!-- end div .post -->
			<?php endwhile; ?>
			<?php else : ?>
				<div class="post">
					<h3><?php _e('404 Error&#58; Not Found', 'wrockmetro' ); ?></h3>
				</div>
			<?php endif; ?>
			<div id="footerads">
<?php if ( of_get_option('wrockmetro_ad1') <> "" ) { echo stripslashes(of_get_option('wrockmetro_ad1')); } ?>
</div>
		</div> <!-- end div #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>