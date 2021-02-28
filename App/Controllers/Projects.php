<?php


namespace App\Controllers;


use App\Helpers\StudentManager;
use App\Models\Group;
use App\Models\Student;
use Core\Controller;
use App\Models\Project;
use Core\Request;


class Projects extends Controller
{
    public function __construct(Request $request, ?array $params = [])
    {
        parent::__construct($request, $params);

        switch ($params['action']) {
            case 'delete':
                $this->deleteStudent($params['value']);
                break;
            case 'add':
                $this->addStudent($request->post('new_student_name'));
                break;
            case 'assign':
                $this->assignStudent($request->post());
                break;
        }
    }

    public function index()
    {
        $this->redirectHome();
    }

    /*
     * Main projects method, that gathers all information from database and renders the project view
     */
    public function show(): void
    {
        if (!$this->params['project_id']) {
            $this->redirectHome();
        }
        $project = new Project();
        $projectExists = $project->getOne($this->params['project_id']);

        $student = new Student();
        $students = $student->getProjectStudents($this->params['project_id']);

        $assignedStudents = StudentManager::getAssignedStudents($students);
        $availableStudents = StudentManager::getAvailableStudents($students);

        $group = new Group();
        $groups = $group->getProjectGroups($this->params['project_id']);

        if ($projectExists === null) $this->redirectHome();

        $this->render('project', [
            'project' => $projectExists,
            'assigned_students' => $assignedStudents,
            'available_students' => $availableStudents,
            'groups' => $groups
        ]);
    }

    protected function deleteStudent(int $id): void
    {
        $student = new Student();
        $student->deleteStudent($id);
        $_SESSION['message'] = 'Student successfully deleted';
    }

    /*
     * Checking for duplicates in current project, if none adding new student
     */
    protected function addStudent(string $name): void
    {

        $student = new Student();
        $nameExists = $student->checkDuplicatesInGroup($name, $this->params['project_id']);
        if (!$nameExists) {
            $student->addStudent($name, $this->params['project_id']);
            $_SESSION['message'] = 'New student added successfully';
        } else {
            $_SESSION['message'] = 'The name already exists in the group';
        }
    }

    protected function assignStudent(array $studentData): void
    {
        $student = new Student();
        $student->assignStudent($studentData);
        $_SESSION['message'] = 'Student successfully added to the group';

    }


}