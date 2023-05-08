@extends('backend.layouts.app')

@section('title', __('Laporan Keluar/Masuk Pelajar'))

@section('content')

{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> --}}

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Laporan Keluar/Masuk Pelajar
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7 pull-right">

                <div class="btn-toolbar float-right">
                    <a class="btn btn-primary" target="_blank" href="{{ route('admin.pdf_log_in_out_view',['term_1' => request('term_1'),'term_2' => request('term_2'), 'date' => request('date')]) }}">Export to PDF</a>
                </div>

            </div>
            <!--col-->

            <div class="col-sm-8">
                <form action="{{ route('admin.log_in_out') }}" method="GET" role="search">

                    <div class="input-group">
                        <label class="my-1 mr-2 font-weight-bold">Cari</label>

                        <select class="form-control" name="term_1">
                            <option value="0">Sila Pilih Kursus</option>

                            @foreach($courses as $course)
                            <option value="{{ $course->id}}" style="text-transform:uppercase">
                                {{ $course->kod}}-{{ $course->nama_kursus}}</option>
                            @endforeach

                        </select>


                        &nbsp;<input type="text" class="form-control mb-2 mr-sm-2" name="term_2" width="200"
                            placeholder="Sesi/Tahun Kemasukkan" id="term_2">

                            <input type="date" class="form-control mb-2 mr-sm-2" id="datepicker" name="date" width="200"
                            placeholder="YYYY/MM/DD" required>

                        {{-- <input class="form-control mb-2 mr-sm-2" id="datepicker" name="date" width="200"
                            placeholder="YYYY/MM/DD" required>
                        <script>
                            $('#datepicker').datepicker({
                                        uiLibrary: 'bootstrap4',
                                        format: 'yyyy-mm-dd'
                                    });
                        </script> --}}


                        <span class="input-group-btn mr-2">
                            <button class="btn btn-info" type="submit" title="Cari">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>

                        <a href="{{ route('admin.kehadiran') }}">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button" title="Refresh page">
                                    <span class="fas fa-sync-alt"></span>
                                </button>
                            </span>
                        </a>
                    </div>
                </form>
            </div>
            <!--col-->

        </div>
        <!--row-->


        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Bil.</th>
                                <th>Nama Pelajar</th>
                                <th>Kod Kursus</th>
                                <th>Sesi Kemasukkan</th>
                                <th>Suhu Keluar</th>
                                <th>Masa Keluar</th>
                                {{-- <th>Lokasi</th> --}}
                                <th>Suhu Masuk</th>
                                <th>Masa Masuk</th>
                                {{-- <th>Lokasi</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($students as $student)

                            <tr>
                                <td>{{ ++$i }}</td>
                                <td style="text-transform:uppercase">{{ $student->nama_pelajar ?? null }}</td>
                                <td>{{ $student->course->kod ?? null }}</td>
                                <td>{{ $student->sesi_masuk ?? null}}</td>

                                @if (!empty($log_in[$student->id_rfid][0]->suhu))
                                    <td>{{ number_format($log_in[$student->id_rfid][0]->suhu ?? null, 2) }}</td>
                                @else
                                    <td> - </td>
                                @endif
                                
                                @if (!empty($log_in[$student->id_rfid][0]->masa))
                                    <td>{{ $log_in[$student->id_rfid][0]->masa ?? null}}</td>
                                @else
                                    <td> - </td>
                                @endif
                                

                                {{-- <td>{{ $log_in[$student->id_rfid][0]->lokasi ?? null}}</td> --}}

                                @if (!empty($log_out_L[$student->id_rfid][0]->suhu))
                                    <td style="background-color:red; color:white;">{{ number_format($log_out_L[$student->id_rfid][0]->suhu ?? null, 2) }}</td>
                                @else

                                    @if (!empty($log_out[$student->id_rfid][0]->suhu))

                                        @if ($log_out[$student->id_rfid][0]->suhu != $log_in[$student->id_rfid][0]->suhu)
                                            <td>{{ number_format($log_out[$student->id_rfid][0]->suhu ?? null, 2) }}</td>
                                        @else
                                            <td> - </td>
                                        @endif
                                        
                                    @else
                                        <td> - </td>
                                    @endif

                                @endif


                                @if (!empty($log_out_L[$student->id_rfid][0]->masa))
                                    <td style="background-color:red; color:white;">{{  $log_out_L[$student->id_rfid][0]->masa ?? null }}</td>
                                @else
                                    @if (!empty($log_out[$student->id_rfid][0]->masa))

                                        @if ($log_out[$student->id_rfid][0]->masa != $log_in[$student->id_rfid][0]->masa)
                                            <td>{{  $log_out[$student->id_rfid][0]->masa ?? null }}</td>
                                        @else
                                            <td> - </td>
                                        @endif

                                    @else
                                        <td> - </td>
                                    @endif
                                @endif
                                
                                {{-- <td>{{ $log_out[$student->id_rfid][0]->lokasi ?? null }}</td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{$students->links()}} --}}
                    {{$students->appends(['term_1' => request('term_1'),'term_2' => request('term_2'), 'date' => request('date')])->links()}}
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->

    </div>
    <!--card-body-->
</div>
<!--card-->
@endsection
