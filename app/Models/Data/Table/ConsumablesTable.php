<?php

namespace App\Models\Data\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ConsumablesTable extends BaseTable
{
    use HasFactory;

    // テーブル (INSERT、UPDATE、DELETE 時に使う)
    const TABLE_STAFF_MASTER = "職員マスタ";
    const TABLE_CONSUMABLE_MASTER = "消耗品マスタ";
    const TABLE_CONSUMABLE_ID_MASTER = "消耗品識別マスタ";
    const TABLE_CONSUMABLE_CATEGORY_MASTER = "消耗品種別マスタ";
    const TABLE_CONSUMABLE_STOCK = "消耗品在庫テーブル";
    const TABLE_CONSUMABLE_BUY = '消耗品仕入テーブル';
    const TABLE_CONSUMABLE_MOVEMENT = "消耗品変動テーブル";
    const TABLE_CONSUMABLE_MOVEMENT_STATUS_HISTORY = "消耗品変動状態履歴テーブル";
    const TABLE_CONSUMABLE_DELIVER = "消耗品配送中件数";

    const VIEW_STAFF_MASTER = "VIEW_" . self::TABLE_STAFF_MASTER;
    const VIEW_CONSUMABLE_MASTER = "VIEW_" . self::TABLE_CONSUMABLE_MASTER;
    const VIEW_CONSUMABLE_ID_MASTER = "VIEW_" . self::TABLE_CONSUMABLE_ID_MASTER;
    const VIEW_CONSUMABLE_CATEGORY_MASTER = "VIEW_" . self::TABLE_CONSUMABLE_CATEGORY_MASTER;
    const VIEW_CONSUMABLE_STOCK = "VIEW_". self::TABLE_CONSUMABLE_STOCK;
    const VIEW_CONSUMABLE_BUY = "VIEW_". self::TABLE_CONSUMABLE_BUY;
    const VIEW_CONSUMABLE_MOVEMENT = "VIEW_消耗品変動テーブル";
    const VIEW_CONSUMABLE_MOVEMENT_STATUS_HISTORY = "VIEW_消耗品変動状態履歴テーブル";
    const VIEW_CONSUMABLE_DELIVER = "VIEW_消耗品配送中件数";

    // DB更新用
    // 消耗品マスタ
    public static function tableConsumablesMaster()
    {
        return DB::table(self::TABLE_CONSUMABLE_MASTER);
    }
    
    // 消耗品識別マスタ
    public static function tableConsumablesIdMaster()
    {
        return DB::table(self::TABLE_CONSUMABLE_ID_MASTER);
    }

    // 消耗品種別マスタを取得
    public static function tableConsumablesCategoryMaster()
    {
        return DB::table(self::TABLE_CONSUMABLE_CATEGORY_MASTER);
    }
    
    // 施設別消耗品在庫テーブル
    public static function tableOfficeConsumablesStock()
    {
        return DB::table(self::TABLE_CONSUMABLE_STOCK);
    }
    
    // 消耗品仕入テーブル
    public static function tableConsumablesBuy()
    {
        return DB::table(self::TABLE_CONSUMABLE_BUY);
    }

    // DB参照用
    // 消耗品マスタ
    public static function viewConsumablesMaster()
    {
        return DB::table(self::VIEW_CONSUMABLE_MASTER);
    }

    // 消耗品識別マスタ
    public static function viewConsumablesIdMaster()
    {
        return DB::table(self::VIEW_CONSUMABLE_ID_MASTER);
    }


    // 消耗品種別マスタ
    public static function viewConsumablesCategoryMaster()
    {
        return DB::table(self::VIEW_CONSUMABLE_CATEGORY_MASTER);
    }

    // 消耗品在庫テーブル
    public static function viewOfficeConsumablesStock()
    {
        return DB::table(self::VIEW_CONSUMABLE_STOCK);
    }

        
    // 消耗品仕入テーブル
    public static function viewConsumablesBuy()
    {
        return DB::table(self::VIEW_CONSUMABLE_BUY);
    }

    // 納品テーブル
    public static function viewConsumablesDeliver()
    {
        return DB::table(self::VIEW_CONSUMABLE_DELIVER);
    }
}
