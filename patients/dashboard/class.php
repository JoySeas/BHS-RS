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
$title = isset($_POST['eventTitle']) ? $_POST['eventTitle'] : '';
$start_date = isset($_POST['eventDate']) ? $_POST['eventDate'] : '';
$content = isset($_POST['eventContent']) ? $_POST['eventContent'] : '';
$event_id = isset($_POST['id']) ? $_POST['id'] : ''; // For update operation
$action = isset($_POST['formAction']) ? $_POST['formAction'] : ''; // To distinguish add/update

if (empty($title) || empty($start_date)) {
    echo json_encode(['status' => 'error', 'message' => 'Title and Date are required.']);
    exit;
}

// Check if the action is 'update' or 'add'
if ($action === 'update' && !empty($event_id)) {
    // Update event in the database
    $sql = "UPDATE events SET title = ?, start_date = ?, content = ? WHERE id = ? AND admin_id = ?";
    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssi', $title, $start_date, $content, $event_id, $admin_id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Event updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update event: ' . mysqli_stmt_error($stmt)]);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare SQL statement.']);
    }
} elseif ($action === 'add') {
    // Insert new event into the database
    $sql = "INSERT INTO events (admin_id, title, start_date, content) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssss', $admin_id, $title, $start_date, $content);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Event added successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add event: ' . mysqli_stmt_error($stmt)]);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare SQL statement.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
}

mysqli_close($connection);
?>
