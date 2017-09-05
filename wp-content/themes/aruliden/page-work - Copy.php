<?php
/*
Template Name: Work
*/
?>

<?php get_header(); ?>
			
	<div class="container-full">
		<div class="row">
			<div class="col-sm-12 page-title">
				<h1 class="title"><?php echo get_the_title(); ?></h1>
			</div>
		</div>
	</div>

	<div class="container-full home-work-listing inner-page-listing">
		<div class="row">
			<ol class="breadcrumb pd-0">
				<li>All</li>
				
<?php

  $taxonomy     = 'works_cat';
  $orderby      = 'id';  
  $show_count   = 0;      // 1 for yes, 0 for no
  $pad_counts   = 0;      // 1 for yes, 0 for no
  $hierarchical = 1;      // 1 for yes, 0 for no  
  $title        = '';  
  $empty        = 0;

  $args = array(
         'taxonomy'     => $taxonomy,
         'orderby'      => $orderby,
         'show_count'   => $show_count,
         'pad_counts'   => $pad_counts,
         'hierarchical' => $hierarchical,
         'title_li'     => $title,
         'parent'		=> 0,
         'hide_empty'   => $empty
  );
 $all_categories = get_categories( $args );
 foreach ($all_categories as $cat) {
 	?>
 	<li><a href="<?php echo get_term_link($cat->slug, "works_cat"); ?>"><?php echo $cat->name; ?></a></li>
<?php
}
?>


			</ol>

		</div>

<?php 
	$args = array( 
	'post_type' => 'aruliden_works',
	'orderby' => 'date',
	'order' => 'DESC'
	);
	$the_query = new WP_Query( $args );
?>
<?php 
	$counter1 = 0;
	$counter = 2;
if ( $the_query->have_posts() ) : 
	$count = $the_query->post_count;
$count = $count + 1;
	  while ( $the_query->have_posts() ) : $the_query->the_post();

	if($counter % 2 ==0)
	{
		echo "<div class='row'>";
	}
?>	


			<div class="<?php if($counter % 2 == 0){echo "col-sm-5 abs left down";} else{echo "col-sm-7 pull-right";} ?>">
				<img src="<?php echo the_post_thumbnail_url("full"); ?>" alt="#" />
				<div class="tag"><?php echo get_the_title(); ?></div>
			</div>



<?php 
	
	if($counter % 2 !=0 || $counter == $count )
	{
		echo "</div>";
	}
	$counter++;

	//echo $counter;
	echo $count;

	?>		

<?php endwhile; endif; ?>	

		<!--div class="row">
			<div class="col-sm-5 abs left down">
				<img src="<?php echo the_post_thumbnail_url("full"); ?>" alt="#" />
				<div class="tag"><?php echo get_the_title(); ?></div>
			</div>
			<div class="col-sm-7 pull-right">
				<img src="<?php echo get_template_directory_uri(); ?>/images/item2.jpg" alt="#" />
				<div class="tag">Google</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-5 abs left down">
				<img src="<?php echo get_template_directory_uri(); ?>/images/item1.jpg" alt="#" />
				<div class="tag">BVLGARI</div>
			</div>
			<div class="col-sm-7 pull-right">
				<img src="<?php echo get_template_directory_uri(); ?>/images/item2.jpg" alt="#" />
				<div class="tag">Google</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-5 abs left down">
				<img src="<?php echo get_template_directory_uri(); ?>/images/item1.jpg" alt="#" />
				<div class="tag">BVLGARI</div>
			</div>
			<div class="col-sm-7 pull-right">
				<img src="<?php echo get_template_directory_uri(); ?>/images/item2.jpg" alt="#" />
				<div class="tag">Google</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-5 abs left down">
				<img src="<?php echo get_template_directory_uri(); ?>/images/item1.jpg" alt="#" />
				<div class="tag">BVLGARI</div>
			</div>
			<div class="col-sm-7 pull-right">
				<img src="<?php echo get_template_directory_uri(); ?>/images/item2.jpg" alt="#" />
				<div class="tag">Google</div>
			</div>
		</div-->

	

		</div>
	</div>


<?php get_footer(); ?>