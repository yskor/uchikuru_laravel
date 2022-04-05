<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data\Table\SessionManageTable;

/**
 * セッション管理データクラス
 * 
 * @author Kodo Hori
 *
 */
class SessionManageData extends BaseData
{
    use HasFactory;
    
    /**
     * 共通システムのセッション管理情報を取得します。
     * 
     * @param string $common_session_token
     * @return unknown
     */
    public static function getSessionManage(string $common_session_token)
    {
        return SessionManageTable::viewSessionManagement()->where('common_session_token', '=', $common_session_token)->first();
    }
}
