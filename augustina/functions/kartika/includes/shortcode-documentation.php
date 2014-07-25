<?php require_once('../../../../../../wp-load.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>Shortcode Documentation</title>
	
	<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/functions/warriorpanel/css/shortcodes.css" />
	
	<script type="text/javascript" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/functions/warriorpanel/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/functions/warriorpanel/js/jquery.ui.core.min.js"></script>
	<script type="text/javascript" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/functions/warriorpanel/js/jquery.ui.accordion.min.js"></script>
	
	<script type="text/javascript">
		//<![CDATA[
        jQuery(document).ready(function($) {
			// Accordion
			$('.warrior-shortcode-accordion').accordion({ autoHeight: false });
        });
		//]]>
    </script>
    
    <style>
    body {
    	font: 12px/150% Arial, Tahoma, sans-serif;
    	color: #333;
    }
    h1.title {
    	font-size: 24px;
    	letter-spacing: -1px;
    	margin:  20px 0;
    }
    h3 {
    	font-size: 16px;
    	font-weight: normal;
    	margin:  0 0 10px 0;
    }
    h4 {
    	font-size: 14px;
    	margin:  20px 0 5px 0;
    }
    ul {
    	margin: 0;
    	padding: 0 18px;
    }
    ul li {
    	margin: 0 10px;
    	padding: 0;
    }
    pre {
		word-wrap: break-word;
    }
    </style>
</head>

<body>

<!-- START: CONTAINER -->
<div id="container">
	<h1 class="title">Shortcode Documentation</h1>
	
	<div class="warrior-shortcode-accordion">
		<h3 class="accordion-caption">Button Shortcode</h3>
		<div class="accordion-content">
				<h4>Available parameters:</h4>
			<ul>
				<li><code>url</code> = the link url</li>
				<li><code>target</code>	= link target (optional) <br /> Available values: _blank, _self, _top</li>
				<li><code>url</code> = the link url </li>
				<li><code>title</code> = link alt /title</li>
				<li><code>color</code> = button color <br /> Available values: black, gray, blue, red, green, purple, brown</li>
			</ul>
			
			<h4>Example</h4>
<pre>[button color="green" url="http://www.themewarrior.com" title="ThemeWarrior" target="_blank"]ThemeWarrior website[/button]</pre>
			
		</div>
		
		<h3 class="accordion-caption">Tabs Shortcode</h3>
		<div class="accordion-content">
			<h4>Available parameters:</h4>
			<ul>
				<li><code>title</code> = the tab name, only available for [tab].</li>
			</ul>
			
			<h4>Example</h4>
<pre>
[tabs]
[tab title="Tab 1"]This is the text that will shown if you click on the tab[/tab]
[tab title="Tab 2"]This is the second tab[/tab]
[/tabs]
</pre>
		</div>
		
		<h3 class="accordion-caption">Columns Shortcode</h3>
		<div class="accordion-content">
			<h4>Available parameters:</h4>
			<ul>
				<li><code>size</code> = number of column in one row. <br /> Available values = 1/2, 1/3, 1/4</li>
				<li><code>last</code> = needed to define the last column, so you only need to add it to the last column <br /> Available value: 1</li>
			</ul>
			
			<h4>Examples</h4>
            
			<strong>Two Column</strong> <br />
<pre>
[columns]
[column size="1/2"]This is the 1st column.[/column]
[column size="1/2" last="1"]This is the 2nd column.[/column]
[/columns]
</pre>
			
			<strong>Three Column</strong> <br />
<pre>
[columns]
[column size="1/3"]This is the 1st column.[/column]
[column size="1/3"]This is the 2nd column.[/column]
[column size="1/3" last="1"]This is the 3rd column.[/column]
[/columns]
</pre>
			
			<strong>Four Columns</strong> <br />
<pre>
[columns]
[column size="1/4"]This is the 1st column.[/column]
[column size="1/4"]This is the 2nd column.[/column]
[column size="1/4"]This is the 3rd column.[/column]
[column size="1/4"]This is the 4th column.[/column]
[/columns]
</pre>
		</div>
		
		<h3 class="accordion-caption">Toggle Shortcode</h3>
		<div class="accordion-content">
			<h4>Available parameters:</h4>
			<ul>
				<li><code>title</code> = the toggle name.</li>
			</ul>
			
			<h4>Example</h4>
<pre>[toggle title="Toggle Example"]This is the text that will shown if you click on the tab[/toggle]</pre>
		</div>
		
		<h3 class="accordion-caption">Accordion Shortcode</h3>
		<div class="accordion-content">
			
			<h4>Available parameters:</h4>
			<ul>
				<li><code>title</code> = the accordion name.</li>
			</ul>
			
			<h4>Example</h4>
<pre>
[accordions]
[accordion title="First Accordion"]This is the first accordion[/accordion]
[accordion title="Second Accordion"]This is the second accordion[/accordion]
[/accordions]
</pre>
		</div>
        
        <h3 class="accordion-caption">Alert Message Shortcode</h3>
		<div class="accordion-content">
			
			<h4>Available parameters:</h4>
			<ul>
				<li><code>style</code> = alert background color <br /> Available values: black, gray, blue, red, green, purple, brown</li>
			</ul>
			
			<h4>Example</h4>
<pre>
[alert style="purple"]Example alert message[/alert]
</pre>
		</div>
        
        <h3 class="accordion-caption">Dropcap Shortcode</h3>
		<div class="accordion-content">
			
			<h4>Available parameters:</h4>
			No parameters available.
			
			<h4>Example</h4>
<pre>
[dropcap]T[/dropcap]his is an example dropcap text.
</pre>
		</div>
        
	</div>
	
</div>
<!-- END: CONTAINER -->

</body>
</html>
