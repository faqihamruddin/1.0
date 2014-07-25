<?php get_header(); ?>

<!-- Parallax Effect -->
<script type="text/javascript">$(document).ready(function(){$('#parallax-pagetitle').parallax("50%", -0.55);});</script>
<?php while(have_posts()) : the_post();?>
<section class="parallax-effect">
  <div id="parallax-pagetitle" style="background-image: url(./images/parallax/1900x911.gif);">
    <div class="color-overlay"> 
      <!-- Page title -->
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><a href="index.html">Home</a></li>
              <li><a href="blog.html">Blog</a></li>
              <li class="active">Blog Post</li>
            </ol>
            <h1><?php the_title();?></h1>
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
        <!-- Article -->
        <article>
          <div class="row">
            <div class="col-sm-1 col-xs-2 meta">
              <div class="meta-date"><span><?php echo substr(get_the_time('F'),0,3); ?></span><?php the_time('j'); ?></div>
            </div>
            <div class="col-sm-11 col-xs-10 meta">
              <h2><?php the_title();?></h2>
              <?php $terms = get_the_terms( get_the_ID(), 'room-category' );$comment = wp_count_comments($post->ID);($comment !== 1) ? $txt = __("Comments",'kartika') : $txt = __("Comment",'kartika');?>
              <span class="meta-author"><i class="fa fa-user"></i><a href="#"><?php the_author();?></a></span><span class="meta-comments"><i class="fa fa-comment"></i><a href="#"><?php echo $comment->approved.' '.$txt;?></a></span> </div>
            <div class="col-md-12">
              <?php echo apply_filters('the_content', $post->post_content);?>  
            </div>
          </div>
        </article>
        
        <?php endwhile;rewind_posts();?>
        <?php comments_template('', true); ?>   
        <!-- Blog: Comments -->
        <section class="comments mt50">
          <div class="blog-comments">
          <?php // Do not delete these lines
          if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
            die (_e('Please do not load this page directly. Thanks!', 'warrior'));

            if (!empty($post->post_password)) { // if there's a password
              if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
          ?>
            <h2 class="lined-heading"><span><i class="fa fa-comments"></i><?php _e('This post is password protected. Enter the password to view comments.','warrior') ; ?></span></h2>
          <?php
              return;
              }
            }
          ?>
          </div>
          
          
        </section>
      </div>
    </section>
    
    <!-- Aside -->
    <aside class="mt50">
      <div class="col-md-3"> 
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) { } ?>
      </div>
    </aside>
  </div>
</div>


<?php get_footer(); ?>