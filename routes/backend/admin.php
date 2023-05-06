<?php

use App\Http\Controllers\Backend\DashboardController;
use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Backend\LokasiController;
use App\Http\Controllers\Backend\HartamodalController;
use App\Http\Controllers\Backend\HmrosakController;
use App\Http\Controllers\Backend\AtaController;
use App\Http\Controllers\Backend\AbrController;
use App\Http\Controllers\Backend\AbrrosakController;
use App\Http\Controllers\Backend\KamusataController;
use App\Http\Controllers\Backend\AsetalihController;
use App\Http\Controllers\Backend\AtarosakController;
use App\Http\Controllers\Backend\StrrosakController;
use App\Models\Courses;
use App\Models\Students;
use App\Models\Lokasi;
use App\Models\Bangunan;
use App\Models\Hartamodal;
use App\Models\Hmrosak;
use App\Models\Hmlupus;
use App\Models\Ata;
use App\Models\Abr;
use App\Models\Abrrosak;
use App\Models\Abrlupus;
use App\Models\Kamusata;
use App\Models\Asetalih;
use App\Models\Atarosak;
use App\Models\Strrosak;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });



// Administrator only
Route::group([
        'middleware' => 'role:'.config('boilerplate.access.role.admin'),
], function () {

        
    /* rfid*/
    Route::get('rfid', [StudentController::class, 'index_RFID'])->name('rfid')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Pengurusan RFID'), route('admin.rfid'));
    });

    Route::get('editrfid/{student}', [StudentController::class, 'edit_RFID'])->name('editrfid')
        ->breadcrumbs(function (Trail $trail, Students $student) {
            $trail->parent('admin.rfid')
                ->push(__('Edit RFID Pelajar'), route('admin.editrfid', $student));
        });
    Route::patch('updaterfid/{student}', [StudentController::class, 'update_RFID'])->name('updaterfid');
    /* end rfid*/

});

