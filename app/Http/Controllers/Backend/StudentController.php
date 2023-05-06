<?php

namespace App\Http\Controllers\Backend;

use App\Models\Students;
use App\Models\Courses;
use App\Models\Log_ins;
use App\Models\Statuss;
use App\Models\TetapanDKP;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Arcanedev\LogViewer\Entities\Log;
use PDF;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Students::with('course')->whereHas('course', function ($q) use ($term) {
                $q->where('nama_pelajar', 'like', '%' . $term . '%')->orWhere('no_kp', 'like', '%' . $term . '%')
                    ->orWhere('sesi_masuk', 'like', '%' . $term . '%')->orWhere('ndp', 'like', '%' . $term . '%');
            })
                ->orWhereHas('course', function ($q) use ($term) {
                    $q->where('kod', 'like', '%' . $term . '%')->orWhere('nama_kursus', 'like', '%' . $term . '%')
                        ->orWhere('kod_noss', 'like', '%' . $term . '%');
                });
            /* ->orWhereHas('device',function($q) use ($term){
                $q->where('kod_IOT','like','%'.$term.'%');
            }); */
        } else {
            $query = Students::query();
        }

        $students = $query->orderBy('course_id', 'ASC')->orderBy('sesi_masuk', 'ASC')->paginate(25);

        return view('backend.student')
            ->with('students', $students)
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
        return view('backend.createstudent')
            ->withCourses(Courses::all());
        /* ->withCourses($course); */
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
        if ($this->check_student($request->no_kp) > 0) {
            return redirect()->back()->withFlashDanger(__('Pelajar telah wujud'));
        }

        $student = new Students();
        $student->nama_pelajar = $request->nama_pelajar;
        $student->no_kp = $request->no_kp;
        $student->ndp = $request->ndp;
        $student->course_id = $request->course_id;
        $student->sesi_masuk = $request->sesi_masuk;
        $student->id_rfid = $request->id_rfid;
        $student->alamat = $request->alamat;
        $student->no_tel = $request->no_tel;
        $student->nama_waris = $request->nama_waris;
        $student->alamat_waris = $request->alamat_waris;
        $student->notel_waris = $request->notel_waris;

        if ($student->save()) {
            return redirect()->route('admin.student')
                ->withFlashSuccess(__('Pelajar telah berjaya disimpan.'));
        } else {
            return redirect()->back()->withFlashDanger(__('Pelajar gagal disimpan'));
        }
    }

    public function check_student($no_kp)
    {
        return Students::where('no_kp', $no_kp)
            ->count();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Students $student)
    {
        //
        return view('backend.showstudent')
            ->withCourses(Courses::all())
            ->withStudent($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Students $student)
    {
        //
        return view('backend.editstudent')
            ->withCourses(Courses::all())
            ->withStudent($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Students $student)
    {
        //
        $updateData = $request->validate([
            'no_kp' => 'required',
            'nama_pelajar' => 'required'
        ]);

        /* Courses::whereId($course)->update($updateData); */
        $student->update($request->all());

        return redirect()->route('admin.student',['term' => request('term')])->withFlashSuccess(__('Maklumat pelajar berjaya dikemaskini.'));
    }

    public function edit_status(Students $student)
    {
        //
        return view('backend.edit_status_student')
            ->withCourses(Courses::all())
            ->withStatuss(Statuss::all())
            ->withStudent($student);
    }
    public function update_status(Request $request, Students $student)
    {

        //
        $updateData = $request->validate([
            'status_id' => 'required'
        ]);

        /* Courses::whereId($course)->update($updateData); */
        $student->update($request->all());

        return redirect()->route('admin.student',['term' => request('term')])->withFlashSuccess(__('Maklumat status pelajar berjaya dikemaskini.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Students $student)
    {
        //
        $student->delete();

        return redirect()->route('admin.student',['term'=>request('term') ?? null])->withFlashSuccess(__('Maklumat pelajar berjaya dipadam.'));
    }

    public function index_RFID(Request $request)
    {
        //
        if (!empty($request->term)) {
            $term = $request->term;

            $query = Students::with('course')->where('status_id',1)->whereHas('course', function ($q) use ($term) {
                $q->where('nama_pelajar', 'like', '%' . $term . '%')->orWhere('no_kp', 'like', '%' . $term . '%')
                    ->orWhere('sesi_masuk', 'like', '%' . $term . '%')->orWhere('ndp', 'like', '%' . $term . '%')
                    ->orWhere('id_rfid', 'like', '%' . $term . '%');
            })
                ->orWhereHas('course', function ($q) use ($term) {
                    $q->where('kod', 'like', '%' . $term . '%')->orWhere('nama_kursus', 'like', '%' . $term . '%')
                        ->orWhere('kod_noss', 'like', '%' . $term . '%');
                });

            /* ->orWhereHas('device',function($q) use ($term){
                $q->where('kod_IOT','like','%'.$term.'%');
            }); */
        } else {
            $query = Students::query()->where('status_id',1);
        }

        $students = $query->orderBy('course_id', 'ASC')->orderBy('semester', 'ASC')->paginate(25);

        return view('backend.rfid')
            ->with('students', $students)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function edit_RFID(Students $student)
    {
        //
        return view('backend.editrfid')
            ->withCourses(Courses::all())
            ->withStudent($student);
    }

    public function update_RFID(Request $request, Students $student)
    {
        //
        $updateData = $request->validate([
            'id_rfid' => 'required'
        ]);

        /* Courses::whereId($course)->update($updateData); */
        $student->update($request->all());

        return redirect()->route('admin.rfid', ['term' => request('term')])->withFlashSuccess(__('Maklumat RFID pelajar berjaya dikemaskini.'));
    }

    public function index_kehadiran(Request $request)
    {
        //
        // $time_am = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s','2021-01-25 07:00:00');
        // $time_pm = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', '2021-01-25 13:00:00');

        // $students = Students::join('log_ins', 'log_ins.id_rfid', '=', 'students.id_rfid')

        //     ->get();

        //return Students::with('log_in')->whereHas('log_in')->get();

        $query = Students::query()->where('status_id',1);

        $date = $request->date ?? date('Y-m-d');

        $log_pagi = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', '07:00')->whereTime('masa', '<', '13:00')->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $log_petang = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', '13:00')->orderBy('masa', 'desc')->get())->groupBy('id_rfid');



        if (!empty($request->term_1)) {
            $term_1 = $request->term_1;
            $term_2 = $request->term_2;
            // $date = $request->date;

            // $date_pagi = date_create('' . $date . ' 07:00:00');
            // $date_petang = date_create('' . $date . ' 13:00:00');
            // $date_pagi = date_format($date_pagi, 'Y-m-d H:i:s');
            // $date_petang = date_format($date_petang, 'Y-m-d H:i:s');


            /* $logins = collect(Log_ins::all()->groupBy('id_rfid')->sortBy('masa','DESC')); */
            $query->where('course_id', $term_1)->where('sesi_masuk', 'like', '%' . $term_2 . '%');



            // $query2 = Students::where('course_id',$term_1)->Where('sesi_masuk','like','%'.$term_2.'%')
            //     ->join('log_ins', 'log_ins.id_rfid', '=', 'students.id_rfid')
            //     ->Where('log_ins.masa','>',$date_petang);
            /* ->union($query); */
        }

        // $students = $query->orderBy('nama_pelajar','ASC')->paginate(25);
        $students = $query->orderBy('semester', 'ASC')->orderBy('nama_pelajar', 'ASC')->paginate(25);

        /* $students1 = $query2->orderBy('nama_pelajar','ASC')->paginate(25); */

        return view('backend.kehadiran')
            ->withCourses(Courses::all())
            ->with('students', $students)
            ->with('log_pagi', $log_pagi)
            ->with('log_petang', $log_petang)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    // Generate PDF

    public function createPDF(Request $request) {

        $query = Students::query()->where('status_id',1);

        $date = $request->date ?? date('Y-m-d');

        $log_pagi = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', '07:00')->whereTime('masa', '<', '13:00')->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $log_petang = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', '13:00')->orderBy('masa', 'desc')->get())->groupBy('id_rfid');


        if (!empty($request->term_1)) {
            $term_1 = $request->term_1;
            $term_2 = $request->term_2;

            $query->where('course_id', $term_1)->where('sesi_masuk', 'like', '%' . $term_2 . '%');

        }

        $students = $query->orderBy('semester', 'ASC')->orderBy('nama_pelajar', 'ASC')->get();

        $pdf = PDF::loadView('backend.pdf_view', compact('students', 'log_pagi', 'log_petang'))->setPaper('a4', 'landscape');

        return $pdf->download('pdf_file.pdf');
    }

    public function semester()
    {
        //
        return view('backend.semester');
    }

    public function update_semester(Request $request)
    {
        $sesi_masuk = $request->sesi_masuk;
        $semester = $request->semester;

        if (!empty($request->sesi_masuk) && !empty($request->semester)) {

            Students::where('sesi_masuk', $sesi_masuk)->update(['semester' => $semester]);
            return redirect()->route('admin.semester')->withFlashSuccess(__('Maklumat semester bagi semua pelajar sesi {{ $sesi_masuk }} berjaya dikemaskini.'));
        }else{
            return redirect()->route('admin.semester')->withFlashDanger(__('Maklumat semester bagi semua pelajar sesi {{ $sesi_masuk }} tidak berjaya dikemaskini.'));
        }
        
    }

    public function tetapan_dkp()
    {
        $tetapandkp = TetapanDKP::where('id', 1)->first();

        return view('backend.tetapan_dkp')
            ->with('tetapandkp',$tetapandkp);
        
    }

    public function update_tetapan_dkp(Request $request)
    {
        $time_1a = $request->time_1a;
        $time_1b = $request->time_1b;
        $time_1c = $request->time_1c;
        $time_2a = $request->time_2a;
        $time_2b = $request->time_2b;
        $time_2c = $request->time_2c;
        $time_2d = $request->time_2d;
        $time_3a = $request->time_3a;
        $time_3b = $request->time_3b;
        $time_3c = $request->time_3c;
        $time_4a = $request->time_4a;
        $time_4b = $request->time_4b;
        $time_4c = $request->time_4c;
        $time_4d = $request->time_4d;
        $time_5a = $request->time_5a;
        $time_5b = $request->time_5b;
        $time_5c = $request->time_5c;


        /* dd($mohon_lupus); */

            tetapandkp::where('id', 1)->update(['time_1a' => $time_1a, 'time_1b' => $time_1b, 'time_1c' => $time_1c,
            'time_2a' => $time_2a, 'time_2b' => $time_2b, 'time_2c' => $time_2c,'time_2d' => $time_2d,
            'time_3a' => $time_3a, 'time_3b' => $time_3b, 'time_3c' => $time_3c,
            'time_4a' => $time_4a, 'time_4b' => $time_4b, 'time_4c' => $time_4c, 'time_4d' => $time_4d,
            'time_5a' => $time_5a, 'time_5b' => $time_5b, 'time_5c' => $time_5c
        ]);
            return redirect()->route('admin.tetapan_dkp')->withFlashSuccess(__('Tetapan berjaya dikemaskini.'));
        
    }


    public function index_kehadiran_dkp(Request $request)
    {
        $date = $request->date ?? date('Y-m-d');

        $tetapandkp = TetapanDKP::where('id', 1)->first();
        
        $slot1a=$tetapandkp->time_1a;
        $slot1b=$tetapandkp->time_1b;
        $slot1c=$tetapandkp->time_1c;

        $slot2a=$tetapandkp->time_2a;
        $slot2b=$tetapandkp->time_2b;
        $slot2c=$tetapandkp->time_2c;
        $slot2d=$tetapandkp->time_2d;

        $slot3a=$tetapandkp->time_3a;
        $slot3b=$tetapandkp->time_3b;
        $slot3c=$tetapandkp->time_3c;

        $slot4a=$tetapandkp->time_4a;
        $slot4b=$tetapandkp->time_4b;
        $slot4c=$tetapandkp->time_4c;
        $slot4d=$tetapandkp->time_4d;

        $slot5a=$tetapandkp->time_5a;
        $slot5b=$tetapandkp->time_5b;
        $slot5c=$tetapandkp->time_5c;


        $query = Students::query()->where('status_id',1);

        $slot1G = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '<', $slot1a)->orderBy('masa', 'asc')->get())->groupBy('id_rfid');
        $slot1Y = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot1a)->whereTime('masa', '<', $slot1b)->orderBy('masa', 'asc')->get())->groupBy('id_rfid');
        $slot1R = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot1b)->whereTime('masa', '<', $slot1c)->orderBy('masa', 'asc')->get())->groupBy('id_rfid');

        $slot2G = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot2a)->whereTime('masa', '<', $slot2b)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot2Y = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot2b)->whereTime('masa', '<', $slot2c)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot2R = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot2c)->whereTime('masa', '<', $slot2d)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');

        $slot3G = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot2d)->whereTime('masa', '<', $slot3a)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot3Y = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot3a)->whereTime('masa', '<', $slot3b)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot3R = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot3b)->whereTime('masa', '<', $slot3c)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');

        $slot4G = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot4a)->whereTime('masa', '<', $slot4b)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot4Y = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot4b)->whereTime('masa', '<', $slot4c)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot4R = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot4c)->whereTime('masa', '<', $slot4d)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');

        $slot5G = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot4d)->whereTime('masa', '<', $slot5a)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot5Y = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot5a)->whereTime('masa', '<', $slot5b)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot5R = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot5b)->whereTime('masa', '<', $slot5c)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');

