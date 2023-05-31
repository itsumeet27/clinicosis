<?php
    session_start();
    require_once('../includes/dbconfig.php');

    $save_for = $_POST['saveDataFor'];
    $save_patient = $_POST['savePatient'];
    
    if(isset($_SESSION['id'])) {
        $id = $_SESSION['id'];

        if($save_for == "self") {
            echo "
            <script>
                document.getElementById('patient_records').style.display='none';
                document.getElementById('patient-dropdown').style.display='none'
            </script>";
        } else {
            echo "<script>document.getElementById('patient_records').style.display='block'</script>";
            echo "<script>document.getElementById('patient-dropdown').style.display='block'</script>";
        }
        
        if($save_patient != "N/A") {
            echo "<script>document.getElementById('patient_records').style.display='none'</script>";
        } else {
            echo "<script>document.getElementById('patient_records').style.display='display'</script>";
        }
    }

?>