<?php
/**
 * kartika Tabs Shortcode
 *
 * @usage <code>[tab title="title"]Text[/tab]</code>
 * @example <code>[tab]Text[/tab]</code> is the default usage - without tab title
 */
function kartika_tab_group( $atts, $content ){

	$GLOBALS['tab_count'] = 1;
	do_shortcode( $content );

	if( is_array( $GLOBALS['tabs'] ) ){
	
		foreach( $GLOBALS['tabs'] as $tab ){
			$tabs[] = '<li><a class="" href="#'.str_replace(' ','',strtolower($tab['title'])).'">'.$tab['title'].'</a></li>';
			$contents[] = '<div class="tab-content" id="'.str_replace(' ','',strtolower($tab['title'])).'">'.$tab['content'].'</div>';
		}
		
		$output = '<div class="kartika-shortcode-tabs tab-shortcode">';
		$output .= '<ul class="tab-items clearfix">'.implode( "\n", $tabs ).'</ul>';
		$output .= implode( "\n", $contents );
		$output .= '</div>';
	}
	
	unset( $GLOBALS['tabs'], $GLOBALS['tab_count'] );
	
	return $output;
}
add_shortcode( 'tabs', 'kartika_tab_group' );


/**
 * kartika Tab Shortcode
 *
 * Function to support kartika_tab_group()
 */
function kartika_tab_single( $atts, $content ){

	extract(shortcode_atts(array(
		'title' => 'Tab %s'
	), $atts));

	$i = $GLOBALS['tab_count'];
		$GLOBALS['tabs'][$i] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' => do_shortcode( $content ) );
	$GLOBALS['tab_count']++;
}
add_shortcode( 'tab', 'kartika_tab_single' );


/**
 * kartika Accordion Shortcode
 *
 * @usage <code>[tab title="title"]Text[/tab]</code>
 * @example <code>[tab]Text[/tab]</code> is the default usage - without tab title
 */
function kartika_accordion_group( $atts, $content ){

	$GLOBALS['accordion_count'] = 1;
	do_shortcode( $content );

	if( is_array( $GLOBALS['accordions'] ) ){
	
		$output = '<div class="kartika-shortcode-accordion">';
	
		foreach( $GLOBALS['accordions'] as $accordion ){
			$output .= '<h3 class="accordion-caption">'.$accordion['title'].'</h3>'
						.'<div class="accordion-content">'.$accordion['content'].'</div>';
		}
		
		$output .= '</div>';

	}
	
	return $output;
}
add_shortcode( 'accordions', 'kartika_accordion_group' );


/**
 * kartika Accordion Content
 *
 * Function to support kartika_accordion_group()
 */
function kartika_accordion_single( $atts, $content ){

	extract(shortcode_atts(array(
		'title' => 'Section %s'
	), $atts));

	$i = $GLOBALS['accordion_count'];
		$GLOBALS['accordions'][$i] = array( 'title' => sprintf( $title, $GLOBALS['accordion_count'] ), 'content' => do_shortcode( $content ) );
	$GLOBALS['accordion_count']++;
}
add_shortcode( 'accordion', 'kartika_accordion_single' );


/**
 * kartika Toggle
 *
 * Function to display toggle content
 */
function get_kartika_toggle( $text, $title ) {

	if ( !empty( $title ) ) {
		$title = $title;
	} else {
		$title = 'Toggle Title';
	}
	
	$toggle = '<div class="kartika-shortcode-toggle">';
	$toggle .= '<h3 class="toggle-caption">' .$title. '</h3>';
	$toggle .= '<div class="toggle-content">'. $text .'</div>';
	$toggle .= '</div>';
	
	return $toggle;
}



/**
 * kartika Toggle Shortcode
 *
 * @usage <code>[toggle title="Caption"]Text[/toggle]</code> 
 * @example <code>[toggle]Text[/toggle]</code> is the default usage 
 */
