<?php
// Include your database connection file
include '../connect.php';

// Check if an ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare the SQL query to fetch the announcement
    $sql = "SELECT * FROM announcements WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the announcement data
        $announcement = $result->fetch_assoc();

        // Output the data as JSON
        header('Content-Type: application/json');
        echo json_encode($announcement);
    } else {
        // No announcement found
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'Announcement not found']);
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
} else {
    // No ID provided
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'No ID provided']);
}
?>
