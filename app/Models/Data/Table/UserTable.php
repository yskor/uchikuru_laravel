<?php

namespace App\Models\Data\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserTable extends BaseTable
{
    use HasFactory;
    
    public static function viewUserMaster(string $as = null) { return DB::table('VIEW_利用者マスタ', $as); }
}
