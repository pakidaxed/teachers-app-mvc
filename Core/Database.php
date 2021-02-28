<?php


namespace Core;


class Database
{
    protected string $table;

    protected \PDO $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
            DB_USER,
            DB_PASS
        );
    }

    public function getOne(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    public function getAll(): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->table ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: null;
    }


}