<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Data\ConsumableData;

class Consumable extends Model
{
    use HasFactory;
    
    public static function getConsumable()
    {
        return ConsumableData::getConsumable();
    }

    // 在庫テーブル取得
    public static function getConsumableStock() 
    {
        return DB::connection('sqlsrv_b')->table('VIEW_消耗品在庫テーブル')->get();
    }

}
