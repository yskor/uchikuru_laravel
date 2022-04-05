<?php

namespace App\Exceptions;

use Exception;

class ClientErrorException extends Exception
{
    public function __construct(string $message, string $key = 'message')
    {
        parent::__construct($message, 400);
    }
    
    public function render()
    {
        return response()->json(
            ['message' => $this->message],
            $this->code,
            );
    }
}
