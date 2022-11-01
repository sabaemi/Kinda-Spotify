<!DOCTYPE html>
    <html lang="en">
        <head>
            <link rel="stylesheet" type="text/css" href="css/c2.css">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Info</title>
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
            <?php
            $sql = "SELECT * FROM User WHERE username ='".$user."'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $loginType = $row['userType']; 
            if($loginType=='A'){
              echo'
              <h1>Edit Information</h1>
              New Password:<input type="text" name="newPassword" id=""> 
              <br><br>
              New Art Name:<input type="text" name="newArtName" id=""> 
              <br><br>
              New Nationality:<input type="text" name="newNationality" id="">
              <br><br>
              New startDate: <input type="date" name="newstartDate" id="">
              <br><br>
              New Email: <input type="text" name="newEmail" id="">
              <br><br>
              <input type="submit" class="sbmtbtn" name="editAction" value="Edit info"/> 
              
              <input type="submit" class="cnclbtn" name="cancl" value="Cancel"/>            
              </form>
              </div>';

              if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["cancl"]) ){
                  header("Location: common.php");
              }
              if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["editAction"] ))
              {
                
                 if(!empty($_POST["newArtName"])){
                      $nName=$_POST["newArtName"];  
                      $sql = "UPDATE Artist SET ArtName ='$nName' WHERE username='$user'";
                    if ($conn->query($sql) === TRUE) {
                       //echo "First Name Record updated successfully <br>";
                       echo "<script>alert('Art Name Record updated successfully');</script>";
                    } else {
                       //echo "Error updating record <br>";
                       echo "<script>alert('Error updating record');</script>";
                    }                      
                  }

                  if(!empty($_POST["newPassword"])){
                      $nPass=$_POST["newPassword"];
                      if(preg_match('/[A-Za-z]/', $_POST["newPassword"]) && preg_match('/[0-9]/', $_POST["newPassword"]) && strlen($_POST["newPassword"])> 7){  
                      $sql = "UPDATE User SET pass ='$nPass' WHERE username='$user'";
                    if ($conn->query($sql) === TRUE) {
                       //echo "Password Record updated successfully <br>";
                       echo "<script>alert('Password Record updated successfully');</script>";
                    }
                   }
                    else {
                       //echo "Error updating record <br>";
                       echo "<script>alert('Error updating record');</script>";
                    }                      
                  }

                  if(!empty($_POST["newNationality"])){
                      $nNationality=$_POST["newNationality"];  
                      $sql = "UPDATE Artist SET nationality ='$nNationality' WHERE username='$user'";
                    if ($conn->query($sql) === TRUE) {
                       //echo "Nationality Record updated successfully <br>";
                       echo "<script>alert('Nationality Record updated successfully');</script>";
                    } else {
                       //echo "Error updating record <br>";
                       echo "<script>alert('Error updating record');</script>";
                    }                      
                  }

                  if(!empty($_POST["newstartDate"])){
                      $nstartDate=$_POST["newstartDate"];  
                      $sql = "UPDATE Artist SET startDate ='$nstartDate' WHERE username='$user'";
                    if ($conn->query($sql) === TRUE) {
                       //echo "DateOfBirth Record updated successfully <br>";
                       echo "<script>alert('startDate Record updated successfully');</script>";
                    } else {
                       //echo "Error updating record <br>";
                       echo "<script>alert('Error updating record');</script>";
                    }                      
                  }

                  if(!empty($_POST["newEmail"])){
                      $nEmail=$_POST["newEmail"];  
                      if (filter_var(test_input($_POST["newEmail"]), FILTER_VALIDATE_EMAIL)){
                      $sql = "UPDATE User SET email ='$nEmail' WHERE username='$user'";
                    if ($conn->query($sql) === TRUE) {
                       //echo "Email Record updated successfully <br>";
                       echo "<script>alert('Email Record updated successfully');</script>";
                    }
                   } else {
                       //echo "Error updating record <br>";
                       echo "<script>alert('Error updating record');</script>";
                    }                      
                  }

              }

              }
              if($loginType=='L'){
                echo'
                <h1>Edit Information</h1>
                New Password:<input type="text" name="newPassword" id=""> 
                <br><br>
                New First Name:<input type="text" name="newFirstName" id=""> 
                <br><br>
                New Last Name:<input type="text" name="newLastName" id="">
                <br><br>
                New Nationality:<input type="text" name="newNationality" id="">
                <br><br>
                New BirthDate: <input type="date" name="newDateOfBirth" id="">
                <br><br>
                New Email: <input type="text" name="newEmail" id="">
                <br><br>
                <input type="submit" class="sbmtbtn" name="editAction" value="Edit"/>  
                
                <input type="submit" class="cnclbtn" name="cancl" value="Cancel"/>        
                </form>
                </div>';
                if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["cancl"] )){
                  header("Location: common.php");
              }

              if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["editAction"] ))
                        {
                          
                           if(!empty($_POST["newFirstName"])){
                                $nName=$_POST["newFirstName"];  
                                $sql = "UPDATE listener SET firstName ='$nName' WHERE username='$user'";
                              if ($conn->query($sql) === TRUE) {
                                 //echo "First Name Record updated successfully <br>";
                                 echo "<script>alert('First Name Record updated successfully');</script>";
                              } else {
                                 //echo "Error updating record <br>";
                                 echo "<script>alert('Error updating record');</script>";
                              }                      
                            }

                            if(!empty($_POST["newLastName"])){
                                $nlastName=$_POST["newLastName"];  
                                $sql = "UPDATE Listener SET lastName ='$nlastName' WHERE username='$user'";
                              if ($conn->query($sql) === TRUE) {
                                 //echo "Last Name Record updated successfully <br>";
                                 echo "<script>alert('Last Name Record updated successfully');</script>";
                              } else {
                                 //echo "Error updating record <br>";
                                 echo "<script>alert('Error updating record');</script>";
                              }                      
                            }

                            if(!empty($_POST["newPassword"])){
                                $nPass=$_POST["newPassword"];
                                if(preg_match('/[A-Za-z]/', $_POST["newPassword"]) && preg_match('/[0-9]/', $_POST["newPassword"]) && strlen($_POST["newPassword"])> 7){  
                                $sql = "UPDATE User SET pass ='$nPass' WHERE username='$user'";
                              if ($conn->query($sql) === TRUE) {
                                 //echo "Password Record updated successfully <br>";
                                 echo "<script>alert('Password Record updated successfully');</script>";
                              }
                             }
                              else {
                                 //echo "Error updating record <br>";
                                 echo "<script>alert('Error updating record');</script>";
                              }                      
                            }

                            if(!empty($_POST["newNationality"])){
                                $nNationality=$_POST["newNationality"];  
                                $sql = "UPDATE Listener SET nationality ='$nNationality' WHERE username='$user'";
                              if ($conn->query($sql) === TRUE) {
                                 //echo "Nationality Record updated successfully <br>";
                                 echo "<script>alert('Nationality Record updated successfully');</script>";
                              } else {
                                 //echo "Error updating record <br>";
                                 echo "<script>alert('Error updating record');</script>";
                              }                      
                            }

                            if(!empty($_POST["newDateOfBirth"])){
                                $nDateOfBirth=$_POST["newDateOfBirth"];  
                                $sql = "UPDATE Listener SET DateOfBirth ='$nDateOfBirth' WHERE username='$user'";
                              if ($conn->query($sql) === TRUE) {
                                 //echo "DateOfBirth Record updated successfully <br>";
                                 echo "<script>alert('DateOfBirth Record updated successfully');</script>";
                              } else {
                                 //echo "Error updating record <br>";
                                 echo "<script>alert('Error updating record');</script>";
                              }                      
                            }

                            if(!empty($_POST["newEmail"])){
                                $nEmail=$_POST["newEmail"];  
                                if (filter_var(test_input($_POST["newEmail"]), FILTER_VALIDATE_EMAIL)){
                                $sql = "UPDATE User SET email ='$nEmail' WHERE username='$user'";
                              if ($conn->query($sql) === TRUE) {
                                 //echo "Email Record updated successfully <br>";
                                 echo "<script>alert('Email Record updated successfully');</script>";
                              }
                             } else {
                                 //echo "Error updating record <br>";
                                 echo "<script>alert('Error updating record');</script>";
                              }                      
                            }

                        }
              }
            ?>
            


</body>
</html>