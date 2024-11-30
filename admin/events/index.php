<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar of Events</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
    <style>
        /* Your existing styles */
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

        /* Responsive FullCalendar */
        #calendar {
            max-width: 100%;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            #calendar {
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            #calendar {
                font-size: 12px;
            }
        }

        .fc-event {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-12">
            <div class="card" style="margin-bottom: 0px;">
                <div class="card-body" style="padding-top: .5rem; padding-bottom: .5rem; border-radius: 5px; box-shadow: 2px 3px 5px rgb(126, 142, 159);">
                    <div class="row page-titles rowpageheaderpadd" style="padding-bottom: 0px;">
                        <div class="col-md-6 col-6 align-self-center" style="padding-left:10px;">
                            <h1 class="mb-0 mt-0" style="font-weight: 800;">SCHEDULE</h1>
                        </div>
                    </div>
                    <!-- FullCalendar -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Modal -->
    <div id="eventModal" style="display: none;">
        <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 999;">
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; width: 90%; max-width: 500px;">
                <h2 style="text-align: center;">Add Event</h2>
                <form id="eventForm" method="POST">
                    <input type="hidden" id="formAction" name="formAction" value="add">
                    <div class="form-group">
                        <input type="text" id="eventTitle" name="eventTitle" class="form-control" placeholder="Enter event title" required>
                    </div>
                    <div class="form-group">
                        <input type="date" id="eventDate" name="eventDate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <textarea id="eventContent" name="eventContent" class="form-control" rows="3" placeholder="Enter event content"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="btn" style="background-color: #5D9EFE; color: white; margin-right: 10px;">Add Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Content Modal -->
<div id="contentModal" style="display: none;">
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 999;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; width: 90%; max-width: 500px;">
            <h2 style="text-align: center;">Event Details</h2>
            <div class="form-group">
                <label for="eventTitleDisplay">Title:</label>
                <p id="eventTitleDisplay"></p>
            </div>
            <div class="form-group">
                <label for="eventDateDisplay">Date:</label>
                <p id="eventDateDisplay"></p>
            </div>
            <div class="form-group">
                <label for="eventContentDisplay">Content:</label>
                <p id="eventContentDisplay"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closecontentModal()">Close</button>
                <button type="button" class="btn" style="background-color: #5D9EFE; color: white;" onclick="openUpdateForm()">Edit</button>
                <button type="button" class="btn btn-danger" onclick="deleteEvent()">Delete</button>
            </div>
        </div>
    </div>
</div>


    <!-- Update Event Modal -->
    <div id="updateModal" style="display: none;">
        <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 999;">
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; width: 90%; max-width: 500px;">
                <h2 style="text-align: center;">Update Event</h2>
                <form id="updateForm" method="POST">
                    <input type="hidden" id="formAction" name="formAction" value="update">
                    <input type="hidden" id="updateId" name="id">
                    <div class="form-group">
                        <input type="text" id="updateTitle" name="eventTitle" class="form-control" placeholder="Enter event title" required>
                    </div>
                    <div class="form-group">
                        <input type="date" id="updateDate" name="eventDate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <textarea id="updateContent" name="eventContent" class="form-control" rows="3" placeholder="Enter event content"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeUpdateModal()">Cancel</button>
                        <button type="submit" class="btn" style="background-color: #5D9EFE; color: white;">Update Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FullCalendar JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let currentEventId = null; // Variable to store the current event ID

        function openModal() {
            document.getElementById('eventModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('eventModal').style.display = 'none';
            document.getElementById('eventForm').reset();
        }

        function opencontentModal(event) {
            document.getElementById('eventTitleDisplay').textContent = event.title;
            document.getElementById('eventDateDisplay').textContent = event.startStr;
            document.getElementById('eventContentDisplay').textContent = event.extendedProps.content;
            document.getElementById('contentModal').style.display = 'block';
            currentEventId = event.id; // Store event ID
        }

        function closecontentModal() {
            document.getElementById('contentModal').style.display = 'none';
        }

        function openUpdateForm() {
            document.getElementById('updateModal').style.display = 'block';
            fetchEventDetails();
        }

        function closeUpdateModal() {
            document.getElementById('updateModal').style.display = 'none';
            document.getElementById('updateForm').reset();
        }

        function fetchEventDetails() {
            fetch('events/get_event.php?id=' + currentEventId)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        document.getElementById('updateId').value = data.event.id;
                        document.getElementById('updateTitle').value = data.event.title;
                        document.getElementById('updateDate').value = data.event.start_date;
                        document.getElementById('updateContent').value = data.event.content;
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'An unexpected error occurred.', 'error');
                });
        }

        document.getElementById('eventForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this);

            fetch('events/class.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Event Added',
                        text: data.message
                    }).then(() => {
                        location.reload(); // Reload the page or update the calendar
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error); // Log any network or fetch errors
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred.'
                });
            });
        });

        document.getElementById('updateForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this);

            fetch('events/update_event.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Event Updated',
                        text: data.message
                    }).then(() => {
                        location.reload(); // Reload the page or update the calendar
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error); // Log any network or fetch errors
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred.'
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: 'events/get_events.php',
                editable: true,
                selectable: true,
                select: function(info) {
                    openModal();
                    document.getElementById('eventDate').value = info.startStr;
                },
                eventClick: function(info) {
                    opencontentModal(info.event);
                },
                eventDrop: function(info) {
                    updateEvent(info.event);
                },
                eventResize: function(info) {
                    updateEvent(info.event);
                }
            });
            calendar.render();
        });
      

        function updateEvent(event) {
    console.log('Sending event data:', {
        id: event.id,
        title: event.title,
        start_date: event.startStr,
        content: event.extendedProps.content || ''
    });

    fetch('events/update_event.php', {
        method: 'POST',
        body: JSON.stringify({
            id: event.id,
            title: event.title,
            start_date: event.startStr,
            content: event.extendedProps.content || ''
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Server response:', data);
        if (data.status === 'error') {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error', 'An unexpected error occurred.', 'error');
    });
}
function deleteEvent() {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you really want to delete this event?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('events/delete_event.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'id': currentEventId
                }),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: data.message
                    }).then(() => {
                        location.reload(); // Reload the page or update the calendar
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred.'
                });
            });
        }
    });
}



    </script>
</body>
</html>
