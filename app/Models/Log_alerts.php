<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_alerts extends Model
{
    use HasFactory;

    protected $table="log_alerts";

    

    public $timestamps=false;

    protected $fillable = [
        'id',
        'lokasi',
        'suhu',
        'masa'
    ];

  

    public function student()
    {
        return $this->belongsTo('App\Models\Students');
    }

}
