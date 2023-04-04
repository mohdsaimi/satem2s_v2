@extends('backend.layouts.app')

@section('title', __('Maklumat Aduan Kerosakan (ABR)'))

@section('content')

<form method="POST" action="{{ route('admin.updateabrrosaktin', [$abrrosak,'term'=>request('term') ?? null]) }}" {{-- enctype="multipart/form-data" --}}>
    <div class="form-group">
        @csrf
        @method('PATCH')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Maklumat Tindakan Aduan Kerosakan (ABR)
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
                            {{-- <input type="hidden" name="harta_modal_id" value="{{ $hmrosak->hartamodal->id }}"> --}}
                            <input type="text" class="form-control" {{-- id="no_siri_pendaftaran" name="no_siri_pendaftaran" --}} value="{{ $abrrosak->abr->no_siri_daftar ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">No Casis/Siri Pembuat</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="no_casis_siri_pembuat" name="no_casis_siri_pembuat" --}} value="{{ $abrrosak->abr->no_chasis ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Tarikh Beli</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="tarikh_beli" name="tarikh_beli" --}} value="{{ $abrrosak->abr->tarikh_belian ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Kategori</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="kategori" name="kategori" --}} value="{{ $abrrosak->abr->kategori ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Sub Kategori</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="sub_kategori" name="sub_kategori" --}} value="{{ $abrrosak->abr->sub_kategori ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Jenis</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="jenis" name="jenis" --}} value="{{ $abrrosak->abr->jenis ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Butiran</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="jenama" name="jenama" --}} value="{{ $abrrosak->abr->butiran ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Kod Lokasi Asal</label>
                        <div class="col-sd">
                            <input type="text" class="form-control" {{-- id="kod_lokasi_asal" name="kod_lokasi_asal" --}} value="{{ $abrrosak->abr->lokasi_asal ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Lokasi</label>
                        <div class="col-md">
                            <input type="text" style="text-transform:uppercase" class="form-control" id="" name="" value="{{ $abrrosak->abr->bangunan->nama_bangunan}} ({{ $abrrosak->abr->bangunan->kod_bangunan}}) Aras {{ $abrrosak->abr->aras ?? null}} - {{ $abrrosak->abr->lokasi->nama_lokasi ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <hr />

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Pengguna Terakhir</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="penguna_akhir" name="penguna_akhir" --}} value="{{ $abrrosak->penguna_akhir ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">Tarikh Kerosakan</label>
                        <div class="col-md">
                            <input type="date" class="form-control mb-2 mr-sm-2" {{-- id="datepicker" name="tarikh_rosak" --}} width="200" value="{{ $abrrosak->tarikh_rosak ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Perihal Kerosakan</label>
                        <div class="col-md">
                            <textarea class="form-control" {{-- id="prihal_rosak" name="prihal_rosak" --}} disabled>{{ $abrrosak->prihal_rosak ?? null}}</textarea>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">Pelapor</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" {{-- id="user_id" name="user_id" --}} value="{{ $abrrosak->kakitangan->nama ?? null}}" disabled>
                            </div><!--col-->
                    </div>

                    

                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">Gambar</label>
                        <div class="col-md-3">
                            <img src="{{ asset('storage/ABR/'.$abrrosak->pic_1) }}" class="rounded mx-auto d-block" width="300px;" alt="pic_1">
                        </div><!--col-->

                        @if (!empty($abrrosak->pic_2))
                        <div class="col-md-3">
                            <img src="{{ asset('storage/ABR/'.$abrrosak->pic_2) }}" class="rounded mx-auto d-block" width="300px;" alt="pic_2">
                        </div><!--col-->
                        @endif

                        @if (!empty($abrrosak->pic_3))
                        <div class="col-md-3">
                            <img src="{{ asset('storage/ABR/'.$abrrosak->pic_3) }}" class="rounded mx-auto d-block" width="300px;" alt="pic_3">
                        </div><!--col-->
                        @endif

                    </div>

                    <hr>

                    <b><div class="form-group row">
                        <label class="col-md-1 col-form-label">PIC</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" style="font-weight: bold;" value="{{ $abrrosak->nama_1->nama ?? null}}" disabled>
                            </div><!--col-->
                    </div></b>

                    <hr>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Jumlah Kos Penyelenggaraan Terdahulu</b></label>
                            <div class="col-md-1">
                                <input type="text" class="form-control" id="kos_dulu" name="kos_dulu" value="{{ $abrrosak->kos_dulu ?? null}}">
                            </div><!--col-->

                            <label class="col-md-2 col-form-label"><b>Anggaran Kos Penyelenggaraan</b></label>
                            <div class="col-md-1">
                                <input type="text" class="form-control" id="kos_anggar" name="kos_anggar" value="{{ $abrrosak->kos_anggar ?? null}}">
                            </div><!--col-->
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Ulasan/Kerja yang dilakukan/Cadangan</b></label>
                            <div class="col-md">
                                <textarea class="form-control" id="nota_tindakan" name="nota_tindakan" required>{{ $abrrosak->nota_tindakan ?? null}}</textarea>
                            </div><!--col-->
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Status</b></label>
                            <div class="col-md-3">
                                <select class="form-control" name="status" style="text-transform:uppercase" required>
                                    @if (empty($abrrosak->status))
                                    <option value="">Sila Pilih</option>
                                    @else
                                    <option value="{{ $abrrosak->status}}" style="text-transform:uppercase">{{ $abrrosak->statusrosak->nama_status }}</option>
                                    @endif
                                    @foreach($statusrosak as $statusrosak)
                                    <option value="{{ $statusrosak->id}}" style="text-transform:uppercase">{{ $statusrosak->nama_status}}</option>
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
</form>
@endsection

