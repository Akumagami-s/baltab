{{-- @dd(Auth::user()->role) --}}
@extends('layouts.base')

@section('css')
<link rel="stylesheet" href="{{ url('assets/css/pengajuaneBaltab.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')

<style>
.pembungkus {
background-color: #fff;
box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
z-index: 10;
transition: 1s;
}
</style>
<div class="mainContent">
    <div class="container-fluid">
    @if (Auth::user()->role==0)
        <div class="wrapperContent">
            <div class="nav nav-tabs tabsButton" id="nav-tab" role="tablist">
                <button class="nav-link @if (empty($_GET['NRP'])){{'active'}} @endif" id="index-tab-menu" data-bs-toggle="tab" data-bs-target="#index-tab"
                        type="button" role="tab" aria-controls="index-tab" aria-selected="true">Index</button>
                @if (!empty($_GET['NRP']))
                <button class="nav-link @if (!empty($_GET['NRP'])){{'active'}} @endif" id="cari-tab-menu" data-bs-toggle="tab" data-bs-target="#cari-tab"
                    type="button" role="tab" aria-controls="cari-tab" aria-selected="true">Data Detail</button>
                @endif
            </div>
            @endif
            <div class="tab-content" id="nav-tabContent">
                @if (Auth::user()->role==0)
                <div class="tab-pane fade show @if(empty($_GET['NRP'])){{'active'}} @endif" id="index-tab" role="tabpanel" aria-labelledby="index-tab-menu">
                    <h1 class="nameContent">Data Pokok Prajurit</h1>
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
                                    <!-- <th>
                                        <input type="checkbox" class="select-all"> All
                                    </th> -->
                                    <th>No</th>
                                    <th>NRP</th>
                                    <th>Nama / NRP</th>
                                    <th>Pangkat</th>
                                    <th>Kesatuan</th>
                                    <th>Corp</th>
                                    {{-- <th>Pengangkatan</th> --}}
                                    <th>Tanggal lahir</th>
                                    <th>Action</th>

                                </tr>
                            </thead>

                        </table>

                        <br>
                        <div class="m-3">
                            {{-- <a class="btn btn-lg btn-success save-sprin" data-url="{{ route('addSprin') }}">Tambahkan
                                ke Sprin</a>
                            <a class="btn btn-lg btn-danger delete-pengajuan"
                                data-url="{{ route('deletePengajuan') }}"><i class="fa fa-trash-o"></i> HAPUS</a>--}}
                        </div>
                    </div>

                </div>
                @endif
                <div class="tab-pane fade show @if (!empty($_GET['NRP'])){{'active'}} @endif @if(Auth::user()->role!=0) active @endif" id="cari-tab" role="tabpanel" aria-labelledby="cari-tab-menu">
                    <h1 class="nameContent">Data Pokok Prajurit</h1>
                    @if (Auth::user()->role==0)
                    {{-- <div class="searchAndImportWrapper">
                        <input class="searchInput" id='ami' type="search" placeholder="Masukan NRP">
                        <button class="btn" onclick="cari()"><ion-icon name="search"></ion-icon></button>
                    </div> --}}
                    @endif
                    <div class="wrapperMainData" id='ama'>
                        @if(!Auth::user()->role==0||(!empty($_GET['NRP'])))
                            @include('A/ajax')
                        @endif
                    </div>
                    @if (!Auth::user()->role==1)
                    <script>
                        function cari() {
                            var a =document.getElementById('ami').value
                            fetch('/baltab/datapok?NRP='+a+'&mtb=f')
                          .then(response => response.text())
                          .then(data=>
                          document.getElementById('ama').innerHTML=data
                          );
                        }
                    </script>
                </div>
                @endif
            </div>
        </div>
        <!-- sa -->
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
                serverSide: true,
                scrollX:true,
                ajax: "https://asiabytes.tech/baltab/dataPokokTabel",
                pageLength: 25,
                columns: [
                    {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },

                    // {
                    //     data: 'check',
                    //     name: 'check',
                    //     orderable: false,
                    //     searchable: false
                    // },

                    {
                        data: 'nrp',
                        name: 'nrp',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'nrp',
                        visible: false,
                        searchable: true
                    },

                    {
                        data: 'uraian_nama',
                        name: 'nama',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'nama',
                        visible: true,
                        searchable: true
                    },
                    {
                        data: 'pangkat_uraian',
                        name: 'pangkat',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'pangkat',
                        visible: true
                    },
                    {
                        data: 'kesatuan_uraian',
                        name: 'kesatuan',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'kesatuan',
                        visible: true
                    },
                    {
                        data: 'corp_uraian',
                        name: 'corps',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'corps',
                        visible: true
                    },
                    // {
                    //     data: 'pengangkatan',
                    //     name: 'pengangkatan',
                    //     defaultContent: "<i class='text-danger'>null</i>",
                    //     className: 'pengangkatan',
                    //     visible: true
                    // },
                    {
                        data: 'tg_lahir',
                        name: 'tg_lahir',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'tg_lahir',
                        visible: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        defaultContent: "<i class='text-danger'>null</i>",
                        className: 'action',
                        visible: true,

                    },


                ],
                order: [
                    [2, 'desc']
                ]
            });
            addColumnFilter(dt_table);

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
                confirmButtonText: 'Ya tambahkan ke dalam sprin!',
                cancelButtonText: 'Batalkan!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {


                    var pengajuan_ids = [];
                    $('.check-pengajuan:checked').each(function(k, d) {
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
                        "timeOut": 5000,
                        "extendedTimeOut": 5000,
                        "showEasing": 'swing',
                        "hideEasing": 'swing',
                        "showMethod": 'fadeIn',
                        "hideMethod": 'slideUp',
                        "onclick": null
                    };

                    if (pengajuan_ids.length) {
                        $.ajax({
                            url: post_url,
                            type: 'post',
                            data: {
                                pengajuan_ids: pengajuan_ids
                            },
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                dt_table.ajax.reload();

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Pengajuan yang dipilih telah dimasukkan kedalam sprin',
                                    showConfirmButton: false,
                                    timer: 3000
                                })

                                setTimeout(function() {
                                    location.reload(true);

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

        $('.select-all').on('click', function() {
            console.log('ada');
            if ($(this).is(':checked')) {
                $('.check-pengajuan').prop('checked', true);
            } else {
                $('.check-pengajuan').prop('checked', false);
            }
        });



        $('.delete-pengajuan').on('click', function() {
            if (!confirm("Anda yakin akan menghapus pengajuan?")) {
                return false;
            }

            var pengajuan_ids = [];
            $('.check-pengajuan:checked').each(function(k, d) {
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
                "timeOut": 5000,
                "extendedTimeOut": 5000,
                "showEasing": 'swing',
                "hideEasing": 'swing',
                "showMethod": 'fadeIn',
                "hideMethod": 'slideUp',
                "onclick": null
            };

            if (pengajuan_ids.length) {
                $.ajax({
                    url: post_url,
                    type: 'post',
                    data: {
                        pengajuan_ids: pengajuan_ids
                    },
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        dt_table.ajax.reload();

                        toastr.success(response.message);
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
        });

        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e){
    $($.fn.dataTable.tables(true)).DataTable()
        .columns.adjust();
  });

</script>
@endsection


{{-- @extends('layouts.base')
@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/pengajuaneBaltab.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')

@if (!Auth::user()->role==1)
<div class="mainContent">
    <div class="container-fluid">
        <div class="wrapperContent">
            <h1 class="nameContent">Data Pokok Prajurit</h1>
            <div class="searchWrapper">
                <input class="searchInput" id="searchInput" type="search" placeholder="Masukan NRP">
                <ion-icon name="search" onclick="cari()">cari</ion-icon>
            </div>
        </div>
    </div>
</div>
@endif
<div class="wrapperMainData container" id='ama'>
    @if (Auth::user()->role==1)
    @include('A/ajax')
    @endif
</div>
@endsection

@section('js')
@if (!Auth::user()->role==1)
<!-- <script>
    function cari() {
     // alert('ads');
     // console.log('ada');
     var a =document.getElementById('ami').value
     fetch('/baltab/datapok?NRP='+a+'&mtb=f')
    .then(response => response.text())
    .then(data=>
     document.getElementById('ama').innerHTML=data
     );
    }
</script> -->
@endif
@endsection --}}
