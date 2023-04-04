<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vips extends Model
{
    use HasFactory;

    protected $table="vips";

    public $timestamps=false;

    protected $appends = ['pagi'];

    protected $fillable = [
        'id',
        'nama_vip',
        'no_kp',
        'id_rfid',
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

    public function log_in_vip()
    {
        return $this->hasMany('App\Models\Log_ins_vip', 'id_rfid', 'id_rfid');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Statuss');
    }
}
