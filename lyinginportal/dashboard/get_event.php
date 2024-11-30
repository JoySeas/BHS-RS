<?php
require '../connect.php'; // Include your database connection

header('Content-Type: application/json');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid event ID.']);
    exit;
}

$sql = "SELECT id, title, start_date, content FROM events WHERE id = ?";
$stmt = mysqli_prepare($connection, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $event_id, $title, $start_date, $content);
    mysqli_stmt_fetch($stmt);
    
    if ($event_id) {
        echo json_encode(['status' => 'success', 'event' => [
            'id' => $event_id,
            'title' => $title,
            'start_date' => $start_date,
            'content' => $content
        ]]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Event not found.']);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare SQL statement.']);
}

mysqli_close($connection);
?>
