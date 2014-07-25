<?php
/**
 * Warrior Functions
 * List of files inclusion and functions
 */

/*	define global variables :
	$themename : theme name information
	$shortname : short name information
	$warrior_panel_version : current version of the kartika
	$version : current theme version
	$options : an array that represent the general theme options
	$seo_options : an array that represent the general theme SEO options
*/

global $themename, $shortname, $version, $warrior_panel_version, $options, $theme_options, $seo_options;
	
$themename = 'Augustina';
$shortname = 'augustina';
$version = wp_get_theme()->Version;

require_once( get_template_directory() . "/functions/kartika/admin-init.php"); // Load kartika

require_once( get_template_directory() . "/functions/theme-options/theme-options.php"); // Load options
require_once( get_template_directory() . "/functions/theme-options/theme-widgets.php"); // Load widgets
require_once( get_template_directory() . "/functions/theme-options/theme-support.php"); // Load theme support
require_once( get_template_directory() . "/functions/theme-options/theme-functions.php"); // Load custom functions
require_once( get_template_directory() . "/functions/theme-options/theme-styles.php"); // Load JavaScript, CSS & comment list layout
// require_once(TEMPLATEPATH . "/functions/theme-options/theme-customizer.php"); // Load theme customizer options

add_action( 'after_setup_theme', 'warrior_theme_init' );

function warrior_theme_init(){
	add_action( 'widgets_init', 'warrior_register_sidebars' );
	add_action( 'init', 'warrior_nav_menu' );
}

function pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<ul class=\"pagination\">";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&laquo;</a></li>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li class=\"active\"><a>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' >".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li><a href=\"".get_pagenum_link($paged + 1)."\">&raquo;</a></li>";  
         echo "</ul>\n";
     }
}
?>