<?php
    include('includes/header.php');
    include('../includes/dbconfig.php');

    $doctor_id = 0;
    $bmi_value = 0;
    $age = "N/A";
    $sex = "N/A";
    $diagnosis = "N/A";
    $height = "N/A";
    $weight = "N/A";
    $bmi_value = "N/A";
    
    $totalPatients = 0;
    $totalBMIValuesRecorded = 0;

    if(isset($_SESSION['id'])) {
        $id = $_SESSION['id'];

        $getUser = mysqli_query($conn, "SELECT u.id, u.name, u.username, u.age, u.sex, u.diagnosis, b.height, b.weight, b.bmi_value FROM users u INNER JOIN bmi b ON u.id = b.user_id WHERE u.id = $id ORDER BY b.created_date DESC");
        if(mysqli_num_rows($getUser) > 0) {
            $row = mysqli_fetch_assoc($getUser);
            $user_id = $row['id'];
            $name = $row['name'];
            $username = $row['username'];
            $age = $row['age'];
            $sex = $row['sex'];
            $diagnosis = $row['diagnosis'];
            $height = $row['height'];
            $weight = $row['weight'];
            $bmi_value = $row['bmi_value'];
            
            $getDoctor = mysqli_query($conn, "SELECT * FROM doctors WHERE user_id = $user_id");
            if(mysqli_num_rows($getDoctor) > 0) {
                $row = mysqli_fetch_assoc($getDoctor);
                $doctor_id = $row['doctor_id'];
                $years_of_experience = $row['years_of_experience'];

                $patientsUnderDoctor = mysqli_query($conn, "SELECT * FROM patients WHERE doctor_id = $user_id");
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
                    <?php if($doctor_id != 0): ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card shadow border-0 bg-primary bg-gradient text-white">
                                <div class="text-center mt-3" style="height:100px;width:100px;margin:0 auto">
                                    <p class="p-4" style="border:2px solid; border-radius:50px;width: 80px;height: 80px;"><b><?=$totalPatients;?></b></p>
                                </div>
                                <h6 class="py-2 text-center">Total No. of Patients</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow border-0 bg-secondary bg-gradient text-white">
                                <div class="text-center mt-3" style="height:100px;width:100px;margin:0 auto">
                                        <p class="p-4" style="border:2px solid; border-radius:50px;width: 80px;height: 80px;"><b><?=$totalBMIValuesRecorded;?></b></p>
                                </div>
                                <h6 class="py-2 text-center">Total No. of BMI Values Recorded</h6>
                            </div>                      
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow border-0 bg-success bg-gradient text-white">
                                <div class="text-center mt-3" style="height:100px;width:100px;margin:0 auto">
                                        <p class="p-4" style="border:2px solid; border-radius:50px;width: 80px;height: 80px;"><b><?=$years_of_experience;?></b></p>
                                </div>
                                <h6 class="py-2 text-center">Total Years of Experience</h6>
                            </div>                      
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="profile-details">
                        <h4 class="h4-responsive py-2">Profile Details</h4>
                        <hr style="border-width:3px;width:200px">
                        <div class="profile-section pt-2 d-flex">
                            <div class="ml-0"><b>Name:&nbsp;</b><?= $name; ?></div>
                            <div class="mx-3"><b>Age:&nbsp;</b><?= $age; ?></div>
                            <div class="mx-3"><b>Sex:&nbsp;</b><?= $sex; ?></div>
                            <div class="mx-3"><b>Diagnosis:&nbsp;</b><?= $diagnosis; ?></div>
                            <div class="mx-3"><b>Height:&nbsp;</b><?= $height; ?></div>
                            <div class="mx-3"><b>Weight:&nbsp;</b><?= $weight; ?></div>
                            <div class="mx-3"><b>BMI Value:&nbsp;</b><?= $bmi_value; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php
    include('includes/footer.php');
?>