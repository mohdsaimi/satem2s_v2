<?php

namespace App\Exports;

use App\Models\Hmrosak;
use App\Models\Hartamodal;
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

class HmrosakExport implements FromQuery, WithHeadings, WithMapping
{
    
    public function headings(): array
    {
        return [
            'id',
            'No. Siri Pendaftaran',
            'Jenis Aset',
            'Penguna Akhir',
            'Tarikh Rosak',
            'Prihal Rosak',
            'Pelapor',
            'Tarikh Aduan',
            /* 'pic_1',
            'pic_2',
            'pic_3', */
            'Kos Penyelenggaraan Terdahulu',
            'Kos Anggaran',
            'Syor',
            'Nama Pegawai Syor',
            'Tarikh Syor',
            /* 'Keputusan',
            'Ulasan',
            'Pegawai Ulasan',
            'Tarikh Ulasan', */
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
        return Hmrosak::query()->where('status','<',7)->orderBy('status','ASC')->orderBy('id','ASC');
    }
    public function map($hmrosak): array
    {
        return [
            $hmrosak->id,
            $hmrosak->hartamodal->no_siri_pendaftaran,
            $hmrosak->hartamodal->jenis,
            $hmrosak->penguna_akhir,
            $hmrosak->tarikh_rosak,
            $hmrosak->prihal_rosak,
            $hmrosak->kakitangan->nama,
            $hmrosak->tarikh_aduan,
            /* $hmrosak->pic_1,
            $hmrosak->pic_2,
            $hmrosak->pic_3, */
            $hmrosak->kos_dulu,
            $hmrosak->kos_anggar,
            $hmrosak->syor,
            $hmrosak->nama_syor->name ?? null,
            $hmrosak->tarikh_syor,
            /* $hmrosak->keputusan,
            $hmrosak->ulasan,
            $hmrosak->user_ulasan,
            $hmrosak->tarikh_ulasan, */
            $hmrosak->statusrosak->nama_status,
            $hmrosak->nama_1->nama ?? null,
            $hmrosak->tarikh_asign,
            $hmrosak->nota_tindakan,
            $hmrosak->tarikh_tindakan,
            $hmrosak->tahun,
            $hmrosak->tarikh_siap,
        ];
    }
}
