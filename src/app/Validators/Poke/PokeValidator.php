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
        $this->validatePermission();
        $this->validateRequiredParameters();
    }

    /**
     * @throws ValidationException
     */
    protected function validateRequiredParameters()
    {
        if (empty($_POST['to'])) {
            throw new ValidationException('Neįvestas parametras "to".');
        }
    }

    /**
     * @return void
     * @throws ValidationException
     */
    protected function validatePermission()
    {
        if ($_SESSION['user_id'] != $_POST['from']) {
            throw new ValidationException('Jūs neturite teisės šiam veiksmui.');
        }
    }
}