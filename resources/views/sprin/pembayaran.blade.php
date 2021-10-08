@extends('layouts/main')

@section('header_script')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/materialadmin/css/theme-default/libs/DataTables/jquery.dataTables.css">
    <link type="text/css" rel="stylesheet" href="{{ url('/') }}/materialadmin/css/theme-default/libs/toastr/toastr.css?1425466569" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="section-header">
            <h2 class="text-primary">Data Pembayaran</h2>
        </div>
        <div class="card">

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <strong>Failed!</strong> {{ session('error') }}
                    </div>
                @endif
                
                <div class="dataTables_wrapper">
                    <div class="dt-filter-column">
                        <a href="{{ url('export/pembayaran') }}" class="btn btn-warning"><i class="fa fa-print"></i> Export</a>
                        <button class="btn btn-md dt-toggle-column"><i class="fa fa-filter"></i> Columns</button>
                        <div class="dt-filter-column-item">
                            
                        </div>
                    </div>

                    <table id="dynamic-table" class="table table-striped dt-table">
                        <thead>
                            <tr>
                            	<th><input type="checkbox" class="select-all"> All</th>
                                <th>No Sprin</th>
                                <th>Nama</th>
                                <th>Pangkat</th>
                                <th>Corp</th>
                                <th>NRP</th>
                                <th>Kesatuan</th>
                                <th>Jml Bln</th>
                                <th>Jml Uang</th>
                                <th>No Rek</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <a class="btn btn-lg btn-success btn-save-pembayaran" data-url="{{ url('sprin/sudah_bayar') }}">Sudah Dibayar</a>
    </div>
</div>

<div class="modal fade" id="bayar-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Masukkan Tanggal Pembayaran</h4>
      </div>
        <form class="form-horizontal form-bayar" action="{{ url('sprin/set-pembayaran') }}" method="post">
          <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label class="control-label col-xs-4 col-md-2">Tanggal</label>
                    <div class="col-xs-8 col-md-10">
                        <input type="text" name="tanggal" class="form-control is-datepicker input-tanggal" autocomplete="off" required>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('footer_script')
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('materialadmin/js/libs/toastr/toastr.js') }}"></script>
    <script src="{{ url('js/bootstrap-datepicker.min.js') }}"></script>

    <script type="text/javascript">
        toastr.options = {
            "closeButton": true,
            "progressBar": false,
            "debug": false,
            "positionClass": 'toast-top-center',
            "showDuration": 330,
            "hideDuration": 330,
            "timeOut":  5000,
            "extendedTimeOut": 5000,
            "showEasing": 'swing',
            "hideEasing": 'swing',
            "showMethod": 'fadeIn',
            "hideMethod": 'slideUp',
            "onclick": null
        };
        
        function addColumnFilter(dt_table){
            var columns = dt_table.settings().init().columns;

            var html = '';
            $.each(columns, function(k, d){
                html += '<input class="dt-filter-column-checkbox" type="checkbox" name="filterColumn[]" value=".'+d.className+'"'+(d.visible == true ? "checked" : "")+'> <label>'+d.className+'</label><br>';
            });

            $('.dt-filter-column-item').html(html);

            $('.dt-filter-column').insertAfter('#dynamic-table_filter');

            $('.dt-filter-column-checkbox').on('change', function(){
                $('.dt-filter-column-checkbox').each(function(k, d){
                    if($(d).is(':checked')){
                        dt_table.column($(d).val()).visible(true);
                    } else {
                        dt_table.column($(d).val()).visible(false);
                    }
                });
            });

            $('.dt-toggle-column').on('click', function(){
                $('.dt-filter-column-item').toggle();
            });
        }

        $(function() {
            dt_table = $('#dynamic-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('sprin/data-pembayaran') !!}',
                pageLength: 25,
                columns: [
                	{
                        data: 'check',
                        name: 'check',
                        orderable: false,
                        searchable: false
                    },
                    { data: 'no_sprin', name: 'no_sprin', defaultContent: "<i class='text-danger'>null</i>", className: 'no_sprin', visible: true },
                    { data: 'nama', name: 'nama', defaultContent: "<i class='text-danger'>null</i>", className: 'nama', visible: true },
                    { data: 'pangkat_uraian', name: 'pangkat', defaultContent: "<i class='text-danger'>null</i>", className: 'pangkat', visible: true },
                    { data: 'corp_uraian', name: 'corps', defaultContent: "<i class='text-danger'>null</i>", className: 'corps', visible: true },
                    { data: 'nrp', name: 'nrp', defaultContent: "<i class='text-danger'>null</i>", className: 'nrp', visible: true },
                    { data: 'kesatuan_uraian', name: 'kesatuan', defaultContent: "<i class='text-danger'>null</i>", className: 'kesatuan', visible: true },
                    { data: 'jml_bulan', name: 'jml_bulan', defaultContent: "<i class='text-danger'>null</i>", className: 'jml_bulan', visible: true },
                    { data: 'jml_uang', name: 'jml_uang', defaultContent: "<i class='text-danger'>null</i>", className: 'jml_uang', visible: true },
                    { data: 'no_rek', name: 'no_rek', defaultContent: "<i class='text-danger'>null</i>", className: 'no_rek', visible: true },
                    { data: 'nama_bank', name: 'nama_bank', defaultContent: "<i class='text-danger'>null</i>", className: 'nama_bank', visible: true },
                    { data: 'action', name: 'action', visible: true }
                ],
                order: [[2, 'desc']]
            });

            addColumnFilter(dt_table);

            $('body').on('click', '.btn-save-pembayaran', function(){
                var pembayaran_ids = [];
                $('.check-pembayaran:checked').each(function(k, d){
                    pembayaran_ids[k] = $(d).val();
                });

                if(!pembayaran_ids.length){
                    toastr.error("Tidak ada data yang dipilih!");
                    return;
                }

                $('#bayar-modal').modal('show');
            })

            $('.form-bayar').on('submit', function(e){
                e.preventDefault();

                if(!$('.form-bayar')[0].checkValidity()){
                    return false;
                }

                var post_url = $(this).attr('action');
                // var post_data = $(this).serializeArray();

                var pembayaran_ids = [];
                $('.check-pembayaran:checked').each(function(k, d){
                    pembayaran_ids[k] = $(d).val();
                });

                var input_tanggal = $('.input-tanggal').val();

                $.ajax({
                    url: post_url,
                    data: {pembayaran_ids: pembayaran_ids, tanggal: input_tanggal},
                    dataType: 'json',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        dt_table.ajax.reload();

                        $('.form-bayar')[0].reset();
                        $('#bayar-modal').modal('hide');

                        toastr.success(response.message);
                    }
                });
            });

            $(".is-datepicker").each(function() {
                $(this).datepicker({
                    format:'yyyy-mm-dd'
                });

                $(this).datepicker('setDate', $(this).val());
            });

            $('.select-all').on('click', function(){
                if($(this).is(':checked')){
                    $('.check-pembayaran').prop('checked', true);
                } else {
                    $('.check-pembayaran').prop('checked', false);
                }
            });
        });
    </script>

@endsection