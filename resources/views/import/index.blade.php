@extends('layouts/main')

@section('content')
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="section-header">
            <h2 class="text-primary">Import CSV</h2>
        </div>
        @if(session('error'))
            <div class="alert alert-danger">
                <strong>Gagal!</strong> {{ session('error') }}
            </div>
        @endif
        <form class="form-inline" action="{{ url('import/save') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-body">
                    <div class="form-group floating-label">
                        <input type="file" name="new_data" class="form-control"></input>
                        @if ($errors->has('new_data'))
                            <span class="text-danger">{{ $errors->first('new_data') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-raised btn-default-light ink-reaction"><i class="fa fa-download"></i> Import</button>
                </div><!--end .card-body -->
            </div><!--end .card -->
        </form>
    </div>
</div>
@endsection