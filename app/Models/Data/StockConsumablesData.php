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
class StockConsumablesData extends BaseData
{
    use HasFactory;

    /**
     *　出荷に伴う在庫数の変更
     */
    public static function update_stock($ship_from_stock, $data)
    {
        if($ship_from_stock->consumption_unit_code == "Q") {
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
        // 在庫不足一覧からの出荷の場合
        if ($data['replenishment_status_code'] == 'S') {
            // 出荷先の在庫テーブルの在庫補充状況コードを更新
            // ConsumablesData::getConsumablesStockData($data['consumables_code'], $data['office_code_to'])
            // ->update(["在庫補充状況コード" => $data['replenishment_status_code']]);
            $dec_values["在庫補充状況コード"] = $data['replenishment_status_code'];
        }
        ConsumablesData::getConsumablesStockData($data['consumables_code'], $data['office_code_from'])->update($dec_values);
    }

}
