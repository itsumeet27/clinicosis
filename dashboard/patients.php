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
                                <th>Name</th>
                                <th>Age</th>
                                <th>Sex</th>
                                <th>Diagnosis</th>
                                <th>Created Date</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $fetchPatients = mysqli_query($conn, "SELECT u.name, u.age, u.sex, u.diagnosis, u.created_date FROM users u INNER JOIN patients p ON u.id = p.user_id INNER JOIN doctors d ON p.doctor_id = $id");
                                    if($fetchPatients) {
                                        while($row = mysqli_fetch_assoc($fetchPatients)){
                                        ?>
                                        <tr>
                                            <td><?=$row['name'];?></td>
                                            <td><?=$row['age'];?></td>
                                            <td style="text-transform:capitalize"><?=$row['sex'];?></td>
                                            <td><?=$row['diagnosis'];?></td>
                                            <td><?=$row['created_date'];?></td>
                                        </tr>
                                        <?php
                                        }
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