function kartika_toggle_shortcode( $atts, $content = null ) { 

	extract( shortcode_atts( array ( 
    	'title' => '' 
	), $atts ) );
	
	return get_kartika_toggle( do_shortcode( $content ), $title ); 
}
add_shortcode('toggle', 'kartika_toggle_shortcode');


/**
 * kartika Button
 *
 * Function to botton style
 */
function get_kartika_button( $text, $url, $target, $title, $class = '', $id = '' ) {

	if ( !empty( $text ) ) {
		$text = esc_attr( $text );
	} else {
		$text = $type;
	}

	if ( !empty( $id ) ) {
		$id = 'id="' . esc_attr( $id ) .'"';
	} else {
		$id = '';
	}

	$classes = 'kartika-shortcode-button';
	$classes_add = explode(',', $class);
	foreach ( $classes_add as $class_add => $value ) {
		if ( !empty( $value ) ) {
			$classes .= ' ' . esc_attr( $value );
		} else {
			$classes .= '';
		}
	} 

	if ( !empty( $id ) ) {
		$id = 'id="' . esc_attr( $id ) . '" ';
	} else {
		$id = '';
	}

	if ( !empty( $target ) ) {
		$target = 'target="' . esc_attr( $target ) . '" ';
	} else {
		$target = '';
	}

	if ( !empty( $url ) ) {
		$url = esc_attr( $url );
	} else {
		$url = '#';
	}

	if ( !empty( $title ) ) {
		$title = 'title="' . $title . '" ';
	} else {
		$title = '';
	}

	$button = '<a href="' . $url . '" class="' . $classes . '" ' . $target . $title . $id . '/>' . $text . '</a>';

	return $button;
}


/**
 * kartika Button Shortcode
 *
 * @usage <code>[button href="url target" title="Title Text" target="window to open url" style="color" size="size"]Text[/button]</code>
 * @example <code>[button]Text[/button]</code> is the default usage - without url target & gray style
 */
function kartika_button_shortcode( $atts, $content = null ) {

	extract( shortcode_atts( array (
		'href' => '#',
		'title' => '',
		'target' => '',
		'style' => 'gray',
		'size' => ''
	), $atts ) );
	
	if (!empty($size)) {
		$classes = $style.' '.$size;
	} else {
		$classes = $style;
	}
	
	return get_kartika_button( $content, $href, $target, $title, $classes, '' );
}
add_shortcode('button', 'kartika_button_shortcode');


/**
 * kartika Alert
 *
 * Function to display alert message
 */
function get_kartika_alert( $text, $style = '' ) {

	if ( !empty( $style ) ) {
		$class = ' ' . esc_attr( $style );
	} else {
		$class = '';
	}
	
	$alert = '<div class="kartika-shortcode-alert'. $class .'">';
	$alert .= '<p>'. $text .'</p>';
	$alert .= '</div>';
	
	return $alert;
}


/**
 * kartika Alert Shortcode
 *
 * @usage <code>[alert style="color"]Text[/alert]</code>
 * @example <code>[alert]Text[/alert]</code> is the default usage - gray style
 */
function kartika_alert_shortcode( $atts, $content = null ) {

	extract( shortcode_atts( array (
		'style' => 'gray'
	), $atts ) );
	
	return get_kartika_alert( $content, $style );
}
add_shortcode('alert', 'kartika_alert_shortcode');


/**
 * kartika Dropcap
 *
 * Function to display dropcap
 */
function get_kartika_dropcap( $text, $style = '' ) {

	if ( !empty( $style ) ) {
		$class = ' ' . esc_attr( $style );
	} else {
		$class = '';
	}
	
	$alert = '<span class="kartika-shortcode-dropcap'. $class .'">';
	$alert .= $text;
	$alert .= '</span>';
	
	return $alert;
}


/**
 * kartika Dropcap Shortcode
 *
 * @usage <code>[dropcap style="color"]Text[/dropcap]</code>
 * @example <code>[dropcap]Text[/dropcap]</code> is the default usage
 */
