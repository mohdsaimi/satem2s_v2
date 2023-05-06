<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TetapanDKP extends Model
{
    use HasFactory;

    protected $table = "tetapandkp";

    public $timestamps = false;

    protected $fillable = [
        'id',
        'time_1a',
        'time_1b',
        'time_1c',
        'time_2a',
        'time_2b',
        'time_2c',
        'time_2d',
        'time_3a',
        'time_3b',
        'time_3c',
        'time_4a',
        'time_4b',
        'time_4c',
        'time_4d',
        'time_5a',
        'time_5b',
        'time_5c'
    ];

    /* public function student()
    {
        return $this->hasMany('App\Models\Students');
    }

    public function log_ins()
    {
        return $this->hasManyThrough(Log_ins::class, Students::class, 'course_id', 'id_rfid', 'id', 'id_rfid');
    } */
}
