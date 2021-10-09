@extends('layouts.base')

@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/pengajuaneBaltab.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')

    <style>
        #tabtwo {
            display: none;
        }

    </style>

    <div class="mainContent">
        <div class="container-fluid">
            <div class="wrapperContent">

                <div class="nav nav-tabs tabsButton" id="nav-tab" role="tablist">

                    <button class="nav-link active" id="index-tab-menu" data-bs-toggle="tab" data-bs-target="#index-tab"
                        type="button" role="tab" aria-controls="index-tab" aria-selected="true">Data Pembayaran</button>
                    <button class="nav-link" id="cari-tab-menu" data-bs-toggle="tab" data-bs-target="#cari-tab"
                        type="button" role="tab" aria-controls="cari-tab" aria-selected="true">Data Pencairan</button>


                </div>

                <div class="tab-content" id="nav-tabContent">



                    <div class="tab-pane fade show active" id="index-tab" role="tabpanel" aria-labelledby="index-tab-menu">

                        <h1 class="nameContent">Data Pembayaran</h1>
    <br>
                        <b><h4>Jumlah Pembayaran : <span style="color:#FF0000;">{{$jml_pembayaran}}</span></h4></b>
                        <br>
                        <b><h4>Total Dana Pembayaran : <span style="color:#08850D;">Rp.{{number_format($jumlah_pembayaran, 2, ',', '.')}}</span></h4></b>
                        <br>
                        <br>
                        <div class="wrapperTable">
                            <div style="display: flex;justify-content: end" class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Filter
                                </button>
                                <ul class="dropdown-menu p-2" aria-labelledby="dropdownMenuButton1">
                                    <div class="dt-filter-column-persetujuan">
                                        <button class="btn btn-md dt-toggle-column-persetujuan"><i
                                                class="fa fa-filter"></i>
                                            Columns</button>
                                        <div class="dt-filter-column-persetujuan-item">

                                        </div>
                                    </div>
                                </ul>

                            </div>
                            <br>

                            <table id="pembayaran" class="table" style="width:100%">
                                <thead class="headTable">
                                    <tr>
                                        <th>No </th>
                                        <th>No Sprin</th>

                                        <th>Nama Rekening / NRP</th>
                                        <th>Nama Bank / No Rekening</th>
                                        <th>Tabungan</th>


                                        <th>Status</th>
                                    </tr>
                                </thead>

                            </table>

                            <br>

                            <br>

                        </div>

                    </div>

                    <div class="tab-pane fade show" id="cari-tab" role="tabpanel" aria-labelledby="cari-tab-menu">

                        <h1 class="nameContent">Data Pencairan</h1>

  <br>

  <b><h4>Jumlah Pencairan : <span style="color:#FF0000;">{{$jml_pencairan}}</span></h4></b>
  <br>
  <b><h4>Total Dana Pencairan : <span style="color:#08850D;">Rp.{{number_format($jumlah_pencairan, 2, ',', '.')}}</span></h4></b>
                        <br>
                        <br>
                        <div class="wrapperTable">

                            <br>

                            <table id="pencairan" class="table" style="width:100%">
                                <thead class="headTable">
                                    <tr>
                                        <th>No </th>
                                        <th>No Sprin</th>


                                        <th>Nama Rekening / NRP</th>
                                        <th>Nama Bank / No Rekening</th>
                                        <th>Tabungan</th>

                                        <th>Status</th>

                                    </tr>
                                </thead>

                            </table>

                            <br>

                        </div>


                    </div>




                </div>

            </div>
        </div>
    </div>

    <footer>
        <p>Copyright 2021 © DITKUAD</p>
    </footer>



@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>

    <script src="{{ url('materialadmin/js/libs/toastr/toastr.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>

   <script type="text/javascript">
        function addColumnFilter(dt_table, tableclass) {
            var columns = dt_table.settings().init().columns;

            var html = '';
            $.each(columns, function(k, d) {
                html += '<input class="dt-filter-column-' + tableclass +
                    '-checkbox" type="checkbox" name="filterColumn[]" value=".' +
                    d.className + '"' + (d.visible == true ? "checked" : "") + '> <label>' + d.className +
                    '</label><br>';
            });

            $('.dt-filter-column-' + tableclass + '-item').html(html);

            $('.dt-filter-' + tableclass + '-column').insertAfter('#dynamic-table_filter');

            $('.dt-filter-column-' + tableclass + '-checkbox').on('change', function() {
                $('.dt-filter-column-' + tableclass + '-checkbox').each(function(k, d) {
                    if ($(d).is(':checked')) {
                        dt_table.column($(d).val()).visible(true);
                    } else {
                        dt_table.column($(d).val()).visible(false);
                    }
                });
            });

            $('.dt-toggle-column-' + tableclass).on('click', function() {
                $('.dt-filter-column-' + tableclass + '-item').toggle();
            });
        }



        $(document).ready(function() {


            pembayaran = $('#pembayaran').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                ajax: "{{ route('seePembayaran') }}",
                pageLength: 25,
                columns: [
                    // {
                    //     data: 'check',
                    //     name: 'check',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable:false
                    },
                    {
                        data: 'no_sprin',
                        name: 'sprin',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'sprinPem',
                        searchable: false,
                        orderable:false
                    },


                    {
                        data: 'nama',
                        name: 'atas_nama',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'atas_nama',
                        visible: true,
                        searchable: true
                    },

                    {
                        data: 'namabank',
                        name: 'nama_bank',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'nama_bank',
                        visible: true,
                        searchable: true,
                        orderable:true
                    },
                    {
                        data: 'jumlah_tabungan',
                        name: 'jumlah_tabungan',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'jumlah_tabungan',
                        visible: true,
                        searchable: true,
                        orderable:true
                    },



                    {
                        data: 'status',
                        name: 'status',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'statusPem',
                        visible: true
                    },




                ],
                order: [
                    [2, 'desc']
                ]
            });
            addColumnFilter(pembayaran, "pembayaran");




            pencairan = $('#pencairan').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                ajax: "{{ route('seeBeres') }}",
                pageLength: 25,
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable:false
                    },
                    {
                        data: 'no_sprin',
                        name: 'no_sprin',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'no_sprin',
                        searchable: true
                    },
                    {
                        data: 'nama',
                        name: 'atas_nama',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'atas_nama',
                        visible: true,
                        searchable: true
                    },
                    {
                        data: 'namabank',
                        name: 'nama_bank',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'nama_bank',
                        visible: true
                    },

                    {
                        data: 'jumlah_tabungan',
                        name: 'jumlah_tabungan',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'jumlah_tabungan',
                        visible: true
                    },

                    {
                        data: 'status',
                        name: 'status',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'status',
                        visible: true
                    },



                ],

            });
            addColumnFilter(pencairan, "pembayaran");


        });




        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });


    </script>




@endsection
