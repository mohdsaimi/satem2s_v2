<?php

use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\Satem2sController;
use App\Http\Controllers\Frontend\AduanController;
use Tabuna\Breadcrumbs\Trail;

use App\Models\Courses;
use App\Models\Students;
use App\Models\Lokasi;
use App\Models\Bangunan;
use App\Models\Hartamodal;
use App\Models\Hmrosak;
use App\Models\Abrrosak;
use App\Models\Atarosak;

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the user has not confirmed their email
 */
Route::group(['as' => 'user.', 'middleware' => ['auth', 'password.expires', config('boilerplate.access.middleware.verified')]], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        /* ->middleware('is_user') */
        ->name('dashboard')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('Dashboard'), route('frontend.user.dashboard'));
        });

    Route::get('account', [AccountController::class, 'index'])
        ->name('account')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.index')
                ->push(__('My Account'), route('frontend.user.account'));
        });

    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    ////
    Route::get('kehadiran', [Satem2sController::class, 'index'])->name('kehadiran')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.user.dashboard')
                ->push(__('Kehadiran Pelajar'), route('frontend.user.kehadiran'));
        });
    Route::get('pdf_view', [Satem2sController::class, 'createPDF'])->name('pdf_view')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.user.dashboard')
                ->push(__('Kehadiran Pelajar'), route('frontend.user.pdf_view'));
        });

    Route::get('list_aduanhm', [AduanController::class, 'index_list_aduan'])->name('list_aduanhm')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.user.dashboard')
                ->push(__('Senarai Aduan Kerosakan Harta Modal'), route('frontend.user.list_aduanhm'));
        });
    Route::get('showhmrosak/{hmrosak}', [AduanController::class, 'show'])->name('showhmrosak')
        ->breadcrumbs(function (Trail $trail, Hmrosak $hmrosak) {
            $trail->parent('frontend.user.list_aduanhm')
                ->push(__('Aduan Kerosakan Harta Modal'), route('frontend.user.showhmrosak', $hmrosak));
        });

    Route::get('hmrosak_selesai', [AduanController::class, 'index_selesai'])->name('hmrosak_selesai')
        ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.user.list_aduanhm')
            ->push(__('Senarai Aduan Kerosakan Aset Alih (Harta Modal) - Selesai'), route('frontend.user.hmrosak_selesai'));
        });

    Route::get('export', [AduanController::class, 'export'])->name('export'); /* excel */

    Route::get('showhmrosak_selesai/{hmrosak}', [AduanController::class, 'show_selesai'])->name('showhmrosak_selesai')
        ->breadcrumbs(function (Trail $trail, Hmrosak $hmrosak) {
            $trail->parent('frontend.user.hmrosak_selesai')
                ->push(__('Maklumat Aduan Kerosakan (HM) - Selesai'), route('frontend.user.showhmrosak_selesai', $hmrosak));
        });
    
    Route::get('pdfhmrosak/{hmrosak}', [AduanController::class, 'createPDF'])->name('pdfhmrosak')
        ->breadcrumbs(function (Trail $trail, Hmrosak $hmrosak) {
            $trail->parent('frontend.user.list_aduanhm')
                ->push(__('Borang Aduan Kerosakan Aset Alih'), route('frontend.user.pdfhmrosak'));
        });

    Route::get('list_aduanabr', [AduanController::class, 'index_list_aduanabr'])->name('list_aduanabr')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.user.dashboard')
            ->push(__('Senarai Aduan Kerosakan ABR'), route('frontend.user.list_aduanabr'));
    });

    Route::get('showabrrosak/{abrrosak}', [AduanController::class, 'show_abr'])->name('showabrrosak')
        ->breadcrumbs(function (Trail $trail, Abrrosak $abrrosak) {
            $trail->parent('frontend.user.list_aduanabr')
                ->push(__('Aduan Kerosakan ABR'), route('frontend.user.showabrrosak', $abrrosak));
    });

    Route::get('pdfabrrosak/{abrrosak}', [AduanController::class, 'createPDF_abr'])->name('pdfabrrosak')
        ->breadcrumbs(function (Trail $trail, Abrrosak $abrrosak) {
            $trail->parent('frontend.user.list_aduanabr')
                ->push(__('Borang Aduan Kerosakan Aset Alih'), route('frontend.user.pdfabrrosak'));
    });

    Route::get('abrrosak_selesai', [AduanController::class, 'index_abr_selesai'])->name('abrrosak_selesai')
        ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.user.list_aduanabr')
            ->push(__('Senarai Aduan Kerosakan Aset Alih (ABR) - Selesai'), route('frontend.user.abrrosak_selesai'));
    });

    Route::get('showabrrosak_selesai/{abrrosak}', [AduanController::class, 'show_abr_selesai'])->name('showabrrosak_selesai')
        ->breadcrumbs(function (Trail $trail, Abrrosak $abrrosak) {
            $trail->parent('frontend.user.abrrosak_selesai')
                ->push(__('Maklumat Aduan Kerosakan (ABR) - Selesai'), route('frontend.user.showabrrosak_selesai', $abrrosak));
    });

    Route::get('exportabr', [AduanController::class, 'export_abr'])->name('exportabr'); /* excel */

    /* Aduan ATA */
    Route::get('list_aduanata', [AduanController::class, 'index_list_aduan_ata'])->name('list_aduanata')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.user.dashboard')
            ->push(__('Senarai Aduan Kerosakan ATA'), route('frontend.user.list_aduanata'));
    });

    Route::get('showatarosak/{atarosak}', [AduanController::class, 'show_ata'])->name('showatarosak')
        ->breadcrumbs(function (Trail $trail, Atarosak $atarosak) {
            $trail->parent('frontend.user.list_aduanata')
                ->push(__('Aduan Kerosakan ATA'), route('frontend.user.showatarosak', $atarosak));
    });

    Route::get('pdfatarosak/{atarosak}', [AduanController::class, 'createPDF_ata'])->name('pdfatarosak')
    ->breadcrumbs(function (Trail $trail, Atarosak $atarosak) {
        $trail->parent('frontend.user.list_aduanata')
            ->push(__('Borang Aduan Kerosakan Aset Tak Alih'), route('frontend.user.pdfatarosak'));
    });

    Route::get('atarosak_selesai', [AduanController::class, 'index_ata_selesai'])->name('atarosak_selesai')
    ->breadcrumbs(function (Trail $trail) {
    $trail->parent('frontend.user.list_aduanata')
        ->push(__('Senarai Aduan Kerosakan Aset Tak Alih - Selesai'), route('frontend.user.atarosak_selesai'));
    });

    Route::get('exportata', [AduanController::class, 'export_ata'])->name('exportata'); /* excel */

    /* End Aduan ATA */

    /* Aduan Struktur ATA */

    Route::get('list_aduanstr', [AduanController::class, 'index_list_aduan_str'])->name('list_aduanstr')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.user.dashboard')
            ->push(__('Senarai Aduan Kerosakan ATA - Struktur'), route('frontend.user.list_aduanstr'));
    });

    Route::get('showstrrosak/{strrosak}', [AduanController::class, 'show_str'])->name('showstrrosak')
    ->breadcrumbs(function (Trail $trail, $strrosak) {
        $trail->parent('frontend.user.list_aduanstr')
            ->push(__('Aduan Kerosakan ATA - Struktur'), route('frontend.user.showstrrosak', $strrosak));
    });

    Route::get('pdfstrrosak/{strrosak}', [AduanController::class, 'createPDF_str'])->name('pdfstrrosak')
    ->breadcrumbs(function (Trail $trail, Strrosak $strrosak) {
        $trail->parent('frontend.user.list_aduanstr')
            ->push(__('Borang Aduan Kerosakan Aset Tak Alih - Struktur'), route('frontend.user.pdfstrrosak'));
    });

    Route::get('strrosak_selesai', [AduanController::class, 'index_str_selesai'])->name('strrosak_selesai')
    ->breadcrumbs(function (Trail $trail) {
    $trail->parent('frontend.user.list_aduanstr')
        ->push(__('Senarai Aduan Kerosakan Aset Tak Alih (Struktur) - Selesai'), route('frontend.user.strrosak_selesai'));
    });

    Route::get('exportstr', [AduanController::class, 'export_str'])->name('exportstr'); /* excel */





    /* End Aduan Struktur ATA */

    /* List Pelupusan */

    Route::get('list_lupushm', [AduanController::class, 'index_list_lupushm'])->name('list_lupushm')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.user.dashboard')
            ->push(__('Senarai Permohonan Pelupusan Harta Modal'), route('frontend.user.list_lupushm'));
    });

    Route::get('showlupushm/{hmlupus}', [AduanController::class, 'showlupushm'])->name('showlupushm')
        ->breadcrumbs(function (Trail $trail, $hmlupus) {
            $trail->parent('frontend.user.list_lupushm')
                ->push(__('Papar Permohonan Pelupusan Aset Alih (Harta Modal)'), route('frontend.user.showlupushm', $hmlupus));
        });

    Route::get('list_lupusabr', [AduanController::class, 'index_list_lupusabr'])->name('list_lupusabr')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('frontend.user.dashboard')
                ->push(__('Senarai Permohonan Pelupusan ABR'), route('frontend.user.list_lupusabr'));
        });

    Route::get('showlupusabr/{abrlupus}', [AduanController::class, 'showlupusabr'])->name('showlupusabr')
        ->breadcrumbs(function (Trail $trail, $abrlupus) {
            $trail->parent('frontend.user.list_lupusabr')
                ->push(__('Papar Permohonan Pelupusan Aset Alih (ABR)'), route('frontend.user.showlupusabr', $abrlupus));
        });

    /* End List Pelupusan */

});
