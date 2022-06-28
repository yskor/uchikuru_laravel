<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Data\Table\ConsumablesTable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * 入居者データクラス
 * @author Kodo Hori
 *
 */
class ShipConsumablesData extends BaseData
{
    use HasFactory;

    /**
     *　出荷テーブルに追加。
     */
    public static function insert_ship($data)
    {
        $ship_values = [
            "消耗品コード" => $data['consumables_code'],
            "出荷元事業所コード" => $data['office_code_from'],
            "出荷数" => $data['ship_quantity'],
            "出荷職員コード" => $data['staff_code'],
            "消耗品変動状態コード" => 'S',
            "出荷日時" => now(),
            "納品先事業所コード" => $data['office_code_to'],
        ];
        ConsumablesTable::tableConsumablesShip()->insert($ship_values);
    }

    /**
     *　出荷に伴う在庫数の変更
     */
    public static function update_stock($ship_from_stock, $data)
    {
    //    dd($ship_from_stock);
        if($ship_from_stock->use_unit_code == "Q") {
            // 在庫数量算出
            $total_stock_quantity = $ship_from_stock->stock_number * $ship_from_stock->quantity + $ship_from_stock->stock_quantity;
            $total_stock_quantity = $total_stock_quantity - $data['ship_quantity'];
            $stock_number = floor($total_stock_quantity / $ship_from_stock->quantity);
            $stock_quantity = ($total_stock_quantity % $ship_from_stock->quantity);
            $dec_values = [
                "消耗品コード" => $data['consumables_code'],
                "個数在庫数" => $stock_number,
                "入数在庫数" => $stock_quantity,
                "更新日時" => now(),
            ];
        } else {
            $dec_values = [
                "消耗品コード" => $data['consumables_code'],
                "個数在庫数" => $ship_from_stock->stock_number - $data['ship_quantity'],
                "入数在庫数" => $ship_from_stock->quantity,
                "更新日時" => now(),
            ];
        }
        ConsumablesData::getConsumablesStockData($data['consumables_code'], $data['office_code_from'])->update($dec_values);
    }

    /**
     *　出荷に伴う在庫数の変更
     */
    public static function cancel_ship($ship_code, $office_code)
    {
        // 出荷情報を参照
        $ship_data = ConsumablesData::viewConsumablesShipData($ship_code);
        // dd($ship_data);
        $consumables_code = $ship_data->consumables_code; //消耗品コード
        $ship_number = $ship_data->shipped_number; //出荷数量
        $head_office_code = 91; //本部
        // 消耗品コードから本部の現在の在庫を参照
        $consumables_stock = ConsumablesData::viewConsumablesStockData($consumables_code, $head_office_code);
        $cancel_values = [
            "個数在庫数" => $consumables_stock->stock_number + $ship_number,
            "更新日時" => now(),
        ];
        // 本部の在庫をキャンセル分増やす
        ConsumablesData::getConsumablesStockData($consumables_code, $head_office_code)->update($cancel_values);
        // 出荷コードが一致する出荷データを削除
        ConsumablesTable::tableConsumablesShip()->where('出荷納品コード', $ship_code)->delete();
    }

}
