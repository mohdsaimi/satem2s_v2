@extends('frontend.layouts.app')

@section('title', __('Maklumat Aduan Kerosakan (HM) - Selesai'))

@section('content')

<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Maklumat Aduan Kerosakan (HM) - Selesai
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
                            <input type="text" class="form-control" {{-- id="no_siri_pendaftaran" name="no_siri_pendaftaran" --}} value="{{ $hmrosak->hartamodal->no_siri_pendaftaran ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">No Casis/Siri Pembuat</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="no_casis_siri_pembuat" name="no_casis_siri_pembuat" --}} value="{{ $hmrosak->hartamodal->no_casis_siri_pembuat ?? null}}" disabled>
                        </div><!--col-->


                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Kategori</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="kategori" name="kategori" --}} value="{{ $hmrosak->hartamodal->kategori ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">Sub Kategori</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="sub_kategori" name="sub_kategori" --}} value="{{ $hmrosak->hartamodal->sub_kategori ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Jenis</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="jenis" name="jenis" --}} value="{{ $hmrosak->hartamodal->jenis ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">Tarikh Beli</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="tarikh_beli" name="tarikh_beli" --}} value="{{ $hmrosak->hartamodal->tarikh_beli ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-1 col-form-label">Jenama</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="jenama" name="jenama" --}} value="{{ $hmrosak->hartamodal->jenama ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">

                        <label class="col-md-2 col-form-label">Kod Lokasi Asal</label>
                        <div class="col-sd">
                            <input type="text" class="form-control" {{-- id="kod_lokasi_asal" name="kod_lokasi_asal" --}} value="{{ $hmrosak->hartamodal->kod_lokasi_asal ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Lokasi</label>
                        <div class="col-md">
                            <input type="text" style="text-transform:uppercase" class="form-control" id="" name="" value="{{ $hmrosak->hartamodal->bangunan->nama_bangunan}} ({{ $hmrosak->hartamodal->bangunan->kod_bangunan}}) Aras {{ $hmrosak->hartamodal->aras ?? null}} - {{ $hmrosak->hartamodal->lokasi->nama_lokasi ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <hr />

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Pengguna Terakhir</label>
                        <div class="col-md">
                            <input type="text" class="form-control" {{-- id="penguna_akhir" name="penguna_akhir" --}} value="{{ $hmrosak->penguna_akhir ?? null}}" disabled>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">Tarikh Kerosakan</label>
                        <div class="col-md">
                            <input type="date" class="form-control mb-2 mr-sm-2" {{-- id="datepicker" name="tarikh_rosak" --}} width="200" value="{{ $hmrosak->tarikh_rosak ?? null}}" disabled>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Perihal Kerosakan</label>
                        <div class="col-md">
                            <textarea class="form-control" {{-- id="prihal_rosak" name="prihal_rosak" --}} disabled>{{ $hmrosak->prihal_rosak ?? null}}</textarea>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">Pelapor</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" {{-- id="user_id" name="user_id" --}} value="{{ $hmrosak->kakitangan->nama ?? null}}" disabled>
                            </div><!--col-->
                    </div>

                    

                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">Gambar</label>
                        <div class="col-md-3">
                            <img src="{{ asset('storage/HM/'.$hmrosak->pic_1) }}" class="rounded mx-auto d-block" width="300px;" alt="pic_1">
                        </div><!--col-->

                        @if (!empty($hmrosak->pic_2))
                        <div class="col-md-3">
                            <img src="{{ asset('storage/HM/'.$hmrosak->pic_2) }}" class="rounded mx-auto d-block" width="300px;" alt="pic_2">
                        </div><!--col-->
                        @endif

                        @if (!empty($hmrosak->pic_3))
                        <div class="col-md-3">
                            <img src="{{ asset('storage/HM/'.$hmrosak->pic_3) }}" class="rounded mx-auto d-block" width="300px;" alt="pic_3">
                        </div><!--col-->
                        @endif

                    </div>

                    <hr>

                    <b><div class="form-group row">
                        <label class="col-md-1 col-form-label">PIC</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" style="font-weight: bold;" value="{{ $hmrosak->nama_1->nama ?? null}}" disabled>
                            </div><!--col-->
                    </div></b>

                    <hr>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Jumlah Kos Penyelenggaraan Terdahulu</b></label>
                            <div class="col-md-1">
                                <input type="text" class="form-control" id="kos_dulu" name="kos_dulu" value="{{ $hmrosak->kos_dulu ?? null}}" disabled>
                            </div><!--col-->

                            <label class="col-md-2 col-form-label"><b>Anggaran Kos Penyelenggaraan</b></label>
                            <div class="col-md-1">
                                <input type="text" class="form-control" id="kos_anggar" name="kos_anggar" value="{{ $hmrosak->kos_anggar ?? null}}" disabled>
                            </div><!--col-->
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Ulasan/Kerja yang dilakukan/Cadangan</b></label>
                            <div class="col-md">
                                <textarea class="form-control" id="nota_tindakan" name="nota_tindakan" disabled>{{ $hmrosak->nota_tindakan ?? null}}</textarea>
                            </div><!--col-->
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Syor Dan Ulasan</b></label>
                            <div class="col-md">
                                <textarea class="form-control" id="syor" name="syor" disabled>{{ $hmrosak->syor ?? null}}</textarea>
                            </div><!--col-->
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"><b>Tahun Perolehan/Pelupusan</b></label>
                                <div class="col-md-1">
                                    <input type="text" class="form-control" name="tahun" value="{{ $hmrosak->tahun ?? null }}" disabled>
                                </div><!--col-->

                        <label class="col-md-2 col-form-label"><b>Tarikh Selesai</b></label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="tahun" value="{{ $hmrosak->tarikh_siap ?? null }}" disabled>
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label"><b>Status</b></label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" style="font-weight: bold;" value="{{  $hmrosak->statusrosak->nama_status ?? null}}" disabled>

                            </div><!--col-->

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

