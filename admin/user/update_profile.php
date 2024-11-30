<?php
include("../connect.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Default variables
$imagePath = ''; 
$username = '';

// Handle file upload
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName = $_FILES['image']['name'];
    $fileSize = $_FILES['image']['size'];
    $fileType = $_FILES['image']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $maxFileSize = 5 * 1024 * 1024; // 5MB

    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
        $uploadFileDir = '../uploads/';
        $dest_path = $uploadFileDir . uniqid() . '.' . $fileExtension;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $imagePath = $dest_path;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to move uploaded file.']);
            exit();
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid file type or size.']);
        exit();
    }
} 

// Verify database connection
if (!$connection) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
    exit();
}

// Fetch the current username if not provided in the request
if (empty($_POST['username'])) {
    $sql = "SELECT username FROM users WHERE user_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->fetch();
    $stmt->close();
} else {
    $username = $_POST['username'];
}

// Update user details, handling the cases where only one or both fields are updated
if ($imagePath) {
    $sql = "UPDATE users SET profile_image = ? WHERE user_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('si', $imagePath, $user_id);
} else {
    $sql = "UPDATE users SET username = ? WHERE user_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('si', $username, $user_id);
}

if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare SQL statement.']);
    exit();
}

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update profile: ' . $stmt->error]);
}

$stmt->close();
$connection->close();
?>
