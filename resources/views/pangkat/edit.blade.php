@extends('layouts/main')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="section-header">
            <h2 class="text-primary">Edit Pangkat</h2>
        </div>
		<div class="card">
			<div class="card-body">
				@if(session('success'))
					<div class="alert alert-success">
						<strong>Sukses!</strong> {{ session('success') }}
					</div>
				@endif

				@if(session('error'))
					<div class="alert alert-danger">
						<strong>Gagal!</strong> {{ session('error') }}
					</div>
				@endif
				<form class="form" method="post" action="{{ url('pangkat/'.$data['_id']) }}">
					<div class="row">
						<div class="col-xs-12 col-md-6">
							{{ method_field('PUT') }}
							{{ csrf_field() }}
							<div class="form-group">
								<input id="kode" type="text" name="kode" class="form-control" value="{{ $data['kode'] }}">
								<label for="kode">Kode</label>
							</div>
							<div class="form-group">
								<input id="uraian" type="text" name="uraian" class="form-control" value="{{ $data['uraian'] }}">
								<label for="uraian">Uraian</label>
							</div>
						</div>
						<div class="col-xs-12">
							<button class="btn btn-primary">Simpan</button>
							<a href="{{ url('pangkat') }}" class="btn btn-danger">Batal</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection