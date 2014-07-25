<?php
/*
Template Name: Homepage
*/
?>

<?php global $shortname; ?>
<?php get_header(); ?>
	<!-- Revolution Slider -->
	<section class="revolution-slider">
	  <div class="bannercontainer">
	    <div class="banner">
	      <ul>
	        <!-- Slide 1 -->
	        <?php  
		
						$args = array(
			                'post_type' => 'slideshow',
			                'posts_per_page' => '-1',
			                'paged' => $paged,
			                );
							$temp = $wp_query; 
							$wp_query = null;
			                $wp_query = new WP_Query($args);
			                if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
			                $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
			            ?>
					<li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
						<img data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat" src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo $thumbnail[0];?>&amp;h=320&amp;w=960&amp;zc=1" alt="" />
					</li>
					<?php endwhile;rewind_posts();?>
		            <?php else:?>
		            <?php endif;?><?php  wp_reset_postdata(); ?>
	      </ul>
	    </div>
	  </div>
	</section>

	<!-- Reservation form -->
	<section id="reservation-form">
	  <div class="container">
	    <div class="row">
	      <div class="col-md-12">           
	        <form class="form-inline reservation-horizontal clearfix" role="form" method="post" action="<?php bloginfo('template_url'); ?>/php/reservation.php" name="reservationform" id="reservationform">
	        <div id="message"></div><!-- Error message display -->
	          <div class="row">
	            <div class="col-sm-3">
	              <div class="form-group">                <input name="email" type="text" id="email" value="" class="form-control" placeholder="Please enter your E-mail"/>
	              </div>
	            </div>
	            <div class="col-sm-2">
	              <div class="form-group">
	                <select class="form-control" name="room" id="room">
	                  <option selected="selected" disabled="disabled">Select a room</option>
	                  <option value="Single">Single room</option>
	                  <option value="Double">Double Room</option>
	                  <option value="Deluxe">Deluxe room</option>
	                </select>
	              </div>
	            </div>
	            <div class="col-sm-2">
	              <div class="form-group">
	                <i class="fa fa-calendar infield"></i>
	                <input name="checkin" type="text" id="checkin" value="" class="form-control" placeholder="Check-in"/>
	              </div>
	            </div>
	            <div class="col-sm-2">
	              <div class="form-group">
	                <i class="fa fa-calendar infield"></i>
	                <input name="checkout" type="text" id="checkout" value="" class="form-control" placeholder="Check-out"/>
	              </div>
	            </div>
	            <div class="col-sm-1">
	              <div class="form-group">
	                <div class="guests-select">
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
	            </div>
	            <div class="col-sm-2">
	              <button type="submit" class="btn btn-primary btn-block">Book Now</button>
	            </div>
	          </div>
	        </form>
	      </div>
	    </div>
	  </div>
	</section>
	<?php if ( get_option($shortname.'_slogan') != "" ) { ?>
	<section class="slogan">
		<h2><?php echo get_option($shortname.'_slogan');?></h2>
	</section>
	 <?php } ?>
	<!-- Rooms -->
	<section class="rooms mt50">
	  <div class="container">
	    <div class="row">
	      <div class="col-sm-12">
	        <h2 class="lined-heading"><span>Guests Favorite Rooms</span></h2>
	      </div>
	      <?php
	      $args = array(
			                'post_type' => 'room',
			                'posts_per_page' => '3',
			                'paged' => $paged,
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
	              <div class="price"><?php if ( get_post_meta($post->ID, 'price', true) != "" ) { echo get_post_meta($post->ID, 'price', true); } else { ?> &euro; 99 <?php };?><span>a night</span></div>
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

	<!-- USP's -->
	<section class="usp mt100">
	  <div class="container">
	    <div class="row">
	      <div class="col-sm-12">
	        <h2 class="lined-heading"><span>hotel feature</span></h2>
	      </div>
	       <?php
	      $args = array(
			                'post_type' => 'feature',
			                'posts_per_page' => '4',
			                'paged' => $paged,
			                );
							$temp = $wp_query; 
							$wp_query = null;
			                $wp_query = new WP_Query($args);
			                if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
			                $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
			            ?>
		    <div class="col-sm-3 bounceIn appear" data-start="0">
		    <div class="box-icon">
	        <div class="circle"><i class="fa <?php if ( get_post_meta($post->ID, 'icon', true) != "" ) { echo get_post_meta($post->ID, 'icon', true); } else { ?> fa-glass <?php };?> fa-lg"></i></div>
	        <h3><?php the_title();?></h3>
	        <p><?php echo kartika_excerpt(150);?> </p>
	        <a href="<?php the_permalink();?>">Read more<i class="fa fa-angle-right"></i></a> </div>
	        </div>
	        <!-- Room -->
	      <?php endwhile;rewind_posts();?>
		  <?php else:?>
		  <?php endif;?><?php  wp_reset_postdata(); ?>
	    </div>
	  </div>
	</section>

	<!-- Gallery -->
	<section class="gallery-slider mt100">
	  <div class="container">
	    <div class="row">
	      <div class="col-md-12">
	        <h2 class="lined-heading"><span>Gallery</span></h2>
	      </div>
	    </div>
	  </div>
	  <div id="owl-gallery" class="owl-carousel">
	     <?php
	        $args = array(
	        'post_type' => 'gallery',
	        'posts_per_page' => '-5',
	        'paged' => $paged,
	        );
	        $temp = $wp_query; 
	        $wp_query = null;
	        $wp_query = new WP_Query($args);
	        if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
	        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
	      ?>
	    <div class="item"><a href="<?php echo $thumbnail[0];?>" data-rel="prettyPhoto[gallery1]"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo $thumbnail[0];?>&amp;h=504&amp;w=800&amp;zc=1" alt="Image 3"><i class="fa fa-search"></i></a></div>
	    <?php endwhile;rewind_posts();?>
      	<?php else:?>
      	<?php endif;?><?php  wp_reset_postdata(); ?>
	   </div>
	  <div class="row lined-heading">
	  	<a href="gallery" class="readmore btn-primary mt50">view all gallery</a>
	  </div>
	</section>


	  <!-- Testimonials -->
	  <section class="testimonials">
	    <div class="container">
	      <div class="col-md-12">
	        <div id="owl-reviews" class="owl-carousel">
	        <?php
	      		$args = array(
			                'post_type' => 'testimonial',
			                'posts_per_page' => '-1',
			                'paged' => $paged,
			                );
							$temp = $wp_query; 
							$wp_query = null;
			                $wp_query = new WP_Query($args);
			                if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
			                $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
			            ?>
	          <div class="item">
	            <div class="row">
	              <div class="col-lg-12 col-md-8 col-sm-10 col-xs-12">
	                <div class="text-balloon"><?php the_content();?><span><?php the_title();?></span> </div>
	              </div>
	            </div>
	          </div>
	          <?php endwhile;rewind_posts();?>
			  <?php else:?>
			  <?php endif;?><?php  wp_reset_postdata(); ?>
	        </div>
	      </div>
	    </div>
	  </section>
	

<?php get_footer(); ?>