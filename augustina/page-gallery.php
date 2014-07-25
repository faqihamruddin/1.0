<?php
/*
Template Name: Gallery
*/
?>

<?php get_header(); ?>

<!-- Parallax Effect -->
<script type="text/javascript">$(document).ready(function(){$('#parallax-pagetitle').parallax("50%", -0.55);});</script>

<section class="parallax-effect">
  <div id="parallax-pagetitle" style="background-image: url(./<?php bloginfo('template_directory');?>/images/parallax/1900x911.gif);">
    <div class="color-overlay"> 
      <!-- Page title -->
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><a href="index.html">Home</a></li>
              <li class="active">Gallery</li>
            </ol>
            <h1>Gallery</h1>
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
            $terms = get_terms('gallery-category', $args);
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

<!-- Gallery -->
<section id="gallery" class="mt50">
  <div class="container">
    <div class="row gallery"> 
      <!-- Image 4 -->
      <?php
        $args = array(
        'post_type' => 'gallery',
        'posts_per_page' => '-1',
        'paged' => $paged,
        );
        $temp = $wp_query; 
        $wp_query = null;
        $wp_query = new WP_Query($args);
        if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
        $terms = get_the_terms( get_the_ID(), 'gallery-category' ); 
      ?>
        <div class="col-sm-3 <?php foreach ($terms as $term) { echo  strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?> fadeIn appear"> <a href="<?php echo $thumbnail[0];?>" data-rel="prettyPhoto[gallery1]"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo $thumbnail[0];?>&amp;h=168&amp;w=263&amp;zc=1" alt="image" class="img-responsive zoom-img" /><i class="fa fa-search"></i></a> </div>
      <?php endwhile;rewind_posts();?>
      <?php else:?>
      <?php endif;?><?php  wp_reset_postdata(); ?>
    </div>
  </div>
</section>

	<!-- END: MAIN CONTENT -->
<?php get_footer(); ?>