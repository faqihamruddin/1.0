<?php
/**
 * kartika Maintenance
 *
 * Function to load maintenance page
 */

function kartika_maintenance() {
	global $shortname;
	
	if( get_option($shortname.'_maintenance_status') == 'Yes' && !current_user_can('administrator') ) {
		include( get_template_directory() . '/includes/maintenance.php' );
		exit;
	} elseif ( get_option($shortname.'_maintenance_status') == 'Yes' && current_user_can('administrator') ) {
		$maintenance_text_admin = stripslashes( get_option($shortname.'_maintenance_text_admin') );
		echo "<div id=\"maintenance-notice\">". $maintenance_text_admin ."</div>";
	}
}

/**
 * kartika Admin Bar
 *
 * Function to display kartika submenu on wp admin bar
 */
function kartika_admin_bar_render() {
    global $wp_admin_bar, $shortname;
	
	$args = array();
	$args[] = array(
        'id' => 'kartika',
        'title' => 'kartika',
        'href' => admin_url( 'admin.php?page=kartika')
    );
	$args[] = array(
        'parent' => 'kartika',
        'id' => 'kartika_options',
        'title' => 'Theme Options',
        'href' => admin_url( 'admin.php?page=kartika')
    );
	$args[] = array(
        'parent' => 'kartika',
        'id' => 'kartika_framework',
        'title' => 'Framework',
        'href' => admin_url( 'admin.php?page=kartika_framework')
    );
	$args[] = array(
        'parent' => 'kartika',
        'id' => 'kartika_seo',
        'title' => 'SEO',
        'href' => admin_url( 'admin.php?page=kartika_seo')
    );
	$args[] = array(
        'parent' => 'kartika',
        'id' => 'kartika_update',
        'title' => 'Update Framework',
        'href' => admin_url( 'admin.php?page=kartika_update')
    );
	
	if ( get_option($shortname.'_kartika_admin_bar') == 'Yes' ) :
		foreach ( $args as $arg ) {
			$wp_admin_bar->add_menu( $arg );
		}
	else :
		$wp_admin_bar->remove_menu( 'kartika' );
	endif;
}
add_action('admin_bar_menu', 'kartika_admin_bar_render', 1000);


/**
 * kartika Generators
 *
 * Function to generate meta generators containing theme name,
 * theme version and kartika version
 */
 
function kartika_generators() {
	global $shortname, $themename, $version, $kartika_panel_version;
	
	if( get_option($shortname.'_generators') == "Yes" ) {
		$output = '';
		$output .= '<meta name="generator" content="'. $themename .' '. $version .'" />'. "\n";
		$output .= '<meta name="generator" content="kartika '. $kartika_panel_version .'"/>'. "\n";
		echo $output;
	}
}
add_action( 'wp_head', 'kartika_generators' );


/**
 * kartika Header Codes
 *
 * Function to load custom codes in header
 */
 
function kartika_header_codes() {
	global $shortname;
	
	if (get_option($shortname.'_header_codes') <> "") {
		echo stripslashes( get_option($shortname.'_header_codes') ) . "\n";
	}
}
add_action( 'wp_head', 'kartika_header_codes' );


/**
 * kartika Footer Codes
 *
 * Function to load custom codes in footer
 */
 
function kartika_footer_codes() {
	global $shortname;
	
	if (get_option($shortname.'_footer_codes') <> "") {
		echo stripslashes( get_option($shortname.'_footer_codes') ) . "\n";
	}
}
add_action( 'wp_footer', 'kartika_footer_codes' );


/**
 * kartika Trim Title Function
 *
 * Function to cut string/text
 * @param Integer $length Word count
 * @return String The text after trim
 */

function kartika_post_title( $length, $cut = true ) {
	$title = get_the_title();
	mb_strlen( $title );
	
	if ( strlen($title) <= $length ) { 
	return $title;
	}
	
	$last_space = strrpos(substr($title, 0, $length), ' ');
	$cut_text = substr($title, 0, $last_space);
	
	
	if ($cut) {
		$cut_text .= '...';
	}
	
	return $cut_text;
}


