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
            font-size: 1.3rem; /* Adjust the size as needed */
            margin: 0 5px; /* Space between icons */
        }

        .delete-icon {
            color: red; /* Customize the delete icon color */
        }

        .fa-edit {
            color: green; /* Customize the edit icon color */
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
<div class="container-fluid" style="padding: 15px 15px; background-color: white; min-height: 540px; margin-top: 15px; border-radius: 5px; border: 1px solid #dcdcdc;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 headerfontfont" style="color: #2c2b2e; font-weight: 500;">
            Patient's Reservation
        </h3>
        <button class="btn add-patient-btn" data-toggle="modal" data-target="#mdlAddPatient">
            <img src="./assets/images/add.png" alt="add-image" style="width: 20px;">
            Add Patients
        </button>
    </div>

<div class="container-fluid" style="padding: 15px 15px; background-color: white; min-height: 540px; margin-top: 15px; border-radius: 5px; border: 1px solid #dcdcdc;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-0 headerfontfont" style="color: #2c2b2e; font-weight: 500;">PATIENTS</h3>
                <!-- <h6 class="mb-0 headerfontfont" style="font-weight: 500; font-size: 15px;">Total of <span id="teacherstotal" style="font-size: 20px; font-weight: 900;"> 35</span> Teachers</h6> -->
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control searchinputorder" id="txtsearchorder" placeholder="Search . . .">
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-12">
            <div class="mb-3" style="border-radius: 10px;">
                <table data-height="350" class="table fixTable table-hover" style="margin-bottom: 0px; border-bottom: 2px solid #000;">
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
<div class="modal fade" id="mdlAddPatient" tabindex="-1" role="dialog" aria-labelledby="addPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPatientModalLabel">Add New Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addPatientForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="patientName">Patient Name</label>
                        <input type="text" class="form-control" id="patientName" placeholder="Enter patient name" required>
                    </div>
                    <div class="form-group">
                        <label for="patientAddress">Address</label>
                        <input type="text" class="form-control" id="patientAddress" placeholder="Enter address" required>
                    </div>
                    <div class="form-group">
                        <label for="patientContact">Contact Number</label>
                        <input type="text" class="form-control" id="patientContact" placeholder="Enter contact number" required>
                    </div>
                    <div class="form-group">
                        <label for="patientDateVisit">Date of Visit</label>
                        <input type="date" class="form-control" id="patientDateVisit" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Patient</button>
                </div>
            </form>
        </div>
    </div>
</div>      

    <!-- Add necessary scripts here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        fetchParents();

        function fetchParents(query) {
        $.ajax({
            url: 'parents/get_parents.php', // Path to your PHP script
            type: 'GET',
            data: { search: query },
            dataType: 'json',
            success: function(data) {
                let rows = '';
                $.each(data, function(index, parent) {
                    rows += `<tr>
                        <td style="text-align: center;">${index + 1}</td>
                        <td>${parent.parent_id}</td>
                        <td>${parent.name}</td>
                        <td>${parent.address}</td>
                        <td>${parent.email}</td>
                        <td style="text-align: center;">
                            <i class="fas fa-eye icon-size" data-id="${parent.parent_id}" title="View"></i>
                            <i class="fas fa-trash delete-icon icon-size" data-id="${parent.parent_id}" title="Delete"></i>
                        </td>
                    </tr>`;
                });
                $('#tblparentlist').html(rows);
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error:", error);
            }
        });
    }

    $(document).on('click', '.delete-icon', function() {
    let parentId = $(this).data('id');

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
            $.ajax({
                url: 'parents/delete_parent.php',
                type: 'GET', // Change to 'GET' to match your PHP script
                data: { parent_id: parentId }, // Adjusted key to match PHP script
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Deleted!',
                            'The parent account has been deleted.',
                            'success'
                        );
                        fetchParents(); // Refresh the table
                    } else {
                        Swal.fire(
                            'Error!',
                            'There was an issue deleting the parent account.',
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Error:", error);
                    Swal.fire(
                        'Error!',
                        'There was an issue deleting the parent account.',
                        'error'
                    );
                }
            });
        }
    });
});
        // Event listener for view icon
        function openContentModal(parent_id) {
    $.ajax({
        url: 'parents/get_parent.php', // Path to the PHP script that fetches parent details
        type: 'GET',
        data: { id: parent_id },
        dataType: 'json',
        success: function(data) {
            // Populate the modal with the fetched data
            $('#parentImageDisplay img').attr('src', `../parent/uploads/${data.profile_image}`);
            $('#parentNameDisplay').text(data.name);
            $('#parentAddressDisplay').text(data.address);
            $('#parentEmailDisplay').text(data.email);
            $('#parentContactDisplay').text(data.mobile_number);
            
            // Show the modal
            $('#contentModal').show();
        },
        error: function(xhr, status, error) {
            console.log("AJAX Error: " + error);
        }
    });
}

