@extends('backend.layouts.app')

@section('title', __('Maklumat Komponen Aset Tak Alih'))

@section('content')

<div class="form-group">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Maklumat Komponen Aset Tak Alih
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
                            <input type="hidden" id="lokasi" name="lokasi" value="{{ $asetalih->lokasi_bangunans_id }}" >
                            <input type="text" class="form-control" id="kod_kom" name="kod_kom" value="{{ $asetalih->kod_kom }}" disabled>
                        </div><!--col-->
                        <label class="col-md-1 col-form-label">Komponen</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="komponen" name="komponen" value="{{ $asetalih->komponen }}" disabled>
                        </div><!--col-->

                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kod Sistem</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="kod_sistem" name="kod_sistem" value="{{ $asetalih->kod_sistem }}" disabled>
                        </div><!--col-->
                        <label class="col-md-1 col-form-label">Sistem</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="sistem" name="sistem" value="{{ $asetalih->sistem }}" disabled>
                        </div><!--col-->

                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kod Sub-Sistem</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="kod_subsistem" name="kod_subsistem" value="{{ $asetalih->kod_subsistem }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Sub-Sistem</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="sub_sistem" name="sub_sistem" value="{{ $asetalih->sub_sistem }}" disabled>
                        </div><!--col-->

                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kod Kejuruteraan</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="kod_kej" name="kod_kej" value="{{ $asetalih->kod_kej }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Nama Kejuruteraan</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="nama_kej" name="nama_kej" value="{{ $asetalih->nama_kej }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nama Komponen Utama</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="nama_komponen" name="nama_komponen" value="{{ $asetalih->nama_komponen }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">No. 1GFMAS</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="no_1gfmas" name="no_1gfmas" value="{{ $asetalih->no_1gfmas }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Kuantiti</b></label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" id="kuantiti" name="kuantiti" value="{{ $asetalih->kuantiti }}" disabled>
                        </div><!--col-->
                        <label class="col-md-1 col-form-label">Catatan</label>
                        <div class="col-md">
                            <textarea class="form-control" id="catatan_1" name="catatan_1" disabled>{{ $asetalih->catatan_1 }}</textarea>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Gambar komponen</label>
                        <div class="col-md-2">
                            <img src="{{ asset('storage/ATA/'.$asetalih->pic) }}" class="rounded mx-auto d-block" width="100px;" alt="pic">
                        </div><!--col-->
                    </div><!--form-group-->

                    <hr>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Tarikh Perolehan</label>
                        <div class="col-md">
                            <input type="date" class="form-control mb-2 mr-sm-2" id="datepicker" name="tarikh_perolehan" width="200" value="{{ $asetalih->tarikh_perolehan }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Tarikh Pasang</label>
                        <div class="col-md">
                            <input type="date" class="form-control mb-2 mr-sm-2" id="datepicker" name="tarikh_pasang" width="200" value="{{ $asetalih->tarikh_pasang }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kos Perolehan</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="kos_perolehan" name="kos_perolehan" value="{{ $asetalih->kos_perolehan }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Tarikh Waranti Tamat</label>
                        <div class="col-md">
                            <input type="date" class="form-control mb-2 mr-sm-2" id="datepicker" name="tarikh_waranti_end" width="200" value="{{ $asetalih->tarikh_waranti_end }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">No. Pesanan Kerajaan</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="no_lo" name="no_lo" value="{{ $asetalih->no_lo }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Tarikh Tamat DLP</label>
                        <div class="col-md">
                            <input type="date" class="form-control mb-2 mr-sm-2" id="datepicker" name="tarikh_tamat_dlp" width="200" value="{{ $asetalih->tarikh_tamat_dlp }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kod PTJ</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="kod_ptj" name="kod_ptj" value="{{ $asetalih->kod_ptj }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Jangka Hayat</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="jangka_hayat" name="jangka_hayat" value="{{ $asetalih->jangka_hayat }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Pengilang</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="pengilang" name="pengilang" value="{{ $asetalih->pengilang }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Pembekal</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="pembekal" name="pembekal" value="{{ $asetalih->pembekal }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">No. Telefon</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="no_tel" name="no_tel" value="{{ $asetalih->no_tel }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Alamat</label>
                        <div class="col-md">
                            <textarea class="form-control" id="alamat" name="alamat" disabled>{{ $asetalih->alamat }}</textarea>
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kontraktor</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="kontraktor" name="kontraktor" value="{{ $asetalih->kontraktor }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">No. Telefon</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="no_tel_kon" name="no_tel_kon" value="{{ $asetalih->no_tel_kon }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Alamat</label>
                        <div class="col-md">
                            <textarea class="form-control" id="alamat_kon" name="alamat_kon" placeholder="Alamat" disabled>{{ $asetalih->alamat_kon }}</textarea>
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Catatan</label>
                        <div class="col-md">
                            <textarea class="form-control" id="catatan_2" name="catatan_2" disabled>{{ $asetalih->catatan_2 }}</textarea>
                        </div><!--col-->
                    </div>

                    <hr>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Diskripsi</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="diskripsi" name="diskripsi" value="{{ $asetalih->diskripsi }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Status Komponen</label>
                        <div class="col-md-4">
                            <select class="form-control" name="status_kom" disabled>
                                <option value="{{ $asetalih->status_kom }}" selected>{{ $asetalih->status_kom }}</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">No. Siri</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="no_siri" name="no_siri" value="{{ $asetalih->no_siri }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Jenama</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="jenama" name="jenama" value="{{ $asetalih->jenama }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">No. Teg/Label</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="label_kom" name="label_kom" value="{{ $asetalih->label_kom }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Model</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="model" name="model" value="{{ $asetalih->model }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">No. Sijil Pendaftaran</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="no_sijil_pendaftaran" name="no_sijil_pendaftaran" value="{{ $asetalih->no_sijil_pendaftaran }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <hr>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Jenis</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="jenis" name="jenis" value="{{ $asetalih->jenis }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Bahan</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="bahan" name="bahan" value="{{ $asetalih->bahan }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Bekalan Elektrik</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="bekalan_ele" name="bekalan_ele" value="{{ $asetalih->bekalan_ele }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Kaedah Pemasangan</label>
                        <div class="col-md">
                            <select class="form-control" name="kaedah_pasang" disabled>
                                <option value="{{ $asetalih->kaedah_pasang }}" selected>{{ $asetalih->kaedah_pasang }}</option>
                                <option value="Lekapan Siling">Lekapan Siling</option>
                                <option value="Lekapan Dinding">Lekapan Dinding</option>
                                <option value="Lekapan Lantai">Lekapan Lantai</option>
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
                            <input type="text" class="form-control" id="saiz_1" name="saiz_1" value="{{ $asetalih->saiz_1 }}" disabled>
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_1" disabled>
                                <option value="{{ $asetalih->unit_1 }}" selected>{{ $asetalih->unit_1 }}</option>
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
                            <input type="text" class="form-control" id="kadaran_1" name="kadaran_1" value="{{ $asetalih->kadaran_1 }}" disabled>
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_kadar_1" disabled>
                                <option value="{{ $asetalih->unit_kadar_1 }}" selected>{{ $asetalih->unit_kadar_1 }}</option>
                                <option value="W">W</option>
                                <option value="KW">KW</option>
                                <option value="V">V</option>
                                <option value="KV">KV</option>
                                <option value="A">A</option>
                                <option value="mA">mA</option>
                                <option value="mA">Hz</option>
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="saiz_2" name="saiz_2" value="{{ $asetalih->saiz_2 }}" disabled>
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_2" disabled>
                                <option value="{{ $asetalih->unit_2 }}" selected>{{ $asetalih->unit_2 }}</option>
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
                            <input type="text" class="form-control" id="kadaran_2" name="kadaran_2" value="{{ $asetalih->kadaran_2 }}" disabled>
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_kadar_2" disabled>
                                <option value="{{ $asetalih->unit_kadar_2 }}" selected>{{ $asetalih->unit_kadar_2 }}</option>
                                <option value="W">W</option>
                                <option value="KW">KW</option>
                                <option value="V">V</option>
                                <option value="KV">KV</option>
                                <option value="A">A</option>
                                <option value="mA">mA</option>
                                <option value="mA">Hz</option>
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="saiz_3" name="saiz_3" value="{{ $asetalih->saiz_3 }}" disabled>
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_3" disabled>
                                <option value="{{ $asetalih->unit_3 }}" selected>{{ $asetalih->unit_3 }}</option>
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
                            <input type="text" class="form-control" id="kadaran_3" name="kadaran_3" value="{{ $asetalih->kadaran_3 }}" disabled>
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_kadar_3" disabled>
                                <option value="{{ $asetalih->unit_kadar_3 }}" selected>{{ $asetalih->unit_kadar_3 }}</option>
                                <option value="W">W</option>
                                <option value="KW">KW</option>
                                <option value="V">V</option>
                                <option value="KV">KV</option>
                                <option value="A">A</option>
                                <option value="mA">mA</option>
                                <option value="mA">Hz</option>
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
                            <input type="text" class="form-control" id="kadaran_4" name="kadaran_4" value="{{ $asetalih->kadaran_4 }}" disabled>
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_kadar_4" disabled>
                                <option value="{{ $asetalih->unit_kadar_4 }}" selected>{{ $asetalih->unit_kadar_4 }}</option>
                                <option value="W">W</option>
                                <option value="KW">KW</option>
                                <option value="V">V</option>
                                <option value="KV">KV</option>
                                <option value="A">A</option>
                                <option value="mA">mA</option>
                                <option value="mA">Hz</option>
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="kapasiti_1" name="kapasiti_1" value="{{ $asetalih->kapasiti_1 }}" disabled>
                        </div><!--col-->
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="unit_kap_1" name="unit_kap_1" value="{{ $asetalih->unit_kap_1 }}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label"></label>

                        <div class="col-md-2">
                            <input type="text" class="form-control" id="kadaran_5" name="kadaran_5" value="{{ $asetalih->kadaran_5 }}" disabled>
                        </div><!--col-->
                        <div class="col-md-2">
                            <select class="form-control" name="unit_kadar_5" disabled>
                                <option value="{{ $asetalih->unit_kadar_5 }}" selected>{{ $asetalih->unit_kadar_5 }}</option>
                                <option value="W">W</option>
                                <option value="KW">KW</option>
                                <option value="V">V</option>
                                <option value="KV">KV</option>
                                <option value="A">A</option>
                                <option value="mA">mA</option>
                                <option value="mA">Hz</option>
                            </select>
                        </div><!--col-->

                    </div><!--form-group-->

                    <div class="form-group row">
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="kapasiti_2" name="kapasiti_2" value="{{ $asetalih->kapasiti_2 }}" disabled>
                        </div><!--col-->
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="unit_kap_2" name="unit_kap_2" value="{{ $asetalih->unit_kap_2 }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="kapasiti_3" name="kapasiti_3" value="{{ $asetalih->kapasiti_3 }}" disabled>
                        </div><!--col-->
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="unit_kap_3" name="unit_kap_3" value="{{ $asetalih->unit_kap_3 }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Catatan</label>
                        <div class="col-md">
                            <textarea class="form-control" id="catatan_3" name="catatan_3" disabled>{{ $asetalih->catatan_3 }}</textarea>
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
                    <a href="{{ route('admin.editasetalih',[$asetalih,'term'=>request('term') ?? null]) }}" class="btn btn-primary">Edit</a>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->

@endsection
