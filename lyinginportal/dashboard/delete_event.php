<?php
session_start();
require '../connect.php'; // Include your database connection

header('Content-Type: application/json');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

$admin_id = $_SESSION['user_id']; // Get the logged-in user's ID from session
$event_id = isset($_POST['id']) ? $_POST['id'] : ''; // For delete operation

if (empty($event_id)) {
    echo json_encode(['status' => 'error', 'message' => 'Event ID is required.']);
    exit;
}

// Delete event from the database
$sql = "DELETE FROM events WHERE id = ? AND admin_id = ?";
$stmt = mysqli_prepare($connection, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ii', $event_id, $admin_id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Event deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete event: ' . mysqli_stmt_error($stmt)]);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare SQL statement.']);
}

mysqli_close($connection);
?>
