<?php

namespace App\Repositories;

use PDO;

class UserRepository extends Repository
{
    /**
     * @return array
     */
    public function getAllUsers(): array
    {
        $query = 'SELECT * FROM users ORDER BY id DESC';

        $stmt = $this->dbh->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

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
     * @param string $email
     * @return mixed
     */
    public function getUserByEmail(string $email): mixed
    {
        $query = 'SELECT * FROM users WHERE email = :email';

        $stmt = $this->dbh->prepare($query);
        $stmt->execute([
            'email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getUserById(int $id): mixed
    {
        $query = 'SELECT * FROM users WHERE id = :id';

        $stmt = $this->dbh->prepare($query);
        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param array $data
     * @return string
     */
    public function create(array $data): string
    {
        $dateTime = date('Y-m-d H:i:s');

        $query = 'INSERT INTO users (username, password, first_name, last_name, email, created_at) VALUES (:username, :password, :first_name, :last_name, :email, :created_at)';

        $stmt = $this->dbh->prepare($query);
        $stmt->execute([
            'username'   => $data['username'],
            'password'   => password_hash($data['password'], PASSWORD_BCRYPT),
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'created_at' => $dateTime,
        ]);

        return $this->dbh->lastInsertId();
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $dateTime = date('Y-m-d H:i:s');

        $query = 'UPDATE users SET password = :password, first_name = :first_name, last_name = :last_name, email = :email, updated_at = :updated_at WHERE id = :id';

        $stmt = $this->dbh->prepare($query);

        return $stmt->execute([
            'password'   => password_hash($data['password'], PASSWORD_BCRYPT),
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'updated_at' => $dateTime,
            'id'         => $id
        ]);
    }
}