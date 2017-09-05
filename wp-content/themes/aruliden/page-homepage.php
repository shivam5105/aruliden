<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>
			
	<div class="container-full">
		<div class="row">
			<div class="col-sm-12 intro-line">
				Aruliden is a creative agency that builds brands, products and experiences.
			</div>
		</div>
	</div>

	<div class="container-full home-work-listing">

<div class="row">
<?php 

	$args = array('post_type' => 'aruliden_works', 'posts_per_page' => 1);
	$the_query = new WP_Query( $args );
	$the_query->the_post(); 
	?>
			<div class="col-sm-5 abs left down animated img-animate">
				<img src="<?php echo the_post_thumbnail_url('large'); ?>" alt="#" />
				<div class="tag"><?php echo get_the_title(); ?></div>
			</div>

	<?php
	wp_reset_postdata();
	$args = array('post_type' => 'aruliden_works', 'offset' => 1, 'posts_per_page' => 1);
	$the_query = new WP_Query( $args );
	$the_query->the_post(); 
?>
			<div class="col-sm-7 pull-right animated img-animate">
				<img src="<?php echo the_post_thumbnail_url('large'); ?>" alt="#" />
				<div class="tag"><?php echo get_the_title(); ?></div>
			</div>
<?php
wp_reset_postdata();
	?>
</div>

<div class="row">
<?php
	$args = array('post_type' => 'aruliden_works', 'offset' => 2, 'posts_per_page' => 1);
	$the_query = new WP_Query( $args );
	$the_query->the_post(); 
?>
			<div class="col-sm-7 pull-right third animated img-animate">
				<div>
					<img src="<?php echo the_post_thumbnail_url('large'); ?>" alt="#" />
					<div class="tag"><?php echo get_the_title(); ?></div>
				</div>
			</div>
</div>
<div class="row">
<?php
	wp_reset_postdata();
	$args = array('post_type' => 'aruliden_works', 'offset' => 3, 'posts_per_page' => 1);
	$the_query = new WP_Query( $args );
	$the_query->the_post(); 
?>
			<div class="col-sm-7 animated img-animate">
				<img src="<?php echo the_post_thumbnail_url('large'); ?>" alt="#" />
				<div class="tag"><?php echo get_the_title(); ?></div>
			</div>
<?php
	wp_reset_postdata();
	$args = array('post_type' => 'aruliden_works', 'offset' => 4, 'posts_per_page' => 1);
	$the_query = new WP_Query( $args );
	$the_query->the_post(); 
?>
			<div class="col-sm-5 abs right animated img-animate">
				<img src="<?php echo the_post_thumbnail_url('large'); ?>" alt="#" />
				<div class="tag"><?php echo get_the_title(); ?></div>
			</div>

</div>
<?php
	wp_reset_postdata();
?>

		
		<div class="view-more"><a href="<?php echo site_url('/work/'); ?>">View more work</a></div>
	</div>


<?php wp_reset_postdata(); ?>



	<div class="container-full home-news-listing">
		<h1><span class="underline">News</span></h1>
		<div class="row">

<?php $args = array( 'post_type' => 'aruliden_news', 'posts_per_page' => 3 );
	$the_query = new WP_Query( $args );
	while ( $the_query->have_posts() ) : $the_query->the_post();
?>	

			<div class="col-sm-4 block">
				<div class="news-grid">
					<?php echo the_title(); ?>
					<div class="read"><a href="<?php echo get_the_permalink(); ?>">Read more</a></div>
				</div>
			</div>
<?php endwhile; ?>

			

		</div>

	</div>
<?php wp_reset_postdata(); ?>

<?php $args = array( 'post_type' => 'aruliden_services', 'posts_per_page' => 1 );
	$the_query = new WP_Query( $args );
	$the_query->the_post();
?>
	<div class="container-full home-service-listing">
		<div class="row">
			<div class="col-sm-12 service-head">
				<?php echo the_content(); ?>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<h2><?php echo get_the_title(); ?></h2>
				<div class="info-accordion">
				<?php 
					$services = get_field("services");
					$counter = 1;
					foreach ($services as $service) {
				?>

					<div class="acc<?php if($counter == 1){echo " active";} ?>">
						<h4 class="head"><?php echo $service['heading']; ?> <span class="<?php if($counter == 1){echo "ion-android-close";}else echo "ion-plus"; ?>"></span></h4>
						<div class="info">
							<?php echo $service['content']; ?>
						</div>
					</div>				

				<?php
				$counter++;
					}
				?>

				</div>

			</div>
			<div class="col-sm-6 text-right">
				<img src="<?php echo the_post_thumbnail_url("large"); ?>" alt="#" />
			</div>
		</div>