function kartika_dropcap_shortcode( $atts, $content = null ) {

	extract( shortcode_atts( array (
		'style' => 'gray'
	), $atts ) );
	
	return get_kartika_dropcap( $content, $style );
}
add_shortcode('dropcap', 'kartika_dropcap_shortcode');


/**
 * kartika One Half Columns Shortcode
 *
 * @usage <code>[column size="" last=""]Text[/column]</code>
 * @example <code>[column size="1/2"]Text[/column]</code> is the default usage
 * @available size is "1/2", "1/3", "1/4"
 */
function kartika_columns( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'size' => '1/2',
		'last' => ''
	), $atts ) );
	
	$class = '';
	if ( $size == '1/2' ) $class .= 'kartika-shortcode-one-half';
	if ( $size == '1/3' ) $class .= 'kartika-shortcode-one-third';
	if ( $size == '1/4' ) $class .= 'kartika-shortcode-one-fourth';
	if ( $last == '1' ) $class .= ' kartika-shortcode-last';
	
	$output = '<div class="'. $class .'">' . do_shortcode( $content ) . '</div>';
		
	return $output;
}
add_shortcode('column', 'kartika_columns');



function parse_shortcode_content( $content ) {

   /* Parse nested shortcodes and add formatting. */
    $content = trim( do_shortcode( shortcode_unautop( $content ) ) );

    /* Remove '' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '' )
        $content = substr( $content, 4 );

    /* Remove '' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of ''. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    $content = str_replace( array( '<p>  </p>' ), '', $content );

    return $content;
}

//move wpautop filter to AFTER shortcode is processed
add_filter( 'the_content', 'parse_shortcode_content', 7 );


/**
 * kartika Shortcode Script
 *
 * Function to load shortcode style & script
 */
function kartika_shortcode_scripts() {
	// Only load these scripts on frontend
	if( !is_admin() ) {
		wp_register_style('shortcodes', get_template_directory_uri().'/functions/kartika/css/shortcodes.css', array(), false, 'all');
		wp_register_style('ui-tabs', get_template_directory_uri().'/functions/kartika/css/jquery.ui.tabs.css', array(), false, 'all');
		wp_enqueue_style('shortcodes');
		wp_enqueue_style('ui-tabs');
		
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-tabs' );
	}
}
add_action( 'init', 'kartika_shortcode_scripts', 11, 1 );


function kartika_shortcode_js_css() {
	if ( is_singular() ) :
?>
    <script type="text/javascript">
		//<![CDATA[
        jQuery(document).ready(function($) {
		
			// Tabs
			$(".kartika-shortcode-tabs.tab-shortcode").each( function() {
				$(this).tabs({ fx: { opacity: 'toggle', duration: 'fast' } });
				$(this).find('ul.tab-items li:first-child').addClass('first');
			});
			
			// Toggle
			$(".toggle-content").hide(); 
			$(".toggle-caption").click(function(e) { 
		        e.preventDefault(); 
		        $(this).toggleClass("hide"); 
				$(this).parent().find(".toggle-content").slideToggle(300); 
			});
			
			// Accordion
			$('.kartika-shortcode-accordion').accordion({
				autoHeight: false
			});
        });
		//]]>
    </script>
<?php
	endif;
}
add_action( 'wp_head', 'kartika_shortcode_js_css' );

function kartika_add_tinymce_button() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
	return;

	if ( get_user_option('rich_editing') == 'true') {
		add_filter('mce_external_plugins', 'kartika_add_tinymce_plugin');
		add_filter('mce_buttons', 'kartika_register_tinymce_button');
	}
}

function kartika_register_tinymce_button($buttons) {
	array_push($buttons, "|", "shortcode");
	return $buttons;
}

function kartika_add_tinymce_plugin($plugin_array) {
	$plugin_array['shortcode'] = get_template_directory_uri().'/functions/kartika/js/tinymce-buttons.js';
	return $plugin_array;
}

add_action('init', 'kartika_add_tinymce_button');
?>