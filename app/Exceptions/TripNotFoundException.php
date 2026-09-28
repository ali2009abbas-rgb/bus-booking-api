<?php

namespace App\Exceptions;

use Exception;

class TripNotFoundException extends Exception
{
    public function __construct(string $message = "الرحلة المطلوبة غير موجودة أو ملغاة!")
    {
        parent::__construct($message, 404);
    }
}
