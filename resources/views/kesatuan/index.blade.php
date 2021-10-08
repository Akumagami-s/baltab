@extends('layouts/main')

@section('header_script')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/materialadmin/css/theme-default/libs/DataTables/jquery.dataTables.css">
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="section-header">
            <h2 class="text-primary">Kesatuan</h2>
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
                
                <a href="{{ url('kesatuan/create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</a>
                <div class="dataTables_wrapper">
                    <table id="kesatuan-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nopend</th>
                                <th>Kobri</th>
                                <th>Kosat</th>
                                <th>Nama Kesatuan</th>
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
            $('#kesatuan-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('kesatuan/data') !!}',
                pageLength: 25,
                columns: [
                    { data: 'nopend', name: 'nopend', defaultContent: "<i class='text-danger'>null</i>" },
                    { data: 'kobri', name: 'kobri', defaultContent: "<i class='text-danger'>null</i>" },
                    { data: 'kosat', name: 'kosat', defaultContent: "<i class='text-danger'>null</i>" },
                    { data: 'namsat', name: 'namsat', defaultContent: "<i class='text-danger'>null</i>" },
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