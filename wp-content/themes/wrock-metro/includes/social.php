<!--   
Package: Free Social Media Icons
Author: Thomas Weichselbaumer, ThemeZee.com
Source: http://themezee.com/free-social-media-icons/
License: GPL v3 (http://www.gnu.org/licenses/gpl.html)
-->
<div id="share">
<?php if(of_get_option('wrockmetro_rss')) :  echo '<a href="'; echo esc_url(of_get_option('wrockmetro_rss')); echo '">';  echo'<img src="'; echo get_template_directory_uri(); echo '/images/rss.jpg" alt="Subcribe to my feed" width="48" height="48"/></a>';  else : endif; ?>

<?php if(of_get_option('wrockmetro_gp')) :  echo '<a href="'; echo esc_url(of_get_option('wrockmetro_gp')); echo '"><img src="';  echo get_template_directory_uri(); echo'/images/googleplus.jpg" alt="Google+ Plus" width="48" height="48"/></a>'; else : endif; ?>

<?php if(of_get_option('wrockmetro_tw')) :  echo '<a href="'; echo esc_url(of_get_option('wrockmetro_tw')); echo '">';  echo'<img src="'; echo get_template_directory_uri(); echo'/images/twitter.jpg" alt="Follow on Twitter" width="48" height="48"/></a>'; else : endif; ?>	 

<?php if(of_get_option('wrockmetro_fb')) :  echo '<a href="'; echo esc_url(of_get_option('wrockmetro_fb')); echo '"><img src="'; echo get_template_directory_uri(); echo'/images/facebook.jpg" alt="Like On Facebook" width="48" height="48"/></a>'; else : endif; ?>	 

<?php if(of_get_option('wrockmetro_in')) : echo '<a href="'; echo esc_url(of_get_option('wrockmetro_in')); echo '"><img src="'; echo get_template_directory_uri(); echo'/images/linkedin.jpg" alt="Linked Follow" width="48" height="48"/></a>'; else : endif; ?>	 

<?php if(of_get_option('wrockmetro_youtube')) : echo '<a href="'; echo esc_url(of_get_option('wrockmetro_youtube')); echo '"><img src="'; echo get_template_directory_uri(); echo'/images/youtube.jpg" alt="Subscribe on YouTube" width="48" height="48"/></a>'; else : endif; ?>	
<?php if(of_get_option('wrockmetro_pinterest')) : echo '<a href="'; echo esc_url(of_get_option('wrockmetro_pinterest')); echo '"><img src="'; echo get_template_directory_uri(); echo'/images/pinterest.jpg" alt="Pinterest" width="48" height="48"/></a>'; else : endif; ?>	

<?php if(of_get_option('wrockmetro_stumbleupon')) : echo '<a href="'; echo esc_url(of_get_option('wrockmetro_stumbleupon')); echo '"><img src="'; echo get_template_directory_uri(); echo'/images/stumbleupon.jpg" alt="Stumbleupon" width="48" height="48"/></a>'; else : endif; ?>	
<?php if(of_get_option('wrockmetro_instagram')) : echo '<a href="'; echo esc_url(of_get_option('wrockmetro_instagram')); echo '"><img src="'; echo get_template_directory_uri(); echo'/images/instagram.jpg" alt="Instagram" width="48" height="48"/></a>'; else : endif; ?>	
<?php if(of_get_option('wrockmetro_email')) :  echo '<a href="'; echo esc_url(of_get_option('wrockmetro_email')); echo '"><img src="'; echo get_template_directory_uri(); echo'/images/email.jpg" alt="Email to us" width="48" height="48"/></a>'; else : endif; ?>	
</div> 
	
