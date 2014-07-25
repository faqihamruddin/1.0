        jQuery(document).ready(function($) {
			$('#warrior-metabox input.button-highlighted').click(function() {
				var fieldsetBasic = $('#warrior-metabox .criteria-prototype').html();
				var fieldsetAddId = 10000+Math.floor(Math.random()*100000);
				var fieldsetDisplay = fieldsetBasic.replace(/___criteria__name___/g, 'criteria_name['+fieldsetAddId+']').replace(/___criteria__value___/g, 'criteria_value['+fieldsetAddId+']').replace(/___criteria__id___/g, fieldsetAddId);
				$('#warrior-metabox fieldset.ratings').append(fieldsetDisplay);
			});
		});
		(function( $ ){
			$.fn.cval = function( options ) {  
				var setting = $.extend( { id : '', value : '' }, options);
				return this.each(function() {
					$(this).slider({ 
						value: setting.value,
						range: 'min',
						min: 1, 
						max: 5, 
						step: 1, 
						slide: function( event, ui ) { 
							$( '#criteria_value_'+setting.id ).val( ui.value ); } 
					});
				});
			};
			$.fn.cdel = function( options ) {  
				var setting = $.extend( { id : '' }, options);
				return this.click(function() {
					$('#criteria-'+setting.id).css('background','#daa').fadeOut('slow').find('input').removeAttr('name');
				});
			};
		})( jQuery );