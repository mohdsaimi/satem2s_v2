<?php

namespace App\Http\Controllers\Backend;

use App\Models\Courses;
use App\Models\Students;
use App\Models\Log_ins;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        /* $date = date('Y-m-d'); */
        $date = $request->date ?? date('Y-m-d');

        $corses = Courses::all();

        //return Courses::with('avgSuhu')->get();

        $katagori = [];
        $data = [];
        foreach ($corses as $kursus) {
            $katagori[] = $kursus->nama_kursus;

            $log_pagi_all[] = Students::where('course_id', $kursus->id)->where('status_id', 1)->count();
            $log_petang_all[] = Students::where('course_id', $kursus->id)->where('status_id', 1)->count();

            $log_pagi[] = Students::where('course_id', $kursus->id)->where('status_id', 1)
                ->whereHas('log_in', function ($q) use ($date) {
                    return $q->whereDate('masa', $date)->whereTime('masa', '>', '07:00')->whereTime('masa', '<', '13:00');
                })
                ->count();

            $log_petang[] = Students::where('course_id', $kursus->id)->where('status_id', 1)
                ->whereHas('log_in', function ($q) use ($date) {
                    return $q->whereDate('masa', $date)->whereTime('masa', '>', '13:00');
                })
                ->count();

            $avg_pagi = Courses::where('id', $kursus->id)
                ->whereHas('log_ins', function ($q) use ($date) {
                    return $q->whereDate('masa', $date)->whereTime('masa', '>', '07:00')->whereTime('masa', '<', '13:00');
                })
                ->with(['log_ins' => function ($q) use ($date) {
                    return $q->whereDate('masa', $date)->whereTime('masa', '>', '07:00')->whereTime('masa', '<', '13:00');
                }])
                ->first()->log_ins ?? 0;

            $avg_petang = Courses::where('id', $kursus->id)
                ->whereHas('log_ins', function ($q) use ($date) {
                    return $q->whereDate('masa', $date)->whereTime('masa', '>', '13:00');
                })
                ->with(['log_ins' => function ($q) use ($date) {
                    return $q->whereDate('masa', $date)->whereTime('masa', '>', '13:00');
                }])
                ->first()->log_ins ?? 0;

            $avg_log_pagi[$kursus->id][] = collect($avg_pagi)->avg('suhu') ?? 0;
            $avg_log_petang[$kursus->id][] = collect($avg_petang)->avg('suhu') ?? 0;
            $log_pagi_tinggi[$kursus->id][] = collect($avg_pagi)->max('suhu') ?? 0;
            $log_petang_tinggi[$kursus->id][] = collect($avg_petang)->max('suhu') ?? 0;
        }

        // return $avg_log_pagi;

        $log_pagi_xhadir[0] = $log_pagi_all[0] - $log_pagi[0];
        $log_petang_xhadir[0] = $log_petang_all[0] - $log_petang[0];
        $log_pagi_xhadir[1] = $log_pagi_all[1] - $log_pagi[1];
        $log_petang_xhadir[1] = $log_petang_all[1] - $log_petang[1];
        $log_pagi_xhadir[2] = $log_pagi_all[2] - $log_pagi[2];
        $log_petang_xhadir[2] = $log_petang_all[2] - $log_petang[2];
        $log_pagi_xhadir[3] = $log_pagi_all[3] - $log_pagi[3];
        $log_petang_xhadir[3] = $log_petang_all[3] - $log_petang[3];
        $log_pagi_xhadir[4] = $log_pagi_all[4] - $log_pagi[4];
        $log_petang_xhadir[4] = $log_petang_all[4] - $log_petang[4];

        //data temp


        /* $suhu_log_pagi = Log_ins::whereDate('masa', $date)->whereTime('masa', '>', '07:00')->whereTime('masa', '<', '13:00')
            ->avg('suhu'); */




        return view('backend.dashboard')
            ->with('date', $date)
            ->with('katagori', $katagori)
            ->with('log_pagi', $log_pagi)
            ->with('log_petang', $log_petang)
            ->with('log_pagi_xhadir', $log_pagi_xhadir)
            ->with('log_petang_xhadir', $log_petang_xhadir)
            ->withCourses(Courses::all())
            ->with('avg_log_pagi', $avg_log_pagi)
            ->with('avg_log_petang', $avg_log_petang)
            ->with('log_pagi_tinggi', $log_pagi_tinggi)
            ->with('log_petang_tinggi', $log_petang_tinggi);

            
    }
}
