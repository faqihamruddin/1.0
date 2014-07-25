<?php
/**
* List of theme support functions
*/


// Check if the function exist
if ( function_exists( 'add_theme_support' ) ){
	global $wp_version;

	// Add post thumbnail feature
	add_theme_support( 'post-thumbnails' );
	add_image_size('small-thumb', 50, 50, true); // Widget image
	add_image_size('cat-small-thumb', 80, 60, true); // warrior_cat_posts_4
	add_image_size('cat-medium-thumb', 280, 170, true); // warrior_cat_posts_2
	add_image_size('cat-large-thumb', 300, 170, true); // warrior_cat_posts_3
	add_image_size('cat-full-thumb', 620, 250, true); // warrior_cat_posts_1
	add_image_size('gallery-thumb', 140, 100, true); // photo gallery image
	add_image_size('featured-large', 620, 350, true); // Featured image
	add_image_size('featured-thumb', 105, 80, true); // Featured thumb
	add_image_size('single-thumb', 580, 225, true); // Single Post thumb
	
	// Add WordPress navigation menus
	function warrior_nav_menu(){
		add_theme_support('nav-menus');
		register_nav_menus( array(
			'top-menu' => __( 'Top Menu', 'warrior' ),
			'main-menu' => __( 'Main Menu', 'warrior' ),
		) );
	}
	
	// Add custom background feature 
	add_theme_support( 'custom-background' );
		 
	 // Add post formats to 'post'
	 //add_theme_support('post-formats', array('gallery', 'video', 'audio'));
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
}

// Slideshow Custom Post Type
add_action('init', 'slideshows_register');
 
function slideshows_register() {
	$labels = array(
		'name' => __('Slideshows', 'warrior'),
		'singular_name' => __('Slideshow', 'warrior'),
		'add_new' => __('Add New', 'warrior'),
		'add_new_item' => __('Add New Slideshow', 'warrior'),
		'edit_item' => __('Edit Slideshow', 'warrior'),
		'new_item' => __('New Slideshow', 'warrior'),
		'view_item' => __('View Slideshow', 'warrior'),
		'search_items' => __('Search Slideshow', 'warrior'),
		'not_found' =>  __('Nothing found', 'warrior'),
		'not_found_in_trash' => __('Nothing found in Trash', 'warrior'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'slideshow', 'with_front' => true ),
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array('title','thumbnail')
	  ); 
 
	register_post_type( 'slideshow' , $args );
}

// Room Custom Post Type
add_action('init', 'rooms_register');
 
function rooms_register() {
	$labels = array(
		'name' => __('Rooms', 'warrior'),
		'singular_name' => __('Room', 'warrior'),
		'add_new' => __('Add New', 'warrior'),
		'add_new_item' => __('Add New Room', 'warrior'),
		'edit_item' => __('Edit Room', 'warrior'),
		'new_item' => __('New Room', 'warrior'),
		'view_item' => __('View Room', 'warrior'),
		'search_items' => __('Search Room', 'warrior'),
		'not_found' =>  __('Nothing found', 'warrior'),
		'not_found_in_trash' => __('Nothing found in Trash', 'warrior'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'room', 'with_front' => true ),
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array('title','editor', 'thumbnail')
	  ); 
 
	register_post_type( 'room' , $args );
}
// gallery Custom Post Type
add_action('init', 'gallerys_register');
 
function gallerys_register() {
	$labels = array(
		'name' => __('Galleries', 'warrior'),
		'singular_name' => __('Gallery', 'warrior'),
		'add_new' => __('Add New', 'warrior'),
		'add_new_item' => __('Add New Gallery', 'warrior'),
		'edit_item' => __('Edit Gallery', 'warrior'),
		'new_item' => __('New Gallery', 'warrior'),
		'view_item' => __('View Gallery', 'warrior'),
		'search_items' => __('Search Gallery', 'warrior'),
		'not_found' =>  __('Nothing found', 'warrior'),
		'not_found_in_trash' => __('Nothing found in Trash', 'warrior'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'gallery', 'with_front' => true ),
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array('title','editor', 'thumbnail')
	  ); 
 
	register_post_type( 'gallery' , $args );
}
// feature Custom Post Type
add_action('init', 'features_register');
 
