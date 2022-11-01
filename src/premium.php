<!DOCTYPE html>
    <html lang="en">
        <head>
            <link rel="stylesheet" type="text/css" href="css/c2.css">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Premium</title>
        </head>
        <body>
                        
        <!--data base-->   
        <?php
            $servername = "localhost";
            $username = "username";
            $password = "password";
            $dataBase = "db6";
            session_start();
            $user = $_SESSION['username'];
                        
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
<h1>upgrade your account to premium</h1>
<?php echo' <h2 >'.$user.'</h2>'; ?>
                        card number: <input type="text" name="cardnum">
                        <br><br>
                        expire card date: <input type="date" name="exdate">
                        <br><br>
                        Pick your Premium:
         <input type="radio" name="kind" value="g">Gold(5days)
         <input type="radio" name="kind" value="s">Silver(3days)
        <br><br>
                        <input type="submit" class="sbmtbtn" name="buy" value="Buy"> 
                        <input type="submit" class="cnclbtn" name="cancl" value="Cancel"/> 
                    </form>  
          </div>
                      <?php
                      if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["cancl"]) ){
                        header("Location: common.php");
                    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['buy'])) {
      if (empty($_POST["cardnum"]) || empty($_POST["exdate"])||empty($_POST["kind"])) {
        echo "<script>alert('all fields required');</script>";
      } 
      else {
         $cardno = test_input($_POST["cardnum"]);
         $xdate = test_input($_POST["exdate"]);
         $kind = test_input($_POST["kind"]);
         $date=date("Y/m/d");
         
         if($kind=='g')
         $kdate=date('Y-m-d', strtotime("+5 days"));
         if($kind=='s')
         $kdate=date('Y-m-d', strtotime("+3 days"));
         $sql1 = "SELECT * FROM User WHERE username ='".$user."'";
            $result = mysqli_query($conn, $sql1);
            $row = mysqli_fetch_assoc($result);
            $loginType = $row['userType']; 
         $sql = "INSERT INTO `Premium` (`cardNo`, `expcardDate` , `buyDate`,`expDate`, `username`, `userType`) VALUES ('$cardno','$xdate','$date','$kdate','$user', '$loginType' )";
         if ($conn->query($sql) === TRUE) {
             echo "<script>alert('upgraded successfully');
             window.location.href='common.php';</script>";
         }
             else{
                echo "<script>alert('wrong info');</script>";
             }
                           
           }
   }

 ?>

</body>
</html>