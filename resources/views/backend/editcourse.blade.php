@extends('backend.layouts.app')

@section('title', __('Edit Kursus'))

@section('content')

<form method="POST" action="{{ route('admin.updatecourse', $course) }}">
    <div class="form-group">
        @csrf
        @method('PATCH')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Edit Kursus
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kod</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="kod" name="kod" value="{{ $course->kod ?? null}}" required>
                        </div><!--col-->

                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nama Kursus</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="nama_kursus" name="nama_kursus" value="{{ $course->nama_kursus ?? null}}" required>
                        </div><!--col-->

                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kod NOSS</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="kod_noss" name="kod_noss" value="{{ $course->kod_noss ?? null}}">
                        </div><!--col-->

                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nama NOSS</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="nama_noss" name="nama_noss" value="{{ $course->nama_noss ?? null}}">
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
                    <button type="submit" class="btn btn-primary">Update</button>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
</form>
@endsection
