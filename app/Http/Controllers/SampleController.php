<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use App\Models\Data\OfficeData;
use App\Models\Office;
use Illuminate\Support\Facades\Log;

class SampleController extends AuthController
{
    /**
     * サンプルページを表示します。
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function sample(Request $request)
    {
        Log::debug(print_r($this->login, true));
        
        $data = ['login' => $this->login];
        
        return self::view($request, 'sample', $data);
    }
    
    /**
     * 事業所を取得します。
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function office(Request $request)
    {
        $request->validate([
            'office_code' => ['required', 'integer'],
        ]);
        
        // アシストを取得
        $office = Office::getOffice($request->office_code);
        
        $data = ['office' => $office];
        
        return self::json($request, $data);
    }
    
    /**
     * 事業所の HTML を取得します。
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function office_html(Request $request)
    {
        $request->validate([
            'office_code' => ['required', 'integer'],
        ]);
        
        // アシストを取得
        $office = Office::getOffice($request->office_code);
        
        $data = ['office' => $office];
        
        return self::jsonHtml($request, self::view($request, 'sample_html', $data)->render());
    }

    // テスト用
    public function test_html(Request $request)
    {
        $request->all();
        
        // アシストを取得
        $office = Office::getOffice($request->office_code);
        
        $data = ['office' => $office];
        
        return self::jsonHtml($request, self::view($request, 'sample_html', $data)->render());
    }
}
