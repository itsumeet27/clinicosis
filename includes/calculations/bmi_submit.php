<?php
    session_start();
    require_once('../../includes/dbconfig.php');

    $bmi = 0.0;
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    
    $height_square = pow($height,2);

    $bmi = (float)($weight/$height_square);
    $bmi_value = number_format($bmi, 2, '.', '');

    echo $bmi_value;
?>