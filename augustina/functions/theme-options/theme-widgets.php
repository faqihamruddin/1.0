<?php
/**
 * Warrior Widgets
 * Register sidebar & load widget files
*/

function warrior_register_sidebars() {
	// Homepage Widget
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => __('Homepage', 'warrior'),
			'before_widget' => '<div id="widget-%1$s" class="widget-home %2$s clearfix">'."\n",
			'after_widget' => '</div>'."\n",
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		));
	}
	
	// Sidebar Widget
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => __('Sidebar', 'warrior'),
			'before_widget' => '<div id="widget-%1$s" class="widget-sidebar %2$s">'."\n",
			'after_widget' => '</div>'."\n",
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		));
	}	

	// Footer Widget
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => __('Footer', 'warrior'),
			'before_widget' => '<div id="widget-%1$s" class="widget-footer %2$s">'."\n",
			'after_widget' => '</div>'."\n",
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		));
	}
}

// Load Custom Widgets
include(TEMPLATEPATH . '/includes/widgets/kartika-tags.php');
include(TEMPLATEPATH . '/includes/widgets/kartika-lastest.php');
include(TEMPLATEPATH . '/includes/widgets/kartika-category.php');
?>