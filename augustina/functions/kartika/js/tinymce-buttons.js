(function() {
	tinymce.create('tinymce.plugins.ShortcodePlugin', {
	init : function(ed, url) {
	
		var urlWarriorPanel = url.replace(/js/i, "");

		// Register commands
		ed.addCommand('mceShortcode', function() {
			ed.windowManager.open({
				file : urlWarriorPanel + 'includes/shortcode-documentation.php',
				width : 650 + parseInt(ed.getLang('shortcode.delta_width', 0)),
				height : 500 + parseInt(ed.getLang('shortcode.delta_height', 0)),
				inline : 1
			}, {
				plugin_url : url
			});
		});

		// Register buttons
		ed.addButton('shortcode', {title : 'Shortcode', cmd : 'mceShortcode', image: urlWarriorPanel + 'images/shortcode-icon.png' });
		},

		getInfo : function() {
			return {
			longname : 'ThemeWarrior Shortcodes',
			author : 'ThemeWarrior',
			authorurl : 'http://www.themewarrior.com',
			infourl : 'http://www.themewarrior.com',
			version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
	 
	// Register plugin
	tinymce.PluginManager.add('shortcode', tinymce.plugins.ShortcodePlugin);
})();