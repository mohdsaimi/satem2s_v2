@extends('backend.layouts.app')

@section('title', __('Maklumat Pelajar'))

@section('content')

    <div class="form-group">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Maklumat Pelajar
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <!--row-->

                <hr />

                <div class="row mt-4">
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nama Pelajar</label>
                            <div class="col-md-10">
                                <p class="card-text mt-2" style="text-transform:uppercase">{{ $student->nama_pelajar ?? null}}</p>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">

                            <label class="col-md-2 col-form-label">No KP</label>
                            <div class="col-md-3">
                                <p class="card-text mt-2">{{ $student->no_kp ?? null}}</p>
                            </div><!--col-->


                            <label class="col-md-1 col-form-label">NDP</label>
                            <div class="col-md-2">
                                <p class="card-text mt-2">{{ $student->ndp ?? null}}</p>
                            </div><!--col-->

                            <label class="col-md-2 col-form-label">Sesi Kemasukan</label>
                            <div class="col-md-2">
                                <p class="card-text mt-2">{{ $student->sesi_masuk ?? null}}</p>
                            </div><!--col-->


                        </div><!--form-group-->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kursus</label>
                            <div class="col-md-5">
                                <p class="card-text mt-2" style="text-transform:uppercase">{{ $student->course->kod ?? null}}-{{ $student->course->nama_kursus ?? null}}</p>
                            </div><!--col-->

                            <label class="col-md-2 col-form-label">No. Telefon Pelajar</label>
                            <div class="col-md-3">
                                <p class="card-text mt-2">{{ $student->no_tel ?? null}}</p>
                            </div><!--col-->

                        </div><!--form-group-->

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Alamat Pelajar</label>
                            <div class="col-md-10">
                                <p class="card-text mt-2" style="text-transform:uppercase">{{ $student->alamat ?? null}}</p>
                            </div><!--col-->

                        </div><!--form-group-->

                        <hr />

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nama Waris</label>
                            <div class="col-md-10">
                                <p class="card-text mt-2" style="text-transform:uppercase">{{ $student->nama_waris ?? null}}</p>
                            </div><!--col-->

                        </div><!--form-group-->

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Alamat Waris</label>
                            <div class="col-md-10">
                                <p class="card-text mt-2" style="text-transform:uppercase">{{ $student->alamat_waris ?? null}}</p>
                            </div><!--col-->

                        </div><!--form-group-->

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">No. Telefon Waris</label>
                            <div class="col-md-10">
                                <p class="card-text mt-2">{{ $student->notel_waris ?? null}}</p>
                            </div><!--col-->

                        </div><!--form-group-->

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('admin.student',['term'=>request('term') ?? null]) }}" class="btn btn-dark">Back</a>
                    </div><!--col-->

                    <div class="col text-right">
                        <a href="{{ route('admin.editstudent',[$student,'term'=>request('term') ?? null]) }}" class="btn btn-primary">Edit</a>

                    </div><!--col-->

                    <form action="{{ route('admin.destroystudent', [$student,'term'=>request('term') ?? null]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button {{-- href="{{ route('admin.destroystudent', $student) }}" --}} type="submit" title="delete" class="btn btn-danger text-light" data-toggle="tooltip" data-placement="top"
                            onclick="return confirm('Are you sure you want to delete the record?')">
                            Delete{{-- <i class="fas fa-trash"></i> --}}
                        </button>
                    </form>

                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    </div>

@endsection
