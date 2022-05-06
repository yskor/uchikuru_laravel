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
    // public function consumption(Request $request)
    // {
    //     Log::debug(print_r($this->login, true));
        
    //     $data = [
    //         'login' => $this->login,
    //     ];

    //     return self::view($request, 'consumption', $data);
    // }

    /**
     * QRコードで読み取った消耗品コードに紐づく出荷消耗品を返す
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function consumption_consumables($consumables_code, Request $request)
    {
        try {
            // $consumables_barcode = $request->qrcode;
            $office_code = $this->login->office_code;
            Log::debug(print_r($this->login, true));
            
            // バーコードから消耗品を取得
            // $consumables = ConsumablesData::viewConsumablesBarcode($consumables_barcode);
            $consumables = ConsumablesData::viewOneConsumables($consumables_code);
            // $consumables_code = $consumables->consumables_code;
            $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, $office_code);
            
            // カードの中だけのhtmlを作成
            $data = [
                'consumables' => $consumables,
                'consumables_stock' => $consumables_stock,
            ];
            // dd($data);
            // $html = view('include.consumption.consumption_consumables', $data)->render();
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            throw new \Exception("読み込みエラーです。もう一度QRコードを読み込んでください");
        }
        // htmlとデータをJson形式で返す
        // return self::jsonHtml($request, $html, $data);
        return self::view($request, 'consumption', $data);
    }

    /**
     * QRコードで読み取った消耗品コードに紐づく消耗品を減らす
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function consumption_done(Request $request)
    {
        try {
            $consumables_code = $request['consumables_code'];
            $office_code = $this->login->office_code;
            $staff_code = $this->login->staff_code;
            Log::debug(print_r($this->login, true));
            
            // バーコードから消耗品を取得
            $consumables = ConsumablesData::viewOneConsumables($consumables_code);
            $consumption_quantity = $consumables->use_quantity;
            $consumption_unit_code = $consumables->use_unit_code;

            // 消費テーブルに追加
            Consumables::insert_consumables_consumption(
                $consumables_code,
                $office_code,
                $consumption_quantity, //消費数量
                $consumption_unit_code, //消費単位
                $staff_code
            );
    
            // 消耗品コードから現在の在庫を参照
            $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, $office_code);
    
            // dd($data, $office_code, $consumables_stock, $consumables_code);
            // カードの中だけのhtmlを作成
            $data = [
                'consumables' => $consumables,
                'consumption_quantity' => $consumption_quantity,
                'consumables_stock_number' => $consumables_stock->stock_number,
                'consumables_stock_quantity' => $consumables_stock->stock_quantity,
                'consumables_stock' => $consumables_stock,
            ];
    
            session()->flash('succes_message', '在庫数を減らしました');
    
            // dd($data);
            // $html = view('modal.consumption_consumables', $data)->render();

        } catch (\Exception $e) {
            ConsumablesData::rollback();
            session()->flash('miss_message', '処理に失敗しました');
            
        }
        
        return self::view($request, 'consumption_done', $data);
    }

}
