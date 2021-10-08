@extends('layouts/main')

@section('header_script')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/materialadmin/css/theme-default/libs/DataTables/jquery.dataTables.css">
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="section-header">
            <h2 class="text-primary">Anggota</h2>
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
                
                <a href="{{ url('anggota/create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</a>
                <div class="dataTables_wrapper">
                    <table id="anggota-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Username</th>
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
            $('#anggota-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('anggota/data') !!}',
                pageLength: 25,
                columns: [
                    { data: 'fullname', name: 'fullname', defaultContent: "<i class='text-danger'>null</i>" },
                    { data: 'email', name: 'email', defaultContent: "<i class='text-danger'>null</i>" },
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