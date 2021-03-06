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
use App\Http\Controllers\TestController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\NoticeController;

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

// マスタ一覧
// Route::get('/master_list', [MasterController::class, 'master_list'])->name('master_list');
Route::get('/qr_list', [MasterController::class, 'qr_list'])->name('qr_list');
Route::get('/add_master/{consumables_category_code}', [MasterController::class, 'add_master'])->name('add_master');
Route::get('/update_master/{consumables_code}', [MasterController::class, 'update_master'])->name('update_master');

// マスタカテゴリ別一覧
Route::get('/master_list/{consumables_category_code}{consumables_code?}', [MasterController::class, 'master_list_category'])->name('master_list_category');
Route::get('/master_list/search/{consumables_category_code}', [MasterController::class, 'master_list_search'])->name('master_list_search');

// マスタカテゴリ別一覧
Route::post('/master_list/{consumables_category_code}', [MasterController::class, 'edit_master'])->name('edit_master');;

// 在庫一覧
Route::get('/stock_list', [StockController::class, 'stock_list'])->name('stock_list');
// 在庫事業所別一覧
Route::get('/stock_list/{office_code}', [StockController::class, 'facility_stock_list'])->name('facility_stock_list');
// 在庫事業所別かつ消耗品カテゴリ一覧
Route::get('/stock_list/{office_code}/{consumables_category_code}', [StockController::class, 'facility_category_stock_list'])->name('facility_category_stock_list');
Route::get('/stock_list/search/{office_code}/{consumables_category_code}', [StockController::class, 'facility_category_stock_list_search'])->name('facility_category_stock_list_search');
Route::get('/stock_list_mobile/{office_code}/{consumables_category_code}', [StockController::class, 'stock_list_mobile'])->name('stock_list_mobile');
// 在庫調整
Route::post('/stock_adjustment/{office_code}/{consumables_category_code}/{consumables_code}', [StockController::class, 'stock_adjustment'])->name('stock_adjustment');

// 仕入一覧
Route::get('/buy_list', [BuyController::class, 'buy_list'])->name('buy_list');
Route::post('/buy_consumables/{consumables_category_code}', [BuyController::class, 'edit_buy'])->name('edit_buy');
Route::post('/buy_consumables', [BuyController::class, 'buy_consumables'])->name('buy_consumables');
// カテゴリ別仕入一覧
Route::get('/buy_list/{consumables_category_code}', [BuyController::class, 'buy_list_category'])->name('buy_list_category');
Route::post('/buy_list/{consumables_category_code}', [BuyController::class, 'edit_buy'])->name('edit_buy');
Route::get('/buy_list/search/{consumables_category_code}', [BuyController::class, 'buy_list_category_search'])->name('buy_list_category_search');

// 出荷一覧
Route::get('/ship_list', [ShipController::class, 'ship_list'])->name('ship_list');
Route::post('/ship_list', [ShipController::class, 'edit_ship'])->name('edit_ship');
Route::post('/ship_consumables', [ShipController::class, 'ship_consumables'])->name('ship_consumables');
Route::post('/ship_shortage_consumables/{office_code}/{consumables_code}', [ShipController::class, 'ship_shortage_consumables'])->name('ship_shortage_consumables');
Route::get('/ship_add', [ShipController::class, 'ship_add'])->name('ship_add');
Route::post('/ship_cancel/{office_code}/{ship_code}/{consumables_code}', [ShipController::class, 'ship_cancel'])->name('ship_cancel');
// 事業所別出荷一覧
Route::get('/ship_list/{office_code}', [ShipController::class, 'facility_ship_list'])->name('facility_ship_list');
Route::post('/ship_list/{office_code}', [ShipController::class, 'facility_edit_ship'])->name('facility_edit_ship');

// 納品画面
Route::get('/deliver', [DeliverController::class, 'deliver'])->name('deliver');
Route::get('/deliver_list/{office_code}', [DeliverController::class, 'deliver_list'])->name('deliver_list');
Route::post('/deliver', [DeliverController::class, 'deliver_consumables'])->name('deliver_consumables');

// 納品状況
Route::get('/deliver_status/{consumables_category_code}', [DeliverController::class, 'deliver_status'])->name('deliver_status');
Route::get('/facility_deliver_status/{consumables_category_code}/{office_code?}', [DeliverController::class, 'facility_deliver_status'])->name('facility_deliver_status');
Route::get('/deliver_status_search', [DeliverController::class, 'deliver_status_search'])->name('deliver_status_search');
Route::get('/deliver_status/{consumables_category_code}/{consumables_code}', [DeliverController::class, 'deliver_status_list'])->name('deliver_status_list');
Route::get('/deliver_status/week/{consumables_category_code}/{consumables_code}', [DeliverController::class, 'week_deliver_status'])->name('week_deliver_status');
Route::get('/deliver_status/month/{consumables_category_code}/{consumables_code}', [DeliverController::class, 'month_deliver_status'])->name('month_deliver_status');

// 納品一覧
Route::post('/deliver_table', [DeliverController::class, 'deliver_table'])->name('deliver_table');

// 消費画面
Route::get('/consumption/{consumables_code}', [ConsumptionController::class, 'consumption'])->name('consumption');
Route::post('/consumption_done', [ConsumptionController::class, 'consumption_done'])->name('consumption_done');

// Route::get('/test', [TestController::class, 'test'])->name('test');

// 施設QR一覧
Route::get('/facility_qr_list', [QrController::class, 'facility_qr_list'])->name('facility_qr_list');

// 在庫不足通知
Route::post('/api/notice/shortage_list', [NoticeController::class, 'notice_shortage_list'])->name('notice_shortage_list');
// Route::get('/api/notice/shortage_list', [NoticeController::class, 'notice_shortage_list'])->name('notice_shortage_list');

// 在庫不足消耗品画面
Route::get('/shortage_consumables', [StockController::class, 'shortage_consumables'])->name('shortage_consumables');