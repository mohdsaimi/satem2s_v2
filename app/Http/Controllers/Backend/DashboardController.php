<?php

namespace App\Http\Controllers\Backend;

use App\Models\Courses;
use App\Models\Students;
use App\Models\Log_ins;
use App\Models\Hmrosak;
use App\Models\Abrrosak;
use App\Models\Asetalih;
use App\Models\Lokasi;
use App\Models\Bangunan;
use App\Models\Atarosak;
use App\Models\Strrosak;
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


        /* BPPA */

        $date_bppa = $request->date_bppa ?? date('Y');

        $awal = "$date_bppa-01-01";
        $akhir = "$date_bppa-12-31";

        $tarikh_awal = Carbon::createFromFormat('Y-m-d', $awal);
        $tarikh_akhir = Carbon::createFromFormat('Y-m-d', $akhir);
        /* $tarikh_awal = new Carbon($awal); */
        /* $tarikh_akhir = new Carbon($akhir); */

        $bil_rosak = Hmrosak::where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)->get()->count();
        $bil_selesai = Hmrosak::where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)->where('status','>=',7)->where('status','<=',10)->get()->count();
        $bil_tolak = Hmrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status', 10)->get()->count();
        $bil_pro_perolehan = Hmrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',2)->get()->count();
        $bil_pro_lupus = Hmrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',3)->get()->count();
        $bil_perolehan = Hmrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',4)->get()->count();
        $bil_lupus = Hmrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',5)->get()->count();
        $bil_kendiri = Hmrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',6)->get()->count();
        $bil_bppa = Hmrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',1)->get()->count();
        $bil_xselesai = Hmrosak::where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)->where('status','<=',6)->get()->count();
        $bil_baru = Hmrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',0)->get()->count();

        $bil_xselesai_semua = Hmrosak::where('status','<=',6)->get()->count();
        $bil_rosak_semua = Hmrosak::get()->count();
        $bil_selesai_semua = Hmrosak::where('status','>=',7)->where('status','<=',10)->get()->count();
        /* $bil_xselesai = $bil_rosak - $bil_selesai; */

        /* ABR */
        $bil_rosak_abr = Abrrosak::where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)->get()->count();
        $bil_selesai_abr = Abrrosak::where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)->where('status','>=',7)->where('status','<=',10)->get()->count();
        $bil_tolak_abr = Abrrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status', 10)->get()->count();
        $bil_pro_perolehan_abr = Abrrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',2)->get()->count();
        $bil_pro_lupus_abr = Abrrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',3)->get()->count();
        $bil_perolehan_abr = Abrrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',4)->get()->count();
        $bil_lupus_abr = Abrrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',5)->get()->count();
        $bil_kendiri_abr = Abrrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',6)->get()->count();
        $bil_bppa_abr = Abrrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',1)->get()->count();
        $bil_xselesai_abr = Abrrosak::where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)->where('status','<=',6)->get()->count();
        $bil_baru_abr = Abrrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',0)->get()->count();

        $bil_xselesai_abr_semua = Abrrosak::where('status','<=',6)->get()->count();
        $bil_rosak_abr_semua = Abrrosak::get()->count();
        $bil_selesai_abr_semua = Abrrosak::where('status','>=',7)->where('status','<=',10)->get()->count();
        /* $bil_xselesai_abr = $bil_rosak_abr - $bil_selesai_abr; */
        /* end ABR */

        /* ATA */
        $bil_rosak_ata = Atarosak::where('tarikh_rosak','>', $tarikh_awal)->where('tarikh_rosak','<',$tarikh_akhir)->get()->count();
        $bil_selesai_ata = Atarosak::where('tarikh_rosak','>', $tarikh_awal)->where('tarikh_rosak','<',$tarikh_akhir)->where('status','>=',7)->where('status','<=',10)->get()->count();
        $bil_tolak_ata = Atarosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status', 10)->get()->count();
        $bil_pro_perolehan_ata = Atarosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',2)->get()->count();
        $bil_pro_lupus_ata = Atarosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',3)->get()->count();
        $bil_perolehan_ata = Atarosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',4)->get()->count();
        $bil_lupus_ata = Atarosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',5)->get()->count();
        $bil_kendiri_ata = Atarosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',6)->get()->count();
        $bil_bppa_ata = Atarosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',1)->get()->count();
        $bil_xselesai_ata = Atarosak::where('tarikh_rosak','>', $tarikh_awal)->where('tarikh_rosak','<',$tarikh_akhir)->where('status','<=',6)->get()->count();
        $bil_baru_ata = Atarosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',0)->get()->count();

        $bil_xselesai_ata_semua = Atarosak::where('status','<=',6)->get()->count();
        $bil_rosak_ata_semua = Atarosak::get()->count();
        $bil_selesai_ata_semua = Atarosak::where('status','>=',7)->where('status','<=',10)->get()->count();
        /* $bil_xselesai_ata = $bil_rosak_abr - $bil_selesai_abr; */
        /* end ATA */

        /* STR ATA */
        $bil_rosak_str = Strrosak::where('tarikh_rosak','>', $tarikh_awal)->where('tarikh_rosak','<',$tarikh_akhir)->get()->count();
        $bil_selesai_str = Strrosak::where('tarikh_rosak','>', $tarikh_awal)->where('tarikh_rosak','<',$tarikh_akhir)->where('status','>=',7)->where('status','<=',10)->get()->count();
        $bil_tolak_str = Strrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status', 10)->get()->count();
        $bil_pro_perolehan_str = Strrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',2)->get()->count();
        $bil_pro_lupus_str = Strrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',3)->get()->count();
        $bil_perolehan_str = Strrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',4)->get()->count();
        $bil_lupus_str = Strrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',5)->get()->count();
        $bil_kendiri_str = Strrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',6)->get()->count();
        $bil_bppa_str = Strrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',1)->get()->count();
        $bil_xselesai_str = Strrosak::where('tarikh_rosak','>', $tarikh_awal)->where('tarikh_rosak','<',$tarikh_akhir)->where('status','<=',6)->get()->count();
        $bil_baru_str = Strrosak::/* where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)-> */where('status',0)->get()->count();

        $bil_xselesai_str_semua = Strrosak::where('status','<=',6)->get()->count();
        $bil_rosak_str_semua = Strrosak::get()->count();
        $bil_selesai_str_semua = Strrosak::where('status','>=',7)->where('status','<=',10)->get()->count();
        /* $bil_xselesai_ata = $bil_rosak_abr - $bil_selesai_abr; */
        /* end STR ATA */


        /* all */
        $bil_rosak_all = $bil_rosak + $bil_rosak_abr;
        $bil_selesai_all = $bil_selesai + $bil_selesai_abr;
        $bil_tolak_all = $bil_tolak + $bil_tolak_abr;
        $bil_pro_perolehan_all = $bil_pro_perolehan + $bil_pro_perolehan_abr;
        $bil_pro_lupus_all = $bil_pro_lupus + $bil_pro_lupus_abr;
        $bil_perolehan_all = $bil_perolehan + $bil_perolehan_abr;
        $bil_lupus_all = $bil_lupus + $bil_lupus_abr;
        $bil_kendiri_all = $bil_kendiri + $bil_kendiri_abr;
        $bil_bppa_all = $bil_bppa + $bil_bppa_abr;
        $bil_xselesai_all = $bil_xselesai + $bil_xselesai_abr;
        $bil_baru_all = $bil_baru + $bil_baru_abr;

        $bil_rosak_all_semua = $bil_rosak_semua + $bil_rosak_abr_semua;
        $bil_selesai_all_semua = $bil_selesai_semua + $bil_selesai_abr_semua;
        $bil_xselesai_all_semua = $bil_xselesai_semua + $bil_xselesai_abr_semua;
        /* end all */

        /* all ATA + STR*/
        $bil_rosak_all_ata = $bil_rosak_ata + $bil_rosak_str;
        $bil_selesai_all_ata = $bil_selesai_ata + $bil_selesai_str;
        $bil_tolak_all_ata = $bil_tolak_ata + $bil_tolak_str;
        $bil_pro_perolehan_all_ata = $bil_pro_perolehan_ata + $bil_pro_perolehan_str;
        $bil_pro_lupus_all_ata = $bil_pro_lupus_ata + $bil_pro_lupus_str;
        $bil_perolehan_all_ata = $bil_perolehan_ata + $bil_perolehan_str;
        $bil_lupus_all_ata = $bil_lupus_ata + $bil_lupus_str;
        $bil_kendiri_all_ata = $bil_kendiri_ata + $bil_kendiri_str;
        $bil_bppa_all_ata = $bil_bppa_ata + $bil_bppa_str;
        $bil_xselesai_all_ata = $bil_xselesai_ata + $bil_xselesai_str;
        $bil_baru_all_ata = $bil_baru_ata + $bil_baru_str;

        $bil_rosak_all_semua_ata = $bil_rosak_ata_semua + $bil_rosak_str_semua;
        $bil_selesai_all_semua_ata = $bil_selesai_ata_semua + $bil_selesai_str_semua;
        $bil_xselesai_all_semua_ata = $bil_xselesai_ata_semua + $bil_xselesai_str_semua;
        /* end all ATA + STR*/

        $hmrosak = Hmrosak::where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)
        ->get()->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->tarikh_aduan)->format('m'); // grouping by months
        });

        $abrrosak = Abrrosak::where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)
        ->get()->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->tarikh_aduan)->format('m'); // grouping by months
        });

        $aduan_bil = [];
        $aduan = [];
        $aduan_bil_abr = [];
        $aduan_abr = [];
        $aduan_all = [];

        foreach ($hmrosak as $key => $value) {
            $aduan_bil[(int)$key] = count($value);
        }

        foreach ($abrrosak as $key => $value) {
            $aduan_bil_abr[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($aduan_bil[$i])){
                $aduan[$i] = $aduan_bil[$i];    
            }else{
                $aduan[$i] = 0;    
            }
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($aduan_bil_abr[$i])){
                $aduan_abr[$i] = $aduan_bil_abr[$i];    
            }else{
                $aduan_abr[$i] = 0;    
            }
        }

        /* all aduan */
        for($i = 1; $i <= 12; $i++){
            $aduan_all[$i] = $aduan[$i] + $aduan_abr[$i];
        }
        /* end all aduan */

        $hmrosak1 = Hmrosak::where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)
        ->where('status','>=',7)->get()->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->tarikh_siap)->format('m'); // grouping by months
        });
        $abrrosak1 = Abrrosak::where('tarikh_aduan','>', $tarikh_awal)->where('tarikh_aduan','<',$tarikh_akhir)
        ->where('status','>=',7)->get()->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->tarikh_siap)->format('m'); // grouping by months
        });

        $aduan_bil1 = [];
        $selesai = [];
        $aduan_bil1_abr = [];
        $selesai_abr = [];
        $selesai_all = [];

        foreach ($hmrosak1 as $key => $value) {
            $aduan_bil1[(int)$key] = count($value);
        }
        foreach ($abrrosak1 as $key => $value) {
            $aduan_bil1_abr[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($aduan_bil1[$i])){
                $selesai[$i] = $aduan_bil1[$i];    
            }else{
                $selesai[$i] = 0;    
            }
        }
        for($i = 1; $i <= 12; $i++){
            if(!empty($aduan_bil1_abr[$i])){
                $selesai_abr[$i] = $aduan_bil1_abr[$i];    
            }else{
                $selesai_abr[$i] = 0;    
            }
        }
        /* all selesai */
        for($i = 1; $i <= 12; $i++){
            $selesai_all[$i]  = $selesai[$i] + $selesai_abr[$i];
        }
        /* end all selesai */

        /* PATA */
        $bil_bangunan = Bangunan::get()->count();
        $bil_ruang = Lokasi::where('nama_lokasi','!=',"-")->get()->count();
        $bil_kom_daftar = Asetalih::get()->count();

