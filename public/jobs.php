<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$db->query(
    "UPDATE blogs SET blog_status = 'ACTIVE', published_at = NOW() WHERE blog_status = 'SCHEDULED' AND scheduled_at <= NOW()",
);
