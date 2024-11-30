<?php
include("connection.php");


// Check if user is logged in (you should implement your own authentication logic)
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Get username from session
$username = $_SESSION['username'];

// Query to get the latest three announcements
$query = "SELECT id, title, date, content FROM announcements ORDER BY created_at DESC LIMIT 3";
$result = $conn->query($query);


?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="dashboard/dashboard.css" />
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>

<link rel="stylesheet" type="text/css" href="dashboard/dashboard.css" />

<style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }
    /* .row {
        margin-top: -20px;
        margin-bottom: 50px;
        position: relative;
    } */
    
   
    .card-title{
        text-align: center;
        font-weight: 800;
        font-size: 1.5rem;
        margin-top: 10px;
    }




</style>
</head>
<body>
<div class="container mt-5">
    
    <div class="row justify-content-center">
        <!-- First Card in the First Row -->
        <div class="col-md-4 mb-4">
        <a href="index.php?url=prenatal" class="card-link" style="text-decoration: none; color: inherit;">
            <div class="card">
                <img src="./assets/images/prenatal.svg" class="card-img-top" alt="Card Image" style="border-radius: 5px; box-shadow: 2px 3px 5px rgb(126, 142, 159);">
                <div class="card-body" style="padding-top: .5rem; padding-bottom: .5rem; border-radius: 5px; box-shadow: 2px 3px 5px rgb(126, 142, 159);">
                    <h5 class="card-title">PRENATAL</h5>
                </div>
            </div>
        </a>
        </div>

        <!-- Second Card in the First Row -->
        <div class="col-md-4 mb-4">
        <a href="index.php?url=immunization" class="card-link" style="text-decoration: none; color: inherit;">
            <div class="card">
                <img src="./assets/images/immunization.svg" class="card-img-top" alt="Card Image" style="border-radius: 5px; box-shadow: 2px 3px 5px rgb(126, 142, 159);">
                <div class="card-body" style="padding-top: .5rem; padding-bottom: .5rem; border-radius: 5px; box-shadow: 2px 3px 5px rgb(126, 142, 159);">
                    <h5 class="card-title">IMMUNIZATION</h5>
                    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                </div>
            </div>
        </a>
        </div>
    </div>

    <div class="row">
        <!-- Single Card in the Second Row -->
        <div class="col-md-4 mx-auto">
        <a href="index.php?url=otherservices" class="card-link" style="text-decoration: none; color: inherit;">
            <div class="card">
                <img src="./assets/images/other.svg" class="card-img-top" alt="Card Image" style="border-radius: 5px; box-shadow: 2px 3px 5px rgb(126, 142, 159);">
                <div class="card-body" style="padding-top: .5rem; padding-bottom: .5rem; border-radius: 5px; box-shadow: 2px 3px 5px rgb(126, 142, 159);">
                    <h5 class="card-title">OTHER SERVICES</h5>
                    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                </div>
            </div>
        </a>
        </div>
    </div>
</div>

</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
