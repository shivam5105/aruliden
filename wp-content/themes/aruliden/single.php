<?php get_header(); ?>

<?php if (have_posts()) : the_post(); ?>
			
<div class="container-full post-single">
	<div class="row">
		<div class="col-sm-5">
			<h1><?php echo get_the_title(); ?></h1>

			<div class="post-date"><h3>Date - <?php echo get_the_date( 'm.d.y' ); ?></h3></div>

			<div class="post-summary">
				<?php echo the_content(); ?>
			</div>
		</div>
		<div class="col-sm-7">
			<div class="post-slider-container">
		 		<ul class="post-slider">
                    
		 		<?php $images = get_field("gallery_images"); 
		 			foreach ($images as $image) {
		 				?>

		 					<li><img src="<?php echo $image['gallery_image']['url'] ?>"></li>
		 				<?php
		 			}

		 		?>


                </ul>
                <div class="outside">
  					<p><span id="slider-prev"></span> <span id="slider-next"></span> <span class="slide-number"></span></p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-full home-news-listing mt95">
		<h1><span class="underline">News</span></h1>
		<div class="row">

			<div class="col-sm-4 block">
				<div class="news-grid">
					Dart x Design,<br/>by various designers
					<div class="read"><a href="#">Read in Designweek.co.uk</a></div>
				</div>
			</div>
			<div class="col-sm-4 block">
				<div class="news-grid">
					FastCompant: Google Rethinks Remote Collaboration with Jamboard
					<div class="read"><a href="#">Read in Designweek.co.uk</a></div>
				</div>
				
			</div>
			<div class="col-sm-4 block">
				<div class="news-grid">
					Dart x Design,<br/>by various designers
					<div class="read"><a href="#">Read in Designweek.co.uk</a></div>
				</div>
				
			</div>

		</div>

	</div>

<?php endif; ?>

<?php get_footer(); ?>