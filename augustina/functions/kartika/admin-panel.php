<?php
/**
 * All function in this file used for kartika ( kartikaTheme's theme options )
 * the files are attached to the action and filter hooks
 * to change the core funtionality
 */
 
// kartika current version.
$kartika_panel_version = '1.2.0';

/**
 * function panel_add_admin()
 * 
 * This function is used to initialize the kartika
 * handle the submitted theme options when the system don't use ajax ( javascript disabled )
 *
 * Add new menu and submenu
 *
 * Add the style and script loader function as an action to the 
 * admin_print_styles/admin_print_scripts hook 
 * 
 */
 
function panel_add_admin() {    
 
    global $themename, $shortname, $version, $kartika_panel_version, $theme_options, $options, $seo_options, $pagenow, $update_sts;
 	
  
 	/** Setup all the theme options if the theme activated for the first time */
	if( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
		$ever_installed = get_option($shortname . '_kartika_ever_installed');
		if ( $ever_installed !== 'Yes' ) {
			panel_restore($options);
			panel_restore($theme_options);
			panel_restore($seo_options);
			update_option($shortname . '_kartika_ever_installed', 'Yes');
		}
	}

    if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'kartika' ) {
		if ( isset($_REQUEST['save_options']) && $_REQUEST['save_options'] == 'Save Changes' ) {
			$msg = panel_save($theme_options, $_POST);
		}
		else if ( isset($_REQUEST['reset_options']) && $_REQUEST['reset_options'] == 'Restore' ) {
			$msg = panel_restore($theme_options, $_POST);
		}
    }

    if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'kartika_framework' ) {
		if ( isset($_REQUEST['save_options']) && $_REQUEST['save_options'] == 'Save Changes' ) {
			$msg = panel_save($options, $_POST);
		}
		else if ( isset($_REQUEST['reset_options']) && $_REQUEST['reset_options'] == 'Restore' ) {
			$msg = panel_restore($options, $_POST);
		}
    }

    if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'kartika_seo' ) {
		if ( isset($_REQUEST['save_options']) && $_REQUEST['save_options'] == 'Save Changes' ) {
			$msg = panel_save($seo_options, $_POST);
		}
		else if ( isset($_REQUEST['reset_options']) && $_REQUEST['reset_options'] == 'Restore' ) {
			$msg = panel_restore($seo_options, $_POST);
		}
    }
	
	// Create new WaarriorPanel menu on the dashboard 
	$icon = get_template_directory_uri(). '/functions/kartika/images/kartika-icon.png';
	if ( count($theme_options) > 0 ) {
		add_menu_page ('kartika Panel', $themename, 'manage_options','kartika', 'kartika_panel_page_main_theme', $icon, 40); 
		// Create new submenu for the Theme Options Page
		$wpanel_theme_option = add_submenu_page('kartika', $themename, 'Theme Options', 'manage_options', 'kartika','kartika_panel_page_main_theme');
		// Framework
		$wpanel = add_submenu_page('kartika', $themename, 'Framework', 'manage_options', 'kartika_framework','kartika_panel_page_main'); // Framework
		
		add_action("admin_print_scripts-$wpanel_theme_option", 'panel_scripts');
		add_action("admin_print_styles-$wpanel_theme_option",'panel_styles');
	} else {
		add_menu_page ('kartika Panel', $themename, 'manage_options','kartika', 'kartika_panel_page_main', $icon, 40); 
		$wpanel = add_submenu_page('kartika', $themename, 'Framework', 'manage_options', 'kartika','kartika_panel_page_main'); // Framework
	}
	// Create new submenu for the Framework Page
	// Create new submenu for the SEO Theme Options Page
	$wpanel_seo = add_submenu_page('kartika', $themename, 'SEO', 'manage_options', 'kartika_seo','kartika_panel_page_seo'); // SEO
	// Create new submenu for the kartika update Page
	$wpanel_update = add_submenu_page('kartika', $themename, 'Update Framework', 'manage_options', 'kartika_update','kartika_panel_page_update');

	// Attached the styles and scripts that needed
	add_action("admin_print_scripts-$wpanel", 'panel_scripts');
	add_action("admin_print_styles-$wpanel",'panel_styles');
	add_action("admin_print_scripts-$wpanel_seo", 'panel_scripts');
	add_action("admin_print_styles-$wpanel_seo",'panel_styles');
	add_action("admin_print_styles-$wpanel_theme",'panel_styles');
	add_action("admin_print_styles-$wpanel_update",'panel_styles');
} 
// Attach panel_add_admin function to admin menu hook Execute the menu addition
add_action('admin_menu', 'panel_add_admin');