/**
 * kartika Excerpt Function
 *
 * Function to cut title
 * @param Integer $length Word count
 * @return String The text after trim
 */

function kartika_excerpt( $length, $ending = '...',  $cut = true ) {
	$excerpt = get_the_excerpt();
	mb_strlen( $excerpt );

	if ( strlen($excerpt) <= $length ) { 
		return $excerpt;
	}
	
	$last_space = strrpos(substr($excerpt, 0, $length), ' ');
	$cut_text = substr($excerpt, 0, $last_space);

	if ($cut) {
		$cut_text .= '';
	}

	return $cut_text;
}

/**
 * kartika Thumbnail
 *
 * Function to display thumbnail using post thumbnail or Timthumb
 */

function kartika_thumbnail($method, $width, $height, $post_thumb_image = '', $image_title = '') {
	global $post, $blog_id, $shortname, $multisite_image_path;
	
	// If using WordPress default post thumbnail
	if ( $method == 'post-thumbnail' ) {
		if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
			the_post_thumbnail($post_thumb_image);
		}
	} 
	// if using Timthumb
	elseif ( $method == 'timthumb' ) {
		if( get_post_meta($post->ID, "thumb", true) ) {
			$values = get_post_custom_values("thumb");
			
			if (isset($blog_id) && $blog_id > 0) {
				echo "<img src=\"". get_template_directory_uri() ."/timthumb.php?src=". kartika_multisite_image_path($multisite_image_path) ."&amp;w=". $width ."&amp;h=". $height ."\" alt=\"". $image_title ."\" title=\"". $image_title ."\" />";
			} else {
				echo "<img src=\"". get_template_directory_uri() ."/timthumb.php?src=". $values[0] ."&amp;w=". $width ."&amp;h=". $height ."\" alt=\"". $image_title ."\" title=\"". $image_title ."\" />";
			}
		}
	// If automatically detect post thumbnail or Timthumb	
	} elseif ( $method == 'both' ) {
		if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
			the_post_thumbnail($post_thumb_image);
		} elseif ( get_post_meta($post->ID, "thumb", true) ) {
			$values = get_post_custom_values("thumb");
			
			// WordPress Multi Site
			if (isset($blog_id) && $blog_id > 0) {
				echo "<img src=\"". get_template_directory_uri() ."/timthumb.php?src=". kartika_multisite_image_path($multisite_image_path) ."&amp;w=". $width ."&amp;h=". $height ."\" alt=\"". $image_title ."\" title=\"". $image_title ."\" />";
			} 
			// WordPress Single Instalation
			else {
				echo "<img src=\"". get_template_directory_uri() ."/timthumb.php?src=". get_template_directory_uri() ."/images/default-thumb.gif&amp;w=". $width ."&amp;h=". $height ."\" alt=\"". $image_title ."\" title=\"". $image_title ."\" />";
			}
		} else {
			// WordPress Multi Site
			if (isset($blog_id) && $blog_id > 0) {
				echo "<img src=\"". get_template_directory_uri() ."/timthumb.php?src=/wp-content/themes/". $shortname ."/images/default-thumb.gif&amp;w=". $width ."&amp;h=". $height ."\" alt=\"". $image_title ."\" title=\"". $image_title ."\" />";
			} 
			// WordPress Single Instalation
			else {
				echo "<img src=\"". get_template_directory_uri() ."/timthumb.php?src=". get_template_directory_uri() ."/images/default-thumb.gif&amp;w=". $width ."&amp;h=". $height ."\" alt=\"". $image_title ."\" title=\"". $image_title ."\" />";
				
			}
		}
	}
}

// Timthumb image path fixed for WordPress Mutil Site
// Code is based on the code created by TimThumb author
function kartika_multisite_image_path ($post_id = null) {
	if ($post_id == null) {
		global $post;
		$post_id = $post->ID;
	}
	$multisite_image_path = get_post_meta($post_id, 'thumb', true);
	global $blog_id;
	if (isset($blog_id) && $blog_id > 0) {
		$image_parts = explode('/files/', $multisite_image_path);
		if (isset($image_parts[1])) {
			$multisite_image_path = '/blogs.dir/' . $blog_id . '/files/' . $image_parts[1];
		}
	}
	return $multisite_image_path;
}


