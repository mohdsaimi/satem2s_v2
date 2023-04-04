@extends('backend.layouts.app')

@section('title', __('Tambah Pelajar'))

@section('content')

</head>

<form method="POST" action="{{ route('admin.storestudent') }}">
    <div class="form-group">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Tambah Pelajar Baru
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
                                <input type="text" class="form-control" id="nama_pelajar" name="nama_pelajar" placeholder="Nama Pelajar (HURUF BESAR)" required>
                            </div><!--col-->

                        </div><!--form-group-->

                        <div class="form-group row">

                            <label class="col-md-2 col-form-label">No KP</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control no_kp" id="no_kp" name="no_kp" placeholder="888888-88-8888" required>
                            </div><!--col-->

                            <label class="col-md-1 col-form-label">NDP</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="ndp" name="ndp" placeholder="NDP">
                            </div><!--col-->

                            <label class="col-md-2 col-form-label">Sesi Kemasukan</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="sesi_masuk" name="sesi_masuk" placeholder="Sesi/Tahun">
                            </div><!--col-->


                        </div><!--form-group-->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kursus</label>
                            <div class="col-md-5">

                                <select class="form-control" name="course_id">
                                    <option value="0">Sila Pilih</option>

                                    @foreach($courses as $course)
                                    <option value="{{ $course->id}}" style="text-transform:uppercase">{{ $course->kod}}-{{ $course->nama_kursus}}</option>
                                    @endforeach

                                    </select>


                            </div><!--col-->

                            <label class="col-md-2 col-form-label">No. Telefon Pelajar</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="no_tel" name="no_tel" placeholder="No. Telefon Pelajar">
                            </div><!--col-->

                        </div><!--form-group-->

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Alamat Pelajar</label>
                            <div class="col-md-10">
                                <textarea id="alamat" name="alamat" class="form-control" aria-label="With textarea"></textarea>
                            </div><!--col-->

                        </div><!--form-group-->

                        <hr />

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nama Waris</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="nama_waris" name="nama_waris" placeholder="Nama Waris (HURUF BESAR)">
                            </div><!--col-->

                        </div><!--form-group-->

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Alamat Waris</label>
                            <div class="col-md-10">
                                <textarea id="alamat_waris" name="alamat_waris" class="form-control" aria-label="With textarea"></textarea>
                            </div><!--col-->

                        </div><!--form-group-->

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">No. Telefon Waris</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="notel_waris" name="notel_waris" placeholder="No. Telefon Waris">
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
