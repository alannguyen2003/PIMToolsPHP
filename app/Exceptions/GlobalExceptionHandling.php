<?php

namespace App\Exceptions;

use Exception;

class GlobalExceptionHandling extends Exception
{
    public function errorMessage() {
        //Error message
        $error = "Error on line " . $this->getLine() . "\nOn file: " . $this->getFile()
                                    . "\nMessage: " . $this->getMessage();
        return $error;
    }
}