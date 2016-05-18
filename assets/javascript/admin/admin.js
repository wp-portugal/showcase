(function(){
	'use strict';

	var metaImageFrame;

	document.getElementById('_cpwp_showcase_screenshot_button').addEventListener('click', function(e){
		e.preventDefault();

		if ( metaImageFrame ) {
			metaImageFrame.open();
			return;
		}

		metaImageFrame = wp.media.frames.meta_image_frame = wp.media({
			title: cpwp_admin_localization.title,
			button: { text: cpwp_admin_localization.button },
			library: { type: 'image' }
		});

		metaImageFrame.on('select', function(){
			var mediaAttachment = metaImageFrame.state().get('selection').first().toJSON();
			document.getElementById('_cpwp_showcase_screenshot').val(mediaAttachment.url);
		});

		metaImageFrame.open();
	});
}());