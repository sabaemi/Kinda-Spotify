<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/c2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup</title>
</head>
<body>
<?php

$err = "";
$user = $pass = $email = $userType = $color = $ftn = NULL;

$servername = "localhost";
$username = "username";
$password = "password";
$dataBase = "db6";
$err = "";

$conn = new mysqli($servername, $username, $password, $dataBase);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['submit'])) {
  if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["userType"]) || empty($_POST["email"])) {
    //$err = "all fields are required";
    echo "<script>alert('all fields are required');</script>";
  } 
  else if(empty($_POST["ftn"]) && empty($_POST["color"])){
    echo "<script>alert('you should answer one of the password recovery questions');</script>";
  }
  else if(!empty($_POST["ftn"]) && !empty($_POST["color"])){
    //$err = "you should at least answer one of the password recovery questions";
    echo "<script>alert('you should answer just one of the password recovery questions');</script>";
  }
  //$email = test_input($_POST["email"]);
  else if (!filter_var($email= test_input($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
    //$err = "Invalid email format";
    echo "<script>alert('Invalid email format');</script>";
  }

  else if(preg_match('/[A-Za-z]/', $_POST["password"]) && preg_match('/[0-9]/', $_POST["password"]) && strlen($_POST["password"])> 7)
   {
     
    $user = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $pass = test_input($_POST["password"]);
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
    $userType = test_input($_POST["userType"]);
    $color = test_input($_POST["color"]);
    $ftn = test_input($_POST["ftn"]);

    $sql = "INSERT INTO User (username,pass,hashedpass,userType,email) VALUES ('$user','$pass','$hashed_password','$userType','$email')";
                $conn->query($sql);
                if(!empty($_POST["color"])) {
                $sql = "INSERT INTO QuestionsList (question,username,answer) VALUES ('color','$user','$color')";
                $conn->query($sql);
                }
                if(!empty($_POST["ftn"])) {
                $sql = "INSERT INTO QuestionsList (question,username,answer) VALUES ('faveTeacher','$user','$ftn')";
                $conn->query($sql);
                }
                session_start();
                $_SESSION['username'] = $user;
                if($userType=='A'){
                  header("Location: artistSignup.php?username=".$user);
                }
                if($userType=='L'){
                  header("Location: listenerSignup.php?username=".$user);
                }
                  
           
    }
    else{
      //echo 'weak password!';
      echo "<script>alert('weak password!');</script>";
    }
 }
 if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['cancel'])) {
  header("Location: main.php");
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
    <h1> Sign Up</h1>
        Username: <input type="text" name="username">
        <br><br>
        Email: <input type="text" name="email">
        <br><br>
         Password: <input type="text" name="password">
        <br><br>
         UserType:
         <input type="radio" name="userType" value="L">Listner
         <input type="radio" name="userType" value="A">Artist
        <br><br>
        Favourite color: <input type="text" name="color">
        <br><br>
         First teacher's name: <input type="text" name="ftn">
        <br><br>
        <input type="submit" class="sbmtbtn" name="submit" value="Submit"> 
        <input type="submit" class="cnclbtn" name="cancel" value="Cancel">  
    </form>
    </div>



</body>
</html>