@extends('frontend.layouts.app')

@section('title', __('Dashboard Satem2s'))


@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{-- <x-frontend.card>
                    <x-slot name="header">
                        @lang('Dashboard')
                    </x-slot>

                    <x-slot name="body">
                        @lang('Selamat datang ke SATEM2S Dashboard')
                    </x-slot>
                </x-frontend.card> --}}
            </div><!--col-md-10-->
        </div><!--row-->



        <div class="card">
            <div class="card-body">
                <form action="{{ route('frontend.satem2s') }}" method="GET" role="search">
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

