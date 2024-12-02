<?php
include("../connect.php");
session_start();

// Check if user is logged in (you should implement your own authentication logic)
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Get username from session
$username = $_SESSION['username'];
?>
<!-----header for admin ----->

<style>
.mailbox .slimScrollDiv {
    height: 200px !important;
}
.username-text {
        text-decoration: none;
    }
/* Responsive styles */
@media screen and (max-width: 768px) {
    .username-text {
        display: none; /* Hides the username on smaller screens */
    }
}
</style>
<header class="topbar" style="border-bottom: 1px solid #dcdcdc;">
    <nav class="navbar top-navbar navbar-expand-md navbar-light" style="background-color: #FFFFFF;">

        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto mt-md-0 ">
                <!-- This is  -->
                <li class="nav-item kailangan" style="display:none;">
                    <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
                        href="javascript:void(0)">
                        <i class="ti-menu"></i>
                    </a>
                </li>

                <li class="nav-item dropdown kailangan2" style="padding-left:1px;">
                    <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark"
                        aria-haspopup="true" aria-expanded="false">
                        <h5 class="text-white" style="margin-bottom:0px;"><img
                                src="assets/images/bhs-logo.svg" alt="logo"
                                class="dark-logo imagetopbar" style="width: 220px;" /></h5>
                    </a>
                </li>
            </ul>

            <style>
            /*Responsive css*/
            @media screen and (max-width: 768px) {

                .textdashboardbread2 {
                    display: none;
                }
                .dark-logo{
                    width: 300px;
                }
            }
            </style>

            <div class="col-md-6 align-self-center clock">
                <h4 class="mb-0 mt-0 float-right textdashboardbread textdashboardbread2"
                    style="font-weight: 400; color: #5f5f5f;"><span class="textdashboardbread" id="txtdatex"></span>
                </h4>
            </div>
            
                    <a href="index.php?url=user"><i><img src="assets/images/user.png" alt=""
                    style="width: 30px"></i>
                        <span class="username-text">&nbsp;&nbsp;<?php echo htmlspecialchars($username); ?></span>
                    </a>
        </div>
    </nav>
</header>
