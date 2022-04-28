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
    const TABLE_CONSUMABLE_ID_MASTER_ONLY = "消耗品識別マスタのみ";
    const TABLE_CONSUMABLE_CATEGORY_MASTER = "消耗品種別マスタ";
    const TABLE_CONSUMABLE_STOCK = "消耗品在庫テーブル";
    const TABLE_CONSUMABLE_BUY = '消耗品仕入テーブル';
    const TABLE_CONSUMABLE_SHIP_DELIVER = "消耗品出荷納品テーブル";
    const TABLE_CONSUMABLE_CONSUMPTION = "消耗品消費テーブル";

    const VIEW_STAFF_MASTER = "VIEW_" . self::TABLE_STAFF_MASTER;
    const VIEW_CONSUMABLE_MASTER = "VIEW_" . self::TABLE_CONSUMABLE_MASTER;
    const VIEW_CONSUMABLE_ID_MASTER = "VIEW_" . self::TABLE_CONSUMABLE_ID_MASTER;
    const VIEW_CONSUMABLE_ID_MASTER_ONLY = "VIEW_" . self::TABLE_CONSUMABLE_ID_MASTER_ONLY;
    const VIEW_CONSUMABLE_CATEGORY_MASTER = "VIEW_" . self::TABLE_CONSUMABLE_CATEGORY_MASTER;
    const VIEW_CONSUMABLE_STOCK = "VIEW_" . self::TABLE_CONSUMABLE_STOCK;
    const VIEW_CONSUMABLE_BUY = "VIEW_" . self::TABLE_CONSUMABLE_BUY;
    const VIEW_CONSUMABLE_SHIP_DELIVER = "VIEW_" . self::TABLE_CONSUMABLE_SHIP_DELIVER;
    const VIEW_CONSUMABLE_CONSUMPTION = "VIEW_" . self::TABLE_CONSUMABLE_CONSUMPTION;

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

    // 消耗品識別マスタのみ
    public static function tableConsumablesIdMasterOnly()
    {
        return DB::table(self::TABLE_CONSUMABLE_ID_MASTER_ONLY);
    }

    // 消耗品種別マスタを取得
    public static function tableConsumablesCategoryMaster()
    {
        return DB::table(self::TABLE_CONSUMABLE_CATEGORY_MASTER);
    }

    // 消耗品在庫テーブル
    public static function tableConsumablesStock()
    {
        return DB::table(self::TABLE_CONSUMABLE_STOCK);
    }

    // 消耗品仕入テーブル
    public static function tableConsumablesBuy()
    {
        return DB::table(self::TABLE_CONSUMABLE_BUY);
    }

    // 消耗品出荷テーブル
    public static function tableConsumablesShip()
    {
        return DB::table(self::TABLE_CONSUMABLE_SHIP_DELIVER);
    }

    // 消耗品消費テーブル
    public static function tableConsumablesConsumption()
    {
        return DB::table(self::TABLE_CONSUMABLE_CONSUMPTION);
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

    // 消耗品識別マスタのみ
    public static function viewConsumablesIdMasterOnly()
    {
        return DB::table(self::VIEW_CONSUMABLE_ID_MASTER_ONLY);
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

    // 出荷テーブル
    public static function viewConsumablesShip()
    {
        return DB::table(self::VIEW_CONSUMABLE_SHIP_DELIVER);
    }

    // 消耗品消費テーブル
    public static function viewConsumablesConsumption()
    {
        return DB::table(self::TABLE_CONSUMABLE_CONSUMPTION);
    }

}
