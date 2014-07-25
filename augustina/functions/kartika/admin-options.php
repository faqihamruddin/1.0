<?php

// Assign global variables

/*
   function array_cat_list_id, return array of hierarchical categories,
   with category id is the array key and category name as array value
   this returned array will use on theme options of dropdown select or multiple select elements
   with category id as element value
*/

function array_cat_list_id($parent, $obj, $arr, $lvl) {
	$lvl++;
	foreach ( $obj as $cat ) {
		if ( $cat->parent==$parent ) {
			$arr[$cat->cat_ID] = str_pad('',($lvl - 1) ,'-').' '.$cat->cat_name;
			$arr = array_cat_list_id($cat->cat_ID, $obj, $arr, $lvl);
		}
	}
	return $arr;
}


/*
   function array_cat_list_id, return array of hierarchical categories,
   with category name is the array key and category name as array value
   this returned array will use on theme options of select or multiple select elements
   with category name as element value
*/

function array_cat_list_name($parent, $obj, $arr, $lvl) {
	$lvl++;
	foreach ( $obj as $cat ) {
		if ( $cat->parent==$parent ) {
			$arr[$cat->cat_name] = str_pad('',($lvl - 1) ,'-').' '.$cat->cat_name;
			$arr = array_cat_list_name($cat->cat_ID, $obj, $arr, $lvl);
		}
	}
	return $arr;
}


function array_page_list_id($parent, $obj, $arr, $lvl) {
	$lvl++;
	foreach ( $obj as $tpage ) {
		if ( $tpage->post_parent==$parent ) {
			$arr[$tpage->ID] = str_pad('',($lvl - 1) ,'-').' '.$tpage->post_title;
			$arr = array_page_list_id($tpage->ID, $obj, $arr, $lvl);
		}
	}
	return $arr;
}

//Access the WordPress Categories via an Array
$categories_array = array();  
$categories_array[0] = 'Select a category:';
$categories_obj = get_categories('hierarchical=true&orderby=name');

//Access the WordPress Pages via an Array
$pages_array = array();
$pages_array[0] = 'Select a Page:';
$pages_obj = get_pages('sort_column=post_parent,menu_order');    


$categories_array = array_cat_list_id(0, $categories_obj, $categories_array, 0);
$pages_array = array_page_list_id(0,$pages_obj, $pages_array, 0);


/**
 *
 * $options is an array of elements that available on general theme options on kartika
 *
 */
$options = array ();

// Create New General Tab 
$options[] = array( "name" => "General Settings",
					"id" => "menu-general",
					"class" => "general",
                    "type" => "open-tab");

$options[] = array( "name" => "Meta Generators",
                    "type" => "heading");
					
$options[] = array( "name" => "Generate Meta Generators",
					"id" => $shortname . "_generators",
					"std" => "Yes",
                    "type" => "switch",
					"desc" => "If turned ON it will display meta generators containing your theme name, theme version and kartika version in &lt;head&gt;.");

$options[] = array( "name" => "Internet Explorer 6 Warning Message",
                    "type" => "heading");
					
$options[] = array( "name" => "Enable IE6 Warning Message",
					"id" => $shortname . "_ie6_warning",
					"std" => "Yes",
                    "type" => "switch",
					"desc" => "If turned ON it will display warning message to your site visitors when they browse your site using Internet Explorer 6 (IE6).");

$options[] = array( "name" => "Message Title",
					"id" => $shortname . "_ie6_warning_title",
					"std" => "You are currently using Internet Explorer 6.",
                    "type" => "text",
					"desc" => "Enter the message title you want your visitors to see.");

$options[] = array( "name" => "Message",
					"id" => $shortname . "_ie6_warning_msg",
					"std" => "To be able to view this website correctly you need to upgrade your browser.",
                    "type" => "textarea",
					"desc" => "Enter the message you want your visitors to see.");
					
					$options[] = array( "name" => "Admin Bar",
                    "type" => "heading");
					
