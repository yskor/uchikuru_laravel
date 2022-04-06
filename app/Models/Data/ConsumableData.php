<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data\Table\ConsumableTable;

/**
 * 入居者データクラス
 * @author Kodo Hori
 *
 */
class ConsumableData extends BaseData
{
    use HasFactory;
    
    /**
     * 消耗品全てのマスタ情報を取得します。
     * @return unknown
     * 
     */
    public static function getConsumable()
    {
        return ConsumableTable::getConsumableMaster();
    }

}
