<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TermsController;
use App\Http\Controllers\Frontend\AduanController;

use App\Http\Controllers\Backend\HartamodalController;

use App\Models\Hartamodal;
use App\Models\Abr;

use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])
    ->name('index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });
Route::get('bppa', [HomeController::class, 'bppa'])
    ->name('bppa')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });
Route::get('kehadiran-1', [HomeController::class, 'check_kehadiran'])->name('pages.kehadiran-1')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Kehadiran Pelajar'), route('frontend.pages.kehadiran-1'));
    });

Route::get('terms', [TermsController::class, 'index'])
    ->name('pages.terms')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
    });

Route::get('konvo', [HomeController::class, 'konvo'])
    ->name('konvo')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });

Route::get('tetamu', [HomeController::class, 'tetamu'])
    ->name('tetamu')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });

Route::get('konvo_del', [HomeController::class, 'konvo_del'])
    ->name('konvo_del')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });

Route::delete('konvo_del_1/{id}', [HomeController::class, 'konvo_del_1'])->name('konvo_del_1');

Route::get('satem2s', [HomeController::class, 'satem2s'])
    ->name('satem2s')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });

Route::get('alerts', [HomeController::class, 'alerts'])
    ->name('alerts')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });

Route::get('ping', [HomeController::class, 'ping'])
    ->name('ping')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });

/* aduan kerosakan */
Route::get('aduanhm1', [AduanController::class, 'index'])->name('pages.aduanhm1')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Aduan Kerosakan Aset Alih (Harta Modal)'), route('frontend.pages.aduanhm1'));
    });

Route::get('aduanhartamodal/{hartamodal}', [AduanController::class, 'aduanhm'])->name('pages.aduanhartamodal')
    ->breadcrumbs(function (Trail $trail, Hartamodal $hartamodal) {
        $trail->parent('frontend.pages.aduanhm1')
            ->push(__('Aduan Kerosakan Aset Alih (Harta Modal)'), route('frontend.pages.aduanhartamodal', $hartamodal));
    });

Route::post('storehmrosak', [AduanController::class, 'store'])->name('storehmrosak');

Route::get('aduanabr1', [AduanController::class, 'index_abr'])->name('pages.aduanabr1')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Aduan Kerosakan Aset Alih (ABR)'), route('frontend.pages.aduanabr1'));
});

Route::get('aduanabr/{abr}', [AduanController::class, 'aduanabr'])->name('pages.aduanabr')
    ->breadcrumbs(function (Trail $trail, Abr $abr) {
        $trail->parent('frontend.pages.aduanabr1')
            ->push(__('Aduan Kerosakan Aset Alih (ABR)'), route('frontend.pages.aduanabr', $abr));
});

Route::post('storeabrrosak', [AduanController::class, 'store_abr'])->name('storeabrrosak');

/* end aduan kerosakan */

/* aduan ata */
Route::get('aduanata1', [AduanController::class, 'index_ata'])->name('pages.aduanata1')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Aduan Kerosakan Aset Tak Alih (Komponen)'), route('frontend.pages.aduanata1'));
    });

Route::get('aduanata2/{lokasi}', [AduanController::class, 'show_aduanata'])->name('pages.aduanata2')
    ->breadcrumbs(function (Trail $trail, $lokasi) {
        $trail->parent('frontend.pages.aduanata1')
            ->push(__('Maklumat Kamus Komponen Aset Tak Alih'), route('frontend.pages.aduanata2',$lokasi));
});

Route::get('aduan_ata/{asetalih}', [AduanController::class, 'aduan_ata'])->name('pages.aduan_ata')
    ->breadcrumbs(function (Trail $trail, $asetalih) {
        $trail->parent('frontend.pages.aduanata1')
            ->push(__('Aduan Komponen Aset Tak Alih'), route('frontend.pages.aduan_ata', $asetalih));
    });

Route::post('storeatarosak', [AduanController::class, 'store_atarosak'])->name('storeatarosak');

/* end aduan ata */

/* Aduan Struktur ATA */

Route::get('aduan_ata_str/{lokasi}', [AduanController::class, 'aduan_ata_str'])->name('pages.aduan_ata_str')
    ->breadcrumbs(function (Trail $trail, $lokasi) {
        $trail->parent('frontend.pages.aduanata1')
            ->push(__('Maklumat Kamus Komponen Aset Tak Alih - Struktur'), route('frontend.pages.aduan_ata_str',$lokasi));
});

Route::post('storestrrosak', [AduanController::class, 'store_strrosak'])->name('storestrrosak');




/* End Aduan Struktur ATA */

/* lupus HM */
Route::get('mohonlupushm', [AduanController::class, 'index_mohonHM'])->name('pages.mohonlupushm')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Permohonan Pelupusan Aset Alih (Harta Modal)'), route('frontend.pages.mohonlupushm'));
    });

Route::get('mohonlupushm1/{hartamodal}', [AduanController::class, 'lupushm'])->name('pages.mohonlupushm1')
    ->breadcrumbs(function (Trail $trail, Hartamodal $hartamodal) {
        $trail->parent('frontend.pages.mohonlupushm')
            ->push(__('Permohonan Pelupusan Aset Alih (Harta Modal)'), route('frontend.pages.mohonlupushm1', $hartamodal));
    });

Route::post('storehmlupus', [AduanController::class, 'storehmlupus'])->name('storehmlupus');
/* end lupus HM */

/* lupus ABR */
Route::get('mohonlupusabr', [AduanController::class, 'index_mohonABR'])->name('pages.mohonlupusabr')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Permohonan Pelupusan Aset Alih (ABR)'), route('frontend.pages.mohonlupusabr'));
});
Route::get('mohonlupusabr1/{abr}', [AduanController::class, 'lupusabr'])->name('pages.mohonlupusabr1')
    ->breadcrumbs(function (Trail $trail, Abr $abr) {
        $trail->parent('frontend.pages.mohonlupusabr')
            ->push(__('Permohonan Pelupusan Aset Alih (ABR)'), route('frontend.pages.mohonlupusabr1', $abr));
});
Route::post('storeabrlupus', [AduanController::class, 'storeabrlupus'])->name('storeabrlupus');
/* end lupus ABR */

/* lokasi bangunan */
Route::get('lokasibangunan', [AduanController::class, 'index_bangunan'])->name('pages.lokasibangunan')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Lokasi Bangunan'), route('frontend.pages.lokasibangunan'));
    });
/* lokasi bangunan */