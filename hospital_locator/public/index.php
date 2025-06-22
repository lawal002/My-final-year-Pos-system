<?php
require_once __DIR__ . '/../includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital Locator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
</head>
<body>
<div class="container py-4">
    <h1 class="mb-4">Hospital Locator</h1>
    <div class="mb-3">
        <input type="text" id="keyword" class="form-control" placeholder="Search by city or name">
    </div>
    <div id="map" style="height:500px;"></div>
    <div id="results" class="mt-3"></div>
</div>
<script src="assets/js/map.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
