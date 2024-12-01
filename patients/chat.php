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
        padding-left: 10px;
        margin-bottom: 10px;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card" style="margin-bottom: 0px;">
            <div class="card-body" style="padding-top: .5rem; padding-bottom: .5rem;">
                <div class="row page-titles rowpageheaderpadd" style="padding-bottom: 0px;">
                    <div class="col-md-6 col-6 align-self-center" style="padding-left:10px;">
                        <h3 class="mb-0 mt-0 headerfontfont text-themecolor" style="font-weight: 600;">CHATS</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid" style="padding: 0px; margin-top: 15px;">
    <div class="row">
        <div class="col-12">
            <div class="card m-0">
                <!-- .chat-row -->
                <div class="chat-main-box">
                    <!-- .chat-left-panel -->
                    <div class="chat-left-aside">
                        <div class="open-panel"><i class="ti-angle-right"></i></div>
                        <div class="chat-left-inner">
                            <div class="form-material" style="margin-top:10px;">
                                <input class="form-control p-3" type="text" placeholder="Search Conversation" id="txtsearchcontacts">
                            </div>
                            <ul class="chatonline style-none ">
                                <div id="dsplychatusers"></div>
                                <li class="p-3"></li>
                            </ul>
                        </div>
                    </div>
                    <!-- .chat-left-panel -->
                    <!-- .chat-right-panel -->
                    <div class="chat-right-aside">
                        <div class="chat-main-header">
                            <div class="p-3 border-bottom">
                                <h3 class="box-title" style="color: #4C644B ;">Chat Message</h3>
                            </div>
                        </div>
                        <div class="chat-rbox">
                            <ul class="chat-list p-4">
                                <div id="dsplychats">
                                    <h6 style='margin-top: 20px; font-weight: 300; color:#afafaf; text-align:center;'>
                                        <i> Select Conversation . . . </i>
                                    </h6>
                                </div>
                            </ul>
                        </div>
                        <div class="card-body" style="border-top: 0.5px solid #fff ">
                            <div class="row">
                                <div class="input-group">
                                    <img id="imagePreview" alt="Image Preview" style="display: none; max-width: 100%; max-height: 100%;">
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="imageAttachment" style="cursor: pointer; background-color:transparent; width:100%;">
                                            <i class="fa fa-paperclip"></i>
                                        </label>
                                    </div>
                                    <!-- File input for image attachment -->
                                    <input type="file" name="imageAttachment" id="imageAttachment" accept="image/*" style="display: none;">


                                    <div class="col-9" style="padding-left: 5px;">
                                        <input type="hidden" name="txtuser_id" id="txtuser_id">
                                        <input type="hidden" name="txtsendtoID" id="txtsendtoID">
                                        <input type="hidden" name="txtadmin" id="txtadmin">
                                        <textarea placeholder="Type your message here . . . " class="form-control b-0" id="txtmessage"></textarea>
                                    </div>


                                    <button type="button" class="btn btn-info btn-circle btn-lg" onclick="sendbutton();">
                                        <i class="fa fa-paper-plane"></i>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- .chat-right-panel -->
                </div>
                <!-- /.chat-row -->
            </div>
        </div>
    </div>
</div>

<!-- slimscrollbar scrollbar JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<script src="js/chat.js"></script>
<script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
<script src="assets/plugins/Chart.js/Chart.min.js"></script>

