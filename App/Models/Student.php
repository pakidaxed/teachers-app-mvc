<?php


namespace App\Models;


use Core\Database;

class Student extends Database
{
    protected string $table = 'students';

    public function getProjectStudents(int $id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE project_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addStudent(string $name, int $projectId): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO $this->table (name, project_id) VALUES (:name, :project_id)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':project_id', $projectId);
        return $stmt->execute();
    }

    public function deleteStudent(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function checkDuplicatesInGroup(string $name, int $id): bool
    {
        $stmt = $this->pdo->prepare("SELECT name FROM $this->table WHERE project_id = :id && name = :name");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$result) {
            return false;
        }

        return true;
    }

    public function assignStudent(array $studentData): void
    {
        $stmt = $this->pdo->prepare("UPDATE $this->table SET 
        group_id = :group_id, 
        position = :position
        WHERE id = :student_id
");
        $stmt->bindParam(':group_id', $studentData['group_id']);
        $stmt->bindParam(':position', $studentData['position']);
        $stmt->bindParam(':student_id', $studentData['student_id']);
        $stmt->execute();
    }

}