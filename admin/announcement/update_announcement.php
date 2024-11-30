<?php
// Include your database connection file
include '../connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $id = intval($_POST['announcement-id']);
    $title = $_POST['announcement-title'];
    $date = $_POST['announcement-date'];
    $time = $_POST['announcement-time'];
    $timeend = $_POST['announcement-timeend'];
    $place = $_POST['announcement-place'];
    $content = $_POST['announcement-content'];

    // Initialize variables
    $imagePath = null;

    // Check if a new image file is uploaded
    if (isset($_FILES['announcement-image']) && $_FILES['announcement-image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../admin/uploads/';
        $imageName = basename($_FILES['announcement-image']['name']);
        $imagePath = $uploadDir . $imageName;

        // Ensure the directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move the uploaded file
        if (!move_uploaded_file($_FILES['announcement-image']['tmp_name'], $imagePath)) {
            echo 'error: Failed to upload image.';
            exit;
        }
    }

    // Build SQL query and parameters
    if ($imagePath) {
        // Update query with new image
        $sql = "UPDATE announcements SET title = ?, date = ?, time = ?, timeend = ?, place = ?, content = ?, image_path = ? WHERE id = ?";
        $params = [$title, $date, $time, $timeend, $place, $content, $imageName, $id];
        $types = "sssssssi";
    } else {
        // Update query without image
        $sql = "UPDATE announcements SET title = ?, date = ?, time = ?, timeend = ?, place = ?, content = ? WHERE id = ?";
        $params = [$title, $date, $time, $timeend, $place, $content, $id];
        $types = "ssssssi";
    }

    // Prepare and execute the SQL query
    if ($stmt = $connection->prepare($sql)) {
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            echo 'success'; // Update successful
        } else {
            echo 'error: ' . $stmt->error; // Include error for debugging
        }

        $stmt->close();
    } else {
        echo 'error: ' . $connection->error; // Include error for debugging
    }

    // Close the database connection
    $connection->close();
} else {
    // Invalid request method
    header('HTTP/1.1 405 Method Not Allowed');
    echo 'Invalid request method';
}
?>
