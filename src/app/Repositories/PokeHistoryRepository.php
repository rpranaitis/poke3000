<?php

namespace App\Repositories;

use PDO;

class PokeHistoryRepository extends Repository
{
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
            'to'   => $data['to'],
            'date' => $data['date'] ?? date('Y-m-d')
        ]);

        return $this->dbh->lastInsertId();
    }
}