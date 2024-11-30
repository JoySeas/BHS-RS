<?php
include '../connect.php';

// Check if the stud_id is provided in the query string
if (isset($_GET['stud_id'])) {
    $stud_id = intval($_GET['stud_id']); // Convert to integer to prevent SQL injection

    // Begin a transaction
    $connection->begin_transaction();

    try {
        // Delete from student_details table
        $query1 = "DELETE FROM student_details WHERE studentdet_id = ?";
        if ($stmt1 = $connection->prepare($query1)) {
            $stmt1->bind_param("i", $stud_id);
            $stmt1->execute();
            $stmt1->close();
        } else {
            throw new Exception("Failed to prepare statement for student_details.");
        }

        // Delete from students table
        $query2 = "DELETE FROM students WHERE stud_id = ?";
        if ($stmt2 = $connection->prepare($query2)) {
            $stmt2->bind_param("i", $stud_id);
            $stmt2->execute();
            $stmt2->close();
        } else {
            throw new Exception("Failed to prepare statement for students.");
        }

        // Commit the transaction
        $connection->commit();
        echo json_encode(array('success' => true));
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        $connection->rollback();
        echo json_encode(array('error' => $e->getMessage()));
    }

    // Close the database connection
    $connection->close();
} else {
    // No stud_id provided
    echo json_encode(array('error' => 'No Student ID provided'));
}
?>
