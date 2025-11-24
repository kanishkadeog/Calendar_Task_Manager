<?php
header("Content-Type: application/json");
require "../db.php";

// Read POST data
$title       = $_POST["title"]      ?? "";
$description = $_POST["description"] ?? "";
$due_date    = $_POST["due_date"]   ?? "";
$priority    = $_POST["priority"]   ?? "";
$category    = $_POST["category"]   ?? "";

// Validate
if ($title === "" || $due_date === "") {
    echo json_encode([
        "status" => "error",
        "message" => "Title & Due Date are required"
    ]);
    exit;
}

// Insert task
$stmt = $pdo->prepare("
    INSERT INTO tasks (title, description, due_date, priority, category, status)
    VALUES (?, ?, ?, ?, ?, 'pending')
");

$ok = $stmt->execute([
    $title,
    $description,
    $due_date,
    $priority,
    $category
]);

echo json_encode([
    "status" => $ok ? "success" : "error"
]);

