	<?php get_template_part('includes/breadcrumb' ); ?>
					
	<div class="caption">
	<?php
	if ( is_category() ) :
		echo '<h1 class="title"><span class="icon-th-large"></span> '.sprintf(__("Posts filed under \"%s\"", 'warrior'), single_cat_title("", false)).'</h1>';
	elseif ( is_tag() ) :
		echo '<h1 class="title"><span class="icon-tags"></span> '.sprintf(__("Posts tagged with \"%s\"", 'warrior'), single_tag_title("", false)).'</h1>';
	elseif ( is_day() ) :
		echo '<h1 class="title"><span class="calendar"></span> '.sprintf(__("Archive for %s", 'warrior'), get_the_time('F jS, Y')).'</h1>';
	elseif ( is_month() ) :
		echo '<h1 class="title"><span class="calendar"></span> '.sprintf(__("Archive for %s", 'warrior'), get_the_time('F, Y')).'</h1>';
	elseif ( is_year() ) :
		echo '<h1 class="title"><span class="calendar"></span> '.sprintf(__("Archive for %s", 'warrior'), get_the_time('Y')).'</h1>';
	elseif ( is_author() ) : 
		echo '<h1 class="title"><span class="icon-user"></span> '.sprintf(__('All Posts Written by "%s"', 'warrior'), get_query_var('author_name')).'</h1>';
	elseif ( is_search() ) :
		echo '<h1 class="title"><span class="icon-search"></span> '.sprintf(__('Search Results for "%s"', 'warrior'), get_search_query()).'</h1>';
	else :
		echo '<h1 class="title"><span class="icon-search"></span> '.__("Blog Archives", 'warrior').'</h1>';
	endif;
	?>
	</div>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<!-- START: POST CONTENT -->
	<div id="post-content" class="clearfix">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="thumb">
				<?php warrior_thumbnail( 'both', '620', '350', 'featured-large', get_the_title()); ?>
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

<?php else : ?>

	<!-- START: POST CONTENT -->
	<div id="post-content" class="clearfix">
		<div id="post-0" class="post error404 not-found hentry clearfix">
			<p><?php _e('Sorry, no post found.', 'warrior'); ?></p>
			<?php get_search_form(); ?>
			<p>&nbsp;</p>
		</div>
	</div>
	<!-- END: POST CONTENT -->

<?php endif; ?>