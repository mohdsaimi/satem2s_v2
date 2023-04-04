<?php

namespace App\Models;

use App\Models\Abr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abrlupus extends Model
{
    use HasFactory;

    protected $table="abrlupus";

    public $timestamps=false;

    protected $fillable = [
  
        'abr_id',
        'prestasi',
        'kod_dulu',
        'nilai_semasa',
        'user_id',
        'tarikh_pohon',
        'kewpa4',
        'pic_1',
        'pic_2',
        'pic_3',
        'jus_1',
        'jus_2',
        'jus_3',
        'kaedah_lupus',
        'tahun_lupus',
        'status'

    ];

    public function abr()
    {
        return $this->belongsTo('App\Models\Abr', 'abr_id', 'id');
    }
    public function kakitangan()
    {
        return $this->belongsTo('App\Models\Kakitangan', 'user_id', 'id');
    }
    /* public function statusrosak()
    {
        return $this->belongsTo('App\Models\Statusrosak', 'status', 'id');
    }
    public function nama_1()
    {
        return $this->belongsTo('App\Models\Kakitangan', 'user_asign', 'id');
    }
 */
}
