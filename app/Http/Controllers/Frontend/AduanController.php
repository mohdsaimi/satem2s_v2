<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Kakitangan;
use App\Models\Hartamodal;
use App\Models\Lokasi;
use App\Models\Bangunan;
use App\Models\Hmrosak;
use App\Models\Statusrosak;
use App\Models\Tetapan;
use App\Models\Hmlupus;
use App\Models\Abr;
use App\Models\Abrrosak;
use App\Models\Abrlupus;
use App\Models\Asetalih;
use App\Models\Atarosak;
use App\Models\Strrosak;

use Illuminate\Http\Request;
use Arcanedev\LogViewer\Entities\Log;
use PDF;

use App\Exports\HmrosakExport;
use App\Exports\AtarosakExport;
use App\Exports\AbrrosakExport;
use App\Exports\StrrosakExport;
/* use Maatwebsite\Excel\Facades\Excel; */
use Excel;

/**
 * Class AduanController.
 */
class AduanController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function aduanhm(Hartamodal $hartamodal)
    {
        return view('frontend.pages.aduanhartamodal')
            ->withHartamodal($hartamodal)
            ->withBangunan(Bangunan::all())
            ->withLokasi(Lokasi::all());
        
    }

    

    public function index(Request $request)
    {
        
        /* $nokp = $request->nokp;

        $pelapor = Kakitangan::query()->where('nokp', $nokp)->get(); */

        if (!empty($request->term)) {
            $term = $request->term;

            $query = Hartamodal::with('bangunan')
                ->where('status_alat_id', '<', 5)->where('no_siri_pendaftaran', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('jenama', 'like', '%' . $term . '%')
                ->orwhereHas('bangunan', function ($q) use ($term) {
                    $q->where('nama_bangunan', 'like', '%' . $term . '%')->orWhere('kod_bangunan', $term );
                })
                ->where('status_alat_id', '<', 5)->orWhereHas('lokasi', function ($q) use ($term) {
                    $q->where('nama_lokasi', 'like', '%' . $term . '%')->orWhere('kod_lokasi', 'like', '%' . $term . '%');
                })
                ->where('status_alat_id', '<', 5)->orWhereHas('status_alat', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Hartamodal::query()->where('status_alat_id', '<', 5);

        }
                
        $hartamodals = $query->orderBy('id','ASC')->paginate(25);

        /* dd($lokasi); */

        return view('frontend.pages.aduanhm1')
            ->with('hartamodals', $hartamodals)
            ->with('i', (request()->input('page', 1) - 1) * 25);
        
    }

    public function store(Request $request)
    {
        if($this->check_idpelapor($request->nokp) > 0){
            
        }else{
            return redirect()->back()->withFlashDanger(__('Pelapor tidak wujud! Pastikan No. KP yang dimasukkan adalah betul.'));
        }
        
        if($this->check_hmrosak($request->harta_modal_id) > 0){
            return redirect()->back()->withFlashDanger(__('Aduan kerosakan telah wujud'));
        }

        if ($request->hasFile('pic_1')) {

            $request->validate([
                'pic_1' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->pic_1->store('HM', 'public');
        }

        if ($request->hasFile('pic_2')) {

            $request->validate([
                'pic_2' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->pic_2->store('HM', 'public');
        }

        if ($request->hasFile('pic_3')) {

            $request->validate([
                'pic_3' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->pic_3->store('HM', 'public');
        }

        $kakitangan = Kakitangan::where('nokp',$request->nokp)->first();

        /* dd($kakitangan); */
        
        $hmrosak = new Hmrosak();
        $hmrosak->harta_modal_id = $request->harta_modal_id;
        $hmrosak->penguna_akhir = $request->penguna_akhir;
        $hmrosak->tarikh_rosak = $request->tarikh_rosak;
        $hmrosak->prihal_rosak = $request->prihal_rosak;
        $hmrosak->status = 0;
        $hmrosak->user_id = $kakitangan->id;
        $hmrosak->pic_1 = $request->pic_1->hashName();

        if (!empty($request->pic_2)) {
            $hmrosak->pic_2 = $request->pic_2->hashName();
        }
        if (!empty($request->pic_3)) {
            $hmrosak->pic_3 = $request->pic_3->hashName();
        }
        
        
        
        /* $hmrosak->user_id = Auth::user()->id;; */

        if($hmrosak->save()){
            return redirect()->route('frontend.pages.aduanhm1')
            ->withFlashSuccess(__('Aduan kerosakan telah berjaya disimpan.'));
        }
        else{
            return redirect()->back()->withFlashDanger(__('Aduan kerosakan gagal disimpan'));
        }
    }

    public function check_idpelapor($nokp){
        return Kakitangan::where('nokp',$nokp)
            ->count();
    }
    public function check_hmrosak($harta_modal_id){
        return Hmrosak::where('harta_modal_id',$harta_modal_id)
            ->where('status','<',5)
            ->count();
    }

    public function index_list_aduan(Request $request)
    {
        
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Hmrosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','<',7)->orwhereHas('hartamodal', function ($q) use ($term) {
                    $q->where('no_siri_pendaftaran', 'like', '%' . $term . '%')
                    ->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('jenama', 'like', '%' . $term . '%');
                })
                ->where('status','<',7)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Hmrosak::query()->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC');
        }

        $hmrosaks = $query->orderBy('status','ASC')->orderBy('id','ASC')->paginate(25);

        return view('frontend.user.list_aduanhm')
            ->with('hmrosaks', $hmrosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
        
    }

    public function show(Hmrosak $hmrosak)
    {
            
        return view('frontend.user.showhmrosak')
            ->withHmrosak($hmrosak)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::where('team_1',1)->get())
            ->withLokasi(Lokasi::all());

    }

    public function index_selesai(Request $request)
    {
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Hmrosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','>', 6)->orWhereHas('hartamodal', function ($q) use ($term) {
                    $q->where('no_siri_pendaftaran', 'like', '%' . $term . '%')
                    ->orWhere('jenis', 'like', '%' . $term . '%')
                    ->orWhere('jenama', 'like', '%' . $term . '%');
                })
                ->where('status','>', 6)->orWhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                })
                ->where('status','>',6)->orwhereHas('statusrosak', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%')->where('id','>',3);
                });
                
        } else {
            
            $query = Hmrosak::query()->where('status','>', 6)->orderBy('tarikh_tindakan','DESC');
        }

        $hmrosaks = $query->orderBy('tarikh_tindakan','DESC')->paginate(25);

        return view('frontend.user.hmrosak_selesai')
            ->with('hmrosaks', $hmrosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function show_selesai(Hmrosak $hmrosak)
    {
        return view('frontend.user.showhmrosak_selesai')
            ->withHmrosak($hmrosak)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::where('team_1',1)->get())
            ->withLokasi(Lokasi::all());

    }

    public function createPDF(Hmrosak $hmrosak) 
    {
        $pdf = PDF::loadView('frontend.user.pdfhmrosak', compact('hmrosak',))->setPaper('a4', 'portrait');

        return $pdf->download('pdfhmrosak.pdf');
        
    }

    public function index_mohonHM(Request $request)
    {
        
        /* $nokp = $request->nokp;

        $pelapor = Kakitangan::query()->where('nokp', $nokp)->get(); */
        $tetapan = Tetapan::where('id', 1)->first();

        if (!empty($request->term)) {

            $term = $request->term;

            $query = Hartamodal::with('bangunan')
                ->where('status_alat_id', '<', 5)->where('no_siri_pendaftaran', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('jenama', 'like', '%' . $term . '%')
                ->orwhereHas('bangunan', function ($q) use ($term) {
                    $q->where('nama_bangunan', 'like', '%' . $term . '%')->orWhere('kod_bangunan', $term );
                })
                ->where('status_alat_id', '<', 5)->orWhereHas('lokasi', function ($q) use ($term) {
                    $q->where('nama_lokasi', 'like', '%' . $term . '%')->orWhere('kod_lokasi', 'like', '%' . $term . '%');
                })
                ->where('status_alat_id', '<', 5)->orWhereHas('status_alat', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Hartamodal::query()->where('status_alat_id', '<', 5);

        }
                
        $hartamodals = $query->orderBy('id','ASC')->paginate(25);

        /* dd($tetapan); */

        return view('frontend.pages.mohonlupushm')
            ->with('hartamodals', $hartamodals)
            ->with('tetapan',$tetapan)
            ->with('i', (request()->input('page', 1) - 1) * 25);
        
    }

    public function lupushm(Hartamodal $hartamodal)
    {
        return view('frontend.pages.mohonlupushm1')
            ->withHartamodal($hartamodal)
            ->withBangunan(Bangunan::all())
            ->withLokasi(Lokasi::all());
        
    }

    public function storehmlupus(Request $request)
    {
        if($this->check_idpelapor($request->nokp) > 0){
            
        }else{
            return redirect()->back()->withFlashDanger(__('Pemohon tidak wujud! Pastikan No. KP yang dimasukkan adalah betul.'));
        }
        
        if($this->check_hmlupus($request->harta_modal_id) > 0){
            return redirect()->back()->withFlashDanger(__('Pemohonan pelupusan telah wujud'));
        }

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

        $kakitangan = Kakitangan::where('nokp',$request->nokp)->first();
        $tetapan = Tetapan::where('id', 1)->first();

        /* dd($kakitangan); */
        
        $hmlupus = new Hmlupus();
        $hmlupus->harta_modal_id = $request->harta_modal_id;
        $hmlupus->prestasi = $request->prestasi;
        $hmlupus->kod_dulu = $request->kod_dulu;
        $hmlupus->nilai_semasa = $request->nilai_semasa;
        $hmlupus->user_id = $kakitangan->id;
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
            return redirect()->route('frontend.pages.mohonlupushm')
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

    public function index_abr(Request $request)
    {
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Abr::with('bangunan')
                ->where('selenggara','!=',0)->where('status_alat_id', '<', 5)->where('no_siri_daftar', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('butiran', 'like', '%' . $term . '%')
                ->orwhereHas('bangunan', function ($q) use ($term) {
                    $q->where('nama_bangunan', 'like', '%' . $term . '%')->orWhere('kod_bangunan', $term );
                })
                ->where('selenggara','!=',0)->where('status_alat_id', '<', 5)->orWhereHas('lokasi', function ($q) use ($term) {
                    $q->where('nama_lokasi', 'like', '%' . $term . '%')->orWhere('kod_lokasi', 'like', '%' . $term . '%');
                })
                ->where('selenggara','=!',0)->where('status_alat_id', '<', 5)->orWhereHas('status_alat', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Abr::query()->where('selenggara','!=',0)->where('status_alat_id', '<', 5);

        }
                
        $abrs = $query->orderBy('id','ASC')->paginate(25);

        return view('frontend.pages.aduanabr1')
            ->with('abrs', $abrs)
            ->with('i', (request()->input('page', 1) - 1) * 25);
        
    }

    public function aduanabr(Abr $abr)
    {
        return view('frontend.pages.aduanabr')
            ->withAbr($abr)
            ->withBangunan(Bangunan::all())
            ->withLokasi(Lokasi::all());
        
    }

    public function store_abr(Request $request)
    {
        if($this->check_idpelapor($request->nokp) > 0){
            
        }else{
            return redirect()->back()->withFlashDanger(__('Pelapor tidak wujud! Pastikan No. KP yang dimasukkan adalah betul.'));
        }
        
        if($this->check_abrrosak($request->abr_id) > 0){
            return redirect()->back()->withFlashDanger(__('Aduan kerosakan telah wujud'));
        }

        if ($request->hasFile('pic_1')) {

            $request->validate([
                'pic_1' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->pic_1->store('ABR', 'public');
        }

        if ($request->hasFile('pic_2')) {

            $request->validate([
                'pic_2' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->pic_2->store('ABR', 'public');
        }

        if ($request->hasFile('pic_3')) {

            $request->validate([
                'pic_3' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->pic_3->store('ABR', 'public');
        }

        $kakitangan = Kakitangan::where('nokp',$request->nokp)->first();
        
        $abrrosak = new Abrrosak();
        $abrrosak->abr_id = $request->abr_id;
        $abrrosak->penguna_akhir = $request->penguna_akhir;
        $abrrosak->tarikh_rosak = $request->tarikh_rosak;
        $abrrosak->prihal_rosak = $request->prihal_rosak;
        $abrrosak->status = 0;
        $abrrosak->user_id = $kakitangan->id;
        $abrrosak->pic_1 = $request->pic_1->hashName();

        if (!empty($request->pic_2)) {
            $abrrosak->pic_2 = $request->pic_2->hashName();
        }
        if (!empty($request->pic_3)) {
            $abrrosak->pic_3 = $request->pic_3->hashName();
        }

        if($abrrosak->save()){
            return redirect()->route('frontend.pages.aduanabr1')
            ->withFlashSuccess(__('Aduan kerosakan telah berjaya disimpan.'));
        }
        else{
            return redirect()->back()->withFlashDanger(__('Aduan kerosakan gagal disimpan'));
        }
    }

    public function check_abrrosak($abr_id){
        return Abrrosak::where('abr_id',$abr_id)
            ->where('status','<',5)
            ->count();
    }

    public function index_list_aduanabr(Request $request)
    {
        
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Abrrosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','<',7)->orwhereHas('abr', function ($q) use ($term) {
                    $q->where('no_siri_daftar', 'like', '%' . $term . '%')
                    ->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('butiran', 'like', '%' . $term . '%');
                })
                ->where('status','<',7)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Abrrosak::query()->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC');
        }

        $abrrosaks = $query->orderBy('status','ASC')->orderBy('id','ASC')->paginate(25);

        return view('frontend.user.list_aduanabr')
            ->with('abrrosaks', $abrrosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
        
    }

    public function show_abr(Abrrosak $abrrosak)
    {
        return view('frontend.user.showabrrosak')
            ->withAbrrosak($abrrosak)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::where('team_1',1)->get())
            ->withLokasi(Lokasi::all());
    }

    public function createPDF_abr(Abrrosak $abrrosak) 
    {
        $pdf = PDF::loadView('frontend.user.pdfabrrosak', compact('abrrosak',))->setPaper('a4', 'portrait');

        return $pdf->download('pdfabrrosak.pdf');
        
    }

    public function index_abr_selesai(Request $request)
    {
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Abrrosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','>', 6)->orWhereHas('abr', function ($q) use ($term) {
                    $q->where('no_siri_daftar', 'like', '%' . $term . '%')
                    ->orWhere('jenis', 'like', '%' . $term . '%')
                    ->orWhere('butiran', 'like', '%' . $term . '%');
                })
                ->where('status','>', 6)->orWhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                })
                ->where('status','>',6)->orwhereHas('statusrosak', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%')->where('id','>',3);
                });
                
        } else {
            
            $query = Abrrosak::query()->where('status','>', 6)->orderBy('tarikh_tindakan','DESC');
        }

        $abrrosaks = $query->orderBy('tarikh_tindakan','DESC')->paginate(25);

        return view('frontend.user.abrrosak_selesai')
            ->with('abrrosaks', $abrrosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function show_abr_selesai(Abrrosak $abrrosak)
    {
        return view('frontend.user.showabrrosak_selesai')
            ->withAbrrosak($abrrosak)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::where('team_1',1)->get())
            ->withLokasi(Lokasi::all());

    }

    public function index_mohonABR(Request $request)
    {
        $tetapan = Tetapan::where('id', 1)->first();

        if (!empty($request->term)) {

            $term = $request->term;

            $query = Abr::with('bangunan')
                ->where('status_alat_id', '<', 5)->where('no_siri_daftar', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('butiran', 'like', '%' . $term . '%')
                ->orwhereHas('bangunan', function ($q) use ($term) {
                    $q->where('nama_bangunan', 'like', '%' . $term . '%')->orWhere('kod_bangunan', $term );
                })
                ->where('status_alat_id', '<', 5)->orWhereHas('lokasi', function ($q) use ($term) {
                    $q->where('nama_lokasi', 'like', '%' . $term . '%')->orWhere('kod_lokasi', 'like', '%' . $term . '%');
                })
                ->where('status_alat_id', '<', 5)->orWhereHas('status_alat', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Abr::query()->where('status_alat_id', '<', 5);

        }
                
        $abrs = $query->orderBy('id','ASC')->paginate(25);

        /* dd($tetapan); */

        return view('frontend.pages.mohonlupusabr')
            ->with('abrs', $abrs)
            ->with('tetapan',$tetapan)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function lupusabr(Abr $abr)
    {
        return view('frontend.pages.mohonlupusabr1')
            ->withAbr($abr)
            ->withBangunan(Bangunan::all())
            ->withLokasi(Lokasi::all());
        
    }

    public function storeabrlupus(Request $request)
    {
        if($this->check_idpelapor($request->nokp) > 0){
            
        }else{
            return redirect()->back()->withFlashDanger(__('Pemohon tidak wujud! Pastikan No. KP yang dimasukkan adalah betul.'));
        }
        
        if($this->check_abrlupus($request->abr_id) > 0){
            return redirect()->back()->withFlashDanger(__('Pemohonan pelupusan telah wujud'));
        }

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

        $kakitangan = Kakitangan::where('nokp',$request->nokp)->first();
        $tetapan = Tetapan::where('id', 1)->first();

        /* dd($kakitangan); */
        
        $abrlupus = new Abrlupus();
        $abrlupus->abr_id = $request->abr_id;
        $abrlupus->prestasi = $request->prestasi;
        $abrlupus->kod_dulu = $request->kod_dulu;
        $abrlupus->nilai_semasa = $request->nilai_semasa;
        $abrlupus->user_id = $kakitangan->id;
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
            return redirect()->route('frontend.pages.mohonlupusabr')
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

    public function export() 
    {
        return Excel::download(new HmrosakExport, 'hmrosak.xlsx');
    }

    public function export_abr() 
    {
        return Excel::download(new AbrrosakExport, 'abrrosak.xlsx');
    }

    public function index_ata(Request $request)
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

        return view('frontend.pages.aduanata1')
            ->with('tajuk_bangunan', $tajuk_bangunan)
            ->with('aras', $aras)
            ->with('bangunans', $bangunans)
            ->with('lokasis', $lokasis)
            ->with('bil_DA', $bil_DA)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function show_aduanata(Lokasi $lokasi)
    {
        $lokasi = Lokasi::where('id', $lokasi->id)->get()->first();
            
        $query = Asetalih::where('lokasi_bangunans_id', $lokasi->id);
                
        $asetalihs = $query->orderBy('id','ASC')->paginate(25);

        return view('frontend.pages.aduanata2')
            ->with('lokasi', $lokasi)
            ->with('asetalihs', $asetalihs)
            ->with('i', (request()->input('page', 1) - 1) * 25);

    }

    public function aduan_ata(Asetalih $asetalih)
    {

        return view('frontend.pages.aduan_ata')
            ->withAsetalih($asetalih)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::all())
            /* ->with('status_alat',$status_alat) */
            ->withLokasi(Lokasi::all());
    }

    public function store_atarosak(Request $request)
    {
        if($this->check_idpelapor($request->nokp) > 0){
            
        }else{
            return redirect()->back()->withFlashDanger(__('Pelapor tidak wujud! Pastikan No. KP yang dimasukkan adalah betul.'));
        }
        
        if($this->check_atarosak($request->asetalih_id) > 0){
            return redirect()->back()->withFlashDanger(__('Aduan kerosakan telah wujud'));
        }

        if ($request->hasFile('pic_1')) {

            $request->validate([
                'pic_1' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /HM
            $request->pic_1->store('ATA_ROSAK', 'public');
        }

        if ($request->hasFile('pic_2')) {

            $request->validate([
                'pic_2' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /HM
            $request->pic_2->store('ATA_ROSAK', 'public');
        }

        if ($request->hasFile('pic_3')) {

            $request->validate([
                'pic_3' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /HM
            $request->pic_3->store('ATA_ROSAK', 'public');
        }

        $kakitangan = Kakitangan::where('nokp',$request->nokp)->first();
        
        $atarosak = new Atarosak();
        $atarosak->asetalih_id = $request->asetalih_id;
        $atarosak->skop = $request->skop;
        $atarosak->keutamaan = $request->keutamaan;
        $atarosak->prihal_rosak = $request->prihal_rosak;
        $atarosak->status = 0;
        $atarosak->user_id = $kakitangan->id;
        $atarosak->bahagian = $request->bahagian;

        $atarosak->pic_1 = $request->pic_1->hashName();

        if (!empty($request->no_tel)) {
            $atarosak->no_tel = $request->no_tel;
        }

        if (!empty($request->pic_2)) {
            $atarosak->pic_2 = $request->pic_2->hashName();
        }
        if (!empty($request->pic_3)) {
            $atarosak->pic_3 = $request->pic_3->hashName();
        }

        if($atarosak->save()){
            return redirect()->route('frontend.pages.aduanata1')
            ->withFlashSuccess(__('Aduan kerosakan komponen telah berjaya disimpan.'));
        }
        else{
            return redirect()->back()->withFlashDanger(__('Aduan kerosakan komponen gagal disimpan'));
        }
    }

    public function check_atarosak($asetalih_id){
        return Atarosak::where('asetalih_id',$asetalih_id)
            ->where('status','<',7)
            ->count();
    }

    public function index_list_aduan_ata(Request $request)
    {
        
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Atarosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','<',7)->orwhereHas('asetalih', function ($q) use ($term) {
                    $q->where('nama_komponen', 'like', '%' . $term . '%')->orWhere('nama_kej', 'like', '%' . $term . '%')->orWhere('diskripsi', 'like', '%' . $term . '%');
                })
                ->where('status','<',7)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                });                
        } else {
            
            $query = Atarosak::query()->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC');
        }

        $atarosaks = $query->orderBy('status','ASC')->orderBy('id','ASC')->paginate(25);

        return view('frontend.user.list_aduanata')
            ->with('atarosaks', $atarosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
        
    }

    public function show_ata(Atarosak $atarosak)
    {
        return view('frontend.user.showatarosak')
            ->withAtarosak($atarosak)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::where('team_1',1)->get())
            ->withStatusrosak(Statusrosak::where('id','>',6)->where('id','<',10)->get())
            ->withLokasi(Lokasi::all());

    }

    public function createPDF_ata(Atarosak $atarosak) 
    {
        $pdf = PDF::loadView('frontend.user.pdfatarosak', compact('atarosak',))->setPaper('a4', 'portrait');

        return $pdf->download('pdfatarosak.pdf');
        
    }

    public function index_ata_selesai(Request $request)
    {
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Atarosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','>',6)->orwhereHas('asetalih', function ($q) use ($term) {
                    $q->where('nama_komponen', 'like', '%' . $term . '%')->orWhere('nama_kej', 'like', '%' . $term . '%')->orWhere('diskripsi', 'like', '%' . $term . '%');
                })
                ->where('status','>',6)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                })
                ->where('status','>',6)->orwhereHas('statusrosak', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%')->where('id','>',3);
                });
                
        } else {
            
            $query = Atarosak::query()->where('status','>',6)->orderBy('tarikh_siap','DESC');
        }

        $atarosaks = $query->orderBy('tarikh_siap','DESC')->paginate(25);

        return view('frontend.user.atarosak_selesai')
            ->with('atarosaks', $atarosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function export_ata() 
    {
        return Excel::download(new AtarosakExport, 'atarosak.xlsx');
    }

    /* Aduan Struktur */

    public function aduan_ata_str(Lokasi $lokasi, Asetalih $asetalih)
    {
        
        $lokasi = Lokasi::where('id', $lokasi->id)->get()->first();
            
        $query = Asetalih::where('lokasi_bangunans_id', $lokasi->id);
                
        $asetalihs = $query->orderBy('id','ASC')->paginate(25);

        return view('frontend.pages.aduan_ata_str')
            ->with('lokasi', $lokasi)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::all())
            /* ->with('asetalihs', $asetalihs) */
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function store_strrosak(Request $request)
    {
        if($this->check_idpelapor($request->nokp) > 0){
            
        }else{
            return redirect()->back()->withFlashDanger(__('Pelapor tidak wujud! Pastikan No. KP yang dimasukkan adalah betul.'));
        }
        
        if($this->check_strrosak($request->lokasi_id) > 0){
            return redirect()->back()->withFlashDanger(__('Aduan kerosakan telah wujud'));
        }

        if ($request->hasFile('pic_1')) {

            $request->validate([
                'pic_1' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /HM
            $request->pic_1->store('ATA_ROSAK', 'public');
        }

        if ($request->hasFile('pic_2')) {

            $request->validate([
                'pic_2' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /HM
            $request->pic_2->store('ATA_ROSAK', 'public');
        }

        if ($request->hasFile('pic_3')) {

            $request->validate([
                'pic_3' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /HM
            $request->pic_3->store('ATA_ROSAK', 'public');
        }

        $kakitangan = Kakitangan::where('nokp',$request->nokp)->first();
        
        $strrosak = new Strrosak();
        $strrosak->lokasi_id = $request->lokasi_id;
        $strrosak->nama_kekemasan = $request->nama_kekemasan;
        $strrosak->skop = $request->skop;
        $strrosak->keutamaan = $request->keutamaan;
        $strrosak->prihal_rosak = $request->prihal_rosak;
        $strrosak->status = 0;
        $strrosak->user_id = $kakitangan->id;
        $strrosak->bahagian = $request->bahagian;

        $strrosak->pic_1 = $request->pic_1->hashName();

        if (!empty($request->no_tel)) {
            $strrosak->no_tel = $request->no_tel;
        }

        if (!empty($request->pic_2)) {
            $strrosak->pic_2 = $request->pic_2->hashName();
        }
        if (!empty($request->pic_3)) {
            $strrosak->pic_3 = $request->pic_3->hashName();
        }

        if($strrosak->save()){
            return redirect()->route('frontend.pages.aduanata1')
            ->withFlashSuccess(__('Aduan kerosakan komponen telah berjaya disimpan.'));
        }
        else{
            return redirect()->back()->withFlashDanger(__('Aduan kerosakan komponen gagal disimpan'));
        }
    }

    public function check_strrosak($lokasi_id){
        return Strrosak::where('lokasi_id',$lokasi_id)
            ->where('status','<',7)
            ->count();
    }

    public function index_list_aduan_str(Request $request)
    {
        
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Strrosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','<',7)
                ->where('status','<',7)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                });                
        } else {
            
            $query = Strrosak::query()->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC');
        }

        $strrosaks = $query->orderBy('status','ASC')->orderBy('id','ASC')->paginate(25);

        return view('frontend.user.list_aduanstr')
            ->with('strrosaks', $strrosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
        
    }

    public function show_str(Strrosak $strrosak)
    {
        return view('frontend.user.showstrrosak')
            ->withStrrosak($strrosak)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::where('team_1',1)->get())
            ->withStatusrosak(Statusrosak::where('id','>',6)->where('id','<',10)->get())
            ->withLokasi(Lokasi::all());

    }

    public function createPDF_str(Strrosak $strrosak) 
    {
        $pdf = PDF::loadView('frontend.user.pdfstrrosak', compact('strrosak',))->setPaper('a4', 'portrait');

        return $pdf->download('pdfstrrosak.pdf');
        
    }

    public function index_str_selesai(Request $request)
    {
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Strrosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','>',6)
                ->where('status','>',6)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                })
                ->where('status','>',6)->orwhereHas('statusrosak', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%')->where('id','>',3);
                });
                
        } else {
            
            $query = Strrosak::query()->where('status','>',6)->orderBy('tarikh_siap','DESC');
        }

        $strrosaks = $query->orderBy('tarikh_siap','DESC')->paginate(25);

        return view('frontend.user.strrosak_selesai')
            ->with('strrosaks', $strrosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function export_str() 
    {
        return Excel::download(new StrrosakExport, 'strrosak.xlsx');
    }

    public function index_bangunan() 
    {
        return view('frontend.pages.lokasibangunan');
    }

    public function index_list_lupushm(Request $request)
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

        return view('frontend.user.list_lupushm')
            ->with('tetapan',$tetapan)
            ->with('hmlupuss', $hmlupuss)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function showlupushm(Hmlupus $hmlupus)
    {
        return view('frontend.user.showlupushm')
            ->withHmlupus($hmlupus)
            ->withBangunan(Bangunan::all())
            ->withLokasi(Lokasi::all());
    }

    public function index_list_lupusabr(Request $request)
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

        return view('frontend.user.list_lupusabr')
            ->with('tetapan',$tetapan)
            ->with('abrlupuss', $abrlupuss)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function showlupusabr(Abrlupus $abrlupus)
    {
        return view('frontend.user.showlupusabr')
            ->withAbrlupus($abrlupus)
            ->withBangunan(Bangunan::all())
            ->withLokasi(Lokasi::all());
    }


}
