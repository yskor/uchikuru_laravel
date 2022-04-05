<?php

namespace App\Models\Data\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SessionManageTable extends BaseTable
{
    use HasFactory;
    
    public static function viewSessionManagement(string $as = null) { return DB::table('VIEW_セッション管理テーブル', $as); }
}
