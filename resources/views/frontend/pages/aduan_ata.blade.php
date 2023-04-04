@extends('frontend.layouts.app')

@section('title', __('Aduan Komponen Aset Tak Alih'))

@section('content')

<div class="container py-4">
<form method="POST" action="{{ route('frontend.storeatarosak') }}" enctype="multipart/form-data">
    <div class="form-group">
        @csrf
        {{-- @method('PATCH') --}}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Aduan Komponen Aset Tak Alih
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">

                        <div class="col-md-2">
                            <input type="hidden" name="asetalih_id" value="{{ $asetalih->id }}">
                        </div><!--col-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Bangunan</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" {{-- id="nama_komponen" name="nama_komponen" --}} value="{{ $asetalih->asetalih_data->bangunan->nama_bangunan }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Kod Dan Nama Ruang</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="no_1gfmas" name="no_1gfmas" --}} value="{{ $asetalih->kod_lokasi_ata }} - {{ $asetalih->asetalih_data->nama_lokasi }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nama Komponen Utama</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="nama_komponen" name="nama_komponen" value="{{ $asetalih->nama_komponen }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Kuantiti Keseluruhan Dalam Ruang</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" id="kuantiti" name="kuantiti" value="{{ $asetalih->kuantiti }}" disabled>
                        </div><!--col-->
                        
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Diskripsi</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="diskripsi" name="diskripsi" value="{{ $asetalih->diskripsi ?? null}}" disabled>
                        </div><!--col-->
                        
                    </div><!--form-group-->

                    

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Gambar komponen</label>
                        <div class="col-md-2">
                            <img src="{{ asset('storage/ATA/'.$asetalih->pic) }}" class="rounded mx-auto d-block" width="200px;" alt="pic">
                        </div><!--col-->
                    </div><!--form-group-->

                    <hr>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Skop Perkhidmatan</label>
                        <div class="col-md">
                            <select class="form-control" name="skop" required>
                                <option value="">Sila Pilih</option>
                                <option value="Keselamatan">Keselamatan</option>
                                <option value="Housekeeping">Housekeeping</option>
                                <option value="Landskap">Landskap</option>
                                <option value="Mekanikal">Mekanikal</option>
                                <option value="Elektrikal">Elektrikal</option>
                                <option value="Sivil dan Struktur">Sivil dan Struktur</option>
                                <option value="Parkir">Parkir</option>
                            </select>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Keutamaan</label>
                        <div class="col-md">
                            <select class="form-control" name="keutamaan" required>
                                <option value="1">Umum</option>
                                <option value="2">Segera (Breakdown)</option>
                                <option value="3">Kecemasan</option>
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">* Keterangan Kerosakan</label>
                        <div class="col-md">
                            <textarea class="form-control" id="prihal_rosak" name="prihal_rosak" required></textarea><p style="color:red;">* Sila masukkan maklumat yang lengkap seperti bilangan komponen yang rosak.</p>
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

                    <div class="form-group row">

                        <label class="col-md-2 col-form-label">Bahagian/Unit</label>
                        <div class="col-md-5">
                            <select class="form-control" name="bahagian" required>
                                <option value="">Sila Pilih</option>
                                <option value="Pejabat Pengarah">Pejabat Pengarah</option>
                                <option value="Bahagian Pembangunan Dan Penyelenggaraan Aset">Bahagian Pembangunan Dan Penyelenggaraan Aset</option>
                                <option value="Bahagian Kawalan Dan Kualiti Latihan">Bahagian Kawalan Dan Kualiti Latihan</option>
                                <option value="Bahagian Pengurusan Pelajar Dan Latihan">Bahagian Pengurusan Pelajar Dan Latihan</option>
                                <option value="Pusat Sumber Dan Multimedia">Pusat Sumber Dan Multimedia</option>
                                <option value="Jabatan Teknologi Kejuruteraan Komputer">Jabatan Teknologi Kejuruteraan Komputer</option>
                                <option value="Jabatan Teknologi Kejuruteraan Mekanikal Dan Pengeluaran">Jabatan Teknologi Kejuruteraan Mekanikal Dan Pengeluaran</option>
                                <option value="Bahagian Khidmat Pengurusan">Bahagian Khidmat Pengurusan</option>
                            </select>
                        </div><!--col-->
                    </div>

                    <div class="form-group row">

                        <label class="col-md-2 col-form-label">No. Telefon</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="no_tel" name="no_tel">
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
                    <button type="submit" class="btn btn-primary">Save</button>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
</form>
</div>
@endsection
