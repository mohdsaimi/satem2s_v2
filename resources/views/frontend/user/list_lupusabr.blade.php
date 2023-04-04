@extends('frontend.layouts.app')

@section('title', __('Senarai Permohonan Pelupusan Aset Bernilai Rendah'))

@section('content')

<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="card-title mb-0">
                        Senarai Permohonan Pelupusan Aset Alih (ABR)
                    </h4>
                </div><!--col-->

                <div class="col-sm-5 pull-right">
                    {{-- <p>&nbsp;</p> --}}
                    {{-- <div class="btn-toolbar float-right">
                        <a href="{{ route('frontend.user.hmrosak_selesai') }}" class="btn btn-primary ml-1" data-toggle="tooltip" title="View"><i class="fas fa-eye"></i> Aduan Selesai</a>
                    </div>

                    <div class="btn-toolbar float-right">
                        <a href="{{ route('frontend.pages.aduanhm1') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create"><i class="fas fa-plus-circle"></i></a>
                    </div>

                    <div class="btn-toolbar float-right">
                        <a href="{{ route('frontend.user.export') }}" class="btn btn-info ml-1" data-toggle="tooltip" title="Excel"><i class="fas fa-file-csv"></i></a>
                    </div> --}}

                </div><!--col-->

                <div class="col-sm-7">
                    <form action="{{ route('frontend.user.list_lupusabr') }}" method="GET" role="search">

                        <div class="input-group">
                            <label class="my-1 mr-2 font-weight-bold">Cari</label>
                            <input type="text" class="form-control mr-2" name="term" placeholder="Masukkan kata carian" id="term" value="{{ request('term') ?? null }}">

                            <span class="input-group-btn mr-2">
                                <button class="btn btn-info" type="submit" title="Cari">
                                    <span class="fas fa-search"></span>
                                </button>
                            </span>

                            <a href="{{ route('frontend.user.list_lupusabr') }}">
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
                            <th>Tarikh Permohonan</th>
                            <th>Pemohon</th>
                            <th>Status</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($abrlupuss as $abrlupus)

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td style="text-transform:uppercase">{{ $abrlupus->abr->no_siri_daftar ?? null }}</td>
                                    <td style="text-transform:uppercase">{{ $abrlupus->abr->jenis ?? null }}</td>
                                    <td style="text-transform:uppercase">{{ $abrlupus->tarikh_pohon ?? null}}</td>
                                    <td style="text-transform:uppercase">{{ $abrlupus->kakitangan->nama ?? null}}</td>
                                    <td>
                                        @if (empty($abrlupus->status))
                                            <i class="btn btn-group-sm btn-info">Baru</i>
                                        @elseif ($abrlupus->status == 1)
                                            <i class="btn btn-group-sm btn-success">Lulus</i>
                                        @else
                                            <i class="btn btn-group-sm btn-danger">Reject</i>
                                        @endif
                                        
                                    </td>
                                    <td>

                                        {{-- butang --}}
                                        <div class="btn-group btn-group-sm">
                                            
                                            <a href="{{ route('frontend.user.showlupusabr',[$abrlupus,'term'=>request('term') ?? null]) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="view">
                                                <i class="fas fa-eye"></i></a>

                                            
                                        </div>
                                        {{-- end butang --}}

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$abrlupuss->appends(['term' => request('term'),'inputState' => request('inputState')])->links()}}
                </div>
            </div><!--col-->
        </div><!--row-->

        </div><!--card-body-->
    </div><!--card-->
</div>
@endsection
