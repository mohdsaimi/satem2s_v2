@extends('backend.layouts.app')

@section('title', __('Tetapan DKP'))

@section('content')

<form method="POST" action="{{ route('admin.update_semester') }}">
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
                                    <th scope="col" colspan="3">Slot 2</th>
                                    <th scope="col" colspan="3">Slot 3</th>
                                    <th scope="col" colspan="3">Slot 4</th>
                                    <th scope="col" colspan="3">Slot 5</th>
                                </tr>
                            
                                <tr>
                                    <td>First Check-in</td>
                                    <td>Time</td>
                                    <td>Last Check-in</td>

                                    <td>First Check-in</td>
                                    <td>Time</td>
                                    <td>Last Check-in</td>

                                    <td>First Check-in</td>
                                    <td>Time</td>
                                    <td>Last Check-in</td>

                                    <td>First Check-in</td>
                                    <td>Time</td>
                                    <td>Last Check-in</td>

                                    <td>First Check-in</td>
                                    <td>Time</td>
                                    <td>Last Check-in</td>
                                    
                                </tr>

                                <tr>
                                    <td><input type="text" class="form-control" id="time_1a" name="time_1a" placeholder="time_1a" required></td>
                                    <td><input type="text" class="form-control" id="time_1" name="time_1" placeholder="time_1" required></td>
                                    <td><input type="text" class="form-control" id="time_1b" name="time_1b" placeholder="time_1b" required></td>

                                    <td><input type="text" class="form-control" id="time_2a" name="time_2a" placeholder="time_2a" required></td>
                                    <td><input type="text" class="form-control" id="time_2" name="time_2" placeholder="time_2" required></td>
                                    <td><input type="text" class="form-control" id="time_2b" name="time_2b" placeholder="time_2b" required></td>

                                    <td><input type="text" class="form-control" id="time_3a" name="time_3a" placeholder="time_3a" required></td>
                                    <td><input type="text" class="form-control" id="time_3" name="time_3" placeholder="time_3" required></td>
                                    <td><input type="text" class="form-control" id="time_3b" name="time_3b" placeholder="time_3b" required></td>

                                    <td><input type="text" class="form-control" id="time_4a" name="time_4a" placeholder="time_4a" required></td>
                                    <td><input type="text" class="form-control" id="time_4" name="time_4" placeholder="time_4" required></td>
                                    <td><input type="text" class="form-control" id="time_4b" name="time_4b" placeholder="time_4b" required></td>

                                    <td><input type="text" class="form-control" id="time_5a" name="time_5a" placeholder="time_5a" required></td>
                                    <td><input type="text" class="form-control" id="time_5" name="time_5" placeholder="time_5" required></td>
                                    <td><input type="text" class="form-control" id="time_5b" name="time_5b" placeholder="time_5b" required></td>
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    </div>
</form>
@endsection
