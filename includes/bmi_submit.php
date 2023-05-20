<?php
    session_start();
    require_once('../includes/dbconfig.php');

    $bmi = 0.0;
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    
    $height_square = pow($height,2);

    $bmi = (float)($weight/$height_square);
    $bmi_value = number_format($bmi, 2, '.', '');

    if(isset($_SESSION['id'])) {
        $id = $_SESSION['id'];

        $findUser = "SELECT * FROM users WHERE id = $id";
        $resultUser = mysqli_query($conn, $findUser);

        if($resultUser) {
            $findUserInBMI = "SELECT * FROM bmi WHERE user_id = $id";
            $queryBMIUser = mysqli_query($conn, $findUserInBMI);

            if($queryBMIUser) {
                $row = mysqli_fetch_assoc($queryBMIUser);
                if(mysqli_num_rows($queryBMIUser) > 0) {
                    $updateBMI = mysqli_query($conn, "UPDATE bmi SET `weight` = '$weight', `height` = '$height', `bmi_value` = '$bmi_value' WHERE user_id = $id");
                } else {
                    $insertBMI = mysqli_query($conn, "INSERT INTO bmi (`user_id`, `weight`, `height`, `bmi_value`) VALUES ('$id', '$weight', '$height', '$bmi_value')");
                } 
            }
            $updateUser = mysqli_query($conn, "UPDATE users SET bmi = $bmi_value WHERE id = $id");
        }
        
    }

    echo "<p class='alert alert-primary'>Your BMI value is: <b>$bmi_value</b> kg/m<sup>2</sup>";
?>