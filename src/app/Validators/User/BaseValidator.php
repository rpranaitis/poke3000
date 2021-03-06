<?php

namespace App\Validators\User;

use App\Exceptions\ValidationException;
use App\Repositories\UserRepository;

class BaseValidator
{
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * @throws ValidationException
     */
    protected function validateRequiredFields()
    {
        if (empty($_POST['username'])) {
            throw new ValidationException('Neįvestas prisijungimo vardas.');
        }

        if (empty($_POST['first_name'])) {
            throw new ValidationException('Neįvestas vardas.');
        }

        if (empty($_POST['last_name'])) {
            throw new ValidationException('Neįvesta pavardė.');
        }

        if (empty($_POST['email'])) {
            throw new ValidationException('Neįvestas el. pašto adresas.');
        }

        if (empty($_POST['password'])) {
            throw new ValidationException('Neįvestas slaptažodis.');
        }

        if (empty($_POST['password_repeated'])) {
            throw new ValidationException('Neįvestas pakartotinas slaptažodis.');
        }
    }

    /**
     * @throws ValidationException
     */
    protected function validateArePasswordsTheSame()
    {
        if ($_POST['password'] !== $_POST['password_repeated']) {
            throw new ValidationException('Slaptažodžiai nesutampa.');
        }
    }

    /**
     * @throws ValidationException
     */
    protected function validatePasswordRules()
    {
        if (!preg_match('/^(?:(?=.*\d)(?=.*[A-Z]).*)$/', $_POST['password'])) {
            throw new ValidationException('Slaptažodį turi sudaryti mažiausiai vienas skaičius ir viena didžioji raidė.');
        }
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