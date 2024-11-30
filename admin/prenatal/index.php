<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenatal</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <!-- Add jsPDF and jsPDF AutoTable CDN and other script needed -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style type="text/css">
        /* Add your styles here */
        .Iclass {
            font-family: 'Poppins';
            font-size: 1.3rem;
            cursor: pointer;
            font-weight: 500;
        }

        .icon-size {
            font-size: 1.3rem;
            /* Adjust the size as needed */
            margin: 0 5px;
            /* Space between icons */
        }

        .delete-icon {
            color: red;
            /* Customize the delete icon color */
        }

        .fa-edit {
            color: green;
            /* Customize the edit icon color */
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
            background-color: #ffffff !important;
        }

        .swal2-icon {
            margin-bottom: 10px !important;
        }

        .modalpaddingnew {
            padding-left: 10px;
            margin-bottom: 10px;
        }

        .add-patient-btn {
            background: #2C4E80;
            border-radius: 10px;
            color: #FFFFFF;
            padding: 10px 20px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }

        .add-patient-btn:hover {
            background: #1F3A60;
            color: #FFFFFF;
        }

        .d-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid"
        style="padding: 15px 15px; background-color: white; min-height: 540px; margin-top: 15px; border-radius: 5px; border: 1px solid #dcdcdc;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0 headerfontfont" style="color: #2c2b2e; font-weight: 800;">
                PRENATAL
            </h3>
            <div class="input-group-prepend">
                <a href="#" id="exportExcelImage">
                    <img src="prenatal/excel.png" alt="Export to Excel"
                        style="cursor: pointer; width: 40px; height: auto;">
                </a>
                <a href="#" id="exportPdfImage">
                    <img src="prenatal/pdf.png" alt="Export to PDF" style="cursor: pointer; width: 40px; height: auto;">
                </a>
            </div>
            <button class="btn add-patient-btn" data-toggle="modal" data-target="#mdlAddPatient">
                <img src="./assets/images/add.png" alt="add-image" style="width: 20px;">
                Add Patient
            </button>
        </div>

        <div class="container-fluid"
            style="padding: 15px 15px; background-color: white; min-height: 540px; margin-top: 15px; border-radius: 5px; border: 1px solid #dcdcdc;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="mb-0 headerfontfont" style="color: #2c2b2e; font-weight: 500;">PATIENTS</h3>
                    <!-- <h6 class="mb-0 headerfontfont" style="font-weight: 500; font-size: 15px;">Total of <span id="teacherstotal" style="font-size: 20px; font-weight: 900;"> 35</span> Teachers</h6> -->
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control searchinputorder" id="txtsearchorder"
                            placeholder="Search . . .">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="mb-3" style="border-radius: 10px;">
                        <table data-height="350" class="table fixTable table-hover"
                            style="margin-bottom: 0px; border-bottom: 2px solid #000;">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th style="width: 2%; white-space: nowrap; text-align: center;"> No. </th>
                                    <th style="width: 15%; white-space: nowrap; text-align: center;"> Name </th>
                                    <th style="width: 13%; white-space: nowrap; text-align: center;"> Address </th>
                                    <th style="width: 8%; white-space: nowrap; text-align: center;"> Date Visit </th>
                                    <th style="width: 8%; white-space: nowrap; text-align: center;"> Contact No. </th>
                                    <th style="width: 4%; white-space: nowrap; text-align: center;"> Action </th>
                                </tr>
                            </thead>
                            <tbody id="tblparentlist"></tbody>
                        </table>
                    </div>

                    <input id="txtlistPageCount" type="hidden">
                    <ul id="uporderlistPageList" class="pagination float-right"></ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Patient Modal -->
    <div class="modal fade" id="mdlAddPatient" tabindex="-1" role="dialog" aria-labelledby="addPatientModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center w-100" id="addPatientModalLabel">Add New Patient</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
                </div>
                <form id="addPatientForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="patientName">Patient Name</label>
                            <input type="text" class="form-control" id="patientName" placeholder="Enter patient name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="patientAddress">Address</label>
                            <input type="text" class="form-control" id="patientAddress"
                                placeholder="Purok No., House No., Brgy., Municipality, Province" required>
                        </div>
                        <div class="form-group">
                            <label for="patientContact">Contact Number</label>
                            <input type="text" class="form-control" id="patientContact" placeholder="+639________"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="patientDateVisit">Date of Visit</label>
                            <input type="date" class="form-control" id="patientDateVisit" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-custom">Add Patient</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Each Patient Modal -->
    <div id="contentModal" style="display: none;">
        <div
            style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 999;">
            <div
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; width: 90%; max-width: 500px; max-height: 80%; overflow-y: auto;">
                <div
                    style="background-color: #5D9EFE; color: white; padding: 10px; text-align: center; margin: -20px -20px 20px -20px;">
                    <h2 style="margin: 0;">Patient Details</h2>
                </div>
                <div class="form-group">
                    <label for="patientNameDisplay">Name:</label>
                    <p id="patientNameDisplay"></p>
                </div>
                <div class="form-group">
                    <label for="patientAddressDisplay">Address:</label>
                    <p id="patientAddressDisplay"></p>
                </div>
                <div class="form-group">
                    <label for="patientContactDisplay">Contact Number:</label>
                    <p id="patientContactDisplay"></p>
                </div>
                <div class="form-group">
                    <label for="patientDateVisitDisplay">Date of Visit:</label>
                    <p id="patientDateVisitDisplay"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeModalBtn">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add necessary scripts here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            // Handle the form submission
            $('#addPatientForm').on('submit', function (e) {
                e.preventDefault();
                var patientData = {
                    name: $('#patientName').val(),
                    address: $('#patientAddress').val(),
                    contact: $('#patientContact').val(),
                    dateVisit: $('#patientDateVisit').val(),
                };

                // Call the function to save the patient data
                savePatientData(patientData);
            });

            // Function to save patient data (e.g., via AJAX)
            function savePatientData(data) {
                $.ajax({
                    url: 'path/to/your/api/endpoint', // Adjust to your actual endpoint
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        if (response.success) {
                            alert('Patient added successfully!');
                            $('#mdlAddPatient').modal('hide');
                            // Optionally, refresh the patient list
                            loadPatientList();
                        } else {
                            alert('Failed to add patient.');
                        }
                    },
                    error: function () {
                        alert('Error adding patient.');
                    }
                });
            }

            // Close the modal
            $('#closeModalBtn').on('click', function () {
                $('#contentModal').hide();
            });
        });
    </script>

</body>

</html>