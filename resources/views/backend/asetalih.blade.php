@extends('backend.layouts.app')

@section('title', __('Senarai Aset Tak Alih'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Senarai Aset Tak Alih ({{ $tajuk_bangunan->nama_bangunan }} Aras {{ $aras }})
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                {{-- <p>&nbsp;</p> --}}
                <div class="btn-toolbar float-right">
                    <a href="{{ route('admin.lokasibangunan') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Lokasi Bangunan"><i class="fas fa-eye"></i></a>
                </div>
            </div><!--col-->

            <div class="col-sm-7">
                <form action="{{ route('admin.asetalih') }}" method="GET" role="search">

                    <div class="input-group">
                        <label class="my-1 mr-2 font-weight-bold">Bangunan</label>
                        <div class="col-md-4">
                            <select class="form-control" name="term" id="term">
                                @foreach ($bangunans as $bangunan)
                                <option value="{{ $bangunan->id }}">{{ $bangunan->nama_bangunan	 }}</option>
                                @endforeach
                            </select>
                        </div><!--col-->

                        <label class="my-1 mr-2 font-weight-bold">Aras</label>
                        <div class="col-md-2">
                            <select class="form-control" name="term1" id="term1">
                                
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="">-</option>
                                
                            </select>
                            {{-- <input type="text" class="form-control mr-1" name="term1" placeholder="" id="term1" value="{{ request('term1') ?? null }}"> --}}
                        </div><!--col-->

                        <span class="input-group-btn mr-2">
                            <button class="btn btn-info" type="submit" title="Cari">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>

                        <a href="{{ route('admin.asetalih') }}">
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
                            <th>Aras</th>
                            <th>Nama Ruang</th>
                            <th>Bil. DA.</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($lokasis as $lokasi)

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $lokasi->bangunan->nama_bangunan ?? null }}</td>
                                    <td>{{ $lokasi->aras ?? null }}</td>
                                    <td>{{ $lokasi->nama_lokasi ?? null}}</td>
                                    <td>{{ $bil_DA->where('lokasi_bangunans_id',$lokasi->id)->count() ?? null}}</td>
                                    <td>

                                        {{-- butang --}}
                                        <div class="btn-group btn-group-sm">

                                            <a href="{{ route('admin.editlokasi',[$lokasi,'term'=>request('term') ?? null]) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="{{ route('admin.show_asetalih',[$lokasi,'term'=>request('term'),'term1'=>request('term1') ?? null]) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="show">
                                                <i class="fas fa-eye"></i></a>
                                            
                                            <a href="{{ route('admin.da6_1',$lokasi) }}" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Print">
                                                <i class="fas fa-print"></i></a>

                                                @if ($bil_DA->where('lokasi_bangunans_id',$lokasi->id)->count() > 0)
                                                <a href="{{ route('admin.show_asetalih',[$lokasi,'term'=>request('term'),'term1'=>request('term1') ?? null]) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="aduan">
                                                    <i class="fas fa-cogs"></i></a>
                                                @endif

                                                @if ($lokasi->selangar_struktur == 1)
                                                <a href="{{ route('admin.aduan_ata_str',[$lokasi,'term'=>request('term'),'term1'=>request('term1') ?? null]) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="aduan struktur">
                                                    <i class="fas fa-tools"></i></a>
                                                @endif

                                        </div>
                                        {{-- end butang --}}

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$lokasis->appends(['term' => request('term'),'term1' => request('term1'),'inputState' => request('inputState')])->links()}}
                </div>
            </div><!--col-->
        </div><!--row-->

    </div><!--card-body-->
</div><!--card-->
@endsection
