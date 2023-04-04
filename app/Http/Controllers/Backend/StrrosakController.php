<?php

namespace App\Http\Controllers\Backend;

use App\Models\Strrosak;
use App\Models\Asetalih;
use App\Models\Lokasi;
use App\Models\Bangunan;
use App\Models\Kakitangan;
use App\Models\Statusrosak;
use App\Models\Tetapan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\Auth\Models\User;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DB;
use PDF;

use App\Exports\StrrosakExport;
/* use Maatwebsite\Excel\Facades\Excel; */
use Excel;

use Auth;

class StrrosakController extends Controller
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

            $query = Strrosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','<',7)
                ->where('status','<',7)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                })
                ->where('status','<',7)->orwhereHas('statusrosak', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Strrosak::query()->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC');
        }

        $strrosaks = $query->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC')->paginate(25);
        
        return view('backend.strrosak')
            ->with('strrosaks', $strrosaks)
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
        
        $strrosak = new Strrosak();
        $strrosak->lokasi_id = $request->lokasi_id;
        $strrosak->nama_kekemasan = $request->nama_kekemasan;
        $strrosak->skop = $request->skop;
        $strrosak->keutamaan = $request->keutamaan;
        $strrosak->prihal_rosak = $request->prihal_rosak;
        $strrosak->status = 0;
        $strrosak->user_id = $request->user_id;
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
            return redirect()->route('admin.strrosak')
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Strrosak  $hmrosak
     * @return \Illuminate\Http\Response
     */
    public function show(Strrosak $strrosak)
    {
        return view('backend.showstrrosak')
            ->withStrrosak($strrosak)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::where('team_1',1)->get())
            ->withLokasi(Lokasi::all());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Strrosak  $strrosak
     * @return \Illuminate\Http\Response
     */
    public function edit(Strrosak $strrosak)
    {
        return view('backend.editstrrosak')
            ->withStrrosak($strrosak)
            ->withBangunan(Bangunan::all())
            ->withStatusrosak(Statusrosak::where('id','>',1)->where('id','!=',4)->where('id','!=',5)->where('id','!=',7)->where('id','!=',8)->where('id','!=',9)->get())
            ->withLokasi(Lokasi::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Strrosak  $strrosak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Strrosak $strrosak)
    {
        $updateData = $request->validate([
            'user_siasat' => 'required',
            'jenis_kerja' => 'required',
            'ulas_siasat' => 'required'
        ]);

        $date = date('Y-m-d');
        
        $strrosak->update(['user_siasat' => $request->user_siasat,
            'status' => 1,
            'user_terima' => Auth::user()->id,
            'tarikh_terima' => $date,
            'tarikh_siasat' => $date,
            'jenis_kerja' => $request->jenis_kerja,
            'ulas_siasat' => $request->ulas_siasat
            ]);

        return redirect()->route('admin.strrosak',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan ATA berjaya dikemaskini.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Strrosak  $strrosak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atarosak $atarosak)
    {
        //
    }

    public function index_tindakan(Request $request)
    {
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Strrosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','>',0)->where('status','<',7)
                ->where('status','>',0)->where('status','<',7)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Strrosak::query()->where('status','>',0)->where('status','<',7)->orderBy('status','ASC')->orderBy('tarikh_siasat','DESC');
        }

        $strrosaks = $query->orderBy('status','ASC')->orderBy('tarikh_siasat','DESC')->paginate(25);

        return view('backend.strrosaktin')
            ->with('strrosaks', $strrosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function update_tindakan(Request $request, Strrosak $strrosak)
    {
        $updateData = $request->validate([
            /* 'jenis_kerja' => 'required',
            'ulas_siasat' => 'required', */
            'status' => 'required'
        ]);

        $date = date('Y-m-d');
        
        $strrosak->update([/* 'jenis_kerja' => $request->jenis_kerja, */
            'kos_dulu' => $request->kos_dulu,
            /* 'ulas_siasat' => $request->ulas_siasat, */
            'status' => $request->status,
            'jenis_1' => $request->jenis_1,
            'harga_1' => $request->harga_1,
            'kuantiti_1' => $request->kuantiti_1,
            'jumlah_1' => $request->jumlah_1,
            'jenis_2' => $request->jenis_2,
            'harga_2' => $request->harga_2,
            'kuantiti_2' => $request->kuantiti_2,
            'jumlah_2' => $request->jumlah_2,
            'jenis_3' => $request->jenis_3,
            'harga_3' => $request->harga_3,
            'kuantiti_3' => $request->kuantiti_3,
            'jumlah_3' => $request->jumlah_3,
            'perihal_kerja' => $request->perihal_kerja,
            'tarikh_mula' => $date
            ]);

        return redirect()->route('admin.strrosaktin',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan berjaya dikemaskini.'));
    }

    public function index_selesai(Request $request)
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

        return view('backend.strrosak_selesai')
            ->with('strrosaks', $strrosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function show_selesai(Strrosak $strrosak)
    {
        return view('backend.showstrrosak_selesai')
            ->withStrrosak($strrosak)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::where('team_1',1)->get())
            ->withLokasi(Lokasi::all());

    }

    public function createPDF(Strrosak $strrosak) 
    {
        $pdf = PDF::loadView('backend.pdfstrrosak', compact('strrosak',))->setPaper('a4', 'portrait');

        return $pdf->download('pdfstrrosak.pdf');
        
    }

    
    public function syor(Strrosak $strrosak)
    {
        return view('backend.syorstrrosak')
            ->withStrrosak($strrosak)
            ->withBangunan(Bangunan::all())
            ->withStatusrosak(Statusrosak::where('id','>',3)->where('id','<',6)->get())
            ->withLokasi(Lokasi::all());
    }

    public function updatesyor(Request $request, Strrosak $strrosak)
    {
        $updateData = $request->validate([
            'status' => 'required',
            'tahun' => 'required'
        ]);

        $date = date('Y-m-d');
        
        $strrosak->update([
            'status' => $request->status,
            'tahun' => $request->tahun
            ]);

        return redirect()->route('admin.strrosak',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan berjaya dikemaskini.'));
    }

    public function syor2(Strrosak $strrosak)
    {
        return view('backend.syor2strrosak')
            ->withStrrosak($strrosak)
            ->withBangunan(Bangunan::all())
            ->withStatusrosak(Statusrosak::where('id','>',6)->where('id','<',10)->get())
            ->withLokasi(Lokasi::all());
    }

    public function updatesyor2(Request $request, Strrosak $strrosak)
    {
        $updateData = $request->validate([
            'status' => 'required'
        ]);

        $date = date('Y-m-d');
        
        $strrosak->update(['status' => $request->status,
            'tarikh_siap' => $date
            ]);

        return redirect()->route('admin.strrosak',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan berjaya dikemaskini.'));
    }

    

    public function export() 
    {
        return Excel::download(new StrrosakExport, 'strrosak.xlsx');
    }

    public function index_bangunan() 
    {
        return view('backend.lokasibangunan');
    }
}
