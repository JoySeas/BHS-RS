<?php
include("connect.php");
session_start();

if (empty($_SESSION['user_id']) || $_SESSION['usertype'] !== 'ADMIN') {
  echo "<script> window.location = 'login.php';</script>";
  exit(); // Add exit to stop further execution of the script
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php
  include('header.php');
  ?>
</head>

<body class="fix-header fix-sidebar card-no-border">

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>

    <div id="main-wrapper">
        <?php include('topbar.php'); ?>

        <?php
    include('leftsidebar.php');
    ?>

        <div class="page-wrapper">

            <div class="container-fluid containerfluidneed" style="padding: 20px 20px;">
                <?php
        if (!isset($_GET['url'])) {
          echo "<script>window.location='index.php?url=dashboard';</script>";
        } else {
          if ($_GET['url'] == "dashboard") {
            include "dashboard/index.php";
          }

          if ($_GET['url'] == "user") {
            include "user/index.php";
          }

          if ($_GET['url'] == "announcement") {
            include "announcement/index.php";
          }
          if ($_GET['url'] == "announcementdetails") {
            include "announcement/announcement_details.php";
          }
          if ($_GET['url'] == "announcement-details") {
            include "dashboard/announcement-details.php";
          }
          if ($_GET['url'] == "events") {
            include "events/index.php";
          }
          if ($_GET['url'] == "records") {
            include "prenatal/index.php";
          }
          if ($_GET['url'] == "prenatal") {
            include "prenatal/index.php";
          }
          if ($_GET['url'] == "immunization") {
            include "immunization/index.php";
          }if ($_GET['url'] == "otherservices") {
            include "otherservices/index.php";
          }
          if ($_GET['url'] == "reservations") {
            include "reservation/index.php";
          }
          if ($_GET['url'] == "adduser") {
            include "adduser/index.php";
          }

        }
        ?>
            </div>

            <?php include('footer.php'); ?>
        </div>

    </div>

    <?php include('jscripts.php'); ?>
</body>

</html>