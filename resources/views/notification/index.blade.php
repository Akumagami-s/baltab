@extends('layouts.base')


@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/notifikasi.css') }}">
@endsection

@section('content')


    <div class="mainContent">
        <div class="container">
            <div class="wrapperContent">

                <h1 class="nameContent">Notifikasi</h1>
                <div class="accordion" id="accordionExample">


                    <div class="accordion-item">
                        <div class="accordion-header">
                            <button data-id="welcome" class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordionwelcome"
                                aria-expanded="false" aria-controls="accordionwelcome">
                                <div class="iconMassage">
                                    <ion-icon name="chatbubbles"></ion-icon>
                                </div>
                                <h2 class="messageName">Selamat Datang Di SISFOBETA V4.0</h2>
                            </button>
                        </div>
                        <div id="accordionwelcome" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>aplikasi yang terintegrasi untuk memudahkan prajurit di seluruh Indonesia dimanapun dan
                                    kapanpun untuk mendapatkan informasi iuran twp, baltab , dan kpr secara online dan up to
                                    date</p>
                            </div>
                        </div>
                    </div>


                    @foreach (DB::connection('login')->table('notify')->where('nrp', Auth::user()->nrp)->get()
        as $item)
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <button data-id="{{ $item->id }}" class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="{{ '#accordion' . $item->id }}"
                                    aria-expanded="false" aria-controls="{{ 'accordion' . $item->id }}">
                                    <div class="iconMassage">
                                        <ion-icon name="chatbubbles"></ion-icon>
                                    </div>
                                    <h2 class="messageName">{{ $item->judul }}</h2>
                                </button>
                            </div>
                            <div id="{{ 'accordion' . $item->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>{{ $item->pesan }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    @foreach (DB::connection('login')->table('notify')->where('nrp', '*')->get()
        as $item)
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <button data-id="{{ $item->id }}" class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="{{ '#accordion' . $item->id }}"
                                    aria-expanded="false" aria-controls="{{ 'accordion' . $item->id }}">
                                    <div class="iconMassage">
                                        <ion-icon name="chatbubbles"></ion-icon>
                                    </div>
                                    <h2 class="messageName">{{ $item->judul }}</h2>
                                </button>
                            </div>
                            <div id="{{ 'accordion' . $item->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>{{ $item->pesan }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>Copyright 2021 © DITKUAD</p>
    </footer>



@endsection

@section('js')


    <script>
        $('.accordion .accordion-item .accordion-header button').click(function() {

            $.ajax({

                    url: '{{ route("read_notif") }}',
                    type: 'POST',

                    data: {
                    "_token": "{{ csrf_token() }}",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'notif_id' :  $(this).attr('data-id'),

                },
                    dataType: 'JSON',
                    success: function (data) {

                        $('#numbernotif').html(data['count']);
                    }
                });
        });
    </script>
@endsection
