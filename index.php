<?php
    include('includes/header.php');
    include('includes/dbconfig.php');
?>
    <div class="container">
        <h1 class="text-center p-3">
            <?php 
                if(isset($_SESSION['username'])) {
                    echo "Hello ",$_SESSION['name'], "! ";
                }
            ?>Welcome to Clinicosis!</h1>
        <h4 class="text-center ">A single stop solution for Medical Calculator</h4>
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
                
            ?>
                <div class="row mt-5">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title text-center">
                                    BMI (Body Mass Index)
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="text-center">Your current BMI value is: <?php echo $bmi; ?></p>
                            </div>
                        </div>
                            
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title text-center">
                                    WHR (Waist-Hip Ratio)
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="text-center">Your current WHR value is: <?php echo $whr; ?></p>
                            </div>
                        </div>
                            
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title text-center">
                                    CBC (Complete Body Count)
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="text-center">
                                    <?php 
                                        if($cbc == "") { 
                                            echo "No value or details for your CBC. Please enter now";
                                        } else {
                                            echo "Your CBC value is: ", $cbc;
                                        }
                                        
                                    ?>
                                </p>
                            </div>
                        </div>
                            
                    </div>
                </div>
            <?php
            }
        ?>
    </div>
<?php
    include('includes/footer.php');
?>