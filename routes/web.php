<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DeliverController;
use App\Http\Controllers\BuyController;

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
Route::get('/sample', [SampleController::class, 'sample']);
Route::post('/sample/office', [SampleController::class, 'office']);
Route::post('/sample/office_html', [SampleController::class, 'office_html']);

// マスタ一覧
Route::get('/master_list', [MasterController::class, 'master_list'])->name('master_list');

// マスタ更新
Route::post('/master_list', [MasterController::class, 'edit_master'])->name('edit_master');

// マスタカテゴリ別一覧
Route::get('/master_list/{consumables_category_code}', [MasterController::class, 'master_list_category'])->name('master_list_category');

// マスタカテゴリ別一覧
Route::post('/master_list/{consumables_category_code}', [MasterController::class, 'master_list_category'])->name('master_list_category');

// 在庫一覧
Route::get('/stock_list', [StockController::class, 'stock_list'])->name('stock_list');
// 在庫事業所別一覧
Route::get('/stock_list/{office_code}', [StockController::class, 'facility_stock_list'])->name('facility_stock_list');

// 仕入一覧
Route::get('/buy_list', [BuyController::class, 'buy_list'])->name('buy_list');
Route::post('/buy_consumables', [BuyController::class, 'buy_consumables'])->name('buy_consumables');
// カテゴリ別仕入一覧
Route::get('/buy_list/{office_code}', [BuyController::class, 'cbuy_list_category'])->name('buy_list_category');

// 納品一覧
Route::get('/deliver_list', [DeliverController::class, 'deliver_list'])->name('deliver_list');
