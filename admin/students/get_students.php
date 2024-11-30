<?php
include '../connect.php';

// Fetch student data from the database
$query = "
    SELECT ts.stud_id, ts.student_no, ts.firstname, ts.middlename, ts.lastname, sd.address, ts.email
    FROM students ts
    JOIN student_details sd ON ts.stud_id = sd.studentdet_id";

$result = mysqli_query($connection, $query);

// Check if the query was successful
if (!$result) {
    die("Query Failed: " . mysqli_error($connection));
}

// Create an array to hold the student data
$student = array();

while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'];
    $student[] = array(
        'stud_id' => $row['stud_id'],
        'student_no' => $row['student_no'],
        'name' => $name,
        'address' => $row['address'],
        'email' => $row['email']
    );
}

// Debugging: Print the JSON output
header('Content-Type: application/json');
echo json_encode($student);
?>
