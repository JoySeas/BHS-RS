<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="20x20" href="assets/images/BHSRS-LOGO.png">
    <title>BHS Reservation System</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            background-color: #f3f7ff;
        }

        #features {
            text-align: center;
        }

        h1 {
            font-weight: 900;
            font-size: 2rem;
            color: #2C4E80;
        }
        .card {
        display: flex;
        flex-direction: column; /* Arrange the content vertically */
        justify-content: space-between; /* Ensure consistent spacing */
        height: 100%; /* Equal height for all cards */
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Evenly space the title and other elements */
        height: 100%; /* Take the available space */
    }

    .card-title {
        min-height: 60px; /* Set a fixed height for the title area */
        display: flex;
        align-items: center; /* Center text vertically */
        justify-content: center; /* Center text horizontally */
        text-align: center; /* Align the title text */
        margin: 0; /* Remove any extra margin */
    }

    .card img {
        width: 100%; /* Maintain full width */
        height: 250px; /* Set a consistent height for images */
        object-fit: cover; /* Ensure the image fills its space */
    }

        @media (min-width: 768px) {
            h1 {
                font-size: 3rem;
            }
        }

       

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        
        

        .card-body h5 {
            font-size: 1.2rem;
            font-weight: bold;
            color: #2C4E80;
            text-align: center;
            margin-top: 10px;
        }

        .card a {
            text-decoration: none !important; /* Removes underline from links */
            color: inherit;                  /* Ensures the original text color */
            display: block;                  /* Makes the entire card clickable */
        }

        .card-title {
            text-decoration: none; /* Explicitly remove underline */
        }

        @media (min-width: 576px) {
            .card img {
                height: 250px;
            }

            .card-body h5 {
                font-size: 1.5rem;
            }
        }
        .row-cols-1.row-cols-sm-2 {
        justify-content: center; /* Center the cards if there are only two columns */
    }
    </style>
</head>
<body>
<section id="features">
    <div class="container">
        <img src="assets/images/bhsrs_LOGO.svg" alt="" style="margin-bottom:-80px; margin-top:-100px;">
        <div class="row row-cols-1 row-cols-sm-2 g-4 justify-content-center">
            <!-- Student Card -->
            <div class="col-md-6"> <!-- Adjust column width for 2 columns -->
                <a href="lyinginportal/login.php" style="text-decoration: none;">
                    <div class="card">
                        <img src="assets/images/maternity.svg" class="card-img-top" alt="Student Login">
                        <div class="card-body">
                            <h5 class="card-title">Southern Maternity Lying in Clinic Portal</h5>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Parent Card -->
            <div class="col-md-6"> <!-- Adjust column width for 2 columns -->
                <a href="admin/login.php" style="text-decoration: none;">
                    <div class="card">
                        <img src="assets/images/BHS.svg" class="card-img-top" alt="Parent Login">
                        <div class="card-body">
                            <h5 class="card-title">Banquerohan Health Station Portal</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
