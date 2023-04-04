<?php

namespace App\Exports;

use App\Models\Atarosak;
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

class AtarosakExport implements FromQuery, WithHeadings, WithMapping
{
    
    public function headings(): array
    {
        return [
            'id',
            'Bangunan',
            'Kod Dan Nama Ruang',
            'Nama Komponen Utama',
            'Kuantiti Keseluruhan Dalam Ruang',
            'Diskripsi',
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
        return Atarosak::query()->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC');
    }
    public function map($atarosak): array
    {
        if ($atarosak->keutamaan == 1){
            $nama_keutamaan="Umum";
        }elseif ($atarosak->keutamaan == 2){
            $nama_keutamaan="Segera";
        }else {
            $nama_keutamaan="Kecemasan";
        }

        $kod_lokasi_ata = $atarosak->asetalih->kod_lokasi_ata ?? null;
        $kod_lokasi_ata .= " - ";
        $kod_lokasi_ata .= $atarosak->asetalih->asetalih_data->nama_lokasi ?? null;

        return [
            $atarosak->id,
            $atarosak->asetalih->asetalih_data->bangunan->nama_bangunan ?? null,
            $kod_lokasi_ata,
            /* $atarosak->asetalih->asetalih_data->nama_lokasi ?? null, */
            $atarosak->asetalih->nama_komponen ?? null,
            $atarosak->asetalih->kuantiti ?? null,
            $atarosak->asetalih->diskripsi ?? null,
            $atarosak->skop ?? null,
            $nama_keutamaan ?? null,
            $atarosak->tarikh_rosak ?? null,
            $atarosak->prihal_rosak ?? null,
            $atarosak->kakitangan->nama,
            $atarosak->nama_2->nama ?? null,
            $atarosak->jenis_kerja ?? null,
            $atarosak->ulas_siasat ?? null,
            $atarosak->tarikh_siasat ?? null,
            $atarosak->perihal_kerja ?? null,
            $atarosak->tarikh_mula ?? null,
            $atarosak->statusrosak->nama_status ?? null,
            $atarosak->tahun ?? null,
            $atarosak->tarikh_siap ?? null,

        ];
    }
}
