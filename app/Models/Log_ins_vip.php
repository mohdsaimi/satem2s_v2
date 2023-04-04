<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_ins_vip extends Model
{
    use HasFactory;

    protected $table="log_ins_vip";

    

    public $timestamps=false;

    protected $fillable = [
        'id',
        'id_rfid',
        'lokasi',
        'suhu',
        'masa'
    ];

  

    public function vip()
    {
        return $this->belongsTo('App\Models\Vips');
    }

}
