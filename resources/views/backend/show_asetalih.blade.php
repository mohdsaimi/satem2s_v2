@extends('backend.layouts.app')

@section('title', __('Senarai Aset Tak Alih'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-10">
                <h4 class="card-title mb-0">
                    Senarai Aset Tak Alih (<b style="text-transform:uppercase">{{ $lokasi->bangunan->nama_bangunan }} - {{ $lokasi->aras }} - {{ $lokasi->nama_lokasi }}</b>)
                </h4>
            </div><!--col-->

            <div class="col-sm pull-right">
                {{-- <p>&nbsp;</p> --}}
                <div class="btn-toolbar float-right">
                    <a href="{{ route('admin.createasetalih', [$lokasi,'term'=>request('term') ?? null,'term1'=>request('term1') ?? null]) }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create"><i class="fas fa-plus-circle"></i></a>
                </div>
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
                            <th>Kuantiti</th>
                            <th>Diskripsi</th>
                            <th>Kejuruteraan</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($asetalihs as $asetalih)

                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $asetalih->nama_komponen ?? null }}</td>
                                    <td>{{ $asetalih->kuantiti ?? null }}</td>
                                    <td>{{ $asetalih->diskripsi ?? null}}</td>
                                    <td>{{ $asetalih->nama_kej ?? null}}</td>
                                    <td>

                                        {{-- butang --}}
                                        <form action="{{ route('admin.destroyasetalih', [$asetalih,$lokasi,'term'=>request('term') ?? null,'term1'=>request('term1') ?? null]) }}" method="POST">
                                            <div class="btn-group btn-group-sm" {{-- aria-label="@lang('labels.backend.access.users.user_actions')" --}}>
                                                <a href="{{ route('admin.showasetalih',[$asetalih,'term'=>request('term') ?? null,'term1'=>request('term1') ?? null]) }}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="show">
                                                    <i class="fas fa-eye"></i></a>

                                                <a href="{{ route('admin.editasetalih',[$asetalih,'term'=>request('term') ?? null,'term1'=>request('term1') ?? null]) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="delete" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="delete"
                                                    onclick="return confirm('Are you sure you want to delete the record?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                                <a href="{{ route('admin.da6',$asetalih) }}" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Print">
                                                    <i class="fas fa-print"></i></a>
                                                
                                                <a href="{{ route('admin.aduan_ata',[$asetalih,'term'=>request('term') ?? null,'term1'=>request('term1') ?? null]) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="aduan">
                                                    <i class="fas fa-cogs"></i></a>
                                            </div>
                                        </form>
                                        {{-- end butang --}}

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$asetalihs->appends(['term' => request('term'),'term1' => request('term1'),'inputState' => request('inputState')])->links()}}
                </div>
            </div><!--col-->
        </div><!--row-->

    </div><!--card-body-->
</div><!--card-->
@endsection
