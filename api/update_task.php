<?php
require "../db.php";

$data = json_decode(file_get_contents("php://input"), true);

$id          = $data["id"] ?? null;
$title       = $data["title"] ?? "";
$description = $data["description"] ?? "";
$due_date    = $data["due_date"] ?? "";
$priority    = $data["priority"] ?? "medium";
$category    = $data["category"] ?? "General";

if (!$id || !$title || !$due_date) {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
    exit;
}

$stmt = $pdo->prepare("
    UPDATE tasks 
    SET title=?, description=?, due_date=?, priority=?, category=?
    WHERE id=?ok
");

$stmt->execute([$title, $description, $due_date, $priority, $category, $id]);

echo json_encode(["status" => "success", "message" => "Task updated"]);
?>