/**
 * Function panel_styles()
 *
 * Enqueue needed styles
*/

function panel_styles() {
	$path = get_template_directory_uri();
	
	// Thickbox css needed for stylize file upload 
	wp_enqueue_style('thickbox');
	// Style css needed to stylize the kartika
	wp_enqueue_style('panel-style', $path.'/functions/kartika/css/style.css');
	// Style css needed to stylize the colorpicker
	wp_enqueue_style('color-picker', $path.'/functions/kartika/css/colorpicker.css');
}


/**
 * Function panel_scripts()
 *
 * Enqueue needed styles
*/

function panel_scripts() {
	$path = get_template_directory_uri();
	
	// Load the scripts needed
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('color-picker', $path.'/functions/kartika/js/colorpicker.js', array('jquery'));
	wp_enqueue_script('eye', $path.'/functions/kartika/js/eye.js', array('jquery'));
	add_action('admin_head','head_script');
}

/**
 * Function panel_scripts()
 *
 * Custom scripts for kartika functionality such as
 * Menu tabs, switch control, media uploader, ajax save function
*/

function head_script() {
?>
<script type="text/javascript">
//<![CDATA[

	// Global var
	
	var currentupload = '';
	var button_action = '';
	var message_id = '';
	jQuery(document).ready(function() {
		// Menu Tab
		jQuery("#rightcol .tab-content").hide();
		jQuery("#menu ul.main-menu li:first").addClass("active").show();
		jQuery("#rightcol .tab-content:first").show();

		jQuery("#menu ul.main-menu li").click(function() {
			jQuery("#menu ul.main-menu li").removeClass("active");
			jQuery(this).addClass("active");
			jQuery("#rightcol .tab-content").hide();

			var activeTab = jQuery(this).find("a").attr("href");
			jQuery(activeTab).fadeIn();
			return false;
		});
	
		// iPhone style switch
		jQuery(".switch-enable").click(function() {
			var parent = jQuery(this).parents('.switch');
			jQuery('.switch-disable',parent).removeClass('selected');
			jQuery(this).addClass('selected');
			jQuery('.checkbox',parent).attr('checked', true);
		});
		jQuery(".switch-disable").click(function() {
			var parent = jQuery(this).parents('.switch');
			jQuery('.switch-enable',parent).removeClass('selected');
			jQuery(this).addClass('selected');
			jQuery('.checkbox',parent).attr('checked', false);
		});

		// Message Box
		jQuery(".message span a").live( 'click',function () {
			jQuery("#TB_message").fadeOut("slow");
			//serializedData = jQuery('#panel_form').serialize();
			//alert(serializedData);
			return false;
		});
		
		jQuery('body').append('<div id="TB_message" class="TB_overlayBG" style="display:none"><div id="message_top" class="message success" title="Message"></div></div>');
		
		jQuery('#TB_message').live('click', function() {
			jQuery(this).fadeOut();
		});
		//EYE.register(initLayout, 'init');
		
		// Open Media Uploader
		jQuery('.file .file-button').click( function() {
			var parent = jQuery(this).parents('.file');
			currentupload = jQuery('.file-url',parent).attr('id');
			tb_show('', '<?php echo admin_url('media-upload.php?type=image&TB_iframe=true'); ?>');
			return false;
		});
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#'+currentupload).val(imgurl);
			jQuery('#'+currentupload).change();
			currentupload = '';
			tb_remove();
		}
		jQuery('.file .file-url').change( function() {
			var parent = jQuery(this).parents('.file');
			jQuery('div.image img', parent).attr('src', jQuery(this).val());
			jQuery('div.image img', parent).fadeIn();
			if ( jQuery('.file-url',parent).val() == '' ) {
				jQuery('.remove',parent).fadeOut();
			} else {
				jQuery('div.image', parent).fadeIn();
				jQuery('.remove',parent).fadeIn();
				jQuery('.remove a',parent).fadeIn();
			}
		});
		jQuery('.file .remove a').click( function() {
			var parent = jQuery(this).parents('.file');
			jQuery('div.image', parent).fadeOut();
			jQuery('.remove', parent).fadeOut();
			jQuery('.file-url',parent).val('');
			jQuery('.file-url',parent).change();
			return false;
		});
		
		
		// Ajax Panel Save
		jQuery('.submit .save').click( function() {
			button_action = 'save';
			if ( jQuery(this).attr('id') == 'save-button-top' ) {
				message_id = 'message_top';
			} else {
				message_id = 'message_bottom';
			}
		});
		jQuery('.submit .restore').click( function() {
			button_action = 'restore';
			if ( jQuery(this).attr('id') == 'restore-button-top' ) {
				message_id = 'message_top';
			} else {
				message_id = 'message_bottom';
			}
		});
		jQuery('#framework_panel_form, #seo_panel_form, #themeopt_panel_form').submit(function() {
			if ( button_action == 'restore' ) {
				confirm_restore = confirm('<?php _e('Are you sure? All the settings will restored to default value.', 'kartika'); ?>');
				if ( !confirm_restore ) {
					return false;
				}
			}
			var serializedData = jQuery(this).serialize();
			var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
			if ( jQuery(this).attr('id') == 'framework_panel_form' ) { ajax_action = 'framework-ajax-' + button_action + '-options'; }
			else if ( jQuery(this).attr('id') == 'themeopt_panel_form' ) { ajax_action = 'opt-ajax-' + button_action + '-options';} 
			else if ( jQuery(this).attr('id') == 'seo_panel_form' ) { ajax_action = 'seo-ajax-' + button_action + '-options';} 
			var data = {
				action : ajax_action,
				data : serializedData
			}
			
			jQuery('.message').html('<?php _e('Saving the options...', 'kartika');?>');
			if ( button_action == 'restore' ) jQuery('.message').html('<?php _e('Restoring the options...', 'kartika'); ?>');
			jQuery('.message' ).fadeIn();
			jQuery('.message').removeClass('success');
			jQuery('.message').addClass('ajax-progress');
			jQuery("#TB_message").fadeIn("fast");
			
			jQuery.post(ajax_url, data, function(response) {
				rsp = response.split('|');
				error = rsp[rsp.length - 1];
				closebtn = '<span class="close"><a href="#" title="<?php _e('Close', 'kartika'); ?>"><?php _e('Close', 'kartika'); ?></a></span>';
				jQuery('.message').html( rsp[0] + closebtn );
				jQuery('.message').removeClass('ajax-progress');
				if ( error == 0 ) {
					jQuery('.message').addClass('success');
				} else {
					jQuery('.message').addClass('error');
				}
			});
			
			return false;
		});


		// Save & Reset button
		jQuery('input#save-button-top, input#restore-button-top').wrapAll('<div id="save-restore-button" class="default"/>');
		var menu = jQuery('#save-restore-button'),
			pos = menu.offset();
		
		jQuery(window).scroll(function(){
			if(jQuery(this).scrollTop() > pos.top+menu.height() && menu.hasClass('default')){
				menu.fadeOut('fast', function(){
					jQuery(this).removeClass('default').addClass('fixed').fadeIn('fast');
				});
			} else if(jQuery(this).scrollTop() <= pos.top && menu.hasClass('fixed')){
				menu.fadeOut('fast', function(){
					jQuery(this).removeClass('fixed').addClass('default').fadeIn('fast');
				});
			}
		});
		
	});

