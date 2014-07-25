<?php
/* TAG CLOUD */

class tag_Widget extends WP_Widget
{
  function tag_Widget()
  {
    $widget_ops = array('classname' => 'widget', 'description' => 'Display tags.' );
    $this->WP_Widget('tag_Widget', '[KARTIKA] - TAG CLOUD', $widget_ops);
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
 
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    echo $before_widget;
    $title = $instance['title'];
 
    if (empty($title)){
      $title = "Tags";
    }
    
 
    // WIDGET CODE GOES HERE
    
     global $name, $post, $content;
    ?>
    <h3><?php echo $title;?></h3>
    <div class="tags">
            <?php     $args = array(
                'orderby' => 'name',
                'parent' => 0
                );
              $tags = get_tags( $args );
              foreach ($tags as $key) {
                echo '<a href="'.get_tag_link( $key->term_id ).'">'.$key->name.'</a>';
              }
              
              ?> 
        </div>
    <?php 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("tag_Widget");') );
