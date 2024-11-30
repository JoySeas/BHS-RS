<?php
include '../connect.php';

$query = "SELECT COUNT(*) AS total FROM users WHERE usertype = 'TEACHER'";
$result = $connection->query($query);

if ($result) {
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode(array('total' => 0));
}

$connection->close();
?>
