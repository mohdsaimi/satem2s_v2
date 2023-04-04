@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => $logged_in_user->name])
        </x-slot>

        <x-slot name="body">
            @lang('Selamat datang ke SATEM2S Dashboard')
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
    

{{--     <div class="card">
        <div class="card-body">
        </div>
    </div> --}}


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

