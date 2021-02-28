<?php

namespace App\Helpers;

trait StudentManager
{
    public static function getAssignedStudents($students): array
    {
        return array_filter($students, function ($student) {
            return $student['group_id'];
        });
    }

    public static function getAvailableStudents($students): array
    {
        return array_filter($students, function ($student) {
            return !$student['group_id'];
        });
    }

}