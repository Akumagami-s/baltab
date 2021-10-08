@extends('layouts/main')

@section('header_script')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/materialadmin/css/theme-default/libs/DataTables/jquery.dataTables.css">
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="section-header">
            <h2 class="text-primary">Korp</h2>
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
                
                <a href="{{ url('corp/create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</a>
                <div class="dataTables_wrapper">
                    <table id="corp-table" class="table table-striped">
                        <thead>
                            <tr>
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
            $('#corp-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('corp/data') !!}',
                pageLength: 25,
                columns: [
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