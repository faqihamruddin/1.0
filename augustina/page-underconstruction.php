<?php
/*
Template Name: Underconstruction
*/
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Augustina Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" href="favicon.ico">		
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/normalize.css">		
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/construct.css">	
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/font-awesome.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/jquery.maximage.min.css">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.countdown.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.maximage.min.js"></script>
<script type="text/javascript" charset="utf-8">
		$(function(){
			// Trigger maximage
			jQuery('#maximage').maximage();
		});
</script>
</head>
	
<body>
	<div id="maximage">
			<img src="<?php bloginfo('template_url'); ?>/images/1.jpg" alt="" width="1400" height="1050" />
			<img src="<?php bloginfo('template_url'); ?>/images/2.jpg" alt="" width="1400" height="1050" />
			<img src="<?php bloginfo('template_url'); ?>/images/3.jpg" alt="" width="1400" height="1050" />
			<img src="<?php bloginfo('template_url'); ?>/images/4.jpg" alt="" width="1400" height="1050" />
			<img src="<?php bloginfo('template_url'); ?>/images/5.jpg" alt="" width="1400" height="1050" />		
	</div>
	<div class="pattern"></div>
	<div id="wrapper">
		<div id="logo"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="logo" /></div>
		<div id="entry-text">Coming soon in <span>July 7th,</span> 2014</div>
		<div id="countdown"></div>
	</div>
	<script type="text/javascript">
    
    $(function() {
      $('#countdown').countdown({
		date: "July 7, 2087 15:03:26",
        render: function(data) {
          var el = $(this.el);
          el.empty()
            .append("<div class='time'><div class='item'>" + this.leadingZeros(data.days, 2) + "</div><span>days</span></div>")
            .append("<div class='time'><div class='item'>" + this.leadingZeros(data.hours, 2) + "</div><span>hrs</span></div>")
            .append("<div class='time'><div class='item'>" + this.leadingZeros(data.min, 2) + "</div><span>min</span></div>")
            .append("<div class='time'><div class='item'>" + this.leadingZeros(data.sec, 2) + "</div><span>sec</span></div>");
        }
      });
    	$('a[href*=#]:not([href=#])').click(function() {
		    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		      var target = $(this.hash);
		      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		      if (target.length) {
		        $('html,body').animate({
		          scrollTop: target.offset().top
		        }, 1000);
		        return false;
		      }
		    }
		  });
    });
    </script>
</body>
</html>