<?php

namespace App\Controllers;

use App\Exceptions\ValidationException;
use App\Helper;
use App\Repositories\UserRepository;
use App\Validators\User\EditingValidator;
use App\Validators\User\LoginValidator;
use App\Validators\User\LogoutValidator;
use App\Validators\User\RegistrationValidator;
use App\Validators\User\ShowValidator;

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

        $this->userRepository->create($_POST);

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

        $this->userRepository->update($id, $_POST);

        return Helper::response('Vartotojo informacija atnaujinta sėkmingai.');
    }

    /**
     * @param int $id
     * @return string
     * @throws ValidationException
     */
    public function show(int $id): string
    {
        session_start();

        $validator = new ShowValidator();
        $validator->validate($id);

        $user = $this->userRepository->getUserById($id);

        if (!$user) {
            throw new ValidationException('Įvyko klaida grąžinant vartotoją.');
        }

        $data = [
            'id'         => $user['id'],
            'username'   => $user['username'],
            'first_name' => $user['first_name'],
            'last_name'  => $user['last_name'],
            'email'      => $user['email']
        ];

        return Helper::response(null, $data);
    }
}