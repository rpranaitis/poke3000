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
        $this->validateEmail($id);
        $this->validateArePasswordsTheSame();
        $this->validatePasswordRules();
    }

    /**
     * @param int $id
     * @throws ValidationException
     */
    protected function validateEmail(int $id)
    {
        $email = $_POST['email'];
        $user = $this->userRepository->getUserById($id);

        if (!$user) {
            throw new ValidationException('Vartotojas nerastas duomenų bazėje.');
        }

        if ($email !== $user['email']) {
            if ($this->userRepository->getUserByEmail($email)) {
                throw new ValidationException('Šis el. pašto adresas jau naudojamas.');
            }
        }
    }
}