@extends('backend.layouts.app')

@section('title', __('Maklumat Syor Aduan Kerosakan (ATA)'))

@section('content')

<form method="POST" action="{{ route('admin.updateatasyor2', [$atarosak,'term'=>request('term') ?? null]) }}" {{-- enctype="multipart/form-data" --}}>
    <div class="form-group">
        @csrf
        @method('PATCH')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Maklumat Syor Aduan Kerosakan (ATA)
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Bangunan</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" {{-- id="nama_komponen" name="nama_komponen" --}} value="{{ $atarosak->asetalih->asetalih_data->bangunan->nama_bangunan }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Kod Dan Nama Ruang</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="no_1gfmas" name="no_1gfmas" --}} value="{{ $atarosak->asetalih->kod_lokasi_ata }} - {{ $atarosak->asetalih->asetalih_data->nama_lokasi }}" disabled>
                        </div><!--col-->
                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nama Komponen Utama</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="nama_komponen" name="nama_komponen" value="{{ $atarosak->asetalih->nama_komponen }}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Kuantiti Keseluruhan Dalam Ruang</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" id="kuantiti" name="kuantiti" value="{{ $atarosak->asetalih->kuantiti }}" disabled>
                        </div><!--col-->
                        
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Diskripsi</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="diskripsi" name="diskripsi" value="{{ $atarosak->asetalih->diskripsi ?? null}}" disabled>
                        </div><!--col-->
                        
                    </div><!--form-group-->

                    <hr />


                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Skop Perkhidmatan</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="skop" name="skop" value="{{ $atarosak->skop ?? null}}" disabled>
                        </div><!--col-->
                        <label class="col-md-2 col-form-label">Keutamaan</label>
                        <div class="col-md">
                            @if ($atarosak->keutamaan == 1)
                                <input type="text" class="form-control" id="keutamaan" name="keutamaan" value="Umum" disabled>
                            @elseif ($atarosak->keutamaan == 2)
                                <input type="text" class="form-control" id="keutamaan" name="keutamaan" value="Segera" disabled>
                            @else
                                <input type="text" class="form-control" id="keutamaan" name="keutamaan" value="Kecemasan" disabled>
                            @endif
                            
                            {{-- <select class="form-control" name="keutamaan" disabled>
                                <option value="1">Umum</option>
                                <option value="2">Segera (Breakdown)</option>
                                <option value="3">Kecemasan</option>
                            </select> --}}
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">Tarikh Aduan</label>
                        <div class="col-md">
                            <input type="date" class="form-control mb-2 mr-sm-2" {{-- id="datepicker" name="tarikh_rosak" --}} width="200" value="{{ $atarosak->tarikh_rosak ?? null}}" disabled>
                        </div><!--col-->

                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Keterangan Kerosakan</label>
                        <div class="col-md">
                            <textarea class="form-control" {{-- id="prihal_rosak" name="prihal_rosak" --}} disabled>{{ $atarosak->prihal_rosak ?? null}}</textarea>
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">Pelapor</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $atarosak->kakitangan->nama ?? null}}" disabled>
                            </div><!--col-->

                        <label class="col-md-1 col-form-label">Bahagian/Unit</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="bahagian" name="bahagian" value="{{ $atarosak->bahagian ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">No. Telefon</label>
                        <div class="col-ms">
                            <input type="text" class="form-control" id="no_tel" name="no_tel" value="{{ $atarosak->no_tel ?? null}}" disabled>
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">Gambar</label>
                        <div class="col-md-3">
                            <img src="{{ asset('storage/ATA_ROSAK/'.$atarosak->pic_1) }}" class="rounded mx-auto d-block" width="300px;" alt="pic_1">
                        </div><!--col-->

                        @if (!empty($atarosak->pic_2))
                        <div class="col-md-3">
                            <img src="{{ asset('storage/ATA_ROSAK/'.$atarosak->pic_2) }}" class="rounded mx-auto d-block" width="300px;" alt="pic_2">
                        </div><!--col-->
                        @endif

                        @if (!empty($atarosak->pic_3))
                        <div class="col-md-3">
                            <img src="{{ asset('storage/ATA_ROSAK/'.$atarosak->pic_3) }}" class="rounded mx-auto d-block" width="300px;" alt="pic_3">
                        </div><!--col-->
                        @endif

                    </div>

                    <hr>

                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">PIC</label>
                            <div class="col-md-3">
                                <select class="form-control" name="user_siasat" style="text-transform:uppercase" disabled>
                                    <option value="{{ $atarosak->user_siasat}}" style="text-transform:uppercase">{{ $atarosak->nama_2->nama }}</option>
                                </select>

                            </div><!--col-->

                    </div>

                    <hr>

                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">Jenis Kerja</label>
                            <div class="col-md-3">
                                <select class="form-control" name="jenis_kerja" style="text-transform:uppercase" disabled>
                                    @if (empty($atarosak->jenis_kerja))
                                    <option value="">Sila Pilih</option>
                                    @else
                                    <option value="{{ $atarosak->jenis_kerja}}">{{ $atarosak->jenis_kerja }}</option>
                                    @endif
                                    
                                    <option value="Penyelenggaraan Pencegahan">Penyelenggaraan Pencegahan</option>
                                    <option value="Penyelenggaraan Pembaikan">Penyelenggaraan Pembaikan</option>
                                </select>

                            </div><!--col-->
                    </div><!--col-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Keterangan</label>
                            <div class="col-md">
                                <textarea class="form-control" id="ulas_siasat" name="ulas_siasat" disabled>{{ $atarosak->ulas_siasat ?? null}}</textarea>
                            </div><!--col-->
                    </div>

                    <hr>

                    <div class="form-group row">
                        <label class="col-md-1 col-form-label"></label>
                            <div class="col-md-4">
                                Jenis Alat Ganti
                            </div><!--col-->
                            
                            <div class="col-md-2">
                                Harga Alat Ganti/Stok
                            </div><!--col-->

                            <div class="col-md-1">
                                Kuantiti
                            </div><!--col-->

                            <div class="col-md-2">
                                Jumlah
                            </div><!--col-->
                    </div>

                    <div class="form-group row">
                        
                        <label class="col-md-1 col-form-label">1.</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="jenis_1" name="jenis_1" value="{{ $atarosak->jenis_1 ?? null}}" disabled>
                            </div><!--col-->
                        
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="harga_1" name="harga_1" value="{{ $atarosak->harga_1 ?? null}}" disabled>
                            </div><!--col-->
                        
                            <div class="col-md-1">
                                <input type="text" class="form-control" id="kuantiti_1" name="kuantiti_1" value="{{ $atarosak->kuantiti_1 ?? null}}" disabled>
                            </div><!--col-->
                        
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="jumlah_1" name="jumlah_1" value="{{ $atarosak->jumlah_1 ?? null}}" disabled>
                            </div><!--col-->
                    </div>

                    <div class="form-group row">
                        
                        <label class="col-md-1 col-form-label">2.</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="jenis_2" name="jenis_2" value="{{ $atarosak->jenis_2 ?? null}}" disabled>
                            </div><!--col-->
                        
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="harga_2" name="harga_2" value="{{ $atarosak->harga_2 ?? null}}" disabled>
                            </div><!--col-->
                        
                            <div class="col-md-1">
                                <input type="text" class="form-control" id="kuantiti_2" name="kuantiti_2" value="{{ $atarosak->kuantiti_2 ?? null}}" disabled>
                            </div><!--col-->
                        
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="jumlah_2" name="jumlah_2" value="{{ $atarosak->jumlah_2 ?? null}}" disabled>
                            </div><!--col-->
                    </div>

                    <div class="form-group row">
                        
                        <label class="col-md-1 col-form-label">3.</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="jenis_3" name="jenis_3" value="{{ $atarosak->jenis_3 ?? null}}" disabled>
                            </div><!--col-->
                        
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="harga_3" name="harga_3" value="{{ $atarosak->harga_3 ?? null}}" disabled>
                            </div><!--col-->
                        
                            <div class="col-md-1">
                                <input type="text" class="form-control" id="kuantiti_3" name="kuantiti_3" value="{{ $atarosak->kuantiti_3 ?? null}}" disabled>
                            </div><!--col-->
                        
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="jumlah_3" name="jumlah_3" value="{{ $atarosak->jumlah_3 ?? null}}" disabled>
                            </div><!--col-->
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Perihal Kerja / Tindakan</label>
                            <div class="col-md">
                                <textarea class="form-control" id="perihal_kerja" name="perihal_kerja" disabled>{{ $atarosak->perihal_kerja ?? null}}</textarea>
                            </div><!--col-->
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Status Semasa</label>
                            <div class="col-md-3">
                                <select class="form-control" name="status" style="text-transform:uppercase" disabled>
                                    <option value="{{ $atarosak->status}}" style="text-transform:uppercase">{{ $atarosak->statusrosak->nama_status }}</option>
                                </select>

                            </div><!--col-->

                    </div>

                    <hr>

                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Status</b></label>
                            <div class="col-md-3">

                                <select class="form-control" name="status" style="text-transform:uppercase" required>
                                    
                                    <option value="" selected>Sila Pilih</option>
                                    
                                    @foreach($statusrosak as $statusrosak)
                                    <option value="{{ $statusrosak->id}}" style="text-transform:uppercase">{{ $statusrosak->nama_status}}</option>
                                    @endforeach
                                </select>

                            </div><!--col-->

                            <label class="col-md-3 col-form-label"><b>Tahun Perolehan/Pelupusan</b></label>
                            <div class="col-md">

                                <input type="text" class="form-control" name="tahun" value="{{ $atarosak->tahun ?? null }}" disabled>

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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
</form>
@endsection

