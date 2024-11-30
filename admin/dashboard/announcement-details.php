<?php
// Database connection
include 'connection.php';

// Get the announcement ID from the URL
$announcement_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the details of the selected announcement
$query = "SELECT * FROM announcements WHERE id = $announcement_id";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$announcement = $result->fetch_assoc();

if (!$announcement) {
    echo "<p>Announcement not found.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins|Montserrat' rel='stylesheet'>
    <style type="text/css">
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .announcement-container {
            display: flex;
            flex-direction: row;
            margin: 1rem;
            border-radius: 5px;
            overflow: hidden;
        }
        .announcement-image {
            flex: 1;
            min-width: 150px;
            position: relative;
        }
        .announcement-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .announcement-content {
            flex: 2;
            padding: 1rem;
        }
        .announcement-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .announcement-date {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 1rem;
        }
        .announcement-text {
            font-size: 1rem;
            margin-bottom: 1rem;
        }
        .see-more {
            color: #007bff;
            cursor: pointer;
            text-align: right;
            display: block;
        }
        .dropdown-menu-container {
            position: absolute;
            top: 6.5rem;
            right: 1.7rem;
            z-index: 1000;
        }
        .dropdown-toggle {
            cursor: pointer;
        }
        .dropdown-menu {
            display: none;
            position: relative;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            right: 0;
        }
        .dropdown-menu a {
            display: block;
            padding: 0.5rem 1rem;
            text-decoration: none;
            color: #333;
        }
        .dropdown-menu a:hover {
            background-color: #f0f0f0;
        }
        .modalnow {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.8);
            justify-content: center;
            align-items: center;
            padding-left: 240px;
            padding-top: 65px;
        }
        .modal-content-now {
            margin: auto;
            display: block;
            max-width: 80%;
            max-height: 80%;
        }
        .close {
            position: absolute;
            top: 20px;
            right: 35px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .announcement-container {
                flex-direction: column;
            }
            .announcement-image {
                min-width: 100%;
            }
            .announcement-content {
                padding: 0.5rem;
            }
            .modal {
                display: none; /* Hide modal on smaller screens */
            }
        }
        
    </style>
</head>
<body>
    <div class="announcement-container">
        <div class="announcement-image">
            <img id="announcementImage" src="<?php echo '../admin/uploads/' . htmlspecialchars(basename($announcement['image_path'])); ?>" alt="Announcement Image">
        </div>
        <div class="announcement-content">
            <div class="announcement-title"><?php echo htmlspecialchars($announcement['title']); ?></div>
            <div class="announcement-date">Posted on: <?php echo date("F j, Y", strtotime($announcement['date'])); ?></div>
            <div class="announcement-text">
                <?php echo nl2br(htmlspecialchars($announcement['content'])); ?>
            </div>
            <a class="see-more" href="./index.php?url=announcement">Back to Announcements</a>
            <!-- Dropdown Menu -->
            <div class="dropdown-menu-container">
                <img src="assets/images/dots.png" class="dropdown-toggle" id="dropdownMenuButton" alt="Options" style="width: 24px; height:24px;">
                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="javascript:void(0);" onclick="openUpdateModal(<?php echo $announcement['id']; ?>)">Update</a>
                    <a href="javascript:void(0);" onclick="deleteAnnouncement(<?php echo $announcement['id']; ?>)">Delete</a>
                </div>
            </div>
             
        </div>
    </div>

    <!-- Modal -->
    <div id="imageModal" class="modalnow">
        <span class="close">&times;</span>
        <img class="modal-content-now" id="modalImage">
    </div>

    <!-- Update Announcement Modal -->
    <div class="modal fade" id="mdlupdateannouncement" tabindex="-1" role="dialog" aria-labelledby="mdlupdateannouncementLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 1rem">
                <div class="modal-header">
                    <h5 class="modal-title text-center w-100" id="mdlupdateannouncementLabel">Update Announcement</h5>
                </div>
                <div class="modal-body">
                    <form id="updateAnnouncementForm" enctype="multipart/form-data">
                        <input type="hidden" id="update-announcement-id" name="announcement-id">
                        <div class="form-group">
                            <input type="text" class="form-control" id="update-announcement-title" name="announcement-title" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" id="update-announcement-date" name="announcement-date">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="update-announcement-content" name="announcement-content" rows="3" placeholder="Type post description here"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control-file" id="update-announcement-image" name="announcement-image" accept="image/*">
                            <small>Current Image: <img id="current-announcement-image" src="" alt="Current Image" style="max-width: 100%; height: auto;"></small>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-custom">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Get the modal
    var modal = document.getElementById("imageModal");
    var img = document.getElementById("announcementImage");
    var modalImg = document.getElementById("modalImage");
    var span = document.getElementsByClassName("close")[0];

    img.onclick = function() {
        // Only show modal if screen width is greater than 768px
        if (window.innerWidth > 768) {
            modal.style.display = "flex";
            modalImg.src = this.src;
        }
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        } else if (!event.target.matches('.dropdown-toggle')) {
            var dropdowns = document.getElementsByClassName('dropdown-menu');
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === 'block') {
                    openDropdown.style.display = 'none';
                }
            }
        }
    }

    // Hide modal on resize
    window.onresize = function() {
        if (window.innerWidth <= 768) {
            modal.style.display = "none";
        }
    }

