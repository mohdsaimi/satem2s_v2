<?php

namespace App\Exports;

use App\Models\Strrosak;
use App\Models\Asetalih;
use App\Models\Bangunan;
use App\Models\Kakitangan;
use App\Models\Lokasi;
use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class StrrosakExport implements FromQuery, WithHeadings, WithMapping
{
    
    public function headings(): array
    {
        return [
            'id',
            'Bangunan',
            'Kod Dan Nama Ruang',
            'Nama Komponen Utama',
/*             'Kuantiti Keseluruhan Dalam Ruang',
            'Diskripsi', */
            'Skop Perkhidmatan',
            'Keutamaan',
            'Tarikh Aduan',
            'Keterangan Kerosakan',
            'Pelapor',
            'PIC',
            'Jenis Kerja',
            'Ulasan Kerosakan',
            'Tarikh Siasatan',
            'Perihal Kerja / Tindakan',
            'Tarikh Mula',
            'Status',
            'Tahun Perolehan/Pelupusan',
            'Tarikh Tamat/Selesai'

        ];
    }

    public function query()
    {
        return Strrosak::query()->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC');
    }
    public function map($strrosak): array
    {
        if ($strrosak->keutamaan == 1){
            $nama_keutamaan="Umum";
        }elseif ($strrosak->keutamaan == 2){
            $nama_keutamaan="Segera";
        }else {
            $nama_keutamaan="Kecemasan";
        }

        $kod_lokasi_str = $strrosak->lokasi->bangunan->kod_bangunan;
        $kod_lokasi_str .= ".";
        $kod_lokasi_str .= $strrosak->lokasi->aras;
        $kod_lokasi_str .= ".";
        $kod_lokasi_str .= $strrosak->lokasi->kod_lokasi;
        $kod_lokasi_str .= " - ";
        $kod_lokasi_str .= $strrosak->lokasi->nama_lokasi;
        /* $kod_lokasi_str = $strrosak->lokasi->bangunan->kod_bangunan.$strrosak->lokasi->aras.$strrosak->lokasi->kod_lokasi - $strrosak->lokasi->nama_lokasi; */

        return [
            $strrosak->id,
            $strrosak->lokasi->bangunan->nama_bangunan ?? null,
            $kod_lokasi_str,
            $strrosak->nama_kekemasan ?? null,
/*             $atarosak->asetalih->kuantiti ?? null,
            $atarosak->asetalih->diskripsi ?? null, */
            $strrosak->skop ?? null,
            $nama_keutamaan ?? null,
            $strrosak->tarikh_rosak ?? null,
            $strrosak->prihal_rosak ?? null,
            $strrosak->kakitangan->nama,
            $strrosak->nama_2->nama ?? null,
            $strrosak->jenis_kerja ?? null,
            $strrosak->ulas_siasat ?? null,
            $strrosak->tarikh_siasat ?? null,
            $strrosak->perihal_kerja ?? null,
            $strrosak->tarikh_mula ?? null,
            $strrosak->statusrosak->nama_status ?? null,
            $strrosak->tahun ?? null,
            $strrosak->tarikh_siap ?? null,

        ];
    }
}
