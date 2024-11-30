<?php
include '../connect.php';
if (isset($_GET['id'])) {
    $stud_id = intval($_GET['id']); // This should match the parameter in your JavaScript AJAX request

    $query = "
        SELECT ts.stud_id, ts.student_no, CONCAT(ts.firstname, ' ', ts.middlename, ' ', ts.lastname) AS name, sd.address, sd.mobile_number, ts.email, ts.profile_image
        FROM students ts
        JOIN student_details sd ON ts.stud_id = sd.studentdet_id
        WHERE ts.stud_id = ?
    ";

    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param("i", $stud_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
            header('Content-Type: application/json');
            echo json_encode($student);
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
