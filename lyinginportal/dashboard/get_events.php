<?php
require '../connect.php'; // Include your database connection

header('Content-Type: application/json');

$sql = "SELECT id, title, start_date AS start, content FROM events";
$result = mysqli_query($connection, $sql);

$events = [];

while ($row = mysqli_fetch_assoc($result)) {
    $events[] = $row;
}

echo json_encode($events);

mysqli_close($connection);
?>
