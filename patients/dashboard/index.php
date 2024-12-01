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

        /* Style for Mondays */
        .fc-day.fc-mon {
            background-color: red !important;
        }

        /* Style for events with prenatal/vaccination */
        .fc-event-prenatal {
            background-color: lightpink !important;
            color: red !important;
        }

        /* Style for Wednesdays */
        .fc-day.fc-wed {
            background-color: lightpink !important;
        }

        /* Style for events with immunization */
        .fc-event-immunization {
            background-color: lightpink !important;
            color: blue !important;
        }
        .fc-daygrid-day.fc-day-today:focus,
.fc-daygrid-day.fc-day-today:active {
    outline: none !important;
}
.fc-event {
    border: none !important;
}

.fc-event-prenatal,
.fc-event-immunization {
    border: none !important;
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
                            <h2 class="mb-0 mt-0" style="font-weight: 800;">SET AN APPOINTMENT</h2>
                        </div>
                    </div>
                    <!-- FullCalendar -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- FullCalendar JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: function(info, successCallback) {
                var events = [];
                var startOfMonth = moment(info.startStr);
                var endOfMonth = moment(info.endStr);
                var currentDate = moment(startOfMonth);

                // Add "Vaccination Prenatal" events for all Mondays
                while (currentDate.isBefore(endOfMonth)) {
                    if (currentDate.day() === 1) { // Monday
                        events.push({
                            title: 'PRENATAL DAY',
                            start: currentDate.format('YYYY-MM-DD'),
                            className: 'fc-event-prenatal'
                        });
                    }
                    currentDate.add(1, 'days');
                }

                currentDate = moment(startOfMonth);
                // Add "Immunization" events for all Wednesdays
                while (currentDate.isBefore(endOfMonth)) {
                    if (currentDate.day() === 3) { // Wednesday
                        events.push({
                            title: 'IMMUNIZATION DAY',
                            start: currentDate.format('YYYY-MM-DD'),
                            className: 'fc-event-immunization'
                        });
                    }
                    currentDate.add(1, 'days');
                }

                successCallback(events);
            },
            dateClick: function(info) {
    // Show a modal using SweetAlert2
    Swal.fire({
    title: 'Set Appointment',
    html: `
        <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 10px;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <label for="appointmentName" style="width: 100px;">Name:</label>
                <input id="appointmentName" class="swal2-input" style="width: 200px;" placeholder="Enter Name">
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <label for="appointmentAddress" style="width: 100px;">Address:</label>
                <input id="appointmentAddress" class="swal2-input" style="width: 200px;" placeholder="Enter Address">
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <label for="appointmentTime" style="width: 100px;">Time:</label>
                <input id="appointmentTime" class="swal2-input" style="width: 200px;" type="time">
            </div>
        </div>
    `,
    showCancelButton: true,
    confirmButtonText: 'Save',
    preConfirm: () => {
        const name = document.getElementById('appointmentName').value;
        const address = document.getElementById('appointmentAddress').value;
        const time = document.getElementById('appointmentTime').value;
        if (!name || !time) {
            Swal.showValidationMessage('Please fill out all fields');
            return false;
        }
        return { name, address, time };
    }

    }).then((result) => {
        if (result.isConfirmed) {
            const { name, address, time } = result.value;
            calendar.addEvent({
                title: `${name} (${time})`,
                start: info.dateStr,
                description: address,
                className: 'fc-event'
            });
            Swal.fire('Saved!', 'Your appointment has been added.', 'success');
        }
    });
}

        });
        calendar.render();
    });
</script>

</body>
</html>
