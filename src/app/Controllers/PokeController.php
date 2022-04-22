<?php

namespace App\Controllers;

use App\Exceptions\ValidationException;
use App\Helper;
use App\Mail\PokeReceived;
use App\Repositories\PokeHistoryRepository;
use App\Repositories\UserRepository;
use App\Validators\Poke\PokeValidator;
use App\Validators\Poke\ShowingAllUsersValidator;
use Exception;

class PokeController
{
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * @var PokeHistoryRepository
     */
    protected PokeHistoryRepository $pokeHistoryRepository;

    /**
     * @var PokeReceived
     */
    protected PokeReceived $pokeReceived;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->pokeHistoryRepository = new PokeHistoryRepository();
        $this->pokeReceived = new PokeReceived();
    }

    /**
     * @return string
     */
    public function index(): string
    {
        return file_get_contents(ROOT_PATH . '/views/index.phtml');
    }

    /**
     * @return string
     * @throws ValidationException
     */
    public function showAllUsersWithPokes(): string
    {
        session_start();

        $validator = new ShowingAllUsersValidator();
        $validator->validate();

        $users = $this->userRepository->getAllUsers();
        $result = [];

        foreach ($users as $user) {
            $tempUser = [
                'id'         => $user['id'],
                'first_name' => $user['first_name'],
                'last_name'  => $user['last_name'],
                'email'      => $user['email'],
                'poke_count' => count($this->pokeHistoryRepository->getAllPokesByEmailTo($user['email']))
            ];

            $result[] = $tempUser;
        }

        return Helper::response(null, $result);
    }

    /**
     * @return string
     * @throws ValidationException
     */
    public function poke(): string
    {
        session_start();

        $validator = new PokeValidator();
        $validator->validate();

        $from = $this->userRepository->getUserById($_POST['from']);
        $to = $this->userRepository->getUserById($_POST['to']);

        if (!$from) {
            throw new ValidationException('Įvyko klaida grąžinant vartotoją iš duomenų bazės.');
        }

        if (!$to) {
            throw new ValidationException('Vartotojas, kuriam siunčiate poke neegzistuoja.');
        }

        $data = [
            'from' => $from['email'],
            'to'   => $to['email']
        ];

        try {
            $this->pokeHistoryRepository->create($data);
        } catch (Exception $e) {
            throw new ValidationException('Įvyko klaida kreipiantis į duomenų bazę.');
        }

        $emailSent = $this->pokeReceived->send($to['email'], $from['username']);

        return Helper::response('Poke sėkmingai išsiųstas.', ['email_sent' => $emailSent]);
    }
}