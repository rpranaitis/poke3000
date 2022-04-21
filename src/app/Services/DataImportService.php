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
        $row = 1;
        $failedImports = 0;
        $path = ROOT_PATH . getenv('USERS_CSV_FILE_PATH');

        if (($handle = fopen($path, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000)) !== false) {
                if ($row === 1) {
                    $structure = ['id', 'first_name', 'last_name', 'email'];

                    if ($data !== $structure) {
                        throw new ServiceException('Bloga CSV failo struktūra.');
                    }
                } else {
                    $data = [
                        'username'   => explode('@', $data[3])[0],
                        'password'   => $this->generateRandomPassword(),
                        'first_name' => $data[1],
                        'last_name'  => $data[2],
                        'email'      => $data[3],
                    ];

                    try {
                        $this->userRepository->create($data);
                    } catch (Exception $e) {
                        $failedImports++;
                        continue;
                    }
                }

                $row++;
            }

            fclose($handle);
        } else {
            throw new ServiceException('Įvyko klaida. Patikrinkite kelią iki CSV failo.');
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