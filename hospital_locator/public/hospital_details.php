<?php
require_once __DIR__ . '/../includes/db.php';

$id = intval($_GET['id'] ?? 0);
$conn = get_db_connection();
$stmt = $conn->prepare('SELECT * FROM hospitals WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$hospital = $stmt->get_result()->fetch_assoc();

if (!$hospital) {
    die('Hospital not found');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($hospital['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1><?= htmlspecialchars($hospital['name']) ?></h1>
    <p><?= htmlspecialchars($hospital['address']) ?>, <?= htmlspecialchars($hospital['city']) ?></p>
    <p>Phone: <?= htmlspecialchars($hospital['phone']) ?></p>
    <p>Website: <a href="<?= htmlspecialchars($hospital['website']) ?>" target="_blank"><?= htmlspecialchars($hospital['website']) ?></a></p>
    <p>Specialties: <?= htmlspecialchars($hospital['specialties']) ?></p>
    <p>Rating: <?= htmlspecialchars($hospital['rating']) ?></p>
</body>
</html>
