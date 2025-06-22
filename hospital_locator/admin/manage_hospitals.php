<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';
require_login();

$conn = get_db_connection();
$result = $conn->query('SELECT * FROM hospitals');
$hospitals = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Hospitals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1>Manage Hospitals</h1>
    <a href="add_edit_hospital.php" class="btn btn-success mb-3">Add Hospital</a>
    <table class="table table-bordered">
        <thead>
            <tr><th>Name</th><th>City</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($hospitals as $h): ?>
                <tr>
                    <td><?= htmlspecialchars($h['name']) ?></td>
                    <td><?= htmlspecialchars($h['city']) ?></td>
                    <td>
                        <a href="add_edit_hospital.php?id=<?= $h['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="delete_hospital.php?id=<?= $h['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="dashboard.php" class="btn btn-secondary">Back</a>
</body>
</html>
