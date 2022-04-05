<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Data\SessionManageData;

class Staff extends Model
{
    use HasFactory;
    
    public static function getStaff(int $staff_code)
    {
        return Staff::getStaff($staff_code);
    }
}
