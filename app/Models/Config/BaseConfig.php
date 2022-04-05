<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * 設定ファイルの基底クラス
 *
 * 設定ファイルクラスを作成する時は、このクラスを継承してください。
 *
 * @author Kodo Hori
 *
 */
abstract class BaseConfig extends Model
{
    use HasFactory;
    
    protected static $base_key;
    
    protected static function getServerURL()
    {
        return sprintf('%s://%s/', self::getProtocol(), request()->server('SERVER_NAME'));
    }
    
    private static function getProtocol()
    {
        return (request()->server->get('HTTPS') == 'on') ? 'https' : 'http';
    }
    
    protected static function getConfigValue($key)
    {
        return Config::get(static::$base_key . '.' . $key);
    }
}
