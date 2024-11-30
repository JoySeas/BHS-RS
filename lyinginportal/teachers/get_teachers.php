<?php
include '../connect.php';

// Fetch teacher data from the database
$query = "
    SELECT t.user_id, t.firstname, t.middlename, t.lastname, d.address, d.mobile_number as contact, t.email
    FROM users t
    JOIN teacher_details d ON t.user_id = d.teacherdet_id";

$result = mysqli_query($connection, $query);

// Check if the query was successful
if (!$result) {
    die("Query Failed: " . mysqli_error($connection));
}

// Create an array to hold the teacher data
$teachers = array();

while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'];
    $teachers[] = array(
        'user_id' => $row['user_id'],
        'name' => $name,
        'address' => $row['address'],
        'email' => $row['email']
    );
}

// Debugging: Print the JSON output
header('Content-Type: application/json');
echo json_encode($teachers);
?>
