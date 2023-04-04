@extends('backend.layouts.app')

@section('title', __('Edit RFID Pelajar'))

@section('content')

<form method="POST" action="{{ route('admin.updaterfid', [$student,'term'=>request('term') ?? null]) }}">
    <div class="form-group">
        @csrf
        @method('PATCH')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Edit RFID Pelajar
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

                                <select class="form-control" name="course_id" disabled>
                                    <option value="{{ $student->course_id}}">{{ $student->course->kod ?? null}}-{{ $student->course->nama_kursus ?? null}}</option>
                                    <option value="0">Sila Pilih</option>

                                    @foreach($courses as $course)
                                    <option value="{{ $course->id}}" style="text-transform:uppercase">{{ $course->kod}}-{{ $course->nama_kursus}}</option>
                                    @endforeach

                                    </select>


                            </div><!--col-->

                            <label class="col-md-2 col-form-label">No. RFID</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="id_rfid" name="id_rfid" value="{{ $student->id_rfid ?? null}}">
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
