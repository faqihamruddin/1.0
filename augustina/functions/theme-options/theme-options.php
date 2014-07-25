<?php
/* All Theme Options
   the $theme_options is a global variable to define specific theme's theme options
   when $theme_options set it will automaticly insert a new menu called 'Theme Options'
*/

//Access the WordPress Categories via an Array
$categories_array = array();  
$categories_name_array = array();  
$categories_obj = get_categories('hierarchical=true&orderby=name');

$categories_name_array = array_cat_list_name(0, $categories_obj, $categories_array, 0);
$categories_array = array_cat_list_id(0, $categories_obj, $categories_array, 0);

$theme_options = array();	


// Create New Appereance Tab
$theme_options[] = array( "name" => "Appearance",
					"class" => "appearance",
					"id" => "menu-appear",
                    "type" => "open-tab");
			
$theme_options[] = array( "name" => "Slogan",
                    "type" => "heading");

$theme_options[] = array( "name" => "Slogan",
					"id" => $shortname . "_slogan",
					"std" => "",
                    "type" => "textarea",
					"desc" => "Type your slogan.");

$theme_options[] = array( "name" => "About",
					"id" => $shortname . "_about",
					"std" => "",
                    "type" => "textarea",
					"desc" => "Type description about you. it will be placed in footer.");

$theme_options[] = array( "name" => "Styles",
                    "type" => "heading");

$theme_options[] = array( "name" => "Theme Style",
					"id" => $shortname . "_style",
					"std" => "default",
					"options" => array('default','black','blue','brown','green','orange','purple','red'),
					"type" => "select2",
					"desc" => "Which style should be use for the theme.");

$theme_options[] = array( "name" => "Favicon",
					"id" => $shortname . "_favicon",
					"std" => "",
                    "type" => "file",
					"desc" => "Upload your favicon. Only JPG, GIF and PNG image allowed. Suggested image dimension 32x32 pixels.");

$theme_options[] = array( "name" => "Logo",
					"id" => $shortname . "_logo",
					"std" => "",
                    "type" => "file",
					"desc" => "Upload your logo or type the URL on the text box. Only JPG, GIF and PNG image allowed.");

$theme_options[] = array( "name" => "Custom CSS Codes",
					"id" => $shortname . "_custom_css",
					"std" => "",
                    "type" => "textarea",
					"desc" => "Type your custom CSS codes here, alternatively you can also write down you custom CSS styles on the custom.css file located on the theme root directory.");

// Close Appearance Tab
$theme_options[] = array( "type" => "close-tab");

// Create New Contact Tab
$theme_options[] = array( "name" => "Contact Information",
					"class" => "contact",
					"id" => "menu-contact",
                    "type" => "open-tab");

$theme_options[] = array( "name" => "Contact Information",
                    "type" => "heading");
					

$theme_options[] = array( "name" => "Address",
					"id" => $shortname . "_address",
					"std" => "",
                    "type" => "textarea",
					"desc" => "Write your address, it will be used on google map.");

$theme_options[] = array( "name" => "Phone",
					"id" => $shortname . "_phone",
					"std" => "",
                    "type" => "text",
					"desc" => "Type your phone number.");

$theme_options[] = array( "name" => "Email",
					"id" => $shortname . "_email",
					"std" => "",
                    "type" => "text",
					"desc" => "Type your email address.");

					
// Close Contact Tab
$theme_options[] = array( "type" => "close-tab");

// Create New Social Networks Tab
$theme_options[] = array( "name" => "Social Network",
 					"class" => "socnet",
					"id" => "menu-socnet",
                   "type" => "open-tab");

$theme_options[] = array( "name" => "Social Network Profiles",
                    "type" => "heading");

$theme_options[] = array( "name" => "Feed URL",
					"id" => $shortname . "_feed",
					"std" => "",
                    "type" => "text",
					"desc" => "Your site's feed url. Example: http://www.kartika.com/feed");

$theme_options[] = array( "name" => "Twitter Profile",
					"id" => $shortname . "_twitter",
					"std" => "http://twitter.com/kartika",
                    "type" => "text",
					"desc" => "Your Twitter profile page. Example: kartika");

$theme_options[] = array( "name" => "Facebook Profile/Page",
					"id" => $shortname . "_facebook",
					"std" => "",
                    "type" => "text",
					"desc" => "Your Facebook profile page. Example: http://www.facebook.com/kartika");

$theme_options[] = array( "name" => "Myspace Page",
					"id" => $shortname . "_myspace",
					"std" => "http://www.myspace.com/kartika",
                    "type" => "text",
					"desc" => "Your MySpace profile page. Example: http://www.myspace.com/kartika");

$theme_options[] = array( "name" => "Linkedin Profile",
					"id" => $shortname . "_linkedin",
					"std" => "",
                    "type" => "text",
					"desc" => "Your LinkedIn profile page. Example: http://www.linkedin.com/in/kartika");

$theme_options[] = array( "name" => "Flickr Photos",
					"id" => $shortname . "_flickr",
					"std" => "",
                    "type" => "text",
					"desc" => "Your Flickr Photos page. Example: http://www.flickr.com/photos/kartika");

$theme_options[] = array( "name" => "Youtube Videos",
					"id" => $shortname . "_youtube",
					"std" => "",
                    "type" => "text",
					"desc" => "Your YouTube video page. Example: http://www.youtube.com/user/xxadelphiaxx");

$theme_options[] = array( "name" => "Vimeo Videos",
					"id" => $shortname . "_vimeo",
					"std" => "http://www.vimeo.com/kartika",
                    "type" => "text",
					"desc" => "Your Vimeo video page. Example: http://www.vimeo.com/kartika");
					
// Close Social Networks Tab
$theme_options[] = array( "type" => "close-tab");

// Create New Miscellaneous Tab
$theme_options[] = array( "name" => "Miscellaneous",
					"class" => "miscellaneous",
					"id" => "menu-miscellaneous",
                    "type" => "open-tab");

$theme_options[] = array( "name" => "Header &amp; Footer Codes",
                    "type" => "heading");

$theme_options[] = array( "name" => "Header Codes",
					"id" => $shortname . "_header_codes",
					"std" => "",
                    "type" => "textarea",
					"desc" => "Paste any Javascript or CSS codes you want to load in &lt;head&gt;.");

$theme_options[] = array( "name" => "Footer Codes",
					"id" => $shortname . "_footer_codes",
					"std" => "",
                    "type" => "textarea",
					"desc" => "Paste your Google Analytics code or any other codes to be placed on footer.");

$theme_options[] = array( "type" => "close-tab");
?>