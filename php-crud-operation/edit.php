
<?php 
  //session start
  session_start();
  //checking session variable
  if(!isset($_SESSION['email'])) {
    header("location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit User</title>
   <link rel="stylesheet" href="./css/bootstrap.min.css">

   <style>
      .heading {
         margin : 6%;
      }
   </style>
</head>
<body class = "container">
<nav class=" navbar-light bg-light">
  <h1 style="text-align: center;" class= "heading">Edit User</h1>
</nav>

<?php 
    //connection string
    $dbUserName = "";
    $dbUserEmail = "";
    $dbUserPassword= "";

    $conn = mysqli_connect('localhost' , 'root' , '' , 'users');
    
    //editid
    if(isset($_GET['editid'])) {
        $edit_id = $_GET['editid'];
       
        $select = "SELECT * FROM user_info WHERE id = '$edit_id'";
        $run = mysqli_query($conn , $select);
        $row = mysqli_fetch_array($run);

        $dbUserName = $row['user_name1'];
        $dbUserEmail = $row['email'];
        $dbUserPassword =$row['user_password'];
      }
?>

<form action = "#" method = "post" onsubmit ="return validation()">
  <!-- User Added Successfully -->
  <span id = 'useredited' style="color : green;"></span><br><br>
  <span id = 'userfailed' style="color : red;"></span>
  <!-- Form Body Start -->
  <div class="form-group">
    <label for="exampleInputEmail1">User Name</label>
    <input type="Text" value ="<?php echo $dbUserName ?>" class="form-control" id="username" placeholder ="Enter Your Name " name = "newUserName" autocomplete = "off">
    <span id = "ename" class = "text-danger text-weight-bold"> </span>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Email</label>
    <input type="Email" value ="<?php echo $dbUserEmail ?>" class="form-control" id="useremail" aria-describedby="emailHelp" placeholder = "Enter Your Email " name = "newUserEmail" autocomplete = "off">
    <span id = "eemail" class = "text-danger text-weight-bold"> </span>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" value ="<?php echo $dbUserPassword ?>"class="form-control" id="userpassword" placeholder ="********" name = "newUserPassword" autocomplete = "off">
    <span id = "epassword" class = "text-danger text-weight-bold"> </span>
  </div>
  <br> <br>
  <div class="form-group" style="text-align: center;">
      <button type="submit" name ="insert_btn" class="btn btn-success">
          Update User
      </button>
  </div> 
</form>
<!-- Form Body End-->

<script type = "text/javascript">
  function validation() {
    //validation variables
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


<?php 
    $conn = mysqli_connect('localhost' , 'root' , '' , 'users');

    if(isset($_POST['insert_btn'])) {

      $eusername = $_POST['newUserName'];
      $euseremail = $_POST['newUserEmail'];
      $euserpassword = $_POST['newUserPassword'];

      $update = "UPDATE user_info SET user_name1 = '$eusername' , email = '$euseremail' , user_password ='$euserpassword' WHERE id = '$edit_id' ";
      
      $run_update = mysqli_query($conn , $update);

      if($run_update === true) {
        echo '<script>document.getElementById("useredited").innerHTML = "User Updated Successfully "</script>';
        echo '<a class="btn btn-primary" href="dashboard.php">View User</a>';

      }
      else {
        echo '<script>document.getElementById("userfailed").innerHTML = "Failed !! "</script>';
      }
    }
?>

</body>
</html>
