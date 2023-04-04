<?php

namespace App\Http\Controllers\Backend;

use App\Models\Courses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $query = Courses::query();
        $course = $query->orderBy('id','ASC')->paginate(25);

        return view('backend.course', compact('course'))
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
        return view('backend.createcourse');
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
        if($this->check_course($request->kod) > 0){
            return redirect()->back()->withFlashDanger(__('Kod kursus telah wujud'));
        }

        $course = new Courses();
        $course->kod = $request->kod;
        $course->nama_kursus = $request->nama_kursus;
        $course->kod_noss = $request->kod_noss;
        $course->nama_noss = $request->nama_noss;

        if($course->save()){
            return redirect()->route('admin.course')
            ->withFlashSuccess(__('Kursus telah berjaya disimpan.'));
        }
        else{
            return redirect()->back()->withFlashDanger(__('Kursus gagal disimpan'));
        }
    }

    public function check_course($kod){
        return Courses::where('kod',$kod)
            ->count();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function show(Courses $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function edit(Courses $course)
    {
        //
        /* return view('backend.editcourse', compact('course')); */

        return view('backend.editcourse')
            ->withCourse($course);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courses $course)
    {
        //
        $updateData = $request->validate([
            'kod' => 'required',
            'nama_kursus' => 'required'
        ]);

        /* Courses::whereId($course)->update($updateData); */
        $course->update($request->all());

        return redirect()->route('admin.course')->withFlashSuccess(__('Kursus berjaya dikemaskini.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courses $course)
    {
        //
        $course->delete();

        return redirect()->route('admin.course')->withFlashSuccess(__('Kursus berjaya dipadam.'));
    }

}
