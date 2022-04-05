<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * 基底コントローラークラス
 * 
 * 全てのコントローラークラスの基本クラスです。
 * 
 * @author Kodo Hori
 *
 */
abstract class BaseController extends Controller
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
        return view($view, $data, $mergeData);
    }
    
    /**
     * JSON を作成します。
     * @param Request $request
     * @param array $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return \Illuminate\Http\JsonResponse
     */
    protected static function json(Request $request, $data = [], int $status = 200, array $headers = [], int $options = 0)
    {
        return response()->json($data, $status, $headers, $options);
    }
}
