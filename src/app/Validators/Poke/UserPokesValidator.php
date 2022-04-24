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