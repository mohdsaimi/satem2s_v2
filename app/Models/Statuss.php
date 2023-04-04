<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuss extends Model
{
    use HasFactory;

    protected $table="statuss";

    public $timestamps=false;

    protected $fillable = [
        'id',
        'nama_status'
    ];

    public function student()
    {
        return $this->hasMany('App\Models\Students');
    }
}
