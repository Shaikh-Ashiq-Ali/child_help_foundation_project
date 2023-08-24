<?php

session_start();

if(isset($_SESSION) && isset($_SESSION['email'])){ 

?>

<!doctype html>
<html lang="en">

<head>
    <title>Students</title>
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
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="stu_uniID" class="form-label">Student Unique ID (16 Digit) : </label>
                            <input type="text" name="stu_uniID" id="stu_uniID" class="form-control"
                                onkeyup="studentIDFormat()" maxlength="19">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="mctsNo" class="form-label">MCTS No :</label>
                            <input type="text" name="mctsNo" id="mctsNo" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="ad_number" class="form-label">Aadhaar Number : </label>
                            <input type="text" name="ad_number" id="ad_number" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="role" class="form-control" id="role" placeholder="Name of Student">
                            <label for="floatingInput">Role</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="location" class="form-control" id="location"
                                placeholder="Name of Student">
                            <label for="floatingInput">Location</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="student_name" class="form-control" id="student_name"
                                placeholder="Name of Student">
                            <label for="floatingInput">Name of Student</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="date" name="dob" class="form-control" id="dob" placeholder="DOB">
                            <label for="floatingInput">DOB</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3 d-flex">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="gender" type="radio" name="inlineRadioOptions"
                                id="inlineRadio1" value="male">
                            <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="gender" type="radio" name="inlineRadioOptions"
                                id="inlineRadio2" value="female">
                            <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="std" class="form-control" id="std">
                            <label for="floatingInput">STD</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="section" class="form-control" id="section">
                            <label for="floatingInput">Section</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="student_father_name" class="form-control" id="student_father_name">
                            <label for="floatingInput">Name of Father/Guardian</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="student_mother_name" class="form-control" id="student_mother_name">
                            <label for="floatingInput">Name of Mother</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="tel" name="contact" class="form-control" id="contact">
                            <label for="floatingInput">Contact No</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="teacher_name" class="form-control" id="teacher_name">
                            <label for="floatingInput">Name of teacher</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="teacher_contact" class="form-control" id="teacher_contact">
                            <label for="floatingInput">Teacher contact</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Default file input example</label>
                            <input class="form-control" name="file" type="file" id="file">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <?php require_once('./includes/footer.php'); ?>
    <script>
    $(document).ready(function() {
        // var ajaxExecuted = false;
        $('input').attr('readonly', true);
        $('#stu_uniID').attr('readonly', false);

        $('#stu_uniID').on('keyup', function() {
            var stuid = $(this).val();
            stuid = stuid.replace(/\//g, '');

            // if (/^\d{16}$/.test(stuid) && !ajaxExecuted) {
            if (/^\d{16}$/.test(stuid)) {
                // ajaxExecuted = true;
                $.ajax({
                    url: "includes/get_student.inc.php",
                    type: "GET",
                    data: {
                        id: stuid
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        for (const key in data[0]) {
                            if (data[0].hasOwnProperty(key)) {
                                // console.log(`${key}: ${data[0][key]}`);
                                if (key != 'stu_uniID') {
                                    $(`#${key}`).val(data[0][key]);
                                }
                            }
                        }
                    },
                    error: function() {
                        console.error("Error fetching data");
                    }
                });
            } else {
                // ajaxExecuted = false;
            }
        })

    })

    function studentIDFormat() {
        let input = document.getElementById("stu_uniID");
        let value = input.value.replace(/\D/g, '');
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