// Administrator & BPPA only
Route::group([
    'middleware' => 'role:bppa|'.config('boilerplate.access.role.admin'),
], function () {

    /* lokasi */
    Route::get('lokasi', [LokasiController::class, 'index'])->name('lokasi')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                ->push(__('Pengurusan Lokasi Ruang'), route('admin.lokasi'));
        });
    Route::get('createlokasi', [LokasiController::class, 'create'])->name('createlokasi')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.lokasi')
                ->push(__('Tambah Lokasi Ruang'), route('admin.createlokasi'));
        });
    Route::post('storelokasi', [LokasiController::class, 'store'])->name('storelokasi');
    Route::get('editlokasi/{lokasis}', [LokasiController::class, 'edit'])->name('editlokasi')
        ->breadcrumbs(function (Trail $trail, Lokasi $lokasis) {
            $trail->parent('admin.lokasi')
                ->push(__('Edit Lokasi Ruang'), route('admin.editlokasi', $lokasis));
        });
    Route::patch('updatelokasi/{lokasis}', [LokasiController::class, 'update'])->name('updatelokasi');
    Route::delete('destroylokasi/{lokasis}', [LokasiController::class, 'destroy'])->name('destroylokasi');
    /* end lokasi*/
    /* harta modal */
    Route::get('hartamodal', [HartamodalController::class, 'index'])->name('hartamodal')
        ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Senarai Harta Modal'), route('admin.hartamodal'));
        });
    Route::get('showhartamodal/{hartamodal}', [HartamodalController::class, 'show'])->name('showhartamodal')
        ->breadcrumbs(function (Trail $trail, Hartamodal $hartamodal) {
            $trail->parent('admin.hartamodal')
                ->push(__('Maklumat Harta Modal'), route('admin.showhartamodal', $hartamodal));
        });
    Route::get('edithartamodal/{hartamodal}', [HartamodalController::class, 'edit'])->name('edithartamodal')
        ->breadcrumbs(function (Trail $trail, Hartamodal $hartamodal) {
            $trail->parent('admin.hartamodal')
                ->push(__('Edit Harta Modal'), route('admin.edithartamodal', $hartamodal));
        });
    Route::patch('updatehartamodal/{hartamodal}', [HartamodalController::class, 'update'])->name('updatehartamodal');
    Route::get('aduanhartamodal/{hartamodal}', [HartamodalController::class, 'aduan'])->name('aduanhartamodal')
        ->breadcrumbs(function (Trail $trail, Hartamodal $hartamodal) {
            $trail->parent('admin.hartamodal')
                ->push(__('Aduan Kerosakan Harta Modal'), route('admin.aduanhartamodal', $hartamodal));
        });
    /* end harta modal */
    /* ABR */
    Route::get('abr', [AbrController::class, 'index'])->name('abr')
        ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Senarai Aset Bernilai Rendah'), route('admin.abr'));
    });

    Route::get('showabr/{abr}', [AbrController::class, 'show'])->name('showabr')
        ->breadcrumbs(function (Trail $trail, Abr $abr) {
            $trail->parent('admin.abr')
                ->push(__('Maklumat Aset Bernilai Rendah'), route('admin.showabr', $abr));
    });

    Route::get('editabr/{abr}', [AbrController::class, 'edit'])->name('editabr')
        ->breadcrumbs(function (Trail $trail, Abr $abr) {
            $trail->parent('admin.abr')
                ->push(__('Edit Aset Bernilai Rendah'), route('admin.editabr', $abr));
    });

    Route::patch('updateabr/{abr}', [AbrController::class, 'update'])->name('updateabr');

    Route::get('aduanabr/{abr}', [AbrController::class, 'aduan'])->name('aduanabr')
        ->breadcrumbs(function (Trail $trail, Abr $abr) {
            $trail->parent('admin.abr')
                ->push(__('Aduan Kerosakan ABR'), route('admin.aduanabr', $abr));
    });

    /* end ABR */
    /* hmrosak */
    Route::get('hmrosak', [HmrosakController::class, 'index'])->name('hmrosak')
        ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Senarai Aduan Kerosakan Aset Alih (Harta Modal)'), route('admin.hmrosak'));
        });
    Route::post('storehmrosak', [HmrosakController::class, 'store'])->name('storehmrosak');

    Route::get('showhmrosak/{hmrosak}', [HmrosakController::class, 'show'])->name('showhmrosak')
        ->breadcrumbs(function (Trail $trail, Hmrosak $hmrosak) {
            $trail->parent('admin.hmrosak')
                ->push(__('Maklumat Harta Modal'), route('admin.showhmrosak', $hmrosak));
        });
    Route::patch('updatehmrosak/{hmrosak}', [HmrosakController::class, 'update'])->name('updatehmrosak');
    Route::get('hmrosak_selesai', [HmrosakController::class, 'index_selesai'])->name('hmrosak_selesai')
    ->breadcrumbs(function (Trail $trail) {
    $trail->parent('admin.dashboard')
        ->push(__('Senarai Aduan Kerosakan Aset Alih (Harta Modal) - Selesai'), route('admin.hmrosak_selesai'));
    });
    Route::get('showhmrosak_selesai/{hmrosak}', [HmrosakController::class, 'show_selesai'])->name('showhmrosak_selesai')
        ->breadcrumbs(function (Trail $trail, Hmrosak $hmrosak) {
            $trail->parent('admin.hmrosak_selesai')
                ->push(__('Maklumat Aduan Kerosakan (HM) - Selesai'), route('admin.showhmrosak_selesai', $hmrosak));
    });
    Route::get('pdfhmrosak/{hmrosak}', [HmrosakController::class, 'createPDF'])->name('pdfhmrosak')
        ->breadcrumbs(function (Trail $trail, Hmrosak $hmrosak) {
            $trail->parent('admin.hmrosak')
                ->push(__('Borang Aduan Kerosakan Aset Alih'), route('admin.pdfhmrosak'));
        });

    Route::get('syorhmrosak/{hmrosak}', [HmrosakController::class, 'syor'])->name('syorhmrosak')
    ->breadcrumbs(function (Trail $trail, Hmrosak $hmrosak) {
        $trail->parent('admin.hmrosak')
            ->push(__('Maklumat Syor Aduan Harta Modal'), route('admin.syorhmrosak', $hmrosak));
    });

    Route::patch('updatesyor/{hmrosak}', [HmrosakController::class, 'updatesyor'])->name('updatesyor');

    Route::get('syor2hmrosak/{hmrosak}', [HmrosakController::class, 'syor2'])->name('syor2hmrosak')
    ->breadcrumbs(function (Trail $trail, Hmrosak $hmrosak) {
        $trail->parent('admin.hmrosak')
            ->push(__('Maklumat Syor Aduan Harta Modal'), route('admin.syor2hmrosak', $hmrosak));
    });

    Route::patch('updatesyor2/{hmrosak}', [HmrosakController::class, 'updatesyor2'])->name('updatesyor2');

    Route::get('export', [HmrosakController::class, 'export'])->name('export'); /* excel */

    /* end hmrosak */
    /* Abrrosak */
    Route::get('abrrosak', [AbrrosakController::class, 'index'])->name('abrrosak')
    ->breadcrumbs(function (Trail $trail) {
    $trail->parent('admin.dashboard')
        ->push(__('Senarai Aduan Kerosakan Aset Alih (ABR)'), route('admin.abrrosak'));
    });

    Route::post('storeabrrosak', [AbrrosakController::class, 'store'])->name('storeabrrosak');

    Route::get('showabrrosak/{abrrosak}', [AbrrosakController::class, 'show'])->name('showabrrosak')
        ->breadcrumbs(function (Trail $trail, Abrrosak $abrrosak) {
            $trail->parent('admin.abrrosak')
                ->push(__('Maklumat Aset Bernilai Rendah'), route('admin.showabrrosak', $abrrosak));
    });

    Route::patch('updateabrrosak/{abrrosak}', [AbrrosakController::class, 'update'])->name('updateabrrosak');

    Route::get('pdfabrrosak/{abrrosak}', [AbrrosakController::class, 'createPDF'])->name('pdfabrrosak')
        ->breadcrumbs(function (Trail $trail, Abrrosak $abrrosak) {
            $trail->parent('admin.abrrosak')
                ->push(__('Borang Aduan Kerosakan Aset Alih'), route('admin.pdfabrrosak'));
    });

    Route::get('syorabrrosak/{abrrosak}', [AbrrosakController::class, 'syor'])->name('syorabrrosak')
    ->breadcrumbs(function (Trail $trail, Abrrosak $abrrosak) {
        $trail->parent('admin.abrrosak')
            ->push(__('Maklumat Syor Aduan ABR'), route('admin.syorabrrosak', $abrrosak));
    });

    Route::patch('updatesyorabr/{abrrosak}', [AbrrosakController::class, 'updatesyorabr'])->name('updatesyorabr');

    Route::get('syor2abrrosak/{abrrosak}', [AbrrosakController::class, 'syor2'])->name('syor2abrrosak')
    ->breadcrumbs(function (Trail $trail, Abrrosak $abrrosak) {
        $trail->parent('admin.abrrosak')
            ->push(__('Maklumat Syor Aduan ABR'), route('admin.syor2abrrosak', $abrrosak));
    });

    Route::patch('updatesyor2abr/{abrrosak}', [AbrrosakController::class, 'updatesyor2abr'])->name('updatesyor2abr');

    Route::get('abrrosak_selesai', [AbrrosakController::class, 'index_selesai'])->name('abrrosak_selesai')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Senarai Aduan Kerosakan Aset Alih (ABR) - Selesai'), route('admin.abrrosak_selesai'));
    });

    Route::get('showabrrosak_selesai/{abrrosak}', [AbrrosakController::class, 'show_selesai'])->name('showabrrosak_selesai')
        ->breadcrumbs(function (Trail $trail, Abrrosak $abrrosak) {
            $trail->parent('admin.abrrosak_selesai')
                ->push(__('Maklumat Aduan Kerosakan (ABR) - Selesai'), route('admin.showabrrosak_selesai', $abrrosak));
    });

    Route::get('exportabr', [AbrrosakController::class, 'export'])->name('exportabr'); /* excel */

    /* end Abrrosak */

    /* ATArosak */

    Route::get('atarosak', [AtarosakController::class, 'index'])->name('atarosak')
    ->breadcrumbs(function (Trail $trail) {
    $trail->parent('admin.dashboard')
        ->push(__('Senarai Aduan Kerosakan Aset Tak Alih'), route('admin.atarosak'));
    });
    
    Route::get('aduan_ata/{asetalih}', [AsetalihController::class, 'aduan'])->name('aduan_ata')
    ->breadcrumbs(function (Trail $trail, Asetalih $asetalih) {
        $trail->parent('admin.asetalih')
            ->push(__('Aduan Komponen Aset Tak Alih'), route('admin.aduan_ata', $asetalih));
    });
    
    Route::post('storeatarosak', [AtarosakController::class, 'store'])->name('storeatarosak');
    
    Route::get('showatarosak/{atarosak}', [AtarosakController::class, 'show'])->name('showatarosak')
        ->breadcrumbs(function (Trail $trail, Atarosak $atarosak) {
            $trail->parent('admin.atarosak')
                ->push(__('Maklumat Aset Tak Alih'), route('admin.showatarosak', $atarosak));
        });

    Route::patch('updateatarosak/{atarosak}', [AtarosakController::class, 'update'])->name('updateatarosak');

    Route::get('syoratarosak/{atarosak}', [AtarosakController::class, 'syor'])->name('syoratarosak')
    ->breadcrumbs(function (Trail $trail, Atarosak $atarosak) {
        $trail->parent('admin.atarosak')
            ->push(__('Maklumat Syor Aduan Aset Tak Alih'), route('admin.syoratarosak', $atarosak));
    });

    Route::patch('updateatasyor/{atarosak}', [AtarosakController::class, 'updatesyor'])->name('updateatasyor');

    Route::get('syor2atarosak/{atarosak}', [AtarosakController::class, 'syor2'])->name('syor2atarosak')
    ->breadcrumbs(function (Trail $trail, Atarosak $atarosak) {
        $trail->parent('admin.atarosak')
            ->push(__('Maklumat Syor Aduan Aset Tak Alih'), route('admin.syor2atarosak', $atarosak));
    });

    Route::patch('updateatasyor2/{atarosak}', [AtarosakController::class, 'updatesyor2'])->name('updateatasyor2');

    Route::get('atarosak_selesai', [AtarosakController::class, 'index_selesai'])->name('atarosak_selesai')
    ->breadcrumbs(function (Trail $trail) {
    $trail->parent('admin.dashboard')
        ->push(__('Senarai Aduan Kerosakan Aset Tak Alih - Selesai'), route('admin.atarosak_selesai'));
    });
    Route::get('showatarosak_selesai/{atarosak}', [AtarosakController::class, 'show_selesai'])->name('showatarosak_selesai')
        ->breadcrumbs(function (Trail $trail, Atarosak $atarosak) {
            $trail->parent('admin.atarosak_selesai')
                ->push(__('Maklumat Aduan Kerosakan (ATA) - Selesai'), route('admin.showatarosak_selesai', $atarosak));
    });

    Route::get('exportata', [AtarosakController::class, 'export'])->name('exportata'); /* excel */

    Route::get('pdfatarosak/{atarosak}', [AtarosakController::class, 'createPDF'])->name('pdfatarosak')
    ->breadcrumbs(function (Trail $trail, Atarosak $atarosak) {
        $trail->parent('admin.atarosak')
            ->push(__('Borang Aduan Kerosakan Aset Tak Alih'), route('admin.pdfatarosak'));
    });

    /* end ATArosak */

    /* ATA rosak Struktur */

    Route::get('Strrosak', [StrrosakController::class, 'index'])->name('strrosak')
    ->breadcrumbs(function (Trail $trail) {
    $trail->parent('admin.dashboard')
        ->push(__('Senarai Aduan Kerosakan Aset Tak Alih (Struktur)'), route('admin.strrosak'));
    });

    Route::get('aduan_ata_str/{lokasi}', [AsetalihController::class, 'aduan_ata_str'])->name('aduan_ata_str')
        ->breadcrumbs(function (Trail $trail, Lokasi $lokasi) {
            $trail->parent('admin.asetalih')
                ->push(__('Aduan Komponen Aset Tak Alih - Struktur'), route('admin.aduan_ata_str', $lokasi));
    });

    Route::post('storestrrosak', [StrrosakController::class, 'store'])->name('storestrrosak');

    Route::get('showstrrosak/{strrosak}', [StrrosakController::class, 'show'])->name('showstrrosak')
    ->breadcrumbs(function (Trail $trail, Strrosak $strrosak) {
        $trail->parent('admin.strrosak')
            ->push(__('Maklumat Aset Tak Alih - Struktur'), route('admin.showstrrosak', $strrosak));
    });

    Route::patch('updatestrrosak/{strrosak}', [StrrosakController::class, 'update'])->name('updatestrrosak');

    Route::get('syorstrrosak/{strrosak}', [StrrosakController::class, 'syor'])->name('syorstrrosak')
    ->breadcrumbs(function (Trail $trail, Strrosak $strrosak) {
        $trail->parent('admin.strrosak')
            ->push(__('Maklumat Syor Aduan Aset Tak Alih - Struktur'), route('admin.syoratarosak', $strrosak));
    });

    Route::patch('updatestrsyor/{strrosak}', [StrrosakController::class, 'updatesyor'])->name('updatestrsyor');

    Route::get('syor2strrosak/{strrosak}', [StrrosakController::class, 'syor2'])->name('syor2strrosak')
    ->breadcrumbs(function (Trail $trail, Strrosak $strrosak) {
        $trail->parent('admin.strrosak')
            ->push(__('Maklumat Syor Aduan Aset Tak Alih - Struktur'), route('admin.syor2strrosak', $strrosak));
    });

    Route::patch('updatestrsyor2/{strrosak}', [StrrosakController::class, 'updatesyor2'])->name('updatestrsyor2');

    Route::get('pdfstrrosak/{strrosak}', [StrrosakController::class, 'createPDF'])->name('pdfstrrosak')
    ->breadcrumbs(function (Trail $trail, Strrosak $strrosak) {
        $trail->parent('admin.strrosak')
            ->push(__('Borang Aduan Kerosakan Aset Tak Alih - Struktur'), route('admin.pdfstrrosak'));
    });

    Route::get('exportstr', [StrrosakController::class, 'export'])->name('exportstr'); /* excel */

    Route::get('strrosak_selesai', [StrrosakController::class, 'index_selesai'])->name('strrosak_selesai')
    ->breadcrumbs(function (Trail $trail) {
    $trail->parent('admin.dashboard')
        ->push(__('Senarai Aduan Kerosakan Aset Tak Alih (Struktur) - Selesai'), route('admin.strrosak_selesai'));
    });
    Route::get('showstrrosak_selesai/{strrosak}', [StrrosakController::class, 'show_selesai'])->name('showstrrosak_selesai')
        ->breadcrumbs(function (Trail $trail, Strrosak $strrosak) {
            $trail->parent('admin.strrosak_selesai')
                ->push(__('Maklumat Aduan Kerosakan (ATA-Struktur) - Selesai'), route('admin.showstrrosak_selesai', $strrosak));
    });

    /* lokasi bangunan */
    Route::get('lokasibangunan', [StrrosakController::class, 'index_bangunan'])->name('lokasibangunan')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Lokasi Bangunan'), route('admin.lokasibangunan'));
    });
    /* lokasi bangunan */







    /* End ATA rosak Struktur */

    /* tetapan bppa */
    Route::get('bppa', [HartamodalController::class, 'bppa'])->name('bppa')
        ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Tetapan BPPA'), route('admin.bppa'));
    });
    Route::post('update_tetapan', [HartamodalController::class, 'update_tetapan'])->name('update_tetapan');
    /* end tetapan bppa */

    /* HM lupus */
    Route::get('hmlupus', [HmrosakController::class, 'index_lupus'])->name('hmlupus')
        ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Senarai Permohonan Pelupusan Aset Alih (Harta Modal)'), route('admin.hmlupus'));
    });

    Route::get('editlupus/{hmlupus}', [HmrosakController::class, 'edit_lupus'])->name('editlupus')
        ->breadcrumbs(function (Trail $trail, Hmlupus $hmlupus) {
            $trail->parent('admin.hmlupus')
                ->push(__('Edit Permohonan Pelupusan Aset Alih (Harta Modal)'), route('admin.editlupus', $hmlupus));
        });

    Route::patch('update_lupus/{hmlupus}', [HmrosakController::class, 'update_lupus'])->name('update_lupus');

    Route::get('pa19/{hmlupus}', [HmrosakController::class, 'createpa19'])->name('pa19')
        ->breadcrumbs(function (Trail $trail, Hmrosak $hmrosak) {
            $trail->parent('admin.hmlupus')
                ->push(__('Borang PEP'), route('admin.hmlupus'));
        });


    Route::get('mohonlupushm', [HmrosakController::class, 'index_mohonHM'])->name('mohonlupushm')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.hmlupus')
            ->push(__('Permohonan Perlupusan Aset Alih (Harta Modal)'), route('admin.mohonlupushm'));
    });

    Route::get('mohonlupushm1/{hartamodal}', [HmrosakController::class, 'lupushm'])->name('mohonlupushm1')
    ->breadcrumbs(function (Trail $trail, Hartamodal $hartamodal) {
        $trail->parent('admin.mohonlupushm')
            ->push(__('Permohonan Pelupusan Aset Alih (Harta Modal)'), route('admin.mohonlupushm1', $hartamodal));
    });

    Route::post('storehmlupus', [HmrosakController::class, 'storehmlupus'])->name('storehmlupus');

    /* end HM lupus */
    /* ABR lupus */
    Route::get('abrlupus', [AbrrosakController::class, 'index_lupus'])->name('abrlupus')
        ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Senarai Permohonan Pelupusan Aset Alih (ABR)'), route('admin.abrlupus'));
    });
    Route::get('mohonlupusabr', [AbrrosakController::class, 'index_mohonABR'])->name('mohonlupusabr')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.abrlupus')
            ->push(__('Permohonan Perlupusan Aset Alih (ABR)'), route('admin.mohonlupusabr'));
    });
    Route::get('mohonlupusabr1/{abr}', [AbrrosakController::class, 'lupusabr'])->name('mohonlupusabr1')
    ->breadcrumbs(function (Trail $trail, Abr $abr) {
        $trail->parent('admin.mohonlupusabr')
            ->push(__('Permohonan Pelupusan Aset Alih (ABR)'), route('admin.mohonlupusabr1', $abr));
    });
    Route::post('storeabrlupus', [AbrrosakController::class, 'storeabrlupus'])->name('storeabrlupus');

    Route::get('editlupusabr/{abrlupus}', [AbrrosakController::class, 'edit_lupusabr'])->name('editlupusabr')
        ->breadcrumbs(function (Trail $trail, Abrlupus $abrlupus) {
            $trail->parent('admin.abrlupus')
                ->push(__('Edit Permohonan Pelupusan Aset Alih (ABR)'), route('admin.editlupusabr', $abrlupus));
    });

    Route::patch('update_lupusabr/{abrlupus}', [AbrrosakController::class, 'update_lupusabr'])->name('update_lupusabr');

    /* end ABR lupus */

});

