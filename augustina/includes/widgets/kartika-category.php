<?php
/* category CLOUD */

class category_Widget extends WP_Widget
{
  function category_Widget()
  {
    $widget_ops = array('classname' => 'widget', 'description' => 'Display categorys.' );
    $this->WP_Widget('category_Widget', '[KARTIKA] - CATEGORY CLOUD', $widget_ops);
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
      $title = "Categories";
    }
    
 
    // WIDGET CODE GOES HERE
  
     global $name, $post, $content;
    ?>
    <h3><?php echo $title;?></h3>
    <ul class="list-unstyled arrow">
            <?php     $args = array(
                'orderby' => 'name',
                'parent' => 0
                );
              $categories = get_categories( $args );
              foreach ($categories as $key) {
                echo '<li><a href="'. get_category_link( $key->term_id ) . '">'.$key->name.' <span class="badge pull-right">'.$key->count.'</span></a></li>';
              }
              
              ?> 
        </ul>
    <?php 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("category_Widget");') );
