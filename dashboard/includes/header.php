<?php
    session_start();
    include('../includes/dbconfig.php');

    if(isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];

        $getDoctor = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
        if($getDoctor) {
            $row = mysqli_fetch_assoc($getDoctor);
            $user_id = $row['id'];
            $name = $row['name'];
            $username = $row['username'];
        }
    }
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
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    </head>
    <body>
        <div style="height: 50vh; background-image: url(https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80); background-size: cover; background-position: center;" class="position-relative w-100">
            <div class="position-absolute text-white d-flex flex-column align-items-start justify-content-center" style="top: 0; right: 0; bottom: 0; left: 0; background-color: rgba(0,0,0,.7);">
                <div class="container">
                <div class="col-md-6">
                    <!-- on small screens remove display-4 -->
                    <h1 class="mb-4 mt-2 font-weight-bold welcome-text" style="font-family: Poppins">Welcome to your dashboard <br> <span style="color: #9B5DE5;"><?=$name;?></span></h1>
                    <div class="mt-5">
                        <!-- hover background-color: white; color: black; -->
                        <a href="#overview" class="btn px-5 py-3 mt-3 text-dark mt-sm-0 bg-light bg-gradient" style="border-radius: 30px;font-weight:600;font-family: Poppins;">Get Started</a>
                    </div>
                </div>
                </div>
            </div>
        </div>