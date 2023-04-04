<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ata extends Model
{
    use HasFactory;
    protected $table="kod_komponen";

    public $timestamps=false;

    protected $fillable = [
  
        'id',
        'kod_kom',
        'kod_1',
        'per_1',
        'kod_2',
        'per_2',
        'kod_3',
        'per_3',
        'kod_4',
        'per_4',
        'kod_5',
        'per_5',
        'kod_6',
        'per_6',
        'kod_7',
        'per_7',
        'sinonim',
        'definisi',
        'aktif'

    ];
}
