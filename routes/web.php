<?php

use App\Http\Controllers\ConfigController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Panel\AgendaController;
use App\Http\Controllers\Panel\HomeController;

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


// Route Components
Route::get('layouts/collapsed-menu', [StaterkitController::class, 'collapsed_menu'])->name('collapsed-menu');
Route::get('layouts/full', [StaterkitController::class, 'layout_full'])->name('layout-full');
Route::get('layouts/without-menu', [StaterkitController::class, 'without_menu'])->name('without-menu');
Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout-empty');
Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name('layout-blank');


// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);


Route::get('/', [HomeController::class, 'index'])->name('initial');
Route::get('/clear/route', [ConfigController::class, 'clearRoute']);

Route::group(['prefix' => 'panel', 'middleware' => 'auth'], function () {
	Route::get('home', [HomeController::class, 'home'])->name('home');
	Route::get('agenda', [AgendaController::class, 'index'])->name('agenda.index');
	Route::post('agenda/create', [AgendaController::class, 'create'])->name('agenda.create');
	Route::post('agenda/update/{contact?}', [AgendaController::class, 'update'])->name('agenda.update');
	Route::get('agenda/contacto/{contac?}', [AgendaController::class, 'data'])->name('agenda.contac');

	Route::put('agenda/delete/{contact?}', [AgendaController::class, 'delete'])->name('agenda.delete');
	Route::put('agenda/deletephone/{phone?}', [AgendaController::class, 'deletephone'])->name('agenda.deletephone');
	Route::put('agenda/deleteaddress{address?}', [AgendaController::class, 'deleteaddress'])->name('agenda.deleteaddress');
});
