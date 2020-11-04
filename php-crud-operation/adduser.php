<?php 
  //session start
  session_start();
  
  if(!isset($_SESSION['email'])) {
    header("location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add User</title>
   <link rel="stylesheet" href="./css/bootstrap.min.css">

   <style>
      .heading {
         margin : 6%;
      }     
   </style>

</head>
<body class = "container">
<nav class=" navbar-light bg-light">
  <h1 style="text-align: center;" class= "heading">Add New User</h1>
</nav>
<?php 
   //connection String
  $conn = new mysqli("localhost", "root", "", "users");

  //Data to be delted --id
  if(isset($_GET['deleteid'])) {
     $del_id = $_GET['deleteid'];

     $delete = "DELETE FROM user_info WHERE id = '$del_id'";
     $run_delete = mysqli_query($conn , $delete);
  }
?>

<form action = "" method = "post" onsubmit = "return validation()">
  <!-- User Added Successfully -->
  <span id = 'useradded' style="color : green;"></span><br><br>
  <span id = 'userfailed' style="color : red;"></span>
  <!-- Form Body Start -->
  <div class="form-group">
    <label for="exampleInputEmail1">User Name</label>
    <input type="Text" class="form-control" id="username" placeholder ="Enter Your Name " name = "newUserName"  autocomplete = "off">
    <span id = "ename" class = "text-danger text-weight-bold"> </span>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Email</label>
    <input type="Email" class="form-control" id="useremail" aria-describedby="emailHelp" placeholder = "Enter Your Email " name = "newUserEmail"  autocomplete = "off">
    <span id = "eemail" class = "text-danger text-weight-bold"></span>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="userpassword" placeholder ="********" name = "newUserPassword"  autocomplete = "off">
    <span id = "epassword" class = "text-danger text-weight-bold"></span>
  </div>
  <br> <br>
  <div class="form-group" style="text-align: center;">
      <button type="submit" name ="submit" class="btn btn-success">
          Add User
      </button>
  </div>
</form>

<script type = "text/javascript">
  function validation() {
    
    let user = document.getElementById('username').value;
    let password = document.getElementById('userpassword').value;
    let email = document.getElementById('useremail').value;

    if(user ===  "") {
      document.getElementById('ename').innerHTML = "Please Enter Valid Name ";
      return false;
    }

    if(!isNaN(user)) {
      document.getElementById('ename').innerHTML = "User Name Must Be In Character  ";
      return false;
    }

    if((user.length <= 2) || (user.length >=20)) {
      document.getElementById('ename').innerHTML = "Invalid User Name length ";
      return false;
    }

    if(email ===  "") {
      document.getElementById('eemail').innerHTML = "Please Enter Valid Email ";
      return false;
    }

    if((email.charAt(email.length-4)!='.') && (email.charAt(email.length-3)!='.')) {
      document.getElementById('eemail').innerHTML = "Invalid . Position ";
      return false;
    }

    if(password ===  "") {
      document.getElementById('epassword').innerHTML = "Please Enter Valid Password ";
      return false;
    }

    if(password.length <=5) {
      document.getElementById('epassword').innerHTML = "Password Must Contain More Than 6 Character ";
      return false;
    }
  }
</script>
</body>
</html>

<?php 
   $conn = mysqli_connect("localhost" , 'root' , '' , 'users');

   if(isset($_POST['submit'])) {
          $newUserName = $_POST['newUserName'];
          $newUserEmail = $_POST['newUserEmail'];
          $newUserPassword = $_POST['newUserPassword'];

            $insert = "INSERT INTO user_info(user_name1 , user_password , email) VALUES('$newUserName' , '$newUserPassword' , '$newUserEmail')";
      
            $run_insert = mysqli_query($conn , $insert);
      
         if($run_insert === true) {
            echo '<script>document.getElementById("useradded").innerHTML = "User Added SuccessFully "</script>';
            echo '<a class="btn btn-primary" href="dashboard.php">View User</a>';
          }
         else {
            echo '<script>document.getElementById("userfailed").innerHTML = "Failed !! "</script>';
         }
    }  
?>

