<?php

namespace App\Http\Controllers\Base;

use Illuminate\Http\Request;
use App\Models\Managers\StaffLoginManager;
use App\Models\Config\MyConfig;

/**
 * 認証が必要なコントローラー抽象クラス
 * 
 * 認証が必要なコントローラーは、このクラスを継承してください。
 * 
 * @author Kodo Hori
 *
 */
abstract class AuthController extends ActionController
{
    // ログイン情報
    public $login;
    
    /**
     * コンストラクタ―
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        // 共通システムにログインしているかチェック
        if(!StaffLoginManager::checkLogin($request)) {
            // ログインしていない場合、共通システムのトップページに飛ばす
            header('Location: ' . MyConfig::getCommonSystemTopPageURL());
            exit;
        }
        // ログイン情報をセット
        $this->login = StaffLoginManager::getLogin($request);
    }
    
    /**
     * ビューを取得します。
     * @param Request $request
     * @param string $view
     * @param array $data
     * @param array $mergeData
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    protected static function view(Request $request, string $view, $data = [], $mergeData = [])
    {
        // ログイン情報
        $data['login'] = StaffLoginManager::getLogin($request);
        return parent::view($request, $view, $data, $mergeData);
    }
}
