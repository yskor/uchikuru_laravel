<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data\UserData;
use Illuminate\Support\Facades\Log;
use App\Models\Config\MyConfig;
use App\Models\Data\BathData;
use App\Models\User\UserStatus;

class User extends Model
{
    use HasFactory;
    
    public static function getUser(int $user_code, bool $append_user_name_honorific_title = false)
    {
        $user = UserData::getUser($user_code);
        if($append_user_name_honorific_title == true) {
            self::addUserNameHonorificTitle($user->user_name);
        }
        
        return $user;
    }
    
    public static function addUserNameHonorificTitle(string $user_name)
    {
        return $user_name . ' ' . MyConfig::getUserNameHonorificTitle();
    }
}
