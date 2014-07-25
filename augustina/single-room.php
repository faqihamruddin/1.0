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
              <li><a href="room-list.html">Room list view</a></li>
              <li class="active">Room detail</li>
            </ol>
            <h1><?php the_title();?></h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="container mt50">
  <div class="row"> 
    <!-- Slider -->
    <section class="standard-slider room-slider">
      <div class="col-sm-12 col-md-8">
        <div id="owl-standard" class="owl-carousel">
          <?php if (class_exists('Just_Field') AND get_post_meta($post->ID, 'image', true) != "")  {
            $images = get_post_meta($post->ID, 'image', true);
            if(!empty($images)) foreach($images as $img) : ?> 
              <div class="item"><a href="<?php echo $img['image'];?>" data-rel="prettyPhoto[gallery1]"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo $img['image'];?>&amp;w=750&amp;h=380&amp;zc=1" alt="<?php echo esc_attr($img['title']); ?>" /></a></div> 
          <?php endforeach; ?>
          <?php } elseif (has_post_thumbnail()) { ?>
          <?php $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), '');?>
            <div class="item"> <a href="<?php echo $thumbnail[0];?>" data-rel="prettyPhoto[gallery1]"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo $thumbnail[0];?>&amp;w=750&amp;zc=1" alt="room 1" class="img-responsive" /></a> </div>
          <?php } ?>
        </div>
      </div>
    </section>
    
    <!-- Reservation form -->
    <section id="reservation-form" class="mt50 clearfix">
      <div class="col-sm-12 col-md-4">
        <form class="reservation-vertical clearfix" role="form" method="post" action="<?php bloginfo('template_directory');?>/php/reservation.php" name="reservationform" id="reservationform">
          <h2 class="lined-heading"><span>Reservation</span></h2>
          <div class="price">
            <h4><?php the_title();?></h4>
            <?php echo get_post_meta($post->ID, 'price',true);?>,-<span> a night</span></div>
          <div id="message"></div>
          <!-- Error message display -->
          <div class="form-group">
            <label for="email" accesskey="E">E-mail</label>
            <input name="email" type="text" id="email" value="" class="form-control" placeholder="Please enter your E-mail"/>
          </div>
          <div class="form-group">
            <select class="hidden" name="room" id="room" disabled="disabled">
              <option selected="selected"><?php the_title();?></option>
            </select>
          </div>
          <div class="form-group">
            <label for="checkin">Check-in</label>
            <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-In is from 11:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
            <i class="fa fa-calendar infield"></i>
            <input name="checkin" type="text" id="checkin" value="" class="form-control" placeholder="Check-in"/>
          </div>
          <div class="form-group">
            <label for="checkout">Check-out</label>
            <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-out is from 12:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
            <i class="fa fa-calendar infield"></i>
            <input name="checkout" type="text" id="checkout" value="" class="form-control" placeholder="Check-out"/>
          </div>
          <div class="form-group">
            <div class="guests-select">
              <label>Guests</label>
              <i class="fa fa-user infield"></i>
              <div class="total form-control" id="test">1</div>
              <div class="guests">
                <div class="form-group adults">
                  <label for="adults">Adults</label>
                  <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="+18 years"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                  <select name="adults" id="adults" class="form-control">
                    <option value="1">1 adult</option>
                    <option value="2">2 adults</option>
                    <option value="3">3 adults</option>
                  </select>
                </div>
                <div class="form-group children">
                  <label for="children">Children</label>
                  <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="0 till 18 years"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                  <select name="children" id="children" class="form-control">
                    <option value="0">0 children</option>
                    <option value="1">1 child</option>
                    <option value="2">2 children</option>
                    <option value="3">3 children</option>
                  </select>
                </div>
                <button type="button" class="btn btn-default button-save btn-block">Save</button>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Book Now</button>
        </form>
      </div>
    </section>
    
    <!-- Room Content -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-sm-12 mt50">
            <h2 class="lined-heading"><span>Room Details</span></h2>
            <h3 class="mt50">Table overview</h3>
            <table class="table table-striped mt30">
              <tbody>
                <tr>
                  <?php
                  $terms = get_the_terms( $post->ID, 'facility' );
                  if ( $terms && ! is_wp_error( $terms ) ) :
                  $terms = array_values($terms);
                  $i = 1;
                  foreach ($terms as $key) {
                  ?>
                    <td><i class="fa fa-check-circle"></i><?php echo $key->name; ?></td>
                  <?php if ($i++ == 3 ) echo '</tr><tr>';}; endif; ?>
                </tr>
              </tbody>
            </table>
            <p class="mt50"><?php echo $post->post_content;?></p>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- Other Rooms -->
<section class="rooms mt50">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2 class="lined-heading"><span>Other rooms</span></h2>
      </div>
      <?php
	      $args = array(
			                'post_type' => 'room',
			                'posts_per_page' => '3',
			                'paged' => $paged,
			                'orderby' => rand 
			                );
							$temp = $wp_query; 
							$wp_query = null;
			                $wp_query = new WP_Query($args);
			                if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
			                $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
			            ?>
	      <!-- Room -->
	      <div class="col-sm-4">
	        <div class="room-thumb"> 
            <?php if (class_exists('Just_Field') AND get_post_meta($post->ID, 'image', true) != "")  {
              $img = get_post_meta($post->ID, 'image', true);?> 
                <img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo $img[0]['image'];?>&amp;h=228&amp;w=356&amp;zc=1" alt="<?php echo esc_attr($img[0]['title']); ?>" />
              <?php } elseif (has_post_thumbnail()) { ?>
                <?php $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), '');?>
                <img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo $thumbnail[0];?>&amp;h=228&amp;w=356&amp;zc=1" alt="room 1" class="img-responsive" />
              <?php } ?>
            <div class="mask">
	            <div class="main">
	              <h5><?php the_title();?></h5>
	              <div class="price"><?php echo get_post_meta($post->ID, 'price', true);?><span>a night</span></div>
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
<?php get_footer(); ?>