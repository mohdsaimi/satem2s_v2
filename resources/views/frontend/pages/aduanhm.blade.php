@extends('frontend.layouts.app')

@section('title', __('Aduan Kerosakan Aset Alih (Harta Modal)'))

@section('content')

<form method="POST" action="{{ route('frontend.pages.aduanhm1') }}">
    <div class="container py-4">
        @csrf
        {{-- @method('PATCH') --}}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Aduan Kerosakan Aset Alih (Harta Modal)
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr />

                <div class="row mt-4">
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">No Kad Pengenalan</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="nokp" name="nokp" placeholder="Masukkan No Kad Pengenalan tanpa '-'" required>
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
                        <button type="submit" class="btn btn-primary">Teruskan</button>
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->

        </div>
    </div>
</form>
@endsection
