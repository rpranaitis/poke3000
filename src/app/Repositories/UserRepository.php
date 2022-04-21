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
        $dateTime = date('Y-m-d H:i:s');

        $query = 'INSERT INTO users (username, password, name, surname, email, created_at) VALUES (:username, :password, :name, :surname, :email, :created_at)';

        $stmt = $this->dbh->prepare($query);
        $stmt->execute([
            'username'   => $_POST['username'],
            'password'   => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'name'       => $_POST['name'],
            'surname'    => $_POST['surname'],
            'email'      => $_POST['email'],
            'created_at' => $dateTime,
        ]);

        return $this->dbh->lastInsertId();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function update(int $id): bool
    {
        $dateTime = date('Y-m-d H:i:s');

        $query = 'UPDATE users SET password = :password, name = :name, surname = :surname, email = :email, updated_at = :updated_at WHERE id = :id';

        $stmt = $this->dbh->prepare($query);

        return $stmt->execute([
            'password'   => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'name'       => $_POST['name'],
            'surname'    => $_POST['surname'],
            'email'      => $_POST['email'],
            'updated_at' => $dateTime,
            'id'         => $id
        ]);
    }
}