<?php

namespace App\Repositories;

use PDO;

class UserRepository extends Repository
{
    /**
     * @param string $username
     * @return mixed
     */
    public function getUserByUsername(string $username): mixed
    {
        $query = 'SELECT * FROM users WHERE username = :username';

        $stmt = $this->dbh->prepare($query);
        $stmt->execute([
            'username' => $username
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @return string
     */
    public function create(): string
    {
        $datetime = date('Y-m-d H:i:s');

        $query = 'INSERT INTO users (username, password, name, surname, email, created_at) VALUES (:username, :password, :name, :surname, :email, :created_at)';

        $stmt = $this->dbh->prepare($query);
        $stmt->execute([
            'username'   => $_POST['username'],
            'password'   => $_POST['password'],
            'name'       => $_POST['name'],
            'surname'    => $_POST['surname'],
            'email'      => $_POST['email'],
            'created_at' => $datetime,
        ]);

        return $this->dbh->lastInsertId();
    }
}