@extends('frontend.layouts.app')

@section('title', __('Aduan Kerosakan Harta Modal - Selesai'))

@section('content')

<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-7">
                    <h4 class="card-title mb-0">
                        Senarai Aduan Kerosakan Aset Alih (Harta Modal) - Selesai
                    </h4>
                </div><!--col-->

                <div class="col-sm-5 pull-right">
                    <p>&nbsp;</p>

                </div><!--col-->

                <div class="col-sm-7">
                    <form action="{{ route('frontend.user.hmrosak_selesai') }}" method="GET" role="search">

                        <div class="input-group">
                            <label class="my-1 mr-2 font-weight-bold">Cari</label>
                            <input type="text" class="form-control mr-2" name="term" placeholder="Masukkan kata carian" id="term" value="{{ request('term') ?? null }}">

                            <span class="input-group-btn mr-2">
                                <button class="btn btn-info" type="submit" title="Cari">
                                    <span class="fas fa-search"></span>
                                </button>
                            </span>

                            <a href="{{ route('frontend.user.hmrosak_selesai') }}">
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
                                <th>Tarikh Rosak</th>
                                <th>Perihal Kerosakan</th>
                                <th>Tarikh Aduan</th>
                                <th>Tarikh Asign</th>
                                <th>Tarikh Selesai</th>
                                <th>Status</th>
                                <th>PIC</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($hmrosaks as $hmrosak)

                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td style="text-transform:uppercase">{{ $hmrosak->hartamodal->no_siri_pendaftaran ?? null }}</td>
                                        <td style="text-transform:uppercase">{{ $hmrosak->hartamodal->jenis ?? null }}</td>
                                        <td style="text-transform:uppercase">{{ $hmrosak->tarikh_rosak ?? null}}</td>
                                        <td>{{ substr($hmrosak->prihal_rosak ?? null,0,50) }}</td>
                                        <td style="text-transform:uppercase">{{ $hmrosak->tarikh_aduan ?? null}}</td>
                                        <td style="text-transform:uppercase">{{ $hmrosak->tarikh_asign ?? null}}</td>
                                        <td style="text-transform:uppercase">{{ $hmrosak->tarikh_siap ?? null}}</td>
                                        <td>{{ $hmrosak->statusrosak->nama_status ?? null}}</td>
                                        <td style="text-transform:uppercase">{{ $hmrosak->nama_1->nama ?? null}}</td>
                                        <td>

                                            {{-- butang --}}
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('frontend.user.showhmrosak_selesai',[$hmrosak,'term'=>request('term') ?? null]) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="show">
                                                    <i class="fas fa-check"></i></a>
                                            </div>
                                            {{-- end butang --}}

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$hmrosaks->appends(['term' => request('term'),'inputState' => request('inputState')])->links()}}
                    </div>
                </div><!--col-->
            </div><!--row-->

        </div><!--card-body-->
    </div><!--card-->
</div>
@endsection