// Function to close the modal
$(document).ready(function() {
    $('#closeModalBtn').on('click', function() {
        $('#contentModal').hide(); // Hide the modal
    });
});

$(document).on('click', '.fa-eye', function() {
    var parentId = $(this).data('id'); // Ensure this matches the data attribute in your HTML
    openContentModal(parentId);
});
// Fetch the total number of parents from the server
function fetchTotalParents() {
        $.ajax({
            url: 'parents/get_total_parents.php', // Path to your PHP script
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Update the total number of parents on the page
                $('#parentstotal').text(data.total);
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error:", error);
            }
        });
    }

    // Fetch parent data based on search input
    function searchParents(query) {
        $.ajax({
            url: 'parents/search_parents.php', // Path to your PHP script
            type: 'GET',
            data: { search: query },
            dataType: 'json',
            success: function(data) {
                let rows = '';
                $.each(data, function(index, parent) {
                    rows += `<tr>
                        <td style="text-align: center;">${index + 1}</td>
                        <td>${parent.parent_id}</td>
                        <td>${parent.name}</td>
                        <td>${parent.address}</td>
                        <td>${parent.email}</td>
                        <td style="text-align: center;">
                            <i class="fas fa-eye icon-size" data-id="${parent.parent_id}" title="View"></i>
                            <i class="fas fa-trash delete-icon icon-size" data-id="${parent.parent_id}" title="Delete"></i>
                        </td>
                    </tr>`;
                });
                $('#tblparentlist').html(rows);
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error:", error);
            }
        });
    }

    // Fetch initial total number of parents
    fetchTotalParents();

    // Event listener for search input
    $('#txtsearchparent').on('keyup', function() {
        let query = $(this).val();
        searchParents(query);
    });
});
document.getElementById('exportExcelImage').addEventListener('click', function (event) {
    event.preventDefault();
    var wb = XLSX.utils.table_to_book(document.querySelector('table'));
    XLSX.writeFile(wb, 'parents.xlsx');
});
document.getElementById('exportPdfImage').addEventListener('click', function (event) {
    event.preventDefault();

    // Ensure jsPDF is properly referenced
    const { jsPDF } = window.jspdf;

    // Create a new jsPDF instance
    const pdf = new jsPDF('p', 'pt', 'letter'); // Defaults to 'a4' but adapts to any paper size

    // Get current page dimensions dynamically
    const pageWidth = pdf.internal.pageSize.width;
    const pageHeight = pdf.internal.pageSize.height;

    // Add the logo
    const logo = new Image();
    logo.src = 'parents/JCCA-LOGO.png'; // Path to your logo image
    logo.onload = function() {
        // Dynamically position and scale the logo relative to page size
        const logoWidth = 110; // Adjust size if needed
        const logoHeight = 120;
        const logoX = 40;
        const logoY = 0;

        pdf.addImage(logo, 'PNG', logoX, logoY, logoWidth, logoHeight);

        // Add a title below the logo
        pdf.setFont('helvetica', 'bold');
        pdf.setFontSize(15);
        pdf.text("Jesus Cares Christian Academy", pageWidth / 2, 50, { align: 'center' }); // Center the title
        pdf.setFontSize(12);
        pdf.text("Student's Parents/Guardian Records", pageWidth / 2, 70, { align: 'center' }); // Center the subtitle

        // Fetch the table
        const table = document.querySelector('table');

        if (!table) {
            console.error("Table element not found!");
            return;
        }

        // Initialize an empty array to hold table rows data
        let rows = [];

        // Loop through table rows
        const tableRows = table.querySelectorAll('tbody tr');
        tableRows.forEach(function (row) {
            let rowData = [];
            const cells = row.querySelectorAll('td');

            cells.forEach(function (cell) {
                rowData.push(cell.textContent.trim()); // Add each cell's text content
            });

            rows.push(rowData); // Push the row data to the array
        });

        // Add the table headers
        let headers = [];
        const tableHeaders = table.querySelectorAll('thead th');
        tableHeaders.forEach(function (header) {
            headers.push(header.textContent.trim()); // Add header text
        });

        // Use jsPDF AutoTable to add the table to the PDF
        pdf.autoTable({
            head: [headers],
            body: rows,
            margin: { top: logoHeight + 40 }, // Adjust margin based on logo size
            headStyles: { fillColor: [60, 141, 188] }, // Custom header background color
            theme: 'grid',
            styles: {
                halign: 'center', // Center the text in the table
                fontSize: 10 // Adjust font size for table content to make it responsive
            }
        });

        // Add footer for the date and time generated
        const currentDate = new Date();
        const formattedDate = currentDate.toLocaleDateString();
        const formattedTime = currentDate.toLocaleTimeString();

        // Place footer at the bottom of the page
        pdf.setFontSize(10);
        pdf.text(`Date Generated: ${formattedDate} ${formattedTime}`, 40, pageHeight - 20); // Bottom-left position

        // Save the generated PDF
        pdf.save('parents.pdf');
    };
});



</script>
</body>
</html>
