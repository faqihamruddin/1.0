<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>
	<!-- START: MAIN CONTENT -->
	<div id="main-content" class="clearfix">
		<div id="lcol-wrapper">
			<!-- START: LEFT COLUMN -->
			<div id="leftcol">
				<?php get_template_part('includes/breadcrumb' ); ?>

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<!-- START: POST CONTENT -->
					<div id="post-content" class="archives-page clearfix">
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="inner">
								<h1 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
								
								<h3><?php _e('Last 10 Blog Posts', 'warrior'); ?></h3>
								<ul>
									<?php wp_get_archives('type=postbypost&limit=10'); ?>
								</ul>
								
								<h3><?php _e('Blog Posts by Month', 'warrior'); ?></h3>
								<ul>
									<?php wp_get_archives('show_post_count=1'); ?>
								</ul>
								
								<h3><?php _e('Blog Categories', 'warrior'); ?></h3>
								<ul>
									<?php wp_list_categories('title_li=&order_by=name&hide_empty=0') ?>
								</ul>
								
								<?php warrior_admin_update_link(); ?>
							</div>
						</div>
					</div>
					<!-- END: POST CONTENT -->
				<?php endwhile; endif; ?>
			</div>
			<!-- END: LEFT COLUMN -->
		</div>
		<?php get_sidebar(); ?>
	</div>
	<!-- END: MAIN CONTENT -->
<?php get_footer(); ?>