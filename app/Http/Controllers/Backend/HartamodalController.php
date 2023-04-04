<?php

namespace App\Http\Controllers\Backend;

use App\Models\Hartamodal;
use App\Models\Lokasi;
use App\Models\Bangunan;
use App\Models\Status_alat;
use App\Models\Kakitangan;
use App\Models\Tetapan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class HartamodalController extends Controller
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

            $query = Hartamodal::with('bangunan')
                ->where('no_siri_pendaftaran', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('jenama', 'like', '%' . $term . '%')
                ->orwhereHas('bangunan', function ($q) use ($term) {
                    $q->where('nama_bangunan', 'like', '%' . $term . '%')->orWhere('kod_bangunan', $term );
                })
                ->orWhereHas('lokasi', function ($q) use ($term) {
                    $q->where('nama_lokasi', 'like', '%' . $term . '%')->orWhere('kod_lokasi', 'like', '%' . $term . '%');
                })
                ->orWhereHas('status_alat', function ($q) use ($term) {
                    $q->where('nama_status', 'like', '%' . $term . '%');
                });
                
        } else {
            
            $query = Hartamodal::query();
        }
                
        $hartamodals = $query->orderBy('id','ASC')->paginate(25);

        /* dd($lokasi); */

        return view('backend.hartamodal')
            ->with('hartamodals', $hartamodals)
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hartamodal  $hartamodal
     * @return \Illuminate\Http\Response
     */
    public function show(Hartamodal $hartamodal)
    {
        return view('backend.showhartamodal')
            ->withHartamodal($hartamodal)
            ->withBangunan(Bangunan::all())
            /* ->with('status_alat',$status_alat) */
            ->withLokasi(Lokasi::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hartamodal  $hartamodal
     * @return \Illuminate\Http\Response
     */
    public function edit(Hartamodal $hartamodal)
    {
        //$status_alat = Status_alat::all();
        $status_alat = Status_alat::where('id', '!=', 5)->get();

        /* dd($aras1); */

        return view('backend.edithartamodal')
            ->withHartamodal($hartamodal)
            ->withBangunan(Bangunan::all())
            ->with('status_alat',$status_alat)
            ->withLokasi(Lokasi::all());
    }

    public function aduan(Hartamodal $hartamodal)
    {
        $status_alat = Status_alat::all();

        /* dd($aras1); */

        return view('backend.aduanhartamodal')
            ->withHartamodal($hartamodal)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::all())
            ->with('status_alat',$status_alat)
            ->withLokasi(Lokasi::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hartamodal  $hartamodal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hartamodal $hartamodal)
    {
        $updateData = $request->validate([
            'status_alat_id' => 'required'
            /* 'aras' => 'required',
            'kod_lokasi' => 'required',
            'bangunan_id' => 'required' */
        ]);

        $hartamodal->update($request->all());

        return redirect()->route('admin.hartamodal', ['term' => request('term')])->withFlashSuccess(__('Harta Modal berjaya dikemaskini.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hartamodal  $hartamodal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hartamodal $hartamodal)
    {
        //
    }

    public function bppa()
    {
        $tetapan = Tetapan::where('id', 1)->first();
        /* $tetapan = Tetapan::all(); */

        /* dd($tetapan); */
        return view('backend.bppa')
            /* ->withTetapan(Tetapan::where('id', 1)->get()); */
            ->with('tetapan',$tetapan);
    }

    public function update_tetapan(Request $request)
    {
        $mohon_lupus = $request->mohon_lupus;
        $tahun_lupus = $request->tahun_lupus;

        /* dd($mohon_lupus); */

            tetapan::where('id', 1)->update(['tetapan_bppa' => $mohon_lupus, 'tahun_lupus' => $tahun_lupus]);
            return redirect()->route('admin.bppa')->withFlashSuccess(__('Tetapan berjaya dikemaskini.'));
        
    }
}
