<?php

namespace App\Validators\Poke;

use App\Exceptions\ValidationException;

class UserPokesValidator extends BaseValidator
{
    /**
     * @param int $id
     * @return void
     * @throws ValidationException
     */
    public function validate(int $id)
    {
        $this->validateSession();
        $this->validatePermission($id);
    }
}