<?php

namespace Core\Middleware;

use Exception;

class Middleware
{
    private const MAP = [
        "role" => Role::class,
    ];

    public static function resolve($key, $params = [])
    {
        if (!$key) {
            return null;
        }

        if (!array_key_exists($key, self::MAP)) {
            throw new Exception(
                "No matching middleware found for this key: {$key}.",
            );
        }

        $class = self::MAP[$key];
        $middleware = new $class();

        if (method_exists($middleware, "handle")) {
            return $middleware->handle($params);
        }
    }
}
