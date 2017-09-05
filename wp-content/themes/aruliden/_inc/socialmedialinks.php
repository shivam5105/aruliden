<?php 
	$socialMediaLinks = array(
							get_option('facebook_url'), 
							get_option('twitter_url'), 
							get_option('instagram_url'),
							get_option('linkedin_url'),
							get_option('pinterest_url'),
							get_option('email_url')
						);
	
	if(in_array(true, $socialMediaLinks)){ ?>
	
		<?php if(get_option('instagram_url')){ ?>
			<li><a href="<?php echo get_option('instagram_url'); ?>" target="_blank">
				Instagram
			</a></li>
		<?php } ?>
		<?php if(get_option('facebook_url')){ ?>
			<li><a href="<?php echo get_option('facebook_url'); ?>" target="_blank">
				Facebook
			</a></li>
		<?php } ?>
		<?php if(get_option('twitter_url')){ ?>
			<li><a href="<?php echo get_option('twitter_url'); ?>" target="_blank">
				Twitter
			</a></li>
		<?php } ?>

		<?php if(get_option('linkedin_url')){ ?>
			<li><a href="<?php echo get_option('linkedin_url'); ?>" target="_blank">
				Linkedin
			</a></li>
		<?php } ?>


		<?php if(get_option('pinterest_url')){ ?>
			<li><a href="<?php echo get_option('pinterest_url'); ?>" target="_blank">
				Pintetrest
			</a></li>
		<?php } ?>


		<?php if(get_option('email_url')){ ?>
			<li><a href="mailto:<?php echo get_option('email_url'); ?>">
				<i class="fa fa-envelope"></i>
			</a></li>
		<?php } ?>

<?php } ?>
