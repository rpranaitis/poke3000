<?php

namespace App\Validators\User;

use App\Exceptions\ValidationException;
use App\Repositories\UserRepository;

class LoginValidator
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
        $this->validateCredentials();
    }

    /**
     * @throws ValidationException
     */
    protected function validateCredentials()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->userRepository->getUserByUsername($username);

        if (!$user || !password_verify($password, $user['password'])) {
            throw new ValidationException('Blogi prisijungimo duomenys.');
        }
    }
}