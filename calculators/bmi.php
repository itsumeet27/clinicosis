<?php 
    session_start();
    include('../includes/header.php');
    include('../includes/dbconfig.php');

    $doctor_id = 0;
?>
    <div style="height: 35vh; background-image: url(https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80); background-size: cover; background-position: center;" class="position-relative w-100">
        <div class="position-absolute text-white d-flex flex-column align-items-start justify-content-center" style="top: 0; right: 0; bottom: 0; left: 0; background-color: rgba(0,0,0,.7);">
            <div class="container mt-5">
                <div class="col-md-12 text-center">
                    <h1 class="">Body Mass Index (BMI)
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-5 p-4">
                <div class="calculator-details">
                    <h4 class="h4-responsive">What is Body Mass Index (BMI)?</h4>
                    <p class="mt-3">Body mass index is a value derived from the mass and height of a person. The BMI is defined as the body mass divided by the square of the body height, and is expressed in units of kg/m²</p>
                </div>
                <div class="calculator-details mt-5">
                    <h4 class="h4-responsive">Why Body Mass Index (BMI) is important?</h4>
                    <p class="mt-3">BMI is an estimate of body fat and a good gauge of your risk for diseases that can occur with more body fat. The <b>higher your BMI</b>, the higher your risk for certain diseases such as <b>heart disease, high blood pressure, type 2 diabetes, gallstones, breathing problems, and certain cancers</b>.</p>
                </div>
                <div class="calculator-details mt-5">
                    <h4 class="h4-responsive">Is Body Mass Index reliable?</h4>
                    <p class="mt-3">For most adults, BMI gives a good estimate of your weight-related health risks. If your <b>BMI is over 35</b>, your weight is definitely putting your <b>health at risk</b>, regardless of the factors below. However, there are some situations where BMI may underestimate or overestimate these risks in the 25-35 BMI range. The main ones are:</p>
                </div>
            </div>
            <div class="col-md-7 p-4">
                <div class="card p-3 border-0 shadow rounded-0">
                    <div class="row">
                        <div class="col-md-6">
                            <form class="form" method="post" id="bmi_form">
                                <div class="form-group">
                                    <input type="text" class="form-control mt-2 bmi" name="weight" id="weight" placeholder="Weight (in kgs)" required>
                                </div>
                                <div class="form-group mt-4">
                                    <input type="text" class="form-control mt-2 bmi" name="height" id="height" placeholder="Height (in m)" required>
                                </div>
                                <div class="d-flex">
                                    <button type="button" id="calculate_bmi" class="btn btn-sm btn-primary mt-4 rounded-0 py-2 px-3" name="calculate_bmi" onclick="calculateBMI()" value="Calculate" style="margin-right: 10px">Calculate BMI</button>
                                    <button type="button" id="open_save_bmi" class="btn btn-sm btn-success mt-4 rounded-0 py-2 px-3" name="open_save_bmi"<?php if(!isset($_SESSION['id'])) { ?> data-bs-toggle="modal" data-bs-target="#loginModal" <?php } else ?> data-bs-toggle="modal" data-bs-target="#saveBmiModal">Save BMI</button>
                                </div>
                            </form>
                            <div class="bmi_result my-3">
                                <p class="alert alert-primary">Your BMI value is: <b id="bmi_result">0</b> kg/m<sup>2</sup>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-4">BMI Categories</h4>
                            <div class="bmi_details">
                                <ul>
                                    <li>BMI Value <= 18.5 or 19: <b class="text-warning">Underweight</b></li>
                                    <li>BMI Value = 19 to 24.9: <b class="text-success">Normal (Fit Body)</b></li>
                                    <li>BMI Value = 25 to 29.5: <b class="text-danger">Overweight</b></li>
                                    <li>BMI Value > 30: <b class="text-dark">Obesity</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="saveBmiModal" tabindex="-1" aria-labelledby="saveBmiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Save Result</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">                        
                        <div class="mb-3">
                            <div>
                                <?php 
                                    if(isset($_SESSION['id'])) { 
                                        $user_id = $_SESSION['id'];
                                        $getDoctor = mysqli_query($conn, "SELECT * FROM doctors WHERE user_id = $user_id");
                                        if(mysqli_num_rows($getDoctor) > 0) {
                                            $row = mysqli_fetch_assoc($getDoctor);
                                            $doctor_id = $row['doctor_id'];
                                            ?>                                                 
                                            <div class="mb-3">
                                                <label for="save-for" class="form-label">Save Result For</label>
                                                <select name="save-for" id="save-for" class="form-control" onchange='saveDataFor()'>
                                                    <option name="n/a" value="N/A">Select Patient or Doctor</option>
                                                    <option name="patient" value="patient">Patient</option>
                                                    <option name="self" value="self">Self</option>
                                                </select>
                                            </div>
                                            <div id="patient-dropdown">
                                                <div class="form-group mb-3">
                                                    <?php
                                                        $fetchPatients = mysqli_query($conn, "SELECT u.name, u.id FROM users u INNER JOIN patients p ON u.id = p.user_id WHERE p.doctor_id = $user_id");
                                                        if(mysqli_num_rows($fetchPatients) > 0) {
                                                        ?>
                                                        <label for="select_patient" class="form-label">Select Patient</label>
                                                        <select name="select_patient" id="select_patient" class="form-control" onchange='saveDataFor()'>
                                                            <option value="N/A">Select Patient</option>
                                                            <?php while($row = mysqli_fetch_assoc($fetchPatients)): ?>
                                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                    <?php } else { ?>
                                                    <p class="alert alert-danger mt-2 p-2 px-3" style="font-size: 13px">Currently, you have no patients assigned</p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div id="patient_records">
                                                <div class="mb-3">
                                                    <label for="patient-name" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="patient-name" name="patient-name" placeholder="Enter Patient Name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="patient-age" class="form-label">Age</label>
                                                    <input type="number" class="form-control" id="patient-age" name="patient-age" placeholder="Enter Patient Age" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="patient-username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" id="patient-username" name="patient-username" placeholder="Enter Patient Username" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="patient-sex" class="form-label">Sex</label>
                                                    <select name="patient-sex" id="patient-sex" class="form-control" required> 
                                                        <option value="N/A">Select Patient Sex</option>
                                                        <option name="male" value="male">Male</option>
                                                        <option name="female" value="female">Female</option>
                                                        <option name="other" value="other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="patient-diagnosis" class="form-label">Diagnosis</label>
                                                    <input type="text" class="form-control" id="patient-diagnosis" name="patient-diagnosis" placeholder="Enter Patient Diagnosis" required>
                                                </div>
                                            </div>
                                            <?php
                                        } else {
                                            echo "<p class='py-2'>Do you want to save your bmi value</p>";
                                        }                                         
                                    }
                                ?>
                            </div>
                        </div>
                        
                        <div id="save-response"></div>
                        <button type="button" class="btn btn-success" name="save_patient_submit" onclick="<?php if($doctor_id != 0) { ?>saveBMI()<?php } else { ?>saveUserBMI()<?php }?>">Submit</button>
                        <div id="save_bmi_result"></div>
                        <div id="login_message"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        function calculateBMI() {
            var height = document.getElementById("height").value;
            var weight = document.getElementById("weight").value;

            if(height != "" && weight != "") {
                $.post("../includes/calculations/bmi_submit.php", { 
                    weight: weight, 
                    height: height
                },
                function(data) {
                    $('#bmi_result').html(data);
                });
            }
        }

        function saveUserBMI() {
            var height = $("#height").val();
            var weight = $("#weight").val();
            var saveDataFor = "self"

            if(height != "" && weight != "") {
                $.post("../includes/calculations/save_bmi.php", {
                    weight: weight, 
                    height: height,
                    saveDataFor: saveDataFor
                },
                function(data) {
                    $('#save_bmi_result').html(data);
                });
            }
        }

        function saveBMI() {
            var name = $('#patient-name').val();
            var age = $('#patient-age').val();
            var username = $('#patient-username').val();
            var sex = $('#patient-sex').val();
            var diagnosis = $('#patient-diagnosis').val();

            var saveDataFor = document.getElementById("save-for").value;
            var selected_patient = document.getElementById("select_patient").value;

            var height = $("#height").val();
            var weight = $("#weight").val();

            if(height != "" && weight != "") {
                $.post("../includes/calculations/save_bmi.php", { 
                    name: name,
                    age: age,
                    username: username,
                    sex: sex,
                    diagnosis: diagnosis,
                    weight: weight, 
                    height: height,
                    saveDataFor: saveDataFor,
                    selected_patient: selected_patient
                },
                function(data) {
                    $('#save_bmi_result').html(data);
                });
            }
        }

        function saveDataFor() {
            var saveDataFor = document.getElementById("save-for").value;
            <?php
                if(mysqli_num_rows($fetchPatients) > 0):
            ?>
            var savePatient = document.getElementById("select_patient").value;

            if(savePatient == undefined) {
                savePatient = "";
            }
            <?php endif; ?>

            if(saveDataFor != "N/A" || savePatient != "N/A") {
                $.post("../includes/check-patient.php", {
                    saveDataFor: saveDataFor,
                    savePatient: savePatient
                },
                function(data) {
                    $('#save-response').html(data);
                });
            }
        }
    </script>


<?php include('../includes/footer.php')?>