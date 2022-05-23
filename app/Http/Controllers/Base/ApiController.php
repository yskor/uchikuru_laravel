<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Base\AuthController;
use App\Http\Controllers\Base\ActionController;
use Illuminate\Support\Facades\Log;

class ApiController extends AuthController
{
    protected static function jsonSuccess(Request $request, $data = [], int $status = 200, array $headers = [], int $options = 0)
    {
        $data['success'] = true;
        return self::json($request, $data, $status, $headers, $options);
    }
    
    protected static function jsonNG(Request $request, string $message, $data = [], int $status = 200, array $headers = [], int $options = 0)
    {
        $data['success'] = false;
        return self::jsonMessage($request, $message, $data, $status, $headers, $options);
    }
    
    protected static function jsonException(Request $request, \Exception $exception, $data = [], int $status = 200, array $headers = [], int $options = 0)
    {
        Log::error($exception);
        $data['success'] = false;
        return self::jsonMessage($request, $exception->getMessage(), $data, $status, $headers, $options);
    }
}
