


@extends('layouts.base')

@section('css')
    <!--Ebaltab Css-->
 <link rel="stylesheet" href="{{url ('assets/css/rekayasaDataeBaltab.css') }}">
 <!--Data Table-->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css">
@endsection


@section('content')


<div class="mainContent">
  <div class="container-fluid">
      <div class="wrapperContent">

        <div class="nav nav-tabs tabsButton" id="nav-tab" role="tablist">
          <button class="nav-link active"
           id="import-tab-menu"
           data-bs-toggle="tab"
           data-bs-target="#import-tab"
           type="button" role="tab"
           aria-controls="import-tab"
           aria-selected="true">Import</button>

           <button class="nav-link"
           id="verifikasi-tab-menu"
           data-bs-toggle="tab"
           data-bs-target="#verifikasi-tab"
           type="button" role="tab"
           aria-controls="verifikasi-tab"
           aria-selected="true">Verifikasi</button>
        </div>

        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active"
            id="import-tab"
            role="tabpanel"
            aria-labelledby="import-tab-menu">

            <h1 class="nameContent">Import CSV</h1>

            <div class="searchAndImportWrapper">
               <form class="d-flex align-items-center" action="{{ route('importPengajuan') }}" method="post" enctype="multipart/form-data">
                   @csrf
                   <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                   <button class="ms-5 btn"><ion-icon name="cloud-download-outline"></ion-icon> IMPORT</button>
               </form>
            </div>



          </div>

          <div class="tab-pane fade"
            id="verifikasi-tab"
            role="tabpanel"
            aria-labelledby="verifikasi-tab-menu">

            <h1 class="nameContent">Verifikasi Data Import</h1>

            <div class="wrapperTable">
                <table id="tableRekayasaData" class="table" style="width:100%">
                  <thead class="headTable">
                      <tr>
                        <th><input type="checkbox" class="select-all"> All</th>
                        <th>NRP</th>
                        <th>Nama</th>
                        <th>Pangkat</th>
                        <th>Kesatuan</th>
                        <th>Kesatuan</th>
                      </tr>
                  </thead>

              </table>
            </div>

            <div class="actionButton fade show">
                <button class="btn greenButton d-flex align-items-center" type="save">
                    <img src="../assets/img/saveIcon.svg" alt="">
                    Save
                </button>
                <button class="btn deleteBtn d-flex align-items-center" type="delete">
                    <img src="../assets/img/white_deleteIcon.svg" alt="">
                    Delete
                </button>
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
{{-- <script src="{{ url('assets/js/rekayasaData.js') }}"></script> --}}
<script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>

<script>


$(document).ready( function () {
    dt_table = $('#tableRekayasaData').DataTable({
            processing: true,
            serverSide: true,
            ajax: "https://asiabytes.tech/baltab/dataPengajuan",
            pageLength: 25,
            columns: [
                {
                    data: 'check',
                    name: 'check',
                    orderable: false,
                    searchable: false
                },
                { data: 'nrp_formated', name: 'NRP', defaultContent: "<i class='text-danger'>null</i>", className: 'NRP', visible: true },
                { data: 'nama', name: 'nama', defaultContent: "<i class='text-danger'>null</i>", className: 'nama', visible: true },
                { data: 'pangkat_uraian', name: 'pangkat', defaultContent: "<i class='text-danger'>null</i>", className: 'pangkat', visible: true },
                { data: 'kesatuan_uraian', name: 'kesatuan', defaultContent: "<i class='text-danger'>null</i>", className: 'kesatuan', visible: true },
                { data: 'corp_uraian', name: 'corps', defaultContent: "<i class='text-danger'>null</i>", className: 'corps', visible: true },



            ],
            order: [[2, 'desc']]
        });
        addColumnFilter(dt_table);

} );

</script>

@endsection
