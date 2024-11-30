<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("../connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = array();
    $title = mysqli_real_escape_string($connection, $_POST['announcement-title']);
    $date = mysqli_real_escape_string($connection, $_POST['announcement-date']);
    $time = mysqli_real_escape_string($connection, $_POST['announcement-time']);
    $timeend = mysqli_real_escape_string($connection, $_POST['announcement-timeend']);
    $place = mysqli_real_escape_string($connection, $_POST['announcement-place']);
    $content = mysqli_real_escape_string($connection, $_POST['announcement-content']);

    $imagePath = "";
    if (isset($_FILES['announcement-image']) && $_FILES['announcement-image']['error'] == 0) {
        $targetDirectory = "../uploads/";
        $imagePath = $targetDirectory . basename($_FILES["announcement-image"]["name"]);
        $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["announcement-image"]["tmp_name"]);
        if ($check === false) {
            $response['error'] = "File is not an image.";
            echo json_encode($response);
            exit();
        }

        if ($_FILES["announcement-image"]["size"] > 5000000) {
            $response['error'] = "Sorry, your file is too large.";
            echo json_encode($response);
            exit();
        }

        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            $response['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            echo json_encode($response);
            exit();
        }

        if (move_uploaded_file($_FILES["announcement-image"]["tmp_name"], $imagePath)) {
            // File uploaded successfully
        } else {
            $response['error'] = "Sorry, there was an error uploading your file.";
            echo json_encode($response);
            exit();
        }
    }

    $sql = "INSERT INTO announcements (title, date, time, timeend, place, content, image_path) VALUES ('$title', '$date', '$time', '$timeend', '$place', '$content', '$imagePath')";
    if (mysqli_query($connection, $sql)) {
        $response['success'] = true;
    } else {
        $response['error'] = "Error: " . $sql . "<br>" . mysqli_error($connection);
    }

    mysqli_close($connection);
    echo json_encode($response);
}
?>
