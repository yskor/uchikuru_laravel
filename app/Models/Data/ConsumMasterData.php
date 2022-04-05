<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data\Table\UserTable;
use App\Models\Data\Table\RoomTable;

/**
 * 入居者データクラス
 * @author Kodo Hori
 *
 */
class UserData extends BaseData
{
    use HasFactory;
    
    /**
     * 指定された入居者コードから入居者情報を取得します。
     * @param int $user_code
     * @return unknown
     */
    public static function getUser(int $user_code)
    {
        return UserTable::viewUserMaster()
                            ->where('user_code', '=', $user_code)->first();
    }
}