//]]>
</script>
<?php
}

/**
 * Function kartika_panel_page_main()
 *
 * Generate the general options page
*/

function kartika_panel_page_main_theme() {
	global $theme_options;
	kartika_panel_page($theme_options, 'themeopt_panel_form');
}


/**
 * Function kartika_panel_page_main()
 *
 * Generate the general options page
*/

function kartika_panel_page_main() {
	global $options;
	kartika_panel_page($options, 'framework_panel_form');
}


/**
 * Function kartika_panel_page_seo()
 *
 * 
 Generate the seo options page
*/
function kartika_panel_page_seo() {
	global $seo_options;
	kartika_panel_page($seo_options, 'seo_panel_form');
}


/**
 * Function kartika_panel_page()
 *
 * Function to create the main interface markup of the kartika
 * such as the menu tabs and the tabs itself
 *
 * the colorpicker script
 *
*/

function kartika_panel_page($options, $form_name) {
	global $themename, $shortname, $version, $kartika_panel_version;
	$panel = kartika_panel_interface($options);
?>

<!-- START: MAIN CONTAINER -->
<div id="kartika">
	<div id="header">
        <div class="inner">
            <div class="logo"><img src="<?php echo get_template_directory_uri(); ?>/functions/kartika/images/themekartika-logo.png" alt="Themekartika" title="Themekartika" /></div>
                
                
    	    <div class="version">Kartika v<?php echo $kartika_panel_version; ?></div>
        </div>
    </div>
    <!-- START: LEFT COLUMN -->
    <div id="leftcol">
        <div id="menu">
            <ul class="main-menu">

				<?php echo $panel[0]; ?>
            </ul>
        </div>
    </div>
    <!-- END: LEFT COLUMN -->
    <!-- START: RIGHT COLUMN -->
    <div id="rightcol">
        
        <div class="options">
        	<div class="inner">
                
                <form action="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>" method="post" name="<?php echo $form_name; ?>" id="<?php echo $form_name; ?>">
                    <fieldset>
                        <div class="input submit">
                            <input class="save button button-primary" type="submit" name="save_options" id="save-button-top" value="<?php _e('Save Changes', 'kartika'); ?>" />
                            <input class="restore button" type="submit" name="reset_options"  id="restore-button-top" value="<?php _e('Restore', 'kartika'); ?>" />
                        </div>
						<?php echo $panel[1]; ?>
                         <div class="input submit">
                            <input class="save button button-primary" type="submit" name="save_options"  id="save-button-bottom" value="<?php _e('Save Changes', 'kartika'); ?>" />
                            <input class="restore button" type="submit" name="reset_options"  id="restore-button-bottom" value="<?php _e('Restore', 'kartika'); ?>" />
                        </div>
               	</fieldset>
                </form>
            </div>
        </div>
    </div>
    <!-- END: RIGHT COLUMN -->
</div>
<!-- END: MAIN CONTAINER -->
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('<?php echo $panel[2]; ?>').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val('#' + hex);
			$(el).prev('.color-popup').children('div').css('backgroundColor', '#' + hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow: function() {
			$(this).ColorPickerSetColor(this.value);
		}
	})
	.bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	});
});
</script>

