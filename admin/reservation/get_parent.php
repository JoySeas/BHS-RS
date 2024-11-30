<?php
include '../connect.php';
if (isset($_GET['id'])) {
    $parent_id = intval($_GET['id']); // This should match the parameter in your JavaScript AJAX request

    $query = "
        SELECT ts.parent_id, CONCAT(ts.firstname, ' ', ts.middlename, ' ', ts.lastname) AS name, sd.address, sd.mobile_number, ts.email, ts.profile_image
        FROM parents ts
        JOIN parent_details sd ON ts.parent_id = sd.parentdet_id
        WHERE ts.parent_id = ?
    ";

    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param("i", $parent_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $parent = $result->fetch_assoc();
            header('Content-Type: application/json');
            echo json_encode($parent);
        } else {
            echo json_encode(array('error' => 'No data found'));
        }

        $stmt->close();
    } else {
        echo json_encode(array('error' => 'Query preparation failed'));
    }
} else {
    echo json_encode(array('error' => 'No id provided'));
}

// Close the database connection
$connection->close();
?>
