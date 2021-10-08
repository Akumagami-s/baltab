@extends('layouts.base')

@section('css')
<link rel="stylesheet" href="{{ url('assets/css/editMaster-eBaltab.css') }}">

@endsection


@section('content')

<div class="mainContent">
    <div class="container-fluid">
        <h1 class="nameContent">Edit Master</h1>



        @if ($type == 'pangkat')
        <div class="wrapperCardEdit institutPangkat">
            <div class="headerName">
                <h1>EDIT INSTITUT PANGKAT</h1>
            </div>
            <form action="{{ route('editPangkat',['id'=>$data->id]) }}" method="POST">
                @csrf
                <div class="wrapperFormAction">
                    <div class="formAction left">
                        <div class="form formKode">
                            <label for="">Kode</label>
                            <input name="kode" value="{{$data->kode}}" type="text">
                        </div>
                        <div class="form formUraian">
                            <label for="">Uraian</label>
                            <input name="uraian" value="{{$data->uraian}}" type="text">
                        </div>
                    </div>
                    <div class="formAction right">

                    </div>
                </div>

                <div class="actionButton">
                    <button class="btn saveBtn d-flex align-items-center" type="submit">
                        <img src="../assets/img/saveIcon.svg" alt="">
                        Simpan
                        </button>
                    </div>
                </form>

        </div>
        <a href="{{ route('master') }}" class="btn btn-danger d-flex align-items-center" style="width: 10%">
            Batal
        </a>
        @elseif($type == 'kesatuan')


        <div class="wrapperCardEdit institutKesatuan">
            <div class="headerName">
                <h1>EDIT INSTITUT KESATUAN</h1>
            </div>
            <form action="{{ route('editKesatuan',['id'=>$data->id]) }}" method="POST">
                @csrf
                <div class="wrapperFormAction">
                    <div class="formAction left">
                        <div class="form">
                            <label for="">Nopend</label>
                            <input type="text" name="nopend" value="{{$data->nopend}}">
                        </div>
                        <div class="form">
                            <label for="">Kobri</label>
                            <input type="text" name="kobri" value="{{$data->kobri}}">
                        </div>
                    </div>
                    <div class="formAction right">
                        <div class="form">
                            <label for="">Kosat</label>
                            <input type="text" name="kosat" value="{{$data->kosat}}">
                        </div>
                        <div class="form">
                            <label for="">Nama Kesatuan</label>
                            <input type="text" name="namsat" value="{{$data->namsat}}">
                        </div>
                    </div>
                </div>

                <div class="actionButton">
                    <button class="btn saveBtn d-flex align-items-center" type="submit">
                        <img src="../assets/img/saveIcon.svg" alt="">
                        Simpan
                        </button>

                </div>
            </form>
        </div>
        <a href="{{ route('master') }}" class="btn btn-danger d-flex align-items-center" style="width: 10%">
            Batal
        </a>
        @elseif ($type == "corp")


        <div class="wrapperCardEdit institutKorp">
            <div class="headerName">
                <h1>EDIT INSTITUT KORP</h1>
            </div>
            <form action="{{ route('editCorp',['id'=>$data->id]) }}" method="POST">
                @csrf
                <div class="wrapperFormAction">
                    <div class="formAction left">
                        <div class="form formKode">
                            <label for="">Kode</label>
                            <input name="kode" value="{{$data->kode}}" type="text">
                        </div>
                        <div class="form formUraian">
                            <label for="">Uraian</label>
                            <input name="uraian" value="{{$data->uraian}}" type="text">
                        </div>
                    </div>
                    <div class="formAction right">

                    </div>
                </div>

                <div class="actionButton">
                    <button class="btn saveBtn d-flex align-items-center" type="submit">
                        <img src="../assets/img/saveIcon.svg" alt="">
                        Simpan
                        </button>

                </div>
            </form>
        </div>
        <a href="{{ route('master') }}" class="btn btn-danger d-flex align-items-center" style="width: 10%">
            Batal
        </a>
        @elseif ($type == "kategori")

        <div class="wrapperCardEdit Kategori">
            <div class="headerName">
                <h1>EDIT KATEGORI</h1>
            </div>
            <form action="{{ route('editKategori', ['id'=>$data->id]) }}" method="POST">
                @csrf
                <div class="wrapperFormAction">
                    <div class="formAction left">
                        <div class="form formKode">
                            <label for="">Kode</label>
                            <input name="kode" value="{{$data->kode}}" type="text">
                        </div>
                        <div class="form formUraian">
                            <label for="">Uraian</label>
                            <input name="uraian" value="{{$data->uraian}}" type="text">
                        </div>
                    </div>
                    <div class="formAction right">

                    </div>
                </div>

                <div class="actionButton">
                    <button class="btn saveBtn d-flex align-items-center" type="submit">
                        <img src="../assets/img/saveIcon.svg" alt="">
                        Simpan
                    </button>

                </div>
            </form>
        </div>
        <a href="{{ route('master') }}" class="btn btn-danger d-flex align-items-center" style="width: 10%">
            Batal
        </a>
        @elseif ($type == 'kotama')



        <div class="wrapperCardEdit kotama">
            <div class="headerName">
                <h1>EDIT KOTAMA</h1>
            </div>
            <form action="{{ route('editKotama', ['id'=>$data->id]) }}" method="POST">
                @csrf
                <div class="wrapperFormAction">
                    <div class="formAction left">
                        <div class="form formKode">
                            <label for="">Kode</label>
                            <input name="kode" value="{{$data->kode}}" type="text">
                        </div>
                        <div class="form formUraian">
                            <label for="">Uraian</label>
                            <input name="uraian" value="{{$data->uraian}}" type="text">
                        </div>
                    </div>
                    <div class="formAction right">

                    </div>
                </div>

                <div class="actionButton">
                    <button class="btn saveBtn d-flex align-items-center" type="submit">
                        <img src="../assets/img/saveIcon.svg" alt="">
                        Simpan
                        </button>

                </div>
            </form>
        </div>
        <a href="{{ route('master') }}" class="btn btn-danger d-flex align-items-center" style="width: 10%">
            Batal
        </a>
        @elseif ($type == "satminkal")
        <div class="wrapperCardEdit satminkal">
            <div class="headerName">
                <h1>EDIT SATMINKAL</h1>
            </div>
            <form action="{{ route('editSatminkal', ['id'=>$data->id]) }}" method="POST">
                @csrf
                <div class="wrapperFormAction">
                    <div class="formAction left">
                        <div class="form formUraian">
                            <label for="">Kode KTM</label>
                            <input name="kode_ktm" value="{{ $data->kode_ktm }}" type="text">
                        </div>
                        <div class="form formKode">
                            <label for="">Kode</label>
                            <input name="kode" value="{{$data->kode}}" type="text">
                        </div>
                        <div class="form formUraian">
                            <label for="">Uraian</label>
                            <input name="uraian" value="{{$data->uraian}}" type="text">
                        </div>
                    </div>
                    <div class="formAction right">

                    </div>
                </div>

                <div class="actionButton">
                    <button class="btn saveBtn d-flex align-items-center" type="submit">
                        <img src="../assets/img/saveIcon.svg" alt="">
                        Simpan
                        </button>

                </div>
            </form>
        </div>

        <a href="{{ route('master') }}" class="btn btn-danger d-flex align-items-center" style="width: 10%">
            Batal
        </a>
        @endif


    </div>
</div>

<footer>
    <p>Copyright 2021 © DITKUAD</p>
</footer>

@endsection

@section('js')

@endsection
