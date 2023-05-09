@extends('backend.layouts.app')

@section('title', __('Log Alert'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Log Alert
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">


            </div><!--col-->

            <div class="col-sm-7">

            </div><!--col-->

        </div><!--row-->


        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Bil.</th>
                            <th>Lokasi</th>
                            <th>masa</th>
                            <th>Suhu</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($log_alerts as $log_alerts)

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td style="text-transform:uppercase">{{ $log_alerts->lokasi ?? null }}</td>
                                    <td>{{ $log_alerts->masa ?? null }}</td>
                                    <td>{{ $log_alerts->suhu ?? null}}</td>
                                    <td>


                                        {{-- butang --}}
                                        <form action="{{ route('admin.destroy_alert', [$log_alerts]) }}" method="POST">
                                            <div class="btn-group btn-group-sm" {{-- aria-label="@lang('labels.backend.access.users.user_actions')" --}}>
                                                
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="delete" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="delete"
                                                    onclick="return confirm('Are you sure you want to delete the record?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </form>
                                        {{-- end butang --}}

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    {{-- {{$log_alerts->links()}} --}}
                    {{-- {{$log_alerts->appends(['inputState' => request('inputState')])->links()}} --}}
                </div>
            </div><!--col-->
        </div><!--row-->

    </div><!--card-body-->
</div><!--card-->
@endsection
