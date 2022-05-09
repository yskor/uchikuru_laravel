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
}
