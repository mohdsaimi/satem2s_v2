<?php

namespace App\Models;

use App\Models\Lokasi;
use App\Models\Bangunan;
use App\Models\Status_alat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abr extends Model
{
    use HasFactory;
    protected $table="abr";

    public $timestamps=false;

    protected $fillable = [
  
        'id',
        'no_siri_daftar',
        'barkod',
        'kod_nasional',
        'kategori',
        'sub_kategori',
        'jenis',
        'jenama',
        'butiran',
        'no_vot',
        'no_rujukan_fail',
        'catatan',
        'no_psn_krjn',
        'no_ptj',
        'sumber_peruntukan',
        'kos',
        'lokasi_asal',
        'bahagian_pengguna',
        'pengguna',
        'status_alat_id',
        'perolehan',
        'tarikh_belian',
        'no_chasis',
        'no_engine',
        'lokasi_id',
        'bangunan_id',
        'kod_lokasi',
        'aras',
        'nama_ruang',
        'selenggara'

    ];

    public function bangunan()
    {
        return $this->belongsTo('App\Models\Bangunan');
    }
    public function lokasi()
    {
        return $this->belongsTo('App\Models\Lokasi');
    }
    public function status_alat()
    {
        return $this->belongsTo('App\Models\Status_alat');
    }
    public function abrrosak()
    {
        return $this->hasMany('App\Models\Abrrosak');
    }
}
