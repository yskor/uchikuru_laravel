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
     * QRコードで読み取った消耗品コードに紐づく出荷消耗品を返す
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function consumption($consumables_code, Request $request)
    {
        $office_code = $this->login->office_code;
        Log::debug(print_r($this->login, true));

        // バーコードから消耗品を取得
        $consumables = ConsumablesData::getConsumables($consumables_code);
        $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, $office_code);
        // dd($consumables_stock);
        if (!$consumables_stock) {
            // 在庫テーブルに存在しない場合
            session()->flash('error_message', $consumables->consumables_name . 'は在庫がありません');
        } elseif ($consumables_stock->use_unit_code == 'N' and $consumables_stock->stock_number < $consumables->use_quantity) {
            // 使用単位がNで在庫が使用数を下回る場合
            session()->flash('error_message', $consumables->consumables_name . 'は在庫がありません');
        } elseif ($consumables_stock->use_unit_code == 'Q' and $consumables_stock->stock_quantity < $consumables->use_quantity and $consumables_stock->stock_number < $consumables->use_quantity) {
            session()->flash('error_message', $consumables->consumables_name . 'は在庫がありません');
        }
        // カードの中だけのhtmlを作成
        $data = [
            'consumables' => $consumables,
            'consumables_stock' => $consumables_stock,
        ];
        return self::view($request, 'consumption', $data);
    }

    /**
     * QRコードで読み取った消耗品コードに紐づく消耗品を減らす
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function consumption_done(Request $request)
    {
        $consumables_code = $request['consumables_code'];
        $office_code = $this->login->office_code;
        $staff_code = $this->login->staff_code;
        Log::debug(print_r($this->login, true));

        // バーコードから消耗品を取得
        $consumables = ConsumablesData::getConsumables($consumables_code);
        $consumption_quantity = $consumables->use_quantity;
        $consumption_unit_code = $consumables->use_unit_code;
        try {
            $wheres = [
                'consumables_code' => $consumables_code,
                'office_code' => $office_code,
                'consumption_quantity' => $consumption_quantity, //消費数量
                'consumption_unit_code' => $consumption_unit_code, //消費単位
                'staff_code' => $staff_code
            ];
            // 消費テーブルに追加
            Consumables::insert_consumables_consumption($wheres);

            session()->flash('success_message', '在庫を持ち出しました');
        } catch (\Exception $e) {
            ConsumablesData::rollback();
            session()->flash('error_message', '処理に失敗しました');
        }
        // 消耗品コードから現在の在庫を参照
        $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, $office_code);

        // dd($office_code,$consumables_code,$consumables_stock);
        $data = [
            'consumables' => $consumables,
            'consumption_quantity' => $consumption_quantity,
            'consumables_stock_number' => $consumables_stock->stock_number,
            'consumables_stock_quantity' => $consumables_stock->stock_quantity,
            'consumables_stock' => $consumables_stock,
        ];

        // dd($data);

        return self::view($request, 'consumption_done', $data);
    }
}
