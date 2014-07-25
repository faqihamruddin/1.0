<?php global $shortname; ?>
<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>
	
<!-- GMap -->
<div id="map">
  <p>This will be replaced with the Google Map.</p>
</div>
<div class="container">
  <div class="row"> 
    <!-- Contact form -->
    <section id="contact-form" class="mt50">
      <div class="col-md-8">
        <h2 class="lined-heading"><span>Send a message</span></h2>
        <?php echo apply_filters('the_content', $post->post_content);?>
        <div id="message"></div>
        <!-- Error message display -->
        <form class="clearfix mt50" role="form" method="post" action="<?php bloginfo('template_directory');?>/php/contact.php" name="contactform" id="contactform">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name" accesskey="U"><span class="required">*</span> Your Name</label>
                <input name="name" type="text" id="name" class="form-control" value=""/>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="email" accesskey="E"><span class="required">*</span> E-mail</label>
                <input name="email" type="text" id="email" value="" class="form-control"/>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="subject" accesskey="S">Subject</label>
            <select name="subject" id="subject" class="form-control">
              <option value="Booking">Booking</option>
              <option value="a Room">Room</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="comments" accesskey="C"><span class="required">*</span> Your message</label>
            <textarea name="comments" rows="9" id="comments" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label><span class="required">*</span> Spam Filter: &nbsp;&nbsp;&nbsp;3 + 1 =</label>		  
            <input name="verify" type="text" id="verify" value="" class="form-control" placeholder="Please enter the outcome" />
          </div>
          <button type="submit" class="btn  btn-lg btn-primary">Send message</button>
        </form>
      </div>
    </section>
    
    <!-- Contact details -->
    <section class="contact-details mt50">
      <div class="col-md-4">
        <h2 class="lined-heading"><span>Address</span></h2>
        <?php $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
        if(has_post_thumbnail()){?>
         <a href="<?php echo $thumbnail[0];?>" data-rel="prettyPhoto"><img src="<?php bloginfo('template_directory');?>/timthumb.php?src=<?php echo $thumbnail[0];?>&amp;w=461&amp;zc=1" alt="Image 1" class="img-thumbnail img-responsive"></a>
        <?php } ?>
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
        <h2 class="lined-heading mt50"><span>Social</span></h2>
        <div class="row">
          <div class="col-xs-4">
            <div class="box-icon"> <a href="<?php echo get_option($shortname.'_facebook');?>">
              <div class="circle"><i class="fa fa-facebook fa-lg"></i></div>
              </a> </div>
          </div>
          <div class="col-xs-4">
            <div class="box-icon"> <a href="http://twitter.com/<?php echo get_option($shortname.'_twitter');?>">
              <div class="circle"><i class="fa fa-twitter fa-lg"></i></div>
              </a> </div>
          </div>
          <div class="col-xs-4">
            <div class="box-icon"> <a href="<?php echo get_option($shortname.'_linkedin');?>">
              <div class="circle"><i class="fa fa-linkedin fa-lg"></i></div>
              </a> </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

	<!-- END: MAIN CONTENT -->
<?php get_footer(); ?>