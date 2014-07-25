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

      </div>
    </section>
    
    <!-- Aside -->
    <aside class="mt50">
      <div class="col-md-3"> 
        <!-- Widget: Text -->
        <div class="widget">
          <h3>About our blog</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sed turpis neque. In auctor, odio eget luctus lobortis, sapien erat blandit felis, eget volutpat augue felis in purus.</p>
        </div>
        <!-- Widget: Latest news -->
        <div class="widget clearfix">
          <h3>Latest News</h3>
          <ul class="list-unstyled">
            <li>
              <article>
                <div class="news-thumb"> <a href="blog-post.html"><img src="images/blog/65x65.gif" alt="65x65"></a> </div>
                <div class="news-content clearfix">
                  <h4><a href="blog-post.html">This is a video post</a></h4>
                  <span><a href="blog-post.html">April 15 2014</a></span> </div>
              </article>
            </li>
            <li>
              <article>
                <div class="news-thumb"> <a href="blog-post.html"><img src="images/blog/65x65.gif" alt="65x65"></a> </div>
                <div class="news-content clearfix">
                  <h4><a href="blog-post.html">An image post</a></h4>
                  <span><a href="blog-post.html">April 14 2014</a></span> </div>
              </article>
            </li>
            <li>
              <article>
                <div class="news-thumb"> <a href="blog-post.html"><img src="images/blog/65x65.gif" alt="65x65"></a> </div>
                <div class="news-content clearfix">
                  <h4><a href="blog-post.html">Audio included post</a></h4>
                  <span><a href="blog-post.html">April 12 2014</a></span> </div>
              </article>
            </li>
          </ul>
        </div>
        <!-- Widget: Categories -->
        <div class="widget">
          <h3>Category</h3>
          <ul class="list-unstyled arrow">
            <li><a href="#">Rooms <span class="badge pull-right">46</span></a></li>
            <li><a href="#">Media <span class="badge pull-right">11</span></a></li>
            <li><a href="#">Marketing <span class="badge pull-right">42</span></a></li>
          </ul>
        </div>
        <!-- Widget: Tags -->
        <div class="widget">
          <h3>Tags</h3>
          <div class="tags"> <a href="#">HTML</a> <a href="#">CSS</a> <a href="#">Jquery</a> <a href="#">Modern</a> <a href="#">Responsive</a> <a href="#">Wordpress</a> <a href="#">Fun</a> <a href="#">Movies</a> <a href="#">Music</a> <a href="#">Information</a> </div>
        </div>
        <!-- Widget: Archive -->
        <div class="widget">
          <h3>Archive</h3>
          <ul class="list-unstyled arrow">
            <li><a href="#">April 2014 <span class="badge pull-right">15</span></a></li>
            <li><a href="#">May 2014 <span class="badge pull-right">9</span></a></li>
            <li><a href="#">February 2014 <span class="badge pull-right">3</span></a></li>
            <li><a href="#">January 2014 <span class="badge pull-right">5</span></a></li>
          </ul>
        </div>
      </div>
    </aside>
  </div>
</div>


<?php get_footer(); ?>