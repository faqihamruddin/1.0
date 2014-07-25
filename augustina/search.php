<?php get_header(); ?>

	<!-- START: MAIN CONTENT -->
	<div id="main-content" class="clearfix">
		<div id="lcol-wrapper">
			<!-- START: LEFT COLUMN -->
			<div id="leftcol">

				<?php include( get_template_directory() . '/includes/posts.php' ); // Display posts ?>

			</div>
			<!-- END: LEFT COLUMN -->
		</div>

		<?php get_sidebar(); ?>

	</div>
	<!-- END: MAIN CONTENT -->

<?php get_footer(); ?>