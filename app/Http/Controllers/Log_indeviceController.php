<?php

namespace App\Http\Controllers;

use App\Models\Log_ins;
use App\Models\Students;
use App\Models\Courses;
use App\Models\Vips;
use App\Models\Log_ins_vip;
use App\Models\Log_inouts;
use Illuminate\Http\Request;

class Log_indeviceController extends Controller
{

    public function add(Request $request)
    {
        $api_key_value = "5a1m1th3gr34t_4Lw4y5pr0t3ct3d8yth34Lm19hty";

        $log_in=new Log_ins;
        $log_in->id_rfid=$request->rfid;
    //buat mcm ni boleh tak?
        //$log_in->students_id=Students::where('id_rfid',$request->rfid)->first()->id;
        $log_in->suhu=$request->suhu;
        $log_in->lokasi=$request->lokasi;

        if($api_key_value == $request->api_key_value){
            $log_in->save();
        }

        //print_r($request->input());
        /* return ("Result"->"Data disimpan"); */
    }

    public function add_vip(Request $request)
    {
        $api_key_value = "5a1m1th3gr34t_4Lw4y5pr0t3ct3d8yth34Lm19hty";

        $log_in=new Log_ins_vip;
        $log_in->id_rfid=$request->rfid;
    //buat mcm ni boleh tak?
        //$log_in->students_id=Students::where('id_rfid',$request->rfid)->first()->id;
        $log_in->suhu=$request->suhu;
        $log_in->lokasi=$request->lokasi;

        if($api_key_value == $request->api_key_value){
            $log_in->save();
        }

        //print_r($request->input());
        /* return ("Result"->"Data disimpan"); */
    }

    public function add_inout(Request $request)
    {
        $api_key_value = "5a1m1th3gr34t_4Lw4y5pr0t3ct3d8yth34Lm19hty";

        $log_in=new Log_inouts;
        $log_in->id_rfid=$request->rfid;

        $log_in->suhu=$request->suhu;
        $log_in->lokasi=$request->lokasi;

        if($api_key_value == $request->api_key_value){
            $log_in->save();
        }

    }

}

