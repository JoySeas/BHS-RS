<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .container {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin: 20px;
        }

        .photo-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border: 2px dashed #ddd;
            border-radius: 10px;
            height: 200px;
            width: 200px;
            background-color: #f5f5f5;
            position: relative;
            cursor: pointer;
        }

        .photo-container p {
            color: #9e9e9e;
            font-size: 14px;
        }

        .photo-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .form-container {
            flex: 1;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
        }

        input[type="text"], select {
            width: 50%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f5f5f5;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            background-color: #5D9EFE;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .btn:hover {
            background-color: #4285f4;
        }

        /* Hidden file input */
        .file-input {
            display: none;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-body" style="padding-top: .5rem; padding-bottom: .5rem; border-radius: 5px; box-shadow: 2px 3px 5px rgb(126, 142, 159);">
            <h3 style="font-weight: 800;">ADD USER</h3>
            <div class="container">
                <div class="photo-container" id="photo-container">
                    <p>Click to upload photo</p>
                    <input type="file" class="file-input" id="photo-input" accept="image/*">
                    <img id="photo-preview" src="" alt="Photo Preview" style="display:none;">
                </div>
                <div class="form-container">
                    <form id="userForm">
                        <div class="form-group">
                            <label for="first-name">First Name:</label>
                            <input type="text" id="first-name" placeholder="Enter first name" required>
                        </div>
                        <div class="form-group">
                            <label for="middle-name">Middle Name:</label>
                            <input type="text" id="middle-name" placeholder="Enter middle name">
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name:</label>
                            <input type="text" id="last-name" placeholder="Enter last name" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" id="username" placeholder="Enter username" required>
                        </div>
                        <div class="form-group">
                            <label for="work-type">Work Type:</label>
                            <select id="work-type" required>
                                <option value="" disabled selected>Select work type</option>
                                <option value="admin">Doctor</option>
                                <option value="staff">Midwife</option>
                                <option value="manager">Nurse</option>
                                <option value="manager">BHW</option>
                            </select>
                        </div>
                        <div style="text-align: right;">
                            <button type="submit" class="btn">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <script>
        // Function to preview the uploaded photo
        document.getElementById('photo-container').addEventListener('click', function() {
            document.getElementById('photo-input').click();
        });

        document.getElementById('photo-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('photo-preview');
                    img.src = e.target.result;
                    img.style.display = 'block'; // Show the preview image
                    document.querySelector('.photo-container p').style.display = 'none'; // Hide the default text
                };
                reader.readAsDataURL(file);
            }
        });

        // Trigger SweetAlert on form submit
        document.getElementById('userForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            // Show SweetAlert confirmation popup
            Swal.fire({
                title: 'Success!',
                text: 'User has been added successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
</body>
</html>
