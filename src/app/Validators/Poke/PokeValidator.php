<?php

namespace App\Validators\Poke;

use App\Exceptions\ValidationException;

class PokeValidator extends BaseValidator
{
    /**
     * @throws ValidationException
     */
    public function validate()
    {
        $this->validateSession();
        $this->validateRequiredParameters();
    }

    /**
     * @throws ValidationException
     */
    protected function validateRequiredParameters()
    {
        if (empty($_POST['from'])) {
            throw new ValidationException('Neįvestas parametras "from".');
        }

        if (empty($_POST['to'])) {
            throw new ValidationException('Neįvestas parametras "to".');
        }
    }
}