<?php
// Let's fix pagination issue first
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

$args=array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'paged' => $paged
);
$wp_query = new WP_Query();
$wp_query->query($args);
?>

<?php if ( $wp_query->have_posts() ): while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
	<!-- START: POST CONTENT -->
	<div id="post-content" class="clearfix">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="thumb">
				<?php warrior_thumbnail( 'both', '620', '250', 'cat-full-thumb', get_the_title()); ?>
				<span class="category"><?php the_category(', '); ?></span>
			</div>
			<div class="inner">
				<h2 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<?php warrior_post_info(); ?>
				
				<?php the_excerpt(); ?>
				<?php warrior_admin_update_link(); ?>
			</div>
		</div>
	</div>
	<!-- END: POST CONTENT -->
<?php endwhile; ?>

	<?php if(function_exists('wp_pagenavi')): wp_pagenavi(); ?>
	<?php else: ?>
		<?php global $wp_query; if($wp_query->max_num_pages > 1) { ?>
		<div class="navigation clearfix">
			<span class="prev"><?php previous_posts_link( __('&larr; Previous', 'warrior') ); ?></span>
			<span class="next"><?php next_posts_link( __('Next &rarr;', 'warrior') ); ?></span>
		</div>
		<?php } ?>
	<?php endif; ?>

<?php endif; ?>