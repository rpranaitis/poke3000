<?php

namespace App\Controllers;

use App\Exceptions\ValidationException;
use App\Helper;
use App\Mail\PokeReceived;
use App\Repositories\PokeHistoryRepository;
use App\Repositories\UserRepository;
use App\Validators\Poke\PokesValidator;
use App\Validators\Poke\PokeSendingValidator;
use App\Validators\Poke\UserPokesValidator;
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
    public function showAllPokes(): string
    {
        session_start();

        $validator = new PokesValidator();
        $validator->validate();

        $pokes = $this->pokeHistoryRepository->getAllPokes();

        return Helper::response(null, $pokes);
    }

    /**
     * @param int $id
     * @return string
     * @throws ValidationException
     */
    public function showAllUserPokes(int $id): string
    {
        session_start();

        $validator = new UserPokesValidator();
        $validator->validate($id);

        $user = $this->userRepository->getUserById($id);

        if (!$user) {
            throw new ValidationException('Įvyko klaida grąžinant vartotoją iš duomenų bazės.');
        }

        $pokes = $this->pokeHistoryRepository->getAllPokesByEmailTo($user['email']) ?? [];

        return Helper::response(null, $pokes);
    }

    /**
     * @return string
     * @throws ValidationException
     */
    public function poke(): string
    {
        session_start();

        $validator = new PokeSendingValidator();
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