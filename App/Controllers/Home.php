<?php

namespace App\Controllers;


use App\Models\Project;
use Core\Controller;


class Home extends Controller
{
    public function index()
    {
        $projects = new Project();
        $this->render('home', $projects->getAll());
    }


}