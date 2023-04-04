@extends('backend.layouts.app')

@section('title', __('Maklumat Aset Bernilai Rendah'))

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Maklumat Aset Bernilai Rendah
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">No. Barkod</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" {{-- id="no_barkod" name="no_barkod" --}} value="{{ $abr->barkod ?? null}}" disabled>
                        </div><!--col-->
                        
                        <label class="col-md-2 col-form-label">No. Siri Pendaftaran</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" {{-- id="no_siri_pendaftaran" name="no_siri_pendaftaran" --}} value="{{ $abr->no_siri_daftar ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Kod Nasional</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="kod_nasional" name="kod_nasional" --}} value="{{ $abr->kod_nasional ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Kategori</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="kategori" name="kategori" --}} value="{{ $abr->kategori ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Sub Kategori</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="sub_kategori" name="sub_kategori" --}} value="{{ $abr->sub_kategori ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Jenis</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="jenis" name="jenis" --}} value="{{ $abr->jenis ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Butiran</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="jenama" name="jenama" --}} value="{{ $abr->butiran ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">No. PTJ Bahagian</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" {{-- id="no_PTJ_bahagian" name="no_PTJ_bahagian" --}} value="{{ $abr->no_ptj ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">Jenis dan No. Enjin</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="jenis_no_enjin" name="jenis_no_enjin" --}} value="{{ $abr->no_engine ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-2 col-form-label">No Casis/Siri Pembuat</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="no_casis_siri_pembuat" name="no_casis_siri_pembuat" --}} value="{{ $abr->no_chasis ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">No. Pesanan Kerajaan</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="no_siri_pendaftaran_ken" name="no_psn_krjn" --}} value="{{ $abr->no_psn_krjn ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">No. VOT</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="no_VOT" name="no_VOT" --}} value="{{ $abr->no_vot ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">No. Rujukan Fail</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="no_rujukan_fail" name="no_rujukan_fail" --}} value="{{ $abr->no_rujukan_fail ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">Penyelenggaraan</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" {{-- id="selenggara" name="selenggara" --}} 
                            @if (empty($abr->selenggara))
                                value="Tidak"
                            @else
                                value="Ya"
                            @endif
                            
                             disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">Sumber Peruntukan</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" {{-- id="sumber_peruntukan" name="sumber_peruntukan" --}} value="{{ $abr->sumber_peruntukan ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Kos</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" {{-- id="kos" name="kos" --}} value="{{ number_format($abr->kos ?? null, 2) }}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">Bahagian Pengguna</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="bahagian_pengguna_asal" name="bahagian_pengguna_asal" --}} value="{{ $abr->bahagian_pengguna ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Pengguna</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="pengguna_asal" name="pengguna_asal" --}} value="{{ $abr->pengguna ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        
                        <label class="col-md-1 col-form-label">Status</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" {{-- id="perolehan" name="perolehan" --}} value="{{ $abr->status_alat->nama_status}}" disabled>
                        </div><!--col-->
                        
                        <label class="col-md-1 col-form-label">Perolehan</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" {{-- id="perolehan" name="perolehan" --}} value="{{ $abr->perolehan ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Tarikh Beli</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="tarikh_beli" name="tarikh_belian" --}} value="{{ $abr->tarikh_belian ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Kod Lokasi Asal</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="kod_lokasi_asal" name="lokasi_asal" --}} value="{{ $abr->lokasi_asal ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Bangunan</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" {{-- id="bangunan_id" name="bangunan_id" --}} value="{{ $abr->bangunan->kod_bangunan}}-{{ $abr->bangunan->nama_bangunan}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Aras</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" {{-- id="aras" name="aras" --}} value="{{ $abr->aras ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Kod Lokasi</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="kod_lokasi" name="kod_lokasi" --}} value="{{ $abr->kod_lokasi ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Nama Lokasi</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="" name="" value="{{ $abr->lokasi->nama_lokasi ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.abr',['term'=>request('term') ?? null]) }}" class="btn btn-dark">Back</a>
                </div><!--col-->

                <div class="col text-right">
                    <a href="{{ route('admin.editabr',[$abr,'term'=>request('term') ?? null]) }}" class="btn btn-primary">Edit</a>
                </div><!--col-->

            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->

@endsection
