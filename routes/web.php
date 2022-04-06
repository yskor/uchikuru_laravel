<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\StockController;

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

Route::get('/', [IndexController::class, 'index'])->name('index');

// require_once 'web/sample.php';
// require_once 'web/master.php';

// サンプルページ
Route::get( '/sample', [SampleController::class, 'sample']);
Route::post( '/sample/office', [SampleController::class, 'office']);
Route::post( '/sample/office_html', [SampleController::class, 'office_html']);

// マスタ一覧
Route::get('/master_list', [MasterController::class, 'master_list'])->name('master_list');

// マスタ登録
Route::post('/master_list', [MasterController::class, 'add_master'])->name('add_master');

// 在庫一覧（本部）
Route::get('/stock_list', [StockController::class, 'stock_list'])->name('stock_list');
// 在庫一覧（施設）
Route::get('/stock_list‗2', [StockController::class, 'stock_list‗2'])->name('stock_list‗2');