<?php
}


/**
 * function kartika_panel_interface()
 * 
 * The function to generate interface for every element of the options control
 * $options parameter is the array of controls
 * the controls have attribute ( as array key ) : 'type', 'std', 'id', 'name', 'class'
 *
 */
 
function kartika_panel_interface($options) {
	$print = '';
	$nav = '';
	$colorlist = '';
	foreach ( $options as $value ) {
		if ( $value['type'] != 'heading' && $value['type'] != 'open-tab' && $value['type'] != 'close-tab' && $value['type'] != 'info' ) {
			$val = get_option($value['id'] );
			$std = $value['std'];
			if ( !isset($val) ) $val = $std ; 
		}
		switch ( $value['type'] ) {
			// if the type of element is open-tab, then create a new tab
			case 'open-tab' :
				// create a new menu list
				$nav .= '	<li><a class="'. $value['class'] .'" href="#' . $value['id'] . '">' . $value['name'] . '</a></li>' . "\n";
				
				// create a div tag for new tab
				$print .= '<div id="'.$value['id'].'" class="tab-content">';
			break;
			
			// close the div tag of the new tab
			case 'close-tab' :
				$print .= '</div>';
			break;

			// create input text
			case 'text' :
				$print .= '<div class="input '. $value['type'] .'">'."\n";
				$print .= '	<label class="inputlabel">'. $value['name'] .'</label>'."\n";
				$print .= '	<div class="field">'."\n";
				$print .= '		<input  type="text" id="'. $value['id'] . '" name="'. $value['id'].'" value="'. stripslashes($val) .'" />'."\n";
			break;

			// create textarea, to input more/multiline text
			case 'textarea' :
				$print .= '<div class="input '. $value['type'] .'">'."\n";
				$print .= '	<label class="inputlabel">'. $value['name'] .'</label>'."\n";
				$print .= '	<div class="field">'."\n";
				$print .= '		<textarea rows="10" id="'. $value['id'] . '" name="'. $value['id'].'" />'. stripslashes($val) ."</textarea>\n";
			break;
			
			// create regular checkbox		
			case 'checkbox' :
				$checked = '';
				if ( $val == 'true' ) {
					$checked = 'checked="checked"';
				}
				$print .= '<div class="input '. $value['type'] .'">'."\n";
				$print .= '	<label class="inputlabel">'. $value['name'] .'</label>'."\n";
				$print .= '	<div class="field">'."\n";
				$print .= '		<input type="checkbox" id="'. $value['id'] . '" name="'. $value['id'].'" '.$checked.' value="true" />' . "\n";
			break;

			// create an iphone style switch, based on checkbox
			case 'switch' :
				$checked = '';
				if ( $val == 'Yes' ) {
					$checked = 'checked="checked"';
					$on = ' selected';
					$off = '';
				} else {
					$off = ' selected';
					$on = '';
				}
				$print .= '<div class="input '. $value['type'] .'">'."\n";
				$print .= '	<label class="inputlabel">'. $value['name'] .'</label>'."\n";
				$print .= '	<div class="field">'."\n";
				$print .= '		<label class="switch-enable'.$on.'"><span>On</span></label>'."\n";
				$print .= '		<label class="switch-disable'.$off.'"><span>Off</span></label>'."\n";
				$print .= '		<input type="checkbox" id="'. $value['id'] . '" name="'. $value['id'].'" '.$checked.'" class="checkbox" value="Yes" />' . "\n";
			break;

			// create a dropdown select, the options base on array
			// using array key as value and array value as a name
			case 'select' :
				$selected = '';
				$print .= '<div class="input '. $value['type'] .'">'."\n";
				$print .= '	<label class="inputlabel">'. $value['name'] .'</label>'."\n";
				$print .= '	<div class="field">'."\n";
				$print .= '		<select id="'. $value['id'] . '" name="'. $value['id'].'" value="'. $val .'" >' . "\n";
				foreach ($value['options'] as $option => $name) {
					if ( $val == $option ) $selected = ' selected="selected"';
					else $selected = '';
					$print .= '			<option'. $selected .' value="'.$option.'">';
					$print .= $name;
					$print .= '</option>'."\n";
				}

				$print .= '		</select>'."\n";
			break;
			
			// create a dropdown select, the options base on array, 
			// using array value both for option value and name
			case 'select2' :
				$selected = '';
				$print .= '<div class="input '. $value['type'] .'">'."\n";
				$print .= '	<label class="inputlabel">'. $value['name'] .'</label>'."\n";
				$print .= '	<div class="field">'."\n";
				$print .= '		<select id="'. $value['id'] . '" name="'. $value['id'].'" value="'. $val .'" >' . "\n";
				foreach ($value['options'] as  $name) {
					if ( $val == $name ) $selected = ' selected="selected"';
					else $selected = '';
					$print .= '			<option'. $selected .' value="'. $name .'">';
					$print .= $name;
					$print .= '</option>'."\n";
				}

				$print .= '		</select>'."\n";
			break;
			
			// create a multiple select, the options based on array
			// using array key as value and array value as a name
			case 'multiple' :
				$selected = '';
				$print .= '<div class="input '. $value['type'] .'">'."\n";
				$print .= '	<label class="inputlabel">'. $value['name'] .'</label>'."\n";
				$print .= '	<div class="field">'."\n";
				$print .= '		<select multiple="multiple" id="'. $value['id'] . '" name="'. $value['id'].'[]" value="'. $val .'" size="10" >' . "\n";
				$keys = array_keys($value['options']);
				foreach ($keys as $key ) {
					$arr_val = explode(',',$val);
					if ( array_search($key, $arr_val) !== false ) $selected = ' selected="selected"';
					else $selected = '';
					
					$print .= '			<option'. $selected .' value="'.$key.'">';
					$print .= $value['options'][$key];
					$print .= '</option>'."\n";
				}
				$print .= '		</select>'."\n";
			break;

			// create a multiple select, the options base on array, 
			// using array value both for option value and name
			case 'multiple2' :
				$selected = '';
				$print .= '<div class="input '. $value['type'] .'">'."\n";
				$print .= '	<label class="inputlabel">'. $value['name'] .'</label>'."\n";
				$print .= '	<div class="field">'."\n";
				$print .= '		<select multiple="multiple" id="'. $value['id'] . '" name="'. $value['id'].'[]" value="'. $val .'" >' . "\n";
				foreach ($value['options'] as $name) {
					$arr_val = explode(',',$val);
					if ( array_search($option, $arr_val) !== false ) $selected = ' selected="selected"';
					else $selected = '';
					
					$print .= '			<option'. $selected .' value="'.$name.'">';
					$print .= $name;
					$print .= '</option>'."\n";
				}
				$print .= '		</select>'."\n";
			break;

			// create colorpicker
			case 'color' :
				$colorlist .= ' #' . $value['id'] .',';
				$print .= '<div class="input '. $value['type'] .'">'."\n";
				$print .= '	<label class="inputlabel">'. $value['name'] .'</label>'."\n";
				$print .= '	<div class="field">'."\n";
				$print .= '	<div class="color-popup">'."\n";
				$print .= '	<div style="background-color: '.$val.'"> </div>'."\n";
				$print .= '	</div>'."\n";
				$print .= '		<input  type="text" id="'. $value['id'] . '" name="'. $value['id'].'" value="'. $val .'" />'."\n";
			break;
			
			// create file uploader
			case 'file' :
				$rm_style = '';
				if ($val == '') {
					$rm_style = ' style="display:none"';
				}
				$print .= '<div class="input '. $value['type'] .'">'."\n";
				$print .= '	<label class="inputlabel">'. $value['name'] .'</label>'."\n";
				$print .= '	<div class="field">'."\n";
				$print .= '		<input  type="text" class="file-url" id="'. $value['id'] . '" name="'. $value['id'].'" value="'. $val .'" />'."\n";
				$print .= '		<input class="file-button" type="button" value="Upload" />' . "\n";
				$print .= '		<div class="image">';
				if ( !empty($val) ) {
					$print .= '			<img src="'. $val .'" alt="" />';
				} else {
					$print .= '			<img src="'. $val .'" alt="" style="display: none;" />';
				}
				$print .= '		</div>';
				if ( !empty($val) ) {
					$print .= '		<div class="remove"><a href="#" '. $rm_style .'>Remove</a></div>';
				} else {
					$print .= '		<div class="remove" style="display: none;"><a href="#" '. $rm_style .'>Remove</a></div>';
				}
			break;
			
			// create multi select box
			case 'multicheck' :
				$checked = '';
				$print .= '<div class="input '. $value['type'] .' checkbox">'."\n";
				$print .= '	<label class="inputlabel">'. $value['name'] .'</label>'."\n";
				$print .= '	<div class="field">'."\n";
				$keys = array_keys($value['options']);
				foreach ($keys as $key ) {
					$id = $value['id'] . '_' . $key;
					$std = $value['std'][$key];
					$val = get_option($id);
					if ($val === false) $val = $std;
					if ( $val == 'Yes' ) $checked = 'checked=checked';
					else $checked = '';
					$print .= '		<input class="desc" value="Yes" type="checkbox" id="' . $id . '" name="' . $id . '" '. $checked . '>';
					$print .= '<label class="desc" for="' .$id . '">' .$value['options'][$key] . '</label><br>'."\n";
				}
			break;
			

			// create heading as title
			case 'heading' :
				$print .= '<h2 class="title"><span>'. $value['name'] .'</span></h2>'."\n";
			break;

			// create information box
			case 'info' :
				$print .= '<div class="info"><div class="inner">'. $value['name'] .'</div></div>'."\n";
		}

		// create the description and closing tags for elements, if type is not heading, open-tab and close-tab
		if ( $value['type'] != 'heading' && $value['type'] != 'open-tab' && $value['type'] != 'close-tab' && $value['type'] != 'info'  ) {
			$print .= '	</div>'."\n";
			$print .= '	<div class="desc">'."\n";
			$print .= '		'. $value['desc'] ."\n";
			$print .= '	</div>'."\n";
			$print .= '</div>'."\n";
		}
	}
	$colorlist = rtrim($colorlist, ',');
	$ret = array($nav, $print, $colorlist);
	// return the array
	// [0] : the menu lists
	// [1] : the tabs of options
	// [2] : the colorlist, the element id of colorpickers
	return $ret;
}