/////////
        $atarosak = Atarosak::where('tarikh_rosak','>', $tarikh_awal)->where('tarikh_rosak','<',$tarikh_akhir)
        ->get()->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->tarikh_rosak)->format('m'); // grouping by months
        });

        $strrosak = Strrosak::where('tarikh_rosak','>', $tarikh_awal)->where('tarikh_rosak','<',$tarikh_akhir)
        ->get()->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->tarikh_rosak)->format('m'); // grouping by months
        });

        $aduan_bil_ata = [];
        $aduan_ata = [];
        $aduan_bil_str = [];
        $aduan_str = [];
        $aduan_all_ata = [];

        foreach ($atarosak as $key => $value) {
            $aduan_bil_ata[(int)$key] = count($value);
        }

        foreach ($strrosak as $key => $value) {
            $aduan_bil_str[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($aduan_bil_ata[$i])){
                $aduan_ata[$i] = $aduan_bil_ata[$i];    
            }else{
                $aduan_ata[$i] = 0;    
            }
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($aduan_bil_str[$i])){
                $aduan_str[$i] = $aduan_bil_str[$i];    
            }else{
                $aduan_str[$i] = 0;    
            }
        }

        /* all aduan */
        for($i = 1; $i <= 12; $i++){
            $aduan_all_ata[$i] = $aduan_ata[$i] + $aduan_str[$i];
        }
        /* end all aduan */


