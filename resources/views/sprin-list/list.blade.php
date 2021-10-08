@extends('layouts/main')

@section('header_script')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/materialadmin/css/theme-default/libs/DataTables/jquery.dataTables.css">
    <link type="text/css" rel="stylesheet" href="{{ url('/') }}/materialadmin/css/theme-default/libs/toastr/toastr.css?1425466569" />
@endsection

@section('content')

@include('sprin-list/_cari_nosprin')

<div class="row">
    <div class="col-xs-12">
        <div class="section-header">
            <h2 class="text-primary">Data Pembayaran</h2>
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
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sprins as $sprin)
                            <tr>   
                                <td>{{ $sprin['no_sprin'] }}</td>                             
                                <td>{{ $sprin['nama'] }}</td>
                                <td>{{ $sprin->get_pangkat_uraian() }}</td>
                                <td>{{ $sprin->get_corp_uraian() }}</td>
                                <td>{{ $sprin['nrp'] }}</td>
                                <td>{{ $sprin->get_kesatuan_uraian() }}</td>
                                <td>{{ $sprin->pembayaran('bulan') }}</td>
                                <td>{{ $sprin->pembayaran('jumlah') }}</td>
                                <td>{{ $sprin->pembayaran('no_rekening') }}</td>
                                <td>{{ $sprin->pembayaran('nama_bank') }}</td>
                                <td>{{ $sprin->status_pembayaran_msg() }}</td>
                                <td>
                                    @if($sprin->selesai == true)
                                        <a href="{{ url('datapokok/view/'.$sprin['datapokok_id']) }}" class="btn btn-warning btn-xs" title="View"><i class="fa fa-eye"></i></a>
                                    @else
                                        <a href="{{ url('sprin/view-pembayaran/'.$sprin['_id']) }}" class="btn btn-warning btn-xs" title="View"><i class="fa fa-eye"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="nosprin-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Masukan No Sprin</h4>
      </div>
        <form class="form-horizontal form-nosprin" action="{{ url('sprin/tambah-pembayaran') }}" method="post">
          <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-xs-4 col-md-2">No Sprin</label>
                    <div class="col-xs-8 col-md-10">
                        <input type="text" name="no_sprin" class="form-control input-nosprin" required>
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
                // processing: true,
                // serverSide: false,
                // ajax: '{!! url('sprin-list/data-nosprin') !!}',
                // pageLength: 25,
                // columns: [
                // 	{
                //         data: 'check',
                //         name: 'check',
                //         orderable: false,
                //         searchable: false
                //     },
                //     { data: 'nama', name: 'nama', defaultContent: "<i class='text-danger'>null</i>", className: 'nama', visible: true },
                //     { data: 'pangkat_uraian', name: 'pangkat', defaultContent: "<i class='text-danger'>null</i>", className: 'pangkat', visible: true },
                //     { data: 'corp_uraian', name: 'corps', defaultContent: "<i class='text-danger'>null</i>", className: 'corps', visible: true },
                //     { data: 'nrp', name: 'nrp', defaultContent: "<i class='text-danger'>null</i>", className: 'nrp', visible: true },
                //     { data: 'kesatuan_uraian', name: 'kesatuan', defaultContent: "<i class='text-danger'>null</i>", className: 'kesatuan', visible: true },
                //     { data: 'jml_bulan', name: 'jml_bulan', defaultContent: "<i class='text-danger'>null</i>", className: 'jml_bulan', visible: true },
                //     { data: 'jml_uang', name: 'jml_uang', defaultContent: "<i class='text-danger'>null</i>", className: 'jml_uang', visible: true },
                //     { data: 'no_rek', name: 'no_rek', defaultContent: "<i class='text-danger'>null</i>", className: 'no_rek', visible: true },
                //     { data: 'nama_bank', name: 'nama_bank', defaultContent: "<i class='text-danger'>null</i>", className: 'nama_bank', visible: true },
                    
                //     {
                //         data: 'action',
                //         name: 'action',
                //         className: 'action',
                //         orderable: false,
                //         searchable: false,
                //         visible: true
                //     }
                // ],
                // order: [[2, 'desc']]
            });

            addColumnFilter(dt_table);
        });

        $('.delete-persetujuan').on('click', function(){
            if(!confirm("Anda yakin akan menghapus persetujuan?")){
                return false;
            }

            var persetujuan_ids = [];
            $('.check-persetujuan:checked').each(function(k, d){
                persetujuan_ids[k] = $(d).val();
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

            if(persetujuan_ids.length){
                $.ajax({
                    url: post_url,
                    type: 'post',
                    data: {persetujuan_ids: persetujuan_ids},
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
                $('.check-persetujuan').prop('checked', true);
            } else {
                $('.check-persetujuan').prop('checked', false);
            }
        });
    </script>

@endsection