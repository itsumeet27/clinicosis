<?php 
    include('includes/dbconfig.php');
    session_start();

    $register_as = $_POST['register_as'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (`name`, `username`, `password`) VALUES ('$name', '$username', '$password')";
    $conn->query($query);

    $getUsers = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $getUsers);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['id'];

        if($register_as == "doctor") {
            $add_doctor = "INSERT INTO doctors (`user_id`) VALUES ('$user_id')";
            $result = mysqli_query($conn, $add_doctor);
        }
    
        if($register_as == "patient") {
            $add_patient = "INSERT INTO patients (`user_id`) VALUES ('$user_id')";
            $result = mysqli_query($conn, $add_patient);
        } 
    }
    
    
    if($result) {
        echo "<p class='alert alert-success mt-3'>You are successfully registered with us!</p>";
        echo "<script>setTimeout(() => { window.location.reload() }, 2000)</script>";
    } else {
        echo "<p class='alert alert-danger mt-3'>Error! Please try again later.</p>";
        echo "<script>setTimeout(() => { window.location.reload() }, 2000)</script>";
    }
    mysqli_close($conn);
?>