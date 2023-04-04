<?php

namespace App\Http\Controllers\Backend;

use App\Models\Kamusata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KamusataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Kamusata::where('nama_komponen', 'like', '%' . $term . '%')
                ->orWhere('diskripsi', 'like', '%' . $term . '%')
                ->orWhere('nama_kej', 'like', '%' . $term . '%');
                /* ->orWhere('sistem', 'like', '%' . $term . '%')
                ->orWhere('sub_sistem', 'like', '%' . $term . '%'); */
                
        } else {
            
            $query = Kamusata::query();
        }
        
                
        $kamusatas = $query->orderBy('id','ASC')->paginate(25);

        return view('backend.kamus_ata', compact('kamusatas'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.createkamus')
            /* ->withCourses(Courses::all()) */;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('pic')) {

            $request->validate([
                'pic' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /HM
            $request->pic->store('ATA', 'public');
        }
        
        $kamusata = new Kamusata();
        $kamusata->kod_kom = $request->kod_kom;
        $kamusata->komponen = $request->komponen;
        $kamusata->kod_kej = $request->kod_kej;
        $kamusata->nama_kej = $request->nama_kej;
        $kamusata->kod_sistem = $request->kod_sistem;
        $kamusata->sistem = $request->sistem;
        $kamusata->kod_subsistem = $request->kod_subsistem;
        $kamusata->sub_sistem = $request->sub_sistem;
        $kamusata->nama_komponen = $request->nama_komponen;
        $kamusata->no_1gfmas = $request->no_1gfmas;
        $kamusata->tarikh_perolehan = $request->tarikh_perolehan;
        $kamusata->kos_perolehan = $request->kos_perolehan;
        $kamusata->no_lo = $request->no_lo;
        $kamusata->kod_ptj = $request->kod_ptj;
        $kamusata->tarikh_pasang = $request->tarikh_pasang;
        $kamusata->tarikh_waranti_end = $request->tarikh_waranti_end;
        $kamusata->tarikh_tamat_dlp = $request->tarikh_tamat_dlp;
        $kamusata->jangka_hayat = $request->jangka_hayat;
        $kamusata->pengilang = $request->pengilang;
        $kamusata->pembekal = $request->pembekal;
        $kamusata->alamat = $request->alamat;
        $kamusata->no_tel = $request->no_tel;
        $kamusata->kontraktor = $request->kontraktor;
        $kamusata->alamat_kon = $request->alamat_kon;
        $kamusata->no_tel_kon = $request->no_tel_kon;
        $kamusata->catatan_1 = $request->catatan_1;
        $kamusata->diskripsi = $request->diskripsi;
        $kamusata->status_kom = $request->status_kom;
        $kamusata->jenama = $request->jenama;
        $kamusata->model = $request->model;
        $kamusata->no_siri = $request->no_siri;
        $kamusata->label_kom = $request->label_kom;
        $kamusata->no_sijil_pendaftaran = $request->no_sijil_pendaftaran;
        $kamusata->catatan_2 = $request->catatan_2;
        $kamusata->jenis = $request->jenis;
        $kamusata->bekalan_ele = $request->bekalan_ele;
        $kamusata->bahan = $request->bahan;
        $kamusata->kaedah_pasang = $request->kaedah_pasang;
        $kamusata->saiz_1 = $request->saiz_1;
        $kamusata->unit_1 = $request->unit_1;
        $kamusata->saiz_2 = $request->saiz_2;
        $kamusata->unit_2 = $request->unit_2;
        $kamusata->saiz_3 = $request->saiz_3;
        $kamusata->unit_3 = $request->unit_3;
        $kamusata->kapasiti_1 = $request->kapasiti_1;
        $kamusata->unit_kap_1 = $request->unit_kap_1;
        $kamusata->kapasiti_2 = $request->kapasiti_2;
        $kamusata->unit_kap_2 = $request->unit_kap_2;
        $kamusata->kapasiti_3 = $request->kapasiti_3;
        $kamusata->unit_kap_3 = $request->unit_kap_3;
        $kamusata->kadaran_1 = $request->kadaran_1;
        $kamusata->unit_kadar_1 = $request->unit_kadar_1;
        $kamusata->kadaran_2 = $request->kadaran_2;
        $kamusata->unit_kadar_2 = $request->unit_kadar_2;
        $kamusata->kadaran_3 = $request->kadaran_3;
        $kamusata->unit_kadar_3 = $request->unit_kadar_3;
        $kamusata->kadaran_4 = $request->kadaran_4;
        $kamusata->unit_kadar_4 = $request->unit_kadar_4;
        $kamusata->kadaran_5 = $request->kadaran_5;
        $kamusata->unit_kadar_5 = $request->unit_kadar_5;
        $kamusata->catatan_3 = $request->catatan_3;
        $kamusata->view = $request->view;
        $kamusata->bahan = $request->bahan;
        $kamusata->bahan = $request->bahan;
        $kamusata->pic = $request->pic->hashName();


        if ($kamusata->save()) {
            return redirect()->route('admin.kamus_ata')
                ->withFlashSuccess(__('Kamus Komponen ATA telah berjaya disimpan.'));
        } else {
            return redirect()->back()->withFlashDanger(__('Kamus Komponen ATA gagal disimpan'));
        }
    }

    public function enablekamusata(Kamusata $kamusata)
    {
        $view = 1;
        /* dd($ata->id); */
        Kamusata::where('id', $kamusata->id)->update(['view' => $view]);
        return redirect()->route('admin.kamus_ata',[$kamusata,'term'=>request('term') ?? null])->withFlashSuccess(__('Kamus Komponen ATA berjaya dikemaskini.'));
    }

    public function disablekamusata(Kamusata $kamusata)
    {
        $view = 0;
        /* dd($ata->id); */
        Kamusata::where('id', $kamusata->id)->update(['view' => $view]);
        return redirect()->route('admin.kamus_ata',[$kamusata,'term'=>request('term') ?? null])->withFlashSuccess(__('Kamus Komponen ATA berjaya dikemaskini.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kamusata  $kamusata
     * @return \Illuminate\Http\Response
     */
    public function show(Kamusata $kamusata)
    {
        return view('backend.showkamus')
            ->withKamusata($kamusata);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kamusata  $kamusata
     * @return \Illuminate\Http\Response
     */
    public function edit(Kamusata $kamusata)
    {
        return view('backend.editkamus')
            ->withKamusata($kamusata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kamusata  $kamusata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kamusata $kamusata)
    {
        $kamusata->update($request->all());

        return redirect()->route('admin.kamus_ata', ['term' => request('term')])->withFlashSuccess(__('Kamus Komponen ATA berjaya dikemaskini.'));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kamusata  $kamusata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kamusata $kamusata)
    {
        //
    }
    public function copy(Kamusata $kamusata)
    {
        return view('backend.copykamus')
            ->withKamusata($kamusata);
    }
}
