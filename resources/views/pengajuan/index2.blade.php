@extends('layouts/main')

@section('header_script')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/materialadmin/css/theme-default/libs/DataTables/jquery.dataTables.css">
    <link type="text/css" rel="stylesheet" href="{{ url('/') }}/materialadmin/css/theme-default/libs/toastr/toastr.css?1425466569" />
@endsection

@section('content')

<style>
    .tab {
        display: none;
    }
</style>
<div class="row">


    <center>
            <div class="search" style="width: 40%">
                <h2>Search KOTAMA</h2>
                <select name="kotama" id="kotama" class="form-control">
                    @foreach (App\Models\KotamaAll::all() as $item)
                        <option value="{{$item->kode}}">{{$item->uraian}}</option>
                    @endforeach

                </select>

                <br>
                <button id="searchkotama" class="btn btn-outline-success">kirim</button>
            </div>
    </center>


    <div class="tab" class="col-xs-12">
        <div class="section-header">
            <h2 class="text-primary">Data Pengajuan</h2>
        </div>
        <div class="card">

            <div class="card-body">
                <div class="dataTables_wrapper">
                    <div class="dt-filter-column">
                        <button class="btn btn-md dt-toggle-column"><i class="fa fa-filter"></i> Columns</button>
                        <div class="dt-filter-column-item">

                        </div>
                    </div>

                    <table id="dynamic-table" class="table table-striped dt-table">
                        <thead>
                            <tr>
                            	<th><input type="checkbox" class="select-all"> All</th>
                                <th>NRP</th>
                                <th>Nama</th>
                                <th>Pangkat</th>
                                <th>Kesatuan</th>
                                <th>Kesatuan</th>

                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <a class="btn btn-lg btn-success save-sprin" data-url="{{ route('addSprin') }}">Tambahkan ke Sprin</a>
        <a class="btn btn-lg btn-danger delete-pengajuan" data-url="{{ url('pengajuan/delete') }}"><i class="fa fa-trash-o"></i> HAPUS</a>
    </div>
</div>
@endsection

@section('footer_script')
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('materialadmin/js/libs/toastr/toastr.js') }}"></script>

    <script type="text/javascript">
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


        $("#searchkotama").on('click', function(event){

            getKotama($('#kotama').val());
            $('.search').css('display','none');


});



    function getKotama(ktm) {
        $('.tab').css('display','block');

        console.log(ktm);
        dt_table = $('#dynamic-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "https://asiabytes.tech/baltab/dataPengajuan/"+ktm,
                pageLength: 25,
                columns: [
                    {
                        data: 'check',
                        name: 'check',
                        orderable: false,
                        searchable: false
                    },
                    { data: 'nrp_formated', name: 'NRP', defaultContent: "<i class='text-danger'>null</i>", className: 'NRP', visible: true },
                    { data: 'nama', name: 'nama', defaultContent: "<i class='text-danger'>null</i>", className: 'nama', visible: true },
                    { data: 'pangkat_uraian', name: 'pangkat', defaultContent: "<i class='text-danger'>null</i>", className: 'pangkat', visible: true },
                    { data: 'kesatuan_uraian', name: 'kesatuan', defaultContent: "<i class='text-danger'>null</i>", className: 'kesatuan', visible: true },
                    { data: 'corp_uraian', name: 'corps', defaultContent: "<i class='text-danger'>null</i>", className: 'corps', visible: true },



                ],
                order: [[2, 'desc']]
            });

            addColumnFilter(dt_table);
    }


    $('.save-sprin').on('click', function(){
                if(!confirm("Tambahkan ke sprin?")){
                    return false;
                }

                var pengajuan_ids = [];
                $('.check-pengajuan:checked').each(function(k, d){
                    pengajuan_ids[k] = $(d).val();
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

                if(pengajuan_ids.length){
                    $.ajax({
                        url: post_url,
                        type: 'post',
                        data: {pengajuan_ids: pengajuan_ids},
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
        console.log('ada');
                if($(this).is(':checked')){
                    $('.check-pengajuan').prop('checked', true);
                } else {
                    $('.check-pengajuan').prop('checked', false);
                }
            });
    </script>



@endsection
