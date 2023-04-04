@extends('backend.layouts.app')

@section('title', __('Tambah Aset Tak Alih'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-10">
                <h4 class="card-title mb-0">
                    Tambah Aset Tak Alih (<b style="text-transform:uppercase">{{ $lokasi->bangunan->nama_bangunan }} - {{ $lokasi->aras }} - {{ $lokasi->nama_lokasi }}</b>)
                </h4>
            </div><!--col-->

            <div class="col-sm pull-right">
                <p>&nbsp;</p>
            </div><!--col-->

            <div class="col-sm-7">
                <form action="{{ route('admin.createasetalih', [$lokasi,'term'=>request('term') ?? null,'term1'=>request('term1') ?? null,'term2'=>request('term2') ?? null]) }}" method="GET" role="search">

                    <div class="input-group">
                        <label class="my-1 mr-2 font-weight-bold">Cari</label>
                        <input type="text" class="form-control mr-2" name="term2" placeholder="Masukkan kata carian" id="term2" value="{{ request('term2') ?? null }}">

                        <span class="input-group-btn mr-2">
                            <button class="btn btn-info" type="submit" title="Cari">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>

                        <a href="{{ route('admin.createasetalih', [$lokasi,'term'=>request('term') ?? null,'term1'=>request('term1') ?? null,'term2'=>request('term2') ?? null]) }}">
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
                            <th>Nama Komponen</th>
                            <th>Diskripsi</th>
                            <th>Kejuruteraan</th>
                            <th>Kontraktor</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($kamusatas as $kamusata)

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $kamusata->nama_komponen ?? null }}</td>
                                    <td>{{ $kamusata->diskripsi ?? null }}</td>
                                    <td>{{ $kamusata->nama_kej ?? null}}</td>
                                    <td>{{ $kamusata->kontraktor ?? null}}</td>
                                    <td>

                                        {{-- butang --}}
                                        {{-- <div class="btn-group btn-group-sm">
                                            <a method="POST" href="{{ route('admin.storeasetalih',[$lokasi,$kamusata,'term'=>request('term'),'term1'=>request('term1') ?? null]) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="show">
                                                <i class="fas fa-eye"></i></a>                                            
                                        </div> --}}

                                        <form method="POST" action="{{ route('admin.storeasetalih',[$lokasi,$kamusata]) }}">
                                            <input type="hidden" name="id" value="{{ $kamusata->id }}" >
                                            <a href="{{ route('admin.storeasetalih',[$lokasi,$kamusata]) }}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Tambah">
                                                <i class="fas fa-check"></i></a>
                                        </form>
                                        
                                        {{-- end butang --}}

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$kamusatas->appends(['term' => request('term'),'term1' => request('term1'),'inputState' => request('inputState')])->links()}}
                </div>
            </div><!--col-->
        </div><!--row-->

    </div><!--card-body-->
</div><!--card-->
@endsection
