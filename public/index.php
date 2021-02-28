<?php

session_start();

use Core\Router;
require '../App/config/env.php';
require '../vendor/autoload.php';

$router = new Router();

$router->run();

session_destroy();







