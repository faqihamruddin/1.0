<?php
if ( function_exists('yoast_breadcrumb') ) {
	echo '<div class="breadcrumb">';
	yoast_breadcrumb();
	echo '</div>';
}

if(function_exists('bcn_display')) {
	echo '<div class="breadcrumb">';
	bcn_display();
	echo '</div>';
}
?>