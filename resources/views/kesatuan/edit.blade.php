@extends('layouts/main')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="section-header">
            <h2 class="text-primary">Edit Kesatuan</h2>
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
				<form class="form" method="post" action="{{ url('kesatuan/'.$data['_id']) }}">
					<div class="row">
						<div class="col-xs-12 col-md-6">
							{{ csrf_field() }}
							{{ method_field('PUT') }}
							<div class="form-group">
								<input id="nopend" type="text" name="nopend" class="form-control" value="{{ $data['nopend'] }}">
								<label for="nopend">Nopend *</label>
							</div>
							<div class="form-group">
								<input id="kobri" type="text" name="kobri" class="form-control" value="{{ $data['kobri'] }}">
								<label for="kobri">Kobri *</label>
							</div>
							<div class="form-group">
								<input id="kosat" type="text" name="kosat" class="form-control" value="{{ $data['kosat'] }}">
								<label for="kosat">Kosat *</label>
							</div>
							<div class="form-group">
								<input id="kpd" type="text" name="kpd" class="form-control" value="{{ $data['kpd'] }}">
								<label for="kpd">Kpd *</label>
							</div>
							<div class="form-group">
								<input id="namsat" type="text" name="namsat" class="form-control" value="{{ $data['namsat'] }}">
								<label for="namsat">Namsat *</label>
							</div>
							<div class="form-group">
								<input id="lokasi" type="text" name="lokasi" class="form-control" value="{{ $data['lokasi'] }}">
								<label for="lokasi">Lokasi *</label>
							</div>
							<div class="form-group">
								<input id="kota" type="text" name="kota" class="form-control" value="{{ $data['kota'] }}">
								<label for="kota">Kota *</label>
							</div>
							<div class="form-group di">
								<input id="di" type="text" name="di" class="form-control" value="{{ $data['di'] }}">
								<label for="di">Di *</label>
							</div>
							<div class="form-group">
								<input id="ku_kotama" type="text" name="ku_kotama" class="form-control" value="{{ $data['ku_kotama'] }}">
								<label for="ku_kotama">Ku Kotama *</label>
							</div>
						</div>
						<div class="col-xs-12">
							<button class="btn btn-primary">Simpan</button>
							<a href="{{ url('kesatuan') }}" class="btn btn-danger">Batal</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection