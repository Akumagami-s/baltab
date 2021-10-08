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
                        type="button" role="tab" aria-controls="index-tab" aria-selected="true">Data Pensiun
                        Lengkap</button>
                    <button class="nav-link" id="cari-tab-menu" data-bs-toggle="tab" data-bs-target="#cari-tab"
                        type="button" role="tab" aria-controls="cari-tab" aria-selected="true">Data Tidak Lengkap</button>

                    <button class="nav-link" id="bulanan-tab-menu" data-bs-toggle="tab" data-bs-target="#bulanan-tab"
                        type="button" role="tab" aria-controls="bulanan-tab" aria-selected="true">Profiling
                        Perbulan</button>
                </div>

                <div class="tab-content" id="nav-tabContent">



                    <div class="tab-pane fade show active" id="index-tab" role="tabpanel" aria-labelledby="index-tab-menu">

                        <h1 class="nameContent"> Data Pensiun Lengkap</h1>

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
                                <a href="{{ route('exportDataProfiling', ['type' => 1]) }}"
                                    class="ms-2 btn btn-outline-success">Export Excel</a>

                            </div>
                            <br>

                            <table id="profilingDataLengkap" class="table" style="width:100%">
                                <thead class="headTable">
                                    <tr>
                                        <th>No</th>
                                        <th><input type="checkbox" class="select-all-lengkap"> All</th>


                                        <th>Nama / NRP</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Tanggal Pensiun</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>

                            </table>

                            <br>
                            <div class="m-3">

                                <a class="btn btn-lg btn-success save-sprin"
                                    data-url="{{ route('addPengajuan') }}">Masukkan ke pengajuan !</a>
                            </div>
                            <br>

                        </div>

                    </div>

                    <div class="tab-pane fade show" id="cari-tab" role="tabpanel" aria-labelledby="cari-tab-menu">

                        <h1 class="nameContent">Data Pensiun Tidak Lengkap</h1>


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
                                <a href="{{ route('exportDataProfiling', ['type' => 0]) }}"
                                    class="ms-2 btn btn-outline-success">Export Excel</a>


                            </div>
                            <br>

                            <table id="profilingDataBiasa" class="table" style="width:100%">
                                <thead class="headTable">
                                    <tr>
                                        {{-- <th><input type="checkbox" class="select-all-biasa"> All</th> --}}
                                        <th>No</th>

                                        <th>Nama / NRP</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Tanggal Pensiun</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>

                            </table>

                            <br>

                        </div>


                    </div>



                    <div class="tab-pane fade show" id="bulanan-tab" role="tabpanel" aria-labelledby="bulanan-tab-menu">

                        <h1 class="nameContent">Profiling Bulanan </h1>

                        <div class="w-50 m-auto">

                            <form action="{{ route('profilingbulan') }}" method="post">

                                @csrf
                                <input onkeypress='validate(event)' name="tahun" placeholder="TAHUN" type="text"
                                    maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control col-6" required>
                                <br>
                                <input onkeypress='validate(event)' name="bulan" placeholder="BULAN" type="text"
                                    maxlength="2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control col-6" required>
                                <br>

                                <select name="type" id="" class="form-control" required>
                                    <option value="" selected>Pilih type</option>
                                    <option value="1">Data Lengkap</option>
                                    <option value="0">Data Tidak Lengkap</option>

                                </select>
                                <br>
                                <center> <button class="btn btn-outline-info">Download bulan itu</button></center>
                            </form>

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
    {{-- <script src="{{ url('assets/js/dataPrajurit.js') }}"></script> --}}
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
            dt_table = $('#profilingDataLengkap').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                ajax: "{{ route('profilingLengkap') }}",
                pageLength: 25,
                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'check',
                        name: 'check',
                        orderable: false,
                        searchable: false
                    },



                    {
                        data: 'nama',
                        name: 'nama',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'nama',
                        visible: true
                    },
                    {
                        data: 'tg_lahir',
                        name: 'tg_lahir',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'tg_lahir',
                        visible: true
                    },
                    {
                        data: 'tgl_pensiun',
                        name: 'tgl_pensiun',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'tgl_pensiun',
                        visible: true
                    },

                    {
                        data: 'action',
                        name: 'action',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'action',
                        visible: true
                    },



                ],
                order: [
                    [2, 'desc']
                ]
            });
            addColumnFilter(dt_table, "persetujuan");




            pemtabel = $('#profilingDataBiasa').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                ajax: "{{ route('profilingBiasa') }}",
                pageLength: 25,
                columns: [

                    // {
                    //         data: 'check',
                    //         name: 'check',
                    //         orderable: false,
                    //         searchable: false

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    //     },

                    {
                        data: 'nama',
                        name: 'nama',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'nama',
                        visible: true
                    },
                    {
                        data: 'tg_lahir',
                        name: 'tg_lahir',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'tg_lahir',
                        visible: true
                    },
                    {
                        data: 'tgl_pensiun',
                        name: 'tgl_pensiun',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'tgl_pensiun',
                        visible: true
                    },


                    {
                        data: 'action',
                        name: 'action',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'action',
                        visible: true
                    },



                ],
                order: [
                    [2, 'desc']
                ]
            });
            addColumnFilter(pemtabel, "pembayaran");


        });


        $('.save-sprin').on('click', function() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-outline-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Apa kamu yakin ?',
                text: "Kamu tidak akan bisa mengembalikan ini !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya tambahkan ke dalam Pengajuan!',
                cancelButtonText: 'Batalkan!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {


                    var pengajuan_ids = [];
                    $('.check-profilinglengkap:checked').each(function(k, d) {
                        pengajuan_ids[k] = $(d).val();
                    });

                    var post_url = $(this).data('url');


                    if (pengajuan_ids.length) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: post_url,
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                pengajuan_ids: pengajuan_ids,

                            },
                            // dataType: 'json',

                            success: function(response) {
                                dt_table.ajax.reload();

                                Swal.fire({
                                    // position: 'top-end',
                                    icon: 'success',
                                    title: 'Data yang dipilih telah dimasukkan ke dalam pengajuan',
                                    showConfirmButton: false,
                                    timer: 500
                                })


                            }
                        });
                    } else {
                        Swal.fire({
                            // position: 'top-end',
                            icon: 'error',
                            title: 'Anda tidak memilih 1 pun data',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }


                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'data anda aman :)',
                        'error'
                    )
                }
            })


        });












        $('.select-all-biasa').on('click', function() {

            if ($(this).is(':checked')) {
                $('.check-profilingbiasa').prop('checked', true);
            } else {
                $('.check-profilingbiasa').prop('checked', false);
            }
        });




        $('.select-all-lengkap').on('click', function() {

            if ($(this).is(':checked')) {
                $('.check-profilinglengkap').prop('checked', true);
            } else {
                $('.check-profilinglengkap').prop('checked', false);
            }
        });


        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

        function validate(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
                // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    </script>




@endsection
