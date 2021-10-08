<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="section-header">
            <h2 class="text-primary">Cari Persetujuan</h2>
        </div>
        @if(session('error'))
            <div class="alert alert-danger">
                <strong>Gagal!</strong> {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
        @endif
        <form class="form-horizontal" action="{{ url('sprin/persetujuan') }}" method="get">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label class="control-label col-md-1">Kotama</label>
                        <div class="col-md-2">                        
                            {{ Form::select('kotama', $list_kotama, $selected_kotama , ['class'=>'form-control is-select2','placeholder'=>'Pilih Kotama']) }}
                        </div>
                        <div class="col-md-1">                            
                            <button type="submit" class="btn btn-raised btn-default-light ink-reaction"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>

                </div><!--end .card-body -->
            </div><!--end .card -->
        </form>
    </div>
</div>