<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Data\ConsumableData;
use App\Models\Data\Table\ConsumableTable;
use Mockery\Generator\StringManipulation\Pass\Pass;
use PHPUnit\TextUI\XmlConfiguration\TestDirectory;

class Consumable extends Model
{

    // テーブル (INSERT、UPDATE、DELETE 時に使う)
    const consumable_code = "VIEW_職員マスタ";

    const consumable_name = "VIEW_消耗品マスタ";
    const TABLE_CONSUMABLE_CATEGORY_MASTER = "VIEW_消耗品カテゴリマスタ";
    const TABLE_CONSUMABLE_STOCK = "VIEW_消耗品在庫テーブル";
    const TABLE_CONSUMABLE_MOVEMENT = "VIEW_消耗品変動テーブル";
    const TABLE_CONSUMABLE_MOVEMENT_STATUS_HISTORY = "VIEW_消耗品変動状態履歴テーブル";
    const TABLE_CONSUMABLE_DELIVER = "VIEW_消耗品配送中件数";


    use HasFactory;


    // マスタ登録
    public static function insert_consumable($param)
    {
        
        $image_filename=$param['image_file']->getClientOriginalName(); //ファイル名取得
        $param['image_file']->storeAs('upload/consumables/',$image_filename); //ファイル保存

        $values = [
            "消耗品コード" => $param['consumable_code'],
            "消耗品名" => $param['consumable_name'],
            "個数単位" => $param['number_unit'],
            "個数単価" => $param['number_unit_price'],
            "入数" => $param['quantity'],
            "入数単位" => $param['quantity_unit'],
            "入数使用" => $param['use_quantity'],
            // "複数使用可" => $param['can_use_multiple'],
            "消耗品カテゴリコード" => $param['consumable_category_code'],
            "最終交渉日" => $param['last_negotiation_date'],
            "画像ファイル名" => $image_filename,
            "作成日時" => now()
        ];

        return ConsumableTable::tableConsumableMaster()->insert($values);
    }

    // マスタ更新
    public static function update_consumable($param)
    {
        
        $image_filename=$param['image_file']->getClientOriginalName(); //ファイル名取得
        $param['image_file']->storeAs('upload/consumables/',$image_filename); //ファイル保存

        $values = [
            "消耗品コード" => $param['consumable_code'],
            "消耗品名" => $param['consumable_name'],
            "個数単位" => $param['number_unit'],
            "個数単価" => $param['number_unit_price'],
            "入数" => $param['quantity'],
            "入数単位" => $param['quantity_unit'],
            "入数使用" => $param['use_quantity'],
            // "複数使用可" => $param['can_use_multiple'],
            "消耗品カテゴリコード" => $param['consumable_category_code'],
            "最終交渉日" => $param['last_negotiation_date'],
            "画像ファイル名" => $image_filename,
            "更新日時" => now()
        ];

        return ConsumableTable::tableConsumableMaster()->update($values);
    }
}
