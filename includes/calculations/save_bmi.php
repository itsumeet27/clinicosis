<?php
    session_start();
    require_once('../../includes/dbconfig.php');

    $name = $_POST['name'];
    $age = $_POST['age'];
    $username = $_POST['username'];
    $sex = $_POST['sex'];
    $diagnosis = $_POST['diagnosis'];
    $save_for = $_POST['saveDataFor'];
    $selected_patient = $_POST['selected_patient'];

    $bmi = 0.0;
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    
    $height_square = pow($height,2);

    $bmi = (float)($weight/$height_square);
    $bmi_value = number_format($bmi, 2, '.', '');
    
    if(isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        if($save_for == "patient") {
            if($selected_patient != "N/A") {
                //Add record to selected patient
                $add_patient_record = mysqli_query($conn, "INSERT INTO bmi (`user_id`, `added_by`, `height`, `weight`, `bmi_value`) VALUES ('$selected_patient', '$id', '$height', '$weight', '$bmi_value')");
                if($add_patient_record) {
                    echo "<p class='alert alert-success mt-3'>Data Saved Successfully!</p>";
                    echo "<script>setTimeout(() => { window.location.reload() }, 2000)</script>";
                }
            } else {
                //Insert into users
                $result = mysqli_query($conn, "INSERT INTO users (`name`, `age`, `username`, `password`, `sex`, `diagnosis`) VALUES ('$name', '$age', '$username', 'newUser1234', '$sex', '$diagnosis')");
                if($result) {
                    $fetch_user = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
                    if($fetch_user) {
                        $row = mysqli_fetch_assoc($fetch_user);
                        $user_id = $row['id'];
                        //Insert into patients
                        mysqli_query($conn, "INSERT INTO patients (`user_id`, `doctor_id`) VALUES ('$user_id', '$id')");

                        // Insert into BMI
                        mysqli_query($conn, "INSERT INTO bmi (`user_id`, `added_by`, `height`, `weight`, `bmi_value`) VALUES ('$user_id', '$id', '$height', '$weight', '$bmi_value')");

                        $fetch_doctor = mysqli_query($conn, "SELECT * FROM doctors WHERE doctor_id = $id");
                        if($fetch_doctor) {
                            $row = mysqli_fetch_assoc($fetch_doctor);
                            $no_of_patients = $row['no_of_patients'];

                            //Update no. of patients for a doctor
                            mysqli_query($conn, "UPDATE doctors SET no_of_patients = $no_of_patients+1");
                        }

                        
                    }
                    
                    echo "<p class='alert alert-success mt-3'>Data Saved Successfully!</p>";
                    echo "<script>setTimeout(() => { window.location.reload() }, 2000)</script>";
                }
            }
        }

        if($save_for == "self") {
            $addBmiRecord = mysqli_query($conn, "INSERT INTO bmi (`user_id`, `added_by`, `height`, `weight`, `bmi_value`) VALUES ('$id', '$id', '$height', '$weight', '$bmi_value')");
            if($addBmiRecord) {
                echo "<p class='alert alert-success mt-3'>Data Saved Successfully</p>";
                echo "<script>setTimeout(() => { window.location.reload() }, 2000)</script>";
            }
        }
    }
    

    
?>