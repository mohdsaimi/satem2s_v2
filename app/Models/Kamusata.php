<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamusata extends Model
{
    use HasFactory;
    protected $table="kamus_komponen";

    public $timestamps=false;

    protected $fillable = [

        'id',
        'kod_kom',
        'komponen',
        'kod_kej',
        'nama_kej',
        'kod_sistem',
        'sistem',
        'kod_subsistem',
        'sub_sistem',
        'nama_komponen',
        'no_1gfmas',
        'tarikh_perolehan',
        'kos_perolehan',
        'no_lo',
        'kod_ptj',
        'tarikh_pasang',
        'tarikh_waranti_end',
        'tarikh_tamat_dlp',
        'jangka_hayat',
        'pengilang',
        'pembekal',
        'alamat',
        'no_tel',
        'kontraktor',
        'alamat_kon',
        'no_tel_kon',
        'catatan_1',
        'diskripsi',
        'status_kom',
        'jenama',
        'model',
        'no_siri',
        'label_kom',
        'no_sijil_pendaftaran',
        'catatan_2',
        'jenis',
        'bekalan_ele',
        'bahan',
        'kaedah_pasang',
        'saiz_1',
        'unit_1',
        'saiz_2',
        'unit_2',
        'saiz_3',
        'unit_3',
        'kapasiti_1',
        'unit_kap_1',
        'kapasiti_2',
        'unit_kap_2',
        'kapasiti_3',
        'unit_kap_3',
        'kadaran_1',
        'unit_kadar_1',
        'kadaran_2',
        'unit_kadar_2',
        'kadaran_3',
        'unit_kadar_3',
        'kadaran_4',
        'unit_kadar_4',
        'kadaran_5',
        'unit_kadar_5',
        'catatan_3',
        'view',
        'pic'

    ];
}
