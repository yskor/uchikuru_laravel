<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use App\Models\Data\ConsumablesData;
use App\Models\Consumables;
use Illuminate\Support\Facades\Log;


class IndexController extends AuthController
{
    //
    /**
     * 初期画面を表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        Log::debug(print_r($this->login, true));

        $data = ['login' => $this->login];

        return self::view($request, 'index', $data);
    }
}