// add action to save the panel optins and seo options
add_action( 'wp_ajax_opt-ajax-save-options', 'kartika_panel_ajax_save' );
add_action( 'wp_ajax_framework-ajax-save-options', 'kartika_panel_framework_ajax_save' );
add_action( 'wp_ajax_seo-ajax-save-options', 'kartika_panel_seo_ajax_save' );
add_action( 'wp_ajax_opt-ajax-restore-options', 'kartika_panel_ajax_restore' );
add_action( 'wp_ajax_framework-ajax-restore-options', 'kartika_panel_framework_ajax_restore' );
add_action( 'wp_ajax_seo-ajax-restore-options', 'kartika_panel_seo_ajax_restore' );


/**
 * function kartika_panel_ajax_save()
 * to excecute save function general options on kartika
 *
 */
 
function kartika_panel_ajax_save() {
	global $theme_options;
	parse_str( $_POST['data'], $data );
	$msg = panel_save($theme_options, $data);
	echo $msg.'|';
}


/**
 * function kartika_panel_ajax_save()
 * to excecute save function general options on kartika
 *
 */
 
function kartika_panel_framework_ajax_save() {
	global $options;
	parse_str( $_POST['data'], $data );
	$msg = panel_save($options, $data);
	echo $msg.'|';
}


