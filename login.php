<?php 
    include('includes/dbconfig.php');
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $login_query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";                    
    $login_result = mysqli_query($conn, $login_query);
    
    if(mysqli_num_rows($login_result) > 0) {
        $row = mysqli_fetch_assoc($login_result);
        if ($row['username'] == $username && $row['password'] == $password) {
            echo "<p class='alert alert-success mt-3'>You're logged in!</p>";
            $_SESSION['name'] = $row['name'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            echo "<script>setTimeout(() => { window.location.reload() }, 2000)</script>";
            
        } else {
            echo "<p class='alert alert-danger mt-3'>You have entered wrong credentials, please check!</p>";
        }
    } else {
        echo "<p class='alert alert-danger mt-3'>Currently, there are no users registered with us!</p>";
        echo "<script>setTimeout(() => { window.location.reload() }, 2000)</script>";
    }
?>