<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $table="students";

    public $timestamps=false;

    protected $appends = ['pagi'];

    protected $fillable = [
        'id',
        'nama_pelajar',
        'no_kp',
        'ndp',
        'course_id',
        'sesi_masuk',
        'semester',
        'id_rfid',
        'alamat',
        'no_tel',
        'nama_waris',
        'alamat_waris',
        'notel_waris',
        'status_id'
    ];

    public function getPagiAttribute()
    {
        // $time_am = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s','2021-01-25 07:00:00');
        // $pagi = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$this->masa);

        // $time_pm = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', '2021-01-25 13:00:00');
        //return Log_ins::where('')
        return $this->masa;

    }

    public function course()
    {
        return $this->belongsTo('App\Models\Courses');
    }

    public function log_in()
    {
        return $this->hasMany('App\Models\Log_ins', 'id_rfid', 'id_rfid');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Statuss');
    }
}
