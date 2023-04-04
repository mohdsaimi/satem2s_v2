@extends('backend.layouts.app')

@section('title', __('Maklumat Harta Modal'))

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Maklumat Harta Modal
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">No. Barkod</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" {{-- id="no_barkod" name="no_barkod" --}} value="{{ $hartamodal->no_barkod ?? null}}" disabled>
                        </div><!--col-->
                        
                        <label class="col-md-2 col-form-label">No. Siri Pendaftaran</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" {{-- id="no_siri_pendaftaran" name="no_siri_pendaftaran" --}} value="{{ $hartamodal->no_siri_pendaftaran ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Kod Nasional</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="kod_nasional" name="kod_nasional" --}} value="{{ $hartamodal->kod_nasional ?? null}}" disabled>
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

                        <label class="col-md-2 col-form-label">No. PTJ Bahagian</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" {{-- id="no_PTJ_bahagian" name="no_PTJ_bahagian" --}} value="{{ $hartamodal->no_PTJ_bahagian ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">Jenis dan No. Enjin</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="jenis_no_enjin" name="jenis_no_enjin" --}} value="{{ $hartamodal->jenis_no_enjin ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-2 col-form-label">No Casis/Siri Pembuat</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="no_casis_siri_pembuat" name="no_casis_siri_pembuat" --}} value="{{ $hartamodal->no_casis_siri_pembuat ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">No. Siri Pendaftaran (Kenderaan)</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="no_siri_pendaftaran_ken" name="no_siri_pendaftaran_ken" --}} value="{{ $hartamodal->no_siri_pendaftaran_ken ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">No. VOT</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="no_VOT" name="no_VOT" --}} value="{{ $hartamodal->no_VOT ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">No. Rujukan Fail</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="no_rujukan_fail" name="no_rujukan_fail" --}} value="{{ $hartamodal->no_rujukan_fail ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">No. Pesanan Kerajaan</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" {{-- id="no_psn_krjn" name="no_psn_krjn" --}} value="{{ $hartamodal->no_psn_krjn ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">Sumber Peruntukan</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" {{-- id="sumber_peruntukan" name="sumber_peruntukan" --}} value="{{ $hartamodal->sumber_peruntukan ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Kos</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" {{-- id="kos" name="kos" --}} value="{{ number_format($hartamodal->kos ?? null, 2) }}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">Bahagian Pengguna</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="bahagian_pengguna_asal" name="bahagian_pengguna_asal" --}} value="{{ $hartamodal->bahagian_pengguna_asal ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Pengguna</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="pengguna_asal" name="pengguna_asal" --}} value="{{ $hartamodal->pengguna_asal ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        
                        <label class="col-md-1 col-form-label">Status</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" {{-- id="perolehan" name="perolehan" --}} value="{{ $hartamodal->status_alat->nama_status}}" disabled>
                        </div><!--col-->
                        
                        <label class="col-md-1 col-form-label">Perolehan</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" {{-- id="perolehan" name="perolehan" --}} value="{{ $hartamodal->perolehan ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Tarikh Beli</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="tarikh_beli" name="tarikh_beli" --}} value="{{ $hartamodal->tarikh_beli ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Kod Lokasi Asal</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="kod_lokasi_asal" name="kod_lokasi_asal" --}} value="{{ $hartamodal->kod_lokasi_asal ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Bangunan</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" {{-- id="bangunan_id" name="bangunan_id" --}} value="{{ $hartamodal->bangunan->kod_bangunan}}-{{ $hartamodal->bangunan->nama_bangunan}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Aras</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" {{-- id="aras" name="aras" --}} value="{{ $hartamodal->aras ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Kod Lokasi</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="kod_lokasi" name="kod_lokasi" --}} value="{{ $hartamodal->kod_lokasi ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Nama Lokasi</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="" name="" value="{{ $hartamodal->lokasi->nama_lokasi ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.hartamodal',['term'=>request('term') ?? null]) }}" class="btn btn-dark">Back</a>
                </div><!--col-->

                <div class="col text-right">
                    <a href="{{ route('admin.edithartamodal',[$hartamodal,'term'=>request('term') ?? null]) }}" class="btn btn-primary">Edit</a>
                </div><!--col-->

            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->

@endsection
