<?php

namespace App\Models;

use App\Models\Lokasi;
use App\Models\Hartamodal;
use App\Models\Abr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bangunan extends Model
{
    use HasFactory;
    protected $table="bangunans";

    public $timestamps=false;

    protected $fillable = [
        'id',
        'kod_bangunan',
        'nama_bangunan'
    ];

    public function lokasi()
    {
        return $this->hasMany('App\Models\Lokasi');
    }

    public function hartamodal()
    {
        return $this->hasMany('App\Models\Hartamodal');
    }

    public function abr()
    {
        return $this->hasMany('App\Models\Abr');
    }
}
