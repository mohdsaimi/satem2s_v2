<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ appName() }}</title>
        <meta name="description" content="@yield('meta_description', appName())">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        @stack('before-styles')
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .div-with-bg{
                /* resize: both;
                overflow: auto; */
                background-image: url('{{ asset('storage/IMAGES/konvo_1.png') }}');
                background-repeat: no-repeat;
                background-position: center center; 
                position: relative;
                background-size: 100% 100%/* cover */;
                height: 100%;
                width: 100%/* 100vh */;
                /* filter: blur(8px); */
                /* -webkit-filter: blur(8px); */
            }

        </style>
        @stack('after-styles')

        @include('includes.partials.ga')
    </head>
    <body>
        @include('includes.partials.read-only')
        @include('includes.partials.logged-in-as')
        {{-- @include('includes.partials.announcements') --}}

        <div id="app" class="flex-center position-ref full-height div-with-bg">
            
            <div class="content">
                @include('includes.partials.messages')

                {{-- <div class="title m-b-md">
                    <br>
                    <p><i class="fas fa-paw"></i> RepoTech</p>
                </div><!--title--> --}}

                <div class="links">
                    {{-- <p><h3>MAJLIS KONVOKESYEN ILP SELANDAR</h3></p> --}}

                    {{-- <a href="http://laravel-boilerplate.com" target="_blank"><i class="fa fa-book"></i> @lang('Docs')</a>
                    <a href="https://github.com/rappasoft/laravel-boilerplate" target="_blank"><i class="fab fa-github"></i> GitHub</a> --}}
                </div><!--links-->

                {{-- <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <p><h3></h3>
                            </p>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                </div> --}}

                <div class="container">
                    <div class="row">

                        {{-- <div class="div-with-bg">

                                test
                                <p>hsghsk</p>
                                <p>hsghsk</p>
                                <p>hsghsk</p>
                                <p>hsghsk</p>
                                <p>hsghsk</p>
                                <p>hsghsk</p>
                                <p>hsghsk</p>
                                <p>hsghsk</p>
                                <p>hsghsk</p>
                                <p>hsghsk</p>
                                <p>hsghsk</p>

                        </div> --}}
                        
                        <div class="card border-danger  mb-5">
                            <div class="card text-center">
                                {{-- <div class="card-header">
                                    <h1>Selamat Datang</h1>
                                </div> --}}

                                <?php
                                    $i=1;
                                ?>

                                @foreach($vips as $vip)
                                
                                    <?php
                                        $senarai_vip [$i] = $vip->nama_vip;
                                        $senarai_suhu [$i] = number_format($log_pagi[$vip->id_rfid][0]->suhu ?? null, 2);
                                        $senarai_masa [$i] = $log_pagi[$vip->id_rfid][0]->masa ?? null;
                                        $i++;
                                    ?>

                                    {{-- <h5 class="card-title">{{ $vip->nama_vip ?? null }}</h5> --}}
                                @endforeach

                                @if ($senarai_suhu [1] != 0.00)
                                    <div class="card-header text-muted">

                                        <div style="width: 50%; height: 100px; float: left; text-align:left;"> 
                                            <img src="{{ asset('storage/IMAGES/LOGO_ILPSELANDAR_2021.png') }}" width="300">
                                        </div>
                                        <div style="margin-left: 50%; height: 100px;  text-align:right;"> 
                                            <img src="{{ asset('storage/IMAGES/satem2s.jpeg') }}" width="200"{{-- alt="Trulli" width="500" height="333" --}}>
                                        </div>
                                        <h1 style="font-size:2.5em;">SELAMAT DATANG</h1>

                                    </div>

                                    <div class="card-body">
                                        <h1 style="font-size:3em;" class="card-title">Tuan Yang Terutama</h1>
                                        <h1 style="font-size:3em;" class="card-title">{{ $senarai_vip [1] ?? null }}</h1>
                                        
                                            {{-- <p class="btn btn-success btn-lg">Suhu : {{ $senarai_suhu [1] ?? null }}</p> --}}
                                            <p class="btn btn-success btn-lg button" style="font-size:2.5em;">Masa : {{ date('H:i:s', strtotime($senarai_masa [1])) }}</p>
                                        
                                    
                                    </div>

                                    <div class="card-footer text-muted">
                                        <h3>Institut Latihan Perindustrian Selandar</h3>
                                    </div>
                                    
                                @endif

                                
                                

                                
                            </div>
                        </div>



                    </div>
                </div>



            </div><!--content-->

        </div><!--app-->


        @stack('before-scripts')
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/frontend.js') }}"></script>
        @stack('after-scripts')
    </body>
</html>
<?php
    header("refresh: 1");
?>
