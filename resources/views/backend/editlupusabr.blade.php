@extends('backend.layouts.app')

@section('title', __('Edit Permohonan Pelupusan Aset Alih (ABR)'))

@section('content')

<form method="POST" action="{{ route('admin.update_lupusabr', [$abrlupus,'term'=>request('term') ?? null]) }}" {{-- enctype="multipart/form-data" --}}>
    <div class="form-group">
        @csrf
        @method('PATCH')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="card-title mb-0">
                        Edit Permohonan Pelupusan Aset Alih (ABR)
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
                            <input type="hidden" name="abrl_id" value="{{ $abrlupus->abr_id }}">
                            <input type="text" class="form-control" {{-- id="no_siri_pendaftaran" name="no_siri_pendaftaran" --}} value="{{ $abrlupus->abr->no_siri_daftar ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">No Casis/Siri Pembuat</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="no_casis_siri_pembuat" name="no_casis_siri_pembuat" --}} value="{{ $abrlupus->abr->no_chasis ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Tarikh Beli</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="tarikh_beli" name="tarikh_beli" --}} value="{{ $abrlupus->abr->tarikh_belian ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Kategori</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="kategori" name="kategori" --}} value="{{ $abrlupus->abr->kategori ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Sub Kategori</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="sub_kategori" name="sub_kategori" --}} value="{{ $abrlupus->abr->sub_kategori ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Jenis</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="jenis" name="jenis" --}} value="{{ $abrlupus->abr->jenis ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Butiran</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="jenama" name="jenama" --}} value="{{ $abrlupus->abr->butiran ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Kod Lokasi Asal</label>
                        <div class="col-sd">
                            <input type="text" class="form-control" {{-- id="kod_lokasi_asal" name="kod_lokasi_asal" --}} value="{{ $abrlupus->abr->lokasi_asal ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Lokasi</label>
                        <div class="col-md">
                            <input type="text" style="text-transform:uppercase" class="form-control" id="" name="" value="{{ $abrlupus->abr->bangunan->nama_bangunan}} ({{ $abrlupus->abr->bangunan->kod_bangunan}}) Aras {{ $abrlupus->abr->aras ?? null}} - {{ $abrlupus->abr->lokasi->nama_lokasi ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <hr />

                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">KEW.PA4</label>
                        <div class="col-md-3">
                            <a href="{{ asset('storage/ABR_LUPUS/'.$abrlupus->kewpa4) }}" target="_BLANK">Klik untuk salinan KEW.PA4</a>
                        </div><!--col-->

                    </div>

                    <hr />


                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">Gambar</label>
                        <div class="col-md-3">
                            <img src="{{ asset('storage/ABR_LUPUS/'.$abrlupus->pic_1) }}" class="rounded mx-auto d-block" width="300px;" alt="pic_1">
                        </div><!--col-->

                        @if (!empty($abrlupus->pic_2))
                        <div class="col-md-3">
                            <img src="{{ asset('storage/ABR_LUPUS/'.$abrlupus->pic_2) }}" class="rounded mx-auto d-block" width="300px;" alt="pic_2">
                        </div><!--col-->
                        @endif

                        @if (!empty($abrlupus->pic_3))
                        <div class="col-md-3">
                            <img src="{{ asset('storage/ABR_LUPUS/'.$abrlupus->pic_3) }}" class="rounded mx-auto d-block" width="300px;" alt="pic_3">
                        </div><!--col-->
                        @endif

                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Tahap Prestasi Semasa Aset (%)</b></label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="prestasi" name="prestasi" value="{{ $abrlupus->prestasi }}" required>
                        </div><!--col-->

                        <label class="col-md-3 col-form-label"><b>Jumlah Kos Penyelenggaraan Terdahulu</b></label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="kod_dulu" name="kod_dulu" value="{{ $abrlupus->kod_dulu }}">
                        </div><!--col-->

                        <label class="col-md-1 col-form-label"><b>Nilai Semasa</b></label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="nilai_semasa" name="nilai_semasa" value="{{ $abrlupus->nilai_semasa }}" required>
                        </div><!--col-->

                        <label class="col-md col-form-label"><b>Tahun Pelupusan</b></label>
                            <div class="col-md">
                                <input type="text" class="form-control" id="tahun_lupus" name="tahun_lupus" value="{{ $abrlupus->tahun_lupus }}" required>
                        </div><!--col-->

                    </div>


                    <div class="form-group row">

                        <label class="col-md-6 col-form-label"><b>Justifikasi</b>

                            <div class="input-group mb-3">
                                <label class="col-md-1 col-form-label">1</label>
                                <select class="form-control col-md-10" name="jus_1" id="jus_1" required>
                                    <option value="{{ $abrlupus->jus_1 }}" selected>{{ $abrlupus->jus_1 }}</option>
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
                                <select class="form-control col-md-10" name="jus_2" id="jus_2">
                                    <option value="{{ $abrlupus->jus_2 }}" selected>{{ $abrlupus->jus_2 }}</option>
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
                                <select class="form-control col-md-10" name="jus_3" id="jus_3">
                                    <option value="{{ $abrlupus->jus_3 }}" selected>{{ $abrlupus->jus_3 }}</option>
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



                    <hr>

                    @if ($abrlupus->status == 0)
                        
                        <div class="input-group mb-3">
                            <label class="col-md-1 col-form-label"><b>Status</b></label>
                            <select class="form-control col-md-1" name="status" id="status" required>
                                <option value="" selected>Sila Pilih</option>
                                <option value="1">Lulus</option>
                                <option value="2">Reject</option>
                            </select>

                            <label class="col-md-2 col-form-label"><b>Kaedah Pelupusan</b></label>
                            <select class="form-control col-md-1" name="kaedah_lupus" id="kaedah_lupus">
                                <option value="" selected>Sila Pilih</option>
                                <option value="E-Waste">E-Waste</option>
                                <option value="Jualan Sisa">Jualan Sisa</option>
                                <option value="Musnah">Musnah</option>
                            </select>
                        </div>

                    @else
                    <div class="input-group mb-3">
                        <label class="col-md-1 col-form-label"><b>Status</b></label>
                        <select class="form-control col-md-1" name="status" id="status" disabled>
                            <option value="{{ $abrlupus->status }}" selected>Lulus</option>
                            <option value="0" >Sila Pilih</option>
                            <option value="1">Lulus</option>
                            <option value="2">Reject</option>
                        </select>

                        <label class="col-md-2 col-form-label"><b>Kaedah Pelupusan</b></label>
                        <select class="form-control col-md-2" name="kaedah_lupus" id="kaedah_lupus">
                            <option value="{{ $abrlupus->kaedah_lupus }}" selected>{{ $abrlupus->kaedah_lupus }}</option>
                            <option value="" >Sila Pilih</option>
                            <option value="E-Waste">E-Waste</option>
                            <option value="Jualan Sisa">Jualan Sisa</option>
                            <option value="Musnah">Musnah</option>
                        </select>
                    </div>
                    @endif
                    


                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                </div><!--col-->

                <div class="col text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
</form>
@endsection

