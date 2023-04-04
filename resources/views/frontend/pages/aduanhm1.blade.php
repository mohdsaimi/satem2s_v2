@extends('frontend.layouts.app')

@section('title', __('Harta Modal'))

@section('content')

<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Aduan Kerosakan Aset Alih (Harta Modal)
                    </h4>
                </div><!--col-->

                <div class="col-sm-7 pull-right">
                    <p>&nbsp;</p>
                    {{-- <div class="btn-toolbar float-right">
                        <a href="{{ route('admin.createlokasi') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create"><i class="fas fa-plus-circle"></i></a>
                    </div> --}}

                </div><!--col-->

                <div class="col-sm-7">
                    <form action="{{ route('frontend.pages.aduanhm1') }}" method="GET" role="search">
                        <div class="input-group">
                            <label class="my-1 mr-2 font-weight-bold">Cari</label>
                            <input type="text" class="form-control mr-2" name="term" placeholder="Masukkan kata carian" id="term" value="{{ request('term') ?? null }}">

                            <span class="input-group-btn mr-2">
                                <button class="btn btn-info" type="submit" title="Cari">
                                    <span class="fas fa-search"></span>
                                </button>
                            </span>

                            <a href="{{ route('frontend.pages.aduanhm1') }}">
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
                                <th>No. Siri Pendaftaran</th>
                                <th>Jenis Aset</th>
                                <th>Jenama</th>
                                <th>Lokasi</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($hartamodals as $hartamodal)

                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td style="text-transform:uppercase">{{ $hartamodal->no_siri_pendaftaran ?? null }}</td>
                                        <td style="text-transform:uppercase">{{ $hartamodal->jenis ?? null }}</td>
                                        <td style="text-transform:uppercase">{{ $hartamodal->jenama ?? null}}</td>
                                        <td style="text-transform:uppercase">{{ $hartamodal->bangunan->kod_bangunan ?? null}}/{{ $hartamodal->aras ?? null}}/{{ $hartamodal->kod_lokasi ?? null}}</td>
                                        <td>

                                            {{-- butang --}}
                                            <div class="btn-group btn-group-sm">
                                                {{-- <a href="{{ route('admin.showhartamodal',[$hartamodal,'term'=>request('term') ?? null]) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="show">
                                                    <i class="fas fa-eye"></i></a>
                                                <a href="{{ route('admin.edithartamodal',[$hartamodal,'term'=>request('term') ?? null]) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="edit">
                                                    <i class="fas fa-edit"></i></a> --}}
                                                <a href="{{ route('frontend.pages.aduanhartamodal',[$hartamodal,'term'=>request('term') ?? null]) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="aduan">
                                                    <i class="fas fa-cogs"></i></a>
                                            </div>
                                            {{-- end butang --}}

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$hartamodals->appends(['term' => request('term'),'inputState' => request('inputState')])->links()}}
                    </div>
                </div><!--col-->
            </div><!--row-->

        </div><!--card-body-->
    </div><!--card-->
</div>
@endsection
