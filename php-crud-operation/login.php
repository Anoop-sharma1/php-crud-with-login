<?php 
    //session start
    session_start();
    $error = ''; // error variable
    if(isset($_POST['submit'])) {
        if(empty($_POST['email']) || empty($_POST['password'])) {
            $error = "Email or Password is Invalid";
        }
        else {
            $email = $_POST['email'];
            $password = $_POST['password'];
            //establishing connection
            $conn = mysqli_connect("localhost" , "root" , "");
            //selecting database
            $db = mysqli_select_db($conn , "users");
            //sql query to fetch info from db
            $query = mysqli_query($conn , "SELECT * FROM user_info WHERE user_password = '$password' AND email = '$email'");
            $rows = mysqli_num_rows($query);
            //session
            if($rows == 1) {
                //session
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header("Location: dashboard.php");
            }
            else {
                $error = "Username or Password is Invalid ";
            }
            mysqli_close($conn);
        }
    }
?>

<!--Log in Html Code Start -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log in</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Log in</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="email" id="email" class="form-control" name="email" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4" style="text-align: center;">
                                <button type="submit" name ="submit" class="btn btn-primary">
                                    Log In
                                </button>
                                <span style = "color : red"><?php echo "<br><br>$error"; ?></span>
                            </div>
                       </form>
                     </div>
                    </div>
                 </div>
              </div>
           </div>
     </div>
</main>
</body>
</html>


