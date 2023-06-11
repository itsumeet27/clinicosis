<?php
    include('includes/header.php');
    include('../includes/dbconfig.php');

    if(isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $totalPatients = 0;

        $getDoctorAsUser = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
        if($getDoctorAsUser) {
            $row = mysqli_fetch_assoc($getDoctorAsUser);
            $user_id = $row['id'];
            $name = $row['name'];
            $username = $row['username'];
            
            $getDoctor = mysqli_query($conn, "SELECT * FROM doctors WHERE user_id = $user_id");
            if($getDoctor) {
                $row = mysqli_fetch_assoc($getDoctor);
                $doctor_id = $row['doctor_id'];
                $years_of_experience = $row['years_of_experience'];

                $patientsUnderDoctor = mysqli_query($conn, "SELECT * FROM patients WHERE doctor_id = $doctor_id");
                if($patientsUnderDoctor) {
                    $totalPatients = mysqli_num_rows($patientsUnderDoctor);
                }

                $bmiValuesByDoctor = mysqli_query($conn, "SELECT * FROM bmi WHERE added_by = $id");
                if($patientsUnderDoctor) {
                    $totalBMIValuesRecorded = mysqli_num_rows($bmiValuesByDoctor);
                }
            }
        }
    }
?>

    <div id="overview" class="my-5">
        <div class="container my-5">
            <div class="row d-flex">
                <div class="col-md-3 sticky-top">
                    <?php include('includes/sidebar.php');?>                    
                </div>
                <div class="col-md-9">
                    <h4 class="pb-1">List of Patients under your inspection</h4>
                    <hr>
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead class="bg-dark bg-gradient text-white">
                                <th></th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Sex</th>
                                <th>Diagnosis</th>
                                <th>Height</th>
                                <th>Weight</th>
                                <th>BMI Value</th>
                                <th>Created Date</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $fetchPatients = mysqli_query($conn, "SELECT u.id, u.name, u.age, u.sex, u.diagnosis, b.height, b.weight, b.bmi_value, u.created_date FROM users u INNER JOIN bmi b ON u.id = b.user_id INNER JOIN patients p ON u.id = p.user_id INNER JOIN doctors d ON p.doctor_id = $id");
                                    if($fetchPatients) {
                                        while($row = mysqli_fetch_assoc($fetchPatients)){
                                            $id = $row['id'];
                                            $name = $row['name'];
                                            $age = $row['age'];
                                            $sex = $row['sex'];
                                            $diagnosis = $row['diagnosis'];
                                            $height = $row['height'];
                                            $weight = $row['weight'];
                                            $bmi_value = $row['bmi_value'];
                                            $created_date = $row['created_date'];
                                        }
                                        ?>
                                        <tr>
                                            <td class="text-center"><a class="text-dark" href="bmi.php?user_id=<?=$id;?>" target="_blank" style="text-decoration: none;font-size:20px" title="Check BMI Trend">&#10148;</a>
                                            <td><?=$name;?></td>
                                            <td><?=$age;?></td>
                                            <td style="text-transform:capitalize"><?=$sex;?></td>
                                            <td><?=$diagnosis;?></td>
                                            <td><?=$height;?></td>
                                            <td><?=$weight;?></td>
                                            <td><?=$bmi_value;?></td>
                                            <td><?=$created_date;?></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php
    include('includes/footer.php');
?>