<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/c3.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Section</title>
</head>
<body>

<!--data base-->   
<?php
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $dataBase = "db6";
        session_start();
        $err = '';

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
    <a href="main.php" name="home">Home</a>
  </div> 

  <br><br><br>
<?php

$names = "SELECT ArtName FROM Artist";
$result = $conn->query($names);
    // while($row = $result->fetch_assoc(){
        // $tedad="SELECT ArtName,count(ArtName) from Music having count(ArtName) > 1 group by ArtName";
        // if ($tedad->num_rows > 0) {
        //          while($row = $result->fetch_assoc()) {
                    
        //             echo $row["ArtName"];
        //          }
        //         }
    // }
    // $tedad="SELECT distinct ArtName,count(ArtName) FROM Music ORDER BY COUNT(ArtName) DESC";
    // if ($tedad->num_rows > 0) {
    //     while($row = $result->fetch_assoc()) {
            
    //         echo $row["ArtName"];
    //     }
    // }
?>
<div class="form1">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <h1>Control Panel</h1><br>
    <h2> All Artists</h2>
    <?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        //echo '<input type="checkbox" name="checkUser[]" value="'.$row["ArtName"].'">';
        echo '<label for="checkUser[]">'.$row["ArtName"].' </label><br>';
    }
}
echo '<br><br><br><br>';

?>
</form>
</div>



  <br><br><br>
<?php
$names = "SELECT ArtName FROM Artist WHERE resType='Checking' ";
$result = $conn->query($names);
?>
<div class="form1">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <h2> New Artists</h2>
    <?php
    $i = 0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $i++;
        echo '<input type="checkbox" name="checkUser[]" value="'.$row["ArtName"].'">';
        echo '<label for="checkUser[]">'.$row["ArtName"].' </label><br>';
    }
}
echo '<br><br><br><br>
    <input type="submit" class="sbmtbtn" name="ok" value="Ok"/>
    <input type="submit" class="cnclbtn" name="delete" value="Delete"/>
    <br><br>';


if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["ok"] ) ){
    
    if(!empty($_POST['checkUser'])) {
        foreach($_POST['checkUser'] as $value){
            $Aname = test_input($value);
            $sql = "UPDATE Artist SET resType='ok' WHERE ArtName='".$Aname."'";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('you allowed $value');</script>";
                }
                else {
                    echo "Error: " . $conn->error;
                    }
        }
}
else{
    echo "<script>alert('you did not select');</script>";
}
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["delete"] ) ){
    
    if(!empty($_POST['checkUser'])) {
        foreach($_POST['checkUser'] as $value){
            $Aname = test_input($value);
              $sql ="DELETE FROM User WHERE username=ANY( SELECT username FROM Artist WHERE ArtName='".$Aname."' )";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('you deleted $value');</script>";
                }
                else {
                   echo "Error: " . $conn->error;
                    }
        }
}
else{
    echo "<script>alert('you did not select');</script>";
}
}
?>
</form>
</div>


<?php
$names = "SELECT username FROM User ";
$result = $conn->query($names);
?>
<br><br>
<div class="form1">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
   
    <?php
    echo'<br><h2> All Users:</h2>';
    $i = 0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $i++;
        echo '<input type="checkbox" name="checkUser[]" value="'.$row["username"].'">';
        echo '<input type="submit" class="usrbtn" name="userbttn[]" value="'.$row["username"].'" ><br>';
    }
}
echo '<br><br><br><br>
    <input type="submit" class="cnclbtn" name="userdelete" value="Delete"/>
    <br><br>
    ';

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["userbttn"] ) ){
foreach($_POST['userbttn'] as $value){
    $fromuser = test_input($value);
    session_start();
            $_SESSION['user'] = $fromuser;
    header("Location: users.php?user=".$fromuser);
 }
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["userdelete"] ) ){
    
    if(!empty($_POST['checkUser'])) {
        foreach($_POST['checkUser'] as $value){
            $username = test_input($value);
                $sql ="DELETE FROM User WHERE username='".$username."'";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('you deleted $value');</script>";
                }
                else {
                    echo "Error: " . $conn->error;
                    }
        }
}
else{
    echo "<script>alert('you did not select');</script>";
}
}
?>
</form>
</div>




<?php
$pls = "SELECT DISTINCT pName FROM Playlist";
$respls = $conn->query($pls);
?>
<br><br><br>
<div class="form1">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <h2> All Playlists:</h2>
    <?php
    $i = 0;
    if ($respls->num_rows > 0) {
        while($plsrow = $respls->fetch_array()) {
            $psrc=$plsrow[0];
            $puser="SELECT DISTINCT username FROM Playlist WHERE pName='".$psrc."'";
            $respu = $conn->query($puser);
            if ($respu->num_rows > 0){
            while($purow = $respu->fetch_array()){
            echo '<br>'.$purow[0].' : '.$psrc.' <br><br>';
            $psns = "SELECT Mname,addDate FROM Playlist WHERE pName='".$psrc."'";
            $psnresult = $conn->query($psns);
            if ($psnresult->num_rows > 0) {
                while($psnrow = $psnresult->fetch_assoc()) {
                    $i++;
                    echo '<input type="submit" class="usrbtn" name="songpl[]" value="'.$psnrow["Mname"].'" >';
                    echo ' added in : '.$psnrow["addDate"].'<br>';
                }
        }
}
    }
}
    }
