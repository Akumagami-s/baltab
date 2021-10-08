@extends('layouts/main')

@section('header_script')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/materialadmin/css/theme-default/libs/DataTables/jquery.dataTables.css">
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="section-header">
            <h2 class="text-primary">Data Pokok Prajurit</h2>
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
                        <button class="btn btn-md dt-toggle-column"><i class="fa fa-filter"></i> Columns</button>
                        <div class="dt-filter-column-item">
                            
                        </div>
                    </div>

                    <table id="dynamic-table" class="table table-striped dt-table">
                        <thead>
                            <tr>
                                <th>NRP</th>
                                <th>Nama</th>
                                <th>Pangkat</th>
                                <th>Kesatuan</th>
                                <th>Korp</th>
                                <th>Pengangkatan</th>
                                <th>Tanggal Lahir</th>
                                <th>Kotama</th>
                                <th>tmt_1</th>
                                <th>tmt_2</th>
                                <th>tmt_3</th>
                                <th>tmt_4</th>
                                <th>tmt_5</th>
                                <th>tmt_henti</th>
                                <th>kode_p_sub</th>
                                <th>kd_bansus</th>
                                <th>tg_update</th>
                                <th>tmt_pa</th>
                                <th>no_bitur</th>
                                <th>kd_ktg</th>
                                <th>tmt_ktg</th>
                                <th>g_pokok</th>
                                <th>t_istri</th>
                                <th>t_anak</th>
                                <th>kpr1</th>
                                <th>kpr2</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

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

        $(function() {
            dt_table = $('#dynamic-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('datapokok/data') !!}',
                pageLength: 25,
                columns: [
                    { data: 'nrp_formated', name: 'nrp', defaultContent: "<i class='text-danger'>null</i>", className: 'nrp', visible: true },
                    { data: 'nama', name: 'nama', defaultContent: "<i class='text-danger'>null</i>", className: 'nama', visible: true },
                    { data: 'pangkat_uraian', name: 'pangkat', defaultContent: "<i class='text-danger'>null</i>", className: 'pangkat', visible: true },
                    { data: 'kesatuan_uraian', name: 'kesatuan', defaultContent: "<i class='text-danger'>null</i>", className: 'kesatuan', visible: true },
                    { data: 'corp_uraian', name: 'corps', defaultContent: "<i class='text-danger'>null</i>", className: 'corps', visible: true },
                    { data: 'tg_pengangkatan_formated', name: 'tmt_abri', defaultContent: "<i class='text-danger'>null</i>", className: 'tmt_abri', visible: true },
                    { data: 'tg_lahir_formated', name: 'tg_lahir', defaultContent: "<i class='text-danger'>null</i>", className: 'tg_lahir', visible: true },

                    { data: 'kotama_uraian', name: 'kd_ktm', defaultContent: "<i class='text-danger'>null</i>", className: 'kd_ktm', visible: false },
                    { data: 'tmt_1', name: 'tmt_1', defaultContent: "<i class='text-danger'>null</i>", className: 'tmt_1', visible: false },
                    { data: 'tmt_2', name: 'tmt_2', defaultContent: "<i class='text-danger'>null</i>", className: 'tmt_2', visible: false },
                    { data: 'tmt_3', name: 'tmt_3', defaultContent: "<i class='text-danger'>null</i>", className: 'tmt_3', visible: false },
                    { data: 'tmt_4', name: 'tmt_4', defaultContent: "<i class='text-danger'>null</i>", className: 'tmt_4', visible: false },
                    { data: 'tmt_5', name: 'tmt_5', defaultContent: "<i class='text-danger'>null</i>", className: 'tmt_5', visible: false },
                    { data: 'tmt_henti', name: 'tmt_henti', defaultContent: "<i class='text-danger'>null</i>", className: 'tmt_henti', visible: false },
                    { data: 'kode_p_sub', name: 'kode_p_sub', defaultContent: "<i class='text-danger'>null</i>", className: 'kode_p_sub', visible: false },
                    { data: 'kd_bansus', name: 'kd_bansus', defaultContent: "<i class='text-danger'>null</i>", className: 'kd_bansus', visible: false },
                    { data: 'tg_update', name: 'tg_update', defaultContent: "<i class='text-danger'>null</i>", className: 'tg_update', visible: false },
                    { data: 'tmt_pa', name: 'tmt_pa', defaultContent: "<i class='text-danger'>null</i>", className: 'tmt_pa', visible: false },
                    { data: 'no_bitur', name: 'no_bitur', defaultContent: "<i class='text-danger'>null</i>", className: 'no_bitur', visible: false },
                    { data: 'kd_ktg', name: 'kd_ktg', defaultContent: "<i class='text-danger'>null</i>", className: 'kd_ktg', visible: false },
                    { data: 'tmt_ktg', name: 'tmt_ktg', defaultContent: "<i class='text-danger'>null</i>", className: 'tmt_ktg', visible: false },
                    { data: 'g_pokok', name: 'g_pokok', defaultContent: "<i class='text-danger'>null</i>", className: 'g_pokok', visible: false },
                    { data: 't_istri', name: 't_istri', defaultContent: "<i class='text-danger'>null</i>", className: 't_istri', visible: false },
                    { data: 't_anak', name: 't_anak', defaultContent: "<i class='text-danger'>null</i>", className: 't_anak', visible: false },
                    { data: 'kpr1', name: 'kpr1', defaultContent: "<i class='text-danger'>null</i>", className: 'kpr1', visible: false },
                    { data: 'kpr2', name: 'kpr2', defaultContent: "<i class='text-danger'>null</i>", className: 'kpr2', visible: false },

                    {
                        data: 'action',
                        name: 'action',
                        className: 'action',
                        orderable: false,
                        searchable: false,
                        visible: true
                    }
                ],
                order: [[0, 'desc']]
            });

            addColumnFilter(dt_table);
        });
    </script>

@endsection