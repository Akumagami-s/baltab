@extends('layouts/main')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="section-header">
            <h2 class="text-primary">Bunga</h2>
        </div>
        <div class="card">
            <div class="card-body">
                <h3>Besaran Bunga Baru</h3>
                <form class="form" method="post" action="{{ url('bunga/generate') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <select name="from_month" class="form-control" required>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <label>Bulan</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select name="from_year" class="form-control" required>
                                    @for($i=date('Y');$i>=1986;$i--)
                                        <option>{{ $i }}</option>
                                    @endfor
                                </select>
                                <label>Tahun</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" name="type" value="value">
                                <input type="number" name="value" class="form-control" step="any" placeholder=0 required>
                                <label>Jumlah (%)</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button class="btn btn-primary btn-md">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <table  id="datapokok" data-source="{{ url('datapokok/pagination') }}" class="table table-striped  order-column">
                    <thead>
                        <th><h3>Periode</h3></th>
                        <th><h3>Jumlah</h3></th>
                        <th><h3>Aksi</h3></th>
                    </thead>
                    
                    <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{ $data->period_range() }}</td>
                                <td>{{ $data['value'] }} %</td>
                                <td>
                                    <a href="{{ url('bunga/remove/'.$data['_id']) }}" class="btn btn-xs btn-danger" onclick="return confirm('Apa anda yakin akan menghapus?')"><i class="fa fa-remove"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $datas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection