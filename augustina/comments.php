<?php // Do not delete these lines
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die (_e('Please do not load this page directly. Thanks!', 'warrior'));

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','warrior') ; ?></p>
<?php
		return;
		}
	}
?>
<section class="comments mt50">
<?php if ( have_comments() ) : ?>

    <!-- START: COMMENT LIST -->
    
	    <div class="blog-comments">
			<h2 class="lined-heading"><span><i class="fa fa-comments"></i><?php comments_number( __('No Comment', 'warrior'), __('1 Comment', 'warrior'), __('% Comments', 'warrior') ); ?></span></h2>
	        <?php wp_list_comments('callback=warrior_comment_list'); ?>
		</div>
   
    <!-- END: COMMENT LIST -->
    
<?php else : // or, if we don't have comments:
	if ( ! comments_open() ) :
?>
		<div class="comment"> <a href="#">
            </a>
            <div class="comment-text">
              <div class="text">
                <p>Comment are closed. </p>
              </div>
            </div>
		</div>
	<?php endif; // end ! comments_open() ?>
		
<?php endif; // end have_comments() ?> 

<?php if ('open' == $post->comment_status) : ?>
	<div class="mt50">
	<h3><i class="fa fa-comment"></i> Leave a comment</h3>
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p><?php echo __('You must be ','kartika');?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php echo __('logged in','kartika');?></a><?php echo __(' to post a comment','kartika');?>.</p>
	<?php else : ?>
		<form role="form" class="mt30" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
			<?php if ( $user_ID ) : ?>
			<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink());?>" title="Log out of this account">Logout &raquo;</a></p>
			<?php else : ?>
	            <div class="form-group">
	                <label for="email">Your Email address</label>
	                <input type="email" class="form-control input-comment" id="email" placeholder="Enter email" value="<?php echo esc_attr($comment_author_email); ?>" name="email">
	            </div>
	            <div class="form-group">
	                <label for="name"><span class="required">*</span> Your Name</label>
	                <input type="text" class="form-control input-comment" id="name" placeholder="Enter name" name="author" value="<?php echo esc_attr($comment_author); ?>">
	            </div>
	        <?php endif; ?>
	            <div class="form-group">
	                <label for="comment"><span class="required">*</span> Your comment</label>
	                <textarea name="comment" rows="9" id="comment" class="form-control"></textarea>
	            </div>
	    	    <button type="submit" class="btn btn-default btn-lg">Post comment</button>
	    	    <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
	    	    <?php do_action('comment_form', $post->ID); ?>
        </form>
    </div>
<?php endif; // If registration required and not logged in ?>
 
<?php endif; // if you delete this the sky will fall on your head ?>

 </section>