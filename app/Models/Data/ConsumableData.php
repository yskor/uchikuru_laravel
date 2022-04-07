<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data\Table\ConsumableTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * 入居者データクラス
 * @author Kodo Hori
 *
 */
class ConsumableData extends BaseData
{
    use HasFactory;

    /**
     *　消耗品の一覧を取得します。
     */
    public static function getConsumable()
    {
        return ConsumableTable::viewConsumableMaster()->get();
    }

    /**
     * 消耗品カテゴリコードからカテゴリを取得します。

     */
    public static function getConsumableCategoryAll()
    {
        return ConsumableTable::viewConsumableCategoryMaster()->get();
    }

    /**
     * 消耗品カテゴリコードからカテゴリを取得します。

     */
    public static function getConsumableCategory($consumable_category_code)
    {
        return ConsumableTable::viewConsumableCategoryMaster()->where('consumable_category_code', '=', $consumable_category_code)->first();
    }

    /**
     * 指定された消耗品カテゴリコードから消耗品の一覧を取得します。
     * @param string $consumable_category_code
     * @return unknown
     */
    public static function getCategoryConsumableList($consumable_category_code)
    {
        return ConsumableTable::viewConsumableMaster()->where('consumable_category_code', '=', $consumable_category_code)->get();
    }
}
