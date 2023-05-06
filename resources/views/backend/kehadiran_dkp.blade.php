@extends('backend.layouts.app')

@section('title', __('Laporan Daftar Kehadiran Pelajar (DKP)'))

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
                    Laporan Daftar Kehadiran Pelajar (DKP)
                </h4>
            </div>
            <!--col-->

            <div class="col-sm-7 pull-right">

                <div class="btn-toolbar float-right">
                    <a class="btn btn-primary" target="_blank" href="{{ route('admin.pdf_dkp_view',['term_1' => request('term_1'),'term_2' => request('term_2'), 'date' => request('date')]) }}">Export to PDF</a>
                </div>

            </div>
            <!--col-->

            <div class="col-sm-8">
                <form action="{{ route('admin.kehadiran_dkp') }}" method="GET" role="search">

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

                        <a href="{{ route('admin.kehadiran_dkp') }}">
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



        {{-- ////////////////////////////////////////////////////////////////////////////////////////////////// --}}




        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table text-center table-bordered">

                        <thead>
                            <tr>
                                <th rowspan="3" style="vertical-align: middle">Bil.</th>
                                <th rowspan="3" style="vertical-align: middle">Nama Pelajar</th>
                                <th rowspan="3" style="vertical-align: middle">NDP</th>
                                <th colspan="5" style="text-align: center">Kedatangan {{ $date ?? null }}</th>
                            </tr>
                            <tr>
                                <th style="text-align: center">1</th>
                                <th style="text-align: center">2</th>
                                <th style="text-align: center">3</th>
                                <th style="text-align: center">4</th>
                                <th style="text-align: center">5</th>
                            </tr>
                            <tr>
                                <th style="text-align: center">0800-0930</th>
                                <th style="text-align: center">1000-1130</th>
                                <th style="text-align: center">1130-1300</th>
                                <th style="text-align: center">1400-1530</th>
                                <th style="text-align: center">1530-1700</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($students as $student)

                            <tr>
                                <td>{{ ++$i }}</td>
                                <td style="text-transform:uppercase">{{ $student->nama_pelajar ?? null }}</td>
                                <td>{{ $student->ndp ?? null }}</td>
                                
                                    @if (!empty($slot1G[$student->id_rfid][0]->masa))
                                        <td style="background-color:green; color:white;">1 <br>{{date('g:i:s A', strtotime($slot1G[$student->id_rfid][0]->masa)) }}</td>
                                    @elseif (!empty($slot1Y[$student->id_rfid][0]->masa))
                                        <td style="background-color:yellow; color:black;">L <br>{{date('g:i:s A', strtotime($slot1Y[$student->id_rfid][0]->masa)) }}</td>
                                    @elseif (!empty($slot1R[$student->id_rfid][0]->masa))
                                        <td style="background-color:red; color:white;">0 <br>{{date('g:i:s A', strtotime($slot1R[$student->id_rfid][0]->masa)) }}</td>
                                    @else
                                        <td style="background-color:red; color:white;">0</td>
                                    @endif
                                

                                
                                    @if (!empty($slot2G[$student->id_rfid][0]->masa))
                                        <td style="background-color:green; color:white;">1 <br>{{date('g:i:s A', strtotime($slot2G[$student->id_rfid][0]->masa)) }}</td>
                                    @elseif (!empty($slot2Y[$student->id_rfid][0]->masa))
                                        <td style="background-color:yellow; color:black;">L <br>{{date('g:i:s A', strtotime($slot2Y[$student->id_rfid][0]->masa)) }}</td>
                                    @elseif (!empty($slot2R[$student->id_rfid][0]->masa))
                                        <td style="background-color:red; color:white;">0 <br>{{date('g:i:s A', strtotime($slot2R[$student->id_rfid][0]->masa)) }}</td>
                                    @else
                                        <td style="background-color:red; color:white;">0</td>
                                    @endif
                                

                                    @if (!empty($slot3G[$student->id_rfid][0]->masa))
                                        <td style="background-color:green; color:white;">1 <br>{{date('g:i:s A', strtotime($slot3G[$student->id_rfid][0]->masa)) }}</td>
                                    @elseif (!empty($slot3Y[$student->id_rfid][0]->masa))
                                        <td style="background-color:yellow; color:black;">L <br>{{date('g:i:s A', strtotime($slot3Y[$student->id_rfid][0]->masa)) }}</td>
                                    @elseif (!empty($slot3R[$student->id_rfid][0]->masa))
                                        <td style="background-color:red; color:white;">0 <br>{{date('g:i:s A', strtotime($slot3R[$student->id_rfid][0]->masa)) }}</td>
                                    @else
                                        <td style="background-color:red; color:white;">0</td>
                                    @endif
                                

                                
                                    @if (!empty($slot4G[$student->id_rfid][0]->masa))
                                        <td style="background-color:green; color:white;">1 <br>{{date('g:i:s A', strtotime($slot4G[$student->id_rfid][0]->masa)) }}</td>
                                    @elseif (!empty($slot4Y[$student->id_rfid][0]->masa))
                                        <td style="background-color:yellow; color:black;">L <br>{{date('g:i:s A', strtotime($slot4Y[$student->id_rfid][0]->masa)) }}</td>
                                    @elseif (!empty($slot4R[$student->id_rfid][0]->masa))
                                        <td style="background-color:red; color:white;">0 <br>{{date('g:i:s A', strtotime($slot4R[$student->id_rfid][0]->masa)) }}</td>
                                    @else
                                        <td style="background-color:red; color:white;">0</td>
                                    @endif
                                

                                
                                    @if (!empty($slot5G[$student->id_rfid][0]->masa))
                                        <td style="background-color:green; color:white;">1 <br>{{date('g:i:s A', strtotime($slot5G[$student->id_rfid][0]->masa)) }}</td>
                                    @elseif (!empty($slot5Y[$student->id_rfid][0]->masa))
                                        <tbody style="background-color:yellow; color:black;">L <br>{{date('g:i:s A', strtotime($slot5Y[$student->id_rfid][0]->masa)) }}</tbody>
                                    @elseif (!empty($slot5R[$student->id_rfid][0]->masa))
                                        <td style="background-color:red; color:white;">0 <br>{{date('g:i:s A', strtotime($slot5R[$student->id_rfid][0]->masa)) }}</td>
                                    @else
                                        <td style="background-color:red; color:white;">0</td>
                                    @endif
                                
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
