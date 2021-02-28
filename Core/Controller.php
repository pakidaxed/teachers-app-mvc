<?php


namespace Core;


class Controller
{
    protected ?array $params;
    protected Request $request;

    public function __construct(Request $request, ?array $params = [])
    {
        $this->params = $params;
        $this->request = $request;
    }

    protected function render(string $template = 'base', ?array $data = []): void
    {
        $template = $template . '/index.php';
        if ($data !== null) extract($data);
        include '../App/Views/index.php';
    }

    protected function redirectHome(): void
    {
        header('Location: /');
    }


}