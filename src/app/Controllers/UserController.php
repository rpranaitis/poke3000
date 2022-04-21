<?php

namespace App\Controllers;

use App\Exceptions\ValidationException;
use App\Helper;
use App\Repositories\UserRepository;
use App\Validators\User\RegistrationValidator;

class UserController
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
     * @return string
     */
    public function register(): string
    {
        $validator = new RegistrationValidator();

        try {
            $validator->validate();
            $this->userRepository->create();
        } catch (ValidationException $e) {
            return Helper::responseError($e->getMessage());
        }

        return Helper::response('Vartotojas sėkmingai sukurtas.');
    }
}