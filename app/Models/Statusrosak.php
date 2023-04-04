<?php

namespace App\Models;
use App\Models\Hmrosak;
use App\Models\Atarosak;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statusrosak extends Model
{
    use HasFactory;

    protected $table="statusrosak";

    public $timestamps=false;

    protected $fillable = [
        'id',
        'nama_status'
    ];

    public function hmrosak()
    {
        return $this->hasMany('App\Models\Hmrosak');
    }

    public function atarosak()
    {
        return $this->hasMany('App\Models\Atarosak');
    }
}
