<?php 
    include('includes/dbconfig.php');
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];
    
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
?>