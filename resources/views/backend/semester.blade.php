@extends('backend.layouts.app')

@section('title', __('Pengurusan Semester'))

@section('content')

<form method="POST" action="{{ route('admin.update_semester') }}">
    <div class="form-group">
        @csrf
        {{-- @method('PATCH') --}}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Pengurusan Semester
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <!--row-->

                <hr />

                <div class="row mt-4">
                    <div class="col">
                        <p>Ubah semester pelajar berdasarkan sesi masuk pelajar</p>
                        <div class="form-group row">
                            <label class="col-md-1 col-form-label">Sesi Masuk</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="sesi_masuk" name="sesi_masuk" placeholder="Masukkan Sesi Masuk (X/XXXX)" required>
                            </div><!--col-->

                            <label class="col-md-1 col-form-label">Semester</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="semester" name="semester" placeholder="Masukkan Semester" required>
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
