<?php  
  //session start
  session_start();
  
  //redirecting to login page
  if(!isset($_SESSION['email'])) {
    header("location: login.php");
  }
  
  //connection string
  $conn = new mysqli("localhost", "root", "", "users");

  //Data to be delted --id
  if(isset($_GET['deleteid'])) {
    $del_id = $_GET['deleteid'];
  
     $delete = "DELETE FROM user_info WHERE id = '$del_id'";
     $run_delete = mysqli_query($conn , $delete);
  }


  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  //fetching user Name from database users and table user_info
  //showing current user log in details
  
  if(isset($_SESSION['email'])) {
    $userFormEmail = $_SESSION['email'];
    $sql = "SELECT user_name1 FROM user_info WHERE email='$userFormEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    
         if($row = $result->fetch_assoc()) {
          $dataBaseUserName  = $row["user_name1"];
         
         }
          $result->free();
    }
    else {
      echo "0 results";
    }
    $conn->close(); 
  }

  else {
    $dataBaseUserName = "Anoop Sharma";
  }
  
?>

<?php  
    
    //Header -- User Name
    echo '
      <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="./css/bootstrap.min.css">
      </head>
      <body style="margin: 6%;">
      <div class="jumbotron">
        <p class="display-4">

          <h1 style = "text-align : center">Hello, '.$dataBaseUserName.'</h1>
          <a class = "btn btn-danger" href="logout.php">Log Out </a>
        </h1>
      </div>
    ';

    $conn = new mysqli("localhost", "root", "", "users");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT id, user_name1, email, created_at , updated_at FROM user_info"; //fetching user email and user password from database users and table user_info
  $result = $conn->query($sql);
  
  echo '<button class="btn btn-primary" onclick = "addUser()" style="margin-left: 93%;">Add User</button> <br><br>';
  echo '<table class = "table"> 
      <thead>
      <tr> 
          <td scope = "col" style="font-weight: bold;">Id</td> 
          <td scope = "col" style="font-weight: bold;">Name</td>
          <td scope = "col" style="font-weight: bold;">Email</td>
          <td scope = "col" style="font-weight: bold;">Created At</td>
          <td scope = "col" style="font-weight: bold;">Updated At</td>
          <td scope = "col" style="font-weight: bold;">Action</td>
      </thead> 
      </tr>';

  if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $dataBaseUserId    = $row["id"];
        $dataBaseUserName  = $row["user_name1"];
        $dataBaseUserEmail = $row["email"];
        $dataBaseUserCreatedAt = $row["created_at"];
        $dataBaseUpdatedAt = $row["updated_at"];

        $flag = ""; 
        if ($_SESSION['email'] == $dataBaseUserEmail){
          $flag = "disabled"; 
        }
        
        echo '<tbody>
        <tr> 
        <th scope="row">'.$dataBaseUserId.'</th> 
        <td>'.$dataBaseUserName.'</td> 
        <td>'.$dataBaseUserEmail.'</td> 
        <td>'.$dataBaseUserCreatedAt.'</td> 
        <td>'.$dataBaseUpdatedAt.'</td>

        <td><button class="btn btn-primary" onclick = editUser('.$dataBaseUserId.') >Edit</button>
        <td><button class="btn btn-danger"'.$flag.' onclick = deleteUser('.$dataBaseUserId.') >Delete</button></td>
        </tbody>   
        </tr>';
    }
    $result->free();
  } 
  else {
    echo "0 results";
  }
  $conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
</head>
<body>

  <script>
    //redirected to edituserpage
    function editUser(id) {
      window.open("edit.php?editid="+id,"_self");  
    }
  
    //redirected to dashboard
    function deleteUser(id) {
      window.open("dashboard.php?deleteid="+id,"_self");  
    }
    
    //redirection to adduser page
    function addUser() {
      window.open("adduser.php","_self");  
    }
  </script>


</body>
</html>
