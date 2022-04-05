<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Data\OfficeData;

class Office extends Model
{
    use HasFactory;
    
    public static function getOffice($office_code)
    {
        return OfficeData::getOffice($office_code);
    }
}