/**
 * function kartika_panel_seo_ajax_save()
 * to excecute save function SEO options on kartika
 *
 */
 
function kartika_panel_seo_ajax_save() {
	global $seo_options;
	parse_str( $_POST['data'], $data );
	$msg = panel_save($seo_options, $data);
	echo $msg.'|';
	//print_r($_POST['data']);
	//echo '|';
}

/**
 * function kartika_panel_ajax_restore()
 *
 * to restore the options to the standard value
 *
 */
 
function kartika_panel_ajax_restore() {
	global $theme_options;
	$msg = panel_restore($theme_options);
	echo esc_attr($msg).'|';
}


/**
 * function kartika_panel_ajax_restore()
 *
 * to restore the options to the standard value
 *
 */
 
function kartika_panel_framework_ajax_restore() {
	global $options;
	$msg = panel_restore($options);
	echo esc_attr($msg).'|';
}


/**
 * function kartika_panel_seo_ajax_restore()
 *
 * to restore the options to the standard value
 *
 */
 
function kartika_panel_seo_ajax_restore() {
	global $seo_options;
	$msg = panel_restore($seo_options);
	echo esc_attr($msg).'|';
}


/** funciton panel_save()
 *
 * save the options, the options itself provide by $options parameter
 * and the $data parameter is the new value to save on the options
 *
 */
 
