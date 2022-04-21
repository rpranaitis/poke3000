<?php

namespace App\Validators\User;

use App\Exceptions\ValidationException;

class LogoutValidator extends BaseValidator
{
    /**
     * @throws ValidationException
     */
    public function validate()
    {
        $this->validateSession();
    }
}