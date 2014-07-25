<?php
/**
 * Warrior Javascript & CSS
 *
 * Function to load Javascript and CSS 
 * for theme frontend
 */
function warrior_enqueue_scripts() {
	global $shortname, $pagenow;
	
	// Only load these scripts on frontend
	if( !is_admin() && $pagenow != 'wp-login.php' ) {
		wp_enqueue_style('style');
		
		// Load CSS file for theme style
		if( get_option($shortname.'_style') <> "" ) {
			wp_register_style($shortname.'_style', get_template_directory_uri().'/styles/'. get_option($shortname.'_style').'/'.get_option($shortname.'_style').'.css', array(), false, 'screen');
			wp_enqueue_style($shortname.'_style');
		} else {
			wp_register_style($shortname.'_style', get_template_directory_uri().'/styles/default/default.css', array(), false, 'screen');
			wp_enqueue_style($shortname.'_style');
		}
		
		
		// Load custom CSS file
		wp_register_style('custom', get_template_directory_uri().'/custom.css', array(), false, 'screen');
		wp_enqueue_style('custom');
	
	} else {
		
	
	}
}
add_action( 'init', 'warrior_enqueue_scripts' );

?>