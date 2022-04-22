<?php

namespace App\Repositories;

class PokeHistoryRepository extends Repository
{
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