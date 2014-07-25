<?php global $shortname; ?>
<!-- Call To Action -->
  <section id="call-to-action">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <i class="fa fa-twitter fa-lg"></i>
          <div id="owl-twitter">
          <?php
          include (TEMPLATEPATH.'/includes/twitteroauth.php');

      $twitteruser = get_option($shortname.'_twitter');
      $notweets = 5;
      $consumerkey = "hoUaPcoJECyfj1rncL8S9YU2j";
      $consumersecret = "ewoLQhdUoQ875BET3PcQPfJFWrWFKp41DB6XZ4Boulht7YujCQ";
      $accesstoken = "361323363-hMTmOY669NnJBMppIFMqC4F42tUVDsCp0fcvVQ7n";
      $accesstokensecret = "uxemdOJtdsXyYL6Dx83VpOc4ENRwzntvjtUtuG00VFenY";

      function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
        $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
        return $connection;
      }

      $connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

      $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);

      //var_dump($tweets);
      foreach ($tweets as $key) {
        echo '<div class="item">';
              echo '<div class="col-lg-12 col-md-8 col-sm-10 col-xs-12">';
                echo '<p>'.$key->text.'</p>';
              echo '</div>';
            echo '</div>';
          ;
      }?>
                    </div>
        </div>
      </div>
    </div>
  </section>
<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <h4>About Augustina</h4>
        <?php echo apply_filters('the_content',get_option($shortname.'_about'));?>
       </div>
      <div class="col-md-4 col-sm-4">
        <h4>From our blog</h4>
        <ul>
        <?php 
        $args = array(
                      'post_type' => 'post',
                      'posts_per_page' => '4',
                      'paged' => $paged
                );
        $temp = $wp_query; 
        $wp_query = null;
        $wp_query = new WP_Query($args);
        if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
        ?>
          <li><a href="<?php the_permalink();?>"><?php the_title();?><br>
            <?php the_time('F j, Y');?></a></li>
        <?php endwhile;rewind_posts();?>
        <?php else:?>
          <li><a href="#">Opps, There's no post!</a></li>
        <?php endif;?><?php  wp_reset_postdata(); ?>
        </ul>
      </div>
      <div class="col-md-4 col-sm-4 maps">
        <h4>Address</h4>
        <address>
           <ul>
            <li>
              <i class="fa fa-map-marker fa-lg"></i>
              <?php echo get_option($shortname.'_address');?><br>
            </li>
            <li>
              <abbr title="Phone"><i class="fa fa-phone fa-lg"></i></abbr> <a href="#"><?php echo get_option($shortname.'_phone');?></a><br>
            </li>
            <li>
              <abbr title="Email"><i class="fa fa-envelope fa-lg"></i></abbr> <a href="#"><?php echo get_option($shortname.'_email');?></a><br>
            </li>
            <li>
              <abbr title="Website"><i class="fa fa-paper-plane fa-lg"></i></abbr> <a href="#"><?php bloginfo('url');?></a><br>
            </li>
          </ul>
        </address>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-6"> &copy; 2014 Augustina Home All Rights Reserved </div>
      </div>
    </div>
  </div>
</footer>

<!-- Go-top Button -->
<div id="go-top"><i class="fa fa-angle-up fa-2x"></i></div>
<script type="text/javascript">
jQuery(document).ready(function () {
    "use strict";

  if (jQuery().gMap) {
        jQuery('#map').gMap({
            zoom: 16, //Integer: Level of zoom in to the map
            markers: [{
                address: "<?php echo get_option($shortname.'_address');?>", //Address of the company
                html: "<h4>Our hotel</h4><p>This is our hotel</p>", //Quicktip
                popup: false, //Boolean 
                scrollwheel: false, //Boolean
                maptype: 'TERRAIN', //Choose between: 'HYBRID', 'TERRAIN', 'SATELLITE' or 'ROADMAP'.
                icon: {
                    image: "<?php bloginfo('template_url'); ?>/images/ui/gmap-icon.png",
                    iconsize: [42, 53],
                    iconanchor: [12, 46]
                },

                controls: {
                    panControl: false, //Boolean
                    zoomControl: false, //Boolean
                    mapTypeControl: true, //Boolean
                    scaleControl: true, //Boolean
                    streetViewControl: true, //Boolean
                    overviewMapControl: false //Boolean
                }
            }]
        });
    }
});
</script>
<?php wp_footer();?>
</body>
</html>