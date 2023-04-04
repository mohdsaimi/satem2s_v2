@extends('backend.layouts.app')

@section('title', __('Tambah Lokasi'))

@section('content')

<form method="POST" action="{{ route('admin.storelokasi') }}">
    <div class="form-group">
        @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Tambah Lokasi Ruang Baru
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Bangunan</label>

                        <div class="col-md-5">

                            <select class="form-control" name="bangunan_id" required>
                                <option value="">Sila Pilih</option>
                                @foreach($bangunan as $bangunan)
                                <option value="{{ $bangunan->id}}" style="text-transform:uppercase">{{ $bangunan->kod_bangunan}}-{{ $bangunan->nama_bangunan}}</option>
                                @endforeach
                                </select>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Aras</label>

                        <div class="col-md">
                                <input type="text" class="form-control" id="aras" name="aras" placeholder="Aras" required>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kod Lokasi</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="kod_lokasi" name="kod_lokasi" placeholder="Kod Lokasi" required>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">Nama Lokasi</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" placeholder="Nama Lokasi" required>
                        </div><!--col-->

                    </div><!--form-group-->
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Pengumpul Data</label>
                            <div class="col-md-3">

                            <select class="form-control" name="nama_1" required>
                                <option value="">Sila Pilih</option>
                                @foreach($kakitangans as $kakitangan)
                                <option value="{{ $kakitangan->id}}" style="text-transform:uppercase">{{ $kakitangan->nama}}</option>
                                @endforeach
                                </select>
                            </div><!--col-->

                        <label class="col-md-2 col-form-label">Pengesah Data</label>
                            <div class="col-md-3">

                            <select class="form-control" name="nama_2" required>
                                <option value="">Sila Pilih</option>
                                @foreach($kakitangans as $kakitangan)
                                <option value="{{ $kakitangan->id}}" style="text-transform:uppercase">{{ $kakitangan->nama}}</option>
                                @endforeach
                                </select>
                            </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Catatan</label>
                        <div class="col-md">
                            <textarea class="form-control" id="catatan" name="catatan" placeholder="Catatan" ></textarea>
                        </div><!--col-->

                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Penyelenggaraan Struktur</label>
                            <div class="col-md-3">

                            <select class="form-control" name="selangar_struktur" required>
                                <option value="0" selected>Tidak</option>
                                <option value="1">Ya</option>
                                </select>
                            </div><!--col-->
                    </div>

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
