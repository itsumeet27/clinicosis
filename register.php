<?php 
    include('includes/dbconfig.php');

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
        echo "<p class='alert alert-success mt-2'>You are successfully registered with us!</p>";
    } else {
        echo "<p class='alert alert-danger mt-2'>Error! Please try again later.</p>";
    }
    mysqli_close($conn);
?>