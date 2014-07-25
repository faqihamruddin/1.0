<?php
/**
 * kartika SEO
 *
 * Function for apply the SEO Options on kartika
 */
 
function kartika_title() {
	global $shortname, $post;
	$output = '';
	if ( have_posts() ) $post_id = $post->ID;
	$enable_seo = get_option($shortname . "_enable_seo");
	
	// If SEO Options is enabled
	if ( $enable_seo == 'Yes') {
		// Get all setting for homepageSEO
		if ( is_home() ) {
			$enable_detail_seo = get_option( $shortname . '_enable_homepage_seo' );
			$title = get_option( $shortname .'_homepage_seo_title');
			$separator = "|";
			$ordering = "0";
			
		// Get all setting for single page SEO
		} elseif ( is_single() || is_page() ) {
			$enable_detail_seo = get_option( $shortname . '_enable_single_seo' );
			$separator = get_option( $shortname .'_single_seo_separator');
			$ordering = get_option( $shortname .'_single_seo_ordering');
			$stitle = get_option($shortname . '_single_seo_title');
			if ( $stitle == '1') {
				$title_custom = '_'.$shortname.'_single_title';
				$title = get_post_meta($post_id, $title_custom, true);
				if ( !empty($title) ) {
					$title = $title;
				} else {
					$title = get_the_title($post_id);
				}
			} else {
				$title = get_the_title($post_id);
			}
			
		} else {
			$enable_detail_seo = '';
			$title = wp_title( '|', 0, 'right' );
		}
		
		if ( $enable_detail_seo == 'Yes' ) {
			$title_only = $title;
			$sitename = get_bloginfo('blogname');
			$sitedesc = get_bloginfo('description');
			if ( $title <> "" ) {
				if ( $ordering == '1' ) $title = $sitename . ' ' . $separator . ' ' . $title;
				else $title = $title = $title . ' ' . $separator . ' ' . $sitename;
			} else {
				$title = $sitename . ' ' . $separator . ' ' . $sitedesc;
			}
			$output .= $title;
		} else {
			if ( is_home() )  $output .= get_bloginfo('description') . ' | ';
			else $output .= wp_title( '|', 0, 'right' );
		
			$output .= get_bloginfo('blogname');
		}
	} else {
		if ( is_home() )  $output .= get_bloginfo('description') . ' | ';
			else $output .= wp_title( '|', 0, 'right' );
		
			$output .= get_bloginfo('blogname');
	}
	echo esc_attr($output);
}

 
function kartika_meta() {
	global $shortname, $post;
	$output = '';
	if ( have_posts() ) $post_id = $post->ID;
	$enable_seo = get_option($shortname . "_enable_seo");
	
	// If SEO Options is enabled
	if ( $enable_seo == 'Yes') {
	
		// Get all setting for homepageSEO
		if ( is_home() ) {
			$enable_detail_seo = get_option( $shortname . '_enable_homepage_seo' );
			$description = get_option( $shortname .'_homepage_seo_desc');
			$keywords = get_option( $shortname .'_homepage_seo_keywords');

		// Get all setting for single page SEO
		} elseif ( is_single() || is_page() ) {
			$enable_detail_seo = get_option( $shortname . '_enable_single_seo' );
			$separator = get_option( $shortname .'_single_seo_separator');
			$ordering = get_option( $shortname .'_single_seo_ordering');

			$sdesc = get_option($shortname . '_single_seo_desc');
			// Should we use custom field or post data for meta description?
			if ( $sdesc == '1') {
				$desc_custom = '_'.$shortname.'_single_description';
				$description = get_post_meta($post_id, $desc_custom, true);
				
				// If custom field description is empty we use the first paragraph instead
				if ( !empty($description) ) {
					$description = $description;	
				} else {
					$description = strip_shortcodes($post->post_content);
					$description = strip_tags($description); 
					$description = trim($description);
					$desc_array = explode("\n", $description );
					$description = strip_tags($desc_array[0]);
				}
			} else {
				$desc_array = explode("\n", $post->post_content );
				$description = strip_tags($desc_array[0]);
			}

			$skeyword = get_option($shortname . '_single_seo_keywords');
			
			// Get post tags and categories for meta keywords
			$auto_keywords = '';
			$posttags = get_the_tags($post_id);
			$categories = get_the_category($post_id);
			if ($posttags) {
				foreach($posttags as $tag) {
					$auto_keywords .= $tag->name . ', ';
				}
				$auto_keywords = rtrim($auto_keywords,', ');
			}
			if ($categories) {
				foreach($categories as $cat) {
					if ( !empty($tag) ) {
						$auto_keywords .= ', ';
						$auto_keywords .= $cat->name;
					} else {
						$auto_keywords .= $cat->name . ', ';
					}
				}
				$auto_keywords = rtrim($auto_keywords,', ');
			}
			
			// Should we use custom field or tags / categories for meta keywords?
			if ( $skeyword == '1') {
				$keywords_custom = '_'.$shortname.'_single_keywords'; 
				$keywords = get_post_meta($post_id, $keywords_custom, true);
				
				if ( !empty($keywords) ) {
					$keywords = $keywords;
				} else {
					$keywords = $auto_keywords;
				}
				
			} else {
				$keywords = $auto_keywords;
			}
		} else {
			$enable_detail_seo = '';
		}
		if ( $enable_detail_seo == 'Yes' ) {
			$sitename = get_bloginfo('blogname');
			$sitedesc = get_bloginfo('description');
			
			$output .= '<meta name="description" content="'. esc_attr($description) . '" />'. "\n";
			$output .= '<meta name="keywords" content="'. esc_attr($keywords) .'"/>'. "\n";
			if ( get_post_meta( $post_id, '_'.$shortname.'_single_noindex', true) == 'Yes' )

				$output .= '<meta name="robots" content="noindex">' ."\n";
		}
		$index_page = get_option($shortname . '_index_page');
		
		if ( is_category() && get_option($shortname . '_index_page_cat') != 'Yes') {
			$output .= '<meta name="robots" content="noindex">' ."\n";
		}
		if ( is_tag() && get_option($shortname . '_index_page_tag') != 'Yes') {
			$output = '<meta name="robots" content="noindex">' ."\n";
		}
		if ( is_author() && get_option($shortname . '_index_page_author') != 'Yes') {
			$output .= '<meta name="robots" content="noindex">' ."\n";
		}
		if ( is_search() && get_option($shortname . '_index_page_search') != 'Yes') {
			$output .= '<meta name="robots" content="noindex">' ."\n";
		}
		if ( is_date() && get_option($shortname . '_index_page_date') != 'Yes') {
			$output .= '<meta name="robots" content="noindex">' ."\n";
		}
	} else {
		// Nothing to print
	}
	echo $output;
}


