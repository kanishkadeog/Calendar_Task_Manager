<?php
require "../db.php";

$data = json_decode(file_get_contents("php://input"), true);
$id = $data["id"] ?? null;

if (!$id) {
    echo json_encode(["status" => "error", "message" => "Task ID missing"]);
    exit;
}

$stmt = $pdo->prepare("SELECT status FROM tasks WHERE id = ?");
$stmt->execute([$id]);
$current = $stmt->fetchColumn();

$newStatus = ($current === "completed") ? "pending" : "completed";

$update = $pdo->prepare("UPDATE tasks SET status=? WHERE id=?");
$update->execute([$newStatus, $id]);

echo json_encode([
    "status" => "success",
    "new_status" => $newStatus
]);
?>
