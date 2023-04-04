@extends('backend.layouts.app')

@section('title', __('Senarai Komponen Aset Tak Alih'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Senarai Komponen Aset Tak Alih
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                <p>&nbsp;</p>

            </div><!--col-->

            <div class="col-sm-7">
                <form action="{{ route('admin.ata') }}" method="GET" role="search">

                    <div class="input-group">
                        <label class="my-1 mr-2 font-weight-bold">Cari</label>
                        <input type="text" class="form-control mr-2" name="term" placeholder="Masukkan kata carian" id="term" value="{{ request('term') ?? null }}">

                        <span class="input-group-btn mr-2">
                            <button class="btn btn-info" type="submit" title="Cari">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>

                        <a href="{{ route('admin.ata') }}">
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
                            <th>Kod</th>
                            <th>Peringkat 1</th>
                            <th>Peringkat 2</th>
                            <th>Peringkat 3</th>
                            <th>Peringkat 4</th>
                            <th>Peringkat 5</th>
                            <th>Peringkat 6</th>
                            <th>Peringkat 7</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($atas as $ata)

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $ata->kod_kom ?? null }}</td>
                                    <td>{{ $ata->per_1 ?? null }}</td>
                                    <td>{{ $ata->per_2 ?? null}}</td>
                                    <td>{{ $ata->per_3 ?? null}}</td>
                                    <td>{{ $ata->per_4 ?? null}}</td>
                                    <td>{{ $ata->per_5 ?? null}}</td>
                                    <td>{{ $ata->per_6 ?? null}}</td>
                                    <td>{{ $ata->per_7 ?? null}}</td>
                                    <td>

                                        {{-- butang --}}
                                        <div class="btn-group btn-group-sm">
                                            @if (empty($ata->aktif))
                                            <form method="POST" action="{{ route('admin.enableata',[$ata,'term'=>request('term') ?? null]) }}">
                                                <input type="hidden" name="id" value="{{ $ata->id }}">
                                                <a href="{{ route('admin.enableata',[$ata,'term'=>request('term') ?? null]) }}" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="enable">
                                                    <i class="fas fa-eye-slash"></i></a>
                                            </form>
                                            @else
                                            <form method="POST" action="{{ route('admin.disableata',[$ata,'term'=>request('term') ?? null]) }}">
                                                <input type="hidden" name="id" value="{{ $ata->id }}">
                                                <a href="{{ route('admin.disableata',[$ata,'term'=>request('term') ?? null]) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="disable">
                                                <i class="fas fa-eye"></i></a>
                                            </form>
                                            @endif
                                            
                                        </div>
                                        {{-- end butang --}}

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$atas->appends(['term' => request('term'),'inputState' => request('inputState')])->links()}}
                </div>
            </div><!--col-->
        </div><!--row-->

    </div><!--card-body-->
</div><!--card-->
@endsection
