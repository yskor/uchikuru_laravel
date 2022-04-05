<?php

namespace App\Exceptions;

use Exception;

class FailureException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message, 500);
    }
    
    public function render()
    {
        return response()->json(
            ['message' => $this->message],
            $this->code,
            );
    }
}
