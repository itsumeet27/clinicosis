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
                <h1 class="mb-4 mt-2 font-weight-bold welcome-text" style="font-family: Poppins">Welcome to <span style="color: #9B5DE5;">Clinicosis</span></h1>
                <p style="color: #bbb;font-family: Montserrat">
                    We are group of translational-researchers who create affordable healthcare and indigenous technologies to offer world-class products to the society.
                </p>
                <div class="mt-5">
                    <!-- hover background-color: white; color: black; -->
                    <a href="#calculators" class="btn px-5 py-3 mt-3 text-dark mt-sm-0 bg-light bg-gradient" style="border-radius: 30px;font-weight:600;font-family: Poppins;">Get Started</a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="container" style="padding-top:3rem" id="aspire">
        <div class="aspirations my-5">
            <div class="section-head text-center">
                <h2 class="p-3 mt-4" style="font-family: Poppins"><b>The Practice</b></h2>
                <p class="px-2" style="font-family: Montserrat;">When you choose us, you join a community. We work not just with you but with other members of our community to build a network of people working together for a healthier world.</p>
            </div>
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card shadow border-0 h-100 mt-3">
                        <img src="assets/images/mission.webp" class="img-fluid img-responsive" />
                        <h5 class="h5-responsive p-3">Our Mission</h5>
                        <p class="px-3">Our experienced medical professionals put your healing needs first. We are proud to provide a high quality level of customer service, clinical practice experience, and commitment to health and wellness to all our clients. Our goal is to make you feel easy and upgraded from a traditional stethoscope to an advance one</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow border-0 h-100 mt-3">
                        <img src="assets/images/experience-and-professionalism.webp" class="img-fluid img-responsive" />
                        <h5 class="h5-responsive p-3">Experience and Professionalism</h5>
                        <p class="px-3">With years of experience, our medical team will assess you and create a custom recovery plan that's right for you. We understand the importance of educating you on the most effective ways to take care of your body, so that you can heal quickly.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow border-0 h-100 mt-3">
                        <img src="assets/images/physicians.webp" class="img-fluid img-responsive" />
                        <h5 class="h5-responsive p-3">Physicians Who Care</h5>
                        <p class="px-3">Not only will our doctors treat your existing conditions, we also work to maximize your prevention strategies. We strive to help you improve your quality of life, achieve your wellness goals, and support your best possible life.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="padding-top:3rem" id="calculators">
        <div class="calculators my-5">
            <div class="section-head text-center">
                <h2 class="p-3 mt-4" style="font-family: Poppins"><b>Medical Calculators</b></h2>
                <p class="px-2" style="font-family: Montserrat;">A single stop solution to calculate important factors that help you understand where and how you can work to make a healthy life!</p>
            </div>            
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card shadow rounded-0 h-100 border-0 mt-3">
                        <div class="card-header p-3 bg-secondary bg-gradient" style="font-family: Poppins;">
                            <h5 class="card-title py-2 mb-0 text-white">
                                BMI (Body Mass Index)
                            </h5>
                        </div>
                        <div class="card-body">
                            <p style="font-family: Montserrat;line-height:1.6rem">
                                Body mass index is a value derived from the mass and height of a person. The BMI is defined as the body mass divided by the square of the body height, and is expressed in units of kg/m².
                            </p>
                        </div>
                        <div class="card-footer bg-white bg-gradient p-3">
                            <a href="calculators/bmi.php" target="_blank" class="btn btn-md bg-dark text-white border-0 rounded-0 py-3 px-4" style="font-family: Poppins">Calculate Now</a>
                        </div>
                    </div>                        
                </div>
                <div class="col-md-4">
                    <div class="card shadow rounded-0 h-100 border-0 mt-3">
                        <div class="card-header p-3 bg-secondary bg-gradient" style="font-family: Poppins;">
                            <h5 class="card-title py-2 mb-0 text-white">
                                WHR (Waist-Hip Ratio)
                            </h5>
                        </div>
                        <div class="card-body">
                            <p style="font-family: Montserrat;line-height:1.6rem">The waist-to-hip ratio (WHR) calculation is one way your doctor can see if excess weight is putting your health at risk. It determines how much fat is stored on your waist, hips, and buttocks.</p>
                        </div>
                        <div class="card-footer bg-white bg-gradient p-3">
                            <a href="calculators/whr.php" target="_blank" class="btn btn-md bg-dark text-white border-0 rounded-0 py-3 px-4" style="font-family: Poppins">Calculate Now</a>
                        </div>
                    </div>                        
                </div>
                <div class="col-md-4">
                    <div class="card shadow rounded-0 h-100 border-0 mt-3">
                        <div class="card-header p-3 bg-secondary bg-gradient" style="font-family: Poppins;">
                            <h5 class="card-title py-2 mb-0 text-white">
                                CBC (Complete Body Count)
                            </h5>
                        </div>
                        <div class="card-body">
                            <p style="font-family: Montserrat;line-height:1.6rem">A complete blood count, also known as a full blood count, is a set of medical laboratory tests that provide information about the cells in a person's blood. The CBC indicates the counts of white blood cells, red blood cells and platelets, the concentration of hemoglobin, and the hematocrit.</p>
                        </div>
                        <div class="card-footer bg-white bg-gradient p-3">
                            <a href="calculators/cbc.php" target="_blank" class="btn btn-md bg-dark text-white border-0 rounded-0 py-3 px-4" style="font-family: Poppins">Calculate Now</a>
                        </div>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
<?php
    include('includes/footer.php');
?>