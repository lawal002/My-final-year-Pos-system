<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_login();

$conn = get_db_connection();
$id = intval($_GET['id'] ?? 0);
$editing = $id > 0;
$name = $type = $address = $city = $lat = $lng = $phone = $website = $specialties = $rating = '';

if ($editing) {
    $stmt = $conn->prepare('SELECT * FROM hospitals WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
    if ($data) extract($data);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $specialties = $_POST['specialties'];
    $rating = $_POST['rating'];

    if ($editing) {
        $stmt = $conn->prepare('UPDATE hospitals SET name=?, type=?, address=?, city=?, latitude=?, longitude=?, phone=?, website=?, specialties=?, rating=? WHERE id=?');
        $stmt->bind_param('ssssddsssdi', $name, $type, $address, $city, $lat, $lng, $phone, $website, $specialties, $rating, $id);
    } else {
        $stmt = $conn->prepare('INSERT INTO hospitals (name, type, address, city, latitude, longitude, phone, website, specialties, rating) VALUES (?,?,?,?,?,?,?,?,?,?)');
        $stmt->bind_param('ssssddsssd', $name, $type, $address, $city, $lat, $lng, $phone, $website, $specialties, $rating);
    }
    $stmt->execute();
    header('Location: manage_hospitals.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $editing ? 'Edit' : 'Add' ?> Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1><?= $editing ? 'Edit' : 'Add' ?> Hospital</h1>
    <form method="post">
        <div class="mb-3"><input type="text" name="name" class="form-control" placeholder="Name" value="<?= htmlspecialchars($name) ?>" required></div>
        <div class="mb-3"><input type="text" name="type" class="form-control" placeholder="Type" value="<?= htmlspecialchars($type) ?>"></div>
        <div class="mb-3"><input type="text" name="address" class="form-control" placeholder="Address" value="<?= htmlspecialchars($address) ?>"></div>
        <div class="mb-3"><input type="text" name="city" class="form-control" placeholder="City" value="<?= htmlspecialchars($city) ?>"></div>
        <div class="mb-3"><input type="number" step="any" name="latitude" class="form-control" placeholder="Latitude" value="<?= htmlspecialchars($lat) ?>"></div>
        <div class="mb-3"><input type="number" step="any" name="longitude" class="form-control" placeholder="Longitude" value="<?= htmlspecialchars($lng) ?>"></div>
        <div class="mb-3"><input type="text" name="phone" class="form-control" placeholder="Phone" value="<?= htmlspecialchars($phone) ?>"></div>
        <div class="mb-3"><input type="text" name="website" class="form-control" placeholder="Website" value="<?= htmlspecialchars($website) ?>"></div>
        <div class="mb-3"><input type="text" name="specialties" class="form-control" placeholder="Specialties" value="<?= htmlspecialchars($specialties) ?>"></div>
        <div class="mb-3"><input type="number" step="0.1" name="rating" class="form-control" placeholder="Rating" value="<?= htmlspecialchars($rating) ?>"></div>
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="manage_hospitals.php" class="btn btn-secondary">Cancel</a>
    </form>
</body>
</html>
