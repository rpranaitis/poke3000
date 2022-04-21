<?php

namespace App\Controllers;

use App\Exceptions\ValidationException;
use App\Helper;
use App\Repositories\UserRepository;
use App\Validators\User\EditingValidator;
use App\Validators\User\LoginValidator;
use App\Validators\User\LogoutValidator;
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
     * @throws ValidationException
     */
    public function register(): string
    {
        $validator = new RegistrationValidator();
        $validator->validate();

        $this->userRepository->create();

        return Helper::response('Vartotojas sėkmingai sukurtas.');
    }

    /**
     * @return string
     * @throws ValidationException
     */
    public function login(): string
    {
        $validator = new LoginValidator();
        $validator->validate();

        $user = $this->userRepository->getUserByUsername($_POST['username']);

        session_start();

        $_SESSION['user_id'] = $user['id'];

        return Helper::response('Prisijungta sėkmingai.', ['user_id' => $user['id']]);
    }

    /**
     * @return string
     * @throws ValidationException
     */
    public function logout(): string
    {
        session_start();

        $validator = new LogoutValidator();
        $validator->validate();

        session_destroy();

        return Helper::response('Atsijungta sėkmingai.');
    }

    /**
     * @param int $id
     * @return string
     * @throws ValidationException
     */
    public function edit(int $id): string
    {
        session_start();

        $validator = new EditingValidator();
        $validator->validate($id);

        $this->userRepository->update($id);

        return Helper::response('Vartotojo informacija atnaujinta sėkmingai.');
    }
}