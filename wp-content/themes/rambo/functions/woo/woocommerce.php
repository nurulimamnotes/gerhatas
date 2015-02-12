
<?php 
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10); 

add_action('woocommerce_before_main_content', 'webriti_rambo_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'webriti_rambo_wrapper_end', 10);

function webriti_rambo_wrapper_start() {?>
<!-- Header Strip -->
<div class="hero-unit-small">
  <div class="container">
    <div class="row-fluid about_space">
      <h2 class="page_head pull-left">
				<?php  the_title(); ?>
	  </h2>
      <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="input-append search_head pull-right">
          <input type="text"   name="s" id="s" placeholder="<?php esc_attr_e( "Search", 'rambo' ); ?>" />
          <button type="submit" class="Search_btn" name="submit" ><?php esc_attr_e( "Go", 'rambo' ); ?></button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /Header Strip -->
 <div class="container"><div class="row-fluid">
 <div class="<?php if( is_active_sidebar('sidebar-primary')) echo "span8"; else echo "span12";?>">
 <?php } ?>
 
<?php function webriti_rambo_wrapper_end() {
if( is_active_sidebar('sidebar-primary')){ echo "</div>"; get_sidebar(); echo "</div></div>"; }
else { echo "</div></div></div>"; } }?>