<?php

namespace App\Repositories;

use PDO;

class PokeHistoryRepository extends Repository
{
    /**
     * @return array
     */
    public function getAllPokes(): array
    {
        $query = 'SELECT `date`, u1.first_name as "sender_first_name", u1.last_name as "sender_last_name", u2.first_name as "recipient_first_name", u2.last_name as "recipient_last_name" FROM pokes_history INNER JOIN users AS u1 ON pokes_history.from = u1.email INNER JOIN users AS u2 ON pokes_history.to = u2.email';

        $stmt = $this->dbh->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $to
     * @return bool|array
     */
    public function getAllPokesByEmailTo(string $to): bool|array
    {
        $query = 'SELECT * FROM pokes_history WHERE `to` = :to';

        $stmt = $this->dbh->prepare($query);
        $stmt->execute([
            'to' => $to
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param array $data
     * @return string
     */
    public function create(array $data): string
    {
        $query = 'INSERT INTO pokes_history (`from`, `to`, `date`) VALUES (:from, :to, :date)';

        $stmt = $this->dbh->prepare($query);
        $stmt->execute([
            'from' => $data['from'],
            'to' => $data['to'],
            'date' => $data['date'] ?? date('Y-m-d')
        ]);

        return $this->dbh->lastInsertId();
    }
}