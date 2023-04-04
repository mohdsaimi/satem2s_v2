<?php

namespace App\Models;

use App\Models\Log_ins;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courses extends Model
{
    use HasFactory;

    protected $table = "courses";

    public $timestamps = false;

    protected $fillable = [
        'id',
        'kod',
        'nama_kursus',
        'kod_noss',
        'nama_noss'
    ];

    public function student()
    {
        return $this->hasMany('App\Models\Students');
    }

    public function log_ins()
    {
        return $this->hasManyThrough(Log_ins::class, Students::class, 'course_id', 'id_rfid', 'id', 'id_rfid');
    }
}