/**
 * kartika Admin Update Link
 *
 * Function to display or not display update link
 */

function kartika_admin_update_link() {
	global $shortname;
	
	if( get_option($shortname.'_update_link') == "Yes" ) :
		edit_post_link(__('Edit Post', 'kartika'), '<p class="edit-post">', '</p>');
	endif;
}

/**
 * kartika IE6 Warning
 *
 * Function to load IE6 warning page
 */

function kartika_ie6_warning () {
	global $shortname;
	
	if( get_option($shortname.'_ie6_warning') == "Yes") {
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.') == true ) {
			include( get_template_directory() . '/includes/ie6-warning.php' );
			exit;
		}
	}
}

/**
 * kartika Theme Logo
 *
 * Function to add logo from kartika
 */

function kartika_logo() {
	global $shortname;
	
	if ( get_option($shortname.'_logo') <> "" ) {
			echo "<a href='". get_home_url()."'><img src='". get_option($shortname.'_logo') ."' alt='". get_bloginfo('name')."' title='". get_bloginfo('name') ."' /></a>";
	} else {
		echo "<a href='". get_home_url() ."'><img src='". get_template_directory_uri() ."/styles/". get_option($shortname.'_style') ."/images/logo.png' alt='". get_bloginfo('name') ."' title='". get_bloginfo('name')."' /></a>";
	}
}


/**
 * kartika Favorite Icon
 *
 * Function to add favicon from kartika
 */

function kartika_favicon() {
	global $shortname;
	
	if( get_option($shortname.'_favicon') <> "" ) :
?>
	<link rel="shortcut icon" href="<?php echo get_option($shortname.'_favicon'); ?>" />
<?php else: ?>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />
<?php
	endif;
}
add_action('wp_head', 'kartika_favicon');


/**
 * kartika Page view  process
 *
 * Function to count post and page view
 * this function update (or add) a new option with key 'kartika_views' to store the view counter for posts and pages
 * the 'kartika_views' option is an array with array structure array(post_id => counter)
 */

function kartika_page_view_process() {
	global $post;
	$count = false;
	$count_it = false;
	
	// If user view a single post or page then get the ID, it will used as a key for views array
	if (is_single() || is_page()) {
		$post_id = $post->ID; 
		$count_it = true;
	}
	// If user view homepage or archives page then the ID will set to 0, it will used as a key for homepage + archive page views
	if (is_home() || is_archive()) {
		$post_id = 0;
		$count_it = false;
	}
	if ($count_it) {
		if ($views = get_option('kartika_views')) {
			$last_views = get_option('kartika_last_views');
			if ( isset( $views[$post_id] )) {
				$views[$post_id] = $views[$post_id] + 1; // increment by 1 view for current post/page
			} else {
				$views[$post_id] = 1; // increment by 1 view for current post/page
			}
			$last_views[$post_id] = time();
			update_option('kartika_views', $views); // save the counter
			update_option('kartika_last_views',$last_views); // save the last time this page viewed
		} else {
			$views = array($post_id => 1 );
			$last_views = array($post_id => time() );
			add_option('kartika_views', $views );
		}
	}
}

add_action('wp_head', 'kartika_page_view_process');

/**
 * kartika Page view 
 *
 * Function to return page view
 */

function kartika_page_view($post_id) {
	if ($views = get_option('kartika_views')) {
		if ( isset($views[$post_id]) )
			$page_view = $views[$post_id];
		else $page_view = 0;
	} else {
		$page_view = 0;
	}
		
	return $page_view;
}

/**
 * kartika most viewed post 
 *
 * Function to display posts with most viewed
 * Parameter $limit : number of most viewed post to show
 */

function kartika_most_viewed_posts($limit = 5, $before='<li>', $after = '</li>') {
	if ($views = get_option('kartika_views')) {
	
		// exclude the homepage count
		$views[0] = false;
		
		// sort descending the array
		arsort($views, SORT_NUMERIC);
		$views = array_filter($views);
		// get the number of post to show, this according to $limit parameter that have default value 5
		$views = array_slice($views,0,$limit,true);
		
		foreach($views as $key=>$val) {
			$mypost = get_post($key);
			$title = $mypost->post_title;
			echo $before . "<a href='".get_permalink($key)."' title='".$title."'>". $title. " (".$val . __('Views', 'kartika').") </a>" . $after;
		}
	}
}


