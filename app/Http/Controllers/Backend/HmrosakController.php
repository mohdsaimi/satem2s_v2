<?php

namespace App\Http\Controllers\Backend;

use App\Models\Hmrosak;
use App\Models\Hartamodal;
use App\Models\Bangunan;
use App\Models\Kakitangan;
use App\Models\Lokasi;
use App\Models\Statusrosak;
use App\Models\Hmlupus;
use App\Models\Tetapan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\Auth\Models\User;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DB;
use PDF;

use App\Exports\HmrosakExport;
/* use Maatwebsite\Excel\Facades\Excel; */
use Excel;

use Auth;

class HmrosakController extends Controller
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

            $query = Hmrosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','<',7)->orwhereHas('hartamodal', function ($q) use ($term) {
                    $q->where('no_siri_pendaftaran', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('jenama', 'like', '%' . $term . '%');
                })
                ->where('status','<',7)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                })
                ->where('status','<',7)->orwhereHas('statusrosak', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Hmrosak::query()->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC');
        }

        $hmrosaks = $query->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC')->paginate(25);

        return view('backend.hmrosak')
            ->with('hmrosaks', $hmrosaks)
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
        if($this->check_hmrosak($request->harta_modal_id) > 0){
            return redirect()->back()->withFlashDanger(__('Aduan kerosakan telah wujud'));
        }

        if ($request->hasFile('pic_1')) {

            $request->validate([
                'pic_1' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /HM
            $request->pic_1->store('HM', 'public');
        }

        if ($request->hasFile('pic_2')) {

            $request->validate([
                'pic_2' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /HM
            $request->pic_2->store('HM', 'public');
        }

        if ($request->hasFile('pic_3')) {

            $request->validate([
                'pic_3' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /HM
            $request->pic_3->store('HM', 'public');
        }
        
        $hmrosak = new Hmrosak();
        $hmrosak->harta_modal_id = $request->harta_modal_id;
        $hmrosak->penguna_akhir = $request->penguna_akhir;
        $hmrosak->tarikh_rosak = $request->tarikh_rosak;
        $hmrosak->prihal_rosak = $request->prihal_rosak;
        $hmrosak->status = 0;
        $hmrosak->user_id = $request->user_id;
        $hmrosak->pic_1 = $request->pic_1->hashName();

        if (!empty($request->pic_2)) {
            $hmrosak->pic_2 = $request->pic_2->hashName();
        }
        if (!empty($request->pic_3)) {
            $hmrosak->pic_3 = $request->pic_3->hashName();
        }
        /* $hmrosak->user_id = Auth::user()->id;; */

        if($hmrosak->save()){
            return redirect()->route('admin.hmrosak')
            ->withFlashSuccess(__('Aduan kerosakan telah berjaya disimpan.'));
        }
        else{
            return redirect()->back()->withFlashDanger(__('Aduan kerosakan gagal disimpan'));
        }
    }

    public function check_hmrosak($harta_modal_id){
        return Hmrosak::where('harta_modal_id',$harta_modal_id)
            ->where('status','<',7)
            ->count();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hmrosak  $hmrosak
     * @return \Illuminate\Http\Response
     */
    public function show(Hmrosak $hmrosak)
    {
        /* $users = DB::table('users')->get(); */
        
        return view('backend.showhmrosak')
            ->withHmrosak($hmrosak)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::where('team_1',1)->get())
            ->withLokasi(Lokasi::all());
            /* ->with('users', $users); */

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hmrosak  $hmrosak
     * @return \Illuminate\Http\Response
     */
    public function edit(Hmrosak $hmrosak)
    {
        return view('backend.edithmrosak')
            ->withHmrosak($hmrosak)
            ->withBangunan(Bangunan::all())
            ->withStatusrosak(Statusrosak::where('id','>',1)->where('id','!=',4)->where('id','!=',5)->where('id','!=',7)->where('id','!=',8)->where('id','!=',9)->get())
            /* ->withKakitangan(Kakitangan::where('team_1',1)->get()) */
            ->withLokasi(Lokasi::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hmrosak  $hmrosak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hmrosak $hmrosak)
    {
        $updateData = $request->validate([
            'user_asign' => 'required'
        ]);

        $date = date('Y-m-d');
        
        /* $hmrosak->update($request->all()); */
        $hmrosak->update(['user_asign' => $request->user_asign,
            'status' => 1,
            'tarikh_asign' => $date
            ]);

        return redirect()->route('admin.hmrosak',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan berjaya dikemaskini.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hmrosak  $hmrosak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hmrosak $hmrosak)
    {
        //
    }

    public function index_tindakan(Request $request)
    {
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Hmrosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','>',0)->where('status','<',7)->orwhereHas('hartamodal', function ($q) use ($term) {
                    $q->where('no_siri_pendaftaran', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('jenama', 'like', '%' . $term . '%');
                })
                ->where('status','>',0)->where('status','<',7)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Hmrosak::query()->where('status','>',0)->where('status','<',7)->orderBy('status','ASC')->orderBy('tarikh_asign','DESC');
        }

        $hmrosaks = $query->orderBy('status','ASC')->orderBy('tarikh_asign','DESC')->paginate(25);
       /*  $statusrosaks = Statusrosak::where('id','>',1)->where('id','<',6)->get(); */

        return view('backend.hmrosaktin')
            ->with('hmrosaks', $hmrosaks)
            /* ->withStatusrosak(Statusrosak::where('id','>',1)->where('id','<',6)->get()) */
            /* ->with('statusrosaks', $statusrosaks) */
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function update_tindakan(Request $request, Hmrosak $hmrosak)
    {
        $updateData = $request->validate([
            'nota_tindakan' => 'required',
            'status' => 'required'
        ]);

        $date = date('Y-m-d');
        
        /* $hmrosak->update($request->all()); */
        $hmrosak->update(['nota_tindakan' => $request->nota_tindakan,
            'kos_dulu' => $request->kos_dulu,
            'kos_anggar' => $request->kos_anggar,
            'status' => $request->status,
            'tarikh_tindakan' => $date
            ]);

        return redirect()->route('admin.hmrosaktin',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan berjaya dikemaskini.'));
    }

    public function index_selesai(Request $request)
    {
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Hmrosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','>',6)->orwhereHas('hartamodal', function ($q) use ($term) {
                    $q->where('no_siri_pendaftaran', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('jenama', 'like', '%' . $term . '%');
                })
                ->where('status','>',6)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                })
                ->where('status','>',6)->orwhereHas('statusrosak', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%')->where('id','>',3);
                });
                
        } else {
            
            $query = Hmrosak::query()->where('status','>',6)->orderBy('tarikh_tindakan','DESC');
        }

        $hmrosaks = $query->orderBy('tarikh_tindakan','DESC')->paginate(25);

        return view('backend.hmrosak_selesai')
            ->with('hmrosaks', $hmrosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function show_selesai(Hmrosak $hmrosak)
    {
        /* $users = DB::table('users')->get(); */
        
        return view('backend.showhmrosak_selesai')
            ->withHmrosak($hmrosak)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::where('team_1',1)->get())
            ->withLokasi(Lokasi::all());
            /* ->with('users', $users); */

    }

    public function createPDF(Hmrosak $hmrosak) 
    {
        $pdf = PDF::loadView('backend.pdfhmrosak', compact('hmrosak',))->setPaper('a4', 'portrait');

        return $pdf->download('pdfhmrosak.pdf');
        
    }

    public function index_lupus(Request $request)
    {
        $tetapan = Tetapan::where('id', 1)->first();
        
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Hmlupus::where('jus_1', 'like', '%' . $term . '%')
                ->where('tahun_lupus', $tetapan->tahun_lupus)->orwhereHas('hartamodal', function ($q) use ($term) {
                    $q->where('no_siri_pendaftaran', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('jenama', 'like', '%' . $term . '%');
                })
                ->where('tahun_lupus', $tetapan->tahun_lupus)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Hmlupus::query()->where('tahun_lupus', $tetapan->tahun_lupus)->orderBy('status','ASC')->orderBy('id','ASC');
        }

        $hmlupuss = $query->orderBy('status','ASC')->orderBy('id','ASC')->paginate(25);

        return view('backend.hmlupus')
            ->with('tetapan',$tetapan)
            ->with('hmlupuss', $hmlupuss)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function edit_lupus(Hmlupus $hmlupus)
    {
        return view('backend.editlupus')
            ->withHmlupus($hmlupus)
            ->withBangunan(Bangunan::all())
            ->withLokasi(Lokasi::all());
    }

    public function update_lupus(Request $request, Hmlupus $hmlupus)
    {
        /* dd($request->harta_modal_id); */
        if($request->status == 1){

            $hmlupus->update(['prestasi' => $request->prestasi,
                'kos_dulu' => $request->kos_dulu,
                'nilai_semasa' => $request->nilai_semasa,
                'jus_1' => $request->jus_1,
                'jus_2' => $request->jus_2,
                'jus_3' => $request->jus_3,
                'tahun_lupus' => $request->tahun_lupus,
                'status' => $request->status,
                'kaedah_lupus' => $request->kaedah_lupus
            ]);

            Hartamodal::where('id','=', $request->harta_modal_id)->update(['status_alat_id' => 5]);

            return redirect()->route('admin.hmlupus',['term' => request('term')])->withFlashSuccess(__('Maklumat permohonan pelupusan berjaya dikemaskini.'));

        }elseif ($request->status == 2) {
            $hmlupus->update(['prestasi' => $request->prestasi,
                'kos_dulu' => $request->kos_dulu,
                'nilai_semasa' => $request->nilai_semasa,
                'jus_1' => $request->jus_1,
                'jus_2' => $request->jus_2,
                'jus_3' => $request->jus_3,
                'tahun_lupus' => $request->tahun_lupus,
                'status' => $request->status,
                'kaedah_lupus' => $request->kaedah_lupus
            ]);

            return redirect()->route('admin.hmlupus',['term' => request('term')])->withFlashSuccess(__('Maklumat permohonan pelupusan berjaya dikemaskini.'));
        }else{
            $hmlupus->update(['prestasi' => $request->prestasi,
                'kos_dulu' => $request->kos_dulu,
                'nilai_semasa' => $request->nilai_semasa,
                'jus_1' => $request->jus_1,
                'jus_2' => $request->jus_2,
                'jus_3' => $request->jus_3,
                'tahun_lupus' => $request->tahun_lupus,
                /* 'status' => $request->status, */
                'kaedah_lupus' => $request->kaedah_lupus
            ]);
            return redirect()->route('admin.hmlupus',['term' => request('term')])->withFlashSuccess(__('Maklumat permohonan pelupusan berjaya dikemaskini.'));
        }
        
    }

    public function createpa19(Hmlupus $hmlupus) 
    {
        $tetapan = Tetapan::where('id', 1)->first();
        
        /* return view('backend.pa19')
        ->withHmlupus($hmlupus)
        ->withBangunan(Bangunan::all())
        ->withLokasi(Lokasi::all()); */


        $pdf = PDF::loadView('backend.pa19', compact('hmlupus', 'tetapan'))->setPaper('a4', 'portrait');

        return $pdf->download('pa19.pdf');
        
    }

    public function syor(Hmrosak $hmrosak)
    {
        return view('backend.syorhmrosak')
            ->withHmrosak($hmrosak)
            ->withBangunan(Bangunan::all())
            ->withStatusrosak(Statusrosak::where('id','>',3)->where('id','<',6)->get())
            /* ->withKakitangan(Kakitangan::where('team_1',1)->get()) */
            ->withLokasi(Lokasi::all());
    }

    public function updatesyor(Request $request, Hmrosak $hmrosak)
    {
        $updateData = $request->validate([
            'syor' => 'required',
            'status' => 'required',
            'tahun' => 'required'
        ]);

        /* $hmrosak->user_syor = Auth::user()->id; */

        $date = date('Y-m-d');
        
        /* $hmrosak->update($request->all()); */
        $hmrosak->update(['syor' => $request->syor,
            'kos_dulu' => $request->kos_dulu,
            'kos_anggar' => $request->kos_anggar,
            'status' => $request->status,
            'tahun' => $request->tahun,
            'tarikh_syor' => $date,
            'user_syor' => Auth::user()->id
            ]);

        return redirect()->route('admin.hmrosak',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan berjaya dikemaskini.'));
    }

    public function syor2(Hmrosak $hmrosak)
    {
        return view('backend.syor2hmrosak')
            ->withHmrosak($hmrosak)
            ->withBangunan(Bangunan::all())
            ->withStatusrosak(Statusrosak::where('id','>',6)->where('id','<',10)->get())
            /* ->withKakitangan(Kakitangan::where('team_1',1)->get()) */
            ->withLokasi(Lokasi::all());
    }

    public function updatesyor2(Request $request, Hmrosak $hmrosak)
    {
        $updateData = $request->validate([
            'status' => 'required'
        ]);

        /* $hmrosak->user_syor = Auth::user()->id; */

        $date = date('Y-m-d');
        
        /* $hmrosak->update($request->all()); */
        $hmrosak->update(['status' => $request->status,
            'tarikh_siap' => $date
            ]);

        return redirect()->route('admin.hmrosak',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan berjaya dikemaskini.'));
    }

    public function index_mohonHM(Request $request)
    {
        $tetapan = Tetapan::where('id', 1)->first();

        if (!empty($request->term)) {

            $term = $request->term;

            $query = Hartamodal::with('bangunan')
                /* ->where('status_alat_id', '<', 5) */->where('no_siri_pendaftaran', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('jenama', 'like', '%' . $term . '%')
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
            
            $query = Hartamodal::query()/* ->where('status_alat_id', '<', 5) */;

        }
                
        $hartamodals = $query->orderBy('id','ASC')->paginate(25);

        /* dd($tetapan); */

        return view('backend.mohonlupushm')
            ->with('hartamodals', $hartamodals)
            ->with('tetapan',$tetapan)
            ->with('i', (request()->input('page', 1) - 1) * 25);
        
    }

    public function lupushm(Hartamodal $hartamodal)
    {
        return view('backend.mohonlupushm1')
            ->withHartamodal($hartamodal)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::all())
            ->withLokasi(Lokasi::all());
        
    }

    public function storehmlupus(Request $request)
    {
                
        if($this->check_hmlupus($request->harta_modal_id) > 0){
            return redirect()->back()->withFlashDanger(__('Pemohonan pelupusan telah wujud'));
        }

        $tetapan = Tetapan::where('id', 1)->first();

        if ($request->hasFile('kewpa3')) {

            $request->validate([
                'kewpa3' => 'mimes:pdf' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->kewpa3->store('HM_LUPUS', 'public');
        }

        if ($request->hasFile('pic_1')) {

            $request->validate([
                'pic_1' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->pic_1->store('HM_LUPUS', 'public');
        }

        if ($request->hasFile('pic_2')) {

            $request->validate([
                'pic_2' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->pic_2->store('HM_LUPUS', 'public');
        }

        if ($request->hasFile('pic_3')) {

            $request->validate([
                'pic_3' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->pic_3->store('HM_LUPUS', 'public');
        }

        /* dd($kakitangan); */
        
        $hmlupus = new Hmlupus();
        $hmlupus->harta_modal_id = $request->harta_modal_id;
        $hmlupus->prestasi = $request->prestasi;
        $hmlupus->kod_dulu = $request->kod_dulu;
        $hmlupus->nilai_semasa = $request->nilai_semasa;
        $hmlupus->user_id = $request->user_id;
        $hmlupus->jus_1 = $request->jus_1;
        $hmlupus->jus_2 = $request->jus_2;
        $hmlupus->jus_3 = $request->jus_3;

        $hmlupus->tahun_lupus = $tetapan->tahun_lupus;
        $hmlupus->status = 0;

        $hmlupus->kewpa3 = $request->kewpa3->hashName();
        $hmlupus->pic_1 = $request->pic_1->hashName();

        if (!empty($request->pic_2)) {
            $hmlupus->pic_2 = $request->pic_2->hashName();
        }
        if (!empty($request->pic_3)) {
            $hmlupus->pic_3 = $request->pic_3->hashName();
        }

        if($hmlupus->save()){
            return redirect()->route('admin.hmlupus')
            ->withFlashSuccess(__('Permohonan pelupusan telah berjaya disimpan.'));
        }
        else{
            return redirect()->back()->withFlashDanger(__('Permohonan pelupusan gagal disimpan'));
        }
    }

    public function check_hmlupus($harta_modal_id){
        return Hmlupus::where('harta_modal_id',$harta_modal_id)
            ->where('status','<', 2)
            ->count();
    }

    public function export() 
    {
        return Excel::download(new HmrosakExport, 'hmrosak.xlsx');
    }

    
    
}
