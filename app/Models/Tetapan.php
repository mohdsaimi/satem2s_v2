<?php

namespace App\Models;

/* use App\Models\Log_ins; */
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tetapan extends Model
{
    use HasFactory;

    protected $table = "tetapan";

    public $timestamps = false;

    protected $fillable = [
        'id',
        'tetapan_bppa',
        'tahun_lupus',
        'tetapan_2'
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
