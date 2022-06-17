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
    // 運営種別コード
    public $operation_type_code;
    
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
        // 運営種別コードを追加
        if($this->login->office_code == 90) {
            $this->login->operation_type_code = 'LABO';
        } else {
            $this->login->operation_type_code = 'CARE';
        }
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
        $login = StaffLoginManager::getLogin($request);
        if($login->office_code == 90) {
            $login->operation_type_code = 'LABO';
        } else {
            $login->operation_type_code = 'CARE';
        }
        $data['login'] = $login;
        // 二重送信防止
        $request->session()->regenerateToken();
        return parent::view($request, $view, $data, $mergeData);
    }

    /**
     * マスタ画面用ビューを取得します。
     * @param Request $request
     * @param string $view
     * @param array $data
     * @param array $mergeData
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    protected static function master_view(Request $request, string $view, $data = [], $mergeData = [])
    {
        // ログイン情報
        $data['login'] = StaffLoginManager::getLogin($request);
        return parent::view($request, $view, $data, $mergeData);
    }
}
