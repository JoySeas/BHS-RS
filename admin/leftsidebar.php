<?php
include("../connect.php");
session_start();

// Check if user is logged in (you should implement your own authentication logic)
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Get username from session
$username = $_SESSION['username'];
?>

<head>
    <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="assets/fontawesome/css/brands.css" rel="stylesheet" />
    <link href="assets/fontawesome/css/solid.css" rel="stylesheet" />
</head>
<style>
    .dropdown-item.active {
        color: #fff;
        text-decoration: none;
        background-color: #D7EBF0;
    }

    .dropdown-item.active {
        background-color: #D7EBF0;
        font-weight: 500;
    }

    .sidebar-nav>ul>li>a.active {
        font-weight: 500;
        background: #D7EBF0;

    }

    .nav-item.active>a {
        background-color: #D7EBF0;
        /* or any desired color for the active menu */
        font-weight: 500;
    }
</style>
<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider" style="margin: 10px 0;"></li>

                <!-- <li id="mainuseraccount">
                    <a href="index.php?url=user"><i class="fas fa-user" style="color: #0092D1"></i>
                        <span class="hide-menu">&nbsp;&nbsp;<?php echo htmlspecialchars($username); ?></span>
                    </a>
                </li> -->
                <li id="maindashboard">
                    <a href="index.php?url=dashboard"><i class="fas fa-home" style="color: #0092D1"></i>
                        <span class="hide-menu">&nbsp;&nbsp;Dashboard</span>
                    </a>
                </li>
                <li id="mainuseraccount">
                    <a href="index.php?url=events"><i><img src="assets/images/calendar.png" alt=""
                                style="width: 30px"></i>
                        <span class="hide-menu">&nbsp;&nbsp;Calendar</span>
                    </a>
                </li>
                <li id="mainuseraccount">
                    <a href="index.php?url=records"><i><img src="assets/images/patientrec.png" alt=""
                                style="width: 30px"></i>
                        <span class="hide-menu">&nbsp;&nbsp;Patient's Record</span>
                    </a>
                </li>
                <li id="mainuseraccount">
                    <a href="index.php?url=announcement"><i><img src="assets/images/mission.png" alt=""
                                style="width: 30px"></i>
                        <span class="hide-menu">&nbsp;&nbsp;Medical Mission</span>
                    </a>
                </li>
                <!-- <li id="mainuseraccount">
                    <a href="index.php?url=backup"><i><img src="assets/images/backup.png" alt=""
                                style="width: 30px"></i>
                        <span class="hide-menu">&nbsp;&nbsp;Backup & Restore</span>
                    </a>
                </li> -->
                <li id="mainuseraccount">
                    <a href="index.php?url=reservations"><i><img src="assets/images/sms.png" alt=""
                                style="width: 30px"></i>
                        <span class="hide-menu">&nbsp;&nbsp;Reservations</span>
                    </a>
                </li>
                <li id="mainuseraccount">
                    <a href="index.php?url=adduser"><i><img src="assets/images/user.png" alt=""
                                style="width: 30px"></i>
                        <span class="hide-menu">&nbsp;&nbsp;Users</span>
                    </a>
                </li>

                <!-- <li id="mainitems"
                    class="nav-item dropdown <?php echo (isset($_GET['url']) && in_array($_GET['url'], ['teachers', 'students', 'parents']) ? 'active show' : ''); ?>">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#"
                        data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="<?php echo (isset($_GET['url']) && in_array($_GET['url'], ['teachers', 'students', 'parents']) ? 'true' : 'false'); ?>">
                        <i><img src="assets/images/users.png" alt="" style="width: 30px"></i>
                        <span class="hide-menu">&nbsp;&nbsp;Users</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right <?php echo (isset($_GET['url']) && in_array($_GET['url'], ['teachers', 'students', 'parents']) ? 'show' : ''); ?>"
                        style="width: 270px;">
                        <a class="dropdown-item <?php echo ($_GET['url'] == 'teachers' ? 'active' : ''); ?>"
                            href="index.php?url=teachers">
                            <i style="margin-left: 15px;"></i>Teachers
                        </a>
                        <a class="dropdown-item <?php echo ($_GET['url'] == 'students' ? 'active' : ''); ?>"
                            href="index.php?url=students">
                            <i style="margin-left: 15px;"></i>Students
                        </a>
                        <a class="dropdown-item <?php echo ($_GET['url'] == 'parents' ? 'active' : ''); ?>"
                            href="index.php?url=parents">
                            <i style="margin-left: 15px;"></i>Parents
                        </a>
                    </div>
                </li> -->




                <li class="nav-devider" style="margin: 100px 0;"></li>

                <!-- <li id="notifications">
                    <a href="#"><i><img src="assets/images/notification.png" alt="" style="width: 30px"></i>
                        <span class="hide-menu">&nbsp;&nbsp;Notifications</span>
                    </a>
                </li> -->
                <li class=" nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            style="font-size: 2rem;"><img src="assets/images/gear.png" alt=""
                                style="width: 30px"></i><span class="hide-menu">&nbsp;&nbsp;Settings</span>
                    </a>
                    <!-- <a class="nav-link text-muted waves-effect waves-dark" href="#" style="font-weight: 300; font-size: 16px; display:none;"><span id=""><b><?php echo $_SESSION['firstname'] ?></b></span></a> -->
                    <div class="dropdown-menu dropdown-menu-right animated flipInY" style="width: 270px;">
                        <ul class="dropdown-user">
                            <li><a href="javascript:void(0)" onclick="opensettingmod();" class="settinghover"><i
                                        class="ti-settings" style="margin-right: 5px;"></i> Account Settings</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0)" onclick="logoutuser();" class="settinghover"><i
                                        class="fas fa-lock"
                                        style="margin-left: 10px; margin-right: 10px;"></i>Logout</a></li>
                            <!--<li><a href="" onclick="opensettingmod();" class="settinghover"><i class="fas fa-lock"></i> Logout</a></li>-->
                        </ul>
                    </div>
                </li>

                <!-- <li id="mainreports">
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="fas fa-file-alt" style="font-size: 23px;"></i>
                        <span class="hide-menu">&nbsp;&nbsp;Reports</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li id="reports-000001"><a href="index.php?url=reports&sub=repstocks">&nbsp;&nbsp;Inventory</a></li>
                        <li id="reports-000002"><a href="index.php?url=reports&sub=repsales">&nbsp;&nbsp;Sales</a></li>
                        <li id="reports-000003"><a href="index.php?url=reports&sub=repreceived">&nbsp;&nbsp;Received Items</a></li>
                    </ul>
                </li> -->
            </ul>
        </nav>
    </div>

    <div id="modalupdateprofileset" class="modal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-md" style="max-width: 400px;">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div style="display: flex;justify-content: space-between !important;">
                                <h4 class="headerfontfont2" style="color: #2c2b2e;font-weight: 500;">Account Settings
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                                    onclick="cleardata()"
                                    style="padding: 1rem 1rem;margin: -1.6rem -1rem -1rem auto;">×</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="txtsetemail" style="margin-bottom: 0px;">Username</label>
                            <input type="text" class="form-control reqdistitem5" name="txtsetemail" id="txtsetemail"
                                style="height: 40px;">
                        </div>

                        <div class="col-md-12 mb-2">
                            <label for="txtsetpassword" style="margin-bottom: 0px;">Password</label>
                            <div class="input-group">
                                <input type="Password" class="form-control reqdistitem5" id="txtsetpassword">
                                <div class="input-group-prepend" style="cursor: pointer;"
                                    onclick="fncaddpassattribunHash();" id="inputaddusereye">
                                    <span class="input-group-text"><i class="fas fa-eye-slash"
                                            id="addusereye"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="padding: 10px 15px;">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn waves-effect waves-light btn-secondary"
                                style="background-color: #4C644B!important; border: 1px solid #4C644B!important;"
                                onclick="updateuser2();">Update</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {

        })

        function logoutuser() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to logout your account?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "logout.php";
                }
            });
        }

        function opensettingmod() {
            $("#modalupdateprofileset").modal('show');

            $.ajax({
                type: 'POST',
                url: 'adminclass.php',
                data: 'form=opensettingmod',
                success: function (data) {
                    var arr = JSON.parse(data);
                    $("#txtsetemail").val(arr[0]);
                    $("#txtsetpassword").val(arr[1]);
                }
            });
        } // displaying the change username and pass for admin---------------------------------------------------------------------

        // design for confirming update on user---------------------------------------------------------------------
        function reqField1(classN) {
            var isValid = 1;
            $('.' + classN).each(function () {
                if ($(this).val() == '') {
                    $(this).css('border', '1px #a94442 solid');
                    $(this).addClass('lala');
                    isValid = 0;
                } else {
                    $(this).css('border', '');
                    $(this).removeClass('lala');
                }
            });

            return isValid;
        } //for confirming update on user---------------------------------------------------------------------

        function fncaddpassattribHash() { //for unseeing the password----------------------------------------------------------------
            $("#txtsetpassword").attr("type", "password");
            $("#inputaddusereye").attr("onclick", "fncaddpassattribunHash()");
            $("#addusereye").removeClass("fa-eye");
            $("#addusereye").addClass("fa-eye-slash");
        } //for unseeing the password----------------------------------------------------------------

        function fncaddpassattribunHash() { //for seeing the password----------------------------------------------------------------
            $("#txtsetpassword").attr("type", "text");
            $("#inputaddusereye").attr("onclick", "fncaddpassattribHash()");
            $("#addusereye").addClass("fa-eye");
            $("#addusereye").removeClass("fa-eye-slash");
        } //for seeing the password----------------------------------------------------------------

        //for confirming update on user---------------------------------------------------------------------
        function updateuser2() {
            var textsetemail = $("#txtsetemail").val();
            var textsetpassword = $("#txtsetpassword").val();
            if (reqField1('reqdistitem5') == 1) {
                $(".preloader").show().css('background', 'rgba(255,255,255,0.5)');
                $.ajax({
                    type: 'POST',
                    url: 'adminclass.php',
                    data: 'textsetemail=' + textsetemail + '&textsetpassword=' + textsetpassword + '&form=updateuser2',
                    success: function (data) {
                        setTimeout(function () {
                            $(".preloader").hide().css('background', '');
                            $("#modalupdateprofileset").modal('hide');
                            Swal.fire(
                                'Success!',
                                'Successfully Updated Account.',
                                'success'
                            )
                        }, 1000);
                        setTimeout(function () {
                            window.location.reload();
                        }, 3000);
                    }
                })
            } else {
                alert('Please review your entries. Ensure all required fields are filled out');
            }
        } //for confirming update on user---------------------------------------------------------------------

        // setInterval(function() {
        //     $.ajax({
        //         url: 'notificationclass.php',
        //         type: 'POST',
        //         success: function(data) {
        //             var data = JSON.parse(data);
        //             if (data.statusCode == 200) {
        //                 $('.notificationclass').html(
        //                     '<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>'
        //                 )
        //             } else if (data.statusCode == 201) {
        //                 $('.notificationclass').html(
        //                     '<div class=""> <span class="heartbit"></span> <span class="point"></span> </div>'
        //                 )
        //             }
        //         }
        //     })
        // }, 1000)

        // $('.shownotif').click(function() {
        //     $.ajax({
        //         url: 'notificationclass.php',
        //         data: {
        //             shownotif: 'shownotif',
        //         },
        //         type: 'POST',
        //         success: function(data) {}
        //     })
        // })
    </script>
</aside>