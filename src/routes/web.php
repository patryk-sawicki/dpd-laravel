<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use PatrykSawicki\DpdApi\app\Http\Controllers\AssetController;
use PatrykSawicki\DpdApi\app\Http\Controllers\DpdController;

Route::prefix('dpd')->name('dpd.')->group(function () {
    Route::get('sass/{name}', [AssetController::class, 'sass']
    )->name(
        'sass'
    );

    Route::get('js/{name}', [AssetController::class, 'js']
    )->name(
        'js'
    );

    Route::get('img/{name}/{ext}', [AssetController::class, 'img']
    )->name(
        'img'
    );

    Route::post('dpdCreate/{disc}/{dir}/{file}', [DpdController::class, 'generateShippingLabel']
    )->name(
        'generateShippingLabel'
    );
});