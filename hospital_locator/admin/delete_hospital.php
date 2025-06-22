<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_login();

$id = intval($_GET['id'] ?? 0);
if ($id) {
    $conn = get_db_connection();
    $stmt = $conn->prepare('DELETE FROM hospitals WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
}
header('Location: manage_hospitals.php');
exit();
