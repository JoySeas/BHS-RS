<?php
include("connection.php"); // Adjust path as necessary

session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Query to count total users for each category
$query = "SELECT
            (SELECT COUNT(*) FROM teachers) AS total_teachers,
            (SELECT COUNT(*) FROM students) AS total_students,
            (SELECT COUNT(*) FROM parents) AS total_parents";

$result = mysqli_query($conn, $query);

// Check for query errors
if (!$result) {
    echo json_encode(['error' => 'Query failed: ' . mysqli_error($conn)]);
    exit();
}

$data = mysqli_fetch_assoc($result);

// Check if data is fetched
if ($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'No data found']);
}
?>
