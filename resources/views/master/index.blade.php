@extends('layouts.base')

@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/mastereBaltab.css') }}">
    <!--Data Table-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.dataTables.min.css">
@endsection
@section('content')

    <style>
        tr {
            transition: .7s;
        }

        tr:hover {

            transition: .7s;
            background: #ECF2F3;
        }

    </style>

    <div class="mainContent">
        <div class="container-fluid">
            <div class="wrapperContent">
                <div class="nav nav-tabs tabsButton" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="institut-tab-menu" data-bs-toggle="tab"
                        data-bs-target="#institut-tab" type="button" role="tab" aria-controls="institut-tab"
                        aria-selected="true">Institut</button>

                    <!-- <button class="nav-link" id="distrik-tab-menu" data-bs-toggle="tab" data-bs-target="#distrik-tab"
                                type="button" role="tab" aria-controls="distrik-tab" aria-selected="true">Distrik</button> -->

                    <!-- <button class="nav-link" id="lokasi-tab-menu" data-bs-toggle="tab" data-bs-target="#lokasi-tab"
                                type="button" role="tab" aria-controls="lokasi-tab" aria-selected="true">Lokasi</button> -->

                    <button class="nav-link" id="kategori-tab-menu" data-bs-toggle="tab" data-bs-target="#kategori-tab"
                        type="button" role="tab" aria-controls="kategori-tab" aria-selected="true">Kategori</button>

                    <button class="nav-link" id="kotama-tab-menu" data-bs-toggle="tab" data-bs-target="#kotama-tab"
                        type="button" role="tab" aria-controls="kotama-tab" aria-selected="true">Kotama</button>

                    <button class="nav-link" id="satminkal-tab-menu" data-bs-toggle="tab"
                        data-bs-target="#satminkal-tab" type="button" role="tab" aria-controls="satminkal-tab"
                        aria-selected="true">Satminkal</button>

                    <button class="nav-link" id="bunga-tab-menu" data-bs-toggle="tab" data-bs-target="#bunga-tab"
                        type="button" role="tab" aria-controls="bunga-tab" aria-selected="true">Bunga</button>

                    <button class="nav-link" id="potongan-tab-menu" data-bs-toggle="tab"
                        data-bs-target="#potongan-tab" type="button" role="tab" aria-controls="potongan-tab"
                        aria-selected="true">Potongan</button>

                </div>

                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="institut-tab" role="tabpanel"
                        aria-labelledby="institut-tab-menu">
                        <h1 class="nameContent">Institut</h1>
                        <div class="wrapperMainData">
                            <div class="wrapperData">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-pangkat-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-pangkat" type="button" role="tab" aria-controls="nav-pangkat"
                                        aria-selected="false">
                                        Pangkat
                                    </button>

                                    <button class="nav-link" id="nav-kesatuan-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-kesatuan" type="button" role="tab" aria-controls="nav-kesatuan"
                                        aria-selected="false">
                                        Kesatuan
                                    </button>

                                    <button class="nav-link" id="nav-korp-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-korp" type="button" role="tab" aria-controls="nav-korp"
                                        aria-selected="false">
                                        Korp
                                    </button>
                                </div>

                                <div class="tab-content" id="nav-tabContent">

                                    <div class="tab-pane fade show active" id="nav-pangkat" role="tabpanel"
                                        aria-labelledby="nav-pangkat-tab">

                                        <div class="wrapperTable">
                                            <table id="tableMasterInstitutPangkat" class="table"
                                                style="width:100%">

                                                <button type="button" class="btn btn-primary btnModal me-3"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Tambah
                                                </button>

                                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Tambah
                                                                    Pangkat</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <form action="{{ route('createPangkat') }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="mainForm columnForm">
                                                                        <div class="actionForm first">
                                                                            <label for="">Kode</label>
                                                                            <input name="kode" type="text">
                                                                        </div>
                                                                        <div class="actionForm two">
                                                                            <label for="">Uraian</label>
                                                                            <input name="uraian" type="text">
                                                                        </div>
                                                                    </div>

                                                                    <div class="buttonActionForm">

                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer actionButton">
                                                                    <button class="btn saveBtn d-flex align-items-center"
                                                                        type="submit">
                                                                        <img src="{{ url('assets/img/saveIcon.svg') }}"
                                                                            alt="">
                                                                        Simpan
                                                                    </button>
                                                                    {{-- <button class="btn deleteBtn d-flex align-items-center"
                                                                data-bs-dismiss="modal" type="batal">
                                                                Batal
                                                            </button> --}}
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>


                                                <thead class="headTable">
                                                    <tr>
                                                        <th>Kode</th>
                                                        <th>Uraian</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bodyTable">
                                                    @foreach ($pangkat as $item)
                                                        <tr>
                                                            <td>{{ $item->kode }}</td>
                                                            <td>{{ $item->uraian }}</td>


                                                            <td>



                                                                    <div class="dropdown">
                                                                    <button style=" border: none;
                                                                    background: transparent;text-align:right;" class="buttonMore" type="button" id="moreAction2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="moreAction2">
                                                                        <li> <a class="dropdown-item" href="{{ route('updatePangkat', ['id' => $item->id]) }}">Edit</a></li>
                                                                        <li> <a class="dropdown-item" href="{{ route('deletePangkat', ['id' => $item->id]) }}" >Delete</a></li>
                                                                    </ul>
                                                                    </div>

                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="nav-kesatuan" role="tabpanel"
                                        aria-labelledby="nav-kesatuan-tab">
                                        <div class="wrapperTable">
                                            <table id="tableMasterInstitutKesatuan" class="table"
                                                style="width:100%">

                                                <button type="button" class="btn btn-primary btnModal"
                                                    data-bs-toggle="modal" data-bs-target="#institutKesatuan">
                                                    Tambah
                                                </button>

                                                <div class="modal fade" id="institutKesatuan" tabindex="-1"
                                                    aria-labelledby="institutKesatuanLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="institutKesatuanLabel">Tambah
                                                                    Kesatuan</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <form action="{{ route('createKesatuan') }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="mainForm rowForm">
                                                                        <div class="first">
                                                                            <div class="actionForm">
                                                                                <label for="">Nopeend</label>
                                                                                <input name="nopend" type="text">
                                                                            </div>
                                                                            <div class="actionForm">
                                                                                <label for="">Kobri</label>
                                                                                <input name="kobri" type="text">
                                                                            </div>
                                                                            <div class="actionForm">
                                                                                <label for="">Kosat</label>
                                                                                <input name="kosat" type="text">
                                                                            </div>
                                                                            <div class="actionForm">
                                                                                <label for="">Kpd</label>
                                                                                <input name="kpd" type="text">
                                                                            </div>
                                                                            <div class="actionForm">
                                                                                <label for="">Namsat</label>
                                                                                <input name="namsat" type="text">
                                                                            </div>
                                                                        </div>
                                                                        <div class="two">
                                                                            <div class="actionForm">
                                                                                <label for="">Lokasi</label>
                                                                                <input name="lokasi" type="text">
                                                                                {{-- <label for="">Lokasi</label>
                                                                                <select  id="cars" name="lokasi">
                                                                                    <option value="volvo">Volvo XC90
                                                                                    </option>
                                                                                    <option value="saab">Saab 95</option>
                                                                                    <option value="mercedes">Mercedes SLK
                                                                                    </option>
                                                                                    <option value="audi">Audi TT</option>
                                                                                </select> --}}
                                                                            </div>
                                                                            <div class="actionForm">
                                                                                <label for="">Kota</label>
                                                                                <input name="kota" type="text">
                                                                            </div>
                                                                            <div class="actionForm">
                                                                                <label for="">Di</label>
                                                                                <input name="di" type="text">
                                                                            </div>
                                                                            <div class="actionForm">
                                                                                <label for="">Ku Kotama</label>
                                                                                <input name="ku_kotama" type="text">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="buttonActionForm">

                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer actionButton">
                                                                    <button class="btn saveBtn d-flex align-items-center"
                                                                        type="save">
                                                                        <img src="{{ url('assets/img/saveIcon.svg') }}"
                                                                            alt="">
                                                                        Simpan
                                                                    </button>
                                                                    {{-- <button class="btn deleteBtn d-flex align-items-center"
                                                                data-bs-dismiss="modal" type="batal">
                                                                Batal
                                                            </button> --}}
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>


                                                <thead class="headTable">
                                                    <tr>
                                                        <th>Nopend</th>
                                                        <th>Kobri</th>
                                                        <th>Kosat</th>
                                                        <th>Nama kesatuan</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bodyTable">
                                                    @foreach ($kesatuan as $item)

                                                        <tr>
                                                            <td>{{ $item->nopend }}</td>
                                                            <td>{{ $item->kobri }}</td>
                                                            <td>{{ $item->kosat }}</td>
                                                            <td>{{ $item->namsat }}</td>
                                                            <td>
                                                                {{-- <div class="actionButton fade show"> --}}



                                                                    <div class="dropdown">
                                                                        <button style=" border: none;
                                                                        background: transparent;text-align:right;" class="buttonMore" type="button" id="moreAction2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fas fa-ellipsis-v"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="moreAction2">
                                                                            <li> <a class="dropdown-item" href="{{ route('updateKesatuan', ['id' => $item->id]) }}">Edit</a></li>
                                                                            <li> <a class="dropdown-item" href="{{ route('deleteKesatuan', ['id' => $item->id]) }}" >Delete</a></li>
                                                                        </ul>
                                                                        </div>


