<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>
  
<!-- Parallax Effect -->
<script type="text/javascript">$(document).ready(function(){$('#parallax-pagetitle').parallax("50%", -0.55);});</script>

<section class="parallax-effect">
  <div id="parallax-pagetitle" style="background-image: url(./<?php bloginfo('template_url'); ?>/images/parallax/1900x911.gif);">
    <div class="color-overlay"> 
      <!-- Page title -->
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
              <ol class="breadcrumb">
              <li><a href="index.html">Home</a></li>
              <li class="active">Blog</li>
            </ol>
            <h1>Archive for <?php single_cat_title();?></h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="container">
  <div class="row"> 
    <!-- Blog -->
    <section class="blog mt50">
      <div class="col-md-9"> 
        <?php
        if(have_posts()) : while(have_posts()) : the_post();
        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
        $terms = get_the_terms( get_the_ID(), 'room-category' );
        $comment = wp_count_comments($post->ID);($comment !== 1) ? $txt = __("Comments",'kartika') : $txt = __("Comment",'kartika');
        ?>
        <!-- Article Image-->
        <article>
        <?php if ( has_post_thumbnail() ) { ?>
          <a href="<?php the_permalink();?>" class="mask">
            <img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo $thumbnail[0];?>&amp;h=344&amp;w=940&amp;zc=1" alt="image" class="img-responsive zoom-img">
          </a>
        <?php }?>
          <div class="row">
            <div class="col-sm-1 col-xs-2 meta">
              <div class="meta-date"><span><?php echo substr(get_the_time('F'),0,3); ?></span><?php the_time('j'); ?></div>
            </div>
            <div class="col-sm-11 col-xs-10 meta">
              <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
              <span class="meta-author"><i class="fa fa-user"></i><a href="<?php the_permalink();?>"><?php the_author();?></a></span><span class="meta-comments"><i class="fa fa-comment"></i><a href="#"><?php echo $comment->approved.' '.$txt;?></a></span>
              <p class="intro"><?php echo kartika_excerpt(100);?></p>
              <a href="<?php the_permalink();?>" class="btn btn-primary pull-right">Read More</a> </div>
          </div>
        </article>
        <!-- Room -->
        <?php endwhile;rewind_posts();?>
        <?php else:?>
          <article> 
           <div class="row">
            <div class="col-sm-11 col-xs-10 meta">
              <h2 class="fadeIn appear">404</h2>
              <h3 class="fadeIn appear" data-start="700">Well this is embarrassing... We can’t find your page.</h3>
              <a class="btn btn-lg btn-default mt30 fadeIn appear" data-start="1000" href="index.html"><i class="fa fa-home"></i> Go back to home</a> </div>
          </div>
        </article>
        <?php endif;?><?php  wp_reset_postdata(); ?>
        <!-- Pagination -->
        <div class="text-center mt50">
          <?php pagination();?>
        </div>
      </div>
    </section>
    
    <!-- Aside -->
    <aside class="mt50"> 
      <!-- Widget: Text -->
      <div class="col-md-3">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) { } ?>
      </div>
    </aside>
  </div>
</div>



<?php get_footer(); ?>