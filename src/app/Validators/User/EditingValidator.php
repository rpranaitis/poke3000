<?php

namespace App\Validators\User;

use App\Exceptions\ValidationException;

class EditingValidator extends BaseValidator
{
    /**
     * @param int $id
     * @throws ValidationException
     */
    public function validate(int $id)
    {
        $this->validateSession();
        $this->validateRequiredFields();
        $this->validatePermission($id);
        $this->validateArePasswordsTheSame();
        $this->validatePasswordRules();
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