<?php


namespace App\Controllers;


use App\Models\Project;
use Core\Controller;

class Api extends Controller
{
    public function index()
    {
        echo 'Hello from API :)';
    }

    /**
     * Adding project to database trough API JavaScript request from Home screen
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $content = trim(file_get_contents("php://input"));
            $decodedContent = json_decode($content, true);

            if ($decodedContent !== null) {
                $project = new Project();
                $project->add($decodedContent);
            }
        }
    }

}