@extends('backend.layouts.app')

@section('title', __('Edit Lokasi'))

@section('content')

<form method="POST" action="{{ route('admin.updatelokasi',[$lokasi,'term'=>request('term') ?? null]) }}">
    <div class="form-group">
        @csrf
        @method('PATCH')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Edit Lokasi Ruang
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr />

            <div class="row mt-4">
                <div class="col">

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Bangunan</label>

                        <div class="col-md-5">

                            <select class="form-control" name="bangunan_id" required>
                                <option value="{{ $lokasi->bangunan_id ?? null}}" style="text-transform:uppercase">{{ $lokasi->bangunan->kod_bangunan}}-{{ $lokasi->bangunan->nama_bangunan}}</option>
                                @foreach($bangunan as $bangunan)
                                <option value="{{ $bangunan->id}}" style="text-transform:uppercase">{{ $bangunan->kod_bangunan}}-{{ $bangunan->nama_bangunan}}</option>
                                @endforeach
                                </select>
                        </div><!--col-->

                        <label class="col-md-1 col-form-label">Aras</label>

                        <div class="col-md">
                                <input type="text" class="form-control" id="aras" name="aras" value="{{ $lokasi->aras ?? null}}" required>
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kod Lokasi</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="kod_lokasi" name="kod_lokasi" value="{{ $lokasi->kod_lokasi ?? null}}" required>
                        </div><!--col-->

                        <label class="col-md-2 col-form-label">Nama Lokasi</label>
                        <div class="col-md">
                            <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" value="{{ $lokasi->nama_lokasi ?? null}}" required>
                        </div><!--col-->

                    </div><!--form-group-->
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Pengumpul Data</label>
                            <div class="col-md-3">

                            <select class="form-control" name="nama_1" required>
                                <option value="{{ $lokasi->nama_1 ?? null}}">{{ $lokasi->nama_pengumpul->nama ?? null}}</option>
                                @foreach($kakitangans as $kakitangan)
                                <option value="{{ $kakitangan->id}}" style="text-transform:uppercase">{{ $kakitangan->nama}}</option>
                                @endforeach
                                </select>
                            </div><!--col-->

                        <label class="col-md-2 col-form-label">Pengesah Data</label>
                            <div class="col-md-3">

                            <select class="form-control" name="nama_2" required>
                                <option value="{{ $lokasi->nama_2 ?? null}}">{{ $lokasi->nama_pengesah->nama ?? null}}</option>
                                @foreach($kakitangans as $kakitangan)
                                <option value="{{ $kakitangan->id}}" style="text-transform:uppercase">{{ $kakitangan->nama}}</option>
                                @endforeach
                                </select>
                            </div><!--col-->
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Catatan</label>
                        <div class="col-md">
                            <textarea class="form-control" id="catatan" name="catatan">{{ $lokasi->catatan ?? null}}</textarea>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Penyelenggaraan Struktur</label>
                            <div class="col-md-3">

                            <select class="form-control" name="selangar_struktur" required>
                                <option value="{{ $lokasi->selangar_struktur ?? null}}">@if ($lokasi->selangar_struktur == 1 )
                                    Ya
                                @else
                                    Tidak
                                @endif</option>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
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
