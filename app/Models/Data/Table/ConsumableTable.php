<?php

namespace App\Models\Data\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ConsumableTable extends BaseTable
{
    use HasFactory;
    
    public static function getConsumableMaster() 
    {
        return DB::connection('sqlsrv_b')->table('VIEW_消耗品マスタ')->get();
    }

}