function panel_save($options, $data) {
	global $themename;
	$val = 0;

	foreach ( $options as $opt ) {
		if ( $opt['type'] != 'heading' && $opt['type'] != 'open-tab' && $opt['type'] != 'close-tab' && $opt['type'] != 'multicheck' && $opt['type'] != 'info' ) {
		
			// if the value of data is available
			if ( isset( $data[$opt['id']]) ) {
				if ( $opt['type'] == 'multiple' ) $value = implode(',', $data[$opt['id']]); 
				else $value = stripslashes($data[$opt['id']]);
			} else {
				// if the switch turned of set value to No
				if ( $opt['type'] == 'switch' ) $value = 'No';
				elseif ( $opt['type'] == 'multiple') $value = '';
				else $value = '';
			}
			update_option($opt['id'], $value);
		} elseif ( $opt['type'] == 'multicheck' ) {
			$keys = array_keys($opt['options']);
			foreach ( $keys as $key ) {
				$optid = $opt['id'] . '_'. $key;
				if ( isset($data[$optid]) ) $value = $data[$optid];
				else $value = '';
				update_option($optid, $value);	
			}
		}
	}
	
	return sprintf(__('%s setting successfuly saved. ', 'kartika'),$themename);
}


/** funciton panel_save()
 *
 * set the options to the standar value, by $options parameter
 * and the $data parameter is the new value to save on the options
 *
 */
 
function panel_restore($options) {
	global $themename;
	foreach ( $options as $opt ) {
		if ( $opt['type'] != 'heading' && $opt['type'] != 'open-tab' && $opt['type'] != 'close-tab' && $opt['type'] != 'multicheck' && $opt['type'] != 'info'  ) {
			if ( !isset($opt['std']) )echo $opt['type'];
			$value = $opt['std'];
			update_option($opt['id'], $value);
		} else if($opt['type'] == 'multicheck' ) {
			$keys = array_keys($opt['options']);
			foreach ( $keys as $key ) {
				$optid = $opt['id'] . '_'. $key;
				$value = $opt['std'][$key];
				update_option($optid, $value);	
			}			
		}
	}	
	return sprintf(__('%s setting successfuly restored. ', 'kartika'),$themename);	

}


/** function kartika_panel_page_themes()
 *
 * The page for browse themes from themekartika.com
 *
 */


/** function kartika_panel_page_update()
 *
 * The page for update kartika framework
 *
 */

