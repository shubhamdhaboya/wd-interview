require('./bootstrap');

jQuery(document).ready(function ($) {
	$('.data-table').DataTable({
		searching: false,
		processing: true,
		serverSide: true,
		ajax: "/companies/json"
	});

	jQuery('#logo').on('change', function (e) {
		if (this.files[0]) {
			$('.logo-file-name').text(this.files[0].name);
		}else{
			$('.logo-file-name').text('');
		}
	});
});