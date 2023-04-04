@extends('backend.layouts.app')

@section('title', __('Pengurusan Kursus'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Senarai Kursus
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">

                <div class="btn-toolbar float-right">
                    <a href="{{ route('admin.createcourse') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create"><i class="fas fa-plus-circle"></i></a>
                </div>

            </div><!--col-->

            {{-- <div class="col-sm-7">
                <form action="{{ route('admin.lokasistok') }}" method="GET" role="search">

                    <div class="input-group">
                        <label class="my-1 mr-2 font-weight-bold">Cari</label>
                        <input type="text" class="form-control mr-2" name="term" placeholder="Masukkan kata carian" id="term">

                        <span class="input-group-btn mr-2">
                            <button class="btn btn-info" type="submit" title="Cari">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>

                          <a href="{{ route('admin.lokasistok') }}">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button" title="Refresh page">
                                    <span class="fas fa-sync-alt"></span>
                                </button>
                            </span>
                        </a>
                    </div>
                </form>
            </div><!--col--> --}}

        </div><!--row-->


        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Bil.</th>
                            <th>Kod Kursus</th>
                            <th>Nama Kursus</th>
                            <th>Kod NOSS</th>
                            <th>Nama NOSS</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($course as $course)

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td style="text-transform:uppercase">{{ $course->kod ?? null }}</td>
                                    <td style="text-transform:uppercase">{{ $course->nama_kursus ?? null }}</td>
                                    <td style="text-transform:uppercase">{{ $course->kod_noss ?? null}}</td>
                                    <td style="text-transform:uppercase">{{ $course->nama_noss ?? null}}</td>
                                    <td>


                                        {{-- butang --}}
                                        <form action="{{ route('admin.destroycourse', $course) }}" method="POST">
                                            <div class="btn-group btn-group-sm" {{-- aria-label="@lang('labels.backend.access.users.user_actions')" --}}>
                                                {{-- <a href="#" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="show">
                                                    <i class="fas fa-eye"></i>
                                                </a> --}}

                                                <a href="{{ route('admin.editcourse',$course) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

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
                    {{-- {{$stoks->appends(['term' => request('term'),'inputState' => request('inputState')])->links()}} --}}
                </div>
            </div><!--col-->
        </div><!--row-->

    </div><!--card-body-->
</div><!--card-->
@endsection
