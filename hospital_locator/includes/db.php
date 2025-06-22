<?php
require_once __DIR__ . '/../config/config.php';

function get_db_connection()
{
    static $conn;
    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            die('Database connection failed: ' . $conn->connect_error);
        }
    }
    return $conn;
}
?>
