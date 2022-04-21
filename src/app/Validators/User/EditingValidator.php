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
}