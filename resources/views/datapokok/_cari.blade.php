<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="section-header">
            @if($page == 'pengajuan_input')
                <h2 class="text-primary">Pencarian Data Prajurit</h2>
            @else
                <h2 class="text-primary">Pencarian Data Pokok Prajurit</h2>
            @endif
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
        <form class="form-inline" action="{{ $page == 'pengajuan_input' ? url('pengajuan/input') : url('datapokok/cari') }}" method="post">
            {{ csrf_field() }}

            <input type="hidden" name="nav" value="{{ $page == 'pengajuan_input' ? 'pengajuan/input' : 'datapokok/cari' }}">

            <div class="card">
                <div class="card-body">
                    <div class="form-group floating-label">
                        <input type="text" class="form-control" id="nrp" name="nrp">
                        <label for="nrp">NRP</label>
                    </div>

                    <button type="submit" class="btn btn-raised btn-default-light ink-reaction"><i class="fa fa-search"></i> Cari</button>
                </div><!--end .card-body -->
            </div><!--end .card -->
        </form>
    </div>
</div>