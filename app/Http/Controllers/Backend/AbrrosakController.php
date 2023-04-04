<?php

namespace App\Http\Controllers\Backend;

use App\Models\Abr;
use App\Models\Abrrosak;
use App\Models\Bangunan;
use App\Models\Kakitangan;
use App\Models\Lokasi;
use App\Models\Statusrosak;
use App\Models\Tetapan;
use App\Models\Abrlupus;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Domains\Auth\Models\User;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DB;
use PDF;
use App\Exports\AbrrosakExport;
use Excel;

use Auth;

class AbrrosakController extends Controller
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

            $query = Abrrosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','<',7)->orwhereHas('abr', function ($q) use ($term) {
                    $q->where('no_siri_daftar', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('butiran', 'like', '%' . $term . '%');
                })
                ->where('status','<',7)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                })
                ->where('status','<',7)->orwhereHas('statusrosak', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Abrrosak::query()->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC');
        }

        $abrrosaks = $query->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC')->paginate(25);

        return view('backend.abrrosak')
            ->with('abrrosaks', $abrrosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->check_abrrosak($request->abr_id) > 0){
            return redirect()->back()->withFlashDanger(__('Aduan kerosakan telah wujud'));
        }

        if ($request->hasFile('pic_1')) {

            $request->validate([
                'pic_1' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /HM
            $request->pic_1->store('ABR', 'public');
        }

        if ($request->hasFile('pic_2')) {

            $request->validate([
                'pic_2' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /HM
            $request->pic_2->store('ABR', 'public');
        }

        if ($request->hasFile('pic_3')) {

            $request->validate([
                'pic_3' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /HM
            $request->pic_3->store('ABR', 'public');
        }
        
        $abrrosak = new Abrrosak();
        $abrrosak->abr_id = $request->abr_id;
        $abrrosak->penguna_akhir = $request->penguna_akhir;
        $abrrosak->tarikh_rosak = $request->tarikh_rosak;
        $abrrosak->prihal_rosak = $request->prihal_rosak;
        $abrrosak->status = 0;
        $abrrosak->user_id = $request->user_id;
        $abrrosak->pic_1 = $request->pic_1->hashName();

        if (!empty($request->pic_2)) {
            $abrrosak->pic_2 = $request->pic_2->hashName();
        }
        if (!empty($request->pic_3)) {
            $abrrosak->pic_3 = $request->pic_3->hashName();
        }

        if($abrrosak->save()){
            return redirect()->route('admin.abrrosak')
            ->withFlashSuccess(__('Aduan kerosakan telah berjaya disimpan.'));
        }
        else{
            return redirect()->back()->withFlashDanger(__('Aduan kerosakan gagal disimpan'));
        }
    }

    public function check_abrrosak($abr_id){
        return Abrrosak::where('abr_id',$abr_id)
            ->where('status','<',7)
            ->count();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Abrrosak  $abrrosak
     * @return \Illuminate\Http\Response
     */
    public function show(Abrrosak $abrrosak)
    {
        /* dd($abrrosak); */
        return view('backend.showabrrosak')
            ->withAbrrosak($abrrosak)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::where('team_1',1)->get())
            ->withLokasi(Lokasi::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Abrrosak  $abrrosak
     * @return \Illuminate\Http\Response
     */
    public function edit(Abrrosak $abrrosak)
    {
        return view('backend.editabrrosak')
            ->withAbrrosak($abrrosak)
            ->withBangunan(Bangunan::all())
            ->withStatusrosak(Statusrosak::where('id','>',1)->where('id','!=',4)->where('id','!=',5)->where('id','!=',7)->where('id','!=',8)->where('id','!=',9)->get())
            ->withLokasi(Lokasi::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Abrrosak  $abrrosak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Abrrosak $abrrosak)
    {
        $updateData = $request->validate([
            'user_asign' => 'required'
        ]);

        $date = date('Y-m-d');
        
        /* $hmrosak->update($request->all()); */
        $abrrosak->update(['user_asign' => $request->user_asign,
            'status' => 1,
            'tarikh_asign' => $date
            ]);

        return redirect()->route('admin.abrrosak',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan berjaya dikemaskini.'));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Abrrosak  $abrrosak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Abrrosak $abrrosak)
    {
        //
    }

    public function index_tindakan(Request $request)
    {
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Abrrosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','>',0)->where('status','<',7)->orwhereHas('abr', function ($q) use ($term) {
                    $q->where('no_siri_daftar', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('butiran', 'like', '%' . $term . '%');
                })
                ->where('status','>',0)->where('status','<',7)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Abrrosak::query()->where('status','>',0)->where('status','<',7)->orderBy('status','ASC')->orderBy('tarikh_asign','DESC');
        }

        $abrrosaks = $query->orderBy('status','ASC')->orderBy('tarikh_asign','DESC')->paginate(25);

        return view('backend.abrrosaktin')
            ->with('abrrosaks', $abrrosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function update_tindakan(Request $request, Abrrosak $abrrosak)
    {
        $updateData = $request->validate([
            'nota_tindakan' => 'required',
            'status' => 'required'
        ]);

        $date = date('Y-m-d');
        
        $abrrosak->update(['nota_tindakan' => $request->nota_tindakan,
            'kos_dulu' => $request->kos_dulu,
            'kos_anggar' => $request->kos_anggar,
            'status' => $request->status,
            'tarikh_tindakan' => $date
            ]);

        return redirect()->route('admin.abrrosaktin',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan berjaya dikemaskini.'));
    }

    public function createPDF(Abrrosak $abrrosak) 
    {
        $pdf = PDF::loadView('backend.pdfabrrosak', compact('abrrosak',))->setPaper('a4', 'portrait');

        return $pdf->download('pdfabrrosak.pdf');
        
    }

    public function syor(Abrrosak $abrrosak)
    {
        return view('backend.syorabrrosak')
            ->withAbrrosak($abrrosak)
            ->withBangunan(Bangunan::all())
            ->withStatusrosak(Statusrosak::where('id','>',3)->where('id','<',6)->get())
            ->withLokasi(Lokasi::all());
    }

    public function updatesyorabr(Request $request, Abrrosak $abrrosak)
    {
        $updateData = $request->validate([
            'syor' => 'required',
            'status' => 'required',
            'tahun' => 'required'
        ]);

        $date = date('Y-m-d');

        $abrrosak->update(['syor' => $request->syor,
            'kos_dulu' => $request->kos_dulu,
            'kos_anggar' => $request->kos_anggar,
            'status' => $request->status,
            'tahun' => $request->tahun,
            'tarikh_syor' => $date,
            'user_syor' => Auth::user()->id
            ]);

        return redirect()->route('admin.abrrosak',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan berjaya dikemaskini.'));
    }

    public function syor2(Abrrosak $abrrosak)
    {
        return view('backend.syor2abrrosak')
            ->withAbrrosak($abrrosak)
            ->withBangunan(Bangunan::all())
            ->withStatusrosak(Statusrosak::where('id','>',6)->where('id','<',10)->get())
            ->withLokasi(Lokasi::all());
    }

    public function updatesyor2abr(Request $request, Abrrosak $abrrosak)
    {
        $updateData = $request->validate([
            'status' => 'required'
        ]);

        $date = date('Y-m-d');

        $abrrosak->update(['status' => $request->status,
            'tarikh_siap' => $date
            ]);

        return redirect()->route('admin.abrrosak',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan berjaya dikemaskini.'));
    }

    public function index_selesai(Request $request)
    {
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Abrrosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','>',6)->orwhereHas('abr', function ($q) use ($term) {
                    $q->where('no_siri_daftar', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('butiran', 'like', '%' . $term . '%');
                })
                ->where('status','>',6)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                })
                ->where('status','>',6)->orwhereHas('statusrosak', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%')->where('id','>',3);
                });
                
        } else {
            
            $query = Abrrosak::query()->where('status','>',6)->orderBy('tarikh_tindakan','DESC');
        }

        $abrrosaks = $query->orderBy('tarikh_tindakan','DESC')->paginate(25);

        return view('backend.abrrosak_selesai')
            ->with('abrrosaks', $abrrosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function show_selesai(Abrrosak $abrrosak)
    {
        
        return view('backend.showabrrosak_selesai')
            ->withAbrrosak($abrrosak)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::where('team_1',1)->get())
            ->withLokasi(Lokasi::all());

    }

    public function index_lupus(Request $request)
    {
        $tetapan = Tetapan::where('id', 1)->first();
        
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Abrlupus::where('jus_1', 'like', '%' . $term . '%')
                ->where('tahun_lupus', $tetapan->tahun_lupus)->orwhereHas('abr', function ($q) use ($term) {
                    $q->where('no_siri_daftar', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('butiran', 'like', '%' . $term . '%');
                })
                ->where('tahun_lupus', $tetapan->tahun_lupus)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Abrlupus::query()->where('tahun_lupus', $tetapan->tahun_lupus)->orderBy('status','ASC')->orderBy('id','ASC');
        }

        $abrlupuss = $query->orderBy('status','ASC')->orderBy('id','ASC')->paginate(25);

        return view('backend.abrlupus')
            ->with('tetapan',$tetapan)
            ->with('abrlupuss', $abrlupuss)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function index_mohonABR(Request $request)
    {
        $tetapan = Tetapan::where('id', 1)->first();

        if (!empty($request->term)) {

            $term = $request->term;

            $query = Abr::with('bangunan')
                /* ->where('status_alat_id', '<', 5) */->where('no_siri_daftar', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('butiran', 'like', '%' . $term . '%')
                ->orwhereHas('bangunan', function ($q) use ($term) {
                    $q->where('nama_bangunan', 'like', '%' . $term . '%')->orWhere('kod_bangunan', $term );
                })
                /* ->where('status_alat_id', '<', 5) */->orWhereHas('lokasi', function ($q) use ($term) {
                    $q->where('nama_lokasi', 'like', '%' . $term . '%')->orWhere('kod_lokasi', 'like', '%' . $term . '%');
                })
                /* ->where('status_alat_id', '<', 5) */->orWhereHas('status_alat', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Abr::query()/* ->where('status_alat_id', '<', 5) */;

        }
                
        $abrs = $query->orderBy('id','ASC')->paginate(25);

        /* dd($tetapan); */

        return view('backend.mohonlupusabr')
            ->with('abrs', $abrs)
            ->with('tetapan',$tetapan)
            ->with('i', (request()->input('page', 1) - 1) * 25);
        
    }

    public function lupusabr(Abr $abr)
    {
        return view('backend.mohonlupusabr1')
            ->withAbr($abr)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::all())
            ->withLokasi(Lokasi::all());
        
    }

    public function storeabrlupus(Request $request)
    {
                
        if($this->check_abrlupus($request->abr_id) > 0){
            return redirect()->back()->withFlashDanger(__('Pemohonan pelupusan telah wujud'));
        }

        $tetapan = Tetapan::where('id', 1)->first();

        if ($request->hasFile('kewpa4')) {

            $request->validate([
                'kewpa4' => 'mimes:pdf' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->kewpa4->store('ABR_LUPUS', 'public');
        }

        if ($request->hasFile('pic_1')) {

            $request->validate([
                'pic_1' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->pic_1->store('ABR_LUPUS', 'public');
        }

        if ($request->hasFile('pic_2')) {

            $request->validate([
                'pic_2' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->pic_2->store('ABR_LUPUS', 'public');
        }

        if ($request->hasFile('pic_3')) {

            $request->validate([
                'pic_3' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->pic_3->store('ABR_LUPUS', 'public');
        }

        /* dd($kakitangan); */
        
        $abrlupus = new Abrlupus();
        $abrlupus->abr_id = $request->abr_id;
        $abrlupus->prestasi = $request->prestasi;
        $abrlupus->kod_dulu = $request->kod_dulu;
        $abrlupus->nilai_semasa = $request->nilai_semasa;
        $abrlupus->user_id = $request->user_id;
        $abrlupus->jus_1 = $request->jus_1;
        $abrlupus->jus_2 = $request->jus_2;
        $abrlupus->jus_3 = $request->jus_3;

        $abrlupus->tahun_lupus = $tetapan->tahun_lupus;
        $abrlupus->status = 0;

        $abrlupus->kewpa4 = $request->kewpa4->hashName();
        $abrlupus->pic_1 = $request->pic_1->hashName();

        if (!empty($request->pic_2)) {
            $abrlupus->pic_2 = $request->pic_2->hashName();
        }
        if (!empty($request->pic_3)) {
            $abrlupus->pic_3 = $request->pic_3->hashName();
        }

        if($abrlupus->save()){
            return redirect()->route('admin.abrlupus')
            ->withFlashSuccess(__('Permohonan pelupusan telah berjaya disimpan.'));
        }
        else{
            return redirect()->back()->withFlashDanger(__('Permohonan pelupusan gagal disimpan'));
        }
    }

    public function check_abrlupus($abr_id){
        return Abrlupus::where('abr_id',$abr_id)
            ->where('status','<', 2)
            ->count();
    }

    public function edit_lupusabr(Abrlupus $abrlupus)
    {
        return view('backend.editlupusabr')
            ->withAbrlupus($abrlupus)
            ->withBangunan(Bangunan::all())
            ->withLokasi(Lokasi::all());
    }

    public function update_lupusabr(Request $request, Abrlupus $abrlupus)
    {
        if($request->status == 1){

            $abrlupus->update(['prestasi' => $request->prestasi,
                'kos_dulu' => $request->kos_dulu,
                'nilai_semasa' => $request->nilai_semasa,
                'jus_1' => $request->jus_1,
                'jus_2' => $request->jus_2,
                'jus_3' => $request->jus_3,
                'tahun_lupus' => $request->tahun_lupus,
                'status' => $request->status,
                'kaedah_lupus' => $request->kaedah_lupus
            ]);

            Abr::where('id','=', $request->abr_id)->update(['status_alat_id' => 5]);

            return redirect()->route('admin.abrlupus',['term' => request('term')])->withFlashSuccess(__('Maklumat permohonan pelupusan berjaya dikemaskini.'));

        }elseif ($request->status == 2) {
            $abrlupus->update(['prestasi' => $request->prestasi,
                'kos_dulu' => $request->kos_dulu,
                'nilai_semasa' => $request->nilai_semasa,
                'jus_1' => $request->jus_1,
                'jus_2' => $request->jus_2,
                'jus_3' => $request->jus_3,
                'tahun_lupus' => $request->tahun_lupus,
                'status' => $request->status,
                'kaedah_lupus' => $request->kaedah_lupus
            ]);

            return redirect()->route('admin.abrlupus',['term' => request('term')])->withFlashSuccess(__('Maklumat permohonan pelupusan berjaya dikemaskini.'));
        }else{
            $abrlupus->update(['prestasi' => $request->prestasi,
                'kos_dulu' => $request->kos_dulu,
                'nilai_semasa' => $request->nilai_semasa,
                'jus_1' => $request->jus_1,
                'jus_2' => $request->jus_2,
                'jus_3' => $request->jus_3,
                'tahun_lupus' => $request->tahun_lupus,
                /* 'status' => $request->status, */
                'kaedah_lupus' => $request->kaedah_lupus
            ]);
            return redirect()->route('admin.abrlupus',['term' => request('term')])->withFlashSuccess(__('Maklumat permohonan pelupusan berjaya dikemaskini.'));
        }
        
    }

    public function export() 
    {
        return Excel::download(new AbrrosakExport, 'abrrosak.xlsx');
    }

}
