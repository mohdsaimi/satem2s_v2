<?php

namespace App\Http\Controllers\Backend;

use App\Models\Atarosak;
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

use App\Exports\AtarosakExport;
/* use Maatwebsite\Excel\Facades\Excel; */
use Excel;

use Auth;

class AtarosakController extends Controller
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

            $query = Atarosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','<',7)->orwhereHas('asetalih', function ($q) use ($term) {
                    $q->where('nama_komponen', 'like', '%' . $term . '%')->orWhere('nama_kej', 'like', '%' . $term . '%')->orWhere('diskripsi', 'like', '%' . $term . '%');
                })
                ->where('status','<',7)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                })
                ->where('status','<',7)->orwhereHas('statusrosak', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Atarosak::query()->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC');
        }

        $atarosaks = $query->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC')->paginate(25);
        
        return view('backend.atarosak')
            ->with('atarosaks', $atarosaks)
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
        
        $atarosak = new Atarosak();
        $atarosak->asetalih_id = $request->asetalih_id;
        $atarosak->skop = $request->skop;
        $atarosak->keutamaan = $request->keutamaan;
        $atarosak->prihal_rosak = $request->prihal_rosak;
        $atarosak->status = 0;
        $atarosak->user_id = $request->user_id;
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
            return redirect()->route('admin.atarosak')
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Atarosak  $hmrosak
     * @return \Illuminate\Http\Response
     */
    public function show(Atarosak $atarosak)
    {
        return view('backend.showatarosak')
            ->withAtarosak($atarosak)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::where('team_1',1)->get())
            ->withLokasi(Lokasi::all());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Atarosak  $hmrosak
     * @return \Illuminate\Http\Response
     */
    public function edit(Atarosak $atarosak)
    {
        return view('backend.editatarosak')
            ->withAtarosak($atarosak)
            ->withBangunan(Bangunan::all())
            ->withStatusrosak(Statusrosak::where('id','>',1)->where('id','!=',4)->where('id','!=',5)->where('id','!=',7)->where('id','!=',8)->where('id','!=',9)->get())
            ->withLokasi(Lokasi::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Atarosak  $hmrosak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atarosak $atarosak)
    {
        $updateData = $request->validate([
            'user_siasat' => 'required',
            'jenis_kerja' => 'required',
            'ulas_siasat' => 'required'
        ]);

        $date = date('Y-m-d');
        
        /* $hmrosak->update($request->all()); */
        $atarosak->update(['user_siasat' => $request->user_siasat,
            'status' => 1,
            'user_terima' => Auth::user()->id,
            'tarikh_terima' => $date,
            'tarikh_siasat' => $date,
            'jenis_kerja' => $request->jenis_kerja,
            'ulas_siasat' => $request->ulas_siasat
            ]);

        return redirect()->route('admin.atarosak',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan komponen berjaya dikemaskini.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Atarosak  $hmrosak
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

            $query = Atarosak::where('prihal_rosak', 'like', '%' . $term . '%')
                ->where('status','>',0)->where('status','<',7)->orwhereHas('asetalih', function ($q) use ($term) {
                    $q->where('nama_komponen', 'like', '%' . $term . '%')->orWhere('nama_kej', 'like', '%' . $term . '%')->orWhere('diskripsi', 'like', '%' . $term . '%');
                })
                ->where('status','>',0)->where('status','<',7)->orwhereHas('kakitangan', function ($q) use ($term) {
                    $q->where('nama', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Atarosak::query()->where('status','>',0)->where('status','<',7)->orderBy('status','ASC')->orderBy('tarikh_siasat','DESC');
        }

        $atarosaks = $query->orderBy('status','ASC')->orderBy('tarikh_siasat','DESC')->paginate(25);

        return view('backend.atarosaktin')
            ->with('atarosaks', $atarosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function update_tindakan(Request $request, Atarosak $atarosak)
    {
        $updateData = $request->validate([
            /* 'jenis_kerja' => 'required',
            'ulas_siasat' => 'required', */
            'status' => 'required'
        ]);

        $date = date('Y-m-d');
        
        $atarosak->update([/* 'jenis_kerja' => $request->jenis_kerja, */
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

        return redirect()->route('admin.atarosaktin',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan berjaya dikemaskini.'));
    }

    public function index_selesai(Request $request)
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

        return view('backend.atarosak_selesai')
            ->with('atarosaks', $atarosaks)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function show_selesai(Atarosak $atarosak)
    {
        return view('backend.showatarosak_selesai')
            ->withAtarosak($atarosak)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::where('team_1',1)->get())
            ->withLokasi(Lokasi::all());

    }

    public function createPDF(Atarosak $atarosak) 
    {
        $pdf = PDF::loadView('backend.pdfatarosak', compact('atarosak',))->setPaper('a4', 'portrait');

        return $pdf->download('pdfatarosak.pdf');
        
    }

    
    public function syor(Atarosak $atarosak)
    {
        return view('backend.syoratarosak')
            ->withAtarosak($atarosak)
            ->withBangunan(Bangunan::all())
            ->withStatusrosak(Statusrosak::where('id','>',3)->where('id','<',6)->get())
            ->withLokasi(Lokasi::all());
    }

    public function updatesyor(Request $request, Atarosak $atarosak)
    {
        $updateData = $request->validate([
            'status' => 'required',
            'tahun' => 'required'
        ]);

        $date = date('Y-m-d');
        
        $atarosak->update([
            'status' => $request->status,
            'tahun' => $request->tahun
            /* 'user_syor' => Auth::user()->id */
            ]);

        return redirect()->route('admin.atarosak',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan berjaya dikemaskini.'));
    }

    public function syor2(Atarosak $atarosak)
    {
        return view('backend.syor2atarosak')
            ->withAtarosak($atarosak)
            ->withBangunan(Bangunan::all())
            ->withStatusrosak(Statusrosak::where('id','>',6)->where('id','<',10)->get())
            ->withLokasi(Lokasi::all());
    }

    public function updatesyor2(Request $request, Atarosak $atarosak)
    {
        $updateData = $request->validate([
            'status' => 'required'
        ]);

        $date = date('Y-m-d');
        
        $atarosak->update(['status' => $request->status,
            'tarikh_siap' => $date
            ]);

        return redirect()->route('admin.atarosak',['term' => request('term')])->withFlashSuccess(__('Maklumat aduan berjaya dikemaskini.'));
    }

    

    public function export() 
    {
        return Excel::download(new AtarosakExport, 'atarosak.xlsx');
    }

    
    
}
