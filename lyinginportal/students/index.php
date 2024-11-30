<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
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
            background-color: #C2ECFF !important;
        }

        .swal2-icon {
            margin-bottom: 10px !important;
        }

        .modalpaddingnew {
            padding-left: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid" style="padding: 15px 15px; background-color: white; min-height: 540px; margin-top: 15px; border-radius: 5px; border: 1px solid;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-0 headerfontfont" style="color: #2c2b2e; font-weight: 500;">Students</h3>
                <h6 class="mb-0 headerfontfont" style="font-weight: 500; font-size: 15px;">Total of <span id="studentstotal" style="font-size: 20px; font-weight: 900;"></span> Students</h6>
            </div>
            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <a href="#" id="exportExcelImage">
                        <img src="students/excel.png" alt="Export to Excel" style="cursor: pointer; width: 40px; height: auto;">
                    </a>
                    <a href="#" id="exportPdfImage">
                        <img src="students/pdf.png" alt="Export to PDF" style="cursor: pointer; width: 40px; height: auto;">
                    </a>
                        <span class="input-group-text searchinputorder"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control searchinputorder" id="txtsearchstudent" placeholder="Search . . .">
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="mb-3" style="border-radius: 10px;">
                    <table data-height="350" class="table table-bordered fixTable table-hover" style="margin-bottom: 0px;">
                        <thead class="bg-success text-white">
                            <tr>
                                <th style="width: 2%; white-space: nowrap; text-align: center;"> No. </th>
                                <th style="width: 3%; white-space: nowrap;"> Student No. </th>
                                <th style="width: 15%; white-space: nowrap;"> Name </th>
                                <th style="width: 13%; white-space: nowrap;"> Address </th>
                                <th style="width: 8%; white-space: nowrap;"> Email </th>
                                <th style="width: 4%; white-space: nowrap; text-align: center;"> Action </th>
                            </tr>
                        </thead>
                        <tbody id="tblstudentlist"></tbody>
                    </table>
                </div>

                <input id="txtlistPageCount" type="hidden">
                <ul id="uporderlistPageList" class="pagination float-right"></ul>
                <div class="col-md-4">
            </div>
            </div>
        </div>
    </div>
<!-- View Each Student Modal -->
<div id="contentModal" style="display: none;">
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 999;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px; width: 90%; max-width: 500px; max-height: 80%; overflow-y: auto; position: relative;">
            <!-- Modal Header -->
            <div style="background-color: #5D9EFE; color: white; padding: 10px; position: relative; text-align: center; margin: -20px -20px 20px -20px;">
                <h2 style="margin: 0; color:#fff; font-weight: 500;">Student Details</h2>
                <!-- Close Icon -->
            </div>
            <div class="form-group">
                <div id="studentImageDisplay" style="text-align: center;">
                    <img src="" alt="Student Image" id="studentImage" style="max-width: 100px; height: auto; border-radius: 50%; border: 3px solid #5D9EFE;">
                </div>
            </div>
            <div class="form-group">
                <label for="studentNameDisplay">Name:</label>
                <p id="studentNameDisplay"></p>
            </div>
            <div class="form-group">
                <label for="studentAddressDisplay">Address:</label>
                <p id="studentAddressDisplay"></p>
            </div>
            <div class="form-group">
                <label for="studentEmailDisplay">Email:</label>
                <p id="studentEmailDisplay"></p>
            </div>
            <div class="form-group">
                <label for="studentContactDisplay">Mobile Number:</label>
                <p id="studentContactDisplay"></p>
            </div>
             <div class="modal-footer" style="margin-right: -20px">
                <button type="button" class="btn btn-secondary" id="closeModalBtn">Close</button>
            </div>
        </div>
        
    </div>
</div>
    <!-- Add necessary scripts here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        fetchStudents();

        function fetchStudents(query) {
        $.ajax({
            url: 'students/get_students.php', // Path to your PHP script
            type: 'GET',
            data: { search: query },
            dataType: 'json',
            success: function(data) {
                let rows = '';
                $.each(data, function(index, student) {
                    rows += `<tr>
                        <td style="text-align: center;">${index + 1}</td>
                        <td>${student.student_no}</td>
                        <td>${student.name}</td>
                        <td>${student.address}</td>
                        <td>${student.email}</td>
                        <td style="text-align: center;">
                            <i class="fas fa-eye icon-size" data-id="${student.stud_id}" title="View"></i>
                            <i class="fas fa-trash delete-icon icon-size" data-id="${student.stud_id}" title="Delete"></i>
                        </td>
                    </tr>`;
                });
                $('#tblstudentlist').html(rows);
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error:", error);
            }
        });
    }

    $(document).on('click', '.delete-icon', function() {
    let studId = $(this).data('id');

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
                url: 'students/delete_student.php',
                type: 'GET', // Change to 'GET' to match your PHP script
                data: { stud_id: studId }, // Adjusted key to match PHP script
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Deleted!',
                            'The student account has been deleted.',
                            'success'
                        );
                        fetchStudents(); // Refresh the table
                    } else {
                        Swal.fire(
                            'Error!',
                            'There was an issue deleting the student account.',
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Error:", error);
                    Swal.fire(
                        'Error!',
                        'There was an issue deleting the student account.',
                        'error'
                    );
                }
            });
        }
    });
});
        // Event listener for view icon
        function openContentModal(stud_id) {
    $.ajax({
        url: 'students/get_student.php', // Path to the PHP script that fetches student details
        type: 'GET',
        data: { id: stud_id },
        dataType: 'json',
        success: function(data) {
            // Populate the modal with the fetched data
            $('#studentImageDisplay img').attr('src', `../student/uploads/${data.profile_image}`);
            $('#studentNameDisplay').text(data.name);
            $('#studentAddressDisplay').text(data.address);
            $('#studentEmailDisplay').text(data.email);
            $('#studentContactDisplay').text(data.mobile_number);
            
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
    var studentId = $(this).data('id'); // Ensure this matches the data attribute in your HTML
    openContentModal(studentId);
});
// Fetch the total number of students from the server
function fetchTotalStudents() {
        $.ajax({
            url: 'students/get_total_students.php', // Path to your PHP script
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Update the total number of students on the page
                $('#studentstotal').text(data.total);
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error:", error);
            }
        });
    }

    // Fetch student data based on search input
    function searchStudents(query) {
        $.ajax({
            url: 'students/search_students.php', // Path to your PHP script
            type: 'GET',
            data: { search: query },
            dataType: 'json',
            success: function(data) {
                let rows = '';
                $.each(data, function(index, student) {
                    rows += `<tr>
                        <td style="text-align: center;">${index + 1}</td>
                        <td>${student.student_no}</td>
                        <td>${student.name}</td>
                        <td>${student.address}</td>
                        <td>${student.email}</td>
                        <td style="text-align: center;">
                            <i class="fas fa-eye icon-size" data-id="${student.stud_id}" title="View"></i>
                            <i class="fas fa-trash delete-icon icon-size" data-id="${student.stud_id}" title="Delete"></i>
                        </td>
                    </tr>`;
                });
                $('#tblstudentlist').html(rows);
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error:", error);
            }
        });
    }

    // Fetch initial total number of students
    fetchTotalStudents();

    // Event listener for search input
    $('#txtsearchstudent').on('keyup', function() {
        let query = $(this).val();
        searchStudents(query);
    });
});
document.getElementById('exportExcelImage').addEventListener('click', function (event) {
    event.preventDefault();
    var wb = XLSX.utils.table_to_book(document.querySelector('table'));
    XLSX.writeFile(wb, 'students.xlsx');
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
        pdf.text("Student's Records", pageWidth / 2, 70, { align: 'center' }); // Center the subtitle

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
        pdf.save('students.pdf');
    };
});


</script>
</body>
</html>
