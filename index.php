<?php
    session_start();
    include('includes/header.php');
    include('includes/dbconfig.php');
?>
    <div style="height: 100vh; background-image: url(https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80); background-size: cover; background-position: center;" class="position-relative w-100">
        <div class="position-absolute text-white d-flex flex-column align-items-start justify-content-center" style="top: 0; right: 0; bottom: 0; left: 0; background-color: rgba(0,0,0,.7);">
            <div class="container">
            <div class="col-md-6">
                <span style="color: #bbb;" class="text-uppercase">
                    <?php 
                        if(isset($_SESSION['username'])) {
                            echo "Hello ",$_SESSION['name'], "! ";
                        }
                    ?>
                </span>
                <!-- on small screens remove display-4 -->
                <h1 class="mb-4 mt-2 display-4 font-weight-bold">Welcome to <span style="color: #9B5DE5;">Clinicosis</span></h1>
                <p style="color: #bbb;">
                    We are group of translational-researchers who create affordable healthcare and indigenous technologies to offer world-class products to the society.
                </p>
                <div class="mt-5">
                    <!-- hover background-color: white; color: black; -->
                    <a href="#calculators" class="btn px-5 py-3 text-white mt-3 mt-sm-0" style="border-radius: 30px; background-color: #9B5DE5;">Get Started</a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="container">
        <?php 
            if(isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                
                $bmi = 0;
                $whr = 0;
                $cbc = "";
                
                $query = "SELECT * FROM users WHERE id = $id";
                $result = mysqli_query($conn, $query);
                if($result) {
                    $row = mysqli_fetch_assoc($result);
                    $bmi = $row['bmi'];
                    $whr = $row['whr'];
                    $cbc = $row['cbc'];
                }
            }
                
        ?>
        <div class="calculators my-5" id="calculators">
            <div class="section-head text-center">
                <h2 class="p-3 mt-4">Medical Calculators</h2>
                <p class="px-2">A single stop solution to calculate important factors that help you understand where and how you can work to make a healthy life!</p>
            </div>            
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card shadow rounded-0 h-100">
                        <div class="card-header">
                            <h5 class="card-title p-2 mb-0">
                                BMI (Body Mass Index)
                            </h5>
                        </div>
                        <div class="card-body">
                            <p>
                                Body mass index is a value derived from the mass and height of a person. The BMI is defined as the body mass divided by the square of the body height, and is expressed in units of kg/m².
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="calculators/bmi.php" target="_blank" class="btn btn-md btn-success border-0 rounded-0 py-2">Calculate Now</a>
                        </div>
                    </div>                        
                </div>
                <div class="col-md-4">
                    <div class="card shadow rounded-0 h-100">
                        <div class="card-header">
                            <h5 class="card-title p-2 mb-0">
                                WHR (Waist-Hip Ratio)
                            </h5>
                        </div>
                        <div class="card-body">
                            <p>The waist-to-hip ratio (WHR) calculation is one way your doctor can see if excess weight is putting your health at risk. It determines how much fat is stored on your waist, hips, and buttocks.</p>
                        </div>
                        <div class="card-footer">
                            <a href="calculators/whr.php" target="_blank" class="btn btn-md btn-success border-0 rounded-0 py-2">Calculate Now</a>
                        </div>
                    </div>                        
                </div>
                <div class="col-md-4">
                    <div class="card shadow rounded-0 h-100">
                        <div class="card-header">
                            <h5 class="card-title p-2 mb-0">
                                CBC (Complete Body Count)
                            </h5>
                        </div>
                        <div class="card-body">
                            <p>A complete blood count, also known as a full blood count, is a set of medical laboratory tests that provide information about the cells in a person's blood. The CBC indicates the counts of white blood cells, red blood cells and platelets, the concentration of hemoglobin, and the hematocrit.</p>
                        </div>
                        <div class="card-footer">
                            <a href="calculators/cbc.php" target="_blank" class="btn btn-md btn-success border-0 rounded-0 py-2">Calculate Now</a>
                        </div>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
<?php
    include('includes/footer.php');
?>