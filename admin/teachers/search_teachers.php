<?php
include '../connect.php';

$search = '%' . $_GET['search'] . '%';
$query = "SELECT t.user_id, CONCAT(t.firstname, ' ', t.middlename, ' ', t.lastname) AS name, d.address, t.email
          FROM users t
          JOIN teacher_details d ON t.user_id = d.teacherdet_id
          WHERE CONCAT(t.firstname, ' ', t.middlename, ' ', t.lastname) LIKE ?";

if ($stmt = $connection->prepare($query)) {
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
    $teachers = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($teachers);
    $stmt->close();
} else {
    echo json_encode(array());
}

$connection->close();
?>
