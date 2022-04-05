<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsumableMasterController;

// マスタ一覧
Route::get( '/consumable_master', [ConsumableMasterController::class, 'consumable_master']);
// Route::post( '/sample/office', [SampleController::class, 'office']);
// Route::post( '/sample/office_html', [SampleController::class, 'office_html']);