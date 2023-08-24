<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
    echo "<pre>";
    print_r($_POST);

    $role = $_POST['role'];
    $location = $_POST['location'];
    $student_name = $_POST['student_name'];
    $std = $_POST['std'];
    $section = $_POST['section'];
    $student_father_name = $_POST['student_father_name'];
    $student_mother_name = $_POST['student_mother_name'];
    $contact = $_POST['contact'];
    $teacher_name = $_POST['teacher_name'];
    $teacher_contact = $_POST['teacher_contact'];
    $file = $_POST['file'];
    $stu_uniID = $_POST['stu_uniID'];
    $mctsNo = $_POST['mctsNo'];
    $ad_number = $_POST['ad_number'];

    if($role === "Select Role"){
        $err = "Please select role";
    }

    // header("Location : ../add_student");

    // if(isset($err)){
    //     die;
    // }

}


// function test_input($data) {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
//   }



?>