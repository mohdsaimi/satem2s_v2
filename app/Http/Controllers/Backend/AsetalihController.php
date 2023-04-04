<?php

namespace App\Http\Controllers\Backend;

use App\Models\Asetalih;
use App\Models\Lokasi;
use App\Models\Bangunan;
use App\Models\Kamusata;
use App\Models\Kakitangan;
use App\Models\Status_alat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class AsetalihController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bangunans = Bangunan::query()->get();

        if (!empty($request->term)) {
            
            $term = $request->term;
            $term1 = $request->term1;
            $tajuk_bangunan = Bangunan::where('id',$term)->first("nama_bangunan");

            $aras = $term1;

            $query = Lokasi::where('bangunan_id', $term)
                ->where('aras', $term1);

            /* $query = Asetalih::with('lokasi')->whereHas('lokasi', function ($q) use ($term) {
                $q->where('bangunan_id', 'like', '%' . $term . '%')->where('aras', 'like', '%' . $term1 . '%');
            }); */

        } else {
            
            /* $query = Lokasi::query(); */
            $query = Lokasi::where('bangunan_id', 1)
                ->where('aras', 01);
            $tajuk_bangunan = Bangunan::first("nama_bangunan");
            $aras = '01';
        }

        $lokasis = $query->orderBy('id','ASC')->paginate(25);
        $bil_DA = Asetalih::with('asetalih_data')->get();

        return view('backend.asetalih')
            ->with('tajuk_bangunan', $tajuk_bangunan)
            ->with('aras', $aras)
            ->with('bangunans', $bangunans)
            ->with('lokasis', $lokasis)
            ->with('bil_DA', $bil_DA)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Lokasi $lokasi,Request $request)
    {
        $lokasi = Lokasi::where('id', $lokasi->id)->get()->first();

        if (!empty($request->term2)) {
            $term2 = $request->term2;

            $query = Kamusata::where([['view', 1],['nama_komponen', 'like', '%' . $term2 . '%']])
                ->orWhere([['view', 1],['diskripsi', 'like', '%' . $term2 . '%']])
                ->orWhere([['view', 1],['nama_kej', 'like', '%' . $term2 . '%']]);
                
        } else {
            
            $query = Kamusata::query();
        }

        $kamusatas = $query->where('view',1)->orderBy('id','ASC')->paginate(25);

        return view('backend.createasetalih', compact('kamusatas'))
            ->with('lokasi', $lokasi)
            ->with('i', (request()->input('page', 1) - 1) * 25);
        /* ->withCourses(Courses::all()) */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Lokasi $lokasi, Kamusata $kamusata)
    {
        /* $kamusata = Kamusata::where('id', $kamusata->id)->first(); */
        $kod_lokasi_ata = $lokasi->bangunan->kod_bangunan.".$lokasi->aras.".$lokasi->kod_lokasi;

        /* dd($kod_lokasi_ata); */
        
        $asetalih = new Asetalih();
        $asetalih->lokasi_bangunans_id = $lokasi->id;
        $asetalih->kod_lokasi_ata = $kod_lokasi_ata;
        $asetalih->kod_kom = $kamusata->kod_kom;
        $asetalih->komponen = $kamusata->komponen;
        $asetalih->kod_kej = $kamusata->kod_kej;
        $asetalih->nama_kej = $kamusata->nama_kej;
        $asetalih->kod_sistem = $kamusata->kod_sistem;
        $asetalih->sistem = $kamusata->sistem;
        $asetalih->kod_subsistem = $kamusata->kod_subsistem;
        $asetalih->sub_sistem = $kamusata->sub_sistem;
        $asetalih->nama_komponen = $kamusata->nama_komponen;
        $asetalih->no_1gfmas = $kamusata->no_1gfmas;
        $asetalih->tarikh_perolehan = $kamusata->tarikh_perolehan;
        $asetalih->kos_perolehan = $kamusata->kos_perolehan;
        $asetalih->no_lo = $kamusata->no_lo;
        $asetalih->kod_ptj = $kamusata->kod_ptj;
        $asetalih->tarikh_pasang = $kamusata->tarikh_pasang;
        $asetalih->tarikh_waranti_end = $kamusata->tarikh_waranti_end;
        $asetalih->tarikh_tamat_dlp = $kamusata->tarikh_tamat_dlp;
        $asetalih->jangka_hayat = $kamusata->jangka_hayat;
        $asetalih->pengilang = $kamusata->pengilang;
        $asetalih->pembekal = $kamusata->pembekal;
        $asetalih->alamat = $kamusata->alamat;
        $asetalih->no_tel = $kamusata->no_tel;
        $asetalih->kontraktor = $kamusata->kontraktor;
        $asetalih->alamat_kon = $kamusata->alamat_kon;
        $asetalih->no_tel_kon = $kamusata->no_tel_kon;
        $asetalih->catatan_1 = $kamusata->catatan_1;
        $asetalih->diskripsi = $kamusata->diskripsi;
        $asetalih->status_kom = $kamusata->status_kom;
        $asetalih->jenama = $kamusata->jenama;
        $asetalih->model = $kamusata->model;
        $asetalih->no_siri = $kamusata->no_siri;
        $asetalih->label_kom = $kamusata->label_kom;
        $asetalih->no_sijil_pendaftaran = $kamusata->no_sijil_pendaftaran;
        $asetalih->catatan_2 = $kamusata->catatan_2;
        $asetalih->jenis = $kamusata->jenis;
        $asetalih->bekalan_ele = $kamusata->bekalan_ele;
        $asetalih->bahan = $kamusata->bahan;
        $asetalih->kaedah_pasang = $kamusata->kaedah_pasang;
        $asetalih->saiz_1 = $kamusata->saiz_1;
        $asetalih->unit_1 = $kamusata->unit_1;
        $asetalih->saiz_2 = $kamusata->saiz_2;
        $asetalih->unit_2 = $kamusata->unit_2;
        $asetalih->saiz_3 = $kamusata->saiz_3;
        $asetalih->unit_3 = $kamusata->unit_3;
        $asetalih->kapasiti_1 = $kamusata->kapasiti_1;
        $asetalih->unit_kap_1 = $kamusata->unit_kap_1;
        $asetalih->kapasiti_2 = $kamusata->kapasiti_2;
        $asetalih->unit_kap_2 = $kamusata->unit_kap_2;
        $asetalih->kapasiti_3 = $kamusata->kapasiti_3;
        $asetalih->unit_kap_3 = $kamusata->unit_kap_3;
        $asetalih->kadaran_1 = $kamusata->kadaran_1;
        $asetalih->unit_kadar_1 = $kamusata->unit_kadar_1;
        $asetalih->kadaran_2 = $kamusata->kadaran_2;
        $asetalih->unit_kadar_2 = $kamusata->unit_kadar_2;
        $asetalih->kadaran_3 = $kamusata->kadaran_3;
        $asetalih->unit_kadar_3 = $kamusata->unit_kadar_3;
        $asetalih->kadaran_4 = $kamusata->kadaran_4;
        $asetalih->unit_kadar_4 = $kamusata->unit_kadar_4;
        $asetalih->kadaran_5 = $kamusata->kadaran_5;
        $asetalih->unit_kadar_5 = $kamusata->unit_kadar_5;
        $asetalih->catatan_3 = $kamusata->catatan_3;
        $asetalih->view = $kamusata->view;
        $asetalih->bahan = $kamusata->bahan;
        $asetalih->bahan = $kamusata->bahan;
        $asetalih->pic = $kamusata->pic;

        if ($asetalih->save()) {
            return redirect()->route('admin.show_asetalih',[$lokasi,'term'=>request('term') ?? null,'term1'=>request('term1') ?? null])
                ->withFlashSuccess(__('Komponen ATA telah berjaya disimpan.'));
        } else {
            return redirect()->back()->withFlashDanger(__('Komponen ATA gagal disimpan'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asetalih  $asetalih
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasi, Asetalih $asetalih)
    {
        /* $lokasi = Lokasi::where('id', $lokasi->id)->first('nama_lokasi','bangunan_id'); */
        $lokasi = Lokasi::where('id', $lokasi->id)->get()->first();
            
        $query = Asetalih::where('lokasi_bangunans_id', $lokasi->id);
                
        $asetalihs = $query->orderBy('id','ASC')->paginate(25);

        return view('backend.show_asetalih')
            ->with('lokasi', $lokasi)
            ->with('asetalihs', $asetalihs)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asetalih  $asetalih
     * @return \Illuminate\Http\Response
     */
    public function edit(Lokasi $lokasi, Asetalih $asetalih)
    {
        /* $lokasi = Lokasi::where('id', $lokasi->id)->get()->first();
        dd($lokasi); */
        
        return view('backend.editasetalih')
            /* ->with('lokasi', $lokasi) */
            ->withLokasi($lokasi)
            ->withAsetalih($asetalih);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asetalih  $asetalih
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asetalih $asetalih)
    {
        $lokasi = $request->lokasi;
        
        /* dd($lokasi); */
        $asetalih->update($request->all());

        return redirect()->route('admin.show_asetalih', [$lokasi,'term' => request('term')])->withFlashSuccess(__('Komponen ATA berjaya dikemaskini.'));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asetalih  $asetalih
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asetalih $asetalih, Lokasi $lokasi)
    {
        $asetalih->delete();

        return redirect()->route('admin.show_asetalih',[$lokasi,'term'=>request('term') ?? null,'term1'=>request('term1') ?? null])->withFlashSuccess(__('Maklumat komponen ATA berjaya dipadam.'));
    
    }

    public function show_ata(Lokasi $lokasi, Asetalih $asetalih)
    {
        /* $lokasi = Lokasi::where('id', $lokasi->id)->get()->first();
        dd($lokasi); */
        
        return view('backend.showasetalih')
            /* ->with('lokasi', $lokasi) */
            ->withLokasi($lokasi)
            ->withAsetalih($asetalih);
    }

    public function createDA6(Asetalih $asetalih) 
    {
        
        /* return view('backend.da6')
        ->withHmlupus($asetalih)
        ->withBangunan(Bangunan::all())
        ->withLokasi(Lokasi::all()); */


        $pdf = PDF::loadView('backend.da6', compact('asetalih'))->setPaper('a4', 'portrait');

        return $pdf->download('da6.pdf');
        
    }

    public function createDA6_1(Lokasi $lokasi) 
    {
        
        /* return view('backend.da6_1')
        ->withHmlupus($asetalih)
        ->withBangunan(Bangunan::all())
        ->withLokasi(Lokasi::all()); */


        $pdf = PDF::loadView('backend.da6_1', compact('lokasi'))->setPaper('a4', 'portrait');

        return $pdf->download('da6_1.pdf');
        
    }

    public function aduan(Asetalih $asetalih)
    {
        /* $status_alat = Status_alat::all(); */

        /* dd($aras1); */

        return view('backend.aduan_ata')
            ->withAsetalih($asetalih)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::all())
            /* ->with('status_alat',$status_alat) */
            ->withLokasi(Lokasi::all());
    }

    public function aduan_ata_str(Lokasi $lokasi, Asetalih $asetalih)
    {
        /* $lokasi = Lokasi::where('id', $lokasi->id)->first('nama_lokasi','bangunan_id'); */
        $lokasi = Lokasi::where('id', $lokasi->id)->get()->first();
            
        $query = Asetalih::where('lokasi_bangunans_id', $lokasi->id);
                
        $asetalihs = $query->orderBy('id','ASC')->paginate(25);

        return view('backend.aduan_ata_str')
            ->with('lokasi', $lokasi)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::all())
            /* ->with('asetalihs', $asetalihs) */
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }


}
