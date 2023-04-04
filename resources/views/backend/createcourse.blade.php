@extends('backend.layouts.app')

@section('title', __('Tambah Kursus'))

@section('content')

{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> --}}

<form method="POST" action="{{ route('admin.storecourse') }}">
    <div class="form-group">
        @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Tambah Kursus Baru
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
                            <input type="text" class="form-control" id="kod" name="kod" placeholder="Kod Kursus" required>
                        </div><!--col-->

                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nama Kursus</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="nama_kursus" name="nama_kursus" placeholder="Nama Kursus" required>
                        </div><!--col-->

                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kod NOSS</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="kod_noss" name="kod_noss" placeholder="Kod NOSS">
                        </div><!--col-->

                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nama NOSS</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="nama_noss" name="nama_noss" placeholder="Nama NOSS">
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
</form>
@endsection
