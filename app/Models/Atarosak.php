<?php

namespace App\Models;

use App\Models\Asetalih;
use App\Domains\Auth\Models\User;
use Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atarosak extends Model
{
    use HasFactory;

    protected $table="atarosak";

    public $timestamps=false;

    protected $fillable = [

        'asetalih_id',
        'user_id',
        'no_tel',
        'bahagian',
        'tarikh_rosak',
        'skop',
        'mod_aduan',
        'keutamaan',
        'prihal_rosak',
        'pic_1',
        'pic_2',
        'pic_3',
        'user_terima',
        'tarikh_terima',
        'jenis_kerja',
        'user_siasat',
        'tarikh_siasat',
        'ulas_siasat',
        'jenis_1',
        'harga_1',
        'kuantiti_1',
        'jumlah_1',
        'jenis_2',
        'harga_2',
        'kuantiti_2',
        'jumlah_2',
        'jenis_3',
        'harga_3',
        'kuantiti_3',
        'jumlah_3',
        'perihal_kerja',
        'tarikh_mula',
        'tarikh_siap',
        'status',
        'tahun'

    ];

    public function asetalih()
    {
        return $this->belongsTo('App\Models\Asetalih', 'asetalih_id', 'id');
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
        return $this->belongsTo('App\Models\Kakitangan', 'user_terima', 'id');
    }
    public function nama_2()
    {
        return $this->belongsTo('App\Models\Kakitangan', 'user_siasat', 'id');
    }
    public function nama_3()
    {
        return $this->belongsTo('App\Models\Kakitangan', 'user_tugas', 'id');
    }
    public function nama_syor()
    {
        return $this->belongsTo('App\Domains\Auth\Models\User', 'user_terima', 'id');
        /* return $this->hasOne("User"); */
    }

}
