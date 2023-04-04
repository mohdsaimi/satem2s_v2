<?php

namespace App\Models;

use App\Models\Hmrosak;
use App\Models\Lokasi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kakitangan extends Model
{
    use HasFactory;
    protected $table="kakitangan";

    public $timestamps=false;

    protected $fillable = [
        'id',
        'nama',
        'jawatan',
        'gred',
        'nokp'
    ];

    public function hmrosak()
    {
        return $this->hasMany('App\Models\Hmrosak');
    }
    public function lokasi()
    {
        return $this->hasMany('App\Models\Lokasi');
    }

}
