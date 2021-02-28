<?php


namespace Core;


class Router
{
    private string $controller = '\App\Controllers\Home';
    private string $method = 'index';
    private ?array $params = [];

    private const DEFAULT_CONTROLLER = 'Home';
    private const CONTROLLER_PREFIX = '\App\Controllers\\';
    private const ERROR_404 = 'Error';

    public function __construct()
    {
        $this->getUrl();
    }

    public function getUrl(): void
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $parsedUrl = explode('/', $url, 3);

        $controller = self::CONTROLLER_PREFIX . ucwords($parsedUrl[0]);
        $method = $parsedUrl[1];

        if (class_exists($controller)) {
            $this->controller = $controller;
        } else {
            if ($url === '') {
                $this->controller = self::CONTROLLER_PREFIX . self::DEFAULT_CONTROLLER;
            } else {
                $this->controller = self::CONTROLLER_PREFIX . self::ERROR_404;
            }
        }

        if (method_exists($controller, $method)) {
            $this->method = $method;
        }

        if ($parsedUrl[2] !== null) {
            $params = explode('/', $parsedUrl[2], 4);
            $this->params['project_id'] = $params[0];
            $this->params['action'] = $params[1];
            $this->params['value'] = $params[2];
            unset($params[3]); // unsetting all the remaining which we don't need
        }
    }

    public function run()
    {
        $this->getUrl();
        $method = $this->method;
        $app = new $this->controller(new Request(), $this->params);
        $app->$method();
    }

}