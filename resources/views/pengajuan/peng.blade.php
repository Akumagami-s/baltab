@extends('layouts.base')

@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/pengajuaneBaltab.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrapdatatables.min.css') }}">
@endsection
@section('content')

    <div class="mainContent">
        <div class="container-fluid">
            <div class="wrapperContent">
                <div class="nav nav-tabs tabsButton" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="index-tab-menu" data-bs-toggle="tab" data-bs-target="#index-tab"
                        type="button" role="tab" aria-controls="index-tab" aria-selected="true">Index</button>
                    <button class="nav-link" id="cari-tab-menu" data-bs-toggle="tab" data-bs-target="#cari-tab"
                        type="button" role="tab" aria-controls="cari-tab" aria-selected="true">Cari</button>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="index-tab" role="tabpanel" aria-labelledby="index-tab-menu">
                        <h1 class="nameContent">Pengajuan Data Prajurit</h1>
                        <div class="wrapperTable">
                            <div style="display: flex;justify-content: end" class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Filter
                                </button>
                                <ul class="dropdown-menu p-2" aria-labelledby="dropdownMenuButton1">
                                    <div class="dt-filter-column">
                                        <button class="btn btn-md dt-toggle-column"><i class="fa fa-filter"></i>
                                            Columns</button>
                                        <div class="dt-filter-column-item">

                                        </div>
                                    </div>
                                </ul>
                            </div>
                            <br>

                            <table id="tablePokokPrajurit" class="table" style="width:100%">
                                <thead class="headTable">
                                    <tr>
                                        <th>No</th>
                                        <th><input type="checkbox" class="select-all"> All</th>
                                        <th>NRP</th>
                                        <th>Nama</th>
                                        <th>Pangkat</th>
                                        <th>Kesatuan</th>
                                        {{-- <th>Corp</th> --}}
                                        {{-- <th>Pengangkatan</th> --}}
                                        <th>Tanggal lahir</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                            </table>

                            <br>
                            <div class="m-3">
                                <a class="btn btn-lg btn-success save-sprin"
                                    data-url="{{ route('addNoSprin') }}">Tambahkan No Sprin</a>
                                <a class="btn btn-lg btn-danger delete-pengajuan"
                                    data-url="{{ route('deletePengajuan') }}"><i class="fa fa-trash-o"></i> HAPUS</a>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade show" id="cari-tab" role="tabpanel" aria-labelledby="cari-tab-menu">

                        <h1 class="nameContent">Pengajuan Data Prajurit</h1>

                        <div class="searchAndImportWrapper">
                            <input class="searchInput" id='ami' type="search" placeholder="Masukan NRP">
                            <button class="btn" onclick="cari()">

                                <ion-icon name="search"></ion-icon>
                            </button>
                        </div>

                        <div class="wrapperMainData" id='ama'>
                        </div>
                        <script>
                            function cari() {

                                var a = document.getElementById('ami').value
                                fetch('/baltab/datapok?NRP=' + a + '&mtb=f')
                                    .then(response => response.text())
                                    .then(data =>
                                        document.getElementById('ama').innerHTML = data
                                    );
                            }
                        </script>

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

    <script type="text/javascript">
        function addColumnFilter(dt_table) {
            var columns = dt_table.settings().init().columns;

            var html = '';
            $.each(columns, function(k, d) {
                html += '<input class="dt-filter-column-checkbox" type="checkbox" name="filterColumn[]" value=".' +
                    d.className + '"' + (d.visible == true ? "checked" : "") + '> <label>' + d.className +
                    '</label><br>';
            });

            $('.dt-filter-column-item').html(html);

            $('.dt-filter-column').insertAfter('#dynamic-table_filter');

            $('.dt-filter-column-checkbox').on('change', function() {
                $('.dt-filter-column-checkbox').each(function(k, d) {
                    if ($(d).is(':checked')) {
                        dt_table.column($(d).val()).visible(true);
                    } else {
                        dt_table.column($(d).val()).visible(false);
                    }
                });
            });

            $('.dt-toggle-column').on('click', function() {
                $('.dt-filter-column-item').toggle();
            });
        }



        $(document).ready(function() {
            dt_table = $('#tablePokokPrajurit').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                ajax: "https://asiabytes.tech/baltab/dataPengajuan",
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
                        data: 'nrp_formated',

                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'NRP',
                        visible: true
                    },
                    {
                        data: 'nama',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'nama',
                        visible: true
                    },
                    {
                        data: 'pangkat_uraian',

                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'pangkat',
                        visible: true
                    },
                    {
                        data: 'kesatuan_uraian',

                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'kesatuan',
                        visible: true
                    },
                    // {
                    //     data: 'corp_uraian',

                    //     defaultContent: "<i class='text-danger'>null</i>",
                    //     className: 'corps',
                    //     visible: true
                    // },
                    // {
                    //     data: 'pengangkatan',

                    //     defaultContent: "<i class='text-danger'>null</i>",
                    //     className: 'pengangkatan',
                    //     visible: true
                    // },
                    {
                        data: 'tg_lahir',

                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'tg_lahir',
                        visible: true
                    },
                    {
                        data: 'action',

                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'action',
                        visible: true
                    },


                ],
                order: [
                    [2, 'desc']
                ]
            });
            addColumnFilter(dt_table);

        });





        $('.save-sprin').on('click', function() {

            var nosprins = "";

            Swal.fire({
                title: 'Masukkan no Sprinnya ',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Tambahkan !',
                showLoaderOnConfirm: true,
                preConfirm: (nosprin) => {
                    nosprins = nosprin;
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {


                if (result.isConfirmed) {

                    var pengajuan_ids = [];
                    $('.check-pengajuan:checked').each(function(k, d) {
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

                                pengajuan_ids: pengajuan_ids,
                                nosprin: nosprins
                            },

                            dataType: 'json',


                            beforeSend: function() {
                                swal.fire({
                                    html: '<h5>Loading...</h5>',
                                    showConfirmButton: false,
                                    onRender: function() {

                                        $('.swal2-content').prepend(sweet_loader);
                                    }
                                });
                            },
                            success: function(response) {
                                dt_table.ajax.reload();
                                $msg = "";

                                for (let i = 0; i < response.err.length + response.succ.length; i++) {

                                    if (response.err[i] != null) {
                                    var element = response.err[i];
                                    $msg += '<div class="alert alert-danger" role="alert">'+element+'</div>';
                                    } else {
                                        var element = response.succ[i];
                                    $msg += '<div class="alert alert-success" role="alert">'+element+'</div>';

                                    }

                                }
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'info',
                                    title: 'Pengajuan yang dipilih telah diproses !',
                                    html:$msg,
                                    showConfirmButton: true,

                                })

                            }
                        });
                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Anda tidak memilih 1 pun pengajuan',
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
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }




            })

        });


        $('.delete-pengajuan').on('click', function() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Apakah kamu yakin ?',
                text: "Kamu tidak akan bisa mengembalikan ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var pengajuan_ids = [];
                    $('.check-pengajuan:checked').each(function(k, d) {
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
                            type: 'post',
                            data: {

                                pengajuan_ids: pengajuan_ids,

                            },
                            dataType: 'json',

                            success: function(response) {
                                dt_table.ajax.reload();

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Pengajuan yang dipilih telah didelete',
                                    showConfirmButton: false,
                                    timer: 3000
                                })

                                setTimeout(function() {
                                    location.reload();

                                }, 3000);
                            }
                        });
                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Anda tidak memilih 1 pun pengajuan',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }




                } else if (

                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'pengajuan terdelete !',
                        'error'
                    )
                }
            })

        });

        $('.select-all').on('click', function() {
            console.log('ada');
            if ($(this).is(':checked')) {
                $('.check-pengajuan').prop('checked', true);
            } else {
                $('.check-pengajuan').prop('checked', false);
            }
        });
    </script>



@endsection
