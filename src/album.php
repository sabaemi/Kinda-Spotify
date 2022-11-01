<!DOCTYPE html>
    <html lang="en">
        <head>
            <link rel="stylesheet" type="text/css" href="css/c3.css">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Album</title>
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
            $sqlll = "SELECT * FROM User WHERE username ='".$user."'";
            $resulttt = mysqli_query($conn, $sqlll);
            $rowww = mysqli_fetch_assoc($resulttt);
            $loginType = $rowww['userType']; 
            if($loginType=='L'){
              echo "<script>alert('Access Denied');
                window.location.href='common.php';</script>";
            }                  
            ?> 
            
            <div class="scrollmenu">         
                <a href="common.php" name="home">Home</a>                            
                </div> 

                                            <div class="form1">
                                            <br><br><br>
<form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
<h1>Release a Music</h1><br><br>
                        Music Name: <input type="text" name="Mname">
                        <br><br>
                        Music Duration: <input type="text" name="Mtime">
                        <br><br>
                        <input type="submit" class="sbmtbtn"  name="submitmusic" value="Submit Music"> 
                        <br><br> 
                    </form>
          </div>

<?php
$Ar = "SELECT ArtName FROM Artist WHERE username ='".$user."' ";
$rmr = $conn->query($Ar);
while($rm = $rmr->fetch_array()) {
   $ArtName=$rm[0];   
}
$shart = "SELECT resType FROM Artist WHERE ArtName ='".$ArtName."' ";
$shartresult = $conn->query($shart);
while($rs = $shartresult->fetch_array()) {
   $resType=$rs[0];   
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["submitmusic"])) {
   if($resType=='ok'){
   if (empty($_POST["Mname"]) || empty($_POST["Mtime"])) {
       echo "<script>alert('all fields are required');</script>";
   } 
   else {
       $Mname = test_input($_POST["Mname"]);
       $Mtime = test_input($_POST["Mtime"]);
       $sql7 = "INSERT INTO `Music` (`Mname`, `Mtime`, `ArtName`, `report` ) VALUES ('$Mname', '$Mtime', '$ArtName', 'Fine' )";
        if ($conn->query($sql7) === TRUE) {
       echo "<script>alert('Music submitted successfully');</script>";
       } else {
       echo "Error: " . $conn->error;
       }
   }
}  
else{
   echo "<script>alert('Admin did not aprove you yet');</script>";
}            
   }
?>


<?php
//$songs = "SELECT Mname FROM Music WHERE ArtName ='".$ArtName."' ";
$songs = "SELECT Mname FROM Music WHERE ArtName ='".$ArtName."' EXCEPT SELECT Mname FROM Album ";
 $mresult = $conn->query($songs);

// while($mrow = $mresult->fetch_array()) {
//    echo $mrow[0];
// }
?>

<div class="form1">
<br><br><br>
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <h1>Your New Songs</h1><br><br>
    <?php
    $j = 0;
