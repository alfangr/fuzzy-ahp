<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\RankingController;

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

Route::get('/', function () {
    return view('criteria');
});

Route::get('/', [CriteriaController::class, 'index'])->name('criterias.index');
Route::post('/criterias', [CriteriaController::class, 'store'])->name('criterias.store');
Route::delete('/criterias/{criteria_id}', [CriteriaController::class, 'destroy'])->name('criterias.destroy');

Route::get('/alternatives', [AlternativeController::class, 'index'])->name('alternatives.index');
Route::post('/alternatives', [AlternativeController::class, 'store'])->name('alternatives.store');
Route::delete('/alternatives/{alternative_id}', [AlternativeController::class, 'destroy'])->name('alternatives.destroy');

Route::get('/rankings', [RankingController::class, 'index'])->name('rankings.index');
Route::post('/rankings', [RankingController::class, 'doRanking'])->name('rankings.do');