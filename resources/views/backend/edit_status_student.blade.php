@extends('backend.layouts.app')

@section('title', __('Edit Status Pelajar'))

@section('content')

<form method="POST" action="{{ route('admin.update_status_student',  [$student,'term'=>request('term') ?? null]) }}">
    <div class="form-group">
        @csrf
        @method('PATCH')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Edit Status Pelajar
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
                                <input type="text" class="form-control" id="nama_pelajar" name="nama_pelajar" value="{{ $student->nama_pelajar ?? null}}" disabled>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">

                            <label class="col-md-2 col-form-label">No KP</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="no_kp" name="no_kp" value="{{ $student->no_kp ?? null}}" disabled>
                            </div><!--col-->


                            <label class="col-md-1 col-form-label">NDP</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="ndp" name="ndp" value="{{ $student->ndp ?? null}}" disabled>
                            </div><!--col-->

                            <label class="col-md-2 col-form-label">Sesi Kemasukan</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="sesi_masuk" name="sesi_masuk" value="{{ $student->sesi_masuk ?? null}}" disabled>
                            </div><!--col-->


                        </div><!--form-group-->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kursus</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="course_id" name="course_id" value="{{ $student->course->kod ?? null}}-{{ $student->course->nama_kursus ?? null}}" disabled>
                            </div><!--col-->

                            <label class="col-md-2 col-form-label">No. Telefon Pelajar</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="no_tel" name="no_tel" value="{{ $student->no_tel ?? null}}" disabled>
                            </div><!--col-->

                        </div><!--form-group-->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status Pelajar</label>
                            <div class="col-md-5">

                                <select class="form-control" name="status_id">
                                    <option value="{{ $student->status_id}}">{{ $student->status->nama_status ?? null}}</option>
                                    <option value="0">Sila Pilih</option>

                                    @foreach($statuss as $status)
                                    <option value="{{ $status->id}}" style="text-transform:uppercase">{{ $status->nama_status}}</option>
                                    @endforeach

                                    </select>

                            </div><!--col-->
                        </div><!--form-group-->

                        
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                    </div><!--col-->

                    <div class="col text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    </div>
</form>
@endsection
