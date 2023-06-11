<?php
    include('includes/header.php');
    include('../includes/dbconfig.php');

    $height = "N/A";
    $weight = "N/A";
    $bmi_value = "N/A";

    $url = $_SERVER['REQUEST_URI'];
    $token = explode("?", $url);
    $patient_id = explode("=", $token[1])[1];
?>
    <div id="overview" class="my-5">
        <div class="container my-5">
        <div class="row d-flex">
                <div class="col-md-3 sticky-top">
                    <?php include('includes/sidebar.php');?>                    
                </div>
                <div class="col-md-9">
                    <div class="bmi-details">
                        <h4 class="h4-responsive py-2">BMI Details</h4>
                        <hr style="border-width:3px;width:200px">
                        <div class="bmi-section pt-2 d-flex">
                            <?php
                                if(isset($_SESSION['id'])) {
                                    $id = $_SESSION['id'];

                                    if($patient_id != "") {
                                        $getUser = mysqli_query($conn, "SELECT u.id, u.name, u.username, b.height, b.weight, b.bmi_value, b.created_date FROM users u INNER JOIN bmi b WHERE u.id = $patient_id ORDER BY b.created_date DESC");
                                    } else {
                                        $getUser = mysqli_query($conn, "SELECT u.id, u.name, u.username, b.height, b.weight, b.bmi_value, b.created_date FROM bmi b INNER JOIN users u ON b.user_id = u.id WHERE u.id = $id ORDER BY b.created_date DESC");
                                    }

                                    $row = mysqli_fetch_assoc($getUser);
                                    $user_id = $row['id'];
                                    $name = $row['name'];
                                    $height = $row['height'];
                                    $weight = $row['weight'];
                                    $bmi_value = $row['bmi_value']; 
                                }
                            ?>
                            <div class="ml-0"><b>Patient Name:&nbsp;</b><?= $name; ?></div>
                            <div class="mx-3"><b>Height:&nbsp;</b><?= $height; ?></div>
                            <div class="mx-3"><b>Weight:&nbsp;</b><?= $weight; ?></div>
                            <div class="mx-3"><b>BMI Value:&nbsp;</b><?= $bmi_value; ?></div>
                        </div>
                    </div>
                    <div class="bmi-chart mt-4">
                        <h4 class="h4-responsive py-2">BMI Chart</h4>
                        <hr style="border-width:3px;width:200px">
                        
                        <script type="text/javascript">
                            google.charts.load('current', {'packages':['corechart']});
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                ['Created Date', 'Body Mass Index (BMI)'],
                                <?php
                                    $getUserBMI = mysqli_query($conn, "SELECT u.id, u.name, u.username, b.height, b.weight, b.bmi_value, b.created_date FROM bmi b INNER JOIN users u ON b.user_id = u.id WHERE u.id = $user_id");
                                    if(mysqli_num_rows($getUserBMI) > 0){
                                        while($user = mysqli_fetch_assoc($getUserBMI)){
                                            echo "['".date("M d Y g:i:s A", strtotime($user['created_date']))."', ".$user['bmi_value']."],";
                                        }
                                    }
                                ?>
                                ]);

                                var options = {
                                    curveType: 'function',
                                    hAxis: {
                                        title: 'Date',
                                        titleTextStyle: {
                                            italic: false,
                                            fontSize: 16
                                        },
                                    },
                                    vAxis: {
                                        title: 'Body Mass Index (BMI)',
                                        titleTextStyle: {
                                            italic: false,
                                            fontSize: 16
                                        }
                                    },
                                    legend: { position: 'top' }
                                };

                                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                                chart.draw(data, options);
                            }
                        </script>
                        <div class="pt-2">
                            <?php if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bmi WHERE user_id = $id")) > 0): ?>
                            <div id="curve_chart" style="width: 100%; height: 480px"></div>
                            <?php else: ?>
                            <div class="alert alert-primary mt-3">We don't have your BMI value saved with us. To see the trend in your BMI <a href="../calculators/bmi.php">click here</a>.
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php
    include('includes/footer.php');
?>