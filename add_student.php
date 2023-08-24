<?php

session_start();

if(isset($_SESSION) && isset($_SESSION['email'])){ 

require_once('./includes/db.php');

$role = $location = $dob = $gender = $section = $student_father_name = $student_mother_name = $contact = $teacher_name = $teacher_contact = $stu_uniID = $mctsNo = $ad_number =  '';

if($_SERVER['REQUEST_METHOD'] == "POST"){

    var_dump($_POST);
    // var_dump($_FILES);

    $role = $_POST['role'];
    $location = $_POST['location'];
    $student_name = $_POST['student_name'];
    $dob = $_POST['dob'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $std = $_POST['std'];
    $section = $_POST['section'];
    $student_father_name = $_POST['student_father_name'];
    $student_mother_name = $_POST['student_mother_name'];
    $contact = $_POST['contact'];
    $teacher_name = $_POST['teacher_name'];
    $teacher_contact = $_POST['teacher_contact'];
    $file = $_FILES['file']['name'];
    $stu_uniID = str_replace('/', '',$_POST['stu_uniID']);
    $mctsNo = $_POST['mctsNo'];
    $ad_number = str_replace('-', '',$_POST['ad_number']);
    
    echo $stu_uniID;
    // echo $stu_uniID_leangth;

    if($stu_uniID === ""){
        $err = "Please enter Student ID";
    }
    if($ad_number === ""){
            $err = "Please enter Student ID";
    }
    if($role === ""){
        $err = "Please select Role";
    }elseif($location === ""){
        $err = "Please select Location";
    }elseif($student_name == ''){
        $err = "Please Enter Student name";
    }

    $array = [
    'role' => $role, 
    'location' => $location,
    'student_name' => $student_name,
    'dob' => $dob,
    'gender' => $gender,
    'std' => $std,
    'section' => $section,
    'student_father_name' => $student_father_name,
    'student_mother_name' => $student_mother_name,
    'contact' => $contact,
    'teacher_name' => $teacher_name,
    'teacher_contact' => $teacher_contact,
    'file' => $file,
    'stu_uniID' => $stu_uniID,
    'mctsNo' => $mctsNo,
    'ad_number' => $ad_number];


    $findStudent = ['stu_uniID'=>$stu_uniID];
    $data = json_decode($database->getData('student',$findStudent),true);
    foreach($data as $key => $value){
        if(isset($value['stu_uniID']) && $value['stu_uniID'] === $stu_uniID){
            $found_student = true;
        }
    }
    
    if(!isset($err)){
        if(isset($found_student)){
            $success_msg = json_decode($database->updateDataBykeyValue('student',$findStudent,$array),true);
            unset($_POST);
        }else{
            $success_msg = json_decode($database->insertData('student',$array),true);
            unset($_POST);
        }   
    }   
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>Student Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap-4.3.1.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">

        <?php require_once('./includes/sidebar.php'); ?>

        <!-- Page Content  -->
        <div id="content" class="p-4">

            <?php require_once('./includes/header.php'); ?>

            <section class="student_registration styled_box p-4">
                <?php if(isset($err)){ ?>
                <div class="pb-4">
                    <p class="text-danger text-uppercase font-weight-bold"><?= $err ?></p>
                </div>
                <?php } ?>
                <?php if(isset($success_msg) && isset($stu_uniID)){ ?>
                <div class="alert alert-success text-center" role="alert">
                    <?= $success_msg['message']; ?>
                </div>
                <?php } ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"
                    enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select text-capitalize" name="role" id="floatingSelect"
                                            aria-label="Floating label select example">
                                            <option selected value="">Select Role</option>
                                            <?php 
                                            $roleArray = ['admin','teacher','student'];
                                            foreach($roleArray as $value){ 
                                            ?>
                                            <option
                                                <?= isset($_POST['role']) && isset($role) && $_POST['role'] === $value ? 'selected' : '' ?>
                                                value="<?= $value ?>"><?= $value ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="floatingSelect">Role <span
                                                class="text-danger fs-6 font-weight-bold">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select text-capitalize" name="location" id="floatingSelect"
                                            aria-label="Floating label select example">
                                            <option selected value="">Select Location</option>
                                            <?php 
                                            $locationArray = ['mumbai','thane','kurla'];
                                            foreach($locationArray as $value){ 
                                            ?>
                                            <option
                                                <?= isset($_POST['location']) && isset($location) && $_POST['location'] === $value ? 'selected' : '' ?>
                                                value="<?= $value ?>"><?= $value ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="floatingSelect">Location <span
                                                class="text-danger fs-6 font-weight-bold">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="student_name" class="form-control" id="floatingInput"
                                            placeholder="Name of Student"
                                            value="<?= isset($_POST['student_name']) && isset($student_name) && $_POST['student_name'] === $student_name ? $student_name : ''  ?>">
                                        <label for="floatingInput">Name of Student <span
                                                class="text-danger fs-6 font-weight-bold">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" name="dob" class="form-control" id="floatingInput"
                                            placeholder="DOB"
                                            value="<?= (isset($_POST['dob']) && isset($dob) && $_POST['dob'] === $dob) ? $dob : ''  ?>">
                                        <label for="floatingInput">DOB</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 d-flex">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="gender" type="radio"
                                            name="inlineRadioOptions" id="inlineRadio1" value="male"
                                            <?= (isset($_POST['gender']) && isset($gender) && $_POST['gender'] === 'male') ? 'checked' : ''  ?>>
                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="gender" type="radio"
                                            name="inlineRadioOptions" id="inlineRadio2" value="female"
                                            <?= (isset($_POST['gender']) && isset($gender) && $_POST['gender'] === 'female') ? 'checked' : ''  ?>>
                                        <label class="form-check-label" for="inlineRadio2">Female</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select text-capitalize" name="std" id="floatingSelect"
                                            aria-label="Floating label select example">
                                            <option selected value="">Select STD</option>
                                            <?php 
                                            $stdArray = ['first','second','third'];
                                            foreach($stdArray as $value){ 
                                            ?>
                                            <option
                                                <?= isset($_POST['std']) && isset($std) && $_POST['std'] === $value ? 'selected' : '' ?>
                                                value="<?= $value ?>"><?= $value ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="floatingSelect">STD</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" name="section" id="floatingSelect"
                                            aria-label="Floating label select example">
                                            <option selected value="">Select Section</option>
                                            <?php 
                                            $sectionArray = ['A','B','C'];
                                            foreach($sectionArray as $value){ 
                                            ?>
                                            <option
                                                <?= isset($_POST['section']) && isset($section) && $_POST['section'] === $value ? 'selected' : '' ?>
                                                value="<?= $value ?>"><?= $value ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <label for="floatingSelect">Section</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="student_father_name" class="form-control"
                                            id="floatingInput" placeholder="Name of Father/Guardian"
                                            value="<?= isset($_POST['student_father_name']) && isset($student_father_name) &&  $_POST['student_father_name'] === $student_father_name ? $student_father_name : ''  ?>">
                                        <label for="floatingInput">Name of Father/Guardian</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="student_mother_name" class="form-control"
                                            id="floatingInput" placeholder="Name of Mother"
                                            value="<?= isset($_POST['student_mother_name']) && isset($student_mother_name) && $_POST['student_mother_name'] === $student_mother_name ? $student_mother_name : ''  ?>">
                                        <label for="floatingInput">Name of Mother</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="tel" name="contact" class="form-control" id="floatingInput"
                                            placeholder="Contact No"
                                            value="<?= isset($_POST['contact']) && isset($contact) && $_POST['contact'] === $contact ? $contact : ''  ?>">
                                        <label for="floatingInput">Contact No</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="teacher_name" class="form-control" id="floatingInput"
                                            placeholder="Name of teacher"
                                            value="<?= isset($_POST['teacher_name']) && isset($teacher_name) && $_POST['teacher_name'] === $teacher_name ? $teacher_name : ''  ?>">
                                        <label for="floatingInput">Name of teacher</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="teacher_contact" class="form-control"
                                            id="floatingInput" placeholder="Teacher contact"
                                            value="<?= isset($_POST['teacher_contact']) && isset($teacher_contact)  && $_POST['teacher_contact'] === $teacher_contact ? $teacher_contact : ''  ?>">
                                        <label for="floatingInput">Teacher contact</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Default file input example</label>
                                        <input class="form-control" name="file" type="file" id="formFile">
                                        <?= isset($_FILES['file']) && isset($file) && $_FILES['file']['name'] === $file ? "<span>$file</span>" : ''  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="stu_uniID" class="form-label">Student Unique ID (16 Digit) : <span
                                        class="text-danger fs-6 font-weight-bold">*</span></label>
                                <input type="text" name="stu_uniID" id="stu_uniID" class="form-control"
                                    value="<?= isset($_POST['stu_uniID']) && isset($stu_uniID) ? $_POST['stu_uniID'] : ''  ?>"
                                    onkeyup="studentIDFormat()" maxlength="19">
                            </div>
                            <div class="mb-3">
                                <label for="mctsNo" class="form-label">MCTS No :
                                    <input type="number" name="mctsNo" id="mctsNo" class="form-control"
                                        value="<?= isset($_POST['mctsNo']) && isset($mctsNo) && $_POST['mctsNo'] === $mctsNo ? $mctsNo : ''  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="ad_number" class="form-label">Aadhaar Number : <span
                                        class="text-danger fs-6 font-weight-bold">*</span></label>
                                <input type="text" name="ad_number" id="ad_number" class="form-control"
                                    value="<?= isset($_POST['ad_number']) && isset($ad_number) ? $_POST['ad_number'] : ''  ?>"
                                    maxlength="14" onkeyup="formatNumber()">
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <input class="btn btn-danger w-25" type="submit" value="Submit">
                        </div>
                </form>
            </section>

        </div>
    </div>

    <?php require_once('./includes/footer.php'); ?>
    <script>
    function formatNumber() {
        let input = document.getElementById("ad_number");
        let value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
        let formattedValue = '';

        if (value.length > 0) {
            formattedValue = value.substring(0, 4);

            if (value.length >= 5) {
                formattedValue += '-' + value.substring(4, 8);
            }

            if (value.length >= 9) {
                formattedValue += '-' + value.substring(8, 12);
            }
        }

        input.value = formattedValue;
    }

    function studentIDFormat() {
        let input = document.getElementById("stu_uniID");
        let value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
        let formattedValue = '';

        if (value.length > 0) {
            formattedValue = value.substring(0, 4);

            if (value.length >= 5) {
                formattedValue += '/' + value.substring(4, 8);
            }

            if (value.length >= 9) {
                formattedValue += '/' + value.substring(8, 12);
            }

            if (value.length >= 13) {
                formattedValue += '/' + value.substring(12, 16);
            }
        }

        input.value = formattedValue;
    }
    </script>
</body>

</html>

<?php
}else{
    header('Location: login.php');
    session_unset();
    die;
}
?>