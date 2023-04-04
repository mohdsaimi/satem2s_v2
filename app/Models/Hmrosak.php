<?php

namespace App\Models;

use App\Models\Hartamodal;
use App\Domains\Auth\Models\User;
use Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hmrosak extends Model
{
    use HasFactory;

    protected $table="hmrosak";

    public $timestamps=false;

    protected $fillable = [
  
        'harta_modal_id',
        'penguna_akhir',
        'tarikh_rosak',
        'prihal_rosak',
        'user_id',
        'tarikh_aduan',
        'pic_1',
        'pic_2',
        'pic_3',
        'kos_dulu',
        'kos_anggar',
        'syor',
        'user_syor',
        'tarikh_syor',
        'keputusan',
        'ulasan',
        'user_ulasan',
        'tarikh_ulasan',
        'status',
        'user_asign',
        'tarikh_asign',
        'nota_tindakan',
        'tarikh_tindakan',
        'tahun',
        'tarikh_siap'

    ];

    public function hartamodal()
    {
        return $this->belongsTo('App\Models\Hartamodal', 'harta_modal_id', 'id');
    }
    public function kakitangan()
    {
        return $this->belongsTo('App\Models\Kakitangan', 'user_id', 'id');
    }
    public function statusrosak()
    {
        return $this->belongsTo('App\Models\Statusrosak', 'status', 'id');
    }
    public function nama_1()
    {
        return $this->belongsTo('App\Models\Kakitangan', 'user_asign', 'id');
    }

    public function nama_syor()
    {
        return $this->belongsTo('App\Domains\Auth\Models\User', 'user_syor', 'id');
        /* return $this->hasOne("User"); */
    }

}
