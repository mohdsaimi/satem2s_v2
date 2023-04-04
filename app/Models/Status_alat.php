<?php

namespace App\Models;
use App\Models\Hartamodal;
use App\Models\Abr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_alat extends Model
{
    use HasFactory;

    protected $table="status_alat";

    public $timestamps=false;

    protected $fillable = [
        'id',
        'nama_status'
    ];

    public function hartamodal()
    {
        return $this->hasMany('App\Models\Hartamodal');
    }
    public function abr()
    {
        return $this->hasMany('App\Models\Abr');
    }
}
