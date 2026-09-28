<?php

namespace App\Exceptions;

use Exception;

class SeatNotAvailableException extends Exception
{
    public function __construct(string $message = "المقعد المطلوب غير متاح أو حُجز مسبقاً في هذه الرحلة!")
    {
        parent::__construct($message, 400);
    }
}
