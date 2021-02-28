<?php


namespace App\Models;


use Core\Database;

class Group extends Database
{
    // Chosen name is because 'groups' are reserved name
    protected string $table = 'project_groups';

    public function getProjectGroups(int $id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE project_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}