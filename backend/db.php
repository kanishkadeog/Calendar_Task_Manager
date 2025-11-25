<?php
require "config.php";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => "DB Connection Failed: " . $e->getMessage()
    ]);
    exit;
}
?>
