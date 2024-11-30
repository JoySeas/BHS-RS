<?php
include("../connect.php");

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data from database
$user_id = $_SESSION['user_id']; // Get user ID from session
$sql = "SELECT u.*, a.date_of_birth, a.place_of_birth, a.address, a.nationality, a.sex, a.mobile_number, a.personal_email
        FROM users u
        LEFT JOIN admin_details a ON u.user_id = a.admin_id
        WHERE u.user_id = '$user_id'";
$result = mysqli_query($connection, $sql);

// Check if query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

// Fetch user data
$row = mysqli_fetch_assoc($result);

// Check if user data was retrieved
if (!$row) {
    die("User not found.");
}

// Close connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="dashboard/dashboard.css" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }
    .banner-container {
        position: relative;
        width: 100%;
        height: auto;
        margin: -20px 0 50px;
    }
    .banner-container img {
        width: 100%;
        height: auto;
        display: block;
    }
    .overlay {
        position: absolute;
        top: 50%;
        left: 5%;
        transform: translateY(-50%);
        color: white;
        font-size: 30px;
        text-align: left;
    }
    .profile {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .profile img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 5px solid white;
        object-fit: cover;
    }
    .profile-info {
        display: flex;
        flex-direction: column;
    }
    .username {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size:smaller ;
    }
    .map-marker {
        margin-top: 5px;
        font-size: 20px; /* Adjust this value to make the map marker smaller */
    }
    @media (max-width: 768px) {
        .overlay {
            font-size: 24px;
        }
        .profile img {
            width: 80px;
            height: 80px;
        }
    }
    @media (max-width: 480px) {
        .overlay {
            font-size: 18px;
        }
        .profile img {
            width: 60px;
            height: 60px;
        }
        .infos ul {
        columns: 1;
        -webkit-columns: 1;
        -moz-columns: 1;
    }
    .infos li {
        display: block;
        margin-bottom: 10px;
    }
    
    }
    @media (max-width: 480px) {
    .infos ul {
        columns: 1;
        -webkit-columns: 1;
        -moz-columns: 1;
    }
    .infos li {
        display: block;
        margin-bottom: 10px;
    }
}
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        overflow-y: auto; /* Make modal scrollable if content overflows */
    }
    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        margin: 20px;
        max-width: 600px;
        max-height: 90vh; /* Limit height to 90% of the viewport height */
        overflow-y: auto; /* Make content scrollable if it overflows */
    }
    .close {
        cursor: pointer;
        float: right;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
    }
    .btn {
        background-color: #5D9EFE;
        color: white;
        margin-right: 10px;
    }
    .address {
        font-size: 18px; /* Adjust this value to make the address font smaller */
        }
</style>
</head>
<body>
    <div class="banner-container">
        <img src="assets/images/BHS-banner.png" alt="banner">
        <div class="overlay">
            <div class="profile">
                <img src="../admin/uploads/<?php echo basename($row['profile_image']); ?>" alt="">
                <div class="profile-info">
                    <div class="username">
                    <?php echo htmlspecialchars($row['firstname'] . ' ' . $row['middlename'] .' ' . $row['lastname']); ?> <i class="fas fa-edit" id="editBtn" style="font-size: 1rem;"></i>
                    </div>
                    <div class="address">
                        <i class="fas fa-map-marker-alt map-marker" style="color: #FFFFFF;"></i> <?php echo htmlspecialchars($row['address']); ?>
                    </div>  </div>
            </div>
        </div>
    </div>

 <!-- Personal Information Section -->
