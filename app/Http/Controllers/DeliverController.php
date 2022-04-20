<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use App\Models\Data\ConsumablesData;
use App\Models\Consumables;
use Illuminate\Support\Facades\Log;


class DeliverController extends AuthController
{
    //
    /**
     * 納品リストを表示します。
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deliver_list(Request $request)
    {
        Log::debug(print_r($this->login, true));

        $office_code = $this->login->office_code;
        
        // 対象事業所の消耗品出荷データを取得＊バーコードが増えた時に対応できていない
        $consumables_ship_list = ConsumablesData::viewFacilityConsumablesShipList($office_code);
        
        $data = [
            'consumables_ship_list' => $consumables_ship_list, //対象の事業所出荷一覧
            'login' => $this->login,
        ];

        return self::view($request, 'deliver_list', $data);
    }

    /**
     * QRコードを返す
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function qrreader(Request $request)
    {
        Log::debug(print_r($this->login, true));
        // カードの中だけのhtmlを作成
        $html = view('include.qr')->render();
        
        // htmlとデータをJson形式で返す
        return self::jsonHtml($request, $html);
    }

    /**
     * QRコードで読み取った消耗品コードに紐づく出荷消耗品を返す
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deliver_consumables(Request $request)
    {
        $consumables_barcode = $request->qrcode;
        
        // バーコードから消耗品を取得
        $consumables = ConsumablesData::viewConsumablesBarcode($consumables_barcode);
        $consumables_code = $consumables->consumables_code;
        // $consumables_code = 4520951011185;
        $office_code = $this->login->office_code;
        Log::debug(print_r($this->login, true));

        $ship_consumables = ConsumablesData::viewFacilityConsumablesShip($office_code, $consumables_code);

        $data = [
            'ship_consumables' => $ship_consumables,
        ];
        // dd($data, $office_code, $consumables_code);
        // カードの中だけのhtmlを作成
        $html = view('modal.deliver_consumables', $data)->render();
        
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
