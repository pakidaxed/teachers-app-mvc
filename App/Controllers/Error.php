<?php


namespace App\Controllers;


class Error
{
    public function index()
    {
        echo '<h1>ERROR 404</h1>';
        die;
    }

}