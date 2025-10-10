<?php

namespace Core\Middleware;

use Exception;

class Middleware
{
    private const MAP = [
        "guest" => Guest::class,
        "auth" => Authenticated::class,
        "author" => Author::class,
    ];

    public static function resolve($key)
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
        return new $class()->handle();
    }
}
