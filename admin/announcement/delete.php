<?php
// Include your database connection file
include '../connect.php';

// Check if the ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare the delete SQL query
    $sql = "DELETE FROM announcements WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    // Execute the query
    if ($stmt->execute()) {
        echo 'success'; // Deletion successful
    } else {
        echo 'error'; // Deletion failed
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
} else {
    // Invalid request
    header('HTTP/1.1 400 Bad Request');
    echo 'Invalid request';
}
?>
