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
        
        $date = $request->date ?? date('Y-m-d');
        
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
        
        $date = $request->date ?? date('Y-m-d');
        
        $query = Vips::query();

        $log_pagi = collect(Log_ins_vip::whereDate('masa', $date)->orderBy('masa', 'desc')->get())->groupBy('id_rfid');
        //$log_petang = collect(Log_ins::whereDate('masa', $date)->whereTime('masa', '>', '13:00')->orderBy('masa', 'desc')->get())->groupBy('id_rfid');


        $vips = $query->orderBy('id', 'ASC')->get();
        
        return view('frontend.tetamu')
        ->with('vips', $vips ?? null)
        ->with('log_pagi', $log_pagi ?? null);
    }

}
