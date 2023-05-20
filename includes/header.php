<!doctype html>

<?php include('includes/dbconfig.php'); ?>
<?php 
    session_start(); 
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Clinicosis | An Initiative by Dr. Rohit Srivastava</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="#">Clinicosis</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown" style="flex-grow: inherit">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Calculators
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
                            <a href="../logout.php" class="btn btn-danger btn-md mx-1">Logout</a>
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
                            <input type="submit" class="btn btn-success" value="Submit" name="login_submit">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <?php 

            if(isset($_POST['login_submit'])) {
                $username = $_POST['login-username'];
                $password = $_POST['login-password'];

                $login_query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
                
                
                $login_result = mysqli_query($conn, $login_query);
                
                if($login_result) {
                    $row = mysqli_fetch_assoc($login_result);
                    if ($row['username'] == $username && $row['password'] == $password) {
                        echo "<script>alert('Logged in successfully!')</script>";
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['id'] = $row['id'];
                        echo "<meta http-equiv='refresh' content='0'>";
                    } else {
                        echo "<script>alert('Please check your credentials!')</script>";
                    }
                }
            }

        ?>

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
                                <label for="register-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="register-name" name="register-name" placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label for="register-email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="register-email" name="register-email" placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label for="register-username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="register-username" name="register-username" placeholder="Enter your username">
                            </div>
                            <div class="mb-3">
                                <label for="register-password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="register-password" name="register-password" placeholder="Enter your password">
                            </div>
                            <input type="submit" class="btn btn-success" value="Submit" name="register_submit">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <?php

            if(isset($_POST['register_submit'])) {
                $name = $_POST['register-name'];
                $email = $_POST['register-email'];
                $username = $_POST['register-username'];
                $password = $_POST['register-password'];

                $query = "INSERT INTO users (`name`, `email`, `username`, `password`) VALUES ('$name', '$email', '$username', '$password')";
                $result = mysqli_query($conn, $query);
                if($result) {
                    echo "<script>alert('You are successfully registered with us!')</script>";
                } else {
                    echo "<script>alert('Error! Please try again later.')</script>";
                }
                mysqli_close($conn);
            }

        ?>
    </body>
</html>