<?php

namespace App\Services;

use App\Exceptions\ServiceException;
use App\Repositories\UserRepository;
use Exception;

class DataImportService
{
    /**
     * @var UserRepository $userRepository
     */
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * @return int
     * @throws ServiceException
     */
    public function importUsersFromCsv(): int
    {
        $path = ROOT_PATH . getenv('USERS_CSV_FILE_PATH');

        if (!file_exists($path)) {
            throw new ServiceException('Įvyko klaida. Patikrinkite kelią iki CSV failo.');
        }

        $csv = array_map('str_getcsv', file($path));

        $structure = [
            'id',
            'first_name',
            'last_name',
            'email'
        ];

        if ($csv[0] !== $structure) {
            throw new ServiceException('Bloga CSV failo struktūra.');
        }

        $failedImports = 0;

        for ($i = 1; $i < count($csv); $i++) {
            $data = [
                'username'   => explode('@', $csv[$i][3])[0],
                'password'   => $this->generateRandomPassword(),
                'first_name' => $csv[$i][1],
                'last_name'  => $csv[$i][2],
                'email'      => $csv[$i][3],
            ];

            try {
                $this->userRepository->create($data);
            } catch (Exception $e) {
                $failedImports++;
                continue;
            }
        }

        return $failedImports;
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