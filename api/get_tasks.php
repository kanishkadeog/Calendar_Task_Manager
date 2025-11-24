<?php
require "../config.php";

header("Content-Type: application/json");

// Debugging (optional)
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // If date is provided
    if (isset($_GET['date'])) {
        $date = $_GET['date'];

        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE due_date = ?");
        $stmt->execute([$date]);
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($tasks);
        exit;
    }

    // Filters
    if (isset($_GET['filter'])) {
        $query = "SELECT * FROM tasks WHERE 1=1";
        $params = [];

        if (!empty($_GET["category"])) {
            $query .= " AND category = ?";
            $params[] = $_GET["category"];
        }
        if (!empty($_GET["priority"])) {
            $query .= " AND priority = ?";
            $params[] = $_GET["priority"];
        }
        if (!empty($_GET["status"])) {
            $query .= " AND status = ?";
            $params[] = $_GET["status"];
        }
        if (!empty($_GET["search"])) {
            $query .= " AND title LIKE ?";
            $params[] = "%" . $_GET["search"] . "%";
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($tasks);
        exit;
    }

    // Default → return empty JSON
    echo json_encode([]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>
