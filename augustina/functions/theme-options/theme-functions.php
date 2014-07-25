<?php
/**
 * Theme Custom Functions
 *
 * Functions used in the theme
 */
 

/**
 * Warrior Menu
 *
 * Adding Home to Nav Menu
 */
add_filter('wp_nav_menu_items','add_home_link',10,2);
function add_home_link($items, $args) {
	global $shortname;
	
	if ( is_front_page() || is_home() ) :  $class = 'menu-item page-item-0 current-menu-item page_item current_page_item menu-item-0'; else: $class = 'menu-item page-item-0 page_item menu-item-0'; endif;
	
	if ( $args->theme_location == 'main-menu' && get_option($shortname.'_home_link') == "Yes" ) { 
		$homeMenuItem = '<li class="'.$class.'">'.$args->before.'<a href="'.home_url('/').'" title="Home">'.$args->link_before.'Home'.$args->link_after.'</a>'.$args->after.'</li>'."\n";
		} else {
		$homeMenuItem = '';
	}
	
	$items = $homeMenuItem . $items;
	return $items;
}


/**
 * Warrior Post Info
 */
function warrior_post_info(){
	global $post;
?>
	<div class="meta">
		<span class="icon-user-md"></span> <?php printf( __('Posted by %s', 'warrior'), get_the_author()); ?>
		<span class="icon-calendar"></span> <?php the_time(get_option('date_format')); ?>
		<span class="icon-comments"></span> <?php comments_popup_link( __( '0 Comment', 'warrior' ), __( '1 Comment', 'warrior' ), __( '% Comments', 'warrior' ), '', __( 'Comments are off', 'warrior' ) ); ?>
		<span class="icon-eye-open"></span> <?php printf( __( '%s views', 'warrior' ), warrior_page_view($post->ID) ); ?>
	</div>
<?php
}


/**
 * Warrior Author Info
 *
 * Function to display author post
 */
function warrior_author_box() { 
	global $post, $shortname;
	
	$author_id	= $post->post_author;
	
	if ( get_option($shortname . "_author_info") == "Yes" ) :	
?>
	<!-- START: AUTHOR BOX -->
	<div id="author-box" class="clearfix">
		<h3 class="title"><span class="icon-th"></span> <?php printf( __('About %s', 'warrior'), get_the_author_meta('display_name', $author_id)); ?></h3>
		<?php echo get_avatar( $author_id, '50' ); ?>
		<p><?php echo get_the_author_meta('description', $author_id); ?></p>
		<p class="author-url">
			<a href="<?php echo get_author_posts_url($author_id); ?>"><span class="icon-list-alt"></span> <?php printf( __('View all post by %s', 'warrior'), get_the_author_meta('display_name', $author_id)); ?></a>
			<?php if ( get_the_author_meta('user_url', $author_id) != '' ) { ?>
				<a href="<?php echo get_the_author_meta('user_url', $author_id); ?>"><span class="icon-download-alt"></span> <?php _e('Visit author\'s website', 'warrior'); ?></a>
			<?php } ?>
		</p>
	</div>
	<!-- END: AUTHOR BOX -->
<?php
	endif;
}


/**
 * Warrior Related Post
 */
