<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/c2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<?php

$err = "";
$servername = "localhost";
$username = "username";
$password = "password";
$dataBase = "db6";
$err = "";

$conn = new mysqli($servername, $username, $password, $dataBase);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

          function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }


?><div class="form1">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <h1>Log In</h1>
        Username: <input type="text" name="loguser">
        <br><br>
         Password: <input type="text" name="logpass">
        <br><br>
         <input type="submit" class="sbmtbtn" name="login" value="login">
         <input type="submit" class="cnclbtn" name="cancl" value="cancel">  
    </form>
    </div>
    
    
<?php
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['login']))
      {
        if (empty($_POST["loguser"]) || empty($_POST["logpass"])) {
          //echo "all fields are required";
          echo "<script>alert('all fields are required');</script>";
        }
        else{
          $loguser = test_input($_POST["loguser"]);
          $logpass = test_input($_POST["logpass"]);

          $nn="SELECT EXISTS(SELECT * FROM User WHERE username ='".$loguser."')";
          $re = $conn->query($nn);
          $r = $re->fetch_array();
          if($r[0]!=0){
          $sql = "SELECT * FROM User WHERE username ='".$loguser."'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          $rightPass = $row['hashedpass'];
          $loginType = $row['userType'];

          if(password_verify($logpass, $rightPass)) {
            session_start();
            $_SESSION['username'] = $loguser;
            echo "<script>alert('registered successfully');</script>";
            header("Location: common.php?username=".$loguser);
            //echo "registered successfully";
            // if($loginType=='A'){
            //   header("Location: Artist.php?username=".$loguser);
            // }
            // if($loginType=='L'){
            //   header("Location: Listener.php?username=".$loguser);
            // }
                      
          }
          else{
            $rightPasss=$row['pass'];
            if($rightPasss==$logpass){
              session_start();
              $_SESSION['username'] = $loguser;
              echo "<script>alert('registered successfully');</script>";
              header("Location: common.php?username=".$loguser);
            }
            //echo "wrong password!";
            else echo "<script>alert('wrong password!');</script>";
          }
        }
        else echo "<script>alert('wrong username!');</script>";
        }
  
      }

      if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['cancl'])){
        header("Location: main.php");
      }
 ?>

</body>
</html>