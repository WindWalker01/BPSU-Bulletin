<?php
namespace Core\Middleware;

class Role
{
    public function handle(array $roles)
    {
        $currentRole = getLoggedInRole();
        // echo json_encode(["currentROle" => $currentRole, "roles" => $roles]);

        if (!in_array(strtolower($currentRole), $roles)) {
            redirect("/404");
            exit("access denied");
        }
        return true;
    }
}
