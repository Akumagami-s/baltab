@extends('layouts/main')

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="section-header">
            <h2 class="text-primary">Tambah Anggota</h2>
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
				<form class="form" method="post" action="{{ url('anggota') }}">
					<div class="row">
						<div class="col-xs-12 col-md-6">
							{{ csrf_field() }}
							<div class="form-group">
								<input id="fullname" type="text" name="fullname" class="form-control" value="{{ old('fullname','') }}">
								<label for="fullname">Nama Lengkap *</label>
							</div>
							<div class="form-group">
								<input id="email" type="text" name="email" class="form-control" value="{{ old('email','') }}">
								<label for="email">Username *</label>
							</div>
							<div class="form-group">
								<input id="password" type="password" name="password" class="form-control" value="{{ old('password','') }}">
								<label for="password">Password *</label>
							</div>
						</div>
						<div class="col-xs-12">
							<button class="btn btn-primary">Simpan</button>
							<a href="{{ url('anggota','') }}" class="btn btn-danger">Batal</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection