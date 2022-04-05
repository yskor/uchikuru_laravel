<?php

namespace App\Exceptions;

use Exception;

class NotLoginedException extends Exception
{
    public function __construct(string $message = 'ログインされていません。')
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
