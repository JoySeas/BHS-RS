<?php
include '../connect.php';

$search = '%' . $_GET['search'] . '%';
$query = "SELECT t.stud_id, t.student_no, CONCAT(t.firstname, ' ', t.middlename, ' ', t.lastname) AS name, d.address, t.email
          FROM students t
          JOIN student_details d ON t.stud_id = d.studentdet_id
          WHERE CONCAT(t.firstname, ' ', t.middlename, ' ', t.lastname) LIKE ?";

if ($stmt = $connection->prepare($query)) {
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
    $students = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($students);
    $stmt->close();
} else {
    echo json_encode(array());
}

$connection->close();
?>