echo '<br><br><br><br>
    Playlist Name:<input type="text" name="Dpname" id=""><br><br>
    User Name:<input type="text" name="Duname" id="">
    <input type="submit" class="cnclbtn" name="Dplaylist" value="Delete"/><br><br>
    <br><br>';


    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["songpl"] ) ){
        foreach($_POST['songpl'] as $value){
            $fromsng = test_input($value);
            $mpAn="SELECT Mtime,ArtName FROM Music WHERE Mname='".$fromsng."'";
            $result = mysqli_query($conn, $mpAn);
            $row = mysqli_fetch_assoc($result);
            $zaman = $row['Mtime'];
            $fard = $row['ArtName'];
            echo "<script>alert(' $value : is $zaman minutes by $fard');</script>";

         }
        }



    if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['Dplaylist'])) {
        if (empty($_POST["Dpname"])||empty($_POST["Duname"])) {
          echo "<script>alert('You have to write the names');</script>";

        } 
        else {
            $pdelete = test_input($_POST["Dpname"]);
            $udelete = test_input($_POST["Duname"]);
            if(empty($_POST['checksngpl'])){
               $sql ="DELETE FROM Playlist WHERE pName ='".$pdelete."'AND username='".$udelete."'";
               $result = mysqli_query($conn, $sql);
               if($result === true){
                 echo "<script>alert('playlist deleted successfully');</script>";
               }
               else{
                 echo "Error deleting playlist: " . $conn->error;
               }
             }
            }
     }

?>
</form>
</div>



<br>
<br>
<br>
<?php
$albums = "SELECT DISTINCT AlbumTitle FROM Album";
$albresult = $conn->query($albums);
?>

<div class="form1">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
    <h2> All Albums:</h2>
    <?php
    $i = 0;
    if ($albresult->num_rows > 0) {
        while($alrow = $albresult->fetch_array()) {
            $src=$alrow[0];
            echo '<br>'.$src.'<br><br>';
            $sns = "SELECT Mname,regDate FROM Album WHERE AlbumTitle='".$src."'";
            $snresult = $conn->query($sns);
            if ($snresult->num_rows > 0) {
                while($snrow = $snresult->fetch_assoc()) {
                    $i++;
                    //echo '<input type="checkbox" name="checksng[]" value="'.$snrow["Mname"].'">';
                    echo '<input type="submit" class="usrbtn" name="songbttn[]" value="'.$snrow["Mname"].'" >';
                    echo ' registered in : '.$snrow["regDate"].'<br>';
                }
        }
}
    }
echo '<br><br>
    Album Title:<input type="text" name="atname" id="">
    <input type="submit" class="cnclbtn" name="aldelete" value="Delete"/><br><br>
    <br><br>';

    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["songbttn"] ) ){
        foreach($_POST['songbttn'] as $value){
            $fromsng = test_input($value);
            $mpAn="SELECT Mtime,ArtName FROM Music WHERE Mname='".$fromsng."'";
            $result = mysqli_query($conn, $mpAn);
            $row = mysqli_fetch_assoc($result);
            $zaman = $row['Mtime'];
            $fard = $row['ArtName'];
            echo "<script>alert(' $value : is $zaman minutes by $fard');</script>";

         }
        }


if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["aldelete"] ) ){
    if (empty($_POST["atname"])) {
        echo "<script>alert('You have to write the name');</script>";
      } 
      else {
          $adelete = test_input($_POST["atname"]);
          if(empty($_POST['checksngpl'])){
             $sql ="DELETE FROM Album WHERE AlbumTitle ='".$adelete."'";
             $result = mysqli_query($conn, $sql);
             if($result === true){
               echo "<script>alert('Album deleted successfully');</script>";
             }
             else{
               echo "Error deleting Album: " . $conn->error;
             }
           }
          }
}

?>
</form>
</div>
<br><br><br>
<?php
$mnames = "SELECT Mname FROM Music WHERE report='reported'";
$mresult = $conn->query($mnames);
?>
<br><br>
<div class="form1">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
   
    <?php
    echo'<br><h2>Reported Songs:</h2>';
    $i = 0;
if ($mresult->num_rows > 0) {
    while($mrow = $mresult->fetch_assoc()) {
        $i++;
        echo '<input type="checkbox" name="checkm[]" value="'.$mrow["Mname"].'">';
        echo '<input type="submit" class="usrbtn" name="msongbttn[]" value="'.$mrow["Mname"].'" ><br>';
    }
}
echo '<br><br><br><br>
    <input type="submit" class="cnclbtn" name="mdelete" value="Delete"/>
    <br><br>
    ';

    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["msongbttn"] ) ){
        foreach($_POST['msongbttn'] as $value){
            $fromsng = test_input($value);
            $mpAn="SELECT Mtime,ArtName FROM Music WHERE Mname='".$fromsng."'";
            $result = mysqli_query($conn, $mpAn);
            $row = mysqli_fetch_assoc($result);
            $zaman = $row['Mtime'];
            $fard = $row['ArtName'];
            echo "<script>alert(' $value : is $zaman minutes by $fard');</script>";

         }
        }

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["mdelete"] ) ){
    
    if(!empty($_POST['checkm'])) {
        foreach($_POST['checkm'] as $value){
            $mmname = test_input($value);
                $sql ="DELETE FROM Music WHERE Mname='".$mmname."'";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('you deleted $value');</script>";
                }
                else {
                    echo "Error: " . $conn->error;
                    }
        }
}
else{
    echo "<script>alert('you did not select');</script>";
}
}
?>
</form>
</div>

</body>
</html>
