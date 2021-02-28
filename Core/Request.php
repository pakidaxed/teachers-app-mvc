<?php

namespace Core;

class Request
{
    private ?array $get;
    private ?array $post;

    public function __construct()
    {
        $this->get = isset($_GET) ? $_GET : null;
        $this->post = isset($_POST) ? $_POST : null;
    }

    /**
     * @param string|null $key
     * @return string|array|null
     */
    public function get(?string $key = null)
    {
        if ($key !== null) {
            return isset($this->get[$key]) ? $this->get[$key] : null;
        }

        return $this->get;

    }

    /**
     * @param string|null $key
     * @return string|array|null
     */
    public function post(?string $key = null)
    {
        if ($key !== null) {
            return isset($this->post[$key]) ? $this->post[$key] : null;
        }

        return $this->post;

    }
}