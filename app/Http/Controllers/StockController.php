<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use App\Models\Data\ConsumableData;
use App\Models\Consumable;
use Illuminate\Support\Facades\Log;


class StockController extends AuthController
{
    //
    /**
     * 消耗品一覧を表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function stock_list(Request $request)
    {
        Log::debug(print_r($this->login, true));
        
        // データを取得
        $stock_list = Consumable::getConsumableStock();
        // dd($consumable_list);
        
        $data = ['stock_list' => $stock_list , 'login' => $this->login];
        
        return self::view($request, 'stock_list', $data );
    }

}
