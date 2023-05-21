<?php 
    session_start();
    include('../includes/header.php');
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
                                    <input type="button" id="calculate_bmi" class="btn btn-md btn-primary mt-4 rounded-0 py-3 px-5" name="calculate_bmi" onclick="calculateBMI()" value="Calculate" style="margin-right: 10px" />
                                </div>
                            </form>
                            <div class="bmi_result my-3" id="bmi_result">
                                <p class="alert alert-primary">Your BMI value is: <b id="bmi_result">0</b>
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
    
    <script type="text/javascript">
        function calculateBMI() {
            var height = $("#height").val();
            var weight = $("#weight").val();

            if(height != "" && weight != "") {
                $.post("../includes/bmi_submit.php", { 
                weight: weight, 
                height: height
                },
                function(data) {
                    $('#bmi_result').html(data);
                });
            }
                        
            
        }
    </script>

<?php include('../includes/footer.php')?>