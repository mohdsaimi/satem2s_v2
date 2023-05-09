<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\Courses;
use App\Models\Log_ins;
use App\Models\Log_ins_vip;
use App\Models\Vips;
use Illuminate\Http\Request;
use Arcanedev\LogViewer\Entities\Log;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.index');
    }

    public function bppa()
    {
        return view('frontend.bppa');
    }

    public function check_kehadiran(Request $request)
    {
        $query = Students::query();

        $date = $request->date ?? date('Y-m-d');

        $log_pagi = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', '07:00')->whereTime('masa', '<', '13:00')->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        $log_petang = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', '13:00')->orderBy('masa', 'desc')->get())->groupBy('id_rfid');

        if (!empty($request->term)) {
            $term = $request->term;

            $query->where('no_kp', $term);
        }else{
            $query->where('no_kp', 0);
        }

        $students = $query->orderBy('nama_pelajar', 'ASC')->get();

        return view('frontend.pages.kehadiran-1')
            ->withCourses(Courses::all())
            ->with('students', $students ?? null)
            ->with('log_pagi', $log_pagi ?? null)
            ->with('log_petang', $log_petang ?? null);
    }

    public function konvo()
    {
        
        /* $date = $request->date ?? date('Y-m-d'); */
        $date = date('Y-m-d');
        
        $query = Vips::query();

        $log_pagi = collect(Log_ins_vip::whereDate('masa', $date)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        //$log_petang = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', '13:00')->orderBy('masa', 'desc')->get())->groupBy('id_rfid');


        $vips = $query->orderBy('id', 'ASC')->get();
        
        return view('frontend.konvo')
        ->with('vips', $vips ?? null)
        ->with('log_pagi', $log_pagi ?? null);
    }

    public function konvo_del(Request $request)
    {
        /* $query = Vips::query();
        $vips = $query->orderBy('id', 'ASC')->get();
 */
        
 
 
        $query = Log_ins_vip::query();

        $log_ins_vip = $query->orderBy('id','ASC')->paginate(25);

        return view('frontend.konvo_del')
            ->with('log_ins_vip', $log_ins_vip)
            ->with('i', (request()->input('page', 1) - 1) * 25);

    }

    public function konvo_del_1(Log_ins_vip $log_ins_vip)
    {
        /* $log_ins_vip->delete(); */
        Log_ins_vip::truncate();  

        return redirect()->route('frontend.konvo_del')->withFlashSuccess(__('Maklumat komponen Konvo berjaya dipadam.'));
    
    }

    public function tetamu()
    {
        
        /* $date = $request->date ?? date('Y-m-d'); */
        $date = date('Y-m-d');
        
        $query = Vips::query();

        $log_pagi = collect(Log_ins_vip::whereDate('masa', $date)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        //$log_petang = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', '13:00')->orderBy('masa', 'desc')->get())->groupBy('id_rfid');


        $vips = $query->orderBy('id', 'ASC')->get();
        
        return view('frontend.tetamu')
        ->with('vips', $vips ?? null)
        ->with('log_pagi', $log_pagi ?? null);
    }

    public function satem2s(Request $request)
    {
        
        /* $date = date('Y-m-d'); */
        $date = $request->date ?? date('Y-m-d');

        $corses = Courses::all();

        $katagori = [];
        $data = [];
        foreach($corses as $kursus){
            $katagori[] = $kursus->nama_kursus;

            $log_pagi_all[] = Students::where('course_id',$kursus->id)->where('status_id', 1)->count();
            $log_petang_all[] = Students::where('course_id',$kursus->id)->where('status_id', 1)->count();

            $log_pagi[] = Students::where('course_id',$kursus->id)->where('status_id', 1)
                ->whereHas('log_in',function($q) use ($date){
                return $q->whereDate('masa', $date)->whereTime('masa', '>', '07:00')->whereTime('masa', '<', '13:00');
                })
                ->count();

            $log_petang[] = Students::where('course_id',$kursus->id)->where('status_id', 1)->where('status_id', 1)
                ->whereHas('log_in',function($q) use ($date){
                return $q->whereDate('masa', $date)->whereTime('masa', '>', '13:00');
            })
                ->count();
        }

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

        return view('frontend.satem2s')
            ->with('date', $date)
            ->with('katagori', $katagori)
            ->with('log_pagi', $log_pagi)
            ->with('log_petang', $log_petang)
            ->with('log_pagi_xhadir', $log_pagi_xhadir)
            ->with('log_petang_xhadir', $log_petang_xhadir);
    }
    

}
