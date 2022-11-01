<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/c2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DeleateAccount</title>
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
    <h1>Delete Account</h1>
    <br>
    UserName: <input type="text" name="deleteUser" id=""><br>
    Password: <input type="password" name="deletePass" id=""> <br>
    <br>
    <input type="submit"  class="cnclbtn" name="delete" value="Delete" />
    
    <input type="submit" class="hmbtn" name="home" value="Home"/>
    <br>
    </form>
        </div>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['delete'])) {
      if (empty($_POST["deleteUser"]) || empty($_POST["deletePass"])) {
        //$err = "all fields are required";
        //$sql = "INSERT INTO `User` (`username`, `pass`, `hashedpass`, `email`, `userType`) VALUES ('admin' ,'adminadmin' ,'jj' ,'admin@gmail.com','D'  )";
        echo "<script>alert('all fields are required');</script>";
      } 
      else {
        $deleteUser = test_input($_POST["deleteUser"]);
        $deletePass = test_input($_POST["deletePass"]);
            
        $sql = "SELECT hashedpass FROM User WHERE username ='".$deleteUser."'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $rightPass = $row['hashedpass'];
        
        if(password_verify($deletePass, $rightPass)) {
            $sql ="DELETE FROM User WHERE username ='".$deleteUser."'";
            $result = mysqli_query($conn, $sql);
            if($result === true){
              //echo "deleted successfully";
              echo "<script>alert('deleted successfully');
                window.location.href='main.php';</script>";
            }
            else{
              echo "Error deleting user: " . $conn->error;
              //echo "<script>alert('Error deleting user: ' . $conn->error);</script>";
            }
          } else {
              //echo "Error: Wrong info" ;
              echo "<script>alert('Error: Wrong info');</script>";
            }
          }
    }
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["home"] )){
        header("Location: main.php");
    }
 ?>

</body>
</html>