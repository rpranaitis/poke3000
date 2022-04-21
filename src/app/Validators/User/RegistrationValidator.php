<?php

namespace App\Validators\User;

use App\Exceptions\ValidationException;

class RegistrationValidator extends BaseValidator
{
    /**
     * @throws ValidationException
     */
    public function validate()
    {
        $this->validateRequiredFields();
        $this->validateUsername();
        $this->validateArePasswordsTheSame();
        $this->validatePasswordRules();
    }

    /**
     * @throws ValidationException
     */
    protected function validateUsername()
    {
        $username = $_POST['username'];

        if ($this->userRepository->getUserByUsername($username)) {
            throw new ValidationException('Šis vartotojo vardas jau naudojamas.');
        }
    }
}