<!doctype html>
<?php  
    include('includes/dbconfig.php');
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Clinicosis | An Initiative by Dr. Rohit Srivastava</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash|Montserrat|Poppins" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top py-3">
            <div class="container">
                <a class="navbar-brand" href="/" style="font-family: Poppins;font-size: 24px"><b>Clinicosis</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown" style="flex-grow: inherit">
                    <ul class="navbar-nav" style="font-family: Poppins">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="medlog.php">Medlog</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Calculate
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="calculators/bmi.php">BMI (Body Mass Index)</a></li>
                                <li><a class="dropdown-item" href="calculators/whr.php">WHR (Waist-Hp Ratio)</a></li>
                                <li><a class="dropdown-item" href="calculators/cbc.php">CBC (Complete Body Count)</a></li>
                            </ul>
                        </li>
                        <li class="nav-item d-flex">
                            <?php if(!isset($_SESSION['username'])) { ?>
                            <button type="button" class="btn btn-primary btn-md mx-1" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                            <button type="button" class="btn btn-success btn-md mx-1" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
                            <?php } ?>
                            <?php if(isset($_SESSION['username'])) { ?>
                            <a href="logout.php" class="btn btn-danger btn-md mx-1">Logout</a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form" method="post">
                            <div class="mb-3">
                                <label for="login-username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="login-username" name="login-username" placeholder="Enter your username">
                            </div>
                            <div class="mb-3">
                                <label for="login-password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="login-password" name="login-password" placeholder="Enter your password">
                            </div>
                            <button type="button" class="btn btn-success" name="login_submit" onclick="loginUser()">Submit</button>
                            <div id="login_message"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register Modal -->
        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Register Now</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form" method="post">
                            <div class="mb-3">
                                <label for="register-as" class="form-label">Register as</label>
                                <select name="register-as" id="register-as" class="form-control">
                                    <option name="patient" value="patient">Patient</option>
                                    <option name="user" value="user">User</option>
                                    <option name="doctor" value="doctor">Doctor</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="register-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="register-name" name="register-name" placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label for="register-username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="register-username" name="register-username" placeholder="Enter your username">
                            </div>
                            <div class="mb-3">
                                <label for="register-password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="register-password" name="register-password" placeholder="Enter your password">
                            </div>
                            <button type="button" class="btn btn-success" name="register_submit" onclick="registerUser()">Submit</button>
                            <div id="register_message"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript">

            function loginUser() {
                var username = $("#login-username").val();
                var password = $("#login-password").val();

                if(username != "" && password != "") {
                    $.post("login.php", {
                        username: username, 
                        password: password
                    },
                    function(data) {
                        $('#login_message').html(data);
                    });
                }
            }

            function registerUser() {
                var register_as = document.getElementById('register-as').value
                var name = $('#register-name').val();
                var username = $("#register-username").val();
                var password = $("#register-password").val();

                if(register_as != "" && name != "" && username != "" && password != "") {
                    $.post("register.php", { 
                        register_as: register_as,
                        name: name,
                        username: username, 
                        password: password
                    },
                    function(data) {
                        $('#register_message').html(data);
                    });
                }
            }
        </script>