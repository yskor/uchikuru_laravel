<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use PhpParser\Error;

class ConsumablesConfig extends BaseConfig
{
    use HasFactory;
    
    protected static $base_key = 'consumablesconfig';
    
    /**
     * システムの設定 
     */
    
    public static function getUserNameHonorificTitle()
    {
        return self::getConfigValue('user_name_honorific_title');
    }
}
