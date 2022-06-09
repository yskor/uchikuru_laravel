<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Data\Table\ConsumablesTable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * 仕入れデータクラス
 * @author Kodo Hori
 *
 */
class BuyConsumablesData extends BaseData
{
    use HasFactory;

    /**
     *  仕入れテーブルに追加する処理
     */
    public static function insert_buy($consumables_data, $buy_unit_code, $buy_quantity, $office_code, $staff_code)
    {
        // insertで渡すデータ
        $buy_values = [
            "消耗品コード" => $consumables_data->consumables_code,
            "消耗品識別コード" => $consumables_data->consumables_barcode,
            "仕入事業所コード" => $office_code,
            "仕入数" => $buy_quantity,
            "仕入単位コード" => $buy_unit_code,
            "仕入単価" => $consumables_data->number_unit_price,
            "仕入職員コード" => $staff_code,
            "作成日時" => now(),
        ];
        // 仕入テーブルに追加
        ConsumablesTable::tableConsumablesBuy()->insert($buy_values);
    }

    /**
     *  在庫テーブルの消耗品を増やす処理
     */
    public static function update_stock($consumables_stock, $buy_unit_code, $buy_quantity, $office_code)
    {
        // 消耗品のbuy_unit_codeがBの時は読み取った数量（段ボール）×箱数を増やす
        if($buy_unit_code == 'B') {
            $add_stock_number = $buy_quantity * $consumables_stock->number; //箱数
            $add_stock_quantity = 0; //個数
        }
        // 消耗品のbuy_unit_codeが N  の時は読み取った数量分箱数を増やす
        elseif($buy_unit_code == 'N') {
            $add_stock_number = $buy_quantity; //箱数
            $add_stock_quantity = 0; //個数
        }
        // 消耗品のbuy_unit_codeが Q  の時は読み取った数量分個数を増やす
        elseif($buy_unit_code == 'Q') {
            $add_stock_number = 0; //箱数
            $add_stock_quantity = $buy_quantity; //個数
        };

        if ($consumables_stock) {
            // 在庫がある場合
            $stock_values = [
                "個数在庫数" => $consumables_stock->stock_number + $add_stock_number,
                "入数在庫数" => $consumables_stock->stock_quantity + $add_stock_quantity,
                "更新日時" => now()
            ];
            // 在庫を更新
            ConsumablesData::getConsumablesStockData($consumables_stock->consumables_code, $office_code)->update($stock_values);
        } else {
            // 在庫がない場合
            $stock_values = [
                "事業所コード" => $office_code,
                "消耗品コード" => $consumables_stock->consumables_code,
                "個数在庫数" => $add_stock_number,
                "入数在庫数" => $add_stock_quantity,
                "作成日時" => now(),
                "更新日時" => now(),
            ];
            // 在庫に新たに追加
            ConsumablesTable::tableConsumablesStock()->insert($stock_values);
        }
    }

}