/**
 * kartika views total 
 *
 * Function to return total viewer
 */

function kartika_views_total() {
	if ($views = get_option('kartika_views'))
	
		// sum the values
		$sum = array_sum($views);
	else
		$sum = 0;

	return $sum;
}


/**
 * kartika Post Rating
 *
 * Function to show post rating, draw stars and show rating dropdown for browser with javascript disabled
 * Parameter $post_id
 */

function kartika_post_rating($post_id) {
	global $shortname;
	
	// create wordpress nonce for ajax submit verification
	$nonce = wp_create_nonce( 'ajax-post-'.$post_id.'-rating-nonce' ); 
	
	//Script below used to save rating via non ajax method
	if ( isset($_POST['rate-submit-'.$post_id]) ) {
		if ( isset($_POST['star-rate-select-'.$post_id]) ) {
			$rate = esc_attr($_POST['star-rate-select-'.$post_id]);
			kartika_post_rating_save($rate, $post_id);
		}
	}

	$anonymous_rate = get_option($shortname."_anonymous_rating");
	
	// Get the average rating, number of voter and current user rate.
	$avg = kartika_post_rating_avg($post_id);
	$voters = kartika_post_rating_voters($post_id);
	$yours = kartika_post_rating_yours($post_id);
	
	// If current user haven't rate yet we will print their rating to none rather than 0
	if ( $yours == 0 ) 
		$your_txt = 'none';
	else 
		$your_txt = $yours;
	
	$ceiled_avg = ceil($avg);
	$floored_avg = floor($avg);
	
	// Check if current user can rate this post or not
	$can_rate = kartika_can_rate($post_id);
	
?>
		<form id="post-rating-form" method="post">
		<div class="star-rating">
            <div class="star_rate_ajax">
            <label id="rate-title-<?php echo $post_id; ?>"><?php _e('Average :', 'kartika'); ?></label><br/>
        <?php 
			for( $j = 1; $j<=5; $j++) { 
			
				// Calculate the width of star in case average rating in decimal
				// Example : for average rating is 3.7 then we draw the fourth star width with 70%
				$diff = $j - ( $avg - $floored_avg );
				if ( $j <= $ceiled_avg ) $onclass = ' on'; else $onclass = '';
				if ( (($j - $avg) < 1) && (($j - $avg) > 0) )  $star_width = ' style="width:'. (($avg - $floored_avg)*100) .'%;"'; else $star_width = '';
				
				// If current user can rate this post we draw the star with link tag <a> 
				// But if if current user can rate then we draw with span tag
				if ( $can_rate ) :
			?>
            		<a href="#<?php echo $j; ?>" title="rate <?php echo $j; ?> star" class="rate<?php echo $onclass; ?>" id="<?php echo $j; ?>star-rate-<?php echo $post_id; ?>"><span<?php echo $star_width; ?>><?php _e('rate', 'kartika'); ?> <?php echo $j; ?> <?php _e('star', 'kartika'); ?></span></a>
            <?php 
				else : ?>
                	<span title="rate <?php echo $j; ?> star" class="rate<?php echo $onclass; ?>" id="<?php echo $j; ?>star-rate-<?php echo $post_id; ?>"><span<?php echo $star_width; ?>><?php _e('rate', 'kartika'); ?> <?php echo $j; ?> <?php _e('star', 'kartika'); ?></span></span>
            <?php 
				endif; ?>
		<?php } ?>	
                <input type="hidden" name="nonce-id-<?php echo $post_id; ?>" id="nonce-id-<?php echo $post_id; ?>" value="<?php echo $nonce; ?>" />
                <div id="rate-info-<?php echo $post_id; ?>" class="rate-info"><?php _e('Your rating: ', 'kartika'); ?> <?php echo $your_txt;?>, <?php _e('Average:', 'kartika'); ?> <?php echo $avg;?> (<?php echo $voters; ?> <?php _e('votes', 'kartika'); ?>)</div>
            </div>
            <?php
			
			// If user can rate this post then create form in case javascript disabled, this will be hidden if javascript enable
			if ( $can_rate ) : ?>
			<div class="hide-on-js">
				<label for="star-rate-select"><?php _e('Rate it','kartika'); ?></label>
					<select id="star-rate-select-<?php echo $post_id; ?>" name="star-rate-select-<?php echo $post_id; ?>">
						<option value="1"><?php _e('1 Star', 'kartika'); ?></option>
						<option value="2"><?php _e('2 Stars', 'kartika'); ?></option>
						<option value="3"><?php _e('3 Stars', 'kartika'); ?></option>
						<option value="4"><?php _e('4 Stars', 'kartika'); ?></option>
						<option value="5"><?php _e('5 Stars', 'kartika'); ?></option>
					</select>
				</label>
				<input type="submit" name="rate-submit-<?php echo $post_id;?>" value="<?php _e('Vote', 'kartika'); ?>" />
			</div>
            <?php
			endif; ?>
		</div>
		</form>
<?php
}


