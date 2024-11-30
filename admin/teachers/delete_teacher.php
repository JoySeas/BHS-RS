<?php
include '../connect.php';

// Check if the user_id is provided in the query string
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id']; // No need to convert to integer

    // Begin a transaction
    $connection->begin_transaction();

    try {
        // Step 1: Get the classrooms associated with the teacher
        $queryClassrooms = "SELECT classroom_id FROM teachers_classroom WHERE teacher_id = ?";
        if ($stmtClassrooms = $connection->prepare($queryClassrooms)) {
            $stmtClassrooms->bind_param("s", $user_id); // Use "s" for varchar
            $stmtClassrooms->execute();
            $resultClassrooms = $stmtClassrooms->get_result();
            
            $classroomIds = [];
            while ($row = $resultClassrooms->fetch_assoc()) {
                $classroomIds[] = $row['classroom_id'];
            }
            $stmtClassrooms->close();
        } else {
            throw new Exception("Failed to prepare statement for fetching classrooms.");
        }

        // Step 2: Delete subjects associated with the classrooms
        if (!empty($classroomIds)) {
            $classroomIdList = implode(',', array_map(function($id) use ($connection) {
                return "'" . $connection->real_escape_string($id) . "'";
            }, $classroomIds)); // Create a comma-separated list of classroom IDs with proper escaping
            $queryDeleteSubjects = "DELETE FROM subjects WHERE classroom_id IN ($classroomIdList)";
            if (!$connection->query($queryDeleteSubjects)) {
                throw new Exception("Failed to delete subjects for the classrooms.");
            }
        }

        // Step 3: Delete the classrooms associated with the teacher
        $queryDeleteClassrooms = "DELETE FROM teachers_classroom WHERE teacher_id = ?";
        if ($stmtDeleteClassrooms = $connection->prepare($queryDeleteClassrooms)) {
            $stmtDeleteClassrooms->bind_param("s", $user_id); // Use "s" for varchar
            $stmtDeleteClassrooms->execute();
            $stmtDeleteClassrooms->close();
        } else {
            throw new Exception("Failed to prepare statement for deleting classrooms.");
        }

        // Step 4: Delete from teacher_details table
        $query1 = "DELETE FROM teacher_details WHERE teacherdet_id = ?";
        if ($stmt1 = $connection->prepare($query1)) {
            $stmt1->bind_param("s", $user_id); // Use "s" for varchar
            $stmt1->execute();
            $stmt1->close();
        } else {
            throw new Exception("Failed to prepare statement for teacher_details.");
        }

        // Step 5: Delete from users table
        $query2 = "DELETE FROM users WHERE user_id = ?";
        if ($stmt2 = $connection->prepare($query2)) {
            $stmt2->bind_param("s", $user_id); // Use "s" for varchar
            $stmt2->execute();
            $stmt2->close();
        } else {
            throw new Exception("Failed to prepare statement for users.");
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
    // No user_id provided
    echo json_encode(array('error' => 'No user_id provided'));
}
?>
