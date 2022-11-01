<!DOCTYPE html>
    <html lang="en">
        <head>
            <link rel="stylesheet" type="text/css" href="css/c3.css">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>YourPage</title>
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

<div class="scrollmenu">         
                <a href="common.php" name="home">Home</a>                            
                </div> 
<br><br>
<div class="form1">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <h1>Search</h1><br><br>
    Enter a Word: <input type="text" name="search">
    <br><br>
    <input type="submit" class="sbmtbtn" name="submit" value="Submit">
    <br><br>  
</form>
</div>
    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["submit"] ) ){
      if (empty($_POST["search"])) {
        echo "<script>alert('all fields are required');</script>";
      } 
      else{
        $search = test_input($_POST["search"]);
            $nn="SELECT EXISTS(SELECT username FROM User WHERE username='".$search."')";
            $re = $conn->query($nn);
            $r = $re->fetch_array();

            $nn1="SELECT EXISTS(SELECT pName FROM Playlist WHERE pName='".$search."')";
            $re1 = $conn->query($nn1);
            $r1 = $re1->fetch_array();

            $nn2="SELECT EXISTS(SELECT Mname FROM Music WHERE Mname='".$search."')";
            $re2 = $conn->query($nn2);
            $r2 = $re2->fetch_array();

            $nn3="SELECT EXISTS(SELECT ArtName FROM Artist WHERE ArtName='".$search."')";
            $re3 = $conn->query($nn3);
            $r3 = $re3->fetch_array();

            $nn4="SELECT EXISTS(SELECT AlbumTitle FROM Album WHERE AlbumTitle='".$search."')";
            $re4 = $conn->query($nn4);
            $r4 = $re4->fetch_array();

            $nn5="SELECT EXISTS(SELECT firstName FROM Listener WHERE firstName='".$search."')";
            $re5 = $conn->query($nn5);
            $r5 = $re5->fetch_array();

            $nn6="SELECT EXISTS(SELECT lastName FROM Listener WHERE lastName='".$search."')";
            $re6 = $conn->query($nn6);
            $r6 = $re6->fetch_array();

            if($r[0]!=0) echo "<script>alert('username $search found!');</script>";

            else if($r1[0]!=0) echo "<script>alert('Playlist $search found!');</script>";

            else if($r2[0]!=0){ 
              $Ar = "SELECT Distinct ArtName FROM Music WHERE Mname ='".$search."' ";
              $rmr = $conn->query($Ar);
              while($rm = $rmr->fetch_array()) {
              $ArtName=$rm[0];   
              }
              echo "<script>alert('Music $search found! by $ArtName');</script>";
            }
 
            else if($r3[0]!=0) echo "<script>alert('Artist $search found!');</script>";

            else if($r4[0]!=0) { 
              $Ar = "SELECT Distinct ArtName FROM Album WHERE AlbumTitle ='".$search."' ";
              $rmr = $conn->query($Ar);
              while($rm = $rmr->fetch_array()) {
              $ArtName=$rm[0];   
              }
              echo "<script>alert('Album $search found! by $ArtName');</script>";
            }

            else if($r5[0]!=0) echo "<script>alert('user with firstname $search found!');</script>";

            else if($r6[0]!=0) echo "<script>alert('user with lastname $search found!');</script>";

            else echo "<script>alert('something is wrong!');</script>";
            
      }
    }
?>


            
<?php
$names = "SELECT username FROM User WHERE username!='".$user."' ";
$result = $conn->query($names);
?>
<br><br>
<div class="form1">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <h1>Last Song Played by Your Followings:</h1><br><br>
    <?php
    $sql1 = "SELECT secondUsername FROM Follow  Where firstUsername='".$user."' ";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
      while($row1 = $result1->fetch_assoc()) {
        $sql = "SELECT Mname FROM Play  Where username='".$row1["secondUsername"]."' AND pDate=(SELECT  max(pDate) FROM Play  WHERE username='".$row1["secondUsername"]."'  )ORDER BY Mname DESC LIMIT 1";
    $result = $conn->query($sql);
    echo '<div class="flrs">' . $row1["secondUsername"];
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        echo ' => ' .$row["Mname"].'</div>';
      }
    }
  else echo ' =>  none </div>';
    }

}
else{
echo '<div class="flrs">you did not follow anyone</div>';
}
?>
<br><br>
</form>
</div>




<br><br>
<div class="form1">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <h1>Last 5 Songs by Your Followed Artist:</h1><br><br>
    <?php
    $sql = "SELECT secondUsername FROM Follow  Where firstUsername='".$user."' 
    intersect SELECT username from Artist ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo '<h2>' . $row["secondUsername"].'</h2>';

        $Ar = "SELECT ArtName FROM Artist WHERE username ='".$row["secondUsername"]."' ";
        $rmr = $conn->query($Ar);
        while($rm = $rmr->fetch_array()){
          $ArtName=$rm[0];  
          $nn="SELECT EXISTS(SELECT Mname FROM Album  Where ArtName='".$ArtName."')";
            $re = $conn->query($nn);
            $r = $re->fetch_array();
            if($r[0]!=0){
        $sql2 = "SELECT Mname FROM Album  Where ArtName='".$ArtName."' AND regDate=(SELECT  max(regDate) FROM Album  WHERE ArtName='".$ArtName."'  )ORDER BY Mname DESC LIMIT 5";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
      while($row2 = $result2->fetch_assoc()){
        echo '<div class="flrs">'.$row2["Mname"].'</div>';
      }
    }
  else echo '<div class="flrs"> none </div>';
  }
  else echo '<div class="flrs"> none </div>';   
}
  }
}
else{
echo '<div class="flrs">you did not follow any Artist</div>';
}
?>
<br><br>
</form>
</div>
</body>
</html>