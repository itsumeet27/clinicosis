<!doctype html>
<?php
    include('../includes/dbconfig.php');

    $doctor_id = 0;
    if(isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];

        $getUser = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
        if($getUser) {
            $row = mysqli_fetch_assoc($getUser);
            $user_id = $row['id'];
            $name = $row['name'];
            $username = $row['username'];
            
            $getDoctor = mysqli_query($conn, "SELECT * FROM doctors WHERE user_id = $user_id");
            if(mysqli_num_rows($getDoctor) > 0) {
                $row = mysqli_fetch_assoc($getDoctor);
                $doctor_id = $row['doctor_id'];
                $years_of_experience = $row['years_of_experience'];
            }
        }
    }
?>
    <div class="card shadow border-0">
        <div class="profile">
            <div class='profile-image'>
                <img src="../assets/images/profile.jpg" class="img-fluid img-responsive p-5" style="height:300px;width:300px;border-radius:50%" />
            </div>            
            <h5 class="text-center"><?=$name;?></h5>
            <p class="text-center mb-3"><?=$username;?>
            <div class="menu-items">
                <ul class="p-0 mb-0" style="list-style: none">
                    <li class="nav-item py-2 mt-2 bg-secondary text-white"><a class="nav-link py-2 px-3" href="index.php">Home</a></li>
                    <li class="nav-item py-2 mt-2 bg-secondary text-white"><a class="nav-link py-2 px-3" href="bmi.php">Your BMI</a></li>
                    <?php if($doctor_id != 0):?>
                    <li class="nav-item py-2 mt-2 bg-secondary text-white"><a class="nav-link py-2 px-3" href="patients.php">Patients</a></li>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['id'])):?>
                    <li class="nav-item py-2 mt-2 bg-secondary text-white"><a class="nav-link py-2 px-3" href="../logout.php">Logout</a></li>
                    <?php endif; ?>
                    <!-- <li class="nav-item bg-light py-2 my-2"><a class="nav-link py-1 px-3" href="bmi.php">BMI</a></li> -->
                </ul>
            </div>
        </div>
    </div>
        

