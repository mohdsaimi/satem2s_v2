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

                

                <div class="links">
                    
                    <div class="row mt-4">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Bil.</th>
                                        <th>Nama</th>
                                        <th>Masa</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($log_ins_vip as $log_ins_vip)
            
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $log_ins_vip->id_rfid ?? null }}</td>
                                                <td>{{ $log_ins_vip->masa ?? null }}</td>
                                                <td>
            
                                                    {{-- butang --}}
                                                    <div class="btn-group btn-group-sm">
            
                                                        <form action="{{ route('frontend.konvo_del_1', [$log_ins_vip->id]) }}" method="POST">
                                                            <div class="btn-group btn-group-sm" {{-- aria-label="@lang('labels.backend.access.users.user_actions')" --}}>
                                                                
                
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" title="delete" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="delete"
                                                                    onclick="return confirm('Are you sure you want to delete the record? {{ $log_ins_vip->id ?? null }}')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                
                                                            </div>
                                                        </form>
            
                                                    </div>
                                                    {{-- end butang --}}
            
                                                </td>
            
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{$lokasis->appends(['term' => request('term'),'term1' => request('term1'),'inputState' => request('inputState')])->links()}} --}}
                            </div>
                        </div><!--col-->
                    </div><!--row-->

                    
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

