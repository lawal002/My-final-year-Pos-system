<?php
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');
$keyword = $_GET['keyword'] ?? null;
$lat = isset($_GET['lat']) ? (float)$_GET['lat'] : null;
$lng = isset($_GET['lng']) ? (float)$_GET['lng'] : null;

if ($keyword) {
    $hospitals = fetch_hospitals_by_keyword($keyword);
} elseif ($lat && $lng) {
    $hospitals = fetch_hospitals_nearby($lat, $lng);
} else {
    $hospitals = [];
}

echo json_encode($hospitals);
?>
