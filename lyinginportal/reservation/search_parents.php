<?php
include '../connect.php';

$search = '%' . $_GET['search'] . '%';
$query = "SELECT t.parent_id, CONCAT(t.firstname, ' ', t.middlename, ' ', t.lastname) AS name, d.address, t.email
          FROM parents t
          JOIN parent_details d ON t.parent_id = d.parentdet_id
          WHERE CONCAT(t.firstname, ' ', t.middlename, ' ', t.lastname) LIKE ?";

if ($stmt = $connection->prepare($query)) {
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
    $parents = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($parents);
    $stmt->close();
} else {
    echo json_encode(array());
}

$connection->close();
?>
