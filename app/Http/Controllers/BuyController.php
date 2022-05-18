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
    // /**
    //  * 仕入一覧をを表示します。
    //  * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    //  */
    // public function buy_list(Request $request)
    // {
    //     Log::debug(print_r($this->login, true));

    //     // 消耗品カテゴリデータを取得
    //     $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
    //     // 消耗品仕入データを参照
    //     $consumables_buy_all = ConsumablesData::viewConsumablesBuyAll();

    //     $data = [
    //         'consumables_category_all' => $consumables_category_all,
    //         'consumables_buy_all' => $consumables_buy_all,
    //         'login' => $this->login,
    //         'consumables_category_code' => 1
    //     ];

    //     // dd($data);

    //     return self::view($request, 'buy_list', $data);
    // }

    //
    /**
     * カテゴリ別の仕入一覧をを表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function buy_list_category($consumables_category_code, Request $request)
    {
        Log::debug(print_r($this->login, true));

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
        // 消耗品カテゴリデータと紐づく仕入データを参照
        $consumables_buy_all = ConsumablesData::viewConsumablesCategoryBuyAll($consumables_category_code);

        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_buy_all' => $consumables_buy_all,
            'consumables_category_code' => $consumables_category_code,
            'search_name' => '',
        ];

        return self::view($request, 'buy_list_category', $data);
    }

    //
    /**
     * キーワードに基づくの仕入一覧をを表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function buy_list_category_search($consumables_category_code, Request $request)
    {
        Log::debug(print_r($this->login, true));
        $search_name = $request->keyword;

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
        // カテゴリ内のキーワードと一致するデータ参照
        $consumables_buy_all = ConsumablesData::viewConsumablesCategoryBuySearchAll($consumables_category_code, $search_name);

        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_buy_all' => $consumables_buy_all,
            'consumables_category_code' => $consumables_category_code,
            'search_name' => $search_name,
        ];

        return self::view($request, 'buy_list_category_search', $data);
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
        $consumables_category_code = $request->consumables_category_code;

        // $handy_reader_dataとバーコードが一致するデータを参照
        $consumables_buy_data = ConsumablesData::viewBuyConsumablesBarcode($handy_reader_data);

        try {
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
                    'login' => $this->login,
                    'consumables_category_code' => $consumables_category_code,
                    'consumables_buy_data' => $consumables_buy_data,
                ];
                // htmlを作成
                $html = view('include.buy.buy_add', $data)->render();

                // htmlとデータをJson形式で返す
                return self::jsonHtml($request, $html, $data);
            } elseif ($buy_add == 1) {
                // データに渡したいデータを格納
                $data = [
                    'handy_reader_data' => $handy_reader_data,
                    'login' => $this->login,
                    'consumables_category_code' => $consumables_category_code,
                    'consumables_buy_data' => $consumables_buy_data,
                ];
                // カードの中だけのhtmlを作成
                $html = view('include.buy.buy_consumables', $data)->render();
            }
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw new \Exception("読み込みエラーです。段ボール以外のバーコードが読み込まれているか、バーコードが登録されていません。");
        }
        // htmlとデータをJson形式で返す
        return self::jsonHtml($request, $html, $data);
    }


    /**
     * 仕入テーブルに追加。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit_buy($consumables_category_code, Request $request)
    {
        Log::debug(print_r($this->login, true));
        // POSTの値を全て取得
        $param = $request->all();
        // dd($param);
        $office_code = 91; //仕入事業所コード（今はアシスト固定）
        $staff_code = $param['staff_code'];

        foreach ($param['buys'] as $data) {
            // dd($data);
            // 仕入テーブルに追加
            Consumables::insert_consumables_buy(
                $data['consumables_code'], //消耗品コード
                $office_code, //仕入事業所コード
                $data['buy_number'], //出荷数
                $staff_code, //職員コード
                // $data['ship_date'], //出荷日
            );
        }

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
        // 消耗品仕入データを参照
        $consumables_buy_all = ConsumablesData::viewConsumablesBuyAll();

        // データに渡したいデータを格納
        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_buy_all' => $consumables_buy_all,
            'consumables_category_code' => $consumables_category_code,
            'search_name' => '',
        ];

        session()->flash('success_message', '消耗品を仕入ました');

        return self::view($request, 'buy_list_category', $data);
    }
}
