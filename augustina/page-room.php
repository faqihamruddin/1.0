<?php
/*
Template Name: Rooms
*/
?>

<?php get_header(); ?>

<!-- Parallax Effect -->
<script type="text/javascript">$(document).ready(function(){$('#parallax-pagetitle').parallax("50%", -0.55);});</script>

<section class="parallax-effect">
  <div id="parallax-pagetitle" style="background-image: url(./images/parallax/1900x911.gif);">
    <div class="color-overlay"> 
      <!-- Page title -->
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><a href="index.html">Home</a></li>
              <li class="active">Rooms list view</li>
            </ol>
            <h1>Rooms list view</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Filter -->
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ul class="nav nav-pills" id="filters">
        <li class="active"><a href="#" data-filter="*">All</a></li>
        <?php
            $terms = get_terms('room-category', $args);
            $count = count($terms); 
            $i=0;
            if ($count > 0) {
              foreach ($terms as $term) {
                $i++;
                $term_list .= '<li><a href="#"  data-filter=".'. $term->slug .'">' . $term->name . '</a></li>';
                if ($count != $i)
                {
                  $term_list .= '';
                }
                else 
                {
                  $term_list .= '';
                }
              }
              echo $term_list;
            }
          ?>
      </ul>
    </div>
  </div>
</div>

<!-- Rooms -->
<section class="rooms mt100">
  <div class="container">
    <div class="row room-list fadeIn appear"> 
      <?php
        $args = array(
                      'post_type' => 'room',
                      'posts_per_page' => '-1',
                      'paged' => $paged,
                      );
              $temp = $wp_query; 
              $wp_query = null;
                      $wp_query = new WP_Query($args);
                      if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
                      $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
                      $terms = get_the_terms( get_the_ID(), 'room-category' ); 
                  ?>
        <!-- Room -->
        <div class="col-sm-4 <?php foreach ($terms as $term) { echo  strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>">
          <div class="room-thumb"> <img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo $thumbnail[0];?>&amp;h=228&amp;w=356&amp;zc=1" alt="room 1" class="img-responsive" />
            <div class="mask">
              <div class="main">
                <h5><?php the_title();?></h5>
                <div class="price">&euro; 99<span>a night</span></div>
              </div>
              <div class="content">
               <?php the_content();?>
               <div class="row">
                    <div class="col-xs-12">
                      <ul class="list-unstyled list-facility">
                        <?php
                        $terms = get_the_terms( $post->ID, 'facility' );
                        if ( $terms && ! is_wp_error( $terms ) ) :
                        $terms = array_values($terms);
                        $i = 1;
                        foreach ($terms as $key) {
                        ?>
                          <li><i class="fa fa-check-circle"></i><?php echo $key->name; ?></li>
                        <?php if ($i++ == 8) break;}; endif; ?>
                      </ul>
                    </div>
                  </div>
                <a href="<?php the_permalink();?>" class="btn btn-primary btn-block">Read More</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Room -->
        <?php endwhile;rewind_posts();?>
      <?php else:?>
      <?php endif;?><?php  wp_reset_postdata(); ?>
      
    </div>
  </div>
</section>

	<!-- END: MAIN CONTENT -->
<?php get_footer(); ?>