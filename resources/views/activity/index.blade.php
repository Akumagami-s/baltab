@extends('layouts/main')

@section('header_script')
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/materialadmin/css/theme-default/libs/DataTables/jquery.dataTables.css">
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="section-header">
            <h2 class="text-primary">Activity Log</h2>
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
                
                <div class="dataTables_wrapper">
                    <table id="activity-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>User</th>
                                <th>Type</th>
                                <th>Model</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="log-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Activity Log</h4>
      </div>
    <div class="modal-body">
        <div class="card">
            <div class="card-head card-head-xs style-primary">
                <header>Before</header>
            </div><!--end .card-head -->
            <div class="card-body">
                <pre class="log-before"></pre>
            </div><!--end .card-body -->
        </div>
        <div class="card">
            <div class="card-head card-head-xs style-success">
                <header>After</header>
            </div><!--end .card-head -->
            <div class="card-body">
                <pre class="log-after"></pre>
            </div><!--end .card-body -->
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Tutup</button>
    </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('footer_script')
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#activity-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('activity/data') !!}',
                pageLength: 25,
                columns: [
                    { data: 'created_at_formated', name: 'created_at', defaultContent: "<i class='text-danger'>null</i>" },
                    { data: 'fullname', name: 'caused_id', defaultContent: "<i class='text-danger'>null</i>" },
                    { data: 'description', name: 'description', defaultContent: "<i class='text-danger'>null</i>" },
                    { data: 'model', name: 'model', defaultContent: "<i class='text-danger'>null</i>" },
                    { data: 'action', name: 'action', defaultContent: "<i class='text-danger'>null</i>" }
                ],
                order: [[0, 'desc']]
            });

            $('body').on('click', '.view-log', function(){
                var postUrl = $(this).data('action');

                $.ajax({
                    url: postUrl,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        $('.log-before').html(response.data.before);
                        $('.log-after').html(response.data.after);

                        $('#log-modal').modal('show');
                    }
                });
            });
        });
    </script>

@endsection