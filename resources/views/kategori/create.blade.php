@extends('layouts/main')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="section-header">
            <h2 class="text-primary">Tambah Kategori</h2>
        </div>
		<div class="card">
			<div class="card-body">
				<form class="form" method="post" action="{{ url('kategori') }}">
					<div class="row">
						<div class="col-xs-12 col-md-6">
							{{ csrf_field() }}
							<div class="form-group">
								<input id="kode" type="text" name="kode" class="form-control" value="{{ old('kode','') }}">
								<label for="kode">Kode *</label>
							</div>
							<div class="form-group">
								<input id="uraian" type="text" name="uraian" class="form-control" value="{{ old('uraian','') }}">
								<label for="uraian">Uraian *</label>
							</div>
						</div>
						<div class="col-xs-12">
							<button class="btn btn-primary">Simpan</button>
							<a href="{{ url('kategori','') }}" class="btn btn-danger">Batal</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection