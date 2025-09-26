<?php

namespace Core;

class Router
{
    protected $routes = [];

    public function get($uri, $controller)
    {
        $this->add("GET", $uri, $controller);
    }

    public function post($uri, $controller)
    {
        $this->add("POST", $uri, $controller);
    }

    public function put($uri, $controller)
    {
        $this->add("PUT", $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        $this->add("PATCH", $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        $this->add("DELETE", $uri, $controller);
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if (
                $route["uri"] === $uri &&
                strtoupper($method) === $route["method"]
            ) {
                return require base_path($route["controller"]);
            }

            $this->abort(404);
        }
    }

    protected function add($method, $uri, $controller)
    {
        $this->routes[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
        ];
    }

    protected function abort($code)
    {
        echo "Not Found.";
        http_response_code($code);
        die();
    }
}
