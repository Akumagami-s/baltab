@if (empty($data->uang->original['message']))
{{-- @dump($status) --}}
{{-- @dump($status['ada'],$status['kelengkapan']) --}}
@if($status['ada']!=$status['kelengkapan'])
<div class="alert alert-danger alert-lg text-center" role="alert">
    Data Belum Lengkap Harap Lengkapi Data Terlebih Dahulu
</div>
<br>
@endif

<div class="wrapperData">

    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-rh" data-bs-toggle="tab" data-bs-target="#nav-riwayathidup"
            type="button" role="tab" aria-controls="nav-riwayathidup" aria-selected="true">
            RH
        </button>

        <button class="nav-link" id="nav-pangkat-tab" data-bs-toggle="tab" data-bs-target="#nav-pangkat" type="button"
            role="tab" aria-controls="nav-pangkat" aria-selected="false">
            Pangkat
        </button>

        <button class="nav-link" id="nav-tabungan-tab" data-bs-toggle="tab" data-bs-target="#nav-tabungan" type="button"
            role="tab" aria-controls="nav-tabungan" aria-selected="false">
            Tabungan
        </button>

        <button class="nav-link" id="nav-status-tab" data-bs-toggle="tab" data-bs-target="#nav-status" type="button"
            role="tab" aria-controls="nav-status" aria-selected="false">
            Status
        </button>

        <button class="nav-link" id="nav-pembayaran-tab" data-bs-toggle="tab" data-bs-target="#nav-pembayaran"
            type="button" role="tab" aria-controls="nav-pembayaran" aria-selected="false">
            Pembayaran
        </button>

    </div>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-riwayathidup" role="tabpanel" aria-labelledby="nav-rh">
            <div class="d-flex dataWrapper">
                <div class="imgProfil">

                    @if (!is_null(DB::connection('login')->table('users')->where('nrp',$data->nrp)->first()->thumb))
                    <img src="{{DB::connection('login')->table('users')->where('nrp',$data->nrp)->first()->thumb}}" alt="" style="width: 200px;
                    height: 200px;
                    border-radius: 50%;min-width:200px;min-height:200px;max-width:200px;max-height:200px;" class="mt-2">
                    @else
                    <img src="https://www.pngkey.com/png/full/115-1150152_default-profile-picture-avatar-png-green.png" alt="" style="min-width: 150px;
                    max-width: 200px;" class="mt-2">
                    @endif
                </div>
                <div class=" wrapperTableInfoData d-flex">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>NRP</td>
                                <td>: <span class="value_nrp"><?=$data->nrp?></span></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>: <span class="value_name">
                                        {{$data->gelar_dpn}} {{$data->nama}} {{$data->gelar_blk}}
                                    </span></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>: <span
                                        class="value_date">@if($data->tg_lahir!=null)<?=date('d F Y', strtotime($data->tg_lahir));?>
                                        @endif</span></td>
                            </tr>
                            <tr>
                                <td>Pangkat</td>
                                <td>: <span class="value_grade">
                                        @if($data->pangkat!=null)
                                        {{DB::connection('login')->table('data_master_pangkat')->where('kode',$data->pangkat)->first()->uraian}}
                                        @endif
                                    </span></td>
                            </tr>
                            <tr>
                                <td>Corp</td>
                                <td>: <span class="value_corp">
                                        @if($data->corps!=null)
                                        {{DB::connection('login')->table('data_master_corp')->where('kode',$data->corps)->first()->uraian}}
                                    </span>
                                </td>
                                @endif
                            </tr>
                            <tr>
                                <td>Kesatuan</td>
                                <td>: <span class="value_kesatuan">
                                        @if($data->kesatuan!=null)
                                        <?php $poin=DB::connection('login')->table('data_master_kesatuan')->where('kosat',$data->kesatuan)->first() ?>
                                            @if($poin!=null)
                                            {{$poin->namsat}}
                                            @else
                                            {{$data->kesatuan}}
                                            @endif
                                        @endif
                                    </span></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Kotama</td>
                                <td>: <span class="value_kotama">
                                        @if($data->kd_ktm!=null)
                                        {{DB::connection('login')->table('data_master_kotama')->where('kode',$data->kd_ktm)->first()->uraian}}
                                        @endif
                                    </span></td>
                            </tr>
                            <tr>
                                <td>Pengangkatan</td>
                                <td>: <span class="value_datePengangkatan">@if($data->tmt_pkt!=null)
                                        <?=date('d F Y', strtotime($data->tmt_pkt));?> @endif</span></td>
                            </tr>
                            <tr>
                                <td>Pensiun</td>
                                <td>: <span class="value_pensiun">@if($data->tmt_henti!=null)
                                        <?=date('d F Y', strtotime($data->tmt_henti));?> @endif</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-pangkat" role="tabpanel" aria-labelledby="nav-pangkat-tab">

            <div class="d-flex dataWrapper">
                <div class="wrapperTableInfoData fullWidth d-flex">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Pangkat</td>
                                <td>: <span class="value_tahun">@if($data->tmt_1!=null)
                                        <?=date('d F Y', strtotime($data->tmt_1));?> @endif</span></td>
                            </tr>
                            <tr>
                                <td>Tamtama/PNS Gol.I</td>
                                <td>: <span class="value_tamtama">@if($data->tmt_1!=null)
                                        <?=date('d F Y', strtotime($data->tmt_1));?> @endif</span></td>
                            </tr>
                            <tr>
                                <td>Bintara/PNS Gol.II</td>
                                <td>: <span class="value_date">@if($data->tmt_2!=null)
                                        <?=date('d F Y', strtotime($data->tmt_2));?> @endif</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Pama/PNS Gol.III</td>
                                <td>: <span class="value_date">@if($data->tmt_3!=null)
                                        <?=date('d F Y', strtotime($data->tmt_3));?> @endif</span></td>
                            </tr>
                            <tr>
                                <td>Pamen/PNS Gol.IV</td>
                                <td>: <span class="value_date">@if($data->tmt_4!=null)
                                        <?=date('d F Y', strtotime($data->tmt_4));?> @endif</span></td>
                            </tr>
                            <tr>
                                <td>Pati</td>
                                <td>: <span class="value_pati">@if($data->tmt_5!=null)
                                        <?=date('d F Y', strtotime($data->tmt_5));?> @endif</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="nav-tabungan" role="tabpanel" aria-labelledby="nav-tabungan-tab">

            <div class="d-flex dataWrapper">
                <div class="wrapperTableInfoData fullWidth">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td><?=($data->nama)?>/<?=$data->nrp?></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->uang['perhitungan'] as $key => $value)

                            <tr>
                                <td style="text-align: center;">
                                    @if ($value['pangkat']=='*')
                                    <?='index ='.$value['potongan'][2]?>
                                    @else
                                    <?=($value['pangkat'])?>
                                    @endif
                                </td>
                                <td style="text-align: center;">: <span
                                        class="value_date"><?=date('d F Y', strtotime('-90 month', strtotime($value['potongan'][1])))?>
                                        s.d <?=date('d F Y', strtotime($value['potongan'][1]))?> </span></td>
                                <td style="text-align: center;"><?=$value['bulan']?> Bulan X <span class="bunga">
                                        <?=number_format($value['potongan'][2], 2, ',', '.')?></span></td>
                                <td style="text-align: center;"> = Rp <span
                                        class="total"><?=number_format($value['total_period'], 2, ',', '.')?></span>
                                </td>
                            </tr>
                            @endforeach

                            <tr class="totalBunga" style="text-align: center;">
                                <td>Bunga</td>
                                <td></td>
                                <td></td>
                                <td style="text-align: center;"> = Rp <span
                                        class="total"><?=number_format($data->uang['bunga'], 2, ',', '.')?></span></td>
                            </tr>
                            <tr class="totalKeseluruhan" style="text-align: center;">
                                <td><strong>Total</strong></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: center;"> = <strong>Rp <span class="total">
                                            <?=number_format($data->uang['total'], 2, ',', '.')?>
                                        </span></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="notice d-flex">
                        <p>Perhatian : Perhitungan diatas hanya meruapakan simulasi yang menggunakan sistem Perbulatan.
                            Tingkat imbal hasil tabungan dari perhitungan simulasi tersebut bukanlah suatu jaminan,
                            tetapi hanya merupakan indikasi berdasarkan rata-rata historis. Realisasi pengembalian
                            tabungan tergantung pada kebijaksanaan pimpinan TNI-AD dalam penentuan pemotongan tabungan
                            dan suku bunga.</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="nav-status" role="tabpanel" aria-labelledby="nav-status-tab">

            <div class="d-flex dataWrapper">
                <div class="wrapperTableInfoData fullWidth">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td>: <span class="value_proses">

                                        @php
                                        $pon=DB::table('datapokok_pembayaran')->where('datapokok_id',$data->_id)->first();
                                        // dd($pon);
                                        $pin=[0=>'belum diajukan',1=>'Pengajuan',2=>'Menunggu Persetujuan',3=>'Proses
                                        Pencairan',4=>'Sudah Dibayarkan'];
                                        @endphp
                                        @if(empty($pon))
                                        @foreach ($pin as $key=>$item)
                                        @if ($data->status==$key)
                                        <?=$item?>
                                        @endif
                                        @endforeach
                                        @else
                                        @foreach ($pin as $key=>$item)
                                        @if ($pon->status==$key)
                                        <?=$item?>
                                        @endif
                                        @endforeach
                                        @endif

                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="nav-pembayaran" role="tabpanel" aria-labelledby="nav-pembayaran-tab">

            <div class="d-flex dataWrapper">
                <div class="d-flex wrapperTableInfoData fullWidth">

                    <table class="table table-striped">
                        <tbody>
                            @if(empty($pon))
                            <tr>
                                <td>Jumlah Uang</td>
                                <td>: <span class="value_uang">Rp.
                                        <?=number_format($data->uang['total'], 2, ',', '.')?></span></td>
                            </tr>
                            @else
                            <tr>
                                <td>Jumlah Uang</td>
                                <td>: <span class="value_uang">RP. <?=$pon->jumlah?></span></td>
                            </tr>
                            @endif
                            @if(empty($pon))
                            <tr>
                                <td>Nama Bank</td>
                                <td>: <span class="value_bank">
                                        <?=$data->nabank?>
                                    </span></td>
                            </tr>
                            <tr>
                                <td>No Rekening</td>
                                <td>: <span class="value_uang"><?=$data->norek?></span></td>
                            </tr>
                            @else
                            <tr>
                                <td>Nama Bank</td>
                                <td>: <span class="value_bank"><?=$pon->nama_bank?></span></td>
                            </tr>
                            <tr>
                                <td>No Rekening</td>
                                <td>: <span class="value_uang"><?=$pon->no_rekening?></span></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        <tbody>
                            @if(empty($pon))
                            <tr>
                                <td>Atas Nama</td>
                                <td>: <span class="value_prajurit"><?=$data->narek?></span></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>: <span class="value_date"><?=$data->tg_cair?></span></td>
                            </tr>
                            @else
                            <tr>
                                <td>Atas Nama</td>
                                <td>: <span class="value_prajurit"><?=$pon->atas_nama?></span></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>: <span class="value_date"><?=$pon->tanggal?></span></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>
<div class="actionButton fade show">
    <!-- <a href=""></a> -->
    <a class="btn editBtn d-flex align-items-center" type="edit" href="/baltab/editBaltab?NRP=<?=$data->nrp?>">
        <img src="../assets/img/white_editIcon.svg" alt="">
        Edit
    </a>
    @if (!Auth::user()->role==1)
    <a class="btn btn-primary d-flex align-items-center" type="edit"
        href="/baltab/ajukan?ac=ajukan&NRP=<?=$data->nrp?>">
        <img src="../assets/img/white_editIcon.svg" alt="">
        Ajukan
    </a>
    <button class="btn deleteBtn d-flex align-items-center" type="delete">
        <img src="../assets/img/white_deleteIcon.svg" alt="">
        Delete
    </button>
    @endif
</div>
@else
<div class="alert alert-lg text-center" style="padding:1rem; background:#A2A846;color:white;font-weight:700;" role="alert">
    <div class="mb-3">
        @if(!empty($_GET['NRP']))
        Data NRP<strong> {{$_GET['NRP']}}</strong> Belum Lengkap Harap Lengkapi Data Terlebih Dahulu
        @elseif(!empty(Auth::user()->nrp))
        Data NRP<strong> {{$data->nrp}}</strong> Belum Lengkap Harap Lengkapi Data Terlebih Dahulu
        @endif

    </div>
    <center><a style="width:min-content;padding:.5rem;background: #FF832A" class="btn editBtn d-flex align-items-center btn text-center" type="edit"
            href="/baltab/editBaltab?NRP=<?=$data->nrp?>">
            <img style="max-width: 20px;" class="me-2" src="../assets/img/white_editIcon.svg" alt="">
            Edit
        </a></center>
</div>
@endif
