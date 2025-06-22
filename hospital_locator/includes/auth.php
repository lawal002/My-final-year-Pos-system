<?php
require_once __DIR__ . '/db.php';

function login($username, $password)
{
    $conn = get_db_connection();
    $stmt = $conn->prepare("SELECT id, hashed_password FROM admins WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['hashed_password'])) {
            $_SESSION['admin_id'] = $row['id'];
            return true;
        }
    }
    return false;
}

function require_login()
{
    if (empty($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit();
    }
}

function logout()
{
    session_destroy();
    header('Location: login.php');
    exit();
}
?>