/**
 * Ajax handling function
 *
 * Function to handle ajax request/submit
 */
 
function kartika_post_rating_ajax_save() {
	// Get all parameter that thrown by ajax
	$post_id = absint($_POST['post_id']);
	$rate = absint($_POST['rate']);
	$nonce = esc_attr($_POST['nonce']);
	
	// Verify nonce
	if ( ! wp_verify_nonce( $nonce, 'ajax-post-'.$post_id.'-rating-nonce' ) ) die ( $nonce );
	
	// Save rating
	kartika_post_rating_save($rate, $post_id);
	$avg = kartika_post_rating_avg($post_id);
	$voters = kartika_post_rating_voters($post_id);
	$yours = kartika_post_rating_yours($post_id);
	
	// Return the response to client browser
	echo 'success|'.absint($avg).'|'.absint($voters).'|'.absint($yours).'|other';
}

// Add action for ajax submit handler
add_action( 'wp_ajax_nopriv_ajax-rate', 'kartika_post_rating_ajax_save' );
add_action( 'wp_ajax_ajax-rate', 'kartika_post_rating_ajax_save' );


/**
 * kartika post rating save
 *
 * Function to save user rating, rating saved as an array on post meta data with key _kartika_rating 
 *
 * Array structure for the saved rating :
 *    Array( 'summary' => ( sum total rating ), 'voter' => ( number of total voter ), 'detail' => ( Array of rating history) )
 *
 * Parameter $rate : user rating
 *           $post_id : post ID to be rate
 */
 
function kartika_post_rating_save($rate, $post_id) {
	global $shortname,  $current_user;

	get_currentuserinfo();
	$expire = get_option($shortname.'_rating_anonymous_expire');
	$enable_edit = get_option($shortname.'_replace_rating');;
	$userid = $current_user->ID;
	
	// Check wether user is login or not
	if ( $userid == 0 ) {
		// If user is not login, then this user treated as anonymous user
		// Use IP address as rating id
		$id = $_SERVER['REMOTE_ADDR'];
	} else {
		// If user is login then use the wordpress user id as rating id
		$id = $userid;
	}
	
	//Get now time
	$rate_date = date('Y-m-d H:i:s');
	
	// Check if this post has already a rate
	if ( $rate_history = get_post_meta($post_id, '_kartika_rating', true)) {
	
		// Get the rating history
		$details = $rate_history['detail'];
		
		// If this user have rate this post before
		if ( count($details[$id]) > 0 ) {	
			$last_time = $details[$id][0]['rate_date'];
			
			// If today pass the expire time since the last time this IP Address rate the post then treat this IP Address as a different user
			// Else replace the last rating point from the user with new one.
			if ( ( strtotime($rate_date) > strtotime('+'.$expire, $last_time ) ) && ( $userid == 0 ) && ( $expire != 'never' ) ) {
				array_unshift($details[$id], array('rate_date'=>strtotime($rate_date), 'rate' => $rate)); 
				$rate_history['summary'] = $rate_history['summary'] + $rate;
				$rate_history['voter'] = $rate_history['voter'] + 1;
			}elseif($enable_edit == 'Yes') {
				$rate_history['summary'] = $rate_history['summary'] - $details[$id][0]['rate'] + $rate;
				$details[$id][0]['rate_date'] = strtotime($rate_date);
				$details[$id][0]['rate'] = $rate;
			}
		// If this user never rate this post
		} else {
			$details[$id][0] = array('rate_date'=>strtotime($rate_date), 'rate' => $rate);
			$rate_history['summary'] = $rate_history['summary'] + $rate;
			$rate_history['voter'] = $rate_history['voter'] + 1;
		}
		$rate_history['detail'] = $details;
		
		// store the new rating on database
		update_post_meta($post_id, '_kartika_rating', $rate_history);
	} else {
		// Add new meta if no one already rate this post
		$detail = array( $id => array(array('rate_date' => strtotime($rate_date), 'rate' => $rate )));
		$post_rating = array( 'summary' => $rate, 'voter' => 1, 'detail' => $detail );
		add_post_meta($post_id,'_kartika_rating', $post_rating);
	}
	
}


