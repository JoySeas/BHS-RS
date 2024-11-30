<?php
include '../connect.php';
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']); // This should match the parameter in your JavaScript AJAX request

    $query = "
        SELECT t.user_id, CONCAT(t.firstname, ' ', t.middlename, ' ', t.lastname) AS name, d.address, d.mobile_number, t.email, t.profile_image
        FROM users t
        JOIN teacher_details d ON t.user_id = d.teacherdet_id
        WHERE t.user_id = ?
    ";

    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $teacher = $result->fetch_assoc();
            header('Content-Type: application/json');
            echo json_encode($teacher);
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
