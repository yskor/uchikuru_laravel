<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;

// マスタ一覧
Route::get('/master_list', [MasterController::class, 'master_list'])->name('master_list');

// マスタ登録
Route::post('/master_list', [MasterController::class, 'add_master'])->name('add_master');