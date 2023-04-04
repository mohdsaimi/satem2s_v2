@extends('backend.layouts.app')

@section('title', __('Aduan Kerosakan Harta Modal'))

@section('content')

<form method="POST" action="{{ route('admin.storehmrosak') }}" enctype="multipart/form-data">
    <div class="form-group">
        @csrf
        {{-- @method('PATCH') --}}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Aduan Kerosakan Harta Modal
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">

                    <div class="form-group row">
                        
                        <label class="col-md-2 col-form-label">No. Siri Pendaftaran</label>
                        <div class="col-md-2">
                            <input type="hidden" name="harta_modal_id" value="{{ $hartamodal->id }}">
                            <input type="text" class="form-control" {{-- id="no_siri_pendaftaran" name="no_siri_pendaftaran" --}} value="{{ $hartamodal->no_siri_pendaftaran ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">No Casis/Siri Pembuat</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="no_casis_siri_pembuat" name="no_casis_siri_pembuat" --}} value="{{ $hartamodal->no_casis_siri_pembuat ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Tarikh Beli</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="tarikh_beli" name="tarikh_beli" --}} value="{{ $hartamodal->tarikh_beli ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Kategori</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="kategori" name="kategori" --}} value="{{ $hartamodal->kategori ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Sub Kategori</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="sub_kategori" name="sub_kategori" --}} value="{{ $hartamodal->sub_kategori ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Jenis</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="jenis" name="jenis" --}} value="{{ $hartamodal->jenis ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Jenama</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="jenama" name="jenama" --}} value="{{ $hartamodal->jenama ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Kod Lokasi Asal</label>
                        <div class="col-sd">
                            <input type="text" class="form-control" {{-- id="kod_lokasi_asal" name="kod_lokasi_asal" --}} value="{{ $hartamodal->kod_lokasi_asal ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Lokasi</label>
                        <div class="col-md">
                            <input type="text" style="text-transform:uppercase" class="form-control" id="" name="" value="{{ $hartamodal->bangunan->nama_bangunan}} ({{ $hartamodal->bangunan->kod_bangunan}}) Aras {{ $hartamodal->aras ?? null}} - {{ $hartamodal->lokasi->nama_lokasi ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <hr />

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Pengguna Terakhir</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="penguna_akhir" name="penguna_akhir" placeholder="Nama Pengguna Terakhir" required>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">Tarikh Kerosakan</label>
                        <div class="col-md">
                            <input type="date" class="form-control mb-2 mr-sm-2" id="datepicker" name="tarikh_rosak" width="200" placeholder="YYYY/MM/DD" required>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Perihal Kerosakan</label>
                        <div class="col-md">
                            <textarea class="form-control" id="prihal_rosak" name="prihal_rosak" placeholder="Nyatakan perihal kerosakan dengan terperinci" required></textarea>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Gambar 1</label>
                        <div class="col-md-2">
                            <input type="file" name="pic_1" required>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Gambar 2</label>
                        <div class="col-md-2">
                            <input type="file" name="pic_2">
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Gambar 3</label>
                        <div class="col-md-2">
                            <input type="file" name="pic_3">
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">Pelapor</label>
                            <div class="col-md-3">

                            <select class="form-control" name="user_id" required>
                                <option value="">Sila Pilih</option>
                                @foreach($kakitangan as $kakitangan)
                                <option value="{{ $kakitangan->id}}" style="text-transform:uppercase">{{ $kakitangan->nama}}</option>
                                @endforeach
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

