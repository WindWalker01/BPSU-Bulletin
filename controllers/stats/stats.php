<?php
use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$current_user_id = (new Authenticator())->getLoggedInUserId();

if (!$current_user_id) {
    redirect('/login'); 
    exit();
}

$search_term = $_GET['search'] ?? '';
$sql_params = ['author_id' => $current_user_id];
$search_sql = '';

if (!empty($search_term)) {
    $search_sql = " AND b.title LIKE :search"; 
    $sql_params['search'] = '%' . $search_term . '%';
}

$posts = $db->query(
    "SELECT 
        b.id, 
        b.title, 
        b.blog_status, 
        COALESCE(v.views_count, 0) as views_count, 
        COALESCE(c.comments_count, 0) as comments_count
    FROM blogs b
    LEFT JOIN (
        SELECT blog_id, COUNT(*) as views_count 
        FROM blog_views 
        GROUP BY blog_id
    ) v ON b.id = v.blog_id
    LEFT JOIN (
        SELECT blog_id, COUNT(*) as comments_count 
        FROM comments 
        GROUP BY blog_id
    ) c ON b.id = c.blog_id
    WHERE 
        b.blog_status = 'ACTIVE' AND b.author_id = :author_id
        {$search_sql}
    ORDER BY 
        b.published_at DESC",
    $sql_params
)->get();

$days_to_fetch = 30;
$daily_start_date = (new DateTime())->modify('-' . ($days_to_fetch - 1) . ' days')->setTime(0, 0, 0);
$end_date = (new DateTime())->setTime(23, 59, 59);

$raw_daily_views = $db->query(
    "SELECT 
        DATE(bv.viewed_at) as view_date,
        COUNT(*) as daily_views
    FROM blog_views bv
    JOIN blogs b ON bv.blog_id = b.id
    WHERE 
        b.author_id = :author_id AND
        bv.viewed_at BETWEEN :start_date AND :end_date
    GROUP BY 
        view_date
    ORDER BY 
        view_date ASC",
    [
        'author_id' => $current_user_id,
        'start_date' => $daily_start_date->format('Y-m-d H:i:s'),
        'end_date' => $end_date->format('Y-m-d H:i:s')
    ]
)->get();

$daily_views_map = [];
foreach ($raw_daily_views as $row) {
    $daily_views_map[$row['view_date']] = $row;
}

$daily_chart_labels = [];
$daily_chart_data = [];
$todays_views = 0;
$today_date_string = (new DateTime())->format('Y-m-d');

for ($i = 0; $i < $days_to_fetch; $i++) {
    $date = (clone $daily_start_date)->modify("+$i days");
    $date_string = $date->format('Y-m-d');
    $label_string = $date->format('M j');
    
    $views = $daily_views_map[$date_string]['daily_views'] ?? 0;
    
    $daily_chart_labels[] = $label_string;
    $daily_chart_data[] = $views;
    
    if ($date_string === $today_date_string) {
        $todays_views = $views;
    }
}

$hours_to_fetch = 24;
$hourly_start_date = (new DateTime())->modify('-' . ($hours_to_fetch - 1) . ' hours');
$hourly_start_date->setTime($hourly_start_date->format('H'), 0, 0);

$raw_hourly_views = $db->query(
    "SELECT 
        DATE_FORMAT(bv.viewed_at, '%Y-%m-%d %H:00:00') as view_hour,
        COUNT(*) as hourly_views
    FROM blog_views bv
    JOIN blogs b ON bv.blog_id = b.id
    WHERE 
        b.author_id = :author_id AND
        bv.viewed_at >= :start_time
    GROUP BY 
        view_hour
    ORDER BY 
        view_hour ASC",
    [
        'author_id' => $current_user_id,
        'start_time' => $hourly_start_date->format('Y-m-d H:i:s')
    ]
)->get();

$hourly_views_map = [];
foreach ($raw_hourly_views as $row) {
    $hourly_views_map[$row['view_hour']] = $row;
}

$hourly_chart_labels = [];
$hourly_chart_data = [];

for ($i = 0; $i < $hours_to_fetch; $i++) {
    $date = (clone $hourly_start_date)->modify("+$i hours");
    $hour_string = $date->format('Y-m-d H:00:00');
    $label_string = $date->format('g A'); 
    
    if ($i == 0 || $date->format('H') == '00') {
        $label_string = $date->format('M j, g A'); 
    }

    $views = $hourly_views_map[$hour_string]['hourly_views'] ?? 0;
    
    $hourly_chart_labels[] = $label_string;
    $hourly_chart_data[] = $views;
}


render('stats/stats.view.php', [ 
    'published_blogs' => $posts,
    'search_term' => $search_term,

    'todays_views' => $todays_views,
    'total_7_day_views' => array_sum(array_slice($daily_chart_data, -7)),
    'total_30_day_views' => array_sum($daily_chart_data),

    'daily_chart_labels_json' => json_encode($daily_chart_labels),
    'daily_chart_data_json' => json_encode($daily_chart_data),
    'hourly_chart_labels_json' => json_encode($hourly_chart_labels),
    'hourly_chart_data_json' => json_encode($hourly_chart_data)
]);