function features_register() {
	$labels = array(
		'name' => __('Features', 'warrior'),
		'singular_name' => __('Feature', 'warrior'),
		'add_new' => __('Add New', 'warrior'),
		'add_new_item' => __('Add New Feature', 'warrior'),
		'edit_item' => __('Edit Feature', 'warrior'),
		'new_item' => __('New Feature', 'warrior'),
		'view_item' => __('View Feature', 'warrior'),
		'search_items' => __('Search Feature', 'warrior'),
		'not_found' =>  __('Nothing found', 'warrior'),
		'not_found_in_trash' => __('Nothing found in Trash', 'warrior'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'feature', 'with_front' => true ),
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array('title','editor', 'thumbnail')
	  ); 
 
	register_post_type( 'feature' , $args );
}
// testimonial Custom Post Type
add_action('init', 'testimonials_register');
 
function testimonials_register() {
	$labels = array(
		'name' => __('Testimonials', 'warrior'),
		'singular_name' => __('Testimonial', 'warrior'),
		'add_new' => __('Add New', 'warrior'),
		'add_new_item' => __('Add New Testimonial', 'warrior'),
		'edit_item' => __('Edit Testimonial', 'warrior'),
		'new_item' => __('New Testimonial', 'warrior'),
		'view_item' => __('View Testimonial', 'warrior'),
		'search_items' => __('Search Testimonial', 'warrior'),
		'not_found' =>  __('Nothing found', 'warrior'),
		'not_found_in_trash' => __('Nothing found in Trash', 'warrior'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'testimonial', 'with_front' => true ),
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array('title','editor', 'thumbnail')
	  ); 
 
	register_post_type( 'testimonial' , $args );
}
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_facility_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_facility_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Facilities', 'taxonomy general name' ),
		'singular_name'     => _x( 'Facility', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Facilities' ),
		'all_items'         => __( 'All Facilities' ),
		'parent_item'       => __( 'Parent Facility' ),
		'parent_item_colon' => __( 'Parent Facility:' ),
		'edit_item'         => __( 'Edit Facility' ),
		'update_item'       => __( 'Update Facility' ),
		'add_new_item'      => __( 'Add New Facility' ),
		'new_item_name'     => __( 'New Facility Name' ),
		'menu_name'         => __( 'Facility' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'facility' ),
	);

	register_taxonomy( 'facility', array( 'room' ), $args );
}
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_category_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_category_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Categories' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => __( 'Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'gallery-category' ),
	);

	register_taxonomy( 'gallery-category', array( 'gallery', ), $args );
}
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_category_room_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_category_room_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Categories' ),
		'all_items'         => __( 'All Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => __( 'Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'room-category' ),
	);

	register_taxonomy( 'room-category', array( 'room', ), $args );
}
// Remove facility from menu
add_action('admin_menu', 'my_remove_sub_menus');

function my_remove_sub_menus() {
    remove_submenu_page( 'edit.php?post_type=room', 'edit-tags.php?taxonomy=facility&amp;post_type=room' );
}
// Load metabox
add_action('admin_init', 'warrior_metabox', 1);	
add_action('admin_print_styles-post-new.php','warrior_metabox_style');
add_action('admin_print_styles-post.php','warrior_metabox_style');
add_action('save_post', 'warrior_metabox_save');
add_action('save_post', 'price_metabox_save');
add_action('save_post', 'icon_metabox_save');

/**
 * Theme Metabox
 * Function to display metabox options
 */
 	
function warrior_metabox() {
	global $themename;
	
    add_meta_box( 
        'slideshow_info',
        $themename . __( ' Slideshow Information', 'myplugin_textdomain' ),
        'warrior_metabox_form',
        'slideshow',
		'normal',
        'high'
    );
	add_meta_box( 
        'price',
        'Price',
        'price_metabox_form',
        'room',
		'side',
        'high'
    );
    add_meta_box( 
        'icon',
        'Icon',
        'icon_metabox_form',
        'feature',
		'normal',
        'high'
    );
    add_meta_box( 
        'review_info',
        $themename . __( ' Rating &amp; Review', 'myplugin_textdomain' ),
        'warrior_metabox_form',
        'post',
		'normal',
        'high'
    );
	
}


/**
 * Metabox Form
 * Function to display metabox form
 */
 
