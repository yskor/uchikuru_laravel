<?php

namespace App\Models\Data\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ConsumableTable extends BaseTable
{
    use HasFactory;

    // テーブル (INSERT、UPDATE、DELETE 時に使う)
    const TABLE_STAFF_MASTER = "職員マスタ";
    const TABLE_CONSUMABLE_MASTER = "消耗品マスタ";
    const TABLE_CONSUMABLE_CATEGORY_MASTER = "消耗品カテゴリマスタ";
    const TABLE_CONSUMABLE_STOCK = "消耗品在庫テーブル";
    const TABLE_CONSUMABLE_OFFICE_STOCK = '消耗品在庫事業所別';
    const TABLE_CONSUMABLE_MOVEMENT = "消耗品変動テーブル";
    const TABLE_CONSUMABLE_MOVEMENT_STATUS_HISTORY = "消耗品変動状態履歴テーブル";
    const TABLE_CONSUMABLE_DELIVER = "消耗品配送中件数";

    const VIEW_STAFF_MASTER = "VIEW_職員マスタ";
    const VIEW_CONSUMABLE_MASTER = "VIEW_消耗品マスタ";
    const VIEW_CONSUMABLE_CATEGORY_MASTER = "VIEW_消耗品カテゴリマスタ";
    const VIEW_CONSUMABLE_STOCK = "VIEW_消耗品在庫テーブル";
    const VIEW_CONSUMABLE_OFFICE_STOCK = '消耗品在庫事業所別';
    const VIEW_CONSUMABLE_MOVEMENT = "VIEW_消耗品変動テーブル";
    const VIEW_CONSUMABLE_MOVEMENT_STATUS_HISTORY = "VIEW_消耗品変動状態履歴テーブル";
    const VIEW_CONSUMABLE_DELIVER = "VIEW_消耗品配送中件数";

    // DB更新用
    // 消耗品マスタ
    public static function tableConsumableMaster()
    {
        return DB::table(self::TABLE_CONSUMABLE_MASTER);
    }
    // 消耗品カテゴリマスタを取得
    public static function tableConsumableCategoryMaster()
    {
        return DB::table(self::TABLE_CONSUMABLE_CATEGORY_MASTER);
    }

    // 事業所べつ消耗品テーブルを取得
    public static function tableOfficeConsumableStock()
    {
        return DB::table(self::TABLE_CONSUMABLE_OFFICE_STOCK);
    }

    // DB参照用
    // 消耗品マスタ
    public static function viewConsumableMaster()
    {
        return DB::table(self::VIEW_CONSUMABLE_MASTER);
    }


    // 消耗品カテゴリマスタ
    public static function viewConsumableCategoryMaster()
    {
        return DB::table(self::VIEW_CONSUMABLE_CATEGORY_MASTER);
    }

    // 事業所べつ消耗品テーブル
    public static function viewOfficeConsumableStock()
    {
        return DB::table(self::VIEW_CONSUMABLE_OFFICE_STOCK);
    }

    // 納品テーブル
    public static function viewConsumableDeliver()
    {
        return DB::table(self::VIEW_CONSUMABLE_DELIVER);
    }
}
