<?php

namespace App\Exceptions;

use Exception;

class ValidationErrorException extends Exception
{
    public array $errors;
    
    public function __construct(string $error_message, string $error_key = 'message', string $message = 'The given data was invalid.')
    {
        parent::__construct($message, 422);
        $this->errors = [$error_key => $error_message];
    }
    
    public function render()
    {
        return response()->json(
            ['errors' => $this->errors],
            $this->code,
            );
    }
}