function warrior_metabox_form() {
	global $post, $shortname;
	
	wp_nonce_field('warrior_metabox_id','warrior_metabox');
	
	if ( 'slideshow' == get_post_type() ) {
		$slideshow_url = get_post_meta($post->ID, '_'.$shortname.'_slideshow_url', true);
		$slideshow_new_window = get_post_meta($post->ID, '_'.$shortname.'_slideshow_new_window', true);
?>
    
	<div id="warrior-metabox" class="warrior-metabox">
    	<fieldset>
            <div class="input text">
                <label><?php _e('Slideshow URL', 'warrior'); ?></label>
                <input id="slideshow_url" name="slideshow_url" type="text" value="<?php echo $slideshow_url; ?>" />
                <div class="hint"><?php _e('Where should this slideshow linked to.', 'warrior'); ?></div>
            </div>
            <div class="input checkbox">
                <label><?php _e('Open URL in a New Window?', 'warrior'); ?></label>
                <input id="slideshow_new_window" name="slideshow_new_window" type="checkbox" value="Yes" <?php if ( $slideshow_new_window == 'Yes' ) echo 'checked'; ?> /> <label class="inline" for="slideshow_new_window"><?php _e('Make this URL opened in a new window.', 'warrior'); ?></span>
            </div>
        </fieldset>
    </div>
	<?php
	}
	
	if ( 'post' == get_post_type() ) {
		$criteria_name = ( get_post_meta($post->ID, '_'.$shortname.'_criteria_name', true) ) ? get_post_meta($post->ID, '_'.$shortname.'_criteria_name', true) : array('');
		$criteria_value = get_post_meta($post->ID, '_'.$shortname.'_criteria_value', true);
		$review_pros = get_post_meta($post->ID, '_'.$shortname.'_review_pros', true);
		$review_cons = get_post_meta($post->ID, '_'.$shortname.'_review_cons', true);
?>
    
	<div id="warrior-metabox" class="warrior-metabox">
    	<fieldset class="ratings">
			<input type="button" value="<?php _e('Add New Criteria', 'warrior'); ?>" class="button button-highlighted" />
			<?php	
			if ( $criteria_name ) {
				$num = 1;
				if ( is_array($criteria_value) ) {
					foreach($criteria_value as $id=>$name) {
						$criteria_name[$id]	= isset($criteria_name[$id]) ? $criteria_name[$id] : '';
						$criteria_value[$id] = !empty($criteria_value[$id]) ? $criteria_value[$id] : '1';
			?>   
			            <div id="criteria-<?php echo $id; ?>" class="input">
			                <label><?php printf( __('Criteria %s', 'warrior'), $num); ?></label>
							<input name="criteria_name[<?php echo $id; ?>]" type="text" class="criteria" value="<?php echo $criteria_name[$id]; ?>" />
							<strong><?php _e('Rating:', 'warrior'); ?></strong>
							<div class="value-block">
								<div id="cvalue_<?php echo $id; ?>" class="criteria-value" ></div>
								<ul class="criteria-value"><?php
									for( $i = 1; $i <= 5; $i++ ) {
										$class = '';
										if ( $i == 1 ) $class .= "first";
										if ( $i == 5 ) $class .= "last";
										echo "<li". ( $class != "" ? " class=\"$class\"" : "" ).">".$i."</li>";
									}
								?></ul>
							</div>
							<input type="hidden" id="criteria_value_<?php echo $id; ?>" value="<?php echo $criteria_value[$id]; ?>" name="criteria_value[<?php echo $id; ?>]" />
							<input type="button" value="<?php _e('Remove', 'warrior'); ?>" class="button" id="remove_<?php echo $id; ?>"/>
			            </div>
						<script type="text/javascript">
							jQuery(document).ready(function($) {
								$( "#cvalue_<?php echo $id; ?>" ).cval({ id: <?php echo $id; ?>, value: <?php echo $criteria_value[$id]; ?> });
								$( "#remove_<?php echo $id; ?>" ).cdel({ id: <?php echo $id; ?> });
							});
						</script>
			<?php
						$num = $num + 1;
					}
				}
			}
			?>
        </fieldset>
		<div class="criteria-prototype" style="display:none;">
			<div id="criteria-___criteria__id___" class="input">
				<label><?php _e('Criteria Name', 'warrior'); ?></label>
				<input name="___criteria__name___" type="text" class="criteria" value="" />
				<strong><?php _e('Rating:', 'warrior'); ?></strong>
				<div class="value-block">
					<div id="cvalue____criteria__id___" class="criteria-value" ></div>
					<ul class="criteria-value"><?php
						for( $i = 1; $i <= 5; $i++ ) {
							$class = '';
							if ( $i == 1 ) $class .= "first";
							if ( $i == 5 ) $class .= "last";
							echo "<li". ( $class != "" ? " class=\"$class\"" : "" ).">".$i."</li>";
						}
					?></ul>
				</div>
				<input type="hidden" id="criteria_value____criteria__id___" value="1" name="___criteria__value___" />
				<input type="button" value="<?php _e('Remove', 'warrior'); ?>" class="button" id="remove____criteria__id___" />
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$( "#cvalue____criteria__id___" ).cval({ id: "___criteria__id___", value: 1 });
					$( "#remove____criteria__id___" ).cdel({ id: "___criteria__id___" });
				});
			</script>
		</div>
		<h4><?php _e('Pros &amp; Cons', 'warrior'); ?></h4>
    	<fieldset class="reviews">
            <div class="input textarea">
                <label><?php _e('Pros', 'warrior'); ?></label>
				<textarea name="review_pros" id="review_pros" cols="30" rows="5"><?php echo $review_pros; ?></textarea>
            </div>
            <div class="input textarea">
                <label><?php _e('Cons', 'warrior'); ?></label>
				<textarea name="review_cons" id="review_cons" cols="30" rows="5"><?php echo $review_cons; ?></textarea>
            </div>
        </fieldset>
    </div>
	<?php
	}
	
}

