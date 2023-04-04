<?php

namespace App\Http\Controllers\Backend;

use App\Models\Abr;
use App\Models\Lokasi;
use App\Models\Bangunan;
use App\Models\Status_alat;
use App\Models\Kakitangan;
use App\Models\Tetapan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class AbrController extends Controller
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

            $query = Abr::with('bangunan')
                ->where('no_siri_daftar', 'like', '%' . $term . '%')->orWhere('jenis', 'like', '%' . $term . '%')->orWhere('butiran', 'like', '%' . $term . '%')
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
            
            $query = Abr::query();
        }
                
        $abrs = $query->orderBy('id','ASC')->paginate(25);

        return view('backend.abr')
            ->with('abrs', $abrs)
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
     * @param  \App\Models\Abr  $abr
     * @return \Illuminate\Http\Response
     */
    public function show(Abr $abr)
    {
        return view('backend.showabr')
            ->withAbr($abr)
            ->withBangunan(Bangunan::all())
            ->withLokasi(Lokasi::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Abr  $abr
     * @return \Illuminate\Http\Response
     */
    public function edit(Abr $abr)
    {
        $status_alat = Status_alat::where('id', '!=', 5)->get();

        /* dd($aras1); */

        return view('backend.editabr')
            ->withAbr($abr)
            ->withBangunan(Bangunan::all())
            ->with('status_alat',$status_alat)
            ->withLokasi(Lokasi::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Abr  $abr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Abr $abr)
    {
        $updateData = $request->validate([
            'status_alat_id' => 'required',
            'selenggara' => 'required'
        ]);

        $abr->update($request->all());

        return redirect()->route('admin.abr', ['term' => request('term')])->withFlashSuccess(__('Aset Bernilai Rendah berjaya dikemaskini.'));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Abr  $abr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Abr $abr)
    {
        //
    }

    public function aduan(Abr $abr)
    {
        $status_alat = Status_alat::all();

        /* dd($aras1); */

        return view('backend.aduanabr')
            ->withAbr($abr)
            ->withBangunan(Bangunan::all())
            ->withKakitangan(Kakitangan::all())
            ->with('status_alat',$status_alat)
            ->withLokasi(Lokasi::all());
    }
}
