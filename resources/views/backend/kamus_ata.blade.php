@extends('backend.layouts.app')

@section('title', __('Senarai Kamus Komponen Aset Tak Alih'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Senarai Kamus Komponen Aset Tak Alih
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                <div class="btn-toolbar float-right">
                    <a href="{{ route('admin.createkamus') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create"><i class="fas fa-plus-circle"></i></a>
                </div>
            </div><!--col-->

            <div class="col-sm-7">
                <form action="{{ route('admin.kamus_ata') }}" method="GET" role="search">

                    <div class="input-group">
                        <label class="my-1 mr-2 font-weight-bold">Cari</label>
                        <input type="text" class="form-control mr-2" name="term" placeholder="Masukkan kata carian" id="term" value="{{ request('term') ?? null }}">

                        <span class="input-group-btn mr-2">
                            <button class="btn btn-info" type="submit" title="Cari">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>

                        <a href="{{ route('admin.kamus_ata') }}">
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
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.editkamus',[$kamusata,'term'=>request('term') ?? null]) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="edit">
                                                <i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin.showkamus',[$kamusata,'term'=>request('term') ?? null]) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="show">
                                                <i class="fas fa-eye"></i></a>

                                            @if (empty($kamusata->view))
                                            <form method="POST" action="{{ route('admin.enablekamusata',[$kamusata,'term'=>request('term') ?? null]) }}">
                                                <input type="hidden" name="id" value="{{ $kamusata->id }}" >
                                                <a href="{{ route('admin.enablekamusata',[$kamusata,'term'=>request('term') ?? null]) }}" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="enable">
                                                    <i class="fas fa-eye-slash"></i></a>
                                            </form>
                                            @else
                                            <form method="POST" action="{{ route('admin.disablekamusata',[$kamusata,'term'=>request('term') ?? null]) }}">
                                                <input type="hidden" name="id" value="{{ $kamusata->id }}" >
                                                <a href="{{ route('admin.disablekamusata',[$kamusata,'term'=>request('term') ?? null]) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="disable">
                                                <i class="fas fa-eye"></i></a>
                                            </form>
                                            @endif
                                            
                                            <a href="{{ route('admin.copykamus',[$kamusata,'term'=>request('term') ?? null]) }}" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="copy">
                                                <i class="fas fa-copy"></i></a>

                                        </div>
                                        {{-- end butang --}}

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$kamusatas->appends(['term' => request('term'),'inputState' => request('inputState')])->links()}}
                </div>
            </div><!--col-->
        </div><!--row-->

    </div><!--card-body-->
</div><!--card-->
@endsection
