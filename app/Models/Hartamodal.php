<?php

namespace App\Models;

use App\Models\Lokasi;
use App\Models\Bangunan;
use App\Models\Status_alat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hartamodal extends Model
{
    use HasFactory;

    protected $table="harta_modal";

    public $timestamps=false;

    protected $fillable = [
  
        'id',
        'no_siri_pendaftaran',
        'no_barkod',
        'kod_nasional',
        'kategori',
        'sub_kategori',
        'jenis',
        'jenama',
        'no_PTJ_bahagian',
        'jenis_no_enjin',
        'no_casis_siri_pembuat',
        'no_siri_pendaftaran_ken',
        'no_VOT',
        'no_rujukan_fail',
        'no_psn_krjn',
        'sumber_peruntukan',
        'kos',
        'bahagian_pengguna_asal',
        'pengguna_asal',
        'status_alat_id',
        'perolehan',
        'tarikh_beli',
        'kod_lokasi_asal',
        'bangunan_id',
        'aras',
        'kod_lokasi',
        'lokasi_id'

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
    public function hmrosak()
    {
        return $this->hasMany('App\Models\Hmrosak');
    }
}
