<?php
include("connect.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form'])) {
    switch ($_POST['form']) {
        case 'registeruseraccount':
            // Hash the password for security
            $password = $_POST['password'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Generate a unique user_id
            $user_id = generateID($connection, 'user_id', 'users', 'admin');
            
            // Prepare the INSERT statement for the users table
            $registeruser = mysqli_query($connection, "INSERT INTO users SET 
                user_id = '" . mysqli_real_escape_string($connection, $user_id) . "', 
                firstname = '" . mysqli_real_escape_string($connection, $_POST['firstName']) . "', 
                middlename = '" . mysqli_real_escape_string($connection, $_POST['middleName']) . "', 
                lastname = '" . mysqli_real_escape_string($connection, $_POST['lastName']) . "', 
                username = '" . mysqli_real_escape_string($connection, $_POST['username']) . "', 
                email = '" . mysqli_real_escape_string($connection, $_POST['email']) . "', 
                password = '" . $hashed_password . "', 
                usertype = 'ADMIN',  
                status = 'APPROVED',  
                date_added = '" . date("Y-m-d") . "', 
                code = '" . md5(uniqid(rand(), true)) . "', 
                image_path = 'profile2.png',  
                profile_image = '../uploads/profile2.png'");
            
            // Check if the insertion was successful
            if ($registeruser) {
                echo "Registration successful!";
            } else {
                // Output MySQL error for debugging
                echo "Error: Failed to register. " . mysqli_error($connection);
            }
            break;
    }
} else {
    echo "Invalid request.";
}
?>