// Administrator, BPPL & TechTeam only
Route::group([
    'middleware' => 'role:administrator|bppl|techteam',
], function () {

    /* tindakan aduan HM */
    Route::get('hmrosaktin', [HmrosakController::class, 'index_tindakan'])->name('hmrosaktin')
        ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Senarai Aduan Kerosakan Aset Alih (Harta Modal)'), route('admin.hmrosaktin'));
    });
    Route::get('edithmrosak/{hmrosak}', [HmrosakController::class, 'edit'])->name('edithmrosak')
        ->breadcrumbs(function (Trail $trail, Hmrosak $hmrosak) {
            $trail->parent('admin.hmrosaktin')
                ->push(__('Maklumat Tindakan Aduan Harta Modal'), route('admin.edithmrosak', $hmrosak));
        });
    Route::patch('updatehmrosaktin/{hmrosak}', [HmrosakController::class, 'update_tindakan'])->name('updatehmrosaktin');

    /* end tindakan aduan HM */

    /* tindakan aduan ABR */
    Route::get('abrrosaktin', [AbrrosakController::class, 'index_tindakan'])->name('abrrosaktin')
        ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Senarai Aduan Kerosakan Aset Alih (ABR)'), route('admin.abrrosaktin'));
    });

    Route::get('editabrrosak/{abrrosak}', [AbrrosakController::class, 'edit'])->name('editabrrosak')
        ->breadcrumbs(function (Trail $trail, Abrrosak $abrrosak) {
            $trail->parent('admin.abrrosaktin')
                ->push(__('Maklumat Tindakan Aduan ABR'), route('admin.editabrrosak', $abrrosak));
    });

    Route::patch('updateabrrosaktin/{abrrosak}', [AbrrosakController::class, 'update_tindakan'])->name('updateabrrosaktin');

    /* end tindakan aduan ABR */

});