function price_metabox_form()
{ 
	global $post;
	
	wp_nonce_field('price_metabox_id','price_metabox');
	$price = get_post_meta($post->ID, 'price', true);
	?>
    <div id="price">
            <div class="input text">
                <label><?php _e('Price', 'kartika'); ?>
               		<input id="price" name="price" type="text" value="<?php echo $price; ?>" /> 
               	</label>
            </div>
    </div>

<?php
}

function icon_metabox_form()
{ 
	global $post;
	
	wp_nonce_field('icon_metabox_id','icon_metabox');
	$icon = get_post_meta($post->ID, 'icon', true);
	?>
    <div id="icon">
    	<div class="icon-list">
    		<input type="radio" id="glass" name="icon" value="fa-glass" <?php checked( $icon, "fa-glass" ); ?>>
    		<label for="glass"><i class="fa fa-glass fa-lg"></i></label>
		</div>
		<div class="icon-list">
			<input type="radio" id="credit-card" name="icon" value="fa-credit-card" <?php checked( $icon, "fa-credit-card" ); ?>>
			<label for="credit-card"><i class="fa fa-credit-card fa-lg"></i></label>
		</div>
		<div class="icon-list">
			<input type="radio" id="fa-cutlery" name="icon" value="fa-cutlery" <?php checked( $icon, "fa-cutlery" ); ?>>
			<label for="fa-cutlery"><i class="fa fa-cutlery fa-lg"></i></label>
		</div>
		<div class="icon-list">
			<input type="radio" id="fa-tin" name="icon" value="fa-tint" <?php checked( $icon, "fa-tint" ); ?>>
			<label for="fa-tin"><i class="fa fa-tint fa-lg"></i></label>
		</div>
		<div class="icon-list">
			<input type="radio" id="fa-bug" name="icon" value="fa-bug" <?php checked( $icon, "fa-bug" ); ?>>
			<label for="fa-bug"><i class="fa fa-bug fa-lg"></i></label>
		</div>
		<div class="icon-list">
			<input type="radio" id="fa-cog" name="icon" value="fa-cog" <?php checked( $icon, "fa-cog" ); ?>>
			<label for="fa-cog"><i class="fa fa-cog fa-lg"></i></label>
		</div>
		<div class="icon-list">
			<input type="radio" id="a-coffee" name="icon" value="fa-coffee" <?php checked( $icon, "fa-coffee" ); ?>>
			<label for="a-coffee"><i class="fa fa-coffee fa-lg"></i></label>
		</div>
		<div class="icon-list">
			<input type="radio" id="fa-dashboard" name="icon" value="fa-dashboard" <?php checked( $icon, "fa-dashboard" ); ?>>
			<label for="fa-dashboard"><i class="fa fa-dashboard fa-lg"></i></label>
		</div>
		<div class="icon-list">
			<input type="radio" id="fa-group" name="icon" value="fa-group" <?php checked( $icon, "fa-group" ); ?>>
			<label for="fa-group"><i class="fa fa-group fa-lg"></i></label>
		</div>
		<div class="icon-list">
			<input type="radio" id="fa-location-arrow" name="icon" value="fa-location-arrow" <?php checked( $icon, "fa-location-arrow" ); ?>>
			<label for="fa-location-arrow"><i class="fa fa-location-arrow fa-lg"></i></label>
		</div>
		<div class="icon-list">
			<input type="radio" id="fa-university" name="icon" value="fa-university" <?php checked( $icon, "fa-university" ); ?>>
			<label for="fa-university"><i class="fa fa-university fa-lg"></i></label>
		</div>
		<div class="icon-list">
			<input type="radio" id="fa-send" name="icon" value="fa-send" <?php checked( $icon, "fa-send" ); ?>>
			<label for="fa-send"><i class="fa fa-send fa-lg"></i></label>
		</div>
		<div class="icon-list">
			<input type="radio" id="fa-compass" name="icon" value="fa-compass" <?php checked( $icon, "fa-compass" ); ?>>
			<label for="fa-compass"><i class="fa fa-compass fa-lg"></i></label>
		</div>
		<div class="icon-list">
			<input type="radio" id="fa-cloud" name="icon" value="fa-cloud" <?php checked( $icon, "fa-cloud" ); ?>>
			<label for="fa-cloud"><i class="fa fa-cloud fa-lg"></i></label>
		</div>
		<div class="icon-list">
			<input type="radio" id="fa-map-marker" name="icon" value="fa-map-marker" <?php checked( $icon, "fa-map-marker" ); ?>>
			<label for="fa-map-marker"><i class="fa fa-map-marker fa-lg"></i></label>
		</div>
		
    </div>

<?php
}
/**
 * Metabox style
 * Function to load CSS file for metabox
 */
 
