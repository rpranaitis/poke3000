<?php

namespace App\Validators\User;

use App\Exceptions\ValidationException;
use App\Repositories\UserRepository;

class RegisterValidator
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
    public function validate()
    {
        $this->validateRequiredFields();
        $this->validateUsername();
        $this->validateArePasswordsTheSame();
        $this->validatePassword();
    }

    /**
     * @throws ValidationException
     */
    protected function validateRequiredFields()
    {
        if (empty($_POST['username'])) {
            throw new ValidationException('Neįvestas vartotojo vardas.');
        }

        if (empty($_POST['password'])) {
            throw new ValidationException('Neįvestas slaptažodis.');
        }

        if (empty($_POST['password_repeated'])) {
            throw new ValidationException('Neįvestas pakartotinas slaptažodis.');
        }

        if (empty($_POST['name'])) {
            throw new ValidationException('Neįvestas vardas.');
        }

        if (empty($_POST['surname'])) {
            throw new ValidationException('Neįvesta pavardė.');
        }

        if (empty($_POST['email'])) {
            throw new ValidationException('Neįvestas el. pašto adresas.');
        }
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
    protected function validatePassword()
    {
        if (!preg_match('/^(?:(?=.*\d)(?=.*[A-Z]).*)$/', $_POST['password'])) {
            throw new ValidationException('Slaptažodį turi sudaryti mažiausiai vienas skaičius ir viena didžioji raidė.');
        }
    }
}