/**
 * Get post rating average function
 *
 */

function kartika_post_rating_avg($post_id) {
	if ( $rating = get_post_meta($post_id, '_kartika_rating', true) ) $avg = round( $rating['summary'] / $rating['voter'], 1 );
	else $avg = 0;

	return absint($avg);
}


/**
 * Get number of voter
 *
 */

function kartika_post_rating_voters($post_id) {
	if ( $rating = get_post_meta($post_id, '_kartika_rating', true) ) $voters = $rating['voter'];
	else $voters = 0;
	
	return absint($voters);	
}


/**
 * Get Current user rating
 *
 */

function kartika_post_rating_yours($post_id) {
	global $shortname, $current_user;
	get_currentuserinfo();
	$expire = get_option($shortname.'_rating_anonymous_expire');
	$anonymous_rate = get_option($shortname."_anonymous_rating");
	$current_date = date('Y-m-d H:i:s');
	$userid = $current_user->ID;
	$your_vote = 0;
	if ($rating = get_post_meta($post_id, '_kartika_rating', true)) {
		if ( $userid == 0 ) {
			$id = $_SERVER['REMOTE_ADDR'];
			if ( isset($rating['detail'][$id]) && count($rating['detail'][$id]) > 0 && $anonymous_rate == 'Yes') {
				$last_time = $rating['detail'][$id][0]['rate_date'];
				if ( ( strtotime($current_date) > strtotime('+'.$expire, $last_time ) ) && ( $expire != 'never' ) ) {
					$your_vote = 0;
				} else {
					$your_vote = $rating['detail'][$id][0]['rate'];
				}
			} else {
				$your_vote = 0;
			}
		} else {
			$id = $userid;
			if ( count($rating['detail'][$id]) > 0 ) {
				$your_vote = $rating['detail'][$id][0]['rate'];
			} else {
				$your_vote = 0;
			}
		}
	}
	return absint($your_vote);
}


/**
 * kartika can rate
 *
 * Check if user can rate this post or not
 * return true if user can rate and false if user cannot rate
 */

function kartika_can_rate($post_id) {
	global $shortname, $current_user;
	get_currentuserinfo();
	$expire = get_option($shortname.'_rating_anonymous_expire');
	$enable_edit = get_option($shortname.'_replace_rating');
	$anonymous_rate = get_option($shortname."_anonymous_rating");
	$userid = $current_user->ID;
	$had_rate = kartika_post_rating_yours($post_id) ;
	if ( $userid == 0 ) {
		if ( $anonymous_rate == 'Yes') {
			if ( $had_rate > 0 && $enable_edit == "No" )
				$can_rate = false;
			else
				$can_rate = true;
			
		} else {
			$can_rate = false;
		}
	} else {
		if ( $had_rate > 0 && $enable_edit == "No" )
			$can_rate = false;
		else
			$can_rate = true;
		
	}
	
	return $can_rate;
}





/**
 * kartika Social Icons
 *
 * Function to echo the social icons list
 */
 
