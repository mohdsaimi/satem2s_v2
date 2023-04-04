@extends('backend.layouts.app')

@section('title', __('Tetapan BPPA'))

@section('content')

<form method="POST" action="{{ route('admin.update_tetapan') }}">
    <div class="form-group">
        @csrf
        {{-- @method('PATCH') --}}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Tetapan BPPA
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <!--row-->

                <hr />

                <div class="row mt-4">
                    <div class="col">
                        
                        <div class="form-group row">

                            <label class="col-md-2 col-form-label">Permohonan Pelupusan
                                <div class="col-md-1">
                                    @if (empty($tetapan->tetapan_bppa))
                                        <div class="col-md-1 col-form-label">
                                            <input class="form-check-input" type="radio" value="0" id="mohon_lupus" name="mohon_lupus" checked>
                                            <label class="form-check-label">
                                                Disable
                                            </label>
                                        </div>
                                        <div class="col-md-1 col-form-label">
                                            <input class="form-check-input" type="radio" value="1" id="mohon_lupus" name="mohon_lupus">
                                            <label class="form-check-label">
                                                Enable
                                            </label>
                                        </div>
                                    @else
                                        <div class="col-md-1 col-form-label">
                                            <input class="form-check-input" type="radio" value="0" id="mohon_lupus" name="mohon_lupus">
                                            <label class="form-check-label">
                                                Disable
                                            </label>
                                        </div>
                                        <div class="col-md-1 col-form-label">
                                            <input class="form-check-input" type="radio" value="1" id="mohon_lupus" name="mohon_lupus" checked>
                                            <label class="form-check-label">
                                                Enable
                                            </label>
                                        </div>
                                    @endif
                                </div>
                            </label>


                            <label class="col-md-1 col-form-label">Tahun Lupus</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="tahun_lupus" name="tahun_lupus" value="{{ $tetapan->tahun_lupus }}">
                            </div><!--col-->

                        </div><!--form-group-->
                        
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
