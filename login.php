<?php

require_once('./includes/db.php');

$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();
    
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    }
    $password = test_input($_POST["password"]);
    if(strlen($password) < 8){
        $error = "Password must be 8 characters only";
    }
    
    // Maintaining Log
    $array = ['collection_name'=>'user','ip_add'=>'0:0:0:0','email'=>$email];
    $database->insertData('log',$array);
    
    if(isset($email) && isset($password)){
        $array = ['email'=>$email,'password'=>$password];
        $data = json_decode($database->getData('user',$array),true);
        if(isset($data['status']) && $data['status'] === 0){
            $error = $data['message'];
        }

        if(!isset($error)){
            $encryption_email= openssl_encrypt($email, $ciphering,$encryption_key, $options, $encryption_iv);
            // var_dump($encryption_email);
            $_SESSION['email'] = $encryption_email;
            header('Location: dashboard');
            die;
        }
    }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="./css/style.css"> -->
</head>

<body>

    <div id="main">
        <div class="container-fluid login">
            <div class="row align-items-center justify-content-center" style="height:100vh">
                <div class="col-lg-8">
                    <img class="img-fluid" src="./images/login_image.jpg" alt="Login Image">
                </div>
                <div class="col-lg-4">
                    <div class="d-block p-5 shadow-lg rounded-3 me-5">
                        <div class="login_child_logo mb-4 text-center">
                            <img class="img-fluid w-50" src="./images/child_help_LOGO.jpg" alt="">
                        </div>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <?php if(isset($error)){ ?>
                            <small class="text-danger"><strong><?= $error ?></strong></small>
                            <?php } ?>
                            <div class="form-floating mb-4">
                                <input type="email" name="email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" value="ashiq@gmail.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" id="floatingPassword"
                                    placeholder="Password" required value="abcde12345">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>