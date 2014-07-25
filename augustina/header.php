<?php global $shortname; ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php if (is_home () ) { bloginfo('name'); echo " - "; bloginfo('description'); 
} elseif (is_category() ) {single_cat_title(); echo " - "; bloginfo('name');
} elseif (is_single() || is_page() ) {single_post_title(); echo " - "; bloginfo('name');
} elseif (is_search() ) {bloginfo('name'); echo " search results: "; echo wp_specialchars($s);
} else { wp_title('',true); }?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" href="favicon.ico">

<!-- Stylesheets -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/animate.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/owl.carousel.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/owl.theme.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/prettyPhoto.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/smoothness/jquery-ui-1.10.4.custom.min.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/rs-plugin/css/settings.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/theme.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/responsive.css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600,700">
<?php wp_head();?>
<!-- Javascripts --> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.11.0.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/bootstrap-hover-dropdown.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/owl.carousel.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.nicescroll.js"></script>  
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.prettyPhoto.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-ui-1.10.4.custom.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.jigowatt.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.sticky.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/waypoints.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.isotope.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.gmap.min.js"></script> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/rs-plugin/js/jquery.themepunch.plugins.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/rs-plugin/js/jquery.themepunch.revolution.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/custom.js"></script> 

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Top header -->
<div id="top-header">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="th-text pull-right">
          <div class="th-item"> 
            <?php if ( get_option($shortname.'_phone') != "" ) { ?>
              <a href="callto:<?php echo get_option($shortname.'_phone');?>"><i class="fa fa-phone"></i> <?php echo get_option($shortname.'_phone');?> </a>
            <?php } else {?>
              <a href="#"><i class="fa fa-phone"></i> 087738032823 </a>
            <?php } ?>
          </div>
          <div class="th-item"> 
            <?php if ( get_option($shortname.'_email') != "" ) { ?>
              <a href="mailto:<?php echo get_option($shortname.'_email');?>"><i class="fa fa-envelope"></i> <?php echo get_option($shortname.'_email');?> </a>
            <?php } else {?>
              <a href="#"><i class="fa fa-envelope"></i> info@augustinahome.com </a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Header -->
<header>
  <!-- Navigation -->
  <div class="navbar yamm navbar-default" id="sticky">
    <div class="container">
      <div class="navbar-header">
        <button type="button" data-toggle="collapse" data-target="#navbar-collapse-grid" class="navbar-toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a href="<?php bloginfo('url'); ?>" class="navbar-brand">         
        <!-- Logo -->
        <div id="logo"> 
        <?php if ( get_option($shortname.'_logo') != "" ) { ?>
          <img id="default-logo" src="<?php echo get_option($shortname.'_logo');?>" alt="Augustina" style="height:44px;">
        <?php } else {?>
          <img id="default-logo" src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="Augustina" style="height:44px;">
        <?php } ?>
        </div>
        </a> </div>
      <div id="navbar-collapse-grid" class="navbar-collapse collapse">
        <?php wp_nav_menu( array( 'menu_class' => 'nav navbar-nav', 'theme_location' => 'main-menu', 'depth' =>4,'container' => 'ul' ) );?>
      </div>
    </div>
  </div>
</header>