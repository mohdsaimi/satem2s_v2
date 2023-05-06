@extends('backend.layouts.app')

@section('title', __('Tetapan DKP'))

@section('content')

<form method="POST" action="{{ route('admin.update_tetapan_dkp') }}">
    <div class="form-group">
        @csrf
        {{-- @method('PATCH') --}}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Tetapan Daftar Kehadiran Pelajar (DKP)
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <!--row-->

                <hr />

                <div class="row mt-4">
                    <div class="col">


                        <table class="table text-center table-bordered">
                            
                                <tr>
                                    <th scope="col" colspan="3">Slot 1</th>
                                    <th scope="col" colspan="4">Slot 2</th>
                                    <th scope="col" colspan="3">Slot 3</th>
                                </tr>
                            
                                <tr>
                                    <td>Masa Mula Slot</td>
                                    <td>Lewat Check-in</td>
                                    <td>Masa Tamat Slot</td>

                                    <td></td>
                                    <td>Masa Mula Slot</td>
                                    <td>Lewat Check-in</td>
                                    <td>Masa Tamat Slot</td>

                                    <td>Masa Mula Slot</td>
                                    <td>Lewat Check-in</td>
                                    <td>Masa Tamat Slot</td>
                                </tr>

                                <tr>
                                    <td><input type="text" class="form-control" id="time_1a" name="time_1a"  value="{{ $tetapandkp->time_1a }}" required></td>
                                    <td><input type="text" class="form-control" id="time_1b" name="time_1b" value="{{ $tetapandkp->time_1b }}" required></td>
                                    <td><input type="text" class="form-control" id="time_1c" name="time_1c" value="{{ $tetapandkp->time_1c }}" required></td>

                                    <td><input type="text" class="form-control" id="time_2a" name="time_2a" value="{{ $tetapandkp->time_2a }}" required></td>
                                    <td><input type="text" class="form-control" id="time_2b" name="time_2b" value="{{ $tetapandkp->time_2b }}" required></td>
                                    <td><input type="text" class="form-control" id="time_2c" name="time_2c" value="{{ $tetapandkp->time_2c }}" required></td>
                                    <td><input type="text" class="form-control" id="time_2d" name="time_2d" value="{{ $tetapandkp->time_2d }}" required></td>

                                    <td><input type="text" class="form-control" id="time_3a" name="time_3a" value="{{ $tetapandkp->time_3a }}" required></td>
                                    <td><input type="text" class="form-control" id="time_3b" name="time_3b" value="{{ $tetapandkp->time_3b }}" required></td>
                                    <td><input type="text" class="form-control" id="time_3c" name="time_3c" value="{{ $tetapandkp->time_3c }}" required></td>
                                </tr>

                                <tr>
                                    <th scope="col" colspan="4">Slot 4</th>
                                    <th scope="col" colspan="3">Slot 5</th>
                                </tr>
                            
                                <tr>
                                    <td></td>
                                    <td>Masa Mula Slot</td>
                                    <td>Lewat Check-in</td>
                                    <td>Masa Tamat Slot</td>

                                    <td>Masa Mula Slot</td>
                                    <td>Lewat Check-in</td>
                                    <td>Masa Tamat Slot</td>
                                    
                                </tr>

                                <tr>
                                    <td><input type="text" class="form-control" id="time_4a" name="time_4a" value="{{ $tetapandkp->time_4a }}" required></td>
                                    <td><input type="text" class="form-control" id="time_4b" name="time_4b" value="{{ $tetapandkp->time_4b }}" required></td>
                                    <td><input type="text" class="form-control" id="time_4c" name="time_4c" value="{{ $tetapandkp->time_4c }}" required></td>
                                    <td><input type="text" class="form-control" id="time_4d" name="time_4d" value="{{ $tetapandkp->time_4d }}" required></td>

                                    <td><input type="text" class="form-control" id="time_5a" name="time_5a" value="{{ $tetapandkp->time_5a }}" required></td>
                                    <td><input type="text" class="form-control" id="time_5b" name="time_5b" value="{{ $tetapandkp->time_5b }}" required></td>
                                    <td><input type="text" class="form-control" id="time_5c" name="time_5c" value="{{ $tetapandkp->time_5c }}" required></td>

                                </tr>
                            
                            </table>

                        
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                    </div><!--col-->

                    <div class="col text-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    </div>
</form>
@endsection
