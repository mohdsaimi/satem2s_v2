@extends('frontend.layouts.app')

@section('title', __('Kehadiran Pelajar'))

@section('content')

    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Kehadiran Pelajar
                        </h4>
                    </div>
                    <!--col-->

                    <div class="col-sm-7 pull-right">

                    </div>
                    <!--col-->

                    <div class="col-sm-8">
                        <form action="{{ route('frontend.pages.kehadiran-1') }}" method="GET" role="search">

                            <div class="input-group">
                                <input type="text" class="form-control mb-2 mr-sm-2" name="term" width="200"
                                    placeholder="No KP. (dengan tanda -)" id="term">

                                    <input type="date" class="form-control mb-2 mr-sm-2" id="datepicker" name="date" width="200"
                                    placeholder="YYYY/MM/DD" required>
                                
                                <span class="input-group-btn mr-2">
                                    <button class="btn btn-info" type="submit" title="Cari">
                                        <span class="fas fa-search"></span>
                                    </button>
                                </span>

                                <a href="{{ route('frontend.user.kehadiran') }}">
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
                                        <th>Nama Pelajar</th>
                                        <th>Kod Kursus</th>
                                        <th>Sesi Kemasukkan</th>
                                        <th>Suhu Pagi</th>
                                        <th>Masa Pagi</th>
                                        <th>Lokasi</th>
                                        <th>Suhu Petang</th>
                                        <th>Masa Petang</th>
                                        <th>Lokasi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($students as $student)

                                    <tr>
                                        <td style="text-transform:uppercase">{{ $student->nama_pelajar ?? null }}</td>
                                        <td>{{ $student->course->kod ?? null }}</td>
                                        <td>{{ $student->sesi_masuk ?? null}}</td>
                                        <td>{{ number_format($log_pagi[$student->id_rfid][0]->suhu ?? null, 2) }}</td>
                                        <td>{{ $log_pagi[$student->id_rfid][0]->masa ?? null}}</td>
                                        <td>{{ $log_pagi[$student->id_rfid][0]->lokasi ?? null}}</td>
                                        <td>{{ number_format($log_petang[$student->id_rfid][0]->suhu ?? null, 2) }}</td>
                                        <td>{{ $log_petang[$student->id_rfid][0]->masa ?? null }}</td>
                                        <td>{{ $log_petang[$student->id_rfid][0]->lokasi ?? null }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{$students->links()}} --}}
                            {{-- {{$students->appends(['term_1' => request('term_1'),'term_2' => request('term_2'), 'date' => request('date')])->links()}} --}}
                        </div>
                    </div>
                    <!--col-->
                </div>
                <!--row-->

            </div>
            <!--card-body-->
        </div>
    </div>

@endsection

