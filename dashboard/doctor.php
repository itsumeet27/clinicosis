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
                    
                </div>
            </div>
        </div>
    </div>
    
<?php
    include('includes/footer.php');
?>