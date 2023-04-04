@extends('frontend.layouts.app')

@section('title', __('Papar Permohonan Pelupusan Aset Alih (Harta Modal)'))

@section('content')

<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="card-title mb-0">
                        Papar Permohonan Pelupusan Aset Alih (Harta Modal)
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
                            <input type="hidden" name="harta_modal_id" value="{{ $hmlupus->harta_modal_id }}">
                            <input type="text" class="form-control" {{-- id="no_siri_pendaftaran" name="no_siri_pendaftaran" --}} value="{{ $hmlupus->hartamodal->no_siri_pendaftaran ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">No Casis/Siri Pembuat</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="no_casis_siri_pembuat" name="no_casis_siri_pembuat" --}} value="{{ $hmlupus->hartamodal->no_casis_siri_pembuat ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Tarikh Beli</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="tarikh_beli" name="tarikh_beli" --}} value="{{ $hmlupus->hartamodal->tarikh_beli ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Kategori</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="kategori" name="kategori" --}} value="{{ $hmlupus->hartamodal->kategori ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Sub Kategori</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="sub_kategori" name="sub_kategori" --}} value="{{ $hmlupus->hartamodal->sub_kategori ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Jenis</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="jenis" name="jenis" --}} value="{{ $hmlupus->hartamodal->jenis ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Jenama</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="jenama" name="jenama" --}} value="{{ $hmlupus->hartamodal->jenama ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Kod Lokasi Asal</label>
                        <div class="col-sd">
                            <input type="text" class="form-control" {{-- id="kod_lokasi_asal" name="kod_lokasi_asal" --}} value="{{ $hmlupus->hartamodal->kod_lokasi_asal ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Lokasi</label>
                        <div class="col-md">
                            <input type="text" style="text-transform:uppercase" class="form-control" id="" name="" value="{{ $hmlupus->hartamodal->bangunan->nama_bangunan}} ({{ $hmlupus->hartamodal->bangunan->kod_bangunan}}) Aras {{ $hmrosak->hartamodal->aras ?? null}} - {{ $hmrosak->hartamodal->lokasi->nama_lokasi ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <hr />

                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">KEW.PA3</label>
                        <div class="col-md-3">
                            <a href="{{ asset('storage/HM_LUPUS/'.$hmlupus->kewpa3) }}" target="_BLANK">Klik untuk salinan KEW.PA3</a>
                        </div><!--col-->

                    </div>

                    <hr />

                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">Gambar</label>
                        <div class="col-md-3">
                            <img src="{{ asset('storage/HM_LUPUS/'.$hmlupus->pic_1) }}" class="rounded mx-auto d-block" width="300px;" alt="pic_1">
                        </div><!--col-->

                        @if (!empty($hmlupus->pic_2))
                        <div class="col-md-3">
                            <img src="{{ asset('storage/HM_LUPUS/'.$hmlupus->pic_2) }}" class="rounded mx-auto d-block" width="300px;" alt="pic_2">
                        </div><!--col-->
                        @endif

                        @if (!empty($hmlupus->pic_3))
                        <div class="col-md-3">
                            <img src="{{ asset('storage/HM_LUPUS/'.$hmlupus->pic_3) }}" class="rounded mx-auto d-block" width="300px;" alt="pic_3">
                        </div><!--col-->
                        @endif

                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Tahap Prestasi Semasa Aset (%)</b></label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="prestasi" name="prestasi" value="{{ $hmlupus->prestasi }}" disabled>
                        </div><!--col-->

                        <label class="col-md-3 col-form-label"><b>Jumlah Kos Penyelenggaraan Terdahulu</b></label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="kod_dulu" name="kod_dulu" value="{{ $hmlupus->kod_dulu }}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label"><b>Nilai Semasa</b></label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="nilai_semasa" name="nilai_semasa" value="{{ $hmlupus->nilai_semasa }}" disabled>
                        </div><!--col-->

                        <label class="col-md col-form-label"><b>Tahun Pelupusan</b></label>
                            <div class="col-md">
                                <input type="text" class="form-control" id="tahun_lupus" name="tahun_lupus" value="{{ $hmlupus->tahun_lupus }}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-6 col-form-label"><b>Justifikasi</b>

                            <div class="input-group mb-3">
                                <label class="col-md-1 col-form-label">1</label>
                                <select class="form-control col-md-10" name="jus_1" id="jus_1" disabled>
                                    <option value="{{ $hmlupus->jus_1 }}" selected>{{ $hmlupus->jus_1 }}</option>
                                    <option value="">Sila Pilih</option>
                                    <option value="Tidak ekonomik untuk dibaiki">Tidak ekonomik untuk dibaiki</option>
                                    <option value="Rosak dan tidak boleh digunakan">Rosak dan tidak boleh digunakan</option>
                                    <option value="Usang">Usang</option>
                                    <option value="Luput tempoh penggunaan">Luput tempoh penggunaan</option>
                                    <option value="Keupayaan aset tidak lagi di peringkat optimum">Keupayaan aset tidak lagi di peringkat optimum</option>
                                    <option value="Tiada alat ganti di pasaran">Tiada alat ganti di pasaran</option>
                                    <option value="Pembekal tidak lagi memberi khidmat sokongan">Pembekal tidak lagi memberi khidmat sokongan</option>
                                    <option value="Tidak lagi diperlukan jabatan">Tidak lagi diperlukan jabatan</option>
                                    <option value="Perubahan teknologi">Perubahan teknologi</option>
                                    <option value="Melebihi keperluan">Melebihi keperluan</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <label class="col-md-1 col-form-label">2</label>
                                <select class="form-control col-md-10" name="jus_2" id="jus_2" disabled>
                                    <option value="{{ $hmlupus->jus_2 }}" selected>{{ $hmlupus->jus_2 }}</option>
                                    <option value="">Sila Pilih</option>
                                    <option value="Tidak ekonomik untuk dibaiki">Tidak ekonomik untuk dibaiki</option>
                                    <option value="Rosak dan tidak boleh digunakan">Rosak dan tidak boleh digunakan</option>
                                    <option value="Usang">Usang</option>
                                    <option value="Luput tempoh penggunaan">Luput tempoh penggunaan</option>
                                    <option value="Keupayaan aset tidak lagi di peringkat optimum">Keupayaan aset tidak lagi di peringkat optimum</option>
                                    <option value="Tiada alat ganti di pasaran">Tiada alat ganti di pasaran</option>
                                    <option value="Pembekal tidak lagi memberi khidmat sokongan">Pembekal tidak lagi memberi khidmat sokongan</option>
                                    <option value="Tidak lagi diperlukan jabatan">Tidak lagi diperlukan jabatan</option>
                                    <option value="Perubahan teknologi">Perubahan teknologi</option>
                                    <option value="Melebihi keperluan">Melebihi keperluan</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <label class="col-md-1 col-form-label">3</label>
                                <select class="form-control col-md-10" name="jus_3" id="jus_3" disabled>
                                    <option value="{{ $hmlupus->jus_3 }}" selected>{{ $hmlupus->jus_3 }}</option>
                                    <option value="">Sila Pilih</option>
                                    <option value="Tidak ekonomik untuk dibaiki">Tidak ekonomik untuk dibaiki</option>
                                    <option value="Rosak dan tidak boleh digunakan">Rosak dan tidak boleh digunakan</option>
                                    <option value="Usang">Usang</option>
                                    <option value="Luput tempoh penggunaan">Luput tempoh penggunaan</option>
                                    <option value="Keupayaan aset tidak lagi di peringkat optimum">Keupayaan aset tidak lagi di peringkat optimum</option>
                                    <option value="Tiada alat ganti di pasaran">Tiada alat ganti di pasaran</option>
                                    <option value="Pembekal tidak lagi memberi khidmat sokongan">Pembekal tidak lagi memberi khidmat sokongan</option>
                                    <option value="Tidak lagi diperlukan jabatan">Tidak lagi diperlukan jabatan</option>
                                    <option value="Perubahan teknologi">Perubahan teknologi</option>
                                    <option value="Melebihi keperluan">Melebihi keperluan</option>
                                </select>
                            </div>

                        </label>


                    </div>



                    
                    


                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a href="{{ url()->previous() }}" class="btn btn-primary">back</a>
                </div><!--col-->


            </div><!--row-->
        </div><!--card-footer-->

    </div><!--card-->
</div>
@endsection
