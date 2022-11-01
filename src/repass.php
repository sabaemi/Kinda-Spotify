<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/c2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Repass</title>
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
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <h1>Password Recovery</h1><br>
        Username: <input type="text" name="fUsername">
        <br><br>
        Favourite Color: <input type="text" name="fColor">
        <br><br>
        Teacher's Name: <input type="text" name="fFtn">
        <br><br>
        new password: <input type="text" name="fPass">
        <br><br>
        <input type="submit" class="sbmtbtn" name="forgetPassword" value="Change Pass"> 
        
    <input type="submit" class="hmbtn" name="home" value="Home"/> 
    </form>
        </div>

    <br><br>
    <br><br>
    <br><br>
    
<?php

      if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['forgetPassword']))
      {
        if (empty($_POST["fUsername"]) || empty($_POST["fPass"])|| (empty($_POST["fFtn"]) && empty($_POST["fColor"]))){
          //echo "fill in the fields!";
          echo "<script>alert('all fields are required');</script>";
        }
        else if(!empty($_POST["fFtn"]) && !empty($_POST["fColor"])){
          //$err = "you should at least answer one of the password recovery questions";
          echo "<script>alert('you should answer just one of the password recovery questions');</script>";
        }
        else{
          

          if(!empty($_POST["fFtn"])){
            $fFtn = $_POST["fFtn"];
            $fUsername = test_input($_POST["fUsername"]);
          $fPass = test_input($_POST["fPass"]);
          $fhashed_password = password_hash($fpass, PASSWORD_DEFAULT);
            $sql = "SELECT * FROM questionslist WHERE username ='".$fUsername."' and question ='faveTeacher' ";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $rightAnswer = $row['answer'];
            if($fFtn == $rightAnswer){
              if(preg_match('/[A-Za-z]/', $_POST["fPass"]) && preg_match('/[0-9]/', $_POST["fPass"]) && strlen($_POST["fPass"])> 7){
              $sql = "UPDATE User SET pass ='$fPass' , hashedpass='$fhashed_password' WHERE username ='$fUsername' ";

              $result = mysqli_query($conn, $sql);
              //echo "password changed";
              echo "<script>alert('password changed');</script>";
              }
              else{
                echo "<script>alert('weak password');</script>"; 
              }
            }
            else{
              echo "<script>alert('password recovery question is wrong');</script>";
            }
          }

          else if(!empty($_POST["fColor"])){
            $fColor = $_POST["fColor"];
            $fUsername = test_input($_POST["fUsername"]);
          $fPass = test_input($_POST["fPass"]);
          $fhashed_password = password_hash($fpass, PASSWORD_DEFAULT);
            $sql = "SELECT * FROM questionslist WHERE username ='".$fUsername."' and question ='color' ";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $rightAnswer = $row['answer'];
            if($fColor == $rightAnswer){
              if(preg_match('/[A-Za-z]/', $_POST["fPass"]) && preg_match('/[0-9]/', $_POST["fPass"]) && strlen($_POST["fPass"])> 7){
              $sql = "UPDATE User SET pass ='$fPass', hashedpass='$fhashed_password' WHERE username ='$fUsername'";
              $result = mysqli_query($conn, $sql);
              //echo "password changed";
              echo "<script>alert('password changed');
                window.location.href='main.php';</script>";
              }
              else{
                echo "<script>alert('weak password');</script>"; 
              }
            }
            else{
              echo "<script>alert('password recovery question is wrong');</script>";
            }
          }

          
        }
  
      }
      if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["home"] )){
        header("Location: main.php");
    }

?>

</body>
</html>