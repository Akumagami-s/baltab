@extends('layouts.base')


@section('css')

@endsection
@section('content')
<form action="/baltab/datapok/update?ac=ajukan" method="POST">
    @csrf
    <div class="mainContent">
        <div class="container-fluid">
            <h1 class="nameContent">Pengajuan Data</h1>
            <div class="card rounded-3 mb-4">
                <div class="card-header">
                    <h2 class="container-xxl">RH</h2>
                </div>
                <div class="card-body container-xxl">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-4">
                            <div class="imgProfil d-flex justify-content-center flex-column align-items-center ">
                                <!-- <img src="../assets/img/profil.png" class="rounded-circle w-50"> -->
                                <img src="@if(Auth::user()->role==0)
                    {{DB::connection('login')->table('users')->where('nrp',$_GET['NRP'])->first()->thumb}}
                    @else
                    {{Auth::user()->thumb}}
                    @endif"
                    class="rounded-circle w-50" style="width: 200px;
                height: 200px;
                border-radius: 50%;">
                            </div>
                        </div>
                        <div class="col">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>NRP</td>
                                        <td><input type="text" readonly value="{{ $user->nrp }}" id="nrp" name="nrp"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Prajurit</td>
                                        <td><input type="text" value="{{ $user->nama }}" id="namaPrajurit" name="nama"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pangkat Prajurit</td>
                                        <td>
                                            <select class="form-select" aria-label="Default select example" name="pangkat">
                                                @foreach (App\Models\Pangkat::all() as $item)
                                                @if ($item->kode == $user->pangkat)

                                                <option value="{{ $item->kode }}" selected>{{ $item->uraian }}
                                                </option>
                                                @else
                                                <option value="{{ $item->kode }}">{{ $item->uraian }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pengangkatan</td>
                                        <td><input value="{{ $user->tmt_pkt }}" type="text" id="tglPengangkatan" name="tmt_pkt"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Corp</td>
                                        <td>
                                            <select class="form-select" aria-label="Default select example" name="corps">

                                                @foreach (DB::connection('login')->table('data_master_corp')->get()
                                                as $item)
                                                @if ($item->kode == $user->corp)
                                                <option value="{{ $item->kode }}" selected>{{ $item->uraian }}
                                                </option>
                                                @else
                                                <option value="{{ $item->kode }}">{{ $item->uraian }}</option>
                                                @endif
                                                @endforeach

                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Kesatuan</td>
                                        <td>
                                            <select class="form-select" aria-label="Default select example" name="kesatuan">

                                                @foreach (DB::connection('login')->table('data_master_kesatuan')->get()
                                                as $item)
                                                @if ($item->kosat == $user->kesatuan)
                                                <option value="{{ $item->kosat }}" selected>
                                                    {{ $item->namsat }}
                                                </option>
                                                @else
                                                <option value="{{ $item->kosat }}">{{ $item->namsat }}
                                                </option>
                                                @endif


                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kotama</td>
                                        <td>
                                            <select class="form-select" aria-label="Default select example" name="kd_ktm">
                                                @foreach (DB::connection('login')->table('data_master_kotama')->get()
                                                as $item)
                                                @if ($item->kode == $user->kd_ktm)
                                                <option value="{{ $item->kode }}" selected>{{ $item->uraian }}
                                                </option>
                                                @else
                                                <option value="{{ $item->kode }}">{{ $item->uraian }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir</td>
                                        <td><input value="{{ $user->tg_lahir }}" type="date" id="tglPengangkatan" name="tg_lahir"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    {{-- <tr>
                              <td>Tanggal Update</td>
                              <td>
                                  <fieldset disabled>
                                      <input type="date" id="disabledTextInput" class="form-control">
                                  </fieldset>
                              </td>
                            </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card rounded-3 mb-4">
                <div class="card-header">
                    <h2 class="container-xxl">Pangkat</h2>
                </div>
                <div class="card-body container-xxl">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>TMT Tamtama</td>
                                        <td><input value="{{ $user->tmt_1 }}" type="date" id="tamtama" name="tmt_1"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TMT Bintara</td>
                                        <td><input type="date" value="{{ $user->tmt_2 }}" id="bintara" name="tmt_2"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TMT Pama</td>
                                        <td><input type="date" name="tmt_3" id="pama" value="{{ $user->tmt_3 }}"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-12 col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>TMT Pamen</td>
                                        <td><input type="date" name="tmt_4" value="{{ $user->tmt_4 }}" id="pamen"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TMT Pati</td>
                                        <td><input type="date" name="tmt_5" value="{{ $user->tmt_5 }}" id="pati"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card rounded-3 mb-4">
                <div class="card-header">
                    <h2 class="container-xxl">RH</h2>
                </div>
                <div class="card-body container-xxl">
                    <div class="row justify-content-center">
                        <div class="col">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>TMT Pangka</td>
                                        <td><input value="{{ $user->tmt_pa }}" type="date" name="tmt_pa" id="tmtPangkat" name="tmtPangkat"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TMT Pensiun</td>
                                        <td><input type="date" value="{{ $user->tmt_henti }}" id="tmtPensiun" name="tmt_henti"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kd Bansus</td>
                                        <td><input value="{{ $user->kd_bansus }}" name="kd_bansus" type="text" id="kdBansus" name="kdBansus"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TMT Perwira</td>
                                        <td><input type="text" id="tmtPerwira" name="tmtPerwira" class="form-control float-end"
                                                aria-describedby="passwordHelpInline"></td>
                                    </tr>
                                    <tr>
                                        <td>No Bitur</td>
                                        <td><input value="{{ $user->no_bitur }}" type="text" id="noBitur" name="no_bitur"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Katagori</td>
                                        <td>
                                            <select class="form-select" name="kd_ktg" aria-label="Default select example">
                                                @foreach (DB::connection('login')->table('data_master_kategori')->get()
                                                as $item)
                                                @if ($item->kode == $user->kd_ktg)
                                                <option value="{{ $item->kode }}" selected>{{ $item->uraian }}
                                                </option>
                                                @else
                                                <option value="{{ $item->kode }}">{{ $item->uraian }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>TMT KTg</td>
                                        <td>
                                            <input value="{{ $user->tmt_ktg }}" type="date" id="tglPengangkatan" name="tmt_ktg"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Gaji Pokok</td>
                                        <td><input value="{{ $user->g_pokok }}" type="text" id="g_pokok" name="g_pokok"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tunjangan Istri</td>
                                        <td><input value="{{ $user->t_istri }}" type="text" id="namaPrajurit" name="t_istri"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tunjangan Anak</td>
                                        <td><input value="{{ $user->t_anak }}" type="text" id="namaPrajurit" name="t_anak"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr style="display: none">
                                        <td style="display: none">KPR 1</td>
                                        <td><input value="{{ $user->kpr1 }}" type="text" id="tglPengangkatan" name="kpr1"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr style="display: none">
                                        <td>KPR 2</td>
                                        <td><input value="{{ $user->kpr2 }}" type="text" id="tglPengangkatan" name="kpr2"
                                                class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card rounded-3 mb-4">
                <div class="card-header">
                    <h2 class="container-xxl">Info Rekening</h2>
                </div>
                <div class="card-body container-xxl">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Nomor Rekening</td>
                                        <td><input value="{{$user->norek}}" type="number" id="norek" name="norek" class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Bank</td>
                                        <td><input type="text" value="{{$user->nabank}}" id="nabank" name="nabank" class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pemilik Rekening</td>
                                        <td>
                                            <input type="text" name="narek" id="narek" value="{{$user->narek}}" class="form-control float-end" aria-describedby="passwordHelpInline">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="actionButton fade show">
                <button class="btn btn-primary d-flex align-items-center" type="edit">
                    <img src="../assets/img/floppy-disk 2.svg" alt="">
                    Ajukan
                </button>
                <button class="btn deleteBtn d-flex align-items-center" type="delete">
                    <img src="../assets/img/white_deleteIcon.svg" alt="">
                    Delete
                </button>
            </div>

        </div>
    </div>
</form>
<footer>
    <p>Copyright 2021 © DITKUAD</p>
</footer>
@endsection

@section('js')
<script>
    $("input").each(function() {
            var element = $(this);
            if (element.val() == "") {
                element.addClass('is-invalid')
            }
        });
</script>
@endsection
