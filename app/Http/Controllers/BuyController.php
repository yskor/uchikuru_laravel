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
use PhpOption\None;

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

        // 消耗品カテゴリデータを参照
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
        // 消耗品カテゴリデータと紐づく仕入データを参照
        $consumables_buy_all = ConsumablesData::viewConsumablesCategoryBuyAll($consumables_category_code);
        // 消耗品の仕入先施設を参照
        $buy_facility_all = ConsumablesData::viewConsumablesBuyFacility($office_code=Null);

        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_buy_all' => $consumables_buy_all,
            'buy_facility_all' => $buy_facility_all,
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
        // 消耗品の仕入先施設を参照
        $buy_facility_all = ConsumablesData::viewConsumablesBuyFacility($office_code=Null);

        $data = [
            'consumables_category_all' => $consumables_category_all,
            'consumables_buy_all' => $consumables_buy_all,
            'consumables_category_code' => $consumables_category_code,
            'buy_facility_all' => $buy_facility_all,
            'search_name' => $search_name,
        ];

        return self::view($request, 'buy_list_category_search', $data);
    }

    /**
     * 読み込んだバーコードに紐づく消耗品の仕入画面を表示する
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
        // 消耗品の仕入先施設を参照
        $buy_facility_all = ConsumablesData::viewConsumablesBuyFacility($office_code=Null);

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
                    'buy_facility_all' => $buy_facility_all,
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
                    'buy_facility_all' => $buy_facility_all,
                    'consumables_buy_data' => $consumables_buy_data,
                ];
                // カードの中だけのhtmlを作成
                $html = view('include.buy.buy_consumables', $data)->render();
            }
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            // throw new \Exception("読み込みエラーです。バーコードが登録されていません。");
            throw $e;
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
        $staff_code = $this->login->staff_code;
        $office_code = $param['office_code_to']; //仕入事業所コード（今はアシスト固定）
        foreach ($param['buys'] as $data) {
            // 仕入テーブルに追加
            Consumables::insert_consumables_buy(
                $data, //仕入れデータ
                $office_code, //仕入事業所コード
                $staff_code, //職員コード
            );
        }

        session()->flash('success_message', '消耗品を仕入ました');

        return redirect()->route('buy_list_category', ['consumables_category_code' => $consumables_category_code]);
    }
}
