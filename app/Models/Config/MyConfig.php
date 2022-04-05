<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use PhpParser\Error;

class MyConfig extends BaseConfig
{
    use HasFactory;
    
    protected static $base_key = 'myconfig';
    
    /**
     * 共通システム関連
     */
    
    public static function getCommonSystemDirectoryName() {
        return self::getConfigValue('common_system_directory_name');
    }
    
    public static function getCommonSystemTopPageRelativeURL() {
        return self::getConfigValue('common_system_top_page_relative_url');
    }
    
    public static function getCommonSystemUserImageRelativeURL() {
        return self::getConfigValue('common_system_user_image_relative_url');
    }
    
    public static function getCommonSystemURL() {
        return sprintf('%s%s/', self::getServerURL(), self::getCommonSystemDirectoryName());
    }
    
    public static function getCommonSystemTopPageURL() {
        return self::getCommonSystemURL() . self::getCommonSystemTopPageRelativeURL();
    }
    
    public static function getCommonSysemUserImageURL() {
        return self::getCommonSystemURL() . self::getCommonSystemUserImageRelativeURL();
    }
    
    /**
     * システムの設定 
     */
    
    public static function getUserNameHonorificTitle()
    {
        return self::getConfigValue('user_name_honorific_title');
    }
}
