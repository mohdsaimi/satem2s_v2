<?php

namespace App\Exports;

use App\Models\Abrrosak;
use App\Models\Abr;
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

class AbrrosakExport implements FromQuery, WithHeadings, WithMapping
{
    
    public function headings(): array
    {
        return [
            
            'id',
            'No. Siri Pendaftaran',
            'Jenis Aset',
            'Butiran Aset',
            'Penguna Akhir',
            'Tarikh Rosak',
            'Prihal Rosak',
            'Pelapor',
            'Tarikh Aduan',
            'Kos Penyelenggaraan Terdahulu',
            'Kos Anggaran',
            'Syor',
            'Nama Pegawai Syor',
            'Tarikh Syor',
            'Status',
            'PIC',
            'Tarikh Tugasan',
            'Nota Tindakan',
            'Tarikh Tindakan',
            'Tahun',
            'Tarikh Selesai'
        // etc
        ];
    }

    public function query()
    {
        return Abrrosak::query()->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC');
    }
    public function map($abrrosak): array
    {
        return [
            $abrrosak->id,
            $abrrosak->abr->no_siri_daftar,
            $abrrosak->abr->jenis ?? null,
            $abrrosak->abr->butiran ?? null,
            $abrrosak->penguna_akhir,
            $abrrosak->tarikh_rosak,
            $abrrosak->prihal_rosak,
            $abrrosak->kakitangan->nama,
            $abrrosak->tarikh_aduan,
            $abrrosak->kos_dulu,
            $abrrosak->kos_anggar,
            $abrrosak->syor,
            $abrrosak->nama_syor->name ?? null,
            $abrrosak->tarikh_syor,
            $abrrosak->statusrosak->nama_status,
            $abrrosak->nama_1->nama  ?? null,
            $abrrosak->tarikh_asign,
            $abrrosak->nota_tindakan,
            $abrrosak->tarikh_tindakan,
            $abrrosak->tahun,
            $abrrosak->tarikh_siap,
        ];
    }
}
