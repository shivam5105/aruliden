<?php
/*
Template Name: News
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


	<div class="container-full news-listing">
		<div class="row">
			<ol class="breadcrumb pd-0">

<li>All</li>
<?php

  $taxonomy     = 'news_cat';
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
 	<li><a href="<?php echo get_term_link($cat->slug, "news_cat"); ?>"><?php echo $cat->name; ?></a></li>
<?php
}
?>

				<!--li>Product + Innovation</li>
				<li>Beauty + Fashion</li-->
			</ol>
		</div>

<?php 
	$perPage = get_option( 'posts_per_page' );
	$paged = ( get_query_var('paged') ? get_query_var('paged') : 1);
	$args = array( 
	'posts_per_page' => $perPage,
	'post_type' => 'aruliden_news',
	'orderby' => 'date',
	'order' => 'DESC'
	);
	$the_query = new WP_Query( $args );
?>
<?php if ( $the_query->have_posts() ) : 
	  while ( $the_query->have_posts() ) : $the_query->the_post();
?>		

		<div class="row news-feed">
			<div class="col-sm-6 news-img">
				<?php the_post_thumbnail("815x420"); ?>
			</div>
			<div class="col-sm-6 news-content">
				<h3><?php echo get_the_title(); ?></h3>
				<div class="view-more left"><a href="<?php echo the_permalink(); ?>">Read more</a></div>
			</div>
		</div>
<?php endwhile;
		endif;
 ?>
		<div class="view-more"><a href="#">Load more</a></div>
	</div>


<?php get_footer(); ?>