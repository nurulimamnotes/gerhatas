<div id="bottom-menu">
<div id="bottom-menu-inner" class="clearfix">
<div id="bottom-menu-1">
<?php if (!dynamic_sidebar('Bottom Menu 1') ) : ?>
	<?php endif; ?>
</div>
<div id="bottom-menu-2">
	<?php if (!dynamic_sidebar('Bottom Menu 2') ) : ?>
	<?php endif; ?>
</div>
<div id="bottom-menu-3">
<?php if ( !dynamic_sidebar('Bottom Menu 3') ) : ?>
	<?php endif; ?></div> 
<div id="bottom-menu-4">
	<?php if ( !dynamic_sidebar('Bottom Menu 4') ) : ?>
	<?php endif; ?>
</div> 
</div> 
</div>
<div id="footer">
	<div id="footer-inner" class="clearfix">
<a href="<?php echo esc_url( home_url( ));?>/" title="<?php bloginfo('name');?>" ><?php bloginfo('name');?></a> <?php _e('Copyright &#169;', 'wrockmetro'); ?> <?php echo date('Y');?> <a href="<?php echo esc_url( __( 'http://www.wrock.org/wrock-metro/', 'wrockmetro' ) ); ?>" title="<?php esc_attr_e( 'Wrock Metro', 'wrockmetro' ); ?>"><?php printf( __( 'Wrock Metro %s', 'wrockmetro' ),''); ?></a><?php _e('Powered by', 'wrockmetro'); ?> <a href="http://wordpress.org/"><?php _e('WordPress', 'wrockmetro'); ?></a>

	<a href="#" class="scrollup"><?php _e('&#8593;', 'wrockmetro'); ?><a>

	</div> <!-- end div #footer-inner -->
	</div> <!-- end div #footer -->
	<!-- END FOOTER -->
		
</div> 