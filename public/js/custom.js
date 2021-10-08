$(function(){
	$('.form-export').on('submit', function(e){
		e.preventDefault();

		var post_url = $(this).attr('action');
		var post_data = $('.form-export').serializeArray();

		$.ajax({
			url: post_url,
			type: 'post',
			dataType: 'json',
			data: post_data,
			success: function(response){
				console.log(response);
			}
		});
	});

	$('.lihat-detail-tabungan').on('click', function(e){
		e.preventDefault();

		$('.detail-tabungan').toggleClass('hide');
	});
});