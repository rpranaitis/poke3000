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

    /**
     * @param int $id
     * @throws ValidationException
     */
    protected function validatePermission(int $id)
    {
        if ($_SESSION['user_id'] !== $id) {
            throw new ValidationException('Jūs neturite teisės šiam veiksmui.');
        }
    }
}