/* Loading metabox if kartika SEO setting enabled */
if ( get_option($shortname . "_enable_seo") == 'Yes' && get_option($shortname . "_enable_single_seo")== 'Yes') {
	add_action('admin_init', 'kartika_seo_metabox', 1);	
	add_action('admin_print_styles-post-new.php','kartika_seo_metabox_style');
	add_action('admin_print_styles-post.php','kartika_seo_metabox_style');
	add_action('save_post', 'kartika_seo_metabox_save');
}


/**
 * kartika SEO metabox
 *
 * Function to show SEO options for Single page
 */

function kartika_seo_metabox() {
	global $themename;
    add_meta_box( 
        'kartika_seo',
        $themename . __( ' Theme SEO Options', 'myplugin_textdomain' ),
        'kartika_seo_metabox_form',
        'post',
		'normal',
        'core' 

    );
    add_meta_box( 
        'kartika_seo',
        $themename . __( ' Theme SEO Options', 'myplugin_textdomain' ),
        'kartika_seo_metabox_form',
        'page',
		'normal',
        'core'
    );

	$custom_types = array('_builtin' => false,); 
 	$custom_types_name = get_post_types($custom_types,'names'); 
 	
	foreach ( $custom_types_name as $custom_post ){
    	add_meta_box( 
        	'kartika_seo',
        	$themename . __( ' Theme SEO Options', 'myplugin_textdomain' ),
        	'kartika_seo_metabox_form',
        	$custom_post,
			'normal',
        	'core'
    	);
	}

}


/**
 * kartika SEO metabox form
 *
 * Function to show SEO options form for Single page
 */
 
