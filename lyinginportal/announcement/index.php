<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <style type="text/css">
        .Iclass {
            font-size: 1.3rem;
            cursor: pointer;
            font-weight: 500;
        }

        ul.pagination {
            display: inline-block;
            padding: 0;
            margin: 0;
        }

        ul.pagination li {
            cursor: pointer;
            display: inline;
            color: #3a4651 !important;
            font-weight: 600;
            padding: 4px 8px;
            border: 1px solid #CCC;
        }

        .pagination li:first-child {
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .pagination li:last-child {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }

        ul.pagination li:hover {
            background-color: #3a4651;
            color: white !important;
        }

        .pagination .active {
            background-color: #3a4651;
            color: white !important;
        }

        .table thead th,
        .table th {
            background-color: #9e9e9e !important;
        }

        .swal2-icon {
            margin-bottom: 10px !important;
        }

        .modalpaddingnew {
            padding-left: 5px;
            margin-bottom: 10px;
        }
        .btn-custom {
        background-color: #5D9EFE;
        border-color: #5D9EFE;
        color: #fff;
        }
        .box img {
            width: 100%;
            height: auto; /* Maintain aspect ratio */
        }

        .fixed-size-card {
        width: 100%; /* Full width by default */
        max-width: 335px; /* Maximum width */
        height: auto; /* Auto height for the card itself */
        margin-bottom: 15px;
        box-shadow: 2px 3px 5px rgb(126, 142, 159);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        }

        .fixed-size-card img {
        width: 323px; /* Fixed width for the image */
        height: 182px; /* Fixed height for the image */
        object-fit: cover; /* Ensures the image covers the specified dimensions */
        margin: 0 auto; /* Centers the image inside the card */
        }

        .box {
        background: #FFFFFF;
        box-shadow: 2px 3px 5px rgb(126, 142, 159);
        padding: 1rem;
        flex: 1; /* Allow box to grow and fill remaining space */
        display: flex;
        flex-direction: column;
        }   

        .content {
        overflow: hidden;
        height: 80px; /* Fixed height for content area */
        position: relative;
        }

        .see-more {
        color: #007bff;
        cursor: pointer;
        display: block;
        text-align: right;
        margin-top: 0.5rem;
        }

        @media (max-width: 576px) {
        .fixed-size-card {
        width: 100%; /* Full width on smaller screens */
        max-width: 100%; /* Override the maximum width */
        height: auto; /* Allow height to adjust automatically */
        margin: 0 0 15px 0; /* Ensure no side margins */
        }
    
        .fixed-size-card img {
        width: 100%; /* Make image responsive */
        height: auto; /* Auto height to maintain aspect ratio */
        }            
        .page-titles {
        padding-bottom: 0;
        }
        h3 {
        font-size: 20px; /* Smaller font size */
        margin-bottom: 1rem; /* Adjust margins */
        margin-top: 0.5rem;
        }
        }
        /* Add styles for the dropdown menu */
        /* Add styles for the dropdown menu */
        .card-image-container {
        position: relative; /* Ensure the dropdown menu is positioned relative to the image */
        }
        .dropdown-menu-container {
        position: absolute;
        top: 10px; /* Adjust as needed */
        right: 10px; /* Adjust as needed */
        z-index: 1000; /* Increase z-index to ensure it's on top of other content */
        }
        .dropdown-toggle {
        cursor: pointer;
        }
        .dropdown-menu {
        display: none; /* Hide menu by default */
        position: relative;
        right: 0;
        top: 100%; /* Adjust position if needed */
        background: white;
        border: 1px solid #ddd;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
        z-index: 1000; /* Ensure dropdown is above other content */
        }

        .dropdown-menu.show {
        display: block;
        }   
        .dropdown-item {
        padding: 10px;
        color: #333;
        text-decoration: none;
        display: block;
        }
        .dropdown-item:hover {
        background-color: #f1f1f1;
        }
    </style>
</head>
<body>


<?php
// Fetch announcements from the database
$sql = "SELECT * FROM announcements ORDER BY date DESC";
$result = mysqli_query($connection, $sql);

function truncateContent($content, $wordLimit = 7) {
    $words = explode(' ', $content);
    if (count($words) > $wordLimit) {
        return implode(' ', array_slice($words, 0, $wordLimit)) . '...';
    }
    return $content;
}
// Check if there are any announcements
if (mysqli_num_rows($result) == 0) {
    // If there are no announcements, show the ADD ANNOUNCEMENT section
    ?>
    <!--ADD ANNOUNCEMENT-->
    <div class="row">
        <div class="col-12">
            <div class="card" style="margin-bottom: 0px;">
                <div class="card-body" style="padding-top: .5rem; padding-bottom: .5rem; border-radius: 5px; box-shadow: 2px 3px 5px rgb(126, 142, 159);">
                    <div class="row page-titles rowpageheaderpadd" style="padding-bottom: 0px;">
                        <div class="col-md-6 col-6 align-self-center" style="padding-left:10px;">
                            <h3 class="mb-0 mt-0 headerfontfont" style="font-weight: 800; font-size: 1.5rem;">MEDICAL MISSION ANNOUNCEMENTS</h3>
                        </div>
                    </div>
                    <!-- Centered Image and Button -->
                    <div class="row">
                        <div class="col-12 text-center" style="margin-top: 80px;">
                            <img src="./assets/images/newpost.png" alt="new-post" style="width: 200px;">
                        </div>
                        <div class="col-12 text-center">
                            <p>Post something good!</p>
                        </div>
                        <div class="col-12 text-center" style="margin-bottom: 100px;">
                            <button class="btn" style="background: #2C4E80; border-radius: 10px; color: #FFFFFF; margin-top: 10px;" data-toggle="modal" data-target="#mdladdannouncement">
                            <img src="./assets/images/add.png" alt="add-image" style="width: 20px"> Add Announcement</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    // If there are announcements, show the ANNOUNCEMENT DETAILS section
    ?>
    <!--ANNOUNCEMENT DETAILS-->
    <div class="row">
    <div class="col-12">
        <div class="card" style="margin-bottom: 0px;">
            <div class="card-body" style="padding-top: .5rem; padding-bottom: .5rem; border-radius: 5px; box-shadow: 2px 3px 5px rgb(126, 142, 159);">
                <div class="row page-titles rowpageheaderpadd" style="padding-bottom: 0px;">
                    <div class="col-md-6" style="padding-left: 1rem;">
                        <h3 style="font-family: 'Poppins'; font-weight: 800; font-size: 25px; margin-bottom: 2rem; margin-top: 1.5rem;">ANNOUNCEMENTS</h3>
                    </div>
                    <div class="col-md-6 text-right" style="padding-right: 1rem;">
                        <button class="btn" style="background: #2C4E80; border-radius: 10px; color: #FFFFFF; margin-top: 1rem;margin-bottom: 2rem;" data-toggle="modal" data-target="#mdladdannouncement">
                        <img src="./assets/images/add.png" alt="add-image" style="width: 20px">
                        Add Post
                    </button>
                    </div>
                </div>

                <div class="row">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <!-- Inside your while loop where announcements are listed -->
                    <div class="col-xs-12 col-md-4">
                         <div class="fixed-size-card">
                            <div class="card-image-container">
                                <img src="../admin/uploads/<?php echo basename($row['image_path']); ?>" alt="">
                                    <div class="dropdown-menu-container">
                                        <img src="assets/images/dots.png" class="dropdown-toggle" id="dropdownMenuButton-<?php echo $row['id']; ?>" alt="Options" style="width: 24px; height:24px;">
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-<?php echo $row['id']; ?>">
                                        <a class="dropdown-item" href="#" onclick="openUpdateModal(<?php echo $row['id']; ?>)">Update</a>
                                        <a class="dropdown-item" href="javascript:void(0);" onclick="deleteAnnouncement(<?php echo $row['id']; ?>)">Delete</a>
                                    </div>
                                </div>
                            </div>

        <div class="box">
            <div class="title">
                <h5 style="font-weight: 800;"><?php echo $row['title']; ?></h5>
            </div>
            <div class="content">
                <h6>
                    <?php echo substr($row['content'], 0, 100); ?>...
                    <a class="see-more" href="./index.php?url=announcementdetails&id=<?php echo $row['id']; ?>">See More</a>
                </h6>       
            </div>
            <div class="author">
                <h6>Date:  <?php echo date("F j, Y", strtotime($row['date'])); ?></h6>
                <h6>Time: <?php echo date("g:i A", strtotime($row['time'])) ;?> - <?php echo date("g:i A", strtotime($row['timeend'])) ; ?></h6> <!-- Display time -->
            </div>
        </div>
    </div>
</div>

                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
}
?>

    <!-- Add Announcement Modal -->
    <div class="modal fade" id="mdladdannouncement" tabindex="-1" role="dialog" aria-labelledby="mdladdannouncementLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 1rem">
                <div class="modal-header">
                    <h5 class="modal-title text-center w-100" id="mdladdannouncementLabel">New Announcement</h5>
                </div>
                <div class="modal-body">
                    <form id="announcementForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" id="announcement-title" name="announcement-title" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" id="announcement-date" name="announcement-date">
                        </div>
                        <div class="form-group">
                            <input type="time" class="form-control" id="announcement-time" name="announcement-time" placeholder="Enter Start time">
                        </div>
                        <div class="form-group">
                            <input type="time" class="form-control" id="announcement-timeend" name="announcement-timeend" placeholder="Enter End time">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="announcement-place" name="announcement-place" placeholder="Enter place">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="announcement-content" name="announcement-content" rows="3" placeholder="Type post description here"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control-file" id="announcement-image" name="announcement-image" accept="image/*">
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
                            <input type="time" class="form-control" id="update-announcement-time" name="announcement-time">
                        </div>
                        <div class="form-group">
                            <input type="time" class="form-control" id="update-announcement-timeend" name="announcement-timeend">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="update-announcement-place" name="announcement-place" placeholder="Enter place">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('#announcementForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this);

            $.ajax({
                url: 'announcement/data.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Announcement posted successfully!',
                    }).then(function() {
                        location.reload(); // Reload the page after closing the alert
                    });
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error posting the announcement.',
                    });
                }
            });
        });
    });
    $(document).ready(function() {
        $('.dropdown-toggle').on('click', function() {
            $(this).siblings('.dropdown-menu').toggleClass('show');
        });

        $(document).on('click', function(event) {
            if (!$(event.target).closest('.dropdown-menu-container').length) {
                $('.dropdown-menu').removeClass('show');
            }
        });
    });
 // Function to open the update modal and fetch announcement data
function openUpdateModal(id) {
    // Fetch announcement data and populate the modal fields
    fetch('announcement/get_announcement.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            document.getElementById('update-announcement-id').value = data.id;
            document.getElementById('update-announcement-title').value = data.title;
            document.getElementById('update-announcement-date').value = data.date;
            document.getElementById('update-announcement-time').value = data.time;
            document.getElementById('update-announcement-timeend').value = data.timeend;
            document.getElementById('update-announcement-place').value = data.place;
            document.getElementById('update-announcement-content').value = data.content;
            document.getElementById('current-announcement-image').src = '../admin/uploads/' + data.image_path;
            $('#mdlupdateannouncement').modal('show');
        })
        .catch(error => console.error('Error fetching announcement data:', error));
}

// Event listener for form submission
document.getElementById('updateAnnouncementForm').addEventListener('submit', function(event) {
    event.preventDefault();
    let formData = new FormData(this);

    fetch('announcement/update_announcement.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        if (result === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Announcement updated successfully!',
            }).then(() => {
                location.reload(); // Refresh the page to see the updates
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error updating announcement!',
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'There was an issue with the request.',
        });
        console.error('Error updating announcement:', error);
    });
});
// Function to delete an announcement
function deleteAnnouncement(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Proceed with the delete operation
            fetch('announcement/delete.php?id=' + id, {
                method: 'POST'
            })
            .then(response => response.text())
            .then(result => {
                if (result === 'success') {
                    Swal.fire(
                        'Deleted!',
                        'Your announcement has been deleted.',
                        'success'
                    ).then(() => {
                        location.reload(); // Refresh the page to remove the deleted announcement
                    });
                } else {
                    Swal.fire(
                        'Error!',
                        'There was an issue deleting the announcement.',
                        'error'
                    );
                }
            })
            .catch(error => {
                Swal.fire(
                    'Error!',
                    'There was an issue with the request.',
                    'error'
                );
                console.error('Error deleting announcement:', error);
            });
        }
    });
}

    
</script>

</body>
</html>
