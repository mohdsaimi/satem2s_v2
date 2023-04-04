@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Dashboard')
                    </x-slot>

                    <x-slot name="body">
                        @lang('Selamat datang ke RepoTech Dashboard')
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->



        <div class="card">
            <div class="card-body">
                <form action="{{ route('frontend.user.dashboard') }}" method="GET" role="search">
                {{-- <div class="container py-4"> --}}
                    <div class="row justify-content-center">
                        <div class="col-md-auto">

                            <a href="kehadiran" {{-- target="_blank" --}} style="text-decoration: none; text-align: center">
                                <p style="text-align: center"><h1><i class="fas fa-fingerprint"></i> SATEM2S</h1></p>
                                <h5><p style="text-align: center">Smart Attendance with TEMperature Screening System</p></h5>
                                <p style="text-align: center">Semak Kehadiran pelajar</p>
                                </a>

                                    <div class="row justify-content-center">
                                        <div class="col-md">
                                        <input type="date" class="form-control mb-2 mr-sm-2" id="datepicker" name="date" width="20"
                                            placeholder="YYYY/MM/DD" required>
                    
                                        </div>
                                        <div class="row-md-2">
                                            <span class="input-group-btn mr-2">
                                                <button class="btn btn-info" type="submit" title="Cari">
                                                    <span class="fas fa-search"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>

                        </div><!--col-md-10-->
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div id="chartsatem2s"></div>
                        </div><!--col-md-10-->
                    </div>

                {{-- </div> --}}
                </form>
            </div>
            
        </div>

        {{--  --}}
        <div class="card">
            <div class="card-body">


                <div class="card text-center">
                    <div class="card-header">
                        <h1><i class="fas fa-cogs"></i> BPPA</h1>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">ADUAN KEROSAKAN ASET ALIH & ASET TAK ALIH</h5>
                        <p class="card-text">Klik butang untuk aduan kerosakan mengikut kategori aset.</p>
                        <a href="aduanhm1" type="button" class="btn btn-outline-info">Harta Modal (HM)</a>
                        <a href="aduanabr1" type="button" class="btn btn-outline-info">Aset Bernilai Rendah (ABR)</a>
                        <a href="aduanata1" type="button" class="btn btn-outline-success">Komponen ATA</a>
                        <a href="aduanata1" type="button" class="btn btn-outline-success">Struktur/Kekemasan ATA</a></p>
                        <p class="card-text"><a href="{{URL::to('/')}}/storage/HM/carta_alir_aduan.pdf" target="_blank">Klik di sini untuk muat turun Carta Alir Aduan Kerosakan Aset Alih.</a></p>
                        <p class="card-text"><a href="lokasibangunan">Klik di sini untuk melihat lokasi setiap bangunan.</a></p>
                    {{-- </div>

                    <div class="card-body"> --}}
                        <hr>
                        <h5 class="card-title">SENARAI ADUAN KEROSAKAN ASET ALIH & ASET TAK ALIH</h5>
                        {{-- <p class="card-text">Klik butang untuk senarai aduan kerosakan mengikut kategori aset.</p> --}}
                        <p><a href="list_aduanhm" type="button" class="btn btn-outline-info">Harta Modal (HM)</a>
                        <a href="list_aduanabr" type="button" class="btn btn-outline-info">Aset Bernilai Rendah (ABR)</a>
                        <a href="list_aduanata" type="button" class="btn btn-outline-success">Komponen ATA</a>
                        <a href="list_aduanstr" type="button" class="btn btn-outline-success">Struktur/Kekemasan ATA</a></p>
                    {{-- </div> --}}

                    
                    <hr>
                    {{-- <div class="card-body"> --}}
                        <h5 class="card-title">PERMOHONAN PELUPUSAN ASET ALIH </h5>
                        <p class="card-text">Klik butang untuk permohonan pelupusan mengikut kategori aset.</p>
                        <p><a href="mohonlupushm" type="button" class="btn btn-outline-secondary">Harta Modal (HM)</a>
                        <a href="mohonlupusabr" type="button" class="btn btn-outline-secondary">Aset Bernilai Rendah (ABR)</a></p>
                    </div>

                    {{-- <divclass="card-body"> --}}
                        <hr>
                        <h5 class="card-title">SENARAI PERMOHONAN PELUPUSAN ASET ALIH </h5>
                        {{-- <p class="card-text">Klik butang untuk senarai aduan kerosakan mengikut kategori aset.</p> --}}
                        <p><a href="list_lupushm" type="button" class="btn btn-outline-secondary">Harta Modal (HM)</a>
                        <a href="list_lupusabr" type="button" class="btn btn-outline-secondary">Aset Bernilai Rendah (ABR)</a>
                    {{-- </div> --}}

                    <div class="card-footer text-muted">
                        Bahagian Pengurusan Dan Penyelenggaraan Aset, Institut Latihan Perindustrian Selandar.
                    </div>
                </div>

                
                {{-- <div class="row justify-content-center">
                    <div class="col-md-auto">

                            <p style="text-align: center"><h1 style="text-decoration: none; text-align: center"><i class="fas fa-cogs"></i> BPPA</h1></p>
                            <h5 style="text-decoration: none; text-align: center">
                                <p>Modul berkaitan Bahagian Pengurusan & Penyelenggaraan Aset</p>
                                <p><a href="aduanhm1">Klik di sini untuk aduan kerosakan aset alih (Harta Modal).</a></p>
                                <p><a href="aduanabr1">Klik di sini untuk aduan kerosakan aset alih (ABR).</a></p>
                                <hr>
                                <p><a href="list_aduanhm">Klik di sini untuk senarai aduan kerosakan aset alih (Harta Modal).</a></p>
                                <p><a href="list_aduanabr">Klik di sini untuk senarai aduan kerosakan aset alih (ABR).</a></p>
                                <hr>
                                <p><a href="mohonlupushm">Klik di sini untuk permohonan perlupusan aset alih (Harta Modal).</a></p>
                                <p><a href="mohonlupusabr">Klik di sini untuk permohonan perlupusan aset alih (ABR).</a></p>
                            </h5>
                    </div>
                </div> --}}


            </div>
        </div>





    </div><!--container-->

@endsection

@section('satem2schart')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>

        Highcharts.chart('chartsatem2s', {

        chart: {
            type: 'column'
        },

        colors: [
            '#ff0000',
            '#4dff88',
            '#800040',
            '#66a3ff'
        ],

        title: {
            text: 'Jumlah Kehadiran Pada {{ date('d-m-Y', strtotime($date)) }}'
        },

        xAxis: {
            categories: {!! json_encode($katagori) !!}
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Bilangan Pelajar'
            }
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            }
        },

                series: [{
                name: 'Log Pagi Tidak Hadir',
                data: {!! json_encode($log_pagi_xhadir) !!},
                stack: 'male'
            }, {
                name: 'Log Pagi Hadir',
                data: {!! json_encode($log_pagi) !!},
                stack: 'male'
            }, {
                name: 'Log Petang Tidak Hadir',
                data: {!! json_encode($log_petang_xhadir) !!},
                stack: 'female'
            }, {
                name: 'Log Petang Hadir',
                data: {!! json_encode($log_petang) !!},
                stack: 'female'
            }]
        });
    </script>
@endsection

