<?php

namespace App\Services;

use App\Exceptions\ServiceException;
use App\Repositories\PokeHistoryRepository;
use App\Repositories\UserRepository;
use Exception;

class DataImportService
{
    /**
     * @var UserRepository $userRepository
     */
    protected UserRepository $userRepository;

    /**
     * @var PokeHistoryRepository $pokeHistoryRepository
     */
    protected PokeHistoryRepository $pokeHistoryRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->pokeHistoryRepository = new PokeHistoryRepository();
    }

    /**
     * @return int[]
     * @throws ServiceException
     */
    public function importUsersFromCsv(): array
    {
        $path = ROOT_PATH . getenv('USERS_CSV_FILE_PATH');

        if (!file_exists($path)) {
            throw new ServiceException('Įvyko klaida. Patikrinkite kelią iki CSV failo.');
        }

        $users = array_map('str_getcsv', file($path));

        $structure = [
            'id',
            'first_name',
            'last_name',
            'email'
        ];

        if ($users[0] !== $structure) {
            throw new ServiceException('Bloga CSV failo struktūra.');
        }

        $successImports = $failedImports = 0;

        for ($i = 1; $i < count($users); $i++) {
            $data = [
                'username'   => explode('@', $users[$i][3])[0],
                'password'   => $this->generateRandomPassword(),
                'first_name' => $users[$i][1],
                'last_name'  => $users[$i][2],
                'email'      => $users[$i][3],
            ];

            try {
                $this->userRepository->create($data);
                $successImports++;
            } catch (Exception $e) {
                $failedImports++;
                continue;
            }
        }

        return [
            'success_imports' => $successImports,
            'failed_imports' => $failedImports
        ];
    }

    /**
     * @return int[]
     * @throws ServiceException
     */
    public function importPokesFromJson(): array
    {
        $path = ROOT_PATH . getenv('POKES_JSON_FILE_PATH');

        if (!file_exists($path)) {
            throw new ServiceException('Įvyko klaida. Patikrinkite kelią iki CSV failo.');
        }

        $pokes = file_get_contents($path);
        $pokes = json_decode($pokes, true);

        $structure = [
            'from',
            'to',
            'date'
        ];

        if (count(array_intersect_key(array_flip($structure), $pokes[0])) !== count($structure)) {
            throw new ServiceException('Bloga JSON failo struktūra.');
        }

        $successImports = $failedImports = 0;

        foreach ($pokes as $poke) {
            $data = [
                'from' => $poke['from'],
                'to'   => $poke['to'],
                'date' => $poke['date']
            ];

            try {
                $this->pokeHistoryRepository->create($data);
                $successImports++;
            } catch (Exception $e) {
                $failedImports++;
                continue;
            }
        }

        return [
            'success_imports' => $successImports,
            'failed_imports' => $failedImports
        ];
    }

    /**
     * @return string
     */
    protected function generateRandomPassword(): string
    {
        $digits = array_flip(range('0', '9'));
        $lowercase = array_flip(range('a', 'z'));
        $uppercase = array_flip(range('A', 'Z'));
        $combined = array_merge($digits, $lowercase, $uppercase);

        return str_shuffle(array_rand($digits) .
            array_rand($lowercase) .
            array_rand($uppercase) .
            implode(array_rand($combined, rand(6, 12))));
    }
}