/* dd($slot2G); */

        if (!empty($request->term_1)) {
            $term_1 = $request->term_1;
            $term_2 = $request->term_2;

            $query->where('course_id', $term_1)->where('sesi_masuk', 'like', '%' . $term_2 . '%');

        }


        $students = $query->orderBy('semester', 'ASC')->orderBy('nama_pelajar', 'ASC')->paginate(25);

        return view('backend.kehadiran_dkp')
            ->withCourses(Courses::all())
            ->with('date', $date)
            ->with('students', $students)
            ->with('slot1G', $slot1G)
            ->with('slot1Y', $slot1Y)
            ->with('slot1R', $slot1R)
            ->with('slot2G', $slot2G)
            ->with('slot2Y', $slot2Y)
            ->with('slot2R', $slot2R)
            ->with('slot3G', $slot3G)
            ->with('slot3Y', $slot3Y)
            ->with('slot3R', $slot3R)
            ->with('slot4G', $slot4G)
            ->with('slot4Y', $slot4Y)
            ->with('slot4R', $slot4R)
            ->with('slot5G', $slot5G)
            ->with('slot5Y', $slot5Y)
            ->with('slot5R', $slot5R)
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    public function create_pdf_dkp(Request $request)
    {
        $date = $request->date ?? date('Y-m-d');

        $tetapandkp = TetapanDKP::where('id', 1)->first();
        
        $slot1a=$tetapandkp->time_1a;
        $slot1b=$tetapandkp->time_1b;
        $slot1c=$tetapandkp->time_1c;

        $slot2a=$tetapandkp->time_2a;
        $slot2b=$tetapandkp->time_2b;
        $slot2c=$tetapandkp->time_2c;
        $slot2d=$tetapandkp->time_2d;

        $slot3a=$tetapandkp->time_3a;
        $slot3b=$tetapandkp->time_3b;
        $slot3c=$tetapandkp->time_3c;

        $slot4a=$tetapandkp->time_4a;
        $slot4b=$tetapandkp->time_4b;
        $slot4c=$tetapandkp->time_4c;
        $slot4d=$tetapandkp->time_4d;

        $slot5a=$tetapandkp->time_5a;
        $slot5b=$tetapandkp->time_5b;
        $slot5c=$tetapandkp->time_5c;


        $query = Students::query()->where('status_id',1);

        $slot1G = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '<', $slot1a)->orderBy('masa', 'asc')->get())->groupBy('id_rfid');
        $slot1Y = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot1a)->whereTime('masa', '<', $slot1b)->orderBy('masa', 'asc')->get())->groupBy('id_rfid');
        $slot1R = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot1b)->whereTime('masa', '<', $slot1c)->orderBy('masa', 'asc')->get())->groupBy('id_rfid');

        $slot2G = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot2a)->whereTime('masa', '<', $slot2b)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot2Y = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot2b)->whereTime('masa', '<', $slot2c)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot2R = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot2c)->whereTime('masa', '<', $slot2d)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');

        $slot3G = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot2d)->whereTime('masa', '<', $slot3a)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot3Y = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot3a)->whereTime('masa', '<', $slot3b)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot3R = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot3b)->whereTime('masa', '<', $slot3c)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');

        $slot4G = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot4a)->whereTime('masa', '<', $slot4b)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot4Y = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot4b)->whereTime('masa', '<', $slot4c)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot4R = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot4c)->whereTime('masa', '<', $slot4d)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');

        $slot5G = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot4d)->whereTime('masa', '<', $slot5a)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot5Y = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot5a)->whereTime('masa', '<', $slot5b)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $slot5R = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', $slot5b)->whereTime('masa', '<', $slot5c)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');

    /* dd($slot2G); */

        if (!empty($request->term_1)) {
            $term_1 = $request->term_1;
            $term_2 = $request->term_2;

            $query->where('course_id', $term_1)->where('sesi_masuk', 'like', '%' . $term_2 . '%');

        }


        $students = $query->orderBy('semester', 'ASC')->orderBy('nama_pelajar', 'ASC')->paginate(25);

        $pdf = PDF::loadView('backend.pdf_dkp_view', compact('students', 'date','slot1G', 'slot1Y', 'slot1R', 'slot2G', 
        'slot2Y', 'slot2R', 'slot3G', 'slot3Y', 'slot3R', 
        'slot4G', 'slot4Y', 'slot4R', 'slot5G', 'slot5Y', 'slot5R'))->setPaper('a4', 'landscape');

        return $pdf->download('pdf_file.pdf');


    }
}