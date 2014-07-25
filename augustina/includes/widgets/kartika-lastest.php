<?php
/* latest */
class latest_Widget extends WP_Widget
{
  function latest_Widget()
  {
    $widget_ops = array('classname' => 'widget', 'description' => 'Display latest post.' );
    $this->WP_Widget('latest-Widget', '[KARTIKA] Lates Box', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = $instance['title'];
 
    if (empty($title)){
      $title = "Latest Posts";
    }
 ?>
 		<div class="widget clearfix">
          <h3><?php echo $title;?></h3>
          <ul class="list-unstyled">
            <?php
                // Start fetching the post from database
                $warrior_latest_latest_posts = new WP_Query("showposts=4&post_type='post'");
            	while($warrior_latest_latest_posts->have_posts()) : $warrior_latest_latest_posts->the_post();
            	$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
            ?>
            <li>
              <article>
              <?php if(has_post_thumbnail()){ ?>
                <div class="news-thumb"> <a href="<?php the_permalink();?>"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo $thumbnail[0];?>&amp;h=65&amp;w=65&amp;zc=1" alt="" /></a> </div>
              <?php } ?>
                <div class="news-content clearfix">
                  <h4><a href="blog-post.html"><?php the_title();?></a></h4>
                  <span><a href="blog-post.html"><?php the_time('F j Y');?></a></span> </div>
              </article>
            </li>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
 	    	</ul>
        </div>
        <?php
	//END CODE
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("latest_Widget");') );