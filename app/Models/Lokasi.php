<?php

namespace App\Models;

use App\Models\Bangunan;
use App\Models\Hartamodal;
use App\Models\Abr;
use App\Models\Asetalih;
use App\Models\Kakitangan;
use App\Models\Strrosak;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $table="lokasi_bangunans";

    public $timestamps=false;

    protected $fillable = [
        'id',
        'bangunan_id',
        'aras',
        'kod_lokasi',
        'nama_lokasi',
        'nama_1',
        'nama_2',
        'catatan',
        'selangar_struktur'

    ];

    public function bangunan()
    {
        return $this->belongsTo('App\Models\Bangunan');
    }
    public function hartamodal()
    {
        return $this->hasMany('App\Models\Hartamodal');
    }
    public function abr()
    {
        return $this->hasMany('App\Models\Abr');
    }
    public function asetalih()
    {
        return $this->hasMany('App\Models\Asetalih');
    }
    public function nama_bangunan()
    {
        return $this->belongsTo('App\Models\Bangunan', 'bangunan_id', 'id');
    }
    public function nama_pengumpul()
    {
        return $this->belongsTo('App\Models\Kakitangan', 'nama_1', 'id');
    }
    public function nama_pengesah()
    {
        return $this->belongsTo('App\Models\Kakitangan', 'nama_2', 'id');
    }
    public function strrosak()
    {
        return $this->hasMany('App\Models\Strrosak');
    }
}
