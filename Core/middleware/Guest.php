<?php
namespace Core\Middleware;

class Guest
{
    public function handle()
    {
        if (isset($_COOKIE["auth_token"])) {
            header("location: /");
            exit();
        }
    }
}
