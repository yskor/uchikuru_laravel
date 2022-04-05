<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampleController;

Route::get( '/sample', [SampleController::class, 'sample']);
Route::post( '/sample/office', [SampleController::class, 'office']);
Route::post( '/sample/office_html', [SampleController::class, 'office_html']);