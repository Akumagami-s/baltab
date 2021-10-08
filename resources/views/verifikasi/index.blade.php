@extends('layouts/main')

@section('header_script')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/materialadmin/css/theme-default/libs/DataTables/jquery.dataTables.css">
    <link type="text/css" rel="stylesheet" href="{{ url('/') }}/materialadmin/css/theme-default/libs/toastr/toastr.css?1425466569" />
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="section-header">
            <h2 class="text-primary">Verifikasi Data Import</h2>
        </div>
        <div class="card">
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

                <div class="dataTables_wrapper">
                    <table id="import-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="select-all"> All</th>
                                <th>NRP</th>
                                <th>Nama</th>
                                <th>Perubahan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <a class="btn btn-lg btn-success save-verifikasi" data-url="{{ url('verifikasi/save') }}">SIMPAN</a>
        <a class="btn btn-lg btn-danger delete-verifikasi" data-url="{{ url('verifikasi/delete') }}"><i class="fa fa-trash-o"></i> HAPUS</a>
    </div>
</div>
@endsection

@section('footer_script')
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('materialadmin/js/libs/toastr/toastr.js') }}"></script>

    <script type="text/javascript">
        $(function() {
            dt_table = $('#import-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('verifikasi/data') !!}',
                pageLength: 25,
                columns: [
                    {
                        data: 'check',
                        name: 'check',
                        orderable: false,
                        searchable: false
                    },
                    { data: 'nrp', name: 'nrp', defaultContent: "<i class='text-danger'>null</i>", 'width': '150px' },
                    { data: 'nama', name: 'nama', defaultContent: "<i class='text-danger'>null</i>", 'width': '200px' },
                    { data: 'perubahan', perubahan: 'nama', defaultContent: "<i class='text-danger'>null</i>",
                        orderable: false,
                        searchable: false },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [[2, 'asc']]
            });

            $(document).on('click', '.btn-verifikasi', function(){
                $(this).siblings('.box-verifikasi').toggle();
            });

            $('.save-verifikasi').on('click', function(){
                if(!confirm("Simpan data baru dan overwrite data yang sudah ada?")){
                    return false;
                }

                var import_ids = [];
                $('.check-verifikasi:checked').each(function(k, d){
                    import_ids[k] = $(d).val();
                });

                var post_url = $(this).data('url');

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

                if(import_ids.length){
                    $.ajax({
                        url: post_url,
                        type: 'post',
                        data: {import_ids: import_ids},
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response){
                            dt_table.ajax.reload();

                            toastr.success(response.message);
                        }
                    });
                } else {
                    toastr.error('Tidak ada data yang dipilih!');
                }
            });

            $('.delete-verifikasi').on('click', function(){
                if(!confirm("Hapus data?")){
                    return false;
                }

                var import_ids = [];
                $('.check-verifikasi:checked').each(function(k, d){
                    import_ids[k] = $(d).val();
                });

                var post_url = $(this).data('url');

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

                if(import_ids.length){
                    $.ajax({
                        url: post_url,
                        type: 'post',
                        data: {import_ids: import_ids},
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response){
                            dt_table.ajax.reload();

                            toastr.success(response.message);
                        }
                    });
                } else {
                    toastr.error('Tidak ada data yang dipilih!');
                }
            });

            $('.select-all').on('click', function(){
                if($(this).is(':checked')){
                    $('.check-verifikasi').prop('checked', true);
                } else {
                    $('.check-verifikasi').prop('checked', false);
                }
            });
        });
    </script>

@endsection