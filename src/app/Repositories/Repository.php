<?php

namespace App\Repositories;

use PDO;

class Repository
{
    /**
     * @var PDO
     */
    protected PDO $dbh;

    public function __construct()
    {
        $host = getenv('MYSQL_HOST');
        $database = getenv('MYSQL_DATABASE');
        $username = getenv('MYSQL_USER');
        $password = getenv('MYSQL_PASSWORD');

        $this->dbh = new PDO("mysql:host={$host};dbname={$database}", $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}