<?php 
    include('../includes/header.php');
    include('../includes/dbconfig.php');
    if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
        $id = $_SESSION['id'];
        $username = $_SESSION['username'];
        
        if(isset($_POST['calculate_bmi'])) {
            $weight = $_POST['weight'];
            $height = $_POST['height'];
            
            $height_square = pow($height,2);
    
            $bmi = (float)($weight/$height_square);
            $bmi_value = number_format($bmi, 2, '.', '');
    
            $update = "UPDATE users SET bmi = $bmi_value WHERE id = $id";
            $update_result = mysqli_query($conn, $update);
            if($update_result) {
                echo "<script>alert('Your bmi value has been saved successfully')</script>";
            }
        }
?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Calculate your BMI</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" method="post">
                            <div class="form-group">
                                <label for="weight">Enter your weight (in kgs)
                                <input type="text" class="form-control" name="weight" id="weight">
                            </div>
                            <div class="form-group mt-3">
                                <label for="height">Enter your height (in m)
                                <input type="text" class="form-control" name="height" id="height">
                            </div>
                            <input type="submit" class="btn btn-md btn-success mt-3" name="calculate_bmi" value="Calculate" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<?php } include('../includes/footer.php')?>