<?php

namespace App\Models\Data;

use App\Models\Consumables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data\Table\ConsumablesTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use PDO;
use phpDocumentor\Reflection\Types\This;

/**
 * 入居者データクラス
 * @author Kodo Hori
 *
 */
class ConsumablesData extends BaseData
{
    use HasFactory;

    /**
     *　消耗品の一覧を取得します。
     */
    public static function getConsumables()
    {
        return ConsumablesTable::viewConsumablesMaster()->get();
    }

    /**
     * 消耗品種別マスタから全てのカテゴリデータを取得します。

     */
    public static function getConsumablesCategoryAll()
    {
        return ConsumablesTable::viewConsumablesCategoryMaster()->get();
    }

    /**
     * 消耗品識別マスタから全てのデータを取得します。

     */
    public static function getConsumablesIdAll()
    {
        return ConsumablesTable::viewConsumablesIdMaster()->get();
    }
    
    // マスタ一覧表示画面用
    public static function getConsumablesAll()
    {
        // データを取得
        $consumables_list = ConsumablesData::getConsumables();

        // 消耗品コードから該当するバーコードを取得し、配列として$consumables_listに格納
        foreach ($consumables_list as $data) {
            $consumables_id_all = ConsumablesData::getConsumablesId($data->consumables_code);
            $data->consumables_barcode = $consumables_id_all;
        }

        // dd($consumables_list);

        return $consumables_id_all;
    }
    

    /**
     * 指定された消耗品カテゴリコードからカテゴリの情報を取得します。

     */
    public static function getConsumablesCategory($consumables_category_code)
    {
        return ConsumablesTable::viewConsumablesCategoryMaster()->where('consumables_category_code', '=', $consumables_category_code)->first();
    }

    /**
     * 指定された消耗品コードから消耗品を取得します。
     * @param string $consumables_code
     */
    public static function getConsumablesIdItem($consumables_code)
    {
        return ConsumablesTable::viewConsumablesIdMaster()->where('consumables_code', '=', $consumables_code);
    }

    /**
     * 指定された消耗品コードから消耗品識別バーコードを全て取得します。
     * @param string $consumables_code
     */
    public static function getConsumablesId($consumables_code)
    {
        return self::getConsumablesIdItem($consumables_code)->select('consumables_barcode')->get();
    }

    /**
     * 指定された消耗品カテゴリコードから消耗品の一覧を取得します。
     * @param string $consumables_category_code
     * @return unknown
     */
    public static function getCategoryConsumablesList($consumables_category_code)
    {
        return ConsumablesTable::viewConsumablesIdMaster()->where('consumables_category_code', '=', $consumables_category_code)->get();
    }

        /**
     *　作成日時から消耗品を取得します。
     */
    public static function getLastConsumables($created_at)
    {
        return ConsumablesTable::viewConsumablesMaster()->where('created_at', '=', $created_at)->first();
    }

        /**
     *　消耗品コードから消耗品を取得します。
     */
    public static function getOneConsumables($consumables_code)
    {
        return ConsumablesTable::tableConsumablesMaster()->where('消耗品コード', '=', $consumables_code);
    }

        /**
     *　消耗品コードから消耗品を参照します。
     */
    public static function viewOneConsumables($consumables_code)
    {
        return ConsumablesTable::viewConsumablesMaster()->where('consumables_code', '=', $consumables_code)->first();
    }
}
