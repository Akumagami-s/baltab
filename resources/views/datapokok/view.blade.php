@extends('layouts/main')

@section('content')

@if(isset($_GET['is_cari']) && $_GET['is_cari'] == 1 || $page == 'datapokok_cari')
    @include('datapokok/_cari')
@endif

<div class="row">
    <div class="col-xs-12">
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
        <div class="section-header">
            <h2 class="text-primary">Data Pokok Prajurit</h2>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-head">
                        <ul class="nav nav-tabs" data-toggle="tabs">
                            <li class="active"><a href="#hr">HR</a></li>
                            <li><a href="#pangkat">Pangkat</a></li>
                            <li><a href="#tabungan">Tabungan</a></li>
                            <li><a href="#status">Status</a></li>
                            @if($data->getPembayaran())
                                <li><a href="#pembayaran">Pembayaran</a></li>
                            @endif
                        </ul>
                    </div><!--end .card-head -->
                    <div class="card-body tab-content">
                        <!-- HR TAB -->
                        <div class="tab-pane active" id="hr">
                            <div class="row">
                                <div class="col-xs-12 col-lg-6">
                                    <table class="table table-striped">
                                        <tr>
                                            <td width="200" class="text-bold">NRP</td>
                                            <td>: {{ $data['nrp'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold">Nama</td>
                                            <td>: {{ $data['nama'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold">Tanggal Lahir</td>
                                            <td>: {{ $data->tg_lahir_formated() }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold">Pangkat</td>
                                            <td>: {!! $data->get_pangkat_uraian() !!}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold">Corp</td>
                                            <td>: {!! $data->get_corp_uraian() !!}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold">Kesatuan</td>
                                            <td>: {!! $data->get_kesatuan_uraian() !!}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold">Kotama</td>
                                            <td>: {!! $data->get_kotama_uraian() !!}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold">Pengangkatan</td>
                                            <td>: {{ $data->tg_pengangkatan_formated() }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold">Pensiun</td>
                                            <td>: {{ $data->tg_pensiun_formated() }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold">Tanggal Update</td>
                                            <td>: {{ $data->updated_at_formated() }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold">KPR 1</td>
                                            <td>: {{ $data['kpr1'] }} {{ strtolower($data['kpr1']) == 'p' || strtolower($data['kpr2']) == 'g' ? '('.\App\Models\DatapokokPembayaran::getSprinDateFormat($data['_id']).')' : '' }}</td>
                                        </tr>
                                    </table>
                                </div>  
                            </div>
                            
                        </div>

                        <!-- PANGKAT TAB -->
                        <div class="tab-pane" id="pangkat">
                            <div class="row">
                                <div class="col-xs-12 col-lg-6">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Pangkat</th>
                                                <th>Tahun</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tamtama / PNS Gol. I</td>
                                                <td>{{ $data->kenaikan_pangkat('tmt_1') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Bintara / PNS Gol. II</td>
                                                <td>{{ $data->kenaikan_pangkat('tmt_2') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pama / PNS Gol. III</td>
                                                <td>{{ $data->kenaikan_pangkat('tmt_3') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pamen / PNS Gol. IV</td>
                                                <td>{{ $data->kenaikan_pangkat('tmt_4') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pati</td>
                                                <td>{{ $data->kenaikan_pangkat('tmt_5') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- TABUNGAN TAB -->
                        <div class="tab-pane" id="tabungan">
                            <h4>{{ $data['nama'] }}/{{ $data['nrp'] }}</h4>
                            @if(!$tabungan)
                                <p>Tidak ada data.</p>
                            @else
                                <table class="table">
                                    @foreach($tabungan['potongans'] as $potongan)
                                        <tr>
                                            <td>{{ $potongan['keterangan'] }}</td>
                                            <td>{{ $potongan['period'] }}</td>
                                            <td class="text-right">{{ $potongan['bulan'] }} Bulan x</td>
                                            <td class="text-right">{{ $potongan['nilai'] }}</td>
                                            <td class="text-right is-rupiah">Rp {{ $potongan['nilai_akhir'] }}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="active">
                                        <td colspan="2">                                
                                            <strong>{{ $tabungan['periode_potongan'] }}</strong>
                                        </td>
                                        <td class="text-right">
                                            <strong>{{ $tabungan['bulan_potongan'] }} Bulan</strong>
                                        </td>
                                        <td></td>
                                        <td class="text-right is-rupiah">
                                            <strong>Rp {{ $tabungan['pokok_potongan'] }}</strong>
                                        </td>
                                    </tr>
                                    <tr class="active">
                                        <td colspan="4">
                                            <strong>Bunga</strong>
                                        </td>
                                        <td class="text-right is-rupiah">
                                            <strong>Rp {{ $tabungan['bunga_potongan'] }}</strong>
                                        </td>
                                    </tr>
                                    <tr class="warning">
                                        <td colspan="4">
                                            <strong>Total</strong>
                                        </td>
                                        <td class="text-right is-rupiah">
                                            <strong>Rp {{ $tabungan['total_potongan'] }}</strong>
                                        </td>
                                    </tr>
                                </table>
                            @endif

                            <div class="alert alert-warning">
                                <i class="fa fa-exclamation-circle"></i> Perhatian: Perhitungan diatas hanya merupakan simulasi yang menggunakan sistem pembulatan. <br>
                                Tingkat imbal hasil tabungan dari perhitungan simulasi tersebut bukanlah suatu jaminan, tetapi hanya merupakan indikasi berdasarkan rata-rata historis. <br>
                                Realisasi pengembalian tabungan tergantung pada kebijaksanaan pimpinan TNI-AD dalam penentuan pemotongan tabungan dan suku bunga.
                            </div>                          
                        </div>

                        <!-- STATUS TAB -->
                        <div class="tab-pane" id="status">
                            <div class="col-xs-12 col-md-6">
                                <table class="table table-striped">
                                    <tr>
                                        <td class="text-right text-bold">Status :</td>
                                        <td>{{ $data->status_pembayaran_msg() }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        @if($data->getPembayaran())
                        <?php $pembayaran = $data->getPembayaran(); ?>
                        <!-- PEMBAYARAN TAB -->
                        <div class="tab-pane" id="pembayaran">
                            <div class="row">
                                <div class="col-xs-12 col-lg-6">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td class="text-right text-bold">Jumlah Uang :</td>
                                                <td>{{ $pembayaran['jumlah'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-bold">Nama Bank :</td>
                                                <td>{{ $pembayaran['nama_bank'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-bold">No Rekening :</td>
                                                <td>{{ $pembayaran['no_rekening'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-bold">Atas Nama :</td>
                                                <td>{{ $pembayaran['atas_nama'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right text-bold">Tanggal :</td>
                                                <td>{{ isset($pembayaran['tanggal']) ? $pembayaran['tanggal'] : '-' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div><!--end .card-body -->
                </div><!--end .card -->

 
                <a href="{{ url('datapokok/edit/'.$data['_id']) }}" class="btn btn-md btn-primary"><i class="fa fa-edit"></i> Edit</a>
                @if(session('active_nav') == 'datapokok/cari')
                    <a href="{{ url('datapokok/cari') }}" class="btn btn-danger">Cancel</a>
                @else
                    <a href="{{ url('datapokok') }}" class="btn btn-danger">Cancel</a>
                @endif
                <div class="clearfix mb-20"></div>

                @if(App\Models\User::current()['email'] == 'superadmin')
                <button class="btn btn-warning lihat-detail-tabungan"><i class="fa fa-th-list"></i> LIHAT DETAIL TABUNGAN</button>
                <div class="card detail-tabungan hide mt-20">
                    <div class="card-body">
                        @if(!$tabungan)
                            Empty
                        @else
                            {!! $tabungan['html'] !!}
                        @endif
                    </div>
                </div>
                @endif

            </div><!--end .col -->
        </div>
    </div>
</div>
@endsection

@section('footer_script')
    <script type="text/javascript" src="{{ url('js/pengajuan.js') }}"></script>
@endsection