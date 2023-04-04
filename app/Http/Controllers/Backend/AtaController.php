<?php

namespace App\Http\Controllers\Backend;

use App\Models\Ata;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AtaController extends Controller
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

            $query = Ata::where('per_1', 'like', '%' . $term . '%')
                ->orWhere('per_2', 'like', '%' . $term . '%')
                ->orWhere('per_3', 'like', '%' . $term . '%')
                ->orWhere('per_4', 'like', '%' . $term . '%')
                ->orWhere('per_5', 'like', '%' . $term . '%')
                ->orWhere('per_6', 'like', '%' . $term . '%')
                ->orWhere('per_7', 'like', '%' . $term . '%');
                
        } else {
            
            $query = Ata::query();
        }
        
                
        $atas = $query->orderBy('id','ASC')->paginate(25);

        return view('backend.ata', compact('atas'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function enableata(Ata $ata)
    {
        $aktif = 1;
        /* dd($ata->id); */
        Ata::where('id', $ata->id)->update(['aktif' => $aktif]);
        return redirect()->route('admin.ata',[$ata,'term'=>request('term') ?? null])->withFlashSuccess(__('Kod Komponen berjaya dikemaskini.'));

    }

    public function disableata(Ata $ata)
    {
        $aktif = 0;
        /* dd($ata->id); */
        Ata::where('id', $ata->id)->update(['aktif' => $aktif]);
        return redirect()->route('admin.ata',[$ata,'term'=>request('term') ?? null])->withFlashSuccess(__('Kod Komponen berjaya dikemaskini.'));

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
     * @param  \App\Models\Ata  $ata
     * @return \Illuminate\Http\Response
     */
    public function show(Ata $ata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ata  $ata
     * @return \Illuminate\Http\Response
     */
    public function edit(Ata $ata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ata  $ata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ata $ata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ata  $ata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ata $ata)
    {
        //
    }
}