function kartika_panel_page_update() {
	global $kartika_panel_version, $wp_filesystem, $update_sts; 

	$download_url = 'http://www.themekartika.com/updates/kartika.zip';

	$url = admin_url('admin.php?page=kartika_update');
	$method = '';
	$form_field = array('submit', 'download_url', 'kartika_update_nonce', 'new_version');
		
	// Check wether user have credentials to access file system 
	// If you don't have, output credential form to access file system
	
	if ( isset( $_POST['submit'] ) && $_POST['submit'] == 'Update' ) {

		if (false === ($creds = request_filesystem_credentials($url, $method, false, false, $form_field) ) ) {
			return true; 
		}

		if ( ! WP_Filesystem($creds) ) {
			// our credentials were no good, ask the user for them again
			request_filesystem_credentials($url, $method, true, false, $form_field);
			return true;
		}
		

	}
	?>
	
    <div class="wrap kartika-panel-update" >
    	<div class="icon32" id="icon-tools"><br></div>
			<h2>kartika Update</h2>

	<?php
	
	$updated = false;

	if ( isset( $_POST['submit'] ) && $_POST['submit'] == 'Update' ) {
		$updated = kartika_do_update();
		$update = !$updated;
	} else {
		if ( $update = kartika_have_new_version() ) :
			$current_version = $kartika_panel_version; 
			$latest_version =  $update; ?>
			<form method="post"  enctype="multipart/form-data" >
				<h3>A new version of kartika is available</h3>
				<p>This will automaticly update your kartika, all files in functions/kartika/ directory will be replaced. We recommend to backup your files before you update the kartika.</p>
				<p>Your version : <?php echo $current_version; ?></p>
				<p>Latest version : <?php echo $latest_version; ?></p>
                
                <?php wp_nonce_field('kartika_panel_update', 'kartika_update_nonce'); ?>
                <input type="hidden" name="new_version" value="<?php echo $update; ?>"  />
                <input type="hidden" name="download_url" value="<?php echo $download_url; ?>"  />
                <input type="submit" class="button-primary" name="submit" value="Update" />
			</form>
        
		<?php
		else :
		$current_version = $kartika_panel_version;  ?>
				<h3>You have the latest version of kartika.</h3>
				<p>Your version : <?php echo $current_version; ?></p>
			<?php
		endif;
	}
	?>
		</div>
    </div>
    <?php
}


/** function kartika_do_update()
 *
 * The function for kartika update process
 *
 */

function kartika_do_update() {
	global $kartika_panel_version;
	
	$updated = false;
	// Check nonce
	if ( wp_verify_nonce( esc_attr($_POST['kartika_update_nonce']),'kartika_panel_update' ) ) {
		
		$download_url = esc_url($_POST['download_url']);

		show_message( '<p>Downloading file...</p>' );
		
		// Download update file from Themekartika server
		$update_file = download_url($download_url); 
		
		if ( is_wp_error($update_file) ) {
			// Stop process if download file error and show some message
			show_message( '<p>Failed to download file : ' . $update_file->get_error_code() . '</p>' ) ;
			return false;
		} else{
			// Download from server success
			show_message('<p>File downloaded succesfully</p><p>Extracting file...</p>');
			
			global $wp_filesystem;
			$to = $wp_filesystem->wp_content_dir() . "/themes/" . get_option( 'template') . "/functions/";

			// Extract downloaded file to the theme functions folder
			$dounzip = unzip_file($update_file, $to);
			
			if ( is_wp_error($dounzip) ) {
				// Error extracting file.
				$error = $dounzip->get_error_code();
				$data = $dounzip->get_error_data($error);

				show_message('<p>Failed extracting file : ' . str_replace('_', ' ', $error ) . '</p>' );
				show_message('<p>Failed updating kartika, visit our <a href="http://support.themekartika.com/" title="Support Forum">Support Forum</a></p>');
				return false;
			} else{
				// Success on updating kartika
				$kartika_panel_version = $_POST['new_version'];
				show_message('<p>kartika updated successfully</p>');
				$updated = true;
			}
			
			unlink($update_file);
		}
	}
	
	return $updated;
	
}


/** function kartika_have_new_version()
 *
 * Function to check new version of kartika
 * Get changelog file from Themekartika server, get the newest version info
 * Compare with the current instaled kartika
 * If there's a new version return the version name else return false
 *
 */

function kartika_have_new_version() {
	global $kartika_panel_version;
	
	$url = 'http://www.themekartika.com/updates/changelog.txt';
    
	// get the changelog file from Themekartika server
	$log_file = download_url($url);
	
	if(!is_wp_error($log_file) && $fcontents = file($log_file)) {
		// On success

		foreach ($fcontents as $line_num => $line) {

			$current_line =  $line;
			if($line_num > 1) {
				// Check the first character of the line, if its numeric then it's a version history
				if (preg_match( '/^[0-9]/', $line)) {
                                            
					$current_line = stristr($current_line,"version" );
					// Get the version number
					$current_line = preg_replace( '~[^0-9,.]~','',$current_line);
					$version = $current_line;
					break;
				}
			}     
		}

		$cversion = explode('.', $kartika_panel_version);
		$nversion = explode('.', $version);
	
		$update = false;
		
		// Compare the version
		if ( $cversion[0] < $nversion[0] ) {
			$update = true; 
		} elseif ( $cversion[1] < $nversion[1] ) {
			$update = true;
		} elseif ( $cversion[2] < $nversion[2] ) { // if version number have 3 digits
			$update = true; }
		
		$ret = ($update === false) ? false : $version;
		unlink($log_file);
		
		// Return the version number if there's a new version, return false if there's no new version
		return $ret;
    } else {
        return false;
    }
}
?>