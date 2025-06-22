<?php
require_once __DIR__ . '/../includes/auth.php';
require_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1>Dashboard</h1>
    <nav>
        <a href="manage_hospitals.php" class="btn btn-primary">Manage Hospitals</a>
        <a href="logout.php" class="btn btn-secondary">Logout</a>
    </nav>
</body>
</html>