function warrior_metabox_style() {
	$path = get_template_directory_uri();
	
	// Style css needed to stylize the metabox
	wp_enqueue_style('panel-style', $path.'/functions/kartika/css/metabox.css');
	wp_enqueue_style('panel-icon', $path.'/css/font-awesome.min.css');
}


/**
 * Metabox Save
 * Function to add action saving all metabox options when post/page is saved
 */

function warrior_metabox_save() {
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

	if ( isset($_POST['warrior_metabox'] ) && !wp_verify_nonce( $_POST['warrior_metabox'], 'warrior_metabox_id' )  )
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
	
	if ( isset($_POST['slideshow_new_window']))
		$slideshow_new_window = $_POST['slideshow_new_window'];
	else
		$slideshow_new_window = 'No';
		
	$slideshow_url = ( isset($_POST['slideshow_url']) ) ? $_POST['slideshow_url'] : '';
	$slideshow_new_window = ( isset($_POST['slideshow_new_window']) ) ? $_POST['slideshow_new_window'] : '';
	
	$criteria_name = ( isset($_POST['criteria_name']) ) ? $_POST['criteria_name'] : '';
	$criteria_value = ( isset($_POST['criteria_value']) ) ? $_POST['criteria_value'] : '';
	$review_pros = ( isset($_POST['review_pros']) ) ? $_POST['review_pros'] : '';
	$review_cons = ( isset($_POST['review_cons']) ) ? $_POST['review_cons'] : '';

	update_post_meta($post_id, '_'.$shortname.'_slideshow_url', $slideshow_url);
	update_post_meta($post_id, '_'.$shortname.'_slideshow_new_window', $slideshow_new_window);
	
	update_post_meta($post_id, '_'.$shortname.'_criteria_name', $criteria_name);
	update_post_meta($post_id, '_'.$shortname.'_criteria_value', $criteria_value);
	update_post_meta($post_id, '_'.$shortname.'_review_pros', $review_pros);
	update_post_meta($post_id, '_'.$shortname.'_review_cons', $review_cons);
	
	return $post_id;
}
function price_metabox_save() {
	global $post;
	
	if ( isset($post) ) {
		if ( is_array($post) )
			$post_id = $post['ID'];
		else
			$post_id = $post->ID;
	} else
		$post_id = 0;
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['price_metabox'] ) && !wp_verify_nonce( $_POST['price_metabox'], 'price_metabox_id' )  )
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

	update_post_meta($post->ID, 'price', $_POST['price']);
	
	return $post_id;
}

function icon_metabox_save() {
	global $post;
	
	if ( isset($post) ) {
		if ( is_array($post) )
			$post_id = $post['ID'];
		else
			$post_id = $post->ID;
	} else
		$post_id = 0;
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['icon_metabox'] ) && !wp_verify_nonce( $_POST['icon_metabox'], 'icon_metabox_id' )  )
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

	update_post_meta($post->ID, 'icon', $_POST['icon']);
	
	return $post_id;
}
// Theme Localization
load_theme_textdomain('warrior', get_template_directory().'/lang');

// Set maximum image width displayed in a single post or page
if ( ! isset( $content_width ) ) {
	$content_width = 620;
}

?>