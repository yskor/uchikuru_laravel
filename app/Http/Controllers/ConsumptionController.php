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

}
