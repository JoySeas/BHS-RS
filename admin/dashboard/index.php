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
    .row {
        margin-top: -20px;
        margin-bottom: 50px;
        position: relative;
    }
    .row img {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        margin-top: -20px;
    }
    .welcome-message {
        position: absolute;
        top: 50%;
        left: 5%;
        transform: translateY(-50%);
        color: white;
        font-size: 30px;
        font-family: 'Poppins', sans-serif;
        text-align: left;
    }
    .welcome-message span {
        font-size: 18px;
    }
    .title{
        font-size: 20px;
    }
    @media (max-width: 768px) {
        .welcome-message {
            font-size: 24px;
            left: 5%;
        }
        .welcome-message span {
            font-size: 16px;
        }
    }
    @media (max-width: 480px) {
        .welcome-message {
            font-size: 15px;
            left: 5%;
        }
        .title{
            font-size: 25px;
        }
        .welcome-message span {
            font-size: 14px;
        }
    }
    .card-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-head .title {
            color: #000000;
            margin-bottom: 15px;
        }
        .card-head .view-users-btn {
            background-color: #5598FB;
            color: #FFFFFF;
            border: none;
            padding: 5px 10px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 12px;
        }
    .box-content {
    position: relative; /* Ensure the box is positioned relative to allow absolute positioning of the button */
    box-shadow: 2px 3px 5px rgb(126, 142, 159);
    background-color: #679DFF;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 25px;
}
.read-btn {
    position: absolute;
    top: 50%;
    right: 15px; /* Adjust as needed */
    transform: translateY(-50%);
    background-color: #F0EDFF;
    color: #000;
    border: none;
    padding: 5px 10px;
    border-radius: 15px;
    text-decoration: none;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.read-btn:hover {
    background-color: #fff; /* Darker shade on hover */
}
.box-event {
    position: relative;
    box-shadow: inset 0 0 0 0.5px #BAB9B9, 2px 3px 5px #BAB9B9; /* Inner stroke and outer shadow */
    background-color: #FFFFFF;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 5px;
    display: flex;
    align-items: center;
}


.event-btn {
    background-color: #679DFF;
    color: #FFFFFF;
    border: none;
    padding: 5px 10px;
    border-radius: 15px;
    text-decoration: none;
    font-size: 14px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.event-details {
    margin-left: 15px; /* Adds space between the event button and the details */
    color: #000;
}

</style>
</head>
<body>
    <div class="row">
        <img src="assets/images/BHS-banner.png" alt="banner">
        <div class="welcome-message">
            Welcome back, <?php echo htmlspecialchars($username); ?>!<br>
            
        </div>
    </div>



<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-xs-12 col-md-6">
              
                    <div class="card" style="margin-bottom: 15px;">
                            <div class="box bg-info" style="background: #FFFFFF;  box-shadow: inset 0 0 0 0.5px #BAB9B9, 2px 3px 5px rgb(126, 142, 159);">
                            <div class="card-head">
                                <h5 class="font-light title" style="color: #4C644B;">Total Users</h5>
                                <button class="view-users-btn" onclick="window.location.href='index.php?url=teachers';">View Users</button>
                            </div>    
                                <div class="row" style="margin-top: 5px; margin-bottom: 55px;  ">
                                    <canvas id="doughnutChart"></canvas>
                                </div>
                        </div>
                    </div>
          
            </div>
<div class="col-xs-12 col-md-6">
        <div class="card" style="margin-bottom: 15px;">
            <div class="box bg-info" style="box-shadow: inset 0 0 0 0.5px #BAB9B9, 2px 3px 5px rgb(126, 142, 159);">
                <div class="card-head" style="margin-bottom: 10px;">
                    <h5 class="font-light title" style="color: #4C644B;">Announcements</h5>
                    <button class="view-users-btn" onclick="window.location.href='index.php?url=announcement';">View More</button>
                </div>
                <?php while($row = $result->fetch_assoc()): ?>
                <div class="box-content">
                    <h5 class="details" style="color: #fff;"><?= htmlspecialchars($row['title']) ?></h5>
                    <h6 class="posted" style="color: #fff;">Posted by: Admin</h6>
                    <h6 class="date" style="color: #fff; font-size: 10px"><?= date('F j, Y', strtotime($row['date'])) ?></h6>
                    <!-- <a href="#" class="read-btn">Read</a> -->
                    <a href="./index.php?url=announcementdetails&id=<?php echo $row['id']; ?>" class="read-btn">Read</a>
                   
                </div>
                <?php endwhile; ?>
            </div>
        </div>
</div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
        // Static data for the doughnut chart
        var ctx = document.getElementById('doughnutChart').getContext('2d');
        var doughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Doctor', 'BHW', 'Nurse', 'Midwife'], // Labels for the slices
                datasets: [{
                    label: 'User Distribution',
                    data: [25, 30, 25, 20], // Data for each slice
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)', // Color for Doctor
                        'rgba(255, 99, 132, 0.6)', // Color for BHW
                        'rgba(255, 159, 64, 0.6)', // Color for Nurse
                        'rgba(75, 192, 192, 0.6)'  // Color for Midwife
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        formatter: (value) => value + '%', // Add percentage on each slice
                        color: '#fff', // Text color inside the chart
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>
