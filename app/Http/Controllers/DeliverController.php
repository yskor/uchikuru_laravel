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
     * QR読取画面を表示します。
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
    public function deliver_list($office_code, Request $request)
    {
        $status_code = "S";

        // 消耗品コードから消耗品を取得
        Log::debug(print_r($this->login, true));

        // 対象事業所の消耗品出荷データを取得
        $deliver_consumables_list = ConsumablesData::viewFacilityCategoryConsumablesDeliverList($office_code, $status_code);

        $data = [
            'deliver_consumables_list' => $deliver_consumables_list, //対象の事業所出荷一覧
            'office_code' => $office_code,
        ];
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
     * 消耗品の納品を行う
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deliver_consumables(Request $request)
    {

        // dd($request->all());
        if ($this->login->operation_type_code == 'LABO') {
            $value = [
                'staff_code' => $this->login->staff_code,
                'office_code_from' => 90, //出荷処理用
                'office_code_to' => $request->office_code_to, //出荷処理用
                'consumables_code' => $request->consumables_code,
                'ship_quantity' => $request->deliver_number,
                'deliver_number' => $request->deliver_number,
                'stock_number' => $request->stock_number,
            ];
            // dd($value);
            // dd($request->consumables_category_code,$request->office_code_to);

            $ship_code = Consumables::insert_consumables_ship($value);
            if ($ship_code) {
                $value['ship_code'] = $ship_code;
                Consumables::insert_consumables_deliver($value);
                $consumables = ConsumablesData::getConsumables($request->consumables_code);
                if ($consumables->quantity == 1) {
                    session()->flash('success_message', $consumables->consumables_name . 'を' . $value['deliver_number'] . '個納品しました');
                } else {
                    session()->flash('success_message', $consumables->consumables_name . 'を' . $value['deliver_number'] . '箱納品しました');
                }
            } else {
                session()->flash('error_message',  '納品処理に失敗しました');
            }
            $referer = $request->headers->get('referer');
            if(strpos($referer, 'shortage')) {
                return redirect()->route('shortage_consumables');
            } else {
                return redirect()->route('facility_category_stock_list', ['office_code' => $request->office_code_to, 'consumables_category_code' => $request->consumables_category_code]);
            }
        } else {
            $value = [
                'staff_code' => $this->login->staff_code,
                'office_code_from' => 91,
                'office_code_to' => $request->office_code_to,
                'ship_code' => $request->ship_code,
                'consumables_code' => $request->consumables_code,
                'deliver_number' => $request->deliver_number,
                'stock_number' => $request->stock_number,
                'status_code' => 'S',
            ];
            Consumables::insert_consumables_deliver($value);
            // 対象事業所の消耗品出荷データを取得
            $deliver_consumables_list = ConsumablesData::viewFacilityCategoryConsumablesDeliverList($value['office_code_to'], $value['status_code']);

            foreach ($deliver_consumables_list as $data) {
                if ($data->stock_number == null) {
                    $data->stock_number = 0;
                }
            }

            $consumables = ConsumablesData::viewConsumablesShipData($value['ship_code']);
            if ($consumables->quantity == 1) {
                session()->flash('success_message', $consumables->consumables_name . 'を' . $value['deliver_number'] . '個納品しました');
            } else {
                session()->flash('success_message', $consumables->consumables_name . 'を' . $value['deliver_number'] . '箱納品しました');
            }

            return redirect()->route('deliver_list', ['office_code' => $request->office_code_to]);
        }
    }


    //
    /**
     * 納品状況を確認する消耗品選択画面（消耗品一覧）
     * @param int $consumables_category_code
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deliver_status($consumables_category_code, Request $request)
    {
        $wheres = [
            'consumables_category_code' => $consumables_category_code,
            'operation_type_code' => $this->login->operation_type_code,
        ];

        $facility_list = OfficeData::getfacilityAll();
        $consumables_category_list = ConsumablesData::getConsumablesCategoryList($wheres);
        $consumables_list = ConsumablesData::getConsumablesList($wheres);

        $data = [
            'facility_list' => $facility_list,
            'consumables_category_list' => $consumables_category_list,
            'consumables_list' => $consumables_list,
            'consumables_category_code' => $consumables_category_code,
            'search_name' => '', //検索キーワード
            'login' => $this->login,
            'office_code' => 'all',
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
        $wheres = [
            'operation_type_code' => $this->login->operation_type_code,
        ];
        $search_name = $request->keyword;
        $consumables_category_code = Null;

        $consumables_category_list = ConsumablesData::getConsumablesCategoryList($wheres);
        // カテゴリ内のキーワードと一致するデータ参照
        $consumables_list = ConsumablesData::viewCategoryConsumablesSearchList($consumables_category_code, $search_name);

        $data = [
            'consumables_category_list' => $consumables_category_list,
            'consumables_list' => $consumables_list,
            'consumables_category_code' => $consumables_category_code,
            'search_name' => $search_name, //検索キーワード
            'login' => $this->login,
            'office_code' => 'all',
        ];

        return self::view($request, 'deliver_status', $data);
    }


    //
    /**
     * 消耗品別の納品状況を表示します。
     * @param int $consumables_category_code
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function facility_deliver_status($consumables_category_code, $office_code, Request $request)
    {
        $wheres = [
            'consumables_category_code' => $consumables_category_code,
            'operation_type_code' => $this->login->operation_type_code,
        ];

        $consumables_category_list = ConsumablesData::getConsumablesCategoryList($wheres);

        $facility_list = OfficeData::getfacilityAll();

        $office_data = OfficeData::getOffice($office_code);

        // 対象消耗品の全施設出荷データを取得
        $deliver_status = Consumables::viewFacilityDeliverStatus($wheres, $office_code);

        $data = [
            'facility_list' => $facility_list, //全ての事業所データ
            'consumables_category_list' => $consumables_category_list,
            'deliver_status' => $deliver_status,
            'consumables_category_code' => $consumables_category_code,
            'search_name' => '', //検索キーワード
            'login' => $this->login,
            'office_code' => $office_code,
            'office_data' => $office_data,
        ];
        return self::view($request, 'facility_deliver_status', $data);
    }

    //
    /**
     * 消耗品別の納品状況を表示します。
     * @param int $consumables_category_code
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function week_deliver_status($consumables_category_code, $consumables_code, Request $request)
    {
        $wheres = [
            'operation_type_code' => $this->login->operation_type_code,
        ];

        $consumables_category_list = ConsumablesData::getConsumablesCategoryList($wheres);

        $facility_list = OfficeData::getfacilityAll();

        // 対象の消耗品を取得
        $consumables = ConsumablesData::getConsumables($consumables_code);

        // 対象消耗品の全施設出荷データを取得
        $deliver_status = ConsumablesData::viewConsumablesDeliverStatusWeek($facility_list, $consumables_code);

        $data = [
            'facility_list' => $facility_list, //全ての事業所データ
            'consumables_category_list' => $consumables_category_list,
            'deliver_status' => $deliver_status,
            'consumables_category_code' => $consumables_category_code,
            'consumables_code' => $consumables_code, //消耗品コード
            'consumables' => $consumables, //消耗品データ
            'search_name' => '', //検索キーワード
            'login' => $this->login,
            'office_code' => 'all',
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
        $facility_list = OfficeData::getfacilityAll();

        // 消耗品カテゴリデータを取得
        $consumables_category_list = ConsumablesData::viewConsumablesCategoryAll();

        // 対象の消耗品を取得
        $consumables = ConsumablesData::getConsumables($consumables_code);

        // 対象消耗品の全施設出荷データを取得
        $deliver_status = ConsumablesData::viewConsumablesDeliverStatusMonth($facility_list, $consumables_code);

        $data = [
            'facility_list' => $facility_list, //全ての事業所データ
            'consumables_category_list' => $consumables_category_list,
            'deliver_status' => $deliver_status,
            'consumables_category_code' => $consumables_category_code,
            'consumables_code' => $consumables_code, //消耗品コード
            'consumables' => $consumables, //消耗品データ
            'search_name' => '', //検索キーワード
            'login' => $this->login,
            'office_code' => 'all',
        ];

        return self::view($request, 'month_deliver_status', $data);
    }
}
