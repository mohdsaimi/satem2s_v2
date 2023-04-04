<?php

namespace App\Http\Controllers\Backend;

use App\Models\Lokasi;
use App\Models\Bangunan;
use App\Models\Kakitangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LokasiController extends Controller
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

            $query = Lokasi::with('bangunan')->whereHas('bangunan', function ($q) use ($term) {
                $q->where('nama_bangunan', 'like', '%' . $term . '%')->orWhere('kod_bangunan', $term );
            })
                ->orWhereHas('bangunan', function ($q) use ($term) {
                    $q->where('nama_lokasi', 'like', '%' . $term . '%')->orWhere('kod_lokasi', 'like', '%' . $term . '%');
                });

        } else {
            
            $query = Lokasi::query();
        }
        
        $lokasis = $query->orderBy('id','ASC')->paginate(25);

        /* dd($lokasi); */

        return view('backend.lokasi')
            ->with('lokasis', $lokasis)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* $bangunans = Bangunan::all()->pluck('id', 'id')->prepend(trans('Sila Pilih'), ''); */
        $bangunans = Bangunan::query()->get();
        $kakitangans = Kakitangan::query()->get();
        
        /* dd($bangunan); */
        return view('backend.createlokasi')
            ->with('bangunan', $bangunans)
            ->with('kakitangans', $kakitangans);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->check_lokasi($request->bangunan_id, $request->aras, $request->kod_lokasi) > 0){
            return redirect()->back()->withFlashDanger(__('Lokasi telah wujud'));
        }

        $lokasis = new Lokasi();
        $lokasis->bangunan_id = $request->bangunan_id;
        $lokasis->aras = $request->aras;
        $lokasis->kod_lokasi = $request->kod_lokasi;
        $lokasis->nama_lokasi = $request->nama_lokasi;
        $lokasis->nama_1 = $request->nama_1;
        $lokasis->nama_2 = $request->nama_2;
        $lokasis->catatan = $request->catatan;
        $lokasis->selangar_struktur = $request->selangar_struktur;

        if($lokasis->save()){
            return redirect()->route('admin.lokasi')
            ->withFlashSuccess(__('Lokasi telah berjaya disimpan.'));
        }
        else{
            return redirect()->back()->withFlashDanger(__('Lokasi gagal disimpan'));
        }
    }

    public function check_lokasi($bangunan_id, $aras, $kod_lokasi){
        return Lokasi::where('bangunan_id',$bangunan_id)
            ->where('aras',$aras)
            ->where('kod_lokasi',$kod_lokasi)
            ->count();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Lokasi $lokasis)
    {
        $kakitangans = Kakitangan::query()->get();
        
        return view('backend.editlokasi')
            ->withLokasi($lokasis)
            ->withBangunan(Bangunan::all())
            ->with('kakitangans', $kakitangans);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lokasi $lokasis)
    {
        $updateData = $request->validate([
            'bangunan_id' => 'required',
            'aras' => 'required',
            'kod_lokasi' => 'required',
            'nama_lokasi' => 'required'
        ]);

        $lokasis->update($request->all());

        return redirect()->route('admin.lokasi', ['term' => request('term')])->withFlashSuccess(__('Lokasi berjaya dikemaskini.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lokasi $lokasis)
    {
        $lokasis->delete();

        return redirect()->route('admin.lokasi', ['term' => request('term')])->withFlashSuccess(__('Lokasi berjaya dipadam.'));
    }
}
