@extends('frontend.layouts.app')

@section('title', __('Permohonan Pelupusan Aset Alih (Harta Modal)'))

@section('content')

<form method="POST" action="{{ route('frontend.storehmlupus') }}" enctype="multipart/form-data">
    <div class="form-group">
        @csrf
        {{-- @method('PATCH') --}}
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="card-title mb-0">
                            Permohonan Pelupusan Aset Alih (Harta Modal)
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
                                <input type="hidden" name="harta_modal_id" value="{{ $hartamodal->id }}">
                                <input type="text" class="form-control" {{-- id="no_siri_pendaftaran" name="no_siri_pendaftaran" --}} value="{{ $hartamodal->no_siri_pendaftaran ?? null}}" disabled>
                            </div><!--col-->

                            <label class="col-md-2 col-form-label">No Casis/Siri Pembuat</label>
                            <div class="col-md">
                                <input type="text" class="form-control" {{-- id="no_casis_siri_pembuat" name="no_casis_siri_pembuat" --}} value="{{ $hartamodal->no_casis_siri_pembuat ?? null}}" disabled>
                            </div><!--col-->
                        </div>

                        <div class="form-group row">

                            <label class="col-md-2 col-form-label">Tarikh Beli</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" {{-- id="tarikh_beli" name="tarikh_beli" --}} value="{{ $hartamodal->tarikh_beli ?? null}}" disabled>
                            </div><!--col-->

                            <label class="col-md-1 col-form-label">Kategori</label>
                            <div class="col-md">
                                <input type="text" class="form-control" {{-- id="kategori" name="kategori" --}} value="{{ $hartamodal->kategori ?? null}}" disabled>
                            </div><!--col-->

                        </div>

                        <div class="form-group row">

                            <label class="col-md-2 col-form-label">Sub Kategori</label>
                            <div class="col-md">
                                <input type="text" class="form-control" {{-- id="sub_kategori" name="sub_kategori" --}} value="{{ $hartamodal->sub_kategori ?? null}}" disabled>
                            </div><!--col-->

                            <label class="col-md-1 col-form-label">Jenis</label>
                            <div class="col-md">
                                <input type="text" class="form-control" {{-- id="jenis" name="jenis" --}} value="{{ $hartamodal->jenis ?? null}}" disabled>
                            </div><!--col-->

                        </div>

                        <div class="form-group row">

                            <label class="col-md-2 col-form-label">Jenama</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" {{-- id="jenama" name="jenama" --}} value="{{ $hartamodal->jenama ?? null}}" disabled>
                            </div><!--col-->

                            <label class="col-md-2 col-form-label">Kod Lokasi Asal</label>
                            <div class="col-md">
                                <input type="text" class="form-control" {{-- id="kod_lokasi_asal" name="kod_lokasi_asal" --}} value="{{ $hartamodal->kod_lokasi_asal ?? null}}" disabled>
                            </div><!--col-->

                        </div>

                        <div class="form-group row">

                            <label class="col-md-2 col-form-label">Lokasi</label>
                            <div class="col-md">
                                <input type="text" style="text-transform:uppercase" class="form-control" id="" name="" value="{{ $hartamodal->bangunan->nama_bangunan}} ({{ $hartamodal->bangunan->kod_bangunan}}) Aras {{ $hartamodal->aras ?? null}} - {{ $hartamodal->lokasi->nama_lokasi ?? null}}" disabled>
                            </div><!--col-->

                        </div>

                        <hr />

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">KEW.PA 3</label>
                            <div class="col-md-2">
                                <input type="file" name="kewpa3" required>
                            </div><!--col-->

                        </div>

                        <hr />

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
                            <label class="col-md-3 col-form-label"><b>Tahap Prestasi Semasa Aset (%)</b></label>
                            <div class="col-md">
                                <input type="text" class="form-control" id="prestasi" name="prestasi" placeholder="0" required>
                            </div><!--col-->

                            <label class="col-md-4 col-form-label"><b>Jumlah Kos Penyelenggaraan Terdahulu</b></label>
                            <div class="col-md">
                                <input type="text" class="form-control" id="kod_dulu" name="kod_dulu" placeholder="RM 0">
                            </div><!--col-->

                            <label class="col-md-2 col-form-label"><b>Nilai Semasa</b></label>
                            <div class="col-md">
                                <input type="text" class="form-control" id="nilai_semasa" name="nilai_semasa" placeholder="RM 1" required>
                            </div><!--col-->

                        </div>

                        <div class="form-group row">

                            <label class="col-md-6 col-form-label"><b>Justifikasi</b>

                                <div class="input-group mb-3">
                                    <label class="col-md-1 col-form-label">1</label>
                                    <select class="form-control col-md-10" name="jus_1" id="jus_1" required>
                                        <option value="" selected>Sila Pilih</option>
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
                                    <select class="form-control col-md-10" name="jus_2" id="jus_2">
                                        <option value="" selected>Sila Pilih</option>
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
                                    <select class="form-control col-md-10" name="jus_3" id="jus_3">
                                        <option value="" selected>Sila Pilih</option>
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

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">No. KP Pemohon</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="nokp" name="nokp" placeholder="No. Kad Pengenalan Pemohon Tanpa (-)" required>
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

