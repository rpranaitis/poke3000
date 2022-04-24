<?php

namespace App\Validators\Poke;

use App\Exceptions\ValidationException;

class BaseValidator
{
    /**
     * @throws ValidationException
     */
    protected function validateSession()
    {
        if (empty($_SESSION['user_id'])) {
            throw new ValidationException('Jūs esate neprisijungęs.');
        }
    }
}