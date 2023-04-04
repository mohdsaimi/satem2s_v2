@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => $logged_in_user->name])
        </x-slot>

        <x-slot name="body">
            @lang('Selamat datang ke RepoTech Dashboard')
        </x-slot>
    </x-backend.card>


    <div class="card">
        <div class="card-body">
            {{-- <div class="container py-4"> --}}
            <form action="{{ route('admin.dashboard') }}" method="GET" role="search">
                <div class="row justify-content-center">
                    <div class="col-md-2">
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

                <div class="row justify-content-center">

                    <div class="col-md">

                            <p style="text-align: center"><h1 style="text-align: center"><i class="fas fa-fingerprint"></i> SATEM2S</h1></p>

                    </div><!--col-md-10-->
                    
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div id="chartsatem2s"></div>
                    </div><!--col-md-10-->
                    <div class="col-md-12">

                        <div class="container">
                            <h4 style="text-align: center"><b>Purata Suhu Pelajar {{ date('d-m-Y', strtotime($date)) }}</b></h4>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col" class="text-right">Kursus</th>
                                    <th scope="col" class="w-25 p-3 text-center">Suhu Pagi</th>
                                    <th scope="col" class="w-25 p-3 text-center">Suhu Petang</th>
                                    <th scope="col" class="w-10 p-3 text-center">Suhu Tertinggi Pagi</th>
                                    <th scope="col" class="w-10 p-3 text-center">Suhu Tertinggi Petang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($courses as $course)

                                    <tr>
                                        <td scope="row" class="text-right">{{ $course->nama_kursus ?? null }}</td>
                                        <td scope="row" class="text-center"><h1 class="font-weight-bold">{{ number_format($avg_log_pagi[$course->id][0], 2) }}</h1></td>
                                        <td scope="row" class="text-center"><h1 class="font-weight-bold">{{ number_format($avg_log_petang[$course->id][0], 2) }}</h1></td>
                                        <td scope="row" class="text-center"><h1 class="font-weight-bold">{{ number_format($log_pagi_tinggi[$course->id][0], 2) }}</h1></td>
                                        <td scope="row" class="text-center"><h1 class="font-weight-bold">{{ number_format($log_petang_tinggi[$course->id][0], 2) }}</h1></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>


                    </div><!--col-md-10-->
                </div>

            </form>
        </div>
    </div>
    

    {{-- BPPA --}}

    <div class="card">
        <div class="card-body">
            {{-- <div class="container py-4"> --}}
            <form action="{{ route('admin.dashboard') }}" method="GET" role="search">
                <div class="row justify-content-center">
                    <div class="col-md-1">
                        <input type="number" class="form-control mb-2 mr-sm-2" id="date_bppa" name="date_bppa" min="2020" max="2099" step="1" value="{{ $date_bppa }}" width="10">
                    </div>
                    <div class="row-md-2">
                        <span class="input-group-btn mr-2">
                            <button class="btn btn-info" type="submit" title="Cari">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>
                    </div>
                </div>

                <div class="row justify-content-center">

                    <div class="col-md">

                            <p style="text-align: center"><h1 style="text-align: center"><i class="fas fa-cogs"></i> BPPA</h1></p>

                    </div><!--col-md-10-->
                    
                </div>

                <div class="row justify-content-center">
                    
                    <div class="col-md-12">
                        <div class="container">
                            <h5 style="text-align: center"><b>Aduan Kerosakan Aset Alih Tahun {{ $date_bppa }}</b></h5>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">
                                            <div class="card">
                                                <div class="card-header table-info table-bordered border-info">
                                                    Bilangan Aduan
                                                </div>
                                                <div class="table-bordered border-info">
                                                    <h1 class="card-title">{{ $bil_rosak_all }}</h1>
                                                </div>
                                                {{-- <div class="table-bordered border-info">
                                                    <h1 class="card-title">{{ $bil_rosak_all_semua }}</h1>
                                                </div> --}}
                                            </div>
                                        </th>

                                        <th scope="col" class="text-center">
                                            <div class="card">
                                                <div class="card-header table-success table-bordered border-success">
                                                    Bilangan Selesai
                                                </div>
                                                <div class="table-bordered border-success">
                                                    <h1 class="card-title">{{ $bil_selesai_all }}</h1>
                                                </div>
                                                {{-- <div class="table-bordered border-success">
                                                    <h1 class="card-title">{{ $bil_selesai_all_semua }}</h1>
                                                </div> --}}
                                            </div>
                                        </th>

                                        <th scope="col" class="text-center">
                                            <div class="card">
                                                <div class="card-header table-danger table-bordered border-danger">
                                                    Bilangan Belum Selesai
                                                </div>
                                                <div class="table-bordered border-danger">
                                                    <h1 class="card-title">{{ $bil_xselesai_all }}</h1>
                                                </div>
                                                {{-- <div class="table-bordered border-danger">
                                                    <h1 class="card-title">{{ $bil_xselesai_all_semua }}</h1>
                                                </div> --}}
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                                        {{-- test --}}

                                <div class="col-md-12">
                                    <div class="container">

                                        {{-- <div class="card"> --}}
                                            <table class="table">

                                                        <h5 style="text-align: center"><b>Jumlah Kumulatif Aduan Kerosakan Aset Alih</b></h5>

    
                                                <tr>
                                                    <td colspan="2" scope="col" class="text-center">
                                                        {{-- <div class="card"> --}}
                                                            <div class="card-header table-danger table-bordered border-danger">
                                                                <b>Bilangan Belum Selesai</b>
                                                            </div>
                                                            <div class="table-bordered border-danger">
                                                                    <div class="table-bordered border-danger">
                                                                        <h1 class="card-title">{{ $bil_xselesai_all_semua }}</h1>
                                                                    </div>
                                                                    <div style="width: 100%; display: table;">
                                                                        <div style="display: table-row">
                                                                            <div style="display: table-cell" class="table-danger table-bordered border-danger">
                                                                                <b>Baru :  {{ $bil_baru_all }}</b>
                                                                            </div>
                                                                            <div style="display: table-cell" class="table-warning table-bordered border-warning">
                                                                                <b>BPPA :  {{ $bil_bppa_all }}</b>
                                                                            </div>
                                                                            <div style="display: table-cell" class="table-warning table-bordered border-warning">
                                                                                <b>Syor Perolehan :  {{ $bil_pro_perolehan_all }}</b>
                                                                            </div>
                                                                            <div style="display: table-cell" class="table-warning table-bordered border-warning">
                                                                                <b>Syor Lupus :  {{ $bil_pro_lupus_all }}</b>
                                                                            </div>
                                                                            <div style="display: table-cell" class="table-secondary table-bordered border-secondary">
                                                                                <b>Dlm Proses Perolehan :  {{ $bil_perolehan_all }}</b>
                                                                            </div>
                                                                            <div style="display: table-cell" class="table-primary table-bordered border-primary">
                                                                                <b>Dlm Proses Lupus :  {{ $bil_lupus_all }}</b>
                                                                            </div>
                                                                            <div style="display: table-cell" class="table-info table-bordered border-info">
                                                                                <b>Dlm Proses Kendiri :  {{ $bil_kendiri_all }}</b>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        {{-- </div> --}}
                                                    </td>
                                                </tr>
    
                                                <tr>
                                                    <td scope="col" class="text-center">
                                                        <div class="card">
                                                            <div class="card-header table-info table-bordered border-info">
                                                                <b>Bilangan Aduan</b>
                                                            </div>
                                                            <div class="table-bordered border-info">
                                                                <h1 class="card-title">{{ $bil_rosak_all_semua }}</h1>
                                                            </div>
                                                        </div>
                                                    </td>
                                                
                                                    <td scope="col" class="text-center">
                                                        <div class="card">
                                                            <div class="card-header table-success table-bordered border-success">
                                                                <b>Bilangan Selesai</b>
                                                            </div>
                                                            <div class="table-bordered border-success">
                                                                <h1 class="card-title">{{ $bil_selesai_all_semua }}</h1>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        {{-- </div> --}}
                                                
                                                
                                    </div>
                                </div>                
                                {{-- end test --}}









                        <div class="col-md-12">
                            <div id="chartbppahm"></div>
                        </div><!--col-md-10-->

                    </div><!--col-md-10-->



                    <br>&nbsp;<br>

                    <div class="col-md-12"> {{-- ATA --}}
                        
                        <div class="container">
                            <h5 style="text-align: center"><b>Pengurusan Aset Tak Alih</b></h5>
                        

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">
                                            <div class="card">
                                                <div class="card-header table-primary table-bordered border-primary">
                                                    Bilangan Blok
                                                </div>
                                                <div class="table-bordered border-primary">
                                                    <h1 class="card-title">{{ $bil_bangunan }}</h1>
                                                </div>
                                            </div>
                                        </th>

                                        <th scope="col" class="text-center">
                                            <div class="card">
                                                <div class="card-header table-info table-bordered border-info">
                                                    Bilangan Ruang
                                                </div>
                                                <div class="table-bordered border-info">
                                                    <h1 class="card-title">{{ $bil_ruang }}</h1>
                                                </div>
                                            </div>
                                        </th>

                                        <th scope="col" class="text-center">
                                            <div class="card">
                                                <div class="card-header table-warning table-bordered border-warning">
                                                    Bilangan Komponen Berdaftar
                                                </div>
                                                <div class="table-bordered border-warning">
                                                    <h1 class="card-title">{{ $bil_kom_daftar }}</h1>
                                                </div>
                                            </div>
                                        </th>

                                    </tr>
                                </thead>
                            </table>
                        </div>



                        <div class="container">
                            <h5 style="text-align: center"><b>Aduan Kerosakan Aset Tak Alih Tahun {{ $date_bppa }}</b></h5>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">
                                            <div class="card">
                                                <div class="card-header table-info table-bordered border-info">
                                                    Bilangan Aduan
                                                </div>
                                                <div class="table-bordered border-info">
                                                    <h1 class="card-title">{{ $bil_rosak_all_ata }}</h1>
                                                </div>
                                            </div>
                                        </th>

                                        <th scope="col" class="text-center">
                                            <div class="card">
                                                <div class="card-header table-success table-bordered border-success">
                                                    Bilangan Selesai
                                                </div>
                                                <div class="table-bordered border-success">
                                                    <h1 class="card-title">{{ $bil_selesai_all_ata }}</h1>
                                                </div>
                                            </div>
                                        </th>

                                        <th scope="col" class="text-center">
                                            <div class="card">
                                                <div class="card-header table-danger table-bordered border-danger">
                                                    Bilangan Belum Selesai
                                                </div>
                                                <div class="table-bordered border-danger">
                                                    <h1 class="card-title">{{ $bil_xselesai_all_ata }}</h1>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>


                        {{-- test --}}

                        <div class="col-md-12">
                            <div class="container">

                                {{-- <div class="card"> --}}
                                    <table class="table">

                                                <h5 style="text-align: center"><b>Jumlah Kumulatif Aduan Kerosakan Aset Tak Alih</b></h5>


                                        <tr>
                                            <td colspan="2" scope="col" class="text-center">
                                                {{-- <div class="card"> --}}
                                                    <div class="card-header table-danger table-bordered border-danger">
                                                        <b>Bilangan Belum Selesai</b>
                                                    </div>
                                                    <div class="table-bordered border-danger">
                                                            <div class="table-bordered border-danger">
                                                                <h1 class="card-title">{{ $bil_xselesai_all_semua_ata }}</h1>
                                                            </div>
                                                            <div style="width: 100%; display: table;">
                                                                <div style="display: table-row">
                                                                    <div style="display: table-cell" class="table-danger table-bordered border-danger">
                                                                        <b>Baru :  {{ $bil_baru_all_ata }}</b>
                                                                    </div>
                                                                    <div style="display: table-cell" class="table-warning table-bordered border-warning">
                                                                        <b>BPPA :  {{ $bil_bppa_all_ata }}</b>
                                                                    </div>
                                                                    <div style="display: table-cell" class="table-warning table-bordered border-warning">
                                                                        <b>Syor Perolehan :  {{ $bil_pro_perolehan_all_ata }}</b>
                                                                    </div>
                                                                    <div style="display: table-cell" class="table-warning table-bordered border-warning">
                                                                        <b>Syor Lupus :  {{ $bil_pro_lupus_all_ata }}</b>
                                                                    </div>
                                                                    <div style="display: table-cell" class="table-secondary table-bordered border-secondary">
                                                                        <b>Dlm Proses Perolehan :  {{ $bil_perolehan_all_ata }}</b>
                                                                    </div>
                                                                    <div style="display: table-cell" class="table-primary table-bordered border-primary">
                                                                        <b>Dlm Proses Lupus :  {{ $bil_lupus_all_ata }}</b>
                                                                    </div>
                                                                    <div style="display: table-cell" class="table-info table-bordered border-info">
                                                                        <b>Dlm Proses Kendiri :  {{ $bil_kendiri_all_ata }}</b>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                {{-- </div> --}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td scope="col" class="text-center">
                                                <div class="card">
                                                    <div class="card-header table-info table-bordered border-info">
                                                        <b>Bilangan Aduan</b>
                                                    </div>
                                                    <div class="table-bordered border-info">
                                                        <h1 class="card-title">{{ $bil_rosak_all_semua_ata }}</h1>
                                                    </div>
                                                </div>
                                            </td>
                                        
                                            <td scope="col" class="text-center">
                                                <div class="card">
                                                    <div class="card-header table-success table-bordered border-success">
                                                        <b>Bilangan Selesai</b>
                                                    </div>
                                                    <div class="table-bordered border-success">
                                                        <h1 class="card-title">{{ $bil_selesai_all_semua_ata }}</h1>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                    </table>
                                {{-- </div> --}}
                                        
                                        
                            </div>
                        </div>                
                        {{-- end test --}}
        
                        <div class="col-md-12">
                            <div id="chartbppaata"></div>
                        </div><!--col-md-10-->



                    </div> {{-- END ATA --}}


                </div>

            </form>
        </div>
    </div>
    


    <div class="card">
        <div class="card-body">
        </div>
    </div>


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

        Highcharts.chart('chartbppahm', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Aduan Kerosakan Aset Alih Bulanan'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Bilangan'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Aduan',
                data: [{{ $aduan_all[1] }},{{ $aduan_all[2] }},{{ $aduan_all[3] }},{{ $aduan_all[4] }},{{ $aduan_all[5] }},{{ $aduan_all[6] }},{{ $aduan_all[7] }},{{ $aduan_all[8] }},{{ $aduan_all[9] }},{{ $aduan_all[10] }},{{ $aduan_all[11] }},{{ $aduan_all[12] }}]
            }, {
                name: 'Selesai',
                data: [{{ $selesai_all[1] }},{{ $selesai_all[2] }},{{ $selesai_all[3] }},{{ $selesai_all[4] }},{{ $selesai_all[5] }},{{ $selesai_all[6] }},{{ $selesai_all[7] }},{{ $selesai_all[8] }},{{ $selesai_all[9] }},{{ $selesai_all[10] }},{{ $selesai_all[11] }},{{ $selesai_all[12] }}]
            }]
        });

        Highcharts.chart('chartbppaata', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Aduan Kerosakan Aset Tak Alih Bulanan'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Bilangan'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Aduan',
                data: [{{ $aduan_all_ata[1] }},{{ $aduan_all_ata[2] }},{{ $aduan_all_ata[3] }},{{ $aduan_all_ata[4] }},{{ $aduan_all_ata[5] }},{{ $aduan_all_ata[6] }},{{ $aduan_all_ata[7] }},{{ $aduan_all_ata[8] }},{{ $aduan_all_ata[9] }},{{ $aduan_all_ata[10] }},{{ $aduan_all_ata[11] }},{{ $aduan_all_ata[12] }}]
            }, {
                name: 'Selesai',
                data: [{{ $selesai_all_ata[1] }},{{ $selesai_all_ata[2] }},{{ $selesai_all_ata[3] }},{{ $selesai_all_ata[4] }},{{ $selesai_all_ata[5] }},{{ $selesai_all_ata[6] }},{{ $selesai_all_ata[7] }},{{ $selesai_all_ata[8] }},{{ $selesai_all_ata[9] }},{{ $selesai_all_ata[10] }},{{ $selesai_all_ata[11] }},{{ $selesai_all_ata[12] }}]
            }]
        });

    </script>
@endsection

