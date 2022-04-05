<?php

namespace App\Exceptions;

use Exception;

class LoginTokenNotSetException extends Exception
{
    public function __construct(string $message = 'ログイントークンが設定されていません。')
    {
        parent::__construct($message, 400);
    }
    
    public function render()
    {
        return response()->json(
            $this->message,
            $this->code,
            );
    }
    
}
