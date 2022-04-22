<?php

namespace App\Validators\User;

use App\Exceptions\ValidationException;
use App\Validators\Poke\BaseValidator;

class UsersWithPokesValidator extends BaseValidator
{
    /**
     * @throws ValidationException
     */
    public function validate()
    {
        $this->validateSession();
    }
}