<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use App\Models\Data\ConsumablesData;
use App\Models\Consumables;
use App\Models\Data\OfficeData;
use App\Models\Data\Table\ConsumablesTable;
use App\Models\Data\Table\OfficeTable;
use Illuminate\Support\Facades\Log;


class BuyController extends AuthController
{
    //
    /**
     * 仕入一覧をを表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function buy_list(Request $request)
    {
        Log::debug(print_r($this->login, true));

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 消耗品仕入データを参照
        $consumables_buy_all = ConsumablesData::viewConsumablesBuyAll();

        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_buy_all' => $consumables_buy_all,
            'login' => $this->login,
            'consumables_category_code' => 'all'
        ];
        
        return self::view($request, 'buy_list', $data);
    }
    
    //
    /**
     * カテゴリ別の仕入一覧をを表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function buy_list_category(Request $request)
    {
        Log::debug(print_r($this->login, true));
        
        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 消耗品仕入データを参照
        $consumables_buy_all = ConsumablesData::viewConsumablesBuyAll();
        
        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_buy_all' => $consumables_buy_all,
            'login' => $this->login,
            'consumables_category_code' => 'all'
        ];
        
        return self::view($request, 'buy_list_category', $data);
    }

    //
    /**
     * 仕入一覧をを表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function buy_consumables($handy_reader_data, Request $request)
    {
        Log::debug(print_r($this->login, true));
        // $handy_reader_dataとバーコードが一致するデータを参照
        // 仕入テーブルに追加
        // $consumables_buy_data = ConsumablesData::viewConsumablesBuyData($handy_reader_data);
        // dd($consumables_buy_data);
        // $data = [
        //     'consumables_buy_data' => $consumables_buy_data,
        //     'login' => $this->login,
        // ];
            $data = 'コントローラ';
        
        // return response()->json($consumables_buy_data);
        return response()->json($data);
    }
    // public function getUsersBySearchName($userName)
    // {
    //     $data = 'コントローラ';
    //     return response()->json($data);
    // }

    // //
    // /**
    //  * 仕入一覧をを表示します。
    //  * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    //  */
    // public function buy_consumables($handy_reader_data, Request $request)
    // {
    //     Log::debug(print_r($this->login, true));
        
    //     // POSTの値を全て受け取る
    //     $param = $request->all();

    //     // 消耗品カテゴリデータを取得
    //     $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
    //     // 消耗品仕入データを参照
    //     $consumables_buy_all = ConsumablesData::viewConsumablesBuyAll();
        
    //     // $handy_reader_dataとバーコードが一致するデータを参照
    //     $consumables_buy_data = ConsumablesData::viewConsumablesBuyData($handy_reader_data);
    //     // 仕入テーブルに追加
    //     Consumables::insert_consumables_buy($handy_reader_data);
    
    //     $data = [
    //         'consumables_category_all' => $consumables_category_all,
    //         'consumables_buy_all' => $consumables_buy_all,
    //         'login' => $this->login,
    //         'consumables_category_code' => 'all'
    //     ];
        
    //     return self::view($request, 'buy_list', $data);
    // }

}
