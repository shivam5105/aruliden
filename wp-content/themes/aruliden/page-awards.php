<?php
/*
Template Name: Awards
*/
?>

<?php get_header(); ?>
			
	<div class="container-full">
		<div class="row">
			<div class="col-sm-12 page-title">
				<h1 class="title">Latest News</h1>
			</div>
		</div>
	</div>

	<div class="container-full">
		<div class="row">
			<ol class="breadcrumb pd-0">
				
				<li>All</li>
<?php

  $taxonomy     = 'awards_cat';
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
 	<li><a href="<?php echo get_term_link($cat->slug, "awards_cat"); ?>"><?php echo $cat->name; ?></a></li>
<?php
}
?>

			</ol>
		</div>
		<div class="row">
			<div class="col-sm-12 page-description">
				<?php 
					the_post();
				the_content(); 

				?>
			</div>
		</div>
	</div>
<?php wp_reset_postdata(); ?>

	<div class="table-container container-full">
		<div class="row">
			<table id="awards-table" class="table dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
					<thead>
						<tr role="row">
							<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 135px;">Award</th>
							<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 219px;">Project</th>
							<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 100px;">Year</th>
						</tr>
					</thead>
					<tbody>

<?php 
	$args = array( 
	'post_type' => 'aruliden_awards',
	'orderby' => 'date',
	'order' => 'DESC'
	);
	$the_query = new WP_Query( $args );
?>
<?php if ( $the_query->have_posts() ) : 
	  while ( $the_query->have_posts() ) : $the_query->the_post();
?>	

						<tr role="row">
							<td class=""><?php echo get_the_title(); ?></td>
							<td class=""><?php echo get_field("project_name"); ?></td>
							<td class=""><?php echo get_field("year"); ?> <span class="expand-info ion-plus"></span></td>
						</tr>
						<tr class="info-row">
							<td colspan="3">
								<div class="info">
								<ul class="col-sm-3">
									<li class="head">Info</li>
									<li><?php echo get_field("info"); ?></li>
								</ul>
								<ul class="col-sm-3">
									<li class="head">Credits</li>
									<?php
										$credits = get_field("credits");
										foreach ($credits as $credit) {
									?>
										<li><span><?php echo $credit['title'] ?></span> <?php echo $credit['name'] ?></li>
									<?php
										}
									?>
								</ul>
								<ul class="col-sm-6">
									<li><img src="<?php echo the_post_thumbnail_url("840x495"); ?>" alt="<?php echo get_field("project_name"); ?>"/></li>
								</ul>

								</div>
							</td>
						</tr>

<?php 
endwhile;
endif;
?>
						
					</tbody>
				</table>
		</div>

		</div>
	</div>


<?php get_footer(); ?>