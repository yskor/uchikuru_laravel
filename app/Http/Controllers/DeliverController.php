<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use App\Models\Data\ConsumablesData;
use App\Models\Consumables;
use Illuminate\Support\Facades\Log;


class DeliverController extends AuthController
{
    //
    /**
     * 納品リストを表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deliver_list(Request $request)
    {
        Log::debug(print_r($this->login, true));

        // データを取得
        $deliver_list = Consumables::getConsumablesDeliver();
        // dd($consumables_list);

        $data = ['deliver_list' => $deliver_list, 'login' => $this->login];

        return self::view($request, 'deliver_list', $data);
    }
}
