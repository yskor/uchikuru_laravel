<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use App\Models\Data\ConsumablesData;
use App\Models\Consumables;
use App\Models\Data\OfficeData;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Null_;
use PhpOption\None;

class DeliverController extends AuthController
{
    //
    /**
     * 納品リストを表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deliver(Request $request)
    {
        Log::debug(print_r($this->login, true));

        $data = [
            'login' => $this->login,
        ];

        return self::view($request, 'deliver', $data);
    }
    //
    /**
     * 納品リストを表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deliver_list(Request $request)
    {
        $staff_code = $this->login->staff_code;
        $office_code = $request->office_code;
        $ship_code = $request->ship_code;
        $consumables_code = $request->consumables_code;
        $deliver_number = $request->deliver_number;
        $stock_number = $request->stock_number;
        $status_code = "S";
        // dd($request->all());
        Consumables::insert_consumables_deliver(
            $ship_code,
            $consumables_code,
            $office_code,
            $deliver_number,
            $stock_number,
            $staff_code
        );

        // 消耗品コードから消耗品を取得
        Log::debug(print_r($this->login, true));

        // 対象事業所の消耗品出荷データを取得
        $deliver_consumables_list = ConsumablesData::viewFacilityCategoryConsumablesDeliverList($office_code, $status_code);

        foreach ($deliver_consumables_list as $data) {
            if ($data->stock_number == null) {
                $data->stock_number = 0;
            }
        }

        $data = [
            'deliver_consumables_list' => $deliver_consumables_list, //対象の事業所出荷一覧
            'office_code' => $office_code,
            // 'office_data' => $office_data,
        ];
        // dd($data, $office_code, $consumables_code);
        return self::view($request, 'deliver_list', $data);
    }

    /**
     * QRコードで読み取った施設の出荷リストを返す
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deliver_table(Request $request)
    {
        try {

            $office_qrcode = $request->qrcode;
            $office_data = OfficeData::viewOfficeData($office_qrcode);
            $office_code = $office_data->office_code;
            $status_code = "S";

            Log::debug(print_r($this->login, true));

            $deliver_consumables_list = ConsumablesData::viewFacilityCategoryConsumablesDeliverList($office_code, $status_code);

            foreach ($deliver_consumables_list as $data) {
                if ($data->stock_number == null) {
                    $data->stock_number = 0;
                }
            }
            $data = [
                'deliver_consumables_list' => $deliver_consumables_list,
                'office_code' => $office_code,
            ];
            // 未納品の消耗品リストテーブルのhtmlを作成
            $html = view('include.deliver.deliver_table', $data)->render();
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw new \Exception("読み込みエラーです。施設QRコード以外のQRコードを読み込んでいるか、バーコードが登録されていません。");
        }

        // htmlとデータをJson形式で返す
        return self::jsonHtml($request, $html, $data);
    }

    /**
     * QRコードで読み取った消耗品コードに紐づく消耗品の納品を行う
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deliver_consumables(Request $request)
    {

        // dd($request->all());
        $staff_code = $this->login->staff_code;
        $office_code = $request->office_code;
        $ship_code = $request->ship_code;
        $consumables_code = $request->consumables_code;
        $deliver_number = $request->deliver_number;
        $stock_number = $request->stock_number;
        $status_code = "S";
        Consumables::insert_consumables_deliver($ship_code, $consumables_code, $office_code, $deliver_number, $stock_number, $staff_code);

        // 消耗品コードから消耗品を取得
        Log::debug(print_r($this->login, true));

        // 対象事業所の消耗品出荷データを取得
        $deliver_consumables_list = ConsumablesData::viewFacilityCategoryConsumablesDeliverList($office_code, $status_code);

        foreach ($deliver_consumables_list as $data) {
            if ($data->stock_number == null) {
                $data->stock_number = 0;
            }
        }

        $consumables = ConsumablesData::viewConsumablesShipData($ship_code);
        session()->flash('message', $consumables->consumables_name . 'を' .$deliver_number. '箱納品しました');

        $data = [
            'deliver_consumables_list' => $deliver_consumables_list, //対象の事業所出荷一覧
            'office_code' => $office_code,
        ];
        return self::view($request, 'deliver_list', $data);
    }

    
    //
    /**
     * 納品状況を確認する消耗品選択画面（消耗品一覧）
     * @param int $consumables_category_code
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deliver_status($consumables_category_code, Request $request)
    {
        // 消耗品カテゴリデータを参照
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
        // カテゴリごとの消耗品識別データ参照
        $consumables_all = ConsumablesData::getCategoryConsumablesList($consumables_category_code);

        $data = [
            'consumables_category_all' => $consumables_category_all, //全てのカテゴリデータ
            'consumables_all' => $consumables_all, //消耗品の全施設出荷データ
            'consumables_category_code' => $consumables_category_code, //消耗品の全施設出荷データ
            'search_name' => '', //検索キーワード
            'login' => $this->login,
        ];

        return self::view($request, 'deliver_status', $data);
    }

    //
    /**
     * 納品状況を確認する消耗品選択画面（消耗品一覧）
     * @param int $consumables_category_code
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deliver_status_search(Request $request)
    {
        $search_name = $request->keyword;
        // 消耗品カテゴリデータを参照
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();
        // カテゴリ内のキーワードと一致するデータ参照
        $consumables_category_code = Null;
        $consumables_all = ConsumablesData::viewCategoryConsumablesSearchList($consumables_category_code, $search_name);

        $data = [
            'consumables_category_all' => $consumables_category_all, //全てのカテゴリデータ
            'consumables_all' => $consumables_all, //消耗品の全施設出荷データ
            'consumables_category_code' => $consumables_category_code,
            'search_name' => $search_name, //検索キーワード
            'login' => $this->login,
        ];

        return self::view($request, 'deliver_status', $data);
    }

    //
    /**
     * 消耗品別の納品状況を表示します。
     * @param int $consumables_category_code
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function week_deliver_status($consumables_category_code, $consumables_code, Request $request)
    {
        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();

        // 対象の消耗品を取得
        $consumables = ConsumablesData::viewOneConsumables($consumables_code);

        // 対象消耗品の全施設出荷データを取得
        $deliver_status = ConsumablesData::viewConsumablesDeliverStatusWeek($facility_all, $consumables_code);

        $data = [
            'facility_all' => $facility_all, //全ての事業所データ
            'consumables_category_all' => $consumables_category_all, //全てのカテゴリデータ
            'deliver_status' => $deliver_status, //消耗品の全施設出荷データ
            'consumables_category_code' => $consumables_category_code, //消耗品の全施設出荷データ
            'consumables_code' => $consumables_code, //消耗品コード
            'consumables' => $consumables, //消耗品データ
            'search_name' => '', //検索キーワード
            'login' => $this->login,
        ];
        return self::view($request, 'week_deliver_status', $data);
    }

    //
    /**
     * 消耗品別の納品状況を表示します。
     * @param int $consumables_category_code
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function month_deliver_status($consumables_category_code, $consumables_code, Request $request)
    {
        // 事業所マスタから事業所を全て参照
        $facility_all = OfficeData::viewfacilityAll();

        // 消耗品カテゴリデータを取得
        $consumables_category_all = ConsumablesData::viewConsumablesCategoryAll();

        // 対象の消耗品を取得
        $consumables = ConsumablesData::viewOneConsumables($consumables_code);

        // 対象消耗品の全施設出荷データを取得
        $deliver_status = ConsumablesData::viewConsumablesDeliverStatusMonth($facility_all, $consumables_code);

        $data = [
            'facility_all' => $facility_all, //全ての事業所データ
            'consumables_category_all' => $consumables_category_all, //全てのカテゴリデータ
            'deliver_status' => $deliver_status, //消耗品の全施設出荷データ
            'consumables_category_code' => $consumables_category_code, //消耗品の全施設出荷データ
            'consumables_code' => $consumables_code, //消耗品コード
            'consumables' => $consumables, //消耗品データ
            'search_name' => '', //検索キーワード
            'login' => $this->login,
        ];

        return self::view($request, 'month_deliver_status', $data);
    }

}
