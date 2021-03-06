<!doctype html>  

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ionicons.min.css"/>
		
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/fonts.css"/>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/theme.css"/>
		<!-- end of wordpress head -->
		<!-- IE8 fallback moved below head to work properly. Added respond as well. Tested to work. -->
			<!-- media-queries.js (fallback) -->
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>			
		<![endif]-->

		<!-- html5.js -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->	
		
			<!-- respond.js -->
		<!--[if lt IE 9]>
		          <script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
		<![endif]-->	
	</head>
	


	<body <?php body_class(); ?>>
				
		<header role="banner">
				
			<div class="navbar navbar-default navbar-fixed-top">
				<div class="container-fluid top-menu-container">
          
					<div class="navbar-header">
<?php //echo the_custom_logo_url(); 
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
?>
							<a class="navbar-brand" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
							<img src="<?php echo $image[0]; ?>" alt="logo" />
							<?php //bloginfo('name'); ?>
								
							</a>
					</div>

					<div class="collapse navbar-collapse navbar-responsive-collapse" id="top-navigation">
						<?php //wp_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>

						<?php
							wp_nav_menu( array(  'theme_location' => 'main_nav', 'container_class' => 'menu-list', 'menu_class' => 'main-menu' ) ); 
						?>
						
					</div>

				</div> <!-- end .container -->
			</div> <!-- end .navbar -->
		
		</header> <!-- end header -->
		<?php if(!is_single()) {  ?>
		<div class="container-fluid page-banner no-pd parallax-window">

			
				<div class="banner-text">
					Good Design is function
					and beauty, together.
				</div>

		</div>
		<?php } ?>
		
		<div class="page-container">
