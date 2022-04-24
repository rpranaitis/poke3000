<?php

namespace App\Validators\Poke;

use App\Exceptions\ValidationException;

class PokesValidator extends BaseValidator
{
    /**
     * @throws ValidationException
     */
    public function validate()
    {
        $this->validateSession();
    }
}