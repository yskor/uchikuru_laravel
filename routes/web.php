<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DeliverController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\ConsumptionController;

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
Route::get('/qr_list', [MasterController::class, 'qr_list'])->name('qr_list');

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
// 在庫事業所別かつ消耗品カテゴリ一覧
Route::get('/stock_list/{office_code}/{consumables_category_code}', [StockController::class, 'facility_category_stock_list'])->name('facility_category_stock_list');

// 仕入一覧
Route::get('/buy_list', [BuyController::class, 'buy_list'])->name('buy_list');
Route::post('/buy_list', [BuyController::class, 'edit_buy'])->name('edit_buy');
Route::post('/buy_consumables', [BuyController::class, 'buy_consumables'])->name('buy_consumables');
// カテゴリ別仕入一覧
Route::get('/buy_list/{consumables_category_code}', [BuyController::class, 'buy_list_category'])->name('buy_list_category');

// 出荷一覧
Route::get('/ship_list', [ShipController::class, 'ship_list'])->name('ship_list');
Route::post('/ship_list', [ShipController::class, 'edit_ship'])->name('edit_ship');
Route::post('/ship_consumables', [ShipController::class, 'ship_consumables'])->name('ship_consumables');
Route::get('/ship_add', [ShipController::class, 'ship_add'])->name('ship_add');
// 事業所別出荷一覧
Route::get('/ship_list/{office_code}', [ShipController::class, 'facility_ship_list'])->name('facility_ship_list');
Route::post('/ship_list/{office_code}', [ShipController::class, 'facility_edit_ship'])->name('facility_edit_ship');

// 納品画面
Route::get('/deliver', [DeliverController::class, 'deliver'])->name('deliver');
Route::get('/deliver_list', [DeliverController::class, 'deliver_list'])->name('deliver_list');
Route::get('/deliver_list_test', [DeliverController::class, 'deliver_list_test'])->name('deliver_list_test');
Route::post('/deliver_list', [DeliverController::class, 'edit_deliver'])->name('edit_deliver');
// 納品一覧
Route::post('/qrreader', [DeliverController::class, 'qrreader'])->name('qrreader');
Route::post('/deliver_consumables', [DeliverController::class, 'deliver_consumables'])->name('deliver_consumables');
Route::post('/deliver_table', [DeliverController::class, 'deliver_table'])->name('deliver_table');

// 消費画面
Route::get('/consumption', [ConsumptionController::class, 'consumption'])->name('consumption');
Route::post('/consumption_done', [ConsumptionController::class, 'consumption_done'])->name('consumption_done');
Route::post('/consumption_consumables', [ConsumptionController::class, 'consumption_consumables'])->name('consumption_consumables');


// test
Route::get('/buy_list_test', [BuyController::class, 'buy_list_test'])->name('buy_list_test');
Route::post('/buy_consumables_test', [BuyController::class, 'buy_consumables_test'])->name('buy_consumables_test');
Route::post('/ship_consumables_test', [ShipController::class, 'ship_consumables_test'])->name('ship_consumables_test');