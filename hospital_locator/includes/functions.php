<?php
require_once __DIR__ . '/db.php';

function fetch_hospitals_by_keyword($keyword)
{
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT * FROM hospitals WHERE name LIKE CONCAT('%', ?, '%') OR city LIKE CONCAT('%', ?, '%')");
    $stmt->bind_param('ss', $keyword, $keyword);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function fetch_hospitals_nearby($lat, $lng, $radius_km = 10)
{
    $conn = get_db_connection();
    $sql = "SELECT *, (
                6371 * acos(
                    cos(radians(?)) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) * sin(radians(latitude))
                )
            ) AS distance
            FROM hospitals
            HAVING distance < ?
            ORDER BY distance";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('dddi', $lat, $lng, $lat, $radius_km);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
