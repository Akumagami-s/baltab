@extends('layouts/main')

@section('header_script')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/materialadmin/css/theme-default/libs/DataTables/jquery.dataTables.css">
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="section-header">
            <h2 class="text-primary">Satminkal</h2>
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
                
                <a href="{{ url('satminkal/create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</a>
                <div class="dataTables_wrapper">
                    <table id="satminkal-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kode Ktm</th>
                                <th>Kode</th>
                                <th>Uraian</th>
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
        $(function() {
            $('#satminkal-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('satminkal/data') !!}',
                pageLength: 25,
                columns: [
                    { data: 'kode_ktm', name: 'kode_ktm', defaultContent: "<i class='text-danger'>null</i>" },
                    { data: 'kode', name: 'kode', defaultContent: "<i class='text-danger'>null</i>" },
                    { data: 'uraian', name: 'uraian', defaultContent: "<i class='text-danger'>null</i>" },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [[0, 'asc']]
            });
        });
    </script>

@endsection