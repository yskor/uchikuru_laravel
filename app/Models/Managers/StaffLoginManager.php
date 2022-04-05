<?php

namespace App\Models\Managers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data\SessionManageData;
use Illuminate\Http\Request;
use App\Exceptions\LoginTokenNotFoundException;
use App\Exceptions\LoginTokenNotSetException;
use Illuminate\Support\Facades\Log;

class StaffLoginManager extends Model
{
    use HasFactory;

    /**
     * ログイントークンのキー
     * @var string
     */
    protected const LOGIN_TOKEN_KEY = 'common_session_token';
    
    /**
     * ログインしているかチェックします。
     * @param Request $request
     * @return boolean
     */
    public static function checkLogin(Request $request)
    {
        try {
            if(self::hasLoginToken($request)) {
                $info = self::getLogin($request);
                $logined = !is_null($info);
            } else {
                $logined = false;
            }
            
            return $logined;
        } catch (LoginTokenNotSetException $e) {
            return false;
        }
    }
    
    /**
     * ログイン情報を取得します。
     * @param Request $request
     * @return \App\Models\Data\unknown
     */
    public static function getLogin(Request $request) {
        return SessionManageData::getSessionManage(self::getLoginToken($request));
    }
    
    /**
     * ログイントークンを取得します。
     * @param Request $request
     * @throws LoginTokenNotSetException
     * @return unknown|NULL|string|array
     */
    public static function getLoginToken(Request $request = null)
    {
        // ログイントークンがクッキーに無い場合は、リクエストのパラメータをチェック
        $token = !is_null($request->cookie(self::LOGIN_TOKEN_KEY)) ? $request->cookie(self::LOGIN_TOKEN_KEY) : null;
        $token = (is_null($token) && isset($_COOKIE[self::LOGIN_TOKEN_KEY])) ? $_COOKIE[self::LOGIN_TOKEN_KEY] : $token;
        $token = (is_null($token) && !is_null($request->login_token)) ? $request->login_token : $token;
        
        if(is_null($token)) {
            throw new LoginTokenNotSetException();
        }
        
        return $token;
    }
    
    /**
     * ログイントークンを持っているかどうか
     * @param Request $request
     * @return boolean
     */
    public static function hasLoginToken(Request $request)
    {
        return !empty(self::getLoginToken($request));
    }
    
}
