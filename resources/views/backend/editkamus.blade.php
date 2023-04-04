@extends('backend.layouts.app')

@section('title', __('Edit Kamus Komponen Aset Tak Alih'))

@section('content')

<form method="POST" action="{{ route('admin.updatekamus', [$kamusata,'term'=>request('term') ?? null]) }}" enctype="multipart/form-data">
    <div class="form-group">
        @csrf
        @method('PATCH')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Edit Kamus Komponen Aset Tak Alih
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kod Komponen</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="kod_kom" name="kod_kom" value="{{ $kamusata->kod_kom }}" required>
                        </div><!--col-->
                        <label class="col-md-1 col-form-label">Komponen</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="komponen" name="komponen" value="{{ $kamusata->komponen }}" required>
                        </div><!--col-->

                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kod Sistem</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="kod_sistem" name="kod_sistem" value="{{ $kamusata->kod_sistem }}" required>
                        </div><!--col-->
                        <label class="col-md-1 col-form-label">Sistem</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="sistem" name="sistem" value="{{ $kamusata->sistem }}" required>
                        </div><!--col-->

                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kod Sub-Sistem</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="kod_subsistem" name="kod_subsistem" value="{{ $kamusata->kod_subsistem }}" required>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Sub-Sistem</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="sub_sistem" name="sub_sistem" value="{{ $kamusata->sub_sistem }}" required>
                        </div><!--col-->

                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kod Kejuruteraan</label>
                        <div class="col-md-2">
                            <select class="form-control" name="kod_kej" >
                                <option value="{{ $kamusata->kod_kej }}" selected>{{ $kamusata->kod_kej }}</option>
                                <option value="E">E</option>
                                <option value="T">T</option>
                                <option value="M">M</option>
                                <option value="B">B</option>
                                <option value="A">A</option>
                                <option value="L">L</option>
                            </select>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Nama Kejuruteraan</label>
                        <div class="col-md">
                            <select class="form-control" name="nama_kej" >
                                <option value="{{ $kamusata->nama_kej }}" selected>{{ $kamusata->nama_kej }}</option>
                                <option value="Elektrikal">Elektrikal</option>
                                <option value="ICT/ELV">ICT/ELV</option>
                                <option value="Mekanikal">Mekanikal</option>
                                <option value="Bio Perubatan">Bio Perubatan</option>
                                <option value="Awam dan Arkitek">Awam dan Arkitek</option>
                                <option value="Lain-lain">Lain-lain</option>
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nama Komponen Utama</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="nama_komponen" name="nama_komponen" value="{{ $kamusata->nama_komponen }}" required>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">No. 1GFMAS</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="no_1gfmas" name="no_1gfmas" value="{{ $kamusata->no_1gfmas }}" >
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Gambar komponen</label>
                        <div class="col-md-2">
                            <img src="{{ asset('storage/ATA/'.$kamusata->pic) }}" class="rounded mx-auto d-block" width="100px;" alt="pic">
                        </div><!--col-->
                    </div><!--form-group-->

                    <hr>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Tarikh Perolehan</label>
                        <div class="col-md">
                            <input type="date" class="form-control mb-2 mr-sm-2" id="datepicker" name="tarikh_perolehan" width="200" value="{{ $kamusata->tarikh_perolehan }}" >
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Tarikh Pasang</label>
                        <div class="col-md">
                            <input type="date" class="form-control mb-2 mr-sm-2" id="datepicker" name="tarikh_pasang" width="200" value="{{ $kamusata->tarikh_pasang }}" >
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kos Perolehan</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="kos_perolehan" name="kos_perolehan" value="{{ $kamusata->kos_perolehan }}" >
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Tarikh Waranti Tamat</label>
                        <div class="col-md">
                            <input type="date" class="form-control mb-2 mr-sm-2" id="datepicker" name="tarikh_waranti_end" width="200" value="{{ $kamusata->tarikh_waranti_end }}" >
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">No. Pesanan Kerajaan</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="no_lo" name="no_lo" value="{{ $kamusata->no_lo }}" >
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Tarikh Tamat DLP</label>
                        <div class="col-md">
                            <input type="date" class="form-control mb-2 mr-sm-2" id="datepicker" name="tarikh_tamat_dlp" width="200" value="{{ $kamusata->tarikh_tamat_dlp }}" >
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kod PTJ</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="kod_ptj" name="kod_ptj" value="{{ $kamusata->kod_ptj }}" >
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Jangka Hayat</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="jangka_hayat" name="jangka_hayat" value="{{ $kamusata->jangka_hayat }}" >
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Pengilang</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="pengilang" name="pengilang" value="{{ $kamusata->pengilang }}" required>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Pembekal</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="pembekal" name="pembekal" value="{{ $kamusata->pembekal }}" required>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">No. Telefon</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="no_tel" name="no_tel" value="{{ $kamusata->no_tel }}" >
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Alamat</label>
                        <div class="col-md">
                            <textarea class="form-control" id="alamat" name="alamat" >{{ $kamusata->alamat }}</textarea>
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kontraktor</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="kontraktor" name="kontraktor" value="{{ $kamusata->kontraktor }}" required>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">No. Telefon</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="no_tel_kon" name="no_tel_kon" value="{{ $kamusata->no_tel_kon }}" >
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Alamat</label>
                        <div class="col-md">
                            <textarea class="form-control" id="alamat_kon" name="alamat_kon" placeholder="Alamat" >{{ $kamusata->alamat_kon }}</textarea>
                        </div><!--col-->
                    </div>

                    <hr>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Diskripsi</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="diskripsi" name="diskripsi" value="{{ $kamusata->diskripsi }}" required>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Status Komponen</label>
                        <div class="col-md-4">
                            <select class="form-control" name="status_kom" required>
                                <option value="{{ $kamusata->status_kom }}" selected>{{ $kamusata->status_kom }}</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">No. Siri</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="no_siri" name="no_siri" value="{{ $kamusata->no_siri }}" >
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Jenama</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="jenama" name="jenama" value="{{ $kamusata->jenama }}" >
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">No. Teg/Label</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="label_kom" name="label_kom" value="{{ $kamusata->label_kom }}" >
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Model</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="model" name="model" value="{{ $kamusata->model }}" >
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">No. Sijil Pendaftaran</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="no_sijil_pendaftaran" name="no_sijil_pendaftaran" value="{{ $kamusata->no_sijil_pendaftaran }}" >
                        </div><!--col-->
                    </div><!--form-group-->

                    <hr>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Jenis</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="jenis" name="jenis" value="{{ $kamusata->jenis }}" >
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Bahan</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="bahan" name="bahan" value="{{ $kamusata->bahan }}" >
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Bekalan Elektrik</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="bekalan_ele" name="bekalan_ele" value="{{ $kamusata->bekalan_ele }}" >
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Kaedah Pemasangan</label>
                        <div class="col-md">
                            <select class="form-control" name="kaedah_pasang" required>
                                <option value="{{ $kamusata->kaedah_pasang }}" selected>{{ $kamusata->kaedah_pasang }}</option>
                                <option value="Lekapan Siling">Lekapan Siling</option>
                                <option value="Lekapan Dinding">Lekapan Dinding</option>
                                <option value="Lekapan Lantai">Lekapan Lantai</option>
                                <option value="Lekapan Rak">Lekapan Rak</option>
                                <option value="Lekapan Meja">Lekapan Meja</option>
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Saiz Fizikal</b></label>

                        <label class="col-md-2 col-form-label"><b>Unit</b></label>

                        <label class="col-md-2 col-form-label"></label>

                        <label class="col-md-2 col-form-label"><b>Kadar</b></label>

                        <label class="col-md-2 col-form-label"><b>Unit</b></label>

                        <label class="col-md-2 col-form-label"></label>

                    </div><!--form-group-->

                    <div class="form-group row">
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="saiz_1" name="saiz_1" value="{{ $kamusata->saiz_1 }}" >
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_1" >
                                <option value="{{ $kamusata->unit_1 }}" selected>{{ $kamusata->unit_1 }}</option>
                                <option value="mm">mm</option>
                                <option value="meter">meter</option>
                                <option value="km">km</option>
                                <option value="inch">inch</option>
                                <option value="feet">feet</option>
                            </select>
                        </div><!--col-->
                        <div class="col-md-2">
                            &nbsp;
                        </div><!--col-->
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="kadaran_1" name="kadaran_1" value="{{ $kamusata->kadaran_1 }}" >
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_kadar_1" >
                                <option value="{{ $kamusata->unit_kadar_1 }}" selected>{{ $kamusata->unit_kadar_1 }}</option>
                                <option value="W">W</option>
                                <option value="KW">KW</option>
                                <option value="V">V</option>
                                <option value="KV">KV</option>
                                <option value="A">A</option>
                                <option value="mA">mA</option>
                                <option value="mA">Hz</option>
                                <option value="Ohm">Ohm</option>
                                <option value="Hours">Hours</option>
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="saiz_2" name="saiz_2" value="{{ $kamusata->saiz_2 }}" >
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_2" >
                                <option value="{{ $kamusata->unit_2 }}" selected>{{ $kamusata->unit_2 }}</option>
                                <option value="mm">mm</option>
                                <option value="meter">meter</option>
                                <option value="km">km</option>
                                <option value="inch">inch</option>
                                <option value="feet">feet</option>
                            </select>
                        </div><!--col-->
                        <div class="col-md-2">
                            &nbsp;
                        </div><!--col-->
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="kadaran_2" name="kadaran_2" value="{{ $kamusata->kadaran_2 }}" >
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_kadar_2" >
                                <option value="{{ $kamusata->unit_kadar_2 }}" selected>{{ $kamusata->unit_kadar_2 }}</option>
                                <option value="W">W</option>
                                <option value="KW">KW</option>
                                <option value="V">V</option>
                                <option value="KV">KV</option>
                                <option value="A">A</option>
                                <option value="mA">mA</option>
                                <option value="mA">Hz</option>
                                <option value="Ohm">Ohm</option>
                                <option value="Hours">Hours</option>
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="saiz_3" name="saiz_3" value="{{ $kamusata->saiz_3 }}" >
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_3" >
                                <option value="{{ $kamusata->unit_3 }}" selected>{{ $kamusata->unit_3 }}</option>
                                <option value="mm">mm</option>
                                <option value="meter">meter</option>
                                <option value="km">km</option>
                                <option value="inch">inch</option>
                                <option value="feet">feet</option>
                            </select>
                        </div><!--col-->
                        <div class="col-md-2">
                            &nbsp;
                        </div><!--col-->
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="kadaran_3" name="kadaran_3" value="{{ $kamusata->kadaran_3 }}" >
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_kadar_3" >
                                <option value="{{ $kamusata->unit_kadar_3 }}" selected>{{ $kamusata->unit_kadar_3 }}</option>
                                <option value="W">W</option>
                                <option value="KW">KW</option>
                                <option value="V">V</option>
                                <option value="KV">KV</option>
                                <option value="A">A</option>
                                <option value="mA">mA</option>
                                <option value="mA">Hz</option>
                                <option value="Ohm">Ohm</option>
                                <option value="Hours">Hours</option>
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        
                        <label class="col-md-2 col-form-label"><b>Kapasiti</b></label>

                        <label class="col-md-2 col-form-label"><b>Unit</b></label>
                        
                        <div class="col-md-2">
                            &nbsp;
                        </div><!--col-->
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="kadaran_4" name="kadaran_4" value="{{ $kamusata->kadaran_4 }}" >
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_kadar_4" >
                                <option value="{{ $kamusata->unit_kadar_4 }}" selected>{{ $kamusata->unit_kadar_4 }}</option>
                                <option value="W">W</option>
                                <option value="KW">KW</option>
                                <option value="V">V</option>
                                <option value="KV">KV</option>
                                <option value="A">A</option>
                                <option value="mA">mA</option>
                                <option value="mA">Hz</option>
                                <option value="Ohm">Ohm</option>
                                <option value="Hours">Hours</option>
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="kapasiti_1" name="kapasiti_1" value="{{ $kamusata->kapasiti_1 }}" >
                        </div><!--col-->
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="unit_kap_1" name="unit_kap_1" value="{{ $kamusata->unit_kap_1 }}" >
                        </div><!--col-->

                        <label class="col-md-2 col-form-label"></label>

                        <div class="col-md-2">
                            <input type="text" class="form-control" id="kadaran_5" name="kadaran_5" value="{{ $kamusata->kadaran_5 }}" >
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_kadar_5">
                                <option value="{{ $kamusata->unit_kadar_5 }}" selected>{{ $kamusata->unit_kadar_5 }}</option>
                                <option value="W">W</option>
                                <option value="KW">KW</option>
                                <option value="V">V</option>
                                <option value="KV">KV</option>
                                <option value="A">A</option>
                                <option value="mA">mA</option>
                                <option value="mA">Hz</option>
                                <option value="Ohm">Ohm</option>
                                <option value="Hours">Hours</option>
                            </select>
                        </div><!--col-->

                    </div><!--form-group-->

                    <div class="form-group row">
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="kapasiti_2" name="kapasiti_2" value="{{ $kamusata->kapasiti_2 }}" >
                        </div><!--col-->
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="unit_kap_2" name="unit_kap_2" value="{{ $kamusata->unit_kap_2 }}" >
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="kapasiti_3" name="kapasiti_3" value="{{ $kamusata->kapasiti_3 }}" >
                        </div><!--col-->
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="unit_kap_3" name="unit_kap_3" value="{{ $kamusata->unit_kap_3 }}" >
                        </div><!--col-->
                    </div><!--form-group-->

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
@endsection