// Administrator & BKKL only
Route::group([
    'middleware' => 'role:administrator|bkkl',
], function () {

    


});

// Administrator & BPPL only
Route::group([
    'middleware' => 'role:administrator|bppl',
], function () {

    /* kursus */
    Route::get('course', [CourseController::class, 'index'])->name('course')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                ->push(__('Pengurusan Kursus'), route('admin.course'));
        });
    Route::get('createcourse', [CourseController::class, 'create'])->name('createcourse')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.course')
                ->push(__('Tambah Kursus'), route('admin.createcourse'));
        });
    Route::post('storecourse', [CourseController::class, 'store'])->name('storecourse');
    Route::get('editcourse/{course}', [CourseController::class, 'edit'])->name('editcourse')
        ->breadcrumbs(function (Trail $trail, Courses $course) {
            $trail->parent('admin.course')
                ->push(__('Edit Kursus'), route('admin.editcourse', $course));
        });
    Route::patch('updatecourse/{course}', [CourseController::class, 'update'])->name('updatecourse');
    Route::delete('destroycourse/{course}', [CourseController::class, 'destroy'])->name('destroycourse');
    /* endkursus */

    /* pelajar */
    Route::get('student', [StudentController::class, 'index'])->name('student')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                ->push(__('Pengurusan Pelajar'), route('admin.student'));
        });
    Route::get('showstudent/{student}', [StudentController::class, 'show'])->name('showstudent')
        ->breadcrumbs(function (Trail $trail, Students $student) {
            $trail->parent('admin.student')
                ->push(__('Maklumat Pelajar'), route('admin.showstudent', $student));
        });
    Route::get('createstudent', [StudentController::class, 'create'])->name('createstudent')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.student')
                ->push(__('Tambah Pelajar'), route('admin.createstudent'));
        });
    Route::post('storestudent', [StudentController::class, 'store'])->name('storestudent');
    Route::get('editstudent/{student}', [StudentController::class, 'edit'])->name('editstudent')
        ->breadcrumbs(function (Trail $trail, Students $student) {
            $trail->parent('admin.student')
                ->push(__('Edit Pelajar'), route('admin.editstudent', $student));
        });
    Route::patch('updatestudent/{student}', [StudentController::class, 'update'])->name('updatestudent');
    Route::delete('destroystudent/{student}', [StudentController::class, 'destroy'])->name('destroystudent');
    Route::get('edit_status_student/{student}', [StudentController::class, 'edit_status'])->name('edit_status_student')
        ->breadcrumbs(function (Trail $trail, Students $student) {
            $trail->parent('admin.student')
                ->push(__('Edit Status Pelajar'), route('admin.edit_status_student', $student));
        });
    Route::patch('update_status_student/{student}', [StudentController::class, 'update_status'])->name('update_status_student');
    /* endpelajar */

    /* semester */
    Route::get('semester', [StudentController::class, 'semester'])->name('semester')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Pengurusan Semester'), route('admin.semester'));
    });
    Route::post('update_semester', [StudentController::class, 'update_semester'])->name('update_semester');
    /* endsemester */

    /* DKP */
    Route::get('tetapan_dkp', [StudentController::class, 'tetapan_dkp'])->name('tetapan_dkp')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Pengurusan DKP'), route('admin.tetapan_dkp'));
    });

    Route::post('update_tetapan_dkp', [StudentController::class, 'update_tetapan_dkp'])->name('update_tetapan_dkp');
    /* endDKP */

});

