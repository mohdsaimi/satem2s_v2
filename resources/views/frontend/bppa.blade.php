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
        </style>
        @stack('after-styles')

        @include('includes.partials.ga')
    </head>
    <body>
        @include('includes.partials.read-only')
        @include('includes.partials.logged-in-as')
        {{-- @include('includes.partials.announcements') --}}

        <div id="app" class="flex-center position-ref full-height">
            <div class="top-right links">
                @auth
                    @if ($logged_in_user->isAdmin())
                        <a href="{{ route('admin.dashboard') }}">@lang('Administrator')</a>
                    @endif
                    @if ($logged_in_user->isUser()||
                    $logged_in_user->isAdmin())
                        <a href="{{ route('frontend.user.dashboard') }}">@lang('Dashboard')</a>
                    @endif

                    <a href="{{ route('frontend.user.account') }}">@lang('Account')</a>
                @else
                    <a href="{{ route('frontend.auth.login') }}">@lang('Login')</a>

                    @if (config('boilerplate.access.user.registration'))
                        <a href="{{ route('frontend.auth.register') }}">@lang('Register')</a>
                    @endif
                @endauth
            </div><!--top-right-->

            <div class="content">
                @include('includes.partials.messages')

                <div class="title m-b-md">
                    <br>
                    {{-- <example-component></example-component> --}}
                    <p><i class="fas fa-paw"></i> RepoTech</p>
                </div><!--title-->

                <div class="links">
                    <p><h3>ILP Selandar One Stop System</h3></p>
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
                        
                        <div class="card border-danger  mb-5">
                            <div class="card text-center">
                                <div class="card-header">
                                    <h1><i class="fas fa-cogs"></i> BPPA</h1>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">ADUAN KEROSAKAN ASET ALIH & ASET TAK ALIH</h5>
                                    <p class="card-text">Klik butang untuk aduan kerosakan mengikut kategori aset.</p>
                                    <p><a href="aduanhm1" type="button" class="btn btn-outline-info">Harta Modal (HM)</a>
                                    <a href="aduanabr1" type="button" class="btn btn-outline-info">Aset Bernilai Rendah (ABR)</a>
                                    <a href="aduanata1" type="button" class="btn btn-outline-success">Komponen ATA</a>
                                    <a href="aduanata1" type="button" class="btn btn-outline-success">Struktur/Kekemasan ATA</a></p>
                                    <p class="card-text"><a href="{{URL::to('/')}}/storage/HM/carta_alir_aduan.pdf" target="_blank">Klik di sini untuk muat turun Carta Alir Aduan Kerosakan Aset Alih.</a></p>
                                    <p class="card-text"><a href="lokasibangunan">Klik di sini untuk melihat lokasi setiap bangunan.</a></p>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <h5 class="card-title">PERMOHONAN PELUPUSAN ASET ALIH </h5>
                                    <p class="card-text">Klik butang untuk permohonan pelupusan mengikut kategori aset.</p>
                                    <p><a href="mohonlupushm" type="button" class="btn btn-outline-secondary">Harta Modal (HM)</a>
                                    <a href="mohonlupusabr" type="button" class="btn btn-outline-secondary">Aset Bernilai Rendah (ABR)</a></p>
                                </div>

                                <div class="card-footer text-muted">
                                    Bahagian Pengurusan Dan Penyelenggaraan Aset, Institut Latihan Perindustrian Selandar.
                                </div>
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
