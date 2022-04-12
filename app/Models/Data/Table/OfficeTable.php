<?php

namespace App\Models\Data\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OfficeTable extends BaseTable
{
    use HasFactory;
    
    public static function viewOfficeMaster(string $as = null) 
    { 
        return DB::table('common_VIEW_事業所マスタ', $as); 
    }
}
