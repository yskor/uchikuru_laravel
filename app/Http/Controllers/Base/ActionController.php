<?php

namespace App\Http\Controllers\Base;

use Illuminate\Http\Request;
use App\Models\Config\MyConfig;

/**
 * 認証不要のコントローラー抽象クラス
 * 
 * 認証が不要なコントローラーは、このクラスを継承してください。
 * 
 * @author Kodo Hori
 *
 */
abstract class ActionController extends BaseController
{
    /**
     * ビューを取得します。
     * @param Request $request
     * @param string $view
     * @param array $data
     * @param array $mergeData
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    protected static function view(Request $request,string $view, array $data = [], array $mergeData = [])
    {
        // 共通システムのトップページ URL
        $data['common_system_top_page_url'] = MyConfig::getCommonSystemTopPageURL();
        
        return parent::view($request, $view, $data, $mergeData);
    }
    
    /**
     * HTML 付きの JSON を作成します。
     * @param Request $request
     * @param string $html
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    protected static function jsonHtml(Request $request, string $html, array $data = [], int $status = 200, array $headers = [], int $options = 0)
    {
        $data['html'] = $html;
        return parent::json($request, $data, $status, $headers, $options);
    }
    
    /**
     * メッセージ付きの JSON を作成します。
     * @param Request $request
     * @param string $message
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    protected static function jsonMessage(Request $request, string $message, array $data = [], int $status = 200, array $headers = [], int $options = 0)
    {
        $data['message'] = $message;
        return parent::json($request, $data, $status, $headers, $options);
    }
    
    /**
     * エラーメッセージ付きの JSON を作成します。
     * @param Request $request
     * @param string $message
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    protected static function jsonErrorMessage(Request $request, string $message, $data = [], int $status = 200, array $headers = [], int $options = 0)
    {
        $data['message'] = $message;
        return parent::json($request, $data, $status, $headers, $options);
    }
}
