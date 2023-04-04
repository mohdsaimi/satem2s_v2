@extends('backend.layouts.app')

@section('title', __('Permohonan Pelupusan Aset Alih (ABR)'))

@section('content')

<form method="POST" action="{{ route('admin.storeabrlupus') }}" enctype="multipart/form-data">
    <div class="form-group">
        @csrf
        {{-- @method('PATCH') --}}
    
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="card-title mb-0">
                            Permohonan Pelupusan Aset Alih (ABR)
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
                            <label class="col-md-2 col-form-label">KEW.PA 4</label>
                            <div class="col-md-2">
                                <input type="file" name="kewpa4" required>
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

