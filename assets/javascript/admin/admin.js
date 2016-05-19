(function(){
	'use strict';

	var metaImageFrame,
		action = function(e) {
			e.preventDefault();

			if ( metaImageFrame ) {
				metaImageFrame.open();
				return;
			}

			metaImageFrame = wp.media.frames.meta_image_frame = wp.media({
				'title'   : cpwpAdminLocalization.title,
				'button'  : { 'text' : cpwpAdminLocalization.button },
				'library' : { 'type' : 'image' }
			});

			metaImageFrame.on('select', function(){
				var mediaAttachment = metaImageFrame.state().get('selection').first().toJSON();

				document.getElementById('cpwp_showcase_screenshot_placeholder').style.backgroundImage = 'url("' + mediaAttachment.url + '")';
				document.getElementById('_cpwp_showcase_screenshot').value = mediaAttachment.id;
			});

			metaImageFrame.open();
		};

	document.getElementById('_cpwp_showcase_screenshot_button').addEventListener('click', action);
	document.getElementById('cpwp_showcase_screenshot_placeholder').addEventListener('click', action);
}());
