<?php

namespace App\Validators\User;

use App\Exceptions\ValidationException;

class ShowValidator extends BaseValidator
{
    /**
     * @param int $id
     * @throws ValidationException
     */
    public function validate(int $id)
    {
        $this->validateSession();
        $this->validatePermission($id);
    }
}