// Administrator, BPPA & AtaTeam only
Route::group([
    'middleware' => 'role:bppa|atateam|'.config('boilerplate.access.role.admin'),
], function () {

    /* kod komponen */
    Route::get('ata', [AtaController::class, 'index'])->name('ata')
        ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Senarai Komponen Aset Tak Alih'), route('admin.ata'));
    });
    
    Route::get('enableata/{ata}', [AtaController::class, 'enableata'])->name('enableata');
    Route::get('disableata/{ata}', [AtaController::class, 'disableata'])->name('disableata');
    /* end kod komponen */

    /* kamus ata */
    Route::get('kamus_ata', [KamusataController::class, 'index'])->name('kamus_ata')
        ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Senarai Kamus Komponen Aset Tak Alih'), route('admin.kamus_ata'));
    });
    Route::get('createkamus', [KamusataController::class, 'create'])->name('createkamus')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.kamus_ata')
                ->push(__('Tambah Kamus Komponen Aset Tak Alih'), route('admin.createkamus'));
    });
    Route::post('storekamus', [KamusataController::class, 'store'])->name('storekamus');

    Route::get('enablekamusata/{kamusata}', [KamusataController::class, 'enablekamusata'])->name('enablekamusata');
    Route::get('disablekamusata/{kamusata}', [KamusataController::class, 'disablekamusata'])->name('disablekamusata');

    Route::get('editkamus/{kamusata}', [KamusataController::class, 'edit'])->name('editkamus')
        ->breadcrumbs(function (Trail $trail, Kamusata $kamusata) {
            $trail->parent('admin.kamus_ata')
                ->push(__('Edit Kamus Komponen Aset Tak Alih'), route('admin.editkamus', $kamusata));
    });
    Route::patch('updatekamus/{kamusata}', [KamusataController::class, 'update'])->name('updatekamus');
    Route::get('showkamus/{kamusata}', [KamusataController::class, 'show'])->name('showkamus')
        ->breadcrumbs(function (Trail $trail, Kamusata $kamusata) {
            $trail->parent('admin.kamus_ata')
                ->push(__('Maklumat Kamus Komponen Aset Tak Alih'), route('admin.showkamus', $kamusata));
        });
    Route::get('copykamus/{kamusata}', [KamusataController::class, 'copy'])->name('copykamus')
        ->breadcrumbs(function (Trail $trail, Kamusata $kamusata) {
            $trail->parent('admin.kamus_ata')
                ->push(__('Salin Kamus Komponen Aset Tak Alih'), route('admin.copykamus', $kamusata));
    });

    /* end kamus ata */

    /* ATA */
    Route::get('asetalih', [AsetalihController::class, 'index'])->name('asetalih')
        ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Senarai Aset Tak Alih'), route('admin.asetalih'));
    });

    Route::get('show_asetalih/{lokasi}', [AsetalihController::class, 'show'])->name('show_asetalih')
        ->breadcrumbs(function (Trail $trail, Lokasi $lokasi) {
            $trail->parent('admin.asetalih')
                ->push(__('Maklumat Kamus Komponen Aset Tak Alih'), route('admin.show_asetalih', $lokasi));
    });

    Route::get('createasetalih/{lokasi}', [AsetalihController::class, 'create'])->name('createasetalih')
        ->breadcrumbs(function (Trail $trail, Lokasi $lokasi) {
            $trail->parent('admin.asetalih')
                ->push(__('Tambah Aset Tak Alih'), route('admin.createasetalih', $lokasi));
    });
    /* Route::get('storeasetalih/{lokasi}/{kamusata}', [AsetalihController::class, 'store'])->name('storeasetalih')
        ->breadcrumbs(function (Trail $trail, Lokasi $lokasi, Kamusata $kamusata) {
            $trail->parent('admin.asetalih')
                ->push(__('Tambah Aset Tak Alih'), route('admin.storeasetalih', $lokasi,$kamusata));
    }); */
    Route::get('storeasetalih/{lokasi}/{kamusata}', [AsetalihController::class, 'store'])->name('storeasetalih');
    Route::delete('destroyasetalih/{asetalih}/{lokasi}', [AsetalihController::class, 'destroy'])->name('destroyasetalih');

    Route::get('editasetalih/{asetalih}', [AsetalihController::class, 'edit'])->name('editasetalih')
    ->breadcrumbs(function (Trail $trail, Asetalih $asetalih) {
        $trail->parent('admin.asetalih')
            ->push(__('Edit Komponen Aset Tak Alih'), route('admin.editasetalih', $asetalih));
    });
    Route::patch('updateasetalih/{asetalih}', [AsetalihController::class, 'update'])->name('updateasetalih');
    Route::get('showasetalih/{asetalih}', [AsetalihController::class, 'show_ata'])->name('showasetalih')
        ->breadcrumbs(function (Trail $trail, Asetalih $asetalih) {
            $trail->parent('admin.asetalih')
                ->push(__('Maklumat Komponen Aset Tak Alih'), route('admin.showasetalih', $asetalih));
    });
    Route::get('da6/{asetalih}', [AsetalihController::class, 'createDA6'])->name('da6')
        ->breadcrumbs(function (Trail $trail, Asetalih $asetalih) {
            $trail->parent('admin.asetalih')
                ->push(__('Borang DA6'), route('admin.da6'));
    });
    Route::get('da6_1/{lokasi}', [AsetalihController::class, 'createDA6_1'])->name('da6_1')
        ->breadcrumbs(function (Trail $trail, Asetalih $asetalih) {
            $trail->parent('admin.asetalih')
                ->push(__('Borang DA6'), route('admin.da6_1'));
    });
    /* end ATA */
    /* Tindakan ATA */
    Route::get('atarosaktin', [AtarosakController::class, 'index_tindakan'])->name('atarosaktin')
        ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Senarai Aduan Kerosakan Aset Tak Alih'), route('admin.atarosaktin'));
    });

    Route::get('editatarosak/{atarosak}', [AtarosakController::class, 'edit'])->name('editatarosak')
        ->breadcrumbs(function (Trail $trail, Atarosak $atarosak) {
            $trail->parent('admin.atarosaktin')
                ->push(__('Maklumat Tindakan Aduan Aset Tak Alih'), route('admin.editatarosak', $atarosak));
        });
    Route::patch('updateatarosaktin/{atarosak}', [AtarosakController::class, 'update_tindakan'])->name('updateatarosaktin');

    /* end Tindakan ATA */

    /* Tindakan Struktur */

    Route::get('strrosaktin', [StrrosakController::class, 'index_tindakan'])->name('strrosaktin')
    ->breadcrumbs(function (Trail $trail) {
    $trail->parent('admin.dashboard')
        ->push(__('Senarai Aduan Kerosakan Aset Tak Alih (Struktur)'), route('admin.strrosaktin'));
    });

    Route::get('editstrrosak/{strrosak}', [StrrosakController::class, 'edit'])->name('editstrrosak')
        ->breadcrumbs(function (Trail $trail, Strrosak $strrosak) {
            $trail->parent('admin.strrosaktin')
                ->push(__('Maklumat Tindakan Aduan Aset Tak Alih (Struktur)'), route('admin.editstrrosak', $strrosak));
        });
    Route::patch('updatestrrosaktin/{strrosak}', [StrrosakController::class, 'update_tindakan'])->name('updatestrrosaktin');



    /* End Tindakan Struktur */

});


