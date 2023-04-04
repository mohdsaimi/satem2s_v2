@extends('backend.layouts.app')

@section('title', __('Aset Tak Alih'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-7">
                <h4 class="card-title mb-0">
                    Senarai Aduan Kerosakan Aset Tak Alih
                </h4>
            </div><!--col-->

            <div class="col-sm-5 pull-right">
                <p>&nbsp;</p>
                {{-- <div class="btn-toolbar float-right">
                    <a href="{{ route('admin.hartamodal') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create"><i class="fas fa-plus-circle"></i></a>
                </div> --}}

            </div><!--col-->

            <div class="col-sm-7">
                <form action="{{ route('admin.atarosaktin') }}" method="GET" role="search">

                    <div class="input-group">
                        <label class="my-1 mr-2 font-weight-bold">Cari</label>
                        <input type="text" class="form-control mr-2" name="term" placeholder="Masukkan kata carian" id="term" value="{{ request('term') ?? null }}">

                        <span class="input-group-btn mr-2">
                            <button class="btn btn-info" type="submit" title="Cari">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>

                        <a href="{{ route('admin.atarosaktin') }}">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button" title="Refresh page">
                                    <span class="fas fa-sync-alt"></span>
                                </button>
                            </span>
                        </a>
                    </div>
                </form>
            </div><!--col-->

        </div><!--row-->


        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>

                            <th>Bil.</th>
                            <th>Bangunan</th>
                            <th>Kod & Nama Ruang</th>
                            <th>Nama Komponen </th>
                            <th>Tarikh Rosak</th>
                            <th>Perihal Kerosakan</th>
                            <th>Pelapor</th>
                            <th>Status</th>
                            <th>PIC</th>
                            <th>Tarikh Tugas</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($atarosaks as $atarosak)

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td style="text-transform:uppercase">{{ $atarosak->asetalih->asetalih_data->bangunan->nama_bangunan ?? null }}</td>
                                    <td style="text-transform:uppercase">{{ $atarosak->asetalih->kod_lokasi_ata ?? null }} - {{ $atarosak->asetalih->asetalih_data->nama_lokasi ?? null }}</td>
                                    <td style="text-transform:uppercase">{{ $atarosak->asetalih->nama_komponen ?? null}}</td>
                                    <td style="text-transform:uppercase">{{ $atarosak->tarikh_rosak ?? null}}</td>
                                    <td>{{ substr($atarosak->prihal_rosak ?? null,0,50) }}</td>
                                    <td style="text-transform:uppercase">{{ $atarosak->kakitangan->nama ?? null}}</td>
                                    <td>{{ $atarosak->statusrosak->nama_status ?? null}}</td>
                                    <td style="text-transform:uppercase">{{ $atarosak->nama_2->nama ?? null}}</td>
                                    <td style="text-transform:uppercase">{{ $atarosak->tarikh_siasat ?? null}}</td>
                                    <td>

                                        {{-- butang --}}

                                        @if (($atarosak->status) == 4 or ($atarosak->status) == 5)
                                            
                                        @else
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.editatarosak',[$atarosak,'term'=>request('term') ?? null]) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="show">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                            </div>
                                        @endif
                                        
                                        {{-- end butang --}}

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$atarosaks->appends(['term' => request('term'),'inputState' => request('inputState')])->links()}}
                </div>
            </div><!--col-->
        </div><!--row-->

    </div><!--card-body-->
</div><!--card-->
@endsection
