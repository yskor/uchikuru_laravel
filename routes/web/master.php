<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsumableController;

// マスタ一覧
Route::get('/consumable_master', [ConsumableController::class, 'consumable_master'])->name('master_list');

// マスタ登録画面
Route::get('/consumable_master/add', [ConsumableAddController::class, 'consumable_master_add'])->name('add_master');

// マスタ登録
Route::post('/consumable_master/create', [ConsumableCreateController::class, 'consumable_master_create'])->name('create_master');