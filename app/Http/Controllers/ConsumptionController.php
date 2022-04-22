<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use App\Models\Data\ConsumablesData;
use App\Models\Consumables;
use App\Models\Data\OfficeData;
use Illuminate\Support\Facades\Log;
use Exception;
use PhpOption\None;

class ConsumptionController extends AuthController
{

    
    /**
     * 消費画面
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function consumption(Request $request)
    {
        Log::debug(print_r($this->login, true));
        
        $data = [
            'login' => $this->login,
        ];

        return self::view($request, 'consumption', $data);
    }

    public function consumption_done(Request $request)
    {
        Log::debug(print_r($this->login, true));
        $param = $request->all();
        $consumables_code = $param["consumables_code"];
        $office_code = $this->login->office_code;
        $total_stock_quantity = $param["total_stock_quantity"];
        $consumption_quantity = $param["consumption_quantity"];
        $staff_code = $this->login->office_code;

        Consumables::insert_consumables_consumption(
            $consumables_code,
            $office_code,
            $total_stock_quantity, //在庫総数
            $consumption_quantity, //消費数量
            $staff_code
        );

        $data = [
            'login' => $this->login,
        ];

        return self::view($request, 'consumption_done', $data);
    }

    /**
     * QRコードで読み取った消耗品コードに紐づく出荷消耗品を返す
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function consumption_consumables(Request $request)
    {
        $consumables_barcode = $request->qrcode;
        $office_code = $this->login->office_code;
        Log::debug(print_r($this->login, true));
        
        // バーコードから消耗品を取得
        $consumables = ConsumablesData::viewConsumablesBarcode($consumables_barcode);
        $consumables_code = $consumables->consumables_code;
        $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, $office_code);
        
        $total_stock_quantity = $consumables_stock->stock_number * $consumables->quantity + $consumables_stock->stock_quantity;
        
        // dd($data, $office_code, $consumables_stock, $consumables_code);
        // カードの中だけのhtmlを作成
        $data = [
            'consumables' => $consumables,
            'consumables_stock' => $consumables_stock,
            'total_stock_quantity' => $total_stock_quantity,
        ];
        // dd($data);
        $html = view('modal.consumption_consumables', $data)->render();
        
        // htmlとデータをJson形式で返す
        return self::jsonHtml($request, $html, $data);
    }

    /**
     * QRコードで読み取った施設の出荷リストを返す
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deliver_table(Request $request)
    {
        $office_qrcode = $request->qrcode;
        $office_data = OfficeData::viewOfficeData($office_qrcode);
        
        Log::debug(print_r($this->login, true));

        $deliver_consumables_list = ConsumablesData::viewFacilityConsumablesShip($office_qrcode);

        $data = [
            'deliver_consumables_list' => $deliver_consumables_list,
            'office_data' => $office_data,
        ];
        // dd($data, $office_code, $consumables_code);
        // 未納品の消耗品リストテーブルのhtmlを作成
        $html = view('include.deliver_table', $data)->render();
        
        // htmlとデータをJson形式で返す
        return self::jsonHtml($request, $html, $data);
    }

    /**
     * QRコードで読み取った消耗品コードに紐づく消耗品の納品を行う
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit_deliver(Request $request)
    {

        // dd($request->all());
        $ship_code = $request->ship_code;
        $staff_code = $this->login->staff_code;
        $office_code = $this->login->office_code;
        $consumables_code = $request->consumables_code;
        $deliver_number = $request->deliver_number;

        // 消耗品コードから消耗品を取得
        Consumables::insert_consumables_deliver($ship_code, $consumables_code, $office_code, $deliver_number, $staff_code);
        // $consumables_code = 4520951011185;
        Log::debug(print_r($this->login, true));

        // 対象事業所の消耗品出荷データを取得＊バーコードが増えた時に対応できていない
        $consumables_ship_list = ConsumablesData::viewFacilityConsumablesShipList($office_code);

        $data = [
            'consumables_ship_list' => $consumables_ship_list, //対象の事業所出荷一覧
            'office_code' => $office_code,
        ];
        // dd($data, $office_code, $consumables_code);
        return self::view($request, 'deliver_list', $data);
    }
}
