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


                    <button class="nav-link active" id="cari-tab-menu" data-bs-toggle="tab" data-bs-target="#cari-tab"
                        type="button" role="tab" aria-controls="cari-tab" aria-selected="true">Proses Pencairan</button>

                    <button class="nav-link" id="list-tab-menu" data-bs-toggle="tab" data-bs-target="#list-tab"
                        type="button" role="tab" aria-controls="list-tab" aria-selected="true">Sudah Di bayarkan</button>
                </div>

                <div class="tab-content" id="nav-tabContent">



                    <div class="tab-pane fade show active" id="cari-tab" role="tabpanel" aria-labelledby="cari-tab-menu">

                        <h1 class="nameContent">Data Pembayaran</h1>


                        <div class="wrapperTable">
                            <div style="display: flex;justify-content: end" class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Filter
                                </button>
                                <ul class="dropdown-menu p-2" aria-labelledby="dropdown2">
                                    <div class="dt-filter-column-pembayaran">
                                        <button class="btn btn-md dt-toggle-column-pembayaran"><i
                                                class="fa fa-filter"></i>
                                            Columns</button>
                                        <div class="dt-filter-column-pembayaran-item">

                                        </div>
                                    </div>
                                </ul>

                                <a href="{{ route('downloadSprin') }}" class="ms-2 btn btn-outline-info">
                                    Export Excel
                                </a>

                            </div>
                            <br>

                            <table id="pemtabel" class="table" style="width:100%">
                                <thead class="headTable">
                                    <tr>
                                        {{-- <th><input type="checkbox" class="select-all-pembayaran"> All</th> --}}
                                        <th>No Sprin</th>
                                        <th>NRP</th>
                                        <th>Nama</th>

                                        <th>Tabungan</th>
                                        <th>Nama Rekening</th>
                                        <th>Nama Bank</th>

                                        <th>No rekening</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                            </table>

                            <br>

                        </div>


                    </div>


                    <!-- agus -->

                    <div class="tab-pane fade show " id="list-tab" role="list-tab" aria-labelledby="list-tab-menu">
                        <h1 class="nameContent">Telah Di Bayarkan</h1>
                        <div class="wrapperTable">
                            <div style="display: flex;justify-content: end" class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Filter
                                </button>
                                <ul class="dropdown-menu p-2" aria-labelledby="dropdown2">
                                    <div class="dt-filter-column-pembayaran">
                                        <button class="btn btn-md dt-toggle-column-pembayaran">
                                            <i class="fa fa-filter"></i>
                                            Columns</button>
                                        <div class="dt-filter-column-pembayaran-item">

                                        </div>
                                    </div>
                                </ul>

                                <a href="{{ route('downloadSprin') }}" class="ms-2 btn btn-outline-info">
                                    Export Excel
                                </a>

                            </div>
                            <br>

                            <table id="selesai" class="table" style="width:100%">
                                <thead class="headTable">
                                    <tr>
                                        {{-- <th><input type="checkbox" class="select-all-pembayaran"> All</th> --}}
                                        <th>No Sprin</th>
                                        <th>NRP</th>

                                        <th>Tabungan</th>
                                        <th>Nama Rekening</th>
                                        <th>Nama Bank</th>

                                        <th>No rekening</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                            </table>

                            <br>

                        </div>


                    </div>
                    <!-- endagus -->

                    <!-- <div class="tab-pane fade show" id="list-tab" role="tabpanel" aria-labelledby="list-tab-menu">

                                <h1 class="nameContent">List</h1>
                                <div id="tabone" class="searchAndImportWrapper">
                                 <input id="nosprin" class="searchInput" type="search" placeholder="Masukan No Sprin">
                                   <button id="nosprinsearch" class="btn btn-outline-success"> <ion-icon name="search"></ion-icon></button>
                                </div>



                                <div id="tabtwo" class="wrapperMainData">


                                    <div class="wrapperTable">
                                        <div style="display: flex;justify-content: end" class="dropdown">

                                            {{-- <a href="{{ route('downloadSprin') }}" class="ms-2 btn btn-outline-info">
                                        Export Excel
                                    </a> --}}

                                        </div>
                                        <br>

                                        <table id="list" class="table" style="width:100%">
                                            <thead class="headTable">
                                                <tr>
                                                    <th><input type="checkbox" class="select-all"> All</th>
                                                    <th>No Sprin</th>
                                                    <th>NRP</th>
                                                    <th>Nama</th>
                                                    <th>Pangkat</th>
                                                    <th>Kesatuan</th>
                                                    <th>Corps</th>
                                                </tr>
                                            </thead>

                                        </table>

                                        <br>




                                    </div>
                                </div>




                            </div> -->






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
    {{-- <script src="{{ url('assets/js/dataPrajurit.js') }}"></script> --}}
    <script src="{{ url('materialadmin/js/libs/toastr/toastr.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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





            selesai = $('#selesai').DataTable({
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
                        data: 'no_sprin',
                        name: 'sprin',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'sprin',
                        visible: true
                    },
                    {
                        data: 'nrp_formated',
                        name: 'NRP',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'NRP',
                        visible: true
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'nama',
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
                        data: 'narek',
                        name: 'narek',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'narek',
                        visible: true
                    },
                    {
                        data: 'nabank',
                        name: 'nabank',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'nabank',
                        visible: true
                    },
                    {
                        data: 'norek',
                        name: 'norek',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'norek',
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
                order: [
                    [2, 'desc']
                ]
            });
            // addColumnFilter(selesai, "pembayaran");



            pemtabel = $('#pemtabel').DataTable({
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
                        data: 'no_sprin',
                        name: 'sprin',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'sprin',
                        visible: true
                    },
                    {
                        data: 'nrp_formated',
                        name: 'NRP',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'NRP',
                        visible: true
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'nama',
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
                        data: 'narek',
                        name: 'narek',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'narek',
                        visible: true
                    },
                    {
                        data: 'nabank',
                        name: 'nabank',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'nabank',
                        visible: true
                    },
                    {
                        data: 'norek',
                        name: 'norek',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'norek',
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
                order: [
                    [2, 'desc']
                ]
            });
            addColumnFilter(pemtabel, "pembayaran");


            // agus

        });

        // $("#nosprinsearch").on('click', function(event) {

        //     getDetail($('#nosprin').val());
        //     $('#tabone').css('display', 'none');


        // });


        // function getDetail(ktm) {
        //     $('#tabtwo').css('display', 'block');

        //     console.log(ktm);
        //     list = $('#list').DataTable({
        //         processing: true,

        //         serverSide: true,
        //         ajax: "https://asiabytes.tech/baltab/seeDetailSprin/" + ktm,
        //         pageLength: 25,
        //         columns: [{
        //                 data: 'check',
        //                 name: 'check',
        //                 orderable: false,
        //                 searchable: false
        //             },
        //             {
        //                 data: 'no_sprin',
        //                 name: 'sprin',
        //                 defaultContent: "<i class='text-danger'>null</i>",
        //                 className: 'sprin',
        //                 visible: true
        //             },
        //             {
        //                 data: 'nrp_formated',
        //                 name: 'NRP',
        //                 defaultContent: "<i class='text-danger'>null</i>",
        //                 className: 'NRP',
        //                 visible: true
        //             },

        //             {
        //                 data: 'pangkat_uraian',
        //                 name: 'pangkat',
        //                 defaultContent: "<i class='text-danger'>null</i>",
        //                 className: 'pangkat',
        //                 visible: true
        //             },
        //             {
        //                 data: 'kesatuan_uraian',
        //                 name: 'kesatuan',
        //                 defaultContent: "<i class='text-danger'>null</i>",
        //                 className: 'kesatuan',
        //                 visible: true
        //             },
        //             {
        //                 data: 'corp_uraian',
        //                 name: 'corps',
        //                 defaultContent: "<i class='text-danger'>null</i>",
        //                 className: 'corps',
        //                 visible: true
        //             },




        //         ],
        //         order: [
        //             [2, 'desc']
        //         ]
        //     });

        //     // addColumnFilter(list,"list");
        // }

        // $('.select-all-pembayaran').on('click', function() {

        //     if ($(this).is(':checked')) {
        //         $('.check-pembayaran').prop('checked', true);
        //     } else {
        //         $('.check-pembayaran').prop('checked', false);
        //     }
        // });


        // $('.save-sprin').on('click', function() {
        //     if (!confirm("Tambahkan ke sprin?")) {
        //         return false;
        //     }

        //     var pengajuan_ids = [];
        //     $('.check-pengajuan:checked').each(function(k, d) {
        //         pengajuan_ids[k] = $(d).val();
        //     });

        //     var post_url = $(this).data('url');

        //     toastr.options = {
        //         "closeButton": true,
        //         "progressBar": false,
        //         "debug": false,
        //         "positionClass": 'toast-top-center',
        //         "showDuration": 330,
        //         "hideDuration": 330,
        //         "timeOut": 5000,
        //         "extendedTimeOut": 5000,
        //         "showEasing": 'swing',
        //         "hideEasing": 'swing',
        //         "showMethod": 'fadeIn',
        //         "hideMethod": 'slideUp',
        //         "onclick": null
        //     };

        //     if (pengajuan_ids.length) {
        //         $.ajax({
        //             url: post_url,
        //             type: 'post',
        //             data: {
        //                 pengajuan_ids: pengajuan_ids
        //             },
        //             dataType: 'json',
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             success: function(response) {

        //                 Swal.fire({
        //                     position: 'top-end',
        //                     icon: 'success',

        //                     title: 'Pengajuan yang dipilih telah dimasukkan kedalam sprin',
        //                     showConfirmButton: false,
        //                     timer: 3000
        //                 })
        //                 setTimeout(function() {
        //                     location.reload();

        //                 }, 3000);
        //             }
        //         });
        //     } else {
        //         Swal.fire({
        //             position: 'top-end',
        //             icon: 'error',
        //             title: 'Anda tidak memilih 1 pun pengajuan',
        //             showConfirmButton: false,
        //             timer: 1500
        //         })
        //     }
        // });
    </script>
    <script>
        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    </script>



@endsection
