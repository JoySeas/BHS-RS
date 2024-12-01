<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <?php include('header.php'); ?>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .auth {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ffffff;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .auth-container {
            display: flex;
            flex-direction: row;
            background-color: #ffffff;
            box-shadow: 1px 1px 5px rgb(126, 142, 159);
            border-radius: 20px;
            max-width: 600px;
            width: 100%;
            height: 600px;
        }

        .auth-container img {
            width: auto;
            height: auto;
            max-width: 400px; /* limit size of logo */
            max-height: 500px; /* limit size of logo */
            object-fit: contain;
            margin-bottom: -80px;
        }

        .form-container {
            padding: 3rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-header {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .card {
            border: none;
            background-color: transparent;
            box-shadow: none;
        }

        .form-group {
            margin-bottom: 20px;
        }

        /* Center logo in the form */
        .form-group img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        @media (min-width: 768px) {
            .auth-container {
                flex-direction: row;
            }

            .auth-container img {
                width: 100%;
            }

            .form-container {
                width: 50%;
            }
        }

        @media (max-width: 767px) {
            .auth-container img {
            width: auto;
            height: auto;
            max-width: 250px; /* limit size of logo */
            max-height: 300px; /* limit size of logo */
            object-fit: contain;
            margin-bottom: -40px;
            }

            .form-container {
                width: 100%;
            }
        }

        hr.custom-line {
            border: none;
            border-top: 1px solid #D2D2D2;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>

    <div class="auth">
        <div class="auth-container">
            <div class="card form-container">
                <div class="card-body cardbodylogin">
                    <div class="form-horizontal form-material">
                        <div class="form-group row" style="margin-bottom: 5px;">
                            <div class="col-md-12">
                                <img src="assets/images/lying_in_LOGO.svg" alt="bhsrsLOGO" class="header-logo">
                            </div>
                        </div>
                        <label class="mt-3" for="username" style="margin-bottom: 0px; color:#000000; font-family: 'Poppins'; font-weight: 500; font-size: 1rem">Email or Username</label>
                        <div class="form-group row">
                            <span class="text-danger"></span>
                            <div class="col-md-11" style="flex: 0 0 98.2%; max-width: 98.2%;">
                                <input type="email" class="form-control underlined" name="txtemail" id="txtemail" placeholder="" required style="height: 40px; border-radius: 8px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" style="margin-bottom: 0px; color:#000000; font-family: 'Poppins'; font-weight: 500; font-size: 1rem">Password</label>
                            <span class="text-danger"></span>
                            <div class="row">
                                <div class="col-md-11" style="padding-right: 0px; flex: 0 0 95%; max-width: 95%;">
                                    <input type="password" class="form-control underlined" name="txtpassword" id="txtpassword" placeholder="" required style="height: 40px; border-radius: 8px;">
                                </div>
                                <div class="col-md-1" style="padding-left: 0px;padding-right: 0px; flex: 1%; max-width: 1%;">
                                    <i class="fa fa-eye-slash" style="margin-left: -23px; cursor: pointer; font-size: 1.1rem; margin-top: .7rem" id="logineye" onclick="fncloginpassattribunHash()"></i>
                                </div>
                                <div class="col-md-11" style="text-align: right; padding-right: 0px; flex: 0 0 95%; max-width: 95%;">
                                    <a href="#">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <div class="col-xs-12">
                                <button class="btn btn-success btn-md btn-block text-uppercase waves-effect waves-light" onclick="loginuser();" style="padding: 10px 10px; font-weight: 500; background-color: #2C4E80; border-radius: 14px;">LogIn</button>
                            </div>
                            <hr class="custom-line">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php include('jscripts.php'); ?>

<script type="text/javascript">
    $(document).keyup(function(e) {
        var e = e || window.event;
        if (e.which == 13) {
            loginuser();
        }
    });

    function loginuser() {
        var txtemail = $("#txtemail").val();
        var txtpassword = $("#txtpassword").val();
        $(".preloader").show().css('background', 'rgba(255,255,255,0.5)');
        $.ajax({
            type: 'POST',
            url: 'adminclass.php',
            data: 'txtemail=' + txtemail +
                '&txtpassword=' + txtpassword +
                '&form=loginuser',
            success: function(data) {
                setTimeout(function() {
                    $(".preloader").hide().css('background', '');
                    if (data == 1) {
                        window.location = 'index.php';
                    } else if (data == 3) {
                        Swal.fire(
                            'USER INACTIVE',
                            'Your account is currently inactive, Please contact your admin.',
                            'warning'
                        )
                    } else {
                        Swal.fire(
                            'USER NOT FOUND',
                            'You have entered invalid username or password.',
                            'warning'
                        )
                    }
                }, 1000);
            }
        })
    }

    function fncloginpassattribHash() {
        $("#txtpassword").attr("type", "password");
        $("#logineye").attr("onclick", "fncloginpassattribunHash()");
        $("#logineye").removeClass("fa-eye");
        $("#logineye").addClass("fa-eye-slash");
    }

    function fncloginpassattribunHash() {
        $("#txtpassword").attr("type", "text");
        $("#logineye").attr("onclick", "fncloginpassattribHash()");
        $("#logineye").addClass("fa-eye");
        $("#logineye").removeClass("fa-eye-slash");
    }
</script>