/////////

        $atarosak1 = Atarosak::where('tarikh_rosak','>', $tarikh_awal)->where('tarikh_rosak','<',$tarikh_akhir)
        ->where('status','>=',7)->get()->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->tarikh_siap)->format('m'); // grouping by months
        });
        $strrosak1 = Strrosak::where('tarikh_rosak','>', $tarikh_awal)->where('tarikh_rosak','<',$tarikh_akhir)
        ->where('status','>=',7)->get()->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->tarikh_siap)->format('m'); // grouping by months
        });

        $aduan_bil1_ata = [];
        $selesai_ata = [];
        $aduan_bil1_str = [];
        $selesai_str = [];
        $selesai_all_ata = [];

        foreach ($atarosak1 as $key => $value) {
            $aduan_bil1_ata[(int)$key] = count($value);
        }
        foreach ($strrosak1 as $key => $value) {
            $aduan_bil1_str[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($aduan_bil1_ata[$i])){
                $selesai_ata[$i] = $aduan_bil1_ata[$i];    
            }else{
                $selesai_ata[$i] = 0;    
            }
        }
        for($i = 1; $i <= 12; $i++){
            if(!empty($aduan_bil1_str[$i])){
                $selesai_str[$i] = $aduan_bil1_str[$i];    
            }else{
                $selesai_str[$i] = 0;    
            }
        }
        /* all selesai */
        for($i = 1; $i <= 12; $i++){
            /* $selesai_all_ata[$i]  = $selesai_ata[$i] + $bil_selesai_all_semua_ata[$i]; */
            $selesai_all_ata[$i]  = $selesai_ata[$i] + $selesai_str[$i];
        }
        /* end all selesai */



        /* end PATA */

        /* end BPPA */

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
            ->with('log_petang_tinggi', $log_petang_tinggi)

            ->with('date_bppa', $date_bppa)
            ->with('bil_rosak_all', $bil_rosak_all)
            ->with('bil_selesai_all', $bil_selesai_all)
            ->with('bil_tolak_all', $bil_tolak_all)
            ->with('bil_pro_perolehan_all', $bil_pro_perolehan_all)
            ->with('bil_pro_lupus_all', $bil_pro_lupus_all)
            ->with('bil_perolehan_all', $bil_perolehan_all)
            ->with('bil_lupus_all', $bil_lupus_all)
            ->with('bil_kendiri_all', $bil_kendiri_all)
            ->with('bil_bppa_all', $bil_bppa_all)
            ->with('bil_xselesai_all', $bil_xselesai_all)
            ->with('aduan_all', $aduan_all)
            ->with('selesai_all', $selesai_all)
            ->with('bil_xselesai_all_semua', $bil_xselesai_all_semua)
            ->with('bil_rosak_all_semua', $bil_rosak_all_semua)
            ->with('bil_selesai_all_semua', $bil_selesai_all_semua)
            ->with('bil_baru_all', $bil_baru_all)

            ->with('bil_bangunan', $bil_bangunan)
            ->with('bil_ruang', $bil_ruang)
            ->with('bil_kom_daftar', $bil_kom_daftar)

            ->with('bil_rosak_all_ata', $bil_rosak_all_ata)
            ->with('bil_selesai_all_ata', $bil_selesai_all_ata)
            ->with('bil_tolak_all_ata', $bil_tolak_all_ata)
            ->with('bil_pro_perolehan_all_ata', $bil_pro_perolehan_all_ata)
            ->with('bil_pro_lupus_all_ata', $bil_pro_lupus_all_ata)
            ->with('bil_perolehan_all_ata', $bil_perolehan_all_ata)
            ->with('bil_lupus_all_ata', $bil_lupus_all_ata)
            ->with('bil_kendiri_all_ata', $bil_kendiri_all_ata)
            ->with('bil_bppa_all_ata', $bil_bppa_all_ata)
            ->with('bil_xselesai_all_ata', $bil_xselesai_all_ata)

            ->with('bil_xselesai_all_semua_ata', $bil_xselesai_all_semua_ata)
            ->with('bil_rosak_all_semua_ata', $bil_rosak_all_semua_ata)
            ->with('bil_selesai_all_semua_ata', $bil_selesai_all_semua_ata)
            ->with('bil_baru_all_ata', $bil_baru_all_ata)
            
            ->with('aduan_all_ata', $aduan_all_ata)
            ->with('selesai_all_ata', $selesai_all_ata);
            
    }
}
