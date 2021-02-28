<?php

namespace App\Models;

use Core\Database;

class Project extends Database
{
    protected string $table = 'projects';

    /*
     * Getting data from API request, adding to DB, and returning json encoded result to front
     */
    public function add(array $data): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO $this->table (name, groups_total, students_per_group)
        VALUES (:name, :groups_total, :students_per_group)");

        $stmt->bindParam(':name', $data['project_name']);
        $stmt->bindParam(':groups_total', $data['groups_total']);
        $stmt->bindParam(':students_per_group', $data['students_per_group']);
        $result = $stmt->execute();
        $lastId = $this->pdo->lastInsertId();

        if ($result) $result2 = $this->generateGroups($data['groups_total'], $lastId);

        if ($result && $result2) {
            echo json_encode(['result' => true]);
        } else {
            echo json_encode(['result' => false]);
        }
    }

    /*
     * Generating automated group names if project inserted successfully
     */
    private function generateGroups(int $groupsTotal, int $projectId): bool
    {
        for ($i = 1; $i <= $groupsTotal; $i++) {
            $stmt = $this->pdo->prepare("INSERT INTO project_groups (name, project_id) 
                VALUES (:name, :project_id)");

            $groupName = 'Group #' . $i;
            $stmt->bindParam(':name', $groupName);
            $stmt->bindParam(':project_id', $projectId);

            $result = $stmt->execute();
        }

        return $result;
    }
}