{{-- @dump($data) --}}
@extends('layouts.base')

@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/dashboardEbaltab.css') }}">
@endsection

@section('content')

    <div class="mainContent">
        <div class="container-fluid">
            <div class="wrapperContent">
                <h1 class="titleHeaderContent">Data Penyaluran Dana</h1>
                <div class="wrapperDataSummary wrapperSlick">
                    <div class="data dataNotSync">
                        <div class="icon">
                            <img src="../assets/img/syncDataIcon.svg" alt="">
                        </div>
                        <h1 class="titleData"><span class="valueData">{{ DB::table('datapokok')->count() }}</span>
                            Prajurit
                        </h1>
                        <small class="titleData"><span
                                class="valueData">{{ DB::table('datapokok_pembayaran')->where('status', '=', '3')->count() }}</span>
                            Proses Pencairan</small>
                        <small class="titleData"><span
                                class="valueData">{{ DB::table('datapokok_pembayaran')->where('status', '=', '4')->count() }}</span>
                            Telah Dicairkan</small>
                        <!-- <button class="btnStyle redButton" type="submit">SINKRON DATA</button> -->
                    </div>

                    <div class="data kelengkapanPengajuan">
                        <div class="arrow">
                            <img src="../assets/img/arrowChart.svg" alt="">
                        </div>
                        <div class="icon wrapperChart">
                            <canvas id="kelengkapanPengajuan"></canvas>
                        </div>
                        <h1 class="titleData">Kelengkapan Pengajuan</h1>
                        <p><span class="month">{{ date('F') }}</span><span
                                class="years">{{ date('Y') }}</span></p>
                    </div>

                    <div class="data approvalSprin">
                        <div class="arrow">
                            <img src="../assets/img/arrowChart.svg" alt="">
                        </div>
                        <div class="icon wrapperChart">
                            <canvas id="approvalSprin"></canvas>
                        </div>
                        <h1 class="titleData">Approval Sprin</h1>
                        <p><span class="month">{{ date('F') }}</span><span
                                class="years">{{ date('Y') }}</span></p>
                    </div>
                </div>

                <div class="container-danaAlokasi-penyaluranDana">
                    <div class="alokasiDana wrapperSlick">
                        <div class="statisticDanaAlokasi cardStatistic">
                            <div class="contentValue">
                                <h3 class="nameValue">Dana Alokasi</h3>
                                <h1 class="valueDana">Rp <span class="value">308.260.458.101</span></h1>
                            </div>
                            <div class="wrapperChart">
                                <canvas id="chartDanaAlokasi"></canvas>
                            </div>
                        </div>

                        <div class="statisticApprovalDanaAlokasi cardStatistic">
                            <div class="contentValue">
                                <h3 class="nameValue">Dana Alokasi</h3>
                                <h1 class="valueDana">Rp <span class="value">308.260.458.101</span></h1>
                            </div>
                            <div class="wrapperChart">
                                <canvas id="chartApprovalDanaAlokasi"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="penyaluranDana wrapperSlick">
                        <div class="cardStatistic">
                            <div class="contentValue">
                                <h3 class="nameValue">Dana Penyaluran</h3>
                                <h1 class="valueDana">Rp <span class="value">308.260.458.101</span></h1>
                            </div>
                            <div class="wrapperChart">
                                <canvas id="chartDanaPenyaluran"></canvas>
                            </div>
                        </div>

                        <div class="cardStatistic">
                            <div class="contentValue">
                                <h3 class="nameValue">Approval Dana Penyaluran</h3>
                                <h1 class="valueDana">Rp <span class="value">308.260.458.101</span></h1>
                            </div>
                            <div class="wrapperChart">
                                <canvas id="chartApprovalDanaPenyaluran"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="statisticAllDataEbaltab">
                    <h1 class="nameChart">Data Rekap Baltab</h1>
                    <div class="containerChart">
                        <div class="wrapperChart">
                            <canvas id="allDataEbaltab"></canvas>
                        </div>
                        <div class="wrapperInfo">
                            <p class="info jumblahPengajuan bg-danger border border-danger rounded" style="color : white">
                                Proses Pencairan</p>
                            <p class="info danaAlokasi bg-warning border border-warning rounded" style="color: white">
                                Pengajuan </p>
                            <p class="info danaPenyaluran bg-primary border border-primary rounded" style="color: white;">
                                Menunggu Persetujuan</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer>
        <p>Copyright 2021 © DITKUAD</p>
    </footer>
    <script src="{{ url('assets/vendors/chart.js') }}"></script>
    <script>
        /* Chart Prajurit Actif or no */
        const data = {
            labels: [
                'Prajurit Aktif',
                'Prajurit Pensiun'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [07, 10],
                backgroundColor: [
                    '#A2A846',
                    '#587350',
                ],
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                legend: {
                    display: false
                },
            }
        };

        var myChart = new Chart(
            document.getElementById('rekapChart'),
            config
        );



        /* Chart KelengkapanPengajuan Data */

        const dataKelengkapanPengajuan = {
            labels: [
                'Value'
            ],
            datasets: [{
                label: 'Kelengkapan',
                data: [{{ $data['kelengkapan']['lengkap'] }}, {{ $data['kelengkapan']['tidak'] }}],
                backgroundColor: [
                    '#FF832A', '#DBD0C0'
                ],
                hoverOffset: 4
            }]
        };

        const configKelengkapanPengajuan = {
            type: 'doughnut',
            data: dataKelengkapanPengajuan,
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                }
            }
        };

        var myChart = new Chart(
            document.getElementById('kelengkapanPengajuan'),
            configKelengkapanPengajuan
        );

        /* Chart dataSprin */
        const dataSprin = {
            labels: [
                'Approval Sprin'
            ],
            datasets: [{
                label: 'Kelengkapan Sprin',
                data: [{{ $data['sprin']['lengkap'] }}, {{ $data['sprin']['tidak'] }}],
                backgroundColor: [
                    '#A2A846', '#DBD0C0'
                ],
                hoverOffset: 4
            }]
        };

        const configSprin = {
            type: 'doughnut',
            data: dataSprin,
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                }
            }
        };

        var myChart = new Chart(
            document.getElementById('approvalSprin'),
            configSprin
        );

        /* Chart danaAlokasi */
        const dataDanaAlokasi = {
            labels: [
                'Approval Sprin'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [75, 25],
                backgroundColor: [
                    '#7334FF', '#DBD0C0'
                ],
                hoverOffset: 4
            }]
        };

        const configDanaAlokasi = {
            type: 'doughnut',
            data: dataDanaAlokasi,
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                }
            }
        };

        var myChart = new Chart(
            document.getElementById('chartDanaAlokasi'),
            configDanaAlokasi
        );


        /* Chart ApprovaldanaAlokasi */
        const dataApprovalDanaAlokasi = {
            labels: [
                'Approval Sprin'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [75, 25],
                backgroundColor: [
                    '#FF832A', '#DBD0C0'
                ],
                hoverOffset: 4
            }]
        };

        const configApprovalDanaAlokasi = {
            type: 'doughnut',
            data: dataApprovalDanaAlokasi,
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                }
            }
        };

        var myChart = new Chart(
            document.getElementById('chartApprovalDanaAlokasi'),
            configApprovalDanaAlokasi
        );


        /* Chart Dana Penyaluran */
        const dataDanaPenyaluran = {
            labels: [
                'Approval Sprin'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [75, 25],
                backgroundColor: [
                    '#DC3545', '#DBD0C0'
                ],
                hoverOffset: 4
            }]
        };

        const configDanaPenyaluran = {
            type: 'doughnut',
            data: dataDanaPenyaluran,
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                }
            }
        };

        var myChart = new Chart(
            document.getElementById('chartDanaPenyaluran'),
            configDanaPenyaluran
        );

        /* Chart Approval Dana Penyaluran */
        const dataApprovalDanaPenyaluran = {
            labels: [
                'Approval Sprin'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [75, 25],
                backgroundColor: [
                    '#A2A846', '#DBD0C0'
                ],
                hoverOffset: 4
            }]
        };

        const configApprovalDanaPenyaluran = {
            type: 'doughnut',
            data: dataApprovalDanaPenyaluran,
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                }
            }
        };

        var myChart = new Chart(
            document.getElementById('chartApprovalDanaPenyaluran'),
            configApprovalDanaPenyaluran
        );




        const labelsAllDataEbaltab = [
            @foreach ($data['alokasi'] as $key => $item)
                '{{ date('F', strtotime($item['mulai'])) }}',
            @endforeach
        ];

        const allDataEbaltab = {
            labels: labelsAllDataEbaltab,
            datasets: [{
                    label: 'Pengajuan',
                    data: [
                        @foreach ($data['alokasi'] as $key => $item)
                            {{ $item['total_pengajuan'] }},
                        @endforeach
                    ],
                    borderColor: '#FF832A',
                    backgroundColor: 'transparent',
                    tension: 0.4,
                    borderWidth: 3,
                },
                {
                    label: 'Menunggu Persetujuan',
                    backgroundColor: 'transparent',
                    data: [
                        @foreach ($data['alokasi'] as $key => $item)
                            {{ $item['total_pesetujuan'] }},
                        @endforeach
                    ],
                    borderColor: '#7334FF',
                    tension: 0.4,
                    borderWidth: 3,
                },
                {
                    label: 'Proses Pencairan',
                    data: [
                        @foreach ($data['alokasi'] as $key => $item)
                            {{ $item['total_pencairan'] }},
                        @endforeach
                    ],
                    borderColor: '#DC3545',
                    backgroundColor: 'transparent',
                    tension: 0.4,
                    borderWidth: 3,
                }
            ]
        };

        const configDataEbaltab = {
            type: 'line',
            data: allDataEbaltab,
            options: {
                animations: {
                    radius: {
                        duration: 200,
                        easing: 'linear',
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                }
            }
        };

        var myChart = new Chart(
            document.getElementById('allDataEbaltab'),
            configDataEbaltab
        );
    </script>
@endsection

@section('js')

    <script src="{{ url('assets/js/chartjs/ui-chart.js') }}"></script>

    <script src="{{ url('assets/js/ebaltab.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.8/push.min.js"
        integrity="sha512-eiqtDDb4GUVCSqOSOTz/s/eiU4B31GrdSb17aPAA4Lv/Cjc8o+hnDvuNkgXhSI5yHuDvYkuojMaQmrB5JB31XQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.8/serviceWorker.min.js"
        integrity="sha512-gZN7SatPzB7LiGjOd4Sree/ecjktoLPgWt22wfApKrzuCpS9KsK7uKEDB+AAGY96NHCW1sAEm1JdaHDDP4MsIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // var a=1
        //  setInterval(() => {
        //     Push.create('Hello World!'+a)
        //     a++
        // }, 1000);
        // Push.create('Hello World!')
        // console.log('ahis');
        // fetch("/baltab/alokasi?call=asd", {
        //         method: 'GET',
        //     }).then((response) => response.json())
        //     .then((data) => {
        //         console.log(data);
        //     });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"
        integrity="sha512-lOrm9FgT1LKOJRUXF3tp6QaMorJftUjowOWiDcG5GFZ/q7ukof19V0HKx/GWzXCdt9zYju3/KhBNdCLzK8b90Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



@endsection
