<!DOCTYPE html>
    <html lang="en">
        <head>
            <link rel="stylesheet" type="text/css" href="css/c2.css">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Listener</title>
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
                        <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                        <h1>Report a Song</h1>
                        <br>
                        Music Name:<input type="text" name="rmname" id=""> 
                        <br><br> 
                        <input type="submit" class="sbmtbtn" name="report" value="Report"/>   
                        <input type="submit" class="cnclbtn" name="cancl" value="Cancel"/>  
                            
                        </form>
          </div>
                        <?php
                        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["cancl"]) ){
                          header("Location: common.php");
                      }
    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['report'])) {
      if (empty($_POST["rmname"])) {
        echo "<script>alert('all fields required');</script>";
      } 
      else {
        $repm = test_input($_POST["rmname"]);
        $nn="SELECT EXISTS(SELECT Mname FROM Music WHERE Mname='".$repm."')";
            $re = $conn->query($nn);
            $r = $re->fetch_array();
            if($r[0]!=0){
         $repm = test_input($_POST["rmname"]);
         $sql = "UPDATE Music SET report ='reported' WHERE Mname='$repm' ";
         if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Report Sent');</script>";
         } else {
            echo "<script>alert('Error sending report');</script>";
         }  
        }
        else    echo "<script>alert('This song doesnt exists');</script>";
           }
   }

 ?>

</body>
</html>