<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use App\Models\Data\ConsumableData;
use App\Models\Consumable;
use Illuminate\Support\Facades\Log;


class ConsumableController extends AuthController
{
    //
    /**
     * 消耗品一覧を表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function consumable_master(Request $request)
    {
        Log::debug(print_r($this->login, true));
        
        // データを取得
        $consumable_list = Consumable::getConsumable();
        // dd($consumable_list);
        
        $data = ['consumable_list' => $consumable_list , 'login' => $this->login];
        
        return self::view($request, 'consumable_master', $data );
    }

    /**
     * 消耗品追加画面
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function add_consumable_master(Request $request)
    {
        Log::debug(print_r($this->login, true));
           
        $data = ['login' => $this->login];
        
        return self::view($request, 'add_consumable_master', $data );
    }
}
