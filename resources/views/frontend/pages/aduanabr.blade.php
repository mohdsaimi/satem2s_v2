@extends('frontend.layouts.app')

@section('title', __('Aduan Kerosakan Aset Alih (ABR)'))

@section('content')

<form method="POST" action="{{ route('frontend.storeabrrosak') }}" enctype="multipart/form-data">
    <div class="form-group">
        @csrf
        {{-- @method('PATCH') --}}
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Aduan Kerosakan Aset Alih (ABR)
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <!--row-->

                <hr />

                <div class="row mt-4">
                    <div class="col">

                        <div class="form-group row">
                            
                            <label class="col-md-2 col-form-label">No. Siri Pendaftaran</label>
                            <div class="col-md-3">
                                <input type="hidden" name="abr_id" value="{{ $abr->id }}">
                                <input type="text" class="form-control" {{-- id="no_siri_pendaftaran" name="no_siri_pendaftaran" --}} value="{{ $abr->no_siri_daftar ?? null}}" disabled>
                            </div><!--col-->

                            <label class="col-md-2 col-form-label">No Casis/Siri Pembuat</label>
                            <div class="col-md">
                                <input type="text" class="form-control" {{-- id="no_casis_siri_pembuat" name="no_casis_siri_pembuat" --}} value="{{ $abr->no_chasis ?? null}}" disabled>
                            </div><!--col-->
                        </div>

                        <div class="form-group row">

                            <label class="col-md-2 col-form-label">Tarikh Beli</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" {{-- id="tarikh_beli" name="tarikh_beli" --}} value="{{ $abr->tarikh_belian ?? null}}" disabled>
                            </div><!--col-->

                            <label class="col-md-1 col-form-label">Kategori</label>
                            <div class="col-md">
                                <input type="text" class="form-control" {{-- id="kategori" name="kategori" --}} value="{{ $abr->kategori ?? null}}" disabled>
                            </div><!--col-->

                        </div>

                        <div class="form-group row">

                            <label class="col-md-2 col-form-label">Sub Kategori</label>
                            <div class="col-md">
                                <input type="text" class="form-control" {{-- id="sub_kategori" name="sub_kategori" --}} value="{{ $abr->sub_kategori ?? null}}" disabled>
                            </div><!--col-->

                            <label class="col-md-1 col-form-label">Jenis</label>
                            <div class="col-md">
                                <input type="text" class="form-control" {{-- id="jenis" name="jenis" --}} value="{{ $abr->jenis ?? null}}" disabled>
                            </div><!--col-->

                        </div>

                        <div class="form-group row">

                            <label class="col-md-2 col-form-label">Butiran</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" {{-- id="jenama" name="jenama" --}} value="{{ $abr->butiran ?? null}}" disabled>
                            </div><!--col-->

                            <label class="col-md-2 col-form-label">Kod Lokasi Asal</label>
                            <div class="col-md">
                                <input type="text" class="form-control" {{-- id="kod_lokasi_asal" name="kod_lokasi_asal" --}} value="{{ $abr->lokasi_asal ?? null}}" disabled>
                            </div><!--col-->

                        </div>

                        <div class="form-group row">

                            <label class="col-md-2 col-form-label">Lokasi</label>
                            <div class="col-md">
                                <input type="text" style="text-transform:uppercase" class="form-control" id="" name="" value="{{ $abr->bangunan->nama_bangunan}} ({{ $abr->bangunan->kod_bangunan}}) Aras {{ $abr->aras ?? null}} - {{ $abr->lokasi->nama_lokasi ?? null}}" disabled>
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
                            <label class="col-md-2 col-form-label">No. KP Pelapor</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="nokp" name="nokp" placeholder="No. Kad Pengenalan Pelapor Tanpa (-)" required>
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
    </div>
</form>
@endsection