$options[] = array( "name" => "Enable kartika in Admin Bar",
					"id" => $shortname . "_kartika_admin_bar",
					"std" => "Yes",
                    "type" => "switch",
					"desc" => "If turned ON, the kartika menus will be displayed on admin bar.");

$options[] = array( "name" => "WordPress Login Form",
                    "type" => "heading");
					
$options[] = array( "name" => "<h3>Information</h3> This option is for customizing WordPress login form.",
                    "type" => "info");
					
$options[] = array( "name" => "Enable Login Logo URL",
					"id" => $shortname . "_wp_login_logo_url",
					"std" => "Yes",
                    "type" => "switch",
					"desc" => "If turned ON, the login form logo will link to your site instead of wordpress.org.");
					
$options[] = array( "name" => "Enable Login Logo Title Text",
					"id" => $shortname . "_wp_login_logo_title",
					"std" => "Yes",
                    "type" => "switch",
					"desc" => "If turned ON, when you hover on the logo it will displaye your site name instead of 'Powered by WordPress'");

$options[] = array( "name" => "Logo",
					"id" => $shortname . "_wp_login_logo",
					"std" => "",
                    "type" => "file",
					"desc" => "Upload your logo or type the URL on the text box. Only JPG, GIF and PNG image allowed. Suggested image dimension 325x65 pixels.");


// Close General Tab
$options[] = array( "type" => "close-tab");

// Create New Maintenance Tab 
$options[] = array( "name" => "Maintenance Mode",
					"id" => "menu-maintenance",
					"class" => "general",
                    "type" => "open-tab");

$options[] = array( "name" => "Site Maintenance",
                    "type" => "heading");
					
$options[] = array( "name" => "Activate Maintenance Mode",
					"id" => $shortname . "_maintenance_status",
					"std" => "No",
                    "type" => "switch",
					"desc" => "Set maintenance mode, ON will make visitors won't be able to browse your site.");

$options[] = array( "name" => "Maintenance Title",
					"id" => $shortname . "_maintenance_title",
					"std" => "Maintenance Mode",
                    "type" => "text",
					"desc" => "Enter the maintenance title.");

$options[] = array( "name" => "Maintenance Message",
					"id" => $shortname . "_maintenance_text",
					"std" => "Sorry, our site is down for maintenance. Be sure to check again in a few minutes.",
                    "type" => "textarea",
					"desc" => "Enter the message you want your visitors to see when maintenance mode is turn on.");

$options[] = array( "name" => "Maintenance Message for Adminsitrator",
					"id" => $shortname . "_maintenance_text_admin",
					"std" => "Notice: You are in maintenance mode!",
                    "type" => "textarea",
					"desc" => "Enter the message displayed to administrators when maintenance mode is turn on.");
					
// Close Maintenance Tab
$options[] = array( "type" => "close-tab");

/**
 *
 * $seo_options is an array of elements that available on seo theme options on kartika
 *
 */

$seo_options = array();

// Create New General SEO Tab
$seo_options[] = array( "name" => "General Settings",
					"id" => "seo-general",
					"class" => "seo-general",
                    "type" => "open-tab");

$seo_options[] = array( "type" => "heading",
					"name" => "SEO Setting");
					
$seo_options[] = array( "name" => "Turn OFF this feature if you've installed 3rd party SEO plugin. Enabling it might caused conflicts or unwanted side effects.",
                    "type" => "info");

$seo_options[] = array( "name" => "Enable SEO Setting",
					"id" => $shortname . "_enable_seo",
					"std" => "",
                    "type" => "switch",
					"desc" => "Enable SEO settings, please note if you're using 3rd party SEO plugin enabling this feature might cause unexpected results.");

// Close General SEO Tab
$seo_options[] = array( "type" => "close-tab");

// Create New Homepage SEO Tab
$seo_options[] = array( "name" => "Homepage",
					"id" => "seo-homepage",
					"class" => "seo-homepage",
                    "type" => "open-tab");

$seo_options[] = array( "type" => "heading",
					"name" => "Homepage SEO");

