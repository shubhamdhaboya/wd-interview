require('./bootstrap');

jQuery(document).ready(function ($) {
	jQuery('#logo').on('change', function (e) {
		if (this.files[0]) {
			$('.logo-file-name').text(this.files[0].name);
		}else{
			$('.logo-file-name').text('');
		}
	});
});