<?php wp_reset_postdata(); ?>

<?php $args = array( 'post_type' => 'aruliden_clients', 'posts_per_page' => 1 );
	$the_query = new WP_Query( $args );
	$the_query->the_post();
	$clients = get_field("clients");
	$clients_count = count($clients);
	$left_row = $clients_count / 2;
?>

		<div class="row select-clients-section">
			<div class="col-sm-6 service-img">
				<img src="<?php echo the_post_thumbnail_url("large"); ?>" alt="#" />
			</div>
			<div class="col-sm-6 select-clients">
				<h2><?php echo get_the_title(); ?></h2>
				<div class="text">
					<?php echo the_content(); ?>
				</div>
				<div class="row">

					<div class="col-sm-6">
						<ul>
				<?php
							for($i = 0; $i <= $left_row-1; $i++)
							{
								echo "<li>".$clients[$i]['client_name']."</li>";
							}
				?>
						</ul>
					</div>
					<div class="col-sm-6">
						<ul>
				<?php
							for($i = $left_row; $i <= $clients_count-1; $i++)
							{
								echo "<li>".$clients[$i]['client_name']."</li>";
							}
				?>
						</ul>
					</div>

					
				</div>
			</div>
		</div>

	</div>

<?php wp_reset_postdata(); ?>

	<div class="container-full home-listing-leadership no-pd">
		<div class="row no-margin">
			<h2><?php echo get_the_title( 90 );?> </h2>
			<div class="text">
				<p><?php echo get_post_field('post_content', 90);?></p>
			</div>
			

<?php 

$i = 0;
$leader = array();
$counter = 1;
$counter1 = 1;
 $args = array('post_type' => 'aruliden_leadership', 'order' => 'ASC');
	$the_query = new WP_Query( $args );
	$num = $the_query->post_count;
	 while ( $the_query->have_posts() ) : $the_query->the_post();

	 	$leader[$i] = $post;

	 $i++;
	 endwhile;

	 $col = 5;
	 	$mod = $num % $col;
		$div = $num / $col;

		if($mod == 0)
		{
		      $total_rows = $div;
		}
		else
		{
		   $total_rows = ($num + ($col - $mod)) / $col;
		}

		for($row = 1; $row <= $total_rows; $row++)
		{
			echo "<div class='leader-list'>";
		 	for($j = (($row - 1) * $col); $j < ($row * $col); $j++)
		 	{
		 		//var_dump($leader[$j]);
		 		//die();
		 	 	?>
		 	 <div class="grid-small">
				<div class="lead-list" data-ref="lead<?php echo $counter; ?>">
					<div class="lead-img"><img src="<?php echo get_the_post_thumbnail_url($leader[$j]->ID, array(330, 334)); ?>" alt="#" /></div>
					<ul>
						<li><?php echo $leader[$j]->post_title; ?></li>
						<li><?php echo get_field('designation', $leader[$j]->ID); ?></li>
						<li>+View bio</li>
					</ul>
				</div>
			</div>
		 	 	<?php
		 	 	$counter++;
		 	}
			echo "</div>";
			for($j = (($row - 1) * $col); $j < ($row * $col); $j++)
			{
			  ?>

			  <div class="leader-info lead<?php echo $counter1; ?>">
					<i class="ion-icon close-bio ion-android-close"></i>
					<ul class="social-contact">
					<?php
						$socials = get_field("social_media", $leader[$j]->ID);
						foreach ($socials as $social) {
							?>
								<li><a href="<?php echo $social['social_media_link'] ?>"><?php echo $social['social_media_name']; ?></a></li>		
							<?php
						}
					?>
						
					</ul>
					<div class="bio">
						<?php
							echo wpautop($leader[$j]->post_content);
						?>
					</div>

				</div>


			  <?php
			  $counter1++;
		 	}
		}

 ?>

		</div>

	</div>

<?php get_footer(); ?>