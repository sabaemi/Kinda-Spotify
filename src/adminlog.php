<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/c2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AdminLog</title>
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


?>
<div class="form1">
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
    <h1>Enter Admin Password</h1><br><br>
    Password: <input type="password" name="adminPass" id=""> <br>
    <br>
    <input type="submit" class="sbmtbtn" name="admin" value="submit" />
    <input type="submit" class="cnclbtn" name="cancel" value="Cancel"> 
    
    </form>
        </div>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['admin']))
    {

      if ($_POST["adminPass"]=="adminadmin") {
        header("Location: admin.php");
      }
      else{
        //echo "access denied!";
        echo "<script>alert('access denied!');</script>";
      }
    }
    if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['cancel'])) {
      header("Location: main.php");
     }
   
 ?>

</body>
</html>