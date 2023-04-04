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
        @include('includes.partials.announcements')

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
                    {{-- <example-component></example-component> --}}
                    {{-- <p><i class="fas fa-fingerprint"></i> SATEM2S</p> --}}
                    <img src="{{ asset('img/satem2s-new.jpeg') }}" class="rounded mx-auto d-block" width="800px;" alt="satem2s">

                </div><!--title-->

                <div class="links">
                    <p><h3><b>S</b>mart <b>A</b>ttendance with <b>TEM</b>perature <b>S</b>creening <b>S</b>ystem</h3></p>
                    {{-- <a href="http://laravel-boilerplate.com" target="_blank"><i class="fa fa-book"></i> @lang('Docs')</a>
                    <a href="https://github.com/rappasoft/laravel-boilerplate" target="_blank"><i class="fab fa-github"></i> GitHub</a> --}}
                </div><!--links-->

                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <p><h3></h3>
                            </p>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">

                        <table class="table table-borderless table-hover">
                            <thead>
                                <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    {{-- <td class="align-middle"><h1><i class="fas fa-fingerprint"></i> SATEM2S</h1></td> --}}
                                    <td style="text-align: justify">
                                        <h5>
                                        <p><b>S</b>mart <b>A</b>ttendance with <b>TEM</b>perature <b>S</b>creening <b>S</b>ystem memperkenalkan paradigma baru untuk memantau kehadiran pelajar menggunakan Radio Frequency Identification (RFID) berdasarkan Internet of Things (IoT) dan dalam masa yang sama dapat membuat saringan suhu badan pelajar sebelum sesi latihan dilaksanakan.</p>
                                        <p><b>SATEM2S</b> ini merupakan sistem pemantauan kehadiran dan saringan suhu badan masa nyata (real time) yang dapat diakses oleh pelbagai pihak.</p>
                                        <p><a href="kehadiran-1" {{-- target="_blank" --}}>Klik di sini untuk menyemak kehadiran anda.</a></p>
                                        <p><a href="https://forms.gle/BJEHCmtbYCPKvY4Y8" target="_blank">Klik di sini untuk memberi maklumbalas.</a></p>
                                        </h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                        
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
