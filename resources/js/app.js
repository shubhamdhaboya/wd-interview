require('./bootstrap');

jQuery(document).ready(function ($) {
	const url = $('.data-table').data('url');

	$('.data-table').DataTable({
		searching: false,
		processing: true,
		serverSide: true,
		ajax: url
	});

	jQuery('#logo').on('change', function (e) {
		if (this.files[0]) {
			$('.logo-file-name').text(this.files[0].name);
		}else{
			$('.logo-file-name').text('');
		}
	});
});