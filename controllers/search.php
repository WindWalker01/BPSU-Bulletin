<?php
use Core\Database;
use Core\App;

$query = $_GET["query"];

$db = App::resolve(Database::class);

$blogs = $db
    ->query(
        "
  SELECT DISTINCT 
    b.id, b.title, b.created_at, b.published_at,
    u.username AS author_name,
    GROUP_CONCAT(DISTINCT t.name) AS tags,
    GROUP_CONCAT(DISTINCT c.value) AS categories
  FROM blogs b
  LEFT JOIN users u ON b.author_id = u.id
  LEFT JOIN blog_tags bt ON bt.blog_id = b.id
  LEFT JOIN tags t ON bt.tag_id = t.id
  LEFT JOIN blog_categories bc ON bc.blog_id = b.id
  LEFT JOIN categories c ON bc.category_id = c.id
  WHERE b.blog_status = 'ACTIVE'
    AND (
      LOWER(b.title) LIKE LOWER(:query)
      OR LOWER(IFNULL(t.name, '')) LIKE LOWER(:query)
      OR LOWER(IFNULL(c.value, '')) LIKE LOWER(:query)
      OR LOWER(IFNULL(u.username, '')) LIKE LOWER(:query)
    )
  GROUP BY b.id
  ORDER BY b.published_at DESC
  LIMIT 10
",
        [
            "query" => "%{$query}%",
        ],
    )
    ->get();

$users = $db
    ->query(
        "
            SELECT 
                u.id,
                u.username,
                u.email,
                u.created_at,
            pi.secure_url
            FROM users u
            INNER JOIN profile_images pi ON pi.user_id = u.id
            WHERE 
            LOWER(u.username) LIKE LOWER(:query)
            LIMIT 10;
            ",
        [
            "query" => "%{$query}%",
        ],
    )
    ->get();

// $db->query(
//     "
// SELECT
//     b.id,
//     u.username,
//     pi.secure_url,
//     b.updated_at,
//     b.title,
//     b.content,

//     COUNT(CASE WHEN br.reaction_id = 1 THEN 1 END) AS reaction_count_like,
//     COUNT(c.id) AS comment_count

// FROM blogs b
// INNER JOIN users u ON b.author_id = u.id
// LEFT JOIN profile_images pi ON b.author_id = pi.user_id
// LEFT JOIN blog_reactions br ON b.id = br.blog_id
// LEFT JOIN comments c ON b.id = c.blog_id

// WHERE b.id = :id
// GROUP BY
//     b.id,
//     u.username,
//     pi.secure_url,
//     b.updated_at,
//     b.title,
//     b.content;

// ", ["id" => ]
// )->get();

echo json_encode(["blogs" => $blogs, "users" => $users]);

exit();
