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

        // dd($data);
        
        return self::view($request, 'buy_list', $data);
    }
    
    //
    /**
     * カテゴリ別の仕入一覧をを表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function buy_list_category($consumables_category_code, Request $request)
    {
        Log::debug(print_r($this->login, true));
        
        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 消耗品カテゴリデータと紐づく仕入データを参照
        $consumables_buy_all = ConsumablesData::viewConsumablesCategoryBuyAll($consumables_category_code);
        
        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_buy_all' => $consumables_buy_all,
            'login' => $this->login,
            'consumables_category_code' => 'all'
        ];
        
        return self::view($request, 'buy_list_category', $data);
    }

    /**
     * 読み込んだバーコードに紐づく消耗品の在庫を増やす。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function buy_consumables(Request $request)
    {
        Log::debug(print_r($this->login, true));
        // バーコードリーダーで読み取った数字を取得
        $handy_reader_data = $request->handy_reader_data;
        $buy_add = $request->buy_add;

        // $handy_reader_dataとバーコードが一致するデータを参照
        $consumables_buy_data = ConsumablesData::viewConsumablesBarcode($handy_reader_data);
        
        // $buy_addが1の時はカードの中身だけを増やす
        if ($buy_add == 0) {
            if ($consumables_buy_data) {
                // 在庫を増やす
                // Consumables::insert_consumables_buy($buy_quantity, $consumables_buy_data->consumables_code);
            } else {
                $consumables_buy_data = 0;
            }
            // データに渡したいデータを格納
            $data = [
                'handy_reader_data' => $handy_reader_data,
                'consumables_buy_data' => $consumables_buy_data,
                'login' => $this->login,
            ];
            // htmlを作成
            $html = view('include.buy_add', $data)->render();
            
            // htmlとデータをJson形式で返す
            return self::jsonHtml($request, $html, $data);
        } elseif ($buy_add == 1) {
            // データに渡したいデータを格納
            $data = [
                'handy_reader_data' => $handy_reader_data,
                'consumables_buy_data' => $consumables_buy_data,
                'login' => $this->login,
            ];
            // カードの中だけのhtmlを作成
            $html = view('include.buy_consumables', $data)->render();
            
            // htmlとデータをJson形式で返す
            return self::jsonHtml($request, $html, $data);
        }
    }

        
    /**
     * 仕入テーブルに追加。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit_buy(Request $request)
    {
        Log::debug(print_r($this->login, true));
        // POSTの値を全て取得
        $param = $request->all();
        // dd($param);
        $office_code = 91; //仕入事業所コード（今はアシスト固定）
        $staff_code = $param['staff_code'];

        foreach ($param['buys'] as $data) {
            // dd($data);
            // 出荷納品テーブルに追加
            Consumables::insert_consumables_buy(
                $data['consumables_code'], //消耗品コード
                $office_code, //仕入事業所コード
                $data['buy_number'], //出荷数
                $staff_code, //職員コード
                // $data['ship_date'], //出荷日
            ); 
        } 

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 消耗品仕入データを参照
        $consumables_buy_all = ConsumablesData::viewConsumablesBuyAll();

        // データに渡したいデータを格納
        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_buy_all' => $consumables_buy_all,
            'login' => $this->login,
            'consumables_category_code' => 'all'
        ];

        return self::view($request, 'buy_list', $data);
    }
    
// テスト用
    //
    /**
     * 仕入一覧をを表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function buy_list_test(Request $request)
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
        
        return self::view($request, 'buy_list_test', $data);
    }
    /**
     * 読み込んだバーコードに紐づく消耗品を表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function buy_consumables_test(Request $request)
    {
        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::getConsumablesCategoryAll();
        // 消耗品仕入データを参照
        $consumables_buy_all = ConsumablesData::viewConsumablesBuyAll();

        Log::debug(print_r($this->login, true));
        $param = $request->all();
        // バーコードリーダーで読み取った数字を取得

        $handy_reader_data = $param['consumables_barcode'];
        // dd($param, $handy_reader_data);
        $buy_quantity = 1; //仕入数量

        // $handy_reader_dataとバーコードが一致するデータを参照
        $consumables_buy_data = ConsumablesData::viewConsumablesBarcode($handy_reader_data);
        if ($consumables_buy_data) {
            // 在庫を増やす
            Consumables::insert_consumables_buy($buy_quantity, $consumables_buy_data->consumables_code);
        } else {
            $consumables_buy_data = 0;
        }
        // dd($consumables_buy_data);

        // データに渡したいデータを格納
        $data = [
            'handy_reader_data' => $handy_reader_data,
            'consumables_buy_data' => $consumables_buy_data,
            'consumables_category_all' => $consumables_category_all,
            'consumables_buy_all' => $consumables_buy_all,
            'login' => $this->login,
            'consumables_category_code' => 'all'
        ];

        // dd($data);
        
        return self::view($request, 'buy_list_test', $data);
    }

}
