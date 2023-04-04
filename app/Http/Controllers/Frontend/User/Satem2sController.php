<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\Courses;
use App\Models\Log_ins;
use Illuminate\Http\Request;
use Arcanedev\LogViewer\Entities\Log;
use PDF;

/**
 * Class Satem2sController.
 */
class Satem2sController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        /* return view('frontend.user.kehadiran'); */

        $query = Students::query()->where('status_id',1);

        $date = $request->date ?? date('Y-m-d');

        $log_pagi = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', '07:00')->whereTime('masa', '<', '13:00')->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $log_petang = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', '13:00')->orderBy('masa', 'desc')->get())->groupBy('id_rfid');



        if (!empty($request->term_1)) {
            $term_1 = $request->term_1;
            $term_2 = $request->term_2;

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

        return view('frontend.user.kehadiran')
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

}