function kartika_social_icons() { 
	global $shortname;
	
	if ( get_option($shortname.'_feed') <> "" ) {
		echo "<a href='". get_option($shortname.'_feed')."'><img src='". get_template_directory_uri()."/images/icons/feed.png' alt='". __( 'Subscribe feed', 'kartika' )."' title='". __( 'Subscribe feed', 'kartika' )."' /></a>";
	}
	
	if ( get_option($shortname.'_twitter') <> "" ) {
		echo "<a href='". get_option($shortname.'_twitter')."'><img src='". get_template_directory_uri()."/images/icons/twitter.png' alt='". __( 'Follow us on Twitter', 'kartika' )."' title='". __( 'Follow us on Twitter', 'kartika' )."' /></a>";
	}
	
	if ( get_option($shortname.'_facebook') <> "" ) {
		echo "<a href='". get_option($shortname.'_facebook')."'><img src='". get_template_directory_uri()."/images/icons/facebook.png' alt='". __( 'Be our fans on Facebook', 'kartika' )."' title='". __( 'Be our fans on Facebook', 'kartika' )."' /></a>";
	}
	
	if ( get_option($shortname.'_myspace') <> "" ) {
		echo "<a href='". get_option($shortname.'_myspace')."'><img src='". get_template_directory_uri()."/images/icons/myspace.png' alt='". __( 'MySpace page', 'kartika' )."' title='". __( 'MySpace page', 'kartika' )."' /></a>";
	}
	
	if ( get_option($shortname.'_linkedin') <> "" ) {
		echo "<a href='". get_option($shortname.'_linkedin')."'><img src='". get_template_directory_uri()."/images/icons/linkedin.png' alt='". __( 'Linkedin profile', 'kartika' )."' title='". __( 'Linkedin profile', 'kartika' )."' /></a>";
	}
	
	if ( get_option($shortname.'_flickr') <> "" ) {
		echo "<a href='". get_option($shortname.'_flickr')."'><img src='". get_template_directory_uri()."/images/icons/flickr.png' alt='". __( 'Flickr photos', 'kartika' )."' title='". __( 'Flickr photos', 'kartika' )."' /></a>";
	}
	
	if ( get_option($shortname.'_youtube') <> "" ) {
		echo "<a href='". get_option($shortname.'_youtube')."'><img src='". get_template_directory_uri()."/images/icons/youtube.png' alt='". __( 'YouTube videos', 'kartika' )."' title='". __( 'YouTube videos', 'kartika' )."' /></a>";
	}
	
	if ( get_option($shortname.'_vimeo') <> "" ) {
		echo "<a href='". get_option($shortname.'_vimeo')."'><img src='". get_template_directory_uri()."/images/icons/vimeo.png' alt='". __( 'Vimeo videos', 'kartika' )."' title='". __( 'Vimeo videos', 'kartika' )."' /></a>";
	}
}

/**
 * kartika Print Link
 *
 * Function to show a print link
 */
function kartika_print_link( $text = 'Print this page', $echo = 1 ){
	$link = '<a href="#" onclick="window.print();return false;" class="print-link" > ' . $text . '</a>';
	if ( $echo ) echo $link;
	return $link;
}


/**
 * kartika Login Form
 *
 * Function to re-style wp-login.php
 */
function kartika_login_form() {
	global $shortname;
	
	if ( get_option($shortname.'_wp_login_logo_url') == 'Yes' ) {
		add_filter('login_headerurl', 'change_wp_login_url');
	}
	
	if ( get_option($shortname.'_wp_login_logo_title') == 'Yes' ) {
		add_filter('login_headertitle', 'change_wp_login_title');
	}
	
	if ( get_option($shortname.'_wp_login_logo') != '' ) {
		add_action('login_head', 'change_wp_login_logo');
	}
}
add_action( 'init', 'kartika_login_form' );


function change_wp_login_url() {
	return get_bloginfo('url');
}

function change_wp_login_title() {
	return get_bloginfo('name');
}

function change_wp_login_logo() {
	global $shortname;
	echo '<style type="text/css">.login h1 a { background-image: url('.get_option($shortname.'_wp_login_logo').') !important; }</style>';
}
?>