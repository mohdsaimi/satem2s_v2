@extends('backend.layouts.app')

@section('title', __('Aset Tak Alih'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="card-title mb-0">
                    Senarai Aduan Kerosakan Aset Tak Alih (Struktur)
                </h4>
            </div><!--col-->

            <div class="col-sm-6 pull-right">
                {{-- <p>&nbsp;</p> --}}
                <div class="btn-toolbar float-right">
                    <a href="{{ route('admin.strrosak_selesai') }}" class="btn btn-primary ml-1" data-toggle="tooltip" title="View"><i class="fas fa-eye"></i> Aduan Selesai</a>
                </div>

                <div class="btn-toolbar float-right">
                    <a href="{{ route('admin.asetalih') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create"><i class="fas fa-plus-circle"></i></a>
                </div>

                <div class="btn-toolbar float-right">
                    <a href="{{ route('admin.exportstr') }}" class="btn btn-info ml-1" data-toggle="tooltip" title="Excel"><i class="fas fa-file-csv"></i></a>
                </div>

            </div><!--col-->

            <div class="col-sm-7">
                <form action="{{ route('admin.strrosak') }}" method="GET" role="search">

                    <div class="input-group">
                        <label class="my-1 mr-2 font-weight-bold">Cari</label>
                        <input type="text" class="form-control mr-2" name="term" placeholder="Masukkan kata carian" id="term" value="{{ request('term') ?? null }}">

                        <span class="input-group-btn mr-2">
                            <button class="btn btn-info" type="submit" title="Cari">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>

                        <a href="{{ route('admin.strrosak') }}">
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
                            <th>Nama Kekemasan/Struktur </th>
                            <th>Tarikh Rosak</th>
                            <th>Perihal Kerosakan</th>
                            <th>Pelapor</th>
                            <th>Status</th>
                            <th>PIC</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($strrosaks as $strrosak)

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td style="text-transform:uppercase">{{ $strrosak->lokasi->bangunan->nama_bangunan ?? null }}</td>
                                    <td style="text-transform:uppercase">{{ $strrosak->lokasi->bangunan->kod_bangunan ?? null }}.{{ $strrosak->lokasi->aras ?? null }}.{{ $strrosak->lokasi->kod_lokasi ?? null }} - {{ $strrosak->lokasi->nama_lokasi ?? null }}</td>
                                    <td style="text-transform:uppercase">{{ $strrosak->nama_kekemasan ?? null}}</td>
                                    <td style="text-transform:uppercase">{{ $strrosak->tarikh_rosak ?? null}}</td>
                                    <td>{{ substr($strrosak->prihal_rosak ?? null,0,50) }}</td>
                                    <td style="text-transform:uppercase">{{ $strrosak->kakitangan->nama ?? null}}</td>
                                    <td>{{ $strrosak->statusrosak->nama_status ?? null}}</td>
                                    <td style="text-transform:uppercase">{{ $strrosak->nama_2->nama ?? null}}</td>
                                    <td>

                                        {{-- butang --}}
                                        <div class="btn-group btn-group-sm">
                                            @if (($strrosak->status) > 1)
                                                
                                            @else
                                            <a href="{{ route('admin.showstrrosak',[$strrosak,'term'=>request('term') ?? null]) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Show">
                                                <i class="fas fa-check"></i></a>
                                            @endif

                                            <a href="{{ route('admin.pdfstrrosak',$strrosak) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Print">
                                                <i class="fas fa-print"></i></a>

                                            @if ($strrosak->status == 2 or $strrosak->status == 3)
                                                <a href="{{ route('admin.syorstrrosak',[$strrosak,'term'=>request('term') ?? null]) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="SYOR">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                            @endif

                                            @if ($strrosak->status == 4 or $strrosak->status == 5 or $strrosak->status == 6)
                                                <a href="{{ route('admin.syor2strrosak',[$strrosak,'term'=>request('term') ?? null]) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Confirm">
                                                    <i class="fas fa-pen"></i></a>
                                            @endif
                                            
                                        </div>
                                        {{-- end butang --}}

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$strrosaks->appends(['term' => request('term'),'inputState' => request('inputState')])->links()}}
                </div>
            </div><!--col-->
        </div><!--row-->

    </div><!--card-body-->
</div><!--card-->
@endsection
