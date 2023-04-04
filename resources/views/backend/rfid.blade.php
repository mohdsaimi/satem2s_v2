@extends('backend.layouts.app')

@section('title', __('Pengurusan RFID'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Pengurusan RFID
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">

                <div class="btn-toolbar float-right">
                    <p>&nbsp;</p>{{-- <a href="{{ route('admin.createstudent') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create"><i class="fas fa-plus-circle"></i></a> --}}
                </div>

            </div><!--col-->

            <div class="col-sm-7">
                <form action="{{ route('admin.rfid') }}" method="GET" role="search">

                    <div class="input-group">
                        <label class="my-1 mr-2 font-weight-bold">Cari</label>
                        <input type="text" class="form-control mr-2" name="term" placeholder="Masukkan kata carian" id="term">

                        <span class="input-group-btn mr-2">
                            <button class="btn btn-info" type="submit" title="Cari">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>

                        <a href="{{ route('admin.rfid') }}">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button" title="Refresh page">
                                    <span class="fas fa-sync-alt"></span>
                                </button>
                            </span>
                        </a>
                    </div>
                </form>
            </div><!--col-->

        </div><!--row-->


        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Bil.</th>
                            <th>Nama Pelajar</th>
                            <th>No. KP</th>
                            <th>NDP</th>
                            <th>Kursus</th>
                            <th>Sesi Kemasukan</th>
                            <th>Semester</th>
                            <th>No. RFID</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td style="text-transform:uppercase">{{ $student->nama_pelajar ?? null }}</td>
                                    <td>{{ $student->no_kp ?? null }}</td>
                                    <td>{{ $student->ndp ?? null}}</td>
                                    <td style="text-transform:uppercase">{{ $student->course->kod ?? null}}</td>
                                    <td>{{ $student->sesi_masuk ?? null}}</td>
                                    <td>{{ $student->semester ?? null}}</td>
                                    <td>{{ $student->id_rfid ?? null}}</td>
                                    <td>


                                        {{-- butang --}}
                                        <form action="{{ route('admin.destroystudent', $student) }}" method="POST">
                                            <div class="btn-group btn-group-sm" {{-- aria-label="@lang('labels.backend.access.users.user_actions')" --}}>
                                                {{-- <a href="{{ route('admin.showstudent',$student) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="show">
                                                    <i class="fas fa-eye"></i>
                                                </a> --}}

                                                <a href="{{ route('admin.editrfid',[$student,'term'=>request('term') ?? null]) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- @csrf
                                                @method('DELETE')
                                                <button type="submit" title="delete" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="delete"
                                                    onclick="return confirm('Are you sure you want to delete the record?')">
                                                    <i class="fas fa-trash"></i>
                                                </button> --}}
                                            </div>
                                        </form>
                                        {{-- end butang --}}

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{$students->links()}} --}}
                    {{$students->appends(['term' => request('term'),'inputState' => request('inputState')])->links()}}
                </div>
            </div><!--col-->
        </div><!--row-->

    </div><!--card-body-->
</div><!--card-->
@endsection