function warrior_related_posts(){
	global $post, $shortname;
	
    if ( get_option($shortname.'_enable_related_post') == "Yes" ) :
          
		// Let's get the categories  
		$categories = get_the_category($post->ID);
		if ($categories) {
            $cat_ids = array();
            foreach($categories as $the_category) $cat_ids[] = $the_category->term_id;
    
            $args=  array(
                'category__in'			=> $cat_ids, 			// The categories
                'post__not_in' 			=> array($post->ID), 	// Exclude current post ID
                'showposts'				=> 4, 					// Number of posts to be displayed
                'ignore_sticky_posts'	=>1 					// Ignore sticky posts
            );
?>
	<!-- START: RELATED POSTS -->
	<div id="related-posts" class="clearfix">
		<h3 class="title"><span class="icon-th"></span> <?php _e('Related Posts', 'warrior'); ?></h3>
		<ul>
<?php                                                    
            $my_query = new wp_query($args);
            if( $my_query->have_posts() ) {

				$i = 1;
                while ($my_query->have_posts()) {
                    $my_query->the_post();
?>
			<li>
				<div class="thumb"><?php warrior_thumbnail( 'both', '80', '60', 'cat-small-thumb', get_the_title()); ?></div>
				<h4 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
				<div class="meta"><?php the_time( get_option('date_format') ); ?> - <?php comments_popup_link( __( '0 Comment', 'warrior' ), __( '1 Comment', 'warrior' ), __( '% Comments', 'warrior' ), '', __( 'Comments are off', 'warrior' ) ); ?></div>
			</li>
<?php
				if ( $i%2 == 0 ) echo '<div class="clearfix"></div>';
				$i = $i+1;
				}
				
			} else {
?>
			<li><?php _e('Sorry, no post found.', 'warrior'); ?></li>
            <?php } ?>
		</ul>
	</div>
	<!-- END: RELATED POSTS -->
<?php       
		}
		wp_reset_query();
    endif;
}


/**
 * Warrior Social Buttons
 *
 * Function to shared post or page
 */
function warrior_social_buttons() {
	global $post;
?>
	<div class="share-buttons clearfix">
		<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo get_permalink($post->ID); ?>&amp;layout=button_count&amp;show_faces=true&amp;width=80&amp;action=like&amp;font&amp;colorscheme=light&amp;height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:20px; margin:0 5px 0 0;" allowTransparency="true"></iframe>
		
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo get_permalink($post->ID); ?>" data-count="horizontal">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>

		<!-- Place this tag where you want the +1 button to render -->
		<g:plusone size="medium"></g:plusone>
		
		<!-- Place this render call where appropriate -->
		<script type="text/javascript">
			(function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			})();
		</script>
        
        <script type="text/javascript">
		(function() {
		var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
		s.type = 'text/javascript';
		s.async = true;
		s.src = 'http://widgets.digg.com/buttons.js';
		s1.parentNode.insertBefore(s, s1);
		})();
		</script>
       
        <!-- Compact Button -->
		<a class="DiggThisButton DiggCompact"></a>
	</div>
<?php
}


/**
 * Warrior Comments
 *
 * Function to load comment list
 */
function warrior_comment_list($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
?>			
			<div class="reply-line"></div>
			<div class="comment"> 
			<?php echo comment_reply_link(array('before' => '<div class="reply-button">', 'after' => '</div>', 'reply_text' => __('Reply', 'kartika'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ));  ?>
				<div class="avatar"><?php echo get_avatar( $comment, 50 ); ?></div>
				<div class="comment-text">
	              <div class="author">
	                <div class="name"><?php comment_author_link(); ?></div>
	                <div class="date"><?php comment_date(); ?></div>
	                <div class="date"><?php edit_comment_link(__('Edit Comment', 'warrior')); ?></div>
	              </div>
	              <div class="text">
	                <?php if ($comment->comment_approved == '0') : ?>
							<p class="moderate"><?php _e('Your comment is now awaiting moderation before it will appear on this post.', 'warrior');?></p>
					<?php endif; ?>
					<?php comment_text(); ?>
	              </div>
	            </div>
	        </div>
<?php
		break;
		case 'pingback'  :
		case 'trackback' :
?>
			<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
				<div class="comment-wrapper">
					<p><?php _e('Pingback', 'warrior'); ?> <?php comment_author(); ?></p>		
				</div>
<?php
		break;
	endswitch;
}
add_filter('get_avatar','add_gravatar_class');

function add_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='img-circle", $class);
    return $class;
}
// Display User Rating
update_option($shortname . '_post_rating', 'Yes');
?>