<div class="col-xs-12">
    <div class="card" style="margin-bottom: 15px;">
        <div class="box bg-info1" style="background: #FFFFFF; box-shadow: 2px 3px 5px rgb(126, 142, 159);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h5 style="color: #000000; font-size: 20px; margin: 0;">Personal Information</h5>
                <!-- <button type="button" class="btn" id="updateDetails">Update Details</button> -->
                <button class="btn" onclick="openUpdateDetailsModal()">Update Details</button>

            </div>
            <hr style="border: .5px solid #817F7F;">
            <div class="infos">
                <ul style="columns: 2; -webkit-columns: 2; -moz-columns: 2; list-style-type: none; padding-left: 20px; color: #000000;">
                    <li style="margin-bottom: 10px;"><i class="fas fa-calendar-alt" style="color: #5D9EFE;"></i> Date of Birth: <?php echo htmlspecialchars($row['date_of_birth']); ?></li>
                    <li style="margin-bottom: 10px;"><i class="fas fa-city" style="color: #5D9EFE;"></i> Place of Birth: <?php echo htmlspecialchars($row['place_of_birth']); ?></li>
                    <li style="margin-bottom: 10px;"><i class="fas fa-map-marker-alt" style="color: #5D9EFE;"></i> Address: <?php echo htmlspecialchars($row['address']); ?></li>
                    <li style="margin-bottom: 10px;"><i class="fas fa-flag" style="color: #5D9EFE;"></i> Nationality: <?php echo htmlspecialchars($row['nationality']); ?></li>
                    <li style="margin-bottom: 10px;"><i class="far fa-user" style="color: #5D9EFE;"></i> Sex: <?php echo htmlspecialchars($row['sex']); ?></li>
                    <li style="margin-bottom: 10px;"><i class="fas fa-mobile-alt" style="color: #5D9EFE;"></i> Mobile Number: <?php echo htmlspecialchars($row['mobile_number']); ?></li>
                    <li style="margin-bottom: 10px;"><i class="fas fa-envelope-open-text" style="color: #5D9EFE;"></i> Personal Email: <?php echo htmlspecialchars($row['personal_email']); ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

    <!-- Update Modal -->
    <div id="updateModal" style="display: none;">
        <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 999;">
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; width: 90%; max-width: 500px;">
                <h2 style="text-align: center;">Update Details</h2>
                <form id="updateForm" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="<?php echo htmlspecialchars($row['username']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="image">Profile Image:</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                        <button type="submit" class="btn" style="background-color: #5D9EFE; color: white; margin-right: 10px;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Details Modal -->
<div id="updateDetailsModal" style="display: none;">
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 999;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; width: 90%; max-width: 500px;  max-height: 90vh; overflow-y: auto;">
            <h2 style="text-align: center;">Update Details</h2>
            <form id="updateDetailsForm" method="POST">
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control">
                </div>
                <div class="form-group">
                    <label for="place_of_birth">Place of Birth:</label>
                    <input type="text" id="place_of_birth" name="place_of_birth" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nationality">Nationality:</label>
                    <input type="text" id="nationality" name="nationality" class="form-control">
                </div>
                <div class="form-group">
                    <label for="sex">Sex:</label>
                    <select id="sex" name="sex" class="form-control">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mobile_number">Mobile Number:</label>
                    <input type="text" id="mobile_number" name="mobile_number" class="form-control">
                </div>
                <div class="form-group">
                    <label for="personal_email">Personal Email:</label>
                    <input type="email" id="personal_email" name="personal_email" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancelDetailsBtn">Cancel</button>
                    <button type="submit" class="btn" style="background-color: #5D9EFE; color: white; margin-right: 10px;">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script>
       $(document).ready(function() {
    // Show the update modal
    $('#editBtn').click(function() {
        $('#updateModal').fadeIn();
    });

    // Hide the update modal
    $('#cancelBtn').click(function() {
        $('#updateModal').fadeOut();
    });

    // Show the update details modal
    $('#updateDetails').click(function() {
        $('#updateDetailsModal').fadeIn();
    });

    // Hide the update details modal
    $('#cancelDetailsBtn').click(function() {
        $('#updateDetailsModal').fadeOut();
    });

    // Handle profile update form submission
    $('#updateForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        $.ajax({
            url: 'user/update_profile.php',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Profile updated successfully.',
                    icon: 'success'
                });
                $('#updateModal').fadeOut();
                location.reload();
            },
            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while updating profile.',
                    icon: 'error'
                });
            }
        });
    });

    // Handle details update form submission
    $('#updateDetailsForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        $.ajax({
            url: 'user/update_details.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Details updated successfully.',
                    icon: 'success'
                });
                $('#updateDetailsModal').fadeOut();
                location.reload();
            },
            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while updating details.',
                    icon: 'error'
                });
            }
        });
    });
});
 // Open modal and load data via AJAX
 function openUpdateDetailsModal() {
        // Show the modal
        document.getElementById("updateDetailsModal").style.display = "block";

        // AJAX request to fetch current user details
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "user/fetch_user_details.php", true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Parse the returned JSON data
                var data = JSON.parse(xhr.responseText);

                // Fill the form fields with data
                if (data.status === 'success') {
                    document.getElementById('date_of_birth').value = data.details.date_of_birth || '';
                    document.getElementById('place_of_birth').value = data.details.place_of_birth || '';
                    document.getElementById('address').value = data.details.address || '';
                    document.getElementById('nationality').value = data.details.nationality || '';
                    document.getElementById('sex').value = data.details.sex || '';
                    document.getElementById('mobile_number').value = data.details.mobile_number || '';
                    document.getElementById('personal_email').value = data.details.personal_email || '';
                }
            }
        };
        xhr.send();
    }

    // Close modal function
    document.getElementById('cancelDetailsBtn').addEventListener('click', function () {
        document.getElementById('updateDetailsModal').style.display = 'none';
    });

    </script>
</body>
</html>