Route::group([
    'middleware' => 'role:administrator|bppl|bppa|bkkl|techteam|atateam',
], function () {

    Route::get('kehadiran', [StudentController::class, 'index_kehadiran'])->name('kehadiran')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                ->push(__('Kehadiran Pelajar'), route('admin.kehadiran'));
        });

    Route::get('pdf_view', [StudentController::class, 'createPDF'])->name('pdf_view')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('admin.dashboard')
            ->push(__('Kehadiran Pelajar'), route('admin.pdf_view'));
    });

    Route::get('kehadiran_dkp', [StudentController::class, 'index_kehadiran_dkp'])->name('kehadiran_dkp')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                ->push(__('Laporan Daftar Kehadiran Pelajar'), route('admin.kehadiran_dkp'));
        });

    Route::get('pdf_dkp_view', [StudentController::class, 'create_pdf_dkp'])->name('pdf_dkp_view')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                ->push(__('Laporan Daftar Kehadiran Pelajar'), route('admin.pdf_dkp_view'));
        });

    
});



Route::resource('courses', CourseController::class);
Route::resource('students', StudentController::class);
Route::resource('lokasis', LokasiController::class);
Route::resource('hartamodals', HartamodalController::class);
Route::resource('atas', AtaController::class);
Route::resource('abrs', AbrController::class);
Route::resource('abrrosaks', AbrrosakController::class);
Route::resource('kamusatas', KamusataController::class);
Route::resource('asetalihs', AsetalihController::class);
Route::resource('atarosaks', AtarosakController::class);