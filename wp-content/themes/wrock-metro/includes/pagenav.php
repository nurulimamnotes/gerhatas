<div class="gap"></div>
<div id="pagenavi" class="clearfix">
	<?php if('wrockmetro_pagenavi') { wrockmetro_pagenavi(); } else { ?>
		<?php next_posts_link('<span class="alignleft">&nbsp; &laquo; Older posts</span>') ?>
		<?php previous_posts_link('<span class="alignright">Newer posts &raquo; &nbsp;</span>') ?>
	<?php } ?>
</div> <!-- end div #pagenavi --><p></p>
<div class="gap"></div>

<div id="footerads">
<?php if ( of_get_option('wrockmetro_ad1') <> "" ) { echo stripslashes(of_get_option('wrockmetro_ad1')); } ?>
</div>

