$(function(){
	$('.form-pengajuan').on('submit', function(e){
		e.preventDefault();

        if(!$('.form-pengajuan')[0].checkValidity()){
            return false;
        }

		var post_url = $(this).attr('action');
		var post_data = $('.form-pengajuan').serializeArray();
		var redirect = $('.btn-pengajuan').data('redirect');

		$.ajax({
			url: post_url,
			type: 'post',
			dataType: 'json',
			data: post_data,
			success: function(response){
				if(response.status == 'success'){
					var datapokok_id = response.datapokok_id;
					window.location = redirect;
				}
			}
		});
	});

	$('.btn-pengajuan').on('click', function(){
        var datapokok_id = $(this).data('id');
        var jumlah = $(this).data('jumlah');
        var bulan = $(this).data('bulan');

        $('.input-datapokokid').val(datapokok_id);
        $('.input-jumlah').val(jumlah);
        $('.input-bulan').val(bulan);
        $('#pengajuan-modal').modal('show');
    })
});