$seo_options[] = array( "name" => "Enable Homepage SEO Setting",
					"id" => $shortname . "_enable_homepage_seo",
					"std" => "",
                    "type" => "switch",
					"desc" => "Enable SEO settings for homepage.");

$seo_options[] = array( "name" => "Homepage Title",
					"id" => $shortname . "_homepage_seo_title",
					"std" => get_bloginfo('title'),
                    "type" => "text",
					"desc" => "Type your custom homepage title.");

$seo_options[] = array( "name" => "Homepage Meta Description",
					"id" => $shortname . "_homepage_seo_desc",
					"std" => get_bloginfo('description'),
                    "type" => "textarea",
					"desc" => "Type your custom homepage description.");

$seo_options[] = array( "name" => "Homepage Meta Keywords",
					"id" => $shortname . "_homepage_seo_keywords",
					"std" => "",
                    "type" => "text",
					"desc" => "Type your custom homepage keywords. Seperate each keyword with a comma.");

// Close Homepage SEO Tab
$seo_options[] = array( "type" => "close-tab");

// Create Single Page SEO Tab
$seo_options[] = array( "name" => "Single Post",
					"id" => "seo-single-post",
					"class" => "seo-single-post",
                    "type" => "open-tab");

$seo_options[] = array( "type" => "heading",
					"name" => "Single Post SEO");
					
$seo_options[] = array( "name" => "Enable Single Post SEO Setting",
					"id" => $shortname . "_enable_single_seo",
					"std" => "",
                    "type" => "switch",
					"desc" => "Enable SEO settings for single post.");

$seo_options[] = array( "name" => "Single Post Title",
					"id" => $shortname . "_single_seo_title",
                    "type" => "select",
					"std" => "",
					"options" => array("Automatically from post or page title", "Use custom field"),
					"desc" => "Select which option will you use for single post description.");

$seo_options[] = array( "name" => "Single Post Description",
					"id" => $shortname . "_single_seo_desc",
                    "type" => "select",
					"std" => "",
					"options" => array("Automatically from post or page content", "Use custom field"),
					"desc" => "Select which option will you use for single post description.");

$seo_options[] = array( "name" => "Single Post Keyword",
					"id" => $shortname . "_single_seo_keywords",
                    "type" => "select",
					"std" => "",
					"options" => array("Automatically from post tags or categories", "Use custom field"),
					"desc" => "Select which option will you use for single post keywords.");

$seo_options[] = array( "name" => "Separator",
					"id" => $shortname . "_single_seo_separator",
					"std" => "|",
                    "type" => "text",
					"desc" => "Type your custom separator between title and description.");

$seo_options[] = array( "name" => "Title Ordering",
					"id" => $shortname . "_single_seo_ordering",
                    "type" => "select",
					"std"=> "0",
					"options" => array("Title &lt;separator&gt; Site Name","Site Name &lt;separator&gt; Title"),
					"desc" => "Type your custom separator between title and site name.");
					
// Close Single Page SEO Tab
$seo_options[] = array( "type" => "close-tab");

// Create SEO Indexing Tab
$seo_options[] = array( "name" => "Indexing",
					"id" => "seo-indexing",
					"class" => "seo-indexing",
                    "type" => "open-tab");

$seo_options[] = array( "name" => "Indexing Options",
						"type" => "heading" );
						 
$seo_options[] = array( "name" => "Indexed Page",
					"id" => $shortname . "_index_page",
					"std" => array( "cat" => "Yes", "tag" => "Yes", "author" => "Yes", "search" => "Yes", "date" => "Yes"),
                    "type" => "multicheck",
					"options" => array( "cat" => "Category Archives", "tag" => "Tag Archives", "author" => "Author Page", "search" => "Search Result", "date" => "Date Archives"),
					"desc" => "Select which page(s) should be indexed on your site. This feature will prevent duplicate content when search engine such as Google indexed your site.");
					
// Close SEO Indexing Tab
$seo_options[] = array( "type" => "close-tab");
?>