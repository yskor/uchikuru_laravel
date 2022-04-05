<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Data\ConsumableData;

class Consumable extends Model
{
    // use HasFactory;
    
    public static function getConsumable()
    {
        return ConsumableData::getConsumable();
    }
}