<script type="text/javascript">
    $(function() {
        $("#txtsearchcontacts").keyup(function(e) {
            if ($('#txtsearchcontacts').val() == "") {
                displaychatusers()
            } else {
                displaychatusers();
            }
        });
        displaychatusers();
    });

    function displaychatusers() {
        var srchprod = $("#txtsearchcontacts").val();
        $.ajax({
            type: 'POST',
            url: 'chat_class.php',
            data: 'srchprod=' + srchprod + '&form=displaychatusers',
            success: function(data) {
                $("#dsplychatusers").html(data);
            }
        })
    }

    function displaychats(user_id, sendtoID) {
        $("#txtmessage").val("");
        $.ajax({
            type: 'POST',
            url: 'chat_class.php',
            data: 'user_id=' + user_id + '&sendtoID=' + sendtoID + '&form=displaychats',
            success: function(data) {
                $("#dsplychats").html(data);
                $("#txtuser_id").val(user_id);
                $("#txtsendtoID").val(sendtoID);
            }
        })

        // $.ajax ({
        //     type: 'POST',
        //     url: 'chat_class.php',
        //     data: 'id=' + id + '&user_id=' + user_id + '&form=fncupdatestatus' ,
        //     success: function(data) {
        //         // alert(data)
        //     }
        // })
    }

    // function sendbutton() {
    //     var textmessage = $("#txtmessage").val();
    //     var textuser_id = $("#txtuser_id").val();
    //     var textsendtoID = $("#txtsendtoID").val();
    //     if (textuser_id != "") {
    //         if (textmessage != "") {
    //             $.ajax({
    //                 type: 'POST',
    //                 url: 'chat_class.php',
    //                 data: 'textmessage=' + textmessage + '&textuser_id=' + textuser_id + '&textsendtoID=' +
    //                     textsendtoID + '&form=sendbutton',
    //                 success: function(data) {
    //                     displaychats(textuser_id, textsendtoID);
    //                     displaychatusers();
    //                     $("#txtmessage").val("");
    //                 }
    //             })
    //         } else {
    //             alert("Please enter a message");
    //         }
    //     } else {
    //         alert("Please select a conversation.");
    //     }
    // }

    $('#imageAttachment').on('change', function() {
        previewImage();
    });

    // Function to preview the selected image
    function previewImage() {
        // Get the image file
        var imageFile = $('#imageAttachment')[0].files[0];

        // Check if an image is selected
        if (imageFile) {
            // Preview the selected image
            var reader = new FileReader();
            reader.onload = function(e) {
                // Display the image preview
                $('#imagePreview').attr('src', e.target.result);
                $('#imagePreview').css('display', 'block');
            }
            reader.readAsDataURL(imageFile);
        } else {
            // If no image selected, hide the preview
            $('#imagePreview').attr('src', '');
            $('#imagePreview').css('display', 'none');
        }
    }

    // Function to show success message with Swal
    function showSuccessMessage(message) {
        Swal.fire({
            title: 'Success!',
            text: message,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }

    // Function to show error message with Swal
    function showErrorMessage(message) {
        Swal.fire({
            title: 'Error!',
            text: message,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }

    // Function to handle the send button click
    function sendbutton() {
        var textMessage = $("#txtmessage").val();
        var textuser_id = $("#txtuser_id").val();
        var textSendToID = $("#txtsendtoID").val();
        var textAdmin = $("#txtadmin").val();

        // Get the image file
        var imageFile = $('#imageAttachment')[0].files[0];

        // Create FormData to send image and additional data
        var formData = new FormData();
        formData.append('textmessage', textMessage);
        formData.append('textuser_id', textuser_id);
        formData.append('textsendtoID', textSendToID);
        formData.append('textadmin', textAdmin);
        formData.append('imageFile', imageFile);
        formData.append('form', 'sendbutton');

        if (textuser_id !== "") {
            if (textMessage !== "" || imageFile !== undefined) {
                // Clear the image preview before making the AJAX request
                $('#imagePreview').attr('src', '');
                $('#imagePreview').css('display', 'none');

                $.ajax({
                    type: 'POST',
                    url: 'chat_class.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        displaychats(textuser_id, textSendToID, textAdmin);
                        displaychatusers();
                        $("#txtmessage").val("");
                        // Show success message with Swal
                        showSuccessMessage("Message sent successfully");
                    },
                    error: function(xhr, status, error) {
                        console.error("Error sending message:", error);
                        // Show error message with Swal
                        showErrorMessage("Failed to send message. Please try again.");
                    },
                    complete: function() {
                        // Clear the input value after the request completes
                        $('#imageAttachment').val('');
                    }
                });
            } else {
                // Show error message with Swal
                showErrorMessage("Please enter a message or select an image");
            }
        } else {
            // Show error message with Swal
            showErrorMessage("Please select a conversation.");
        }
    }
</script>