function kartika_seo_metabox_form() {
	global $post, $shortname;
	
	$kartika_single_noindex = get_post_meta($post->ID, '_'.$shortname.'_single_noindex', true);
	$kartika_single_title = get_post_meta($post->ID, '_'.$shortname.'_single_title', true);
	$kartika_single_description = get_post_meta($post->ID, '_'.$shortname.'_single_description', true);
	$kartika_single_keywords = get_post_meta($post->ID, '_'.$shortname.'_single_keywords', true);
	
	$stitle = get_option($shortname . '_single_seo_title');
	$sdesc = get_option($shortname . '_single_seo_desc');
	$skeyword = get_option($shortname . '_single_seo_keywords');

	// Use nonce for verification
	wp_nonce_field('kartika_seo_metabox_id','kartika_seo_metabox');
	?>
    
	<div id="seo-metabox" class="kartika-metabox">
    	<fieldset>
            <div class="input checkbox">
                <label><?php _e('Noindex', 'kartika'); ?></label>
                <input id="kartika_single_noindex" name="kartika_single_noindex" type="checkbox" value="Yes" <?php if ( $kartika_single_noindex == 'Yes' ) echo 'checked'; ?> /> <label class="inline" for="kartika_single_noindex"><?php _e('Make this page not be indexed by search engine.', 'kartika'); ?></label>
            </div>
            
            <?php if ( $stitle == '1') { ?>
            <div class="input text">
                <label><?php _e('Page Title', 'kartika'); ?></label>
                <input id="kartika_single_title" name="kartika_single_title" type="text" value="<?php echo $kartika_single_title; ?>" />
                <div class="hint"><?php _e('Set custom title for this post/page.', 'kartika'); ?></div>
            </div>
            <?php } ?>
            <?php if ( $sdesc == '1') { ?>
            <div class="input textarea">
                <label><?php _e('Page Description', 'kartika'); ?></label>
                <textarea id="kartika_single_description" name="kartika_single_description" ><?php echo $kartika_single_description; ?></textarea>
                <div class="hint"><?php _e('Set custom meta description for this post/page.', 'kartika'); ?></div>
            </div>
            <?php } ?>
            <?php if ( $skeyword == '1') { ?>
            <div class="input text">
                <label><?php _e('Page Keywords', 'kartika'); ?></label>
                <input id="kartika_single_keywords" name="kartika_single_keywords" type="text" value="<?php echo $kartika_single_keywords; ?>" />
                <div class="hint"><?php _e('Set custom keywords for this post/page (separate each one with comma).', 'kartika'); ?></div>
            </div>
            <?php } ?>
        </fieldset>
    </div>
	<?php
}


/**
 * kartika SEO metabox style
 *
 * Function to load css file to stylize the SEO meta box
 */

function kartika_seo_metabox_style() {
	$path = get_template_directory_uri();
	
	// Style css needed to stylize the SEO metabox
	wp_enqueue_style('panel-style', $path.'/functions/kartika/css/metabox.css');
}


/**
 * kartika SEO metabox save
 *
 * Function to add action saving all SEO metabox when post/page saved
 */

function kartika_seo_metabox_save() {
	global $post, $shortname;
	
	if ( isset($post) ) {
		if ( is_array($post) )
			$post_id = $post['ID'];
		else
			$post_id = $post->ID;
	} else
		$post_id = 0;
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['kartika_seo_metabox'] ) && !wp_verify_nonce( $_POST['kartika_seo_metabox'], 'kartika_seo_metabox_id' )  )
		return $post_id;

	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;

  
	// Check permissions
	if ( isset($_REQUEST['post_type']) && 'page' == $_REQUEST['post_type'] && $post_id ) {
		if ( !current_user_can( 'edit_page', $post_id )  )
    	    return $post_id;
		}
	else if ($post_id)
	{
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated: we need to find and save the data
	if ( isset($_POST['kartika_single_noindex']))
		$kartika_single_noindex = $_POST['kartika_single_noindex'];
	else
		$kartika_single_noindex = 'No';
		
	$kartika_single_title = ( isset($_POST['kartika_single_title']) ) ? $_POST['kartika_single_title'] : '';
	$kartika_single_description = ( isset($_POST['kartika_single_description']) ) ? $_POST['kartika_single_description'] : '';
	$kartika_single_keywords = ( isset($_POST['kartika_single_keywords']) ) ? $_POST['kartika_single_keywords'] : '';
	
	update_post_meta($post_id, '_'.$shortname.'_single_noindex', esc_attr($kartika_single_noindex));
	update_post_meta($post_id, '_'.$shortname.'_single_title', esc_attr($kartika_single_title));
	update_post_meta($post_id, '_'.$shortname.'_single_description', esc_attr($kartika_single_description));
	update_post_meta($post_id, '_'.$shortname.'_single_keywords', esc_attr($kartika_single_keywords));
	
	return $post_id;
}
?>