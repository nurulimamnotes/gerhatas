<div class="block ui-tabs-panel deactive" id="option-ui-id-9" >
	<h2><?php _e('Projects Section settings','rambo');?></h2><hr>	
	<?php $current_options = get_option('rambo_theme_options');
	if(isset($_POST['rambo_settings_save_4']))
	{	
		if($_POST['rambo_settings_save_4'] == 1) 
		{
			if ( empty($_POST) || !wp_verify_nonce($_POST['rambo_gernalsetting_nonce_customization'],'rambo_customization_nonce_gernalsetting') )
			{  print 'Sorry, your nonce did not verify.';	exit; }
			else  
			{				
				$current_options['project_heading_one']=sanitize_text_field($_POST['project_heading_one']);
				$current_options['project_tagline']=sanitize_text_field($_POST['project_tagline']);
				
				$current_options['project_one_thumb']=sanitize_text_field($_POST['project_one_thumb']);
				$current_options['project_two_thumb']=sanitize_text_field($_POST['project_two_thumb']);
				$current_options['project_three_thumb']=sanitize_text_field($_POST['project_three_thumb']);
				$current_options['project_four_thumb']=sanitize_text_field($_POST['project_four_thumb']);
				
				$current_options['project_one_title']=sanitize_text_field($_POST['project_one_title']);
				$current_options['project_two_title']=sanitize_text_field($_POST['project_two_title']);
				$current_options['project_three_title']=sanitize_text_field($_POST['project_three_title']);
				$current_options['project_four_title']=sanitize_text_field($_POST['project_four_title']);
				
				$current_options['project_one_text']=sanitize_text_field($_POST['project_one_text']);
				$current_options['project_two_text']=sanitize_text_field($_POST['project_two_text']);
				$current_options['project_three_text']=sanitize_text_field($_POST['project_three_text']);
				$current_options['project_four_text']=sanitize_text_field($_POST['project_four_text']);
				 if(isset($_POST['home_projects_enabled']))
				{ echo $current_options['home_projects_enabled']="on";
				} 
				else
				{
				echo $current_options['home_projects_enabled']="off";
				
				}
                //$current_options['front_page']=sanitize_text_field(isset($_POST['front_page']));				
				update_option('rambo_theme_options',stripslashes_deep($current_options));
			}
		}	
		if($_POST['rambo_settings_save_4'] == 2) 
		{
			$project_img = WEBRITI_TEMPLATE_DIR_URI .'/images/project_thumb.png';
			$current_options['home_projects_enabled']="on";			
			
			$current_options['project_heading_one']="Featured Portfolio Projects";
			$current_options['project_tagline']="Maecenas sit amet tincidunt elit. Pellentesque habitant morbi tristique senectus et netus et Nulla facilisi.";
			
			$current_options['project_one_thumb']=$project_img;			
			$current_options['project_one_title']="Product One";
			$current_options['project_one_text']="A set of pieces of creative work collected to be shown to potential customers or employers.the artist had put together a portfolio of his work";
			
			$current_options['project_two_thumb']=$project_img;			
			$current_options['project_two_title']="Product Two";
			$current_options['project_two_text']="A set of pieces of creative work collected to be shown to potential customers or employers.the artist had put together a portfolio of his work";
			
			$current_options['project_three_thumb']=$project_img;			
			$current_options['project_three_title']="Product Three";
			$current_options['project_three_text']="A set of pieces of creative work collected to be shown to potential customers or employers.the artist had put together a portfolio of his work";
			
			$current_options['project_four_thumb']=$project_img;			
			$current_options['project_four_title']="Product Four";
			$current_options['project_four_text']="A set of pieces of creative work collected to be shown to potential customers or employers.the artist had put together a portfolio of his work";
			
			
			update_option('rambo_theme_options',$current_options);
		}
	}  ?>
	<form method="post" id="rambo_theme_options_4">
		<?php wp_nonce_field('rambo_customization_nonce_gernalsetting','rambo_gernalsetting_nonce_customization'); ?>
		<div class="section">
			<h3><?php _e('Enable Home Project Section','rambo'); ?></h3>
			<input type="checkbox" <?php if($current_options['home_projects_enabled']=='on') echo "checked='checked'"; ?> id="home_projects_enabled" name="home_projects_enabled" > <span class="explain"><?php _e('Enable Projects section in fornt page.','rambo'); ?></span>
		</div>
		<div class="section">
			<h3><?php _e('Home Project  Heading','rambo'); ?></h3>
			<hr>
			<h3><?php _e('Project Section Heading','rambo'); ?></h3>
			<input class="webriti_inpute" type="text" value="<?php if(isset($current_options['project_heading_one'])) { echo $current_options['project_heading_one']; } ?>" id="project_heading_one" name="project_heading_one" size="36" />
			<span class="icons help"><span class="tooltip"><?php  _e('Enter Project Section Heading','rambo');?></span></span>
		
			<h3><?php _e('Project Section Tagline','rambo'); ?><span class="icons help"><span class="tooltip"><?php  _e('Enter Project Thumbnail','rambo');?></span></span></h3>
			<input class="webriti_inpute"  type="text" name="project_tagline" id="project_tagline" value="<?php if( isset($current_options['project_tagline'])) echo $current_options['project_tagline']; ?>" >
			<span class="icons help"><span class="tooltip"><?php  _e('Enter Project Section Tagline','rambo');?></span></span>	
		</div>		
		<div class="section">
			<h3><?php _e('Home Project One','rambo'); ?></h3>
			<hr>
			<h3><?php _e('Project One Title','rambo'); ?></h3>
			<input class="webriti_inpute" type="text" value="<?php if(isset($current_options['project_one_title'])) { echo $current_options['project_one_title']; } ?>" id="project_one_title" name="project_one_title" size="36" />
			<span class="icons help"><span class="tooltip"><?php  _e('Enter Project Title','rambo');?></span></span>
		
			<h3><?php _e('Project One Thumbnail','rambo'); ?><span class="icons help"><span class="tooltip"><?php  _e('Enter Project Thumbnail','rambo');?></span></span></h3>
			<input class="webriti_inpute"  type="text" name="project_one_thumb" id="project_one_thumb" value="<?php if( isset($current_options['project_one_thumb'])) echo $current_options['project_one_thumb']; ?>" >
			<input type="button" id="upload_button" value="Add Thumb One" class="upload_image_button" />			
			<?php if(isset($current_options['project_one_thumb'])) { ?>
			<p><img class="webriti_home_slide" src="<?php echo $current_options['project_one_thumb'];  ?>" /></p>
			<?php } ?>
			<h3><?php _e('Project One Description','rambo'); ?></h3>
			<textarea rows="5" cols="8" id="project_one_text" name="project_one_text"  class="textbox1"><?php if(isset($current_options['project_one_text'])) { echo esc_attr($current_options['project_one_text']); } ?></textarea>
			<div class=""><?php _e('Enter home Project One description text less then 150 character .','rambo'); ?><br></div>
		</div>	
		<div class="section">
			<h3><?php _e('Home Project Two','rambo'); ?></h3>
			<hr>
			<h3><?php _e('Project Two Title','rambo'); ?></h3>
			<input class="webriti_inpute" type="text" value="<?php if(isset($current_options['project_two_title'])) { echo $current_options['project_two_title']; } ?>" id="project_two_title" name="project_two_title" size="36" />
			<span class="icons help"><span class="tooltip"><?php  _e('Enter Project Title','rambo');?></span></span>
		
			<h3><?php _e('Project Two Thumbnail','rambo'); ?><span class="icons help"><span class="tooltip"><?php  _e('Enter Project Thumbnail','rambo');?></span></span></h3>
			<input class="webriti_inpute"  type="text" name="project_two_thumb" id="project_two_thumb" value="<?php if( isset($current_options['project_two_thumb'])) echo $current_options['project_two_thumb']; ?>" >
			<input type="button" id="upload_button" value="Add Thumb Two" class="upload_image_button" />			
			<?php if(isset($current_options['project_two_thumb'])) { ?>
			<p><img class="webriti_home_slide" src="<?php echo $current_options['project_two_thumb'];  ?>" /></p>
			<?php } ?>
			<h3><?php _e('Project Two Description','rambo'); ?></h3>
			<textarea rows="5" cols="8" id="project_two_text" name="project_two_text"  class="textbox1"><?php if(isset($current_options['project_two_text'])) { echo esc_attr($current_options['project_two_text']); } ?></textarea>
			<div class=""><?php _e('Enter home Project Two description text less then 150 character .','rambo'); ?><br></div>
		</div>
		<div class="section">
			<h3><?php _e('Home Project Three','rambo'); ?></h3>
			<hr>
			<h3><?php _e('Project Three Title','rambo'); ?></h3>
			<input class="webriti_inpute" type="text" value="<?php if(isset($current_options['project_three_title'])) { echo $current_options['project_three_title']; } ?>" id="project_three_title" name="project_three_title" size="36" />
			<span class="icons help"><span class="tooltip"><?php  _e('Enter Project Title','rambo');?></span></span>
		
			<h3><?php _e('Project Three Thumbnail','rambo'); ?><span class="icons help"><span class="tooltip"><?php  _e('Enter Project Thumbnail','rambo');?></span></span></h3>
			<input class="webriti_inpute"  type="text" name="project_three_thumb" id="project_three_thumb" value="<?php if( isset($current_options['project_three_thumb'])) echo $current_options['project_three_thumb']; ?>" >
			<input type="button" id="upload_button" value="Add Thumb Three" class="upload_image_button" />			
			<?php if(isset($current_options['project_three_thumb'])) { ?>
			<p><img class="webriti_home_slide" src="<?php echo $current_options['project_three_thumb'];  ?>" /></p>
			<?php } ?>
			<h3><?php _e('Project Three Description','rambo'); ?></h3>
			<textarea rows="5" cols="8" id="project_three_text" name="project_three_text"  class="textbox1"><?php if(isset($current_options['project_three_text'])) { echo esc_attr($current_options['project_three_text']); } ?></textarea>
			<div class=""><?php _e('Enter home Project Three description text less then 150 character .','rambo'); ?><br></div>
		</div>
		<div class="section">
			<h3><?php _e('Home Project Four','rambo'); ?></h3>
			<hr>
			<h3><?php _e('Project Four Title','rambo'); ?></h3>
			<input class="webriti_inpute" type="text" value="<?php if(isset($current_options['project_four_title'])) { echo $current_options['project_four_title']; } ?>" id="project_four_title" name="project_four_title" size="36" />
			<span class="icons help"><span class="tooltip"><?php  _e('Enter Project Title','rambo');?></span></span>
		
			<h3><?php _e('Project Four Thumbnail','rambo'); ?><span class="icons help"><span class="tooltip"><?php  _e('Enter Project Thumbnail','rambo');?></span></span></h3>
			<input class="webriti_inpute"  type="text" name="project_four_thumb" id="project_four_thumb" value="<?php if( isset($current_options['project_four_thumb'])) echo $current_options['project_four_thumb']; ?>" >
			<input type="button" id="upload_button" value="Add Thumb Four" class="upload_image_button" />			
			<?php if(isset($current_options['project_four_thumb'])) { ?>
			<p><img class="webriti_home_slide" src="<?php echo $current_options['project_four_thumb'];  ?>" /></p>
			<?php } ?>
			<h3><?php _e('Project Four Description','rambo'); ?></h3>
			<textarea rows="5" cols="8" id="project_four_text" name="project_four_text"  class="textbox1"><?php if(isset($current_options['project_four_text'])) { echo esc_attr($current_options['project_four_text']); } ?></textarea>
			<div class=""><?php _e('Enter home Project Four description text less then 150 character .','rambo'); ?><br></div>
		</div>
		<div id="button_section">
			<input type="hidden" value="1" id="rambo_settings_save_4" name="rambo_settings_save_4" />
			<input class="reset-button btn" type="button" name="reset" value="Restore Defaults" onclick="rambo_option_data_reset('4');">
			<input class="btn btn-primary" type="button" value="Save Options" onclick="rambo_option_data_save('4')" >
			<!--  alert massage when data saved and reset -->
			<div class="rambo_settings_save" id="rambo_settings_save_4_success" ><?php _e('Options data successfully Saved','rambo');?></div>
			<div class="rambo_settings_save" id="rambo_settings_save_4_reset" ><?php _e('Options data successfully reset','rambo');?></div>
		</div>
	</form>
</div>