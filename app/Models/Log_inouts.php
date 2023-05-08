<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_inouts extends Model
{
    use HasFactory;

    protected $table="log_inouts";

    

    public $timestamps=false;

    protected $fillable = [
        'id',
        'id_rfid',
        'lokasi',
        'suhu',
        'masa'
    ];

  

    public function student()
    {
        return $this->belongsTo('App\Models\Students');
    }

}
