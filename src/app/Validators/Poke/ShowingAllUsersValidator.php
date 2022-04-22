<?php

namespace App\Validators\Poke;

use App\Exceptions\ValidationException;

class ShowingAllUsersValidator
{
    /**
     * @throws ValidationException
     */
    public function validate()
    {
        $this->validateSession();
    }

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