{{--
                                                                    <a href="{{ route('updateKesatuan', ['id' => $item->id]) }}"
                                                                        class="btn editBtn d-flex align-items-center"
                                                                        type="edit">
                                                                        <img src="{{ url('assets/img/white_editIcon.svg') }}"
                                                                            alt="">
                                                                        Edit
                                                                    </a>
                                                                    <a onclick="return confirm('apakah anda yakin ?')"
                                                                        href="{{ route('deleteKesatuan', ['id' => $item->id]) }}"
                                                                        class="btn deleteBtn d-flex align-items-center"
                                                                        type="delete">
                                                                        <img src="{{ url('assets/img/white_deleteIcon.svg') }}"
                                                                            alt="">
                                                                        Delete
                                                                    </a> --}}
                                                                {{-- </div> --}}
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>


                                    </div>

                                    <div class="tab-pane fade" id="nav-korp" role="tabpanel"
                                        aria-labelledby="nav-korp-tab">

                                        <div class="wrapperTable">
                                            <table id="tableMasterInstitutKorp" class="table" style="width:100%">

                                                <button type="button" class="btn btn-primary btnModal"
                                                    data-bs-toggle="modal" data-bs-target="#modelKorp">
                                                    Tambah
                                                </button>

                                                <div class="modal fade" id="modelKorp" tabindex="-1"
                                                    aria-labelledby="modelKorpLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modelKorpLabel">Tambah
                                                                    Pangkat</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <form method="POST" action="{{ route('createCorp') }}">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="mainForm columnForm">
                                                                        <div class="actionForm first">
                                                                            <label for="">Kode</label>
                                                                            <input name="kode" type="text">
                                                                        </div>
                                                                        <div class="actionForm two">
                                                                            <label for="">Uraian</label>
                                                                            <input name="uraian" type="text">
                                                                        </div>
                                                                    </div>

                                                                    <div class="buttonActionForm">

                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer actionButton">
                                                                    <button type="submit"
                                                                        class="btn saveBtn d-flex align-items-center"
                                                                        type="save">
                                                                        <img src="{{ url('assets/img/saveIcon.svg') }}"
                                                                            alt="">
                                                                        Simpan
                                                                    </button>
                                                                    {{-- <button class="btn deleteBtn d-flex align-items-center"
                                                            data-bs-dismiss="modal" type="batal">
                                                            Batal
                                                        </button> --}}
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                        </div>


                                        <thead class="headTable">
                                            <tr>
                                                <th>Kode</th>
                                                <th>Uraian</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bodyTable">
                                            @foreach ($corp as $item)


                                                <tr>
                                                    <td>{{ $item->kode }}</td>
                                                    <td>{{ $item->uraian }}</td>
                                                    <td>


                                                        <div class="dropdown">
                                                            <button style=" border: none;
                                                            background: transparent;text-align:right;" class="buttonMore" type="button" id="moreAction2" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="moreAction2">
                                                                <li> <a class="dropdown-item" href="{{ route('updateCorp', ['id' => $item->id]) }}">Edit</a></li>
                                                                <li> <a class="dropdown-item" href="{{ route('deleteCorp', ['id' => $item->id]) }}" >Delete</a></li>
                                                            </ul>
                                                            </div>

                                                        {{-- <div class="actionButton fade show">
                                                            <a href="{{ route('updateCorp', ['id' => $item->id]) }}"
                                                                class="btn editBtn d-flex align-items-center" type="edit">
                                                                <img src="{{ url('assets/img/white_editIcon.svg') }}"
                                                                    alt="">
                                                                Edit
                                                            </a>
                                                            <a onclick="return confirm('apakah anda yakin ?')"
                                                                href="{{ route('deleteCorp', ['id' => $item->id]) }}"
                                                                class="btn deleteBtn d-flex align-items-center"
                                                                type="delete">
                                                                <img src="{{ url('assets/img/white_deleteIcon.svg') }}"
                                                                    alt="">
                                                                Delete
                                                            </a>
                                                        </div> --}}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                        </table>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade" id="distrik-tab" role="tabpanel" aria-labelledby="distrik-tab-menu">
                    <h1 class="nameContent">ini distrik</h1>
                </div>

                <div class="tab-pane fade" id="lokasi-tab" role="tabpanel" aria-labelledby="lokasi-tab-menu">

                    <h1 class="nameContent">ini Lokasi</h1>
                </div>

                <div class="tab-pane fade" id="kategori-tab" role="tabpanel" aria-labelledby="kategori-tab-menu">

                    <h1 class="nameContent">Kategori</h1>

                    <div class="wrapperTable">
                        <table id="tableMasterKategori" class="table" style="width:100%">

                            <button type="button" class="btn btn-primary btnModal" data-bs-toggle="modal"
                                data-bs-target="#kategori">
                                Tambah
                            </button>

                            <div class="modal fade" id="kategori" tabindex="-1" aria-labelledby="kategoriLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="kategoriLabel">Tambah Kategori</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form action="{{ route('createKategori') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mainForm columnForm">
                                                    <div class="actionForm first">
                                                        <label for="">Kode</label>
                                                        <input name="kode" type="text">
                                                    </div>
                                                    <div class="actionForm two">
                                                        <label for="">Uraian</label>
                                                        <input name="uraian" type="text">
                                                    </div>
                                                </div>

                                                <div class="buttonActionForm">

                                                </div>
                                            </div>

                                            <div class="modal-footer actionButton">
                                                <button type="submit" class="btn saveBtn d-flex align-items-center">
                                                    <img src="{{ url('assets/img/saveIcon.svg') }}" alt="">
                                                    Simpan
                                                </button>
                                                {{-- <button class="btn deleteBtn d-flex align-items-center"
                                                    data-bs-dismiss="modal" type="batal">
                                                    Batal
                                                </button> --}}
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>


                            <thead class="headTable">
                                <tr>
                                    <th>Kode</th>
                                    <th>Uraian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="bodyTable">
                                @foreach ($kategori as $item)


                                    <tr>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->uraian }}</td>
                                        <td>


                                            <div class="dropdown">
                                                <button style=" border: none;
                                                background: transparent;text-align:right;" class="buttonMore" type="button" id="moreAction2" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="moreAction2">
                                                    <li> <a class="dropdown-item" href="{{ route('updateKategori', ['id' => $item->id]) }}">Edit</a></li>
                                                    <li> <a class="dropdown-item" href="{{ url('assets/img/white_deleteIcon.svg') }}" >Delete</a></li>
                                                </ul>
                                                </div>


                                            {{-- <div class="actionButton fade show">
                                                <a href="{{ route('updateKategori', ['id' => $item->id]) }}"
                                                    class="btn editBtn d-flex align-items-center" type="edit">
                                                    <img src="{{ url('assets/img/white_editIcon.svg') }}" alt="">
                                                    Edit
                                                </a>
                                                <a onclick="return confirm('apakah anda yakin ?')"
                                                    href="{{ route('deleteKategori', ['id' => $item->id]) }}"
                                                    onclick="return confirm('apakah anda yakin ?');"
                                                    class="btn deleteBtn d-flex align-items-center" type="delete">
                                                    <img src="{{ url('assets/img/white_deleteIcon.svg') }}" alt="">
                                                    Delete
                                                </a>
                                            </div> --}}
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="kotama-tab" role="tabpanel" aria-labelledby="kotama-tab-menu">

                    <h1 class="nameContent">Kotama</h1>

                    <div class="wrapperTable">
                        <table id="tableMasterKotama" class="table" style="width:100%">

                            <button type="button" class="btn btn-primary btnModal" data-bs-toggle="modal"
                                data-bs-target="#kotama">
                                Tambah
                            </button>

                            <div class="modal fade" id="kotama" tabindex="-1" aria-labelledby="kotamaLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="kotamaLabel">Tambah Kotama</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form method="POST" action="{{ route('createKotama') }}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mainForm columnForm">
                                                    <div class="actionForm first">
                                                        <label for="">Kode</label>
                                                        <input name="kode" type="text">
                                                    </div>
                                                    <div class="actionForm two">
                                                        <label for="">Uraian</label>
                                                        <input name="uraian" type="text">
                                                    </div>
                                                </div>

                                                <div class="buttonActionForm">

                                                </div>
                                            </div>

                                            <div class="modal-footer actionButton">
                                                <button class="btn saveBtn d-flex align-items-center" type="submit">
                                                    <img src="{{ url('assets/img/saveIcon.svg') }}" alt="">
                                                    Simpan
                                                </button>
                                                {{-- <button class="btn deleteBtn d-flex align-items-center"
                                                data-bs-dismiss="modal" type="batal">
                                                Batal
                                                </button> --}}
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>


                            <thead class="headTable">
                                <tr>
                                    <th>Kode</th>
                                    <th>Uraian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="bodyTable">
                                @foreach ($kotama as $item)

                                    <tr>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->uraian }}</td>
                                        <td>



                                             <div class="dropdown">
                                                <button style=" border: none;
                                                background: transparent;text-align:right;" class="buttonMore" type="button" id="moreAction2" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="moreAction2">
                                                    <li> <a class="dropdown-item" href="{{ route('updateKotama', ['id' => $item->id]) }}">Edit</a></li>
                                                    <li> <a class="dropdown-item" href="{{ route('deleteKotama', ['id' => $item->id]) }}" >Delete</a></li>
                                                </ul>
                                                </div>
                                            {{-- <div class="actionButton fade show">
                                                <a href="{{ route('updateKotama', ['id' => $item->id]) }}"
                                                    class="btn editBtn d-flex align-items-center" type="edit">
                                                    <img src="{{ url('assets/img/white_editIcon.svg') }}" alt="">
                                                    Edit
                                                </a>
                                                <a onclick="return confirm('apakah anda yakin ?')"
                                                    href="{{ route('deleteKotama', ['id' => $item->id]) }}"
                                                    class="btn deleteBtn d-flex align-items-center" type="delete">
                                                    <img src="{{ url('assets/img/white_deleteIcon.svg') }}" alt="">
                                                    Delete
                                                </a>
                                            </div> --}}
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="satminkal-tab" role="tabpanel" aria-labelledby="satminkal-tab-menu">

                    <h1 class="nameContent">Satminkal</h1>

                    <div class="wrapperTable">
                        <table id="tableMasterSatminkal" class="table" style="width:100%">

                            <button type="button" class="btn btn-primary btnModal" data-bs-toggle="modal"
                                data-bs-target="#satminkal">
                                Tambah
                            </button>

                            <div class="modal fade" id="satminkal" tabindex="-1" aria-labelledby="satminkalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="satminkalLabel">Tambah Satminkal</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <form action="{{ route('createSatminkal') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mainForm columnForm">
                                                    <div class="actionForm first">
                                                        <label for="">Kode KTM</label>
                                                        <input name="kode_ktm" type="text">
                                                    </div>
                                                    <div class="actionForm first">
                                                        <label for="">Kode</label>
                                                        <input name="kode" type="text">
                                                    </div>
                                                    <div class="actionForm two">
                                                        <label for="">Uraian</label>
                                                        <input name="uraian" type="text">
                                                    </div>
                                                </div>

                                                <div class="buttonActionForm">

                                                </div>
                                            </div>

                                            <div class="modal-footer actionButton">
                                                <button class="btn saveBtn d-flex align-items-center" type="submit">
                                                    <img src="{{ url('assets/img/saveIcon.svg') }}" alt="">
                                                    Simpan
                                                </button>
                                                {{-- <button class="btn deleteBtn d-flex align-items-center"
                                                data-bs-dismiss="modal" type="batal">
                                                Batal
                                            </button> --}}
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>


                            <thead class="headTable">
                                <tr>
                                    <th>Kode KTM</th>
                                    <th>Kode</th>
                                    <th>Uraian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="bodyTable">
                                @foreach ($satminkal as $item)

                                    <tr>
                                        <td>{{ $item->kode_ktm }}</td>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->uraian }}</td>
                                        <td>



                                            <div class="dropdown">
                                                <button style=" border: none;
                                                background: transparent;text-align:right;" class="buttonMore" type="button" id="moreAction2" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="moreAction2">
                                                    <li> <a class="dropdown-item" href="{{ route('updateSatminkal', ['id' => $item->id]) }}">Edit</a></li>
                                                    <li> <a class="dropdown-item" href="{{ route('deleteSatminkal', ['id' => $item->id]) }}" >Delete</a></li>
                                                </ul>
                                                </div>
                                            {{-- <div class="actionButton fade show">
                                                <a href="{{ route('updateSatminkal', ['id' => $item->id]) }}"
                                                    class="btn editBtn d-flex align-items-center" type="edit">
                                                    <img src="{{ url('assets/img/white_editIcon.svg') }}" alt="">
                                                    Edit
                                                </a>
                                                <a onclick="return confirm('apakah anda yakin ?')"
                                                    href="{{ route('deleteSatminkal', ['id' => $item->id]) }}"
                                                    class="btn deleteBtn d-flex align-items-center" type="delete">
                                                    <img src="{{ url('assets/img/white_deleteIcon.svg') }}" alt="">
                                                    Delete
                                                </a>
                                            </div> --}}
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="bunga-tab" role="tabpanel" aria-labelledby="bunga-tab-menu">

                    <h1 class="nameContent">Bunga</h1>

                    <div class="wrapperPotonganBunga">

                        <div class="nameTabs">
                            <h3>Tambah Data Bunga</h3>
                            <form action="createBunga" method="POST" class="wrapperAction">
                                @csrf
                                <div class="formInput month">
                                    {{-- <label for="">Bulan</label>
                                        <select id="cars" name="cars">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="fiat">Fiat</option>
                                            <option value="audi">Audi</option>
                                        </select> --}}

                                    <label for=""> Masukan Periode</label>
                                    <input name="period" type="date">

                                </div>
                                {{-- <div class="formInput year">
                                         <label for="">Tahun</label>
                                        <select id="cars" name="cars">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="fiat">Fiat</option>
                                            <option value="audi">Audi</option>
                                        </select>

                                        <label for="">Jumlah (Rp)</label>
                                        <input type="text">
                                    </div> --}}

                                <div class="formInput jumlah">
                                    <label for="">Jumlah (INT)</label>
                                    <input name="jumlah" type="number">
                                </div>

                                <div class="formInput actionButton">
                                    <button type="submit" class="btn greenButton d-flex align-items-center" type="save">
                                        <img src="{{ url('assets/img/saveIcon.svg') }}" alt="">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="wrapperTable">
                        <table id="tableMasterBunga" class="table" style="width:100%">

                            <thead class="headTable">
                                <tr>
                                    <th>Periode</th>
                                    <th>Type</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="bodyTable">
                                @foreach ($bunga as $item)
                                    <tr>
                                        <td>{{ $item->period }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->value }}</td>
                                        <td>


                                            <div class="dropdown">
                                                <button style=" border: none;
                                                background: transparent;text-align:right;" class="buttonMore" type="button" id="moreAction2" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="moreAction2">

                                                    <li> <a class="dropdown-item" href="{{ route('deleteBunga', ['id' => $item->id]) }}" >Delete</a></li>
                                                </ul>
                                                </div>
                                            {{-- <div class="actionButton fade show">
                                                <a onclick="return confirm('apakah anda yakin ?')"
                                                    href="{{ route('deleteBunga', ['id' => $item->id]) }}"
                                                    class="btn deleteBtn d-flex align-items-center" type="delete">
                                                    <img src="{{ url('assets/img/white_deleteIcon.svg') }}" alt="">
                                                    Hapus
                                                </a>
                                            </div> --}}
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="potongan-tab" role="tabpanel" aria-labelledby="potongan-tab-menu">

                    <h1 class="nameContent">Potongan</h1>

                    <div class="wrapperPotonganBunga">

                        <div class="nameTabs">
                            <h3>Potongan</h3>

                            <form action="{{ route('createPotongan') }}" method="POST" class="wrapperAction">
                                @csrf
                                <div class="formInput month">
                                    <label for="">Bulan</label>
                                    <select id="cars" name="bulan">
                                        <option value="01">January</option>
                                        <option value="02">February</option>
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
                                </div>

                                <div class="formInput year">
                                    <label for="Tahun">Tahun</label>
                                    <select id="Tahun" name="tahun">
                                        <option value="2021">2021</option>
                                        <option value="2020">2020</option>
                                        <option value="2019">2019</option>
                                        <option value="2018">2018</option>
                                        <option value="2016">2016</option>
                                        <option value="2015">2015</option>
                                        <option value="2014">2014</option>
                                        <option value="2013">2013</option>
                                        <option value="2012">2012</option>
                                        <option value="2011">2011</option>
                                        <option value="2010">2010</option>
                                    </select>
                                </div>


                                <div class="formInput jumlah">
                                    <label for="">Pangkat </label>
                                    <input name="pangkat" type="text">
                                </div>

                                <div class="formInput jumlah">
                                    <label for="">Jumlah (Rp)</label>
                                    <input name="value" type="number">
                                </div>

                                <div class="formInput actionButton">
                                    <button class="btn greenButton d-flex align-items-center" type="submit">
                                        <img src="{{ url('assets/img/saveIcon.svg') }}" alt="">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                    <div class="wrapperTable">
                        <table id="tableMasterPotongan" class="table" style="width:100%">

                            <thead class="headTable">
                                <tr>
                                    <th>Periode</th>
                                    <th>Pangkat</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="bodyTable">
                                @foreach ($potongan as $item)
                                    <tr>
                                        <td>{{ $item->period }}</td>
                                        <td>{{ $item->pangkat }}</td>
                                        <td>{{ $item->value }}</td>
                                        <td>

                                            <div class="dropdown">
                                                <button style=" border: none;
                                                background: transparent;text-align:right;" class="buttonMore" type="button" id="moreAction2" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="moreAction2">

                                                    <li> <a class="dropdown-item" href="{{ route('deletePotongan', ['id' => $item->id]) }}" >Delete</a></li>
                                                </ul>
                                                </div>
                                            {{-- <div class="actionButton fade show">
                                                <a href="{{ route('deletePotongan', ['id' => $item->id]) }}"
                                                    class="btn deleteBtn d-flex align-items-center" type="delete">
                                                    <img src="{{ url('assets/img/white_deleteIcon.svg') }}" alt="">
                                                    Hapus
                                                </a>
                                            </div> --}}
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>

    <footer>
        <p>Copyright 2021 © DITKUAD</p>
    </footer>



@endsection


@section('js')
    <!--DataTable-->
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
    <!--dataPrajurit Js-->
    <script src="{{ url('assets/js/master-eBaltab.js') }}"></script>



@endsection
