<?php

session_start();
// var_dump($_SESSION);
if(isset($_SESSION) && isset($_SESSION['email'])){ 

require_once('includes/db.php');

$data = json_decode($database->getData('student','all'),true);

foreach($data as $key => $value){
    foreach($value as $inkey => $invalue){
        $$inkey[] = $invalue;
    }
}

$gender_count = isset($gender) ? array_count_values($gender) : '';

?>

<!doctype html>
<html lang="en">

<head>
    <title>Dashboard</title>
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

            <div class="row gx-2 student_detail">

                <div class="col-xl-3">
                    <div class="dashboard-summery-one student_chart">
                        <h4>Students</h4>
                        <div class="student_doughnut_chart">
                            <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
                        </div>
                        <div class="d-flex align-items-center justify-content-between student_chart_content">
                            <div>
                                <div class="item-title">Female</div>
                                <div class="item-number"><span class="counter"
                                        data-num="<?= isset($gender_count) ? $gender_count['male'] : 0;  ?>"><?= isset($gender_count) ? $gender_count['male'] : 0;  ?></span>
                                </div>
                            </div>
                            <div>
                                <div class="item-title">Male</div>
                                <div class="item-number"><span class="counter"
                                        data-num="<?= isset($gender_count) ? $gender_count['female'] : 0;  ?>">
                                        <?= isset($gender_count) ? $gender_count['female'] : 0;  ?>
                                    </span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9">
                    <div class="row g-3 justify-content-center">
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="item-icon text-center">
                                            <img class="img-fluid w-50" src="images/icons/students.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">Students</div>
                                            <div class="item-number"><span class="counter"
                                                    data-num="<?= isset($data) ? count($data) : 0 ?>"><?= isset($data) ? count($data) : 0 ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="item-icon text-center">
                                            <img class="img-fluid w-50" src="images/icons/health_camp.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">Health Camp</div>
                                            <div class="item-number"><span class="counter" data-num="29">29</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="item-icon text-center">
                                            <img class="img-fluid w-50" src="images/icons/students.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">TOT</div>
                                            <div class="item-number">
                                                <span class="counter">4</span>
                                                <!-- <small>(Participants-54)</small> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="item-icon text-center">
                                            <img class="img-fluid w-50" src="images/icons/refer.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">Referrals</div>
                                            <div class="item-number"><span class="counter" data-num="10">10</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="item-icon text-center">
                                            <img class="img-fluid w-50" src="images/icons/morbidity.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">Morbidity Cases</div>
                                            <div class="item-number"><span class="counter" data-num="3">3</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="item-icon text-center">
                                            <img class="img-fluid w-50" src="images/icons/social-care.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">Awareness Sessions</div>
                                            <div class="item-number"><span class="counter" data-num="8">8</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="item-icon text-center">
                                            <img class="img-fluid w-50" src="images/icons/discussion.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">Counselling Sessions</div>
                                            <div class="item-number"><span class="counter" data-num="6">6</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-sm-6 col-12">
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="item-icon text-center">
                                            <img class="img-fluid w-50" src="images/icons/group_counselling.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="item-content">
                                            <div class="item-title">Group Counselling Sessions</div>
                                            <div class="item-number"><span class="counter" data-num="6">6</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <section class="select_range mt-5 mb-5">
                <div class="container-fluid px-4 text-center">
                    <div class="row gx-5">
                        <div class="col select_range_box" style="height:300px">
                            <div class="p-3"></div>
                        </div>
                        <div class="col select_range_box" style="height:300px">
                            <div class="p-3"></div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <?php require_once('./includes/footer.php'); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
    const xValues = ["Female", "Male", ];
    const yValues = [<?= isset($gender_count) ? $gender_count['female'] : 0;  ?>,
        <?= isset($gender_count) ? $gender_count['male'] : 0;  ?>
    ];
    const barColors = ["blue", "green"];

    new Chart("myChart", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
    </script>
</body>

</html>

<?php
}else{
    header("Location: login.php");
    session_unset();
    die;
}
?>