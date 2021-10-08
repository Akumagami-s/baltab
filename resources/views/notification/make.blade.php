@extends('layouts.base')



@section('content')
    <style>
        .ls {
            list-style: none;
            padding: 12px;
            border: thin solid #F0F8FF;
        }

        .ls:hover {
            background-color: #7FFFD4;
        }

    </style>


    <br>
    <br>
    <br>
    <br>

    <div class="container">






        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Broadcast</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Specific</button>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                <br>
                <h3>Broadcast Message</h3>
                <form action="{{ route('postMessage') }}" method="post">
                    @csrf
                    <label>TYPE</label>
                    <input type="text" name="type" value="*" class="form-control" readonly="readonly">
                    <br>
                    <label>Judul</label>
                    <input type="text" id="judul" name="judul" placeholder="judul" class="form-control" />



                    <br>
                    <label>Pesan</label>
                    <textarea name="pesan" id="" cols="30" rows="10" class="form-control"></textarea>
                    <br>
                    <button type="submit" class="btn btn-success w-100">
                        Kirim !

                    </button>

                </form>

            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                <br>
                <center>
                    <button onclick="deleteselected()" class="btn btn-danger">Delete selected</button>

                </center>
                <div class="row">
                    <div>
                        <br>
                        <form action="{{ route('postMessage') }}" method="post">
                            @csrf
                            <label>Cari NRP</label>
                            <input type="hidden" name="type" value="nb">
                            <input type="text" name="provinsi" id="provinsi" class="form-control"
                                placeholder="Pesan untuk nrp ?" autocomplete="off" />
                            <div id="provinsiList"></div>
                            <label>List Penerima</label>
                            <input type="text" name="nrplist" id="nrplist" class="form-control" readonly="readonly"
                                value="">
                            <label>Judul</label>
                            <input type="text" id="judul" name="judul" placeholder="judul" class="form-control" />



                            <br>
                            <label>Pesan</label>
                            <textarea name="pesan" id="" cols="30" rows="10" class="form-control"></textarea>
                            <br>
                            <button type="submit" class="w-100 btn btn-success">
                                Kirim !

                            </button>

                        </form>


                    </div>
                </div>


            </div>

        </div>







        <br>
        <br>
        <br>
    </div>


@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>


    <script>
        $(document).ready(function() {
            $('#provinsi').keyup(function() {
                var query = $(this).val();
                if (query != '') {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('getWho') }}",
                        method: "POST",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            var htm = '';
                            for (let i = 0; i < data.length; i++) {

                                htm += '<li class="ls" data-nrp="' + data[i].nrp + '">' + data[
                                    i].name + ' --- ' + data[i].nrp + '</li>'
                            }

                            $('#provinsiList').fadeIn();
                            $('#provinsiList').html(htm);

                        }
                    });
                }
            });
            $(document).on('click', 'li', function() {

                var vals = $('#nrplist').val() + $(this).attr('data-nrp') + ',';
                $('#nrplist').val(vals);
                $('#provinsiList').fadeOut();
            });
        });


        function deleteselected() {
            $('#nrplist').val('');
        }
    </script>
@endsection
