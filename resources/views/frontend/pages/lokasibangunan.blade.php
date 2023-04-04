@extends('frontend.layouts.app')

@section('title', __('Lokasi Bangunan'))

@section('content')

<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Lokasi Bangunan
                    </h4>
                </div><!--col-->

                <div class="col-sm-7 pull-right">
                    {{-- <p>&nbsp;</p> --}}
                    {{-- <div class="btn-toolbar float-right">
                        <a href="{{ route('admin.createlokasi') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create"><i class="fas fa-plus-circle"></i></a>
                    </div> --}}

                    <div class="btn-toolbar float-right">
                        <a href="{{ route('frontend.pages.aduanata1') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Aduan Kerosakan ATA"><i class="fas fa-plus-circle"></i></a>
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
                                <th class="text-center">Kod Bangunan</th>
                                <th>Nama Bangunan</th>
                                <th>Download</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td class="text-center">A</td>
                                    <td>PENTADBIRAN</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Pentadbiran Aras 1.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td class="text-center">B</td>
                                    <td>PUSAT SUMBER</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Pusat Sumber Aras 1 & 2.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td class="text-center">C</td>
                                    <td>DEWAN BESAR ARAS 1</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Dewan Besar Aras 1.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td class="text-center">C</td>
                                    <td>DEWAN BESAR ARAS 2</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Dewan Besar Aras 2.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td class="text-center">D</td>
                                    <td>PONDOK PENGAWAL</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/pengawal_utama.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td class="text-center">E</td>
                                    <td>DEWAN KULIAH</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Dewan Kuliah Aras 1 & 2.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>7.</td>
                                    <td class="text-center">F</td>
                                    <td>RUMAH SAMPAH TERTUTUP</td>
                                    <td><i class='btn-sm btn-danger fas fa-ban'></i></td>
                                </tr>
                                <tr>
                                    <td>8.</td>
                                    <td class="text-center">G</td>
                                    <td>KAFETARIA</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Kafeteria Aras 1.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>9.</td>
                                    <td class="text-center">H</td>
                                    <td>BENGKEL PERISIAN ARAS 1</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Bengkel Perisian Aras 1.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>10.</td>
                                    <td class="text-center">H</td>
                                    <td>BENGKEL PERISIAN ARAS 2</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Bengkel Perisian Aras 2.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>11.</td>
                                    <td class="text-center">I</td>
                                    <td>STOR PEKERJA KONTRAK</td>
                                    <td><i class='btn-sm btn-danger fas fa-ban'></i></td>
                                </tr>
                                <tr>
                                    <td>12.</td>
                                    <td class="text-center">J</td>
                                    <td>PENCAWANG ELEKTRIK 2</td>
                                    <td><i class='btn-sm btn-danger fas fa-ban'></i></td>
                                </tr>
                                <tr>
                                    <td>13.</td>
                                    <td class="text-center">K</td>
                                    <td>BENGKEL KOMPUTER SISTEM & RANGKAIAN ARAS 1</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Bengkel Sistem Aras 1.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>14.</td>
                                    <td class="text-center">K</td>
                                    <td>BENGKEL KOMPUTER SISTEM & RANGKAIAN ARAS 2</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Bengkel Sistem Aras 2.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>14.</td>
                                    <td class="text-center">L</td>
                                    <td>BENGKEL CADD & IPD ARAS 1</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Bengkel CAD Aras 1.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>15.</td>
                                    <td class="text-center">L</td>
                                    <td>BENGKEL CADD & IPD ARAS 2</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Bengkel CAD Aras 2.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>16.</td>
                                    <td class="text-center">M</td>
                                    <td>STOR PEMANDU</td>
                                    <td><i class='btn-sm btn-danger fas fa-ban'></i></td>
                                </tr>
                                <tr>
                                    <td>17.</td>
                                    <td class="text-center">N</td>
                                    <td>PENCAWANG ELEKTRIK 1</td>
                                    <td><i class='btn-sm btn-danger fas fa-ban'></i></td>
                                </tr>
                                <tr>
                                    <td>18.</td>
                                    <td class="text-center">O</td>
                                    <td>KUARTERS G2</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Kuarters G Aras 2-4.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>19.</td>
                                    <td class="text-center">P</td>
                                    <td>KUARTERS F</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Kuarters F Aras 2-3.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>20.</td>
                                    <td class="text-center">Q</td>
                                    <td>KUARTERS C</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Kuarters C.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>21.</td>
                                    <td class="text-center">R</td>
                                    <td>KUARTERS D1 & D2</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Kuarters D.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>22.</td>
                                    <td class="text-center">S</td>
                                    <td>KUARTERS D3 & D4</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Kuarters E.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>23.</td>
                                    <td class="text-center">T</td>
                                    <td>KUARTERS G1</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Kuarters G Aras 2-4.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>24.</td>
                                    <td class="text-center">U</td>
                                    <td>SURAU</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Surau.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>25.</td>
                                    <td class="text-center">V</td>
                                    <td>DEWAN MAKAN</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Dewan Makan.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>26.</td>
                                    <td class="text-center">W</td>
                                    <td>POS PENGAWAL ASRAMA</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/pondok_pengawal_asrama.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>27.</td>
                                    <td class="text-center">X</td>
                                    <td>ASRAMA D ARAS 1</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Asrama D Aras 1.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>28.</td>
                                    <td class="text-center">X</td>
                                    <td>ASRAMA D ARAS 2</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Asrama D Aras 2.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>29.</td>
                                    <td class="text-center">X</td>
                                    <td>ASRAMA D ARAS 3</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Asrama D Aras 3.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>30.</td>
                                    <td class="text-center">Y</td>
                                    <td>ASRAMA C ARAS 1</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Asrama C Aras 1.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>31.</td>
                                    <td class="text-center">Y</td>
                                    <td>ASRAMA C ARAS 2</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Asrama C Aras 2.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>32.</td>
                                    <td class="text-center">Y</td>
                                    <td>ASRAMA C ARAS 3</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Asrama C Aras 3.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>33.</td>
                                    <td class="text-center">Z</td>
                                    <td>ASRAMA A ARAS 1</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Asrama A Aras 1.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>34.</td>
                                    <td class="text-center">Z</td>
                                    <td>ASRAMA A ARAS 2</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Asrama A Aras 2.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>35.</td>
                                    <td class="text-center">Z</td>
                                    <td>ASRAMA A ARAS 3</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Asrama A Aras 3.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>36.</td>
                                    <td class="text-center">AA</td>
                                    <td>ASRAMA B ARAS 1</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Asrama B Aras 1.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>37.</td>
                                    <td class="text-center">AA</td>
                                    <td>ASRAMA B ARAS 2</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Asrama B Aras 2.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>38.</td>
                                    <td class="text-center">AA</td>
                                    <td>ASRAMA B ARAS 3</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Asrama B Aras 3.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                                <tr>
                                    <td>39.</td>
                                    <td class="text-center">AC</td>
                                    <td>ASTAKA</td>
                                    <td><a href="{{URL::to('/')}}/storage/LOKASI/Astaka.pdf" target="_blank" class='btn-sm btn-info'><i class='fas fa-download'></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- {{$hartamodals->appends(['term' => request('term'),'inputState' => request('inputState')])->links()}} --}}
                    </div>
                </div><!--col-->
            </div><!--row-->

        </div><!--card-body-->
    </div><!--card-->
</div>
@endsection
