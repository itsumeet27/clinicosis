<!doctype html>
<?php
    include('../includes/dbconfig.php');

    if(isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];

        $getDoctor = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
        if($getDoctor) {
            $row = mysqli_fetch_assoc($getDoctor);
            $name = $row['name'];
            $username = $row['username'];
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
                    <li class="nav-item py-2 mt-2 bg-secondary text-white"><a class="nav-link py-2 px-3" href="doctor.php">Home</a></li>
                    <li class="nav-item py-2 mt-2 bg-secondary text-white"><a class="nav-link py-2 px-3" href="patients.php">Patients</a></li>
                    <?php if(isset($_SESSION['id'])):?>
                    <li class="nav-item py-2 mt-2 bg-secondary text-white"><a class="nav-link py-2 px-3" href="../logout.php">Logout</a></li>
                    <?php endif; ?>
                    <!-- <li class="nav-item bg-light py-2 my-2"><a class="nav-link py-1 px-3" href="bmi.php">BMI</a></li> -->
                </ul>
            </div>
        </div>
    </div>
        