if ($mresult->num_rows > 0) {
    while($mrow = $mresult->fetch_assoc()) {
        $j++;
        echo '<input type="checkbox" name="checkMusic[]" value="'.$mrow["Mname"].'">';
        echo '<input type="submit"  class="usrbtn" name="Song'.$j.'" value="'.$mrow["Mname"].'" ><br>';
        
    }
}
echo '<br><br><br><br>
    Album Name: <input type="text" name="AlbumTitle"><br><br>
    Genre: <input type="text" name="genre"><br><br>
    <input type="submit" class="sbmtbtn" name="submitalbum" value="Submit Album"/>
    <br><br><br><br>';

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["submitalbum"] ) ){
   //taeed sabte album
   if($resType=='ok'){
   if(!empty($_POST['checkMusic'])){
   $checked_arr = $_POST['checkMusic'];
   $count = count($checked_arr);
   if($count==1 && empty($_POST["AlbumTitle"]) && !empty($_POST["genre"])){
      foreach($_POST['checkMusic'] as $mvalue){
         //$albumt = test_input($_POST["AlbumTitle"]);
         $genre = test_input($_POST["genre"]); 
         $songname = test_input($mvalue);
         $mtr = "SELECT Mtime FROM Music WHERE Mname ='".$songname."' ";
         $rmtr = $conn->query($mtr);
         while($rmt = $rmtr->fetch_array()) {
            $mtime=$rmt[0];   
         }
         $date=date("Y/m/d");
         $sql5 = "INSERT INTO `Album` (`AlbumTitle`, `genre` , `regDate`, `Mname`, `Mtime`, `ArtName`) VALUES ('$songname','$genre', '$date','$songname','$mtime', '$ArtName' )";
             if ($conn->query($sql5) === TRUE) {
                 echo "<script>alert('Album submitted successfully');</script>";
             }
             else {
                 echo "Error: " . $conn->error;
                 }
     }
   }
   else if($count==1 && !empty($_POST["AlbumTitle"]) && !empty($_POST["genre"])){
      echo "<script>alert('You can not choose one song and album title');</script>";
   }
   else if($count>1 && !empty($_POST["AlbumTitle"]) && !empty($_POST["genre"])){
      foreach($_POST['checkMusic'] as $mvalue){
         $albumt = test_input($_POST["AlbumTitle"]);
         $genre = test_input($_POST["genre"]); 
         $songname = test_input($mvalue);
         $mtr = "SELECT Mtime FROM Music WHERE Mname ='".$songname."' ";
         $rmtr = $conn->query($mtr);
         while($rmt = $rmtr->fetch_array()) {
            $mtime=$rmt[0];   
         }
         $date=date("Y/m/d");
         $sql5 = "INSERT INTO `Album` (`AlbumTitle`, `genre` , `regDate`, `Mname`, `Mtime`, `ArtName`) VALUES ('$albumt','$genre', '$date','$songname','$mtime', '$ArtName' )";
             if ($conn->query($sql5) === TRUE) {
                 echo "<script>alert('Album submitted successfully');</script>";
             }
             else {
                 echo "Error: " . $conn->error;
                 }
     }
   }
    
else{
    echo "<script>alert('you did not select right');</script>";
}
}

else{
   echo "<script>alert('you did not select any');</script>";
}
}
else{
   echo "<script>alert('Admin did not aprove you yet');</script>";
}
}

?>
<br><br>
</form>
</div>
<div class="form1">
<br><br><br>
<form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
<h1>Delete a Song</h1><br><br>
                        Music Name: <input type="text" name="songname">
                        <br><br>
                        <input type="submit"  class="cnclbtn"  name="deletesong" value="Delete"> 
                        <br><br> 
                        <br><br>
                    </form>
</div>

                    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['deletesong'])) {
      if (empty($_POST["songname"])) {
        echo "<script>alert('fill in fields');</script>";
      } 
      else {
         $mdelete = test_input($_POST["songname"]);
             $sql ="DELETE FROM Album WHERE Mname ='".$mdelete."'";
             $result = mysqli_query($conn, $sql);
             if($result === true){
               echo "<script>alert('deleted successfully');</script>";
             }
             else{
               echo "Error deleting song: " . $conn->error;
             }
           }
   }

 ?>

  <div class="form1">
  <br><br><br>
<form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
<h1>Delete an Album</h1><br><br>
                        Album Name: <input type="text" name="albname">
                        <br><br>
                        <input type="submit"  class="cnclbtn" name="deletealb" value="Delete"> 
                        
                        <br><br>
                    </form>
  </div>
                    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['deletealb'])) {
      if (empty($_POST["albname"])) {
        echo "<script>alert('fill in fields');</script>";
      } 
      else {
         $adelete = test_input($_POST["albname"]);
             $sql ="DELETE FROM Album WHERE AlbumTitle ='".$adelete."'";
             $result = mysqli_query($conn, $sql);
             if($result === true){
               echo "<script>alert('deleted successfully');</script>";
             }
             else{
               echo "Error deleting album: " . $conn->error;
             }
           }
   }

 ?>

</body>
</html>

                       


                                                           
                  