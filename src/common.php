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
    <a href="info.php?username=".$user name="home">Edit Info</a>
    <a href="premium.php?username=".$user name="home">Premimu</a>
    <a href="search.php?username=".$user name="home">Search</a>
    <a href="main.php" name="home">Home</a>
    <a href="report.php" name="home">Report</a>
    <a href="mail.php?username=".$user name="home"><img alt="bl" src="pics/envel.png" class="images" /></a>
    ||
    <a href="album.php?username=".$user name="home">Album Managing</a>
  </div> 
<?php

$names = "SELECT username FROM User WHERE username!='".$user."' ";
$result = $conn->query($names);
?>
<br><br>
<div class="form1">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
   
    <?php
    echo' <h1> '.$user.' Welcome to Your Page</h1><br>
    <h2> Other Users:</h2>';
    $i = 0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $i++;
        echo '<input type="checkbox" name="checkUser[]" value="'.$row["username"].'">';
        echo '<input type="submit" class="usrbtn" name="userbttn[]" value="'.$row["username"].'" ><br>';
    }
}
echo '<br><br><br><br>
    <input type="submit" class="sbmtbtn" name="follow" value="Follow"/>
    <input type="submit" class="cnclbtn" name="unfollow" value="Unfollow"/>
    <br><br>
    <input type="submit" class="flbtn" name="yourfollowers" value="Your Followers"/>
    <input type="submit" class="flbtn"name="yourfollowings" value="Your Followings"/><br><br><br><br>
    ';

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["userbttn"] ) ){
foreach($_POST['userbttn'] as $value){
    $fromuser = test_input($value);
    session_start();
            $_SESSION['user'] = $fromuser;
    header('Location: users.php?user='.$fromuser);
 }
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["follow"] ) ){
    
    if(!empty($_POST['checkUser'])) {
        foreach($_POST['checkUser'] as $value){
            $secondUsername = test_input($value);
            $nn="SELECT EXISTS(SELECT secondUsername FROM Follow WHERE secondUsername='".$secondUsername."' AND firstUsername='".$user."')";
            $re = $conn->query($nn);
            $r = $re->fetch_array();
            if($r[0]==0){
                $sql = "INSERT INTO `Follow` (`firstUsername`, `secondUsername` ) VALUES ('$user', '$secondUsername' )";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('you followed $value');</script>";
                }
                else {
                    echo "Error: " . $conn->error;
                    }
                }
                else{
                    echo "<script>alert('you already followed $value');</script>";
                }
        }
}
else{
    echo "<script>alert('you did not select');</script>";
}
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["unfollow"] ) ){
    
    if(!empty($_POST['checkUser'])) {
        foreach($_POST['checkUser'] as $value){
            $secondUsername = test_input($value);
            $nn="SELECT EXISTS(SELECT secondUsername FROM Follow WHERE secondUsername='".$secondUsername."' AND firstUsername='".$user."')";
            $re = $conn->query($nn);
            $r = $re->fetch_array();
            if($r[0]!=0){
                $sql ="DELETE FROM Follow WHERE secondUsername='".$secondUsername."'";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('you unfollowed $value');</script>";
                }
                else {
                    echo "Error: " . $conn->error;
                    }
                }
                else{
                    echo "<script>alert('you never followed $value');</script>";
                }
        }
}
else{
    echo "<script>alert('you did not select');</script>";
}

}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["yourfollowings"] ) ){
    $sql1 = "SELECT secondUsername FROM Follow  Where firstUsername='".$user."' ";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        echo "<table><tr><th>Your Followings</th></tr>";
        while($row1 = $result1->fetch_assoc()) {
           // echo $row1["secondUsername"];
           //$print=$row1["secondUsername"];
            //echo "<script>alert('you followed $print');</script>";
            echo "<tr><td>" . $row1["secondUsername"]. "</td></tr>";
        }
        echo "</table>";

}
else{
    echo "<script>alert('you did not follow anyone');</script>";
}
}
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["yourfollowers"] ) ){
    $sql1 = "SELECT firstUsername FROM Follow  Where secondUsername='".$user."' ";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        echo "<table><tr><th>Your Followers</th></tr>";
        while($row1 = $result1->fetch_assoc()) {
            echo "<tr><td>" . $row1["firstUsername"]. "</td></tr>";
        }
        echo "</table>";
}
else{
    echo "<script>alert('no one followed you');</script>";
}
}
?>
</form>
</div>
<br><br><br>

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
                    echo '<input type="checkbox" name="checksng[]" value="'.$snrow["Mname"].'">';
                    echo '<input type="submit" class="usrbtn" name="songbttn[]" value="'.$snrow["Mname"].'" >';
                    echo ' registered in : '.$snrow["regDate"].'<br>';
                }
        }
}
    }
echo '<br><br><br><br>
    <input type="submit" class="sbmtbtn" name="like" value="Like"/>
    <input type="submit" class="cnclbtn" name="unlike" value="Unlike"/>
    <input type="submit" class="flbtn" name="play" value="Play"/><br><br>
    Playlist Name:<input type="text" name="pname" id="">
    <input type="submit" class="sbmtbtn" name="playlist" value="Add to Playlist"/><br><br>
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


if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["play"] ) ){
    
    if(!empty($_POST['checksng'])) {
        $checked_arr = $_POST['checksng'];
        $count = count($checked_arr);
        $precheck="SELECT EXISTS(SELECT username FROM Premium WHERE username='".$user."')";
        $reprecheck = $conn->query($precheck);
        $rprecheck = $reprecheck->fetch_array(); 

        if($count<6){
        foreach($_POST['checksng'] as $value){
            $mplay = test_input($value);
            $mpAn="SELECT ArtName FROM Music WHERE Mname='".$mplay."'";
            $apsres = $conn->query($mpAn);
            while($rps = $apsres->fetch_array()) {
               $resArtp=$rps[0];   
            }
            $date1=date("Y/m/d");
            $mcnt="SELECT count(distinct Mname ) FROM Play WHERE username='".$user."' AND pDate='".$date1."'";
            $rmc = $conn->query($mcnt);
            $rc = $rmc->fetch_array();
            if($rc[0]<6 || $rprecheck[0]!=0){
                $sql = "INSERT INTO `Play` (`Mname`, `pDate`, `ArtName`, `username` ) VALUES ('$mplay' ,'$date1' ,'$resArtp' ,'$user' )";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('you played $value');</script>";
                }
                else {
                    echo "Error: " . $conn->error;
                    }
                }
                else{
                    echo "<script>alert('you can not play anymore today');</script>";
                }
        }
    }
        else{
            echo "<script>alert('you can not play more than 5 music at once');</script>"; 
        }
}
else{
    echo "<script>alert('you did not select');</script>";
}
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["playlist"] ) ){
    if(!empty($_POST['checksng']) && !empty($_POST["pname"])) {
        foreach($_POST['checksng'] as $value){
            $plname = test_input($_POST["pname"]);
            $mplayl = test_input($value);
            $mpAn="SELECT ArtName FROM Music WHERE Mname='".$mplayl."'";
            $apsres = $conn->query($mpAn);
            while($rps = $apsres->fetch_array()) {
               $resArtp=$rps[0];   
            }
            $date2=date("Y/m/d");
            $nnl="SELECT EXISTS(SELECT Mname FROM Playlist WHERE username='".$user."' AND Mname='".$mplayl."'AND pNAme='".$plname."')";
            $rel = $conn->query($nnl);
            $rl = $rel->fetch_array();
            
            $mcnt="SELECT count(distinct pName ) FROM Playlist WHERE username='".$user."'  ";
            $rmc = $conn->query($mcnt);
            $rc = $rmc->fetch_array();
            //echo $rc[0];
            $precheck="SELECT EXISTS(SELECT username FROM Premium WHERE username='".$user."')";
        $reprecheck = $conn->query($precheck);
        $rprecheck = $reprecheck->fetch_array(); 

            if($rc[0]<6|| $rprecheck[0]!=0){
                if($rl[0]==0){
                $sql = "INSERT INTO `Playlist` (`pName`, `username`, `Mname`,`addDate`, `ArtName` ) VALUES ('$plname' ,'$user','$mplayl' ,'$date2' ,'$resArtp'  )";
                if ($conn->query($sql) === TRUE) {
                    $mcnt2="SELECT count(distinct pName ) FROM Playlist WHERE username='".$user."'  ";
                    $rmc2 = $conn->query($mcnt2);
                    $rc2 = $rmc2->fetch_array();
                    if($rc2[0]<6|| $rprecheck[0]!=0){ 
                        echo "<script>alert(' $value added to playlist');</script>";
                    }
                    else{
                        $sql2 ="DELETE FROM Playlist WHERE pName='".$plname."' AND username='".$user."' AND Mname='".$mplayl."' AND addDate='".$date2."'  ";
                        if ($conn->query($sql2) === TRUE) {
                        echo "<script>alert('you can not create playlists anymore');</script>";
                        }
                    }
                }
                else {
                    echo "Error: " . $conn->error;
                    }
                }
                else echo "<script>alert(' $value is already in this playlist');</script>";
                
            }
                else{
                    echo "<script>alert('you can not create playlists anymore');</script>";
                }
        }
}
else{
    echo "<script>alert('you did not select or add the name');</script>";
}
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["like"] ) ){
    if(!empty($_POST['checksng']) ) {
        foreach($_POST['checksng'] as $value){
            $mplayl = test_input($value);
            $mpAn="SELECT ArtName FROM Music WHERE Mname='".$mplayl."'";
            $apsres = $conn->query($mpAn);
            while($rps = $apsres->fetch_array()) {
               $resArtp=$rps[0];   
            }
            $date2=date("Y/m/d");
            $nnl="SELECT EXISTS(SELECT Mname FROM Playlist WHERE username='".$user."' AND Mname='".$mplayl."'AND pNAme='Liked Songs')";
            $rel = $conn->query($nnl);
            $rl = $rel->fetch_array();

                if($rl[0]==0){
                $sql = "INSERT INTO `Playlist` (`pName`, `username`, `Mname`,`addDate`, `ArtName` ) VALUES ('Liked Songs' ,'$user','$mplayl' ,'$date2' ,'$resArtp'  )";
                if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('you liked $value');</script>";
                }
                else {
                    echo "Error: " . $conn->error;
                    }
                }
                else echo "<script>alert('you already liked $value ');</script>";
        }
}
else{
    echo "<script>alert('you did not select ');</script>";
}
}


if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["unlike"] ) ){
    if(!empty($_POST['checksng']) ) {
        foreach($_POST['checksng'] as $value){
            $mplayl = test_input($value);
            $nnl="SELECT EXISTS(SELECT Mname FROM Playlist WHERE username='".$user."' AND Mname='".$mplayl."'AND pNAme='Liked Songs')";
            $rel = $conn->query($nnl);
            $rl = $rel->fetch_array();
            
                if($rl[0]!=0){
                        $sql2 ="DELETE FROM Playlist WHERE pName='Liked Songs' AND username='".$user."' AND Mname='".$mplayl."'  ";
                        if ($conn->query($sql2) === TRUE) {
                        echo "<script>alert('you unliked $value');</script>";
                        }
                        else {
                            echo "Error: " . $conn->error;
                            }
                }
                else echo "<script>alert('you never liked $value ');</script>";
                }
        }
        else{
            echo "<script>alert('you did not select ');</script>";
        }
}

?>
</form>
</div>
<br><br><br>
<?php
$pls = "SELECT DISTINCT pName FROM Playlist";
$respls = $conn->query($pls);
?>
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
                    echo '<input type="checkbox" name="checksngpl[]" value="'.$psnrow["Mname"].'">';
                    echo '<input type="submit" class="usrbtn" name="songpl[]" value="'.$psnrow["Mname"].'" >';
                    echo ' added in : '.$psnrow["addDate"].'<br>';
                }
        }
}
    }
}
    }
echo '<br><br><br><br>
    Playlist Name:<input type="text" name="Dpname" id="">
    <input type="submit" class="cnclbtn" name="Dplaylist" value="Delete"/><br><br>
    User Name:<input type="text" name="user2" id="">
    <input type="submit" class="flbtn" name="splaylist" value="Share"/>
    <input type="submit" class="flbtn" name="likpl" value="Like Playlist"/><br><br>
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
        if (empty($_POST["Dpname"])) {
          echo "<script>alert('You have to write the name of playlist');</script>";

        } 
        else {
            $pdelete = test_input($_POST["Dpname"]);
            if(empty($_POST['checksngpl'])){
               $sql ="DELETE FROM Playlist WHERE pName ='".$pdelete."'AND username='".$user."'";
               $result = mysqli_query($conn, $sql);
               if($result === true){
                 echo "<script>alert('playlist deleted successfully');</script>";
               }
               else{
                 echo "Error deleting playlist: " . $conn->error;
               }
             }
             else{
                    foreach($_POST['checksngpl'] as $value){
                        $dmu = test_input($value);
                        $sql22 ="DELETE FROM Playlist WHERE pName ='".$pdelete."'AND username='".$user."' AND Mname='".$dmu."' ";
                        $result22 = mysqli_query($conn, $sql22);
                        if($result22 === true){
                          echo "<script>alert('songs deleted successfully');</script>";
                        }
                        else{
                          echo "Error deleting songs: " . $conn->error;
                        }
                    }
             }
            }
     }

     if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['splaylist'])) {
        if (empty($_POST["Dpname"])|| empty($_POST['user2'])) {
          echo "<script>alert('You have to write the name of playlist and user');</script>";
        } 
        else {
            $pshr = test_input($_POST["Dpname"]);
            $pus2=test_input($_POST["user2"]);
            $date2=date("Y/m/d");
            $nn="SELECT EXISTS(SELECT addUsername FROM SharedPlaylist WHERE mainUsername='".$user."' AND pName='".$pshr."' AND addUsername='".$pus2."')";
            $re = $conn->query($nn);
            $r = $re->fetch_array();
            if($r[0]==0){
            $sql = "INSERT INTO `SharedPlaylist` (`pName`,`mainUsername`, `addUsername` ) VALUES ('$pshr','$user', '$pus2' )";

            $msnme="SELECT Mname FROM Playlist WHERE pName='".$pshr."' AND username='".$user."' ";
            $msnres = $conn->query($msnme);
            while($mnsps = $msnres->fetch_array()) {
                $mpAn="SELECT ArtName FROM Music WHERE Mname='".$mnsps[0]."'";
                $apsres = $conn->query($mpAn);
                while($rps = $apsres->fetch_array()) { 
                    $sql2 = "INSERT INTO `Playlist` (`pName`, `username`, `Mname`,`addDate`, `ArtName` ) VALUES ('Shared $pshr from $user' ,'$pus2','$mnsps[0]' ,'$date2' ,'$rps[0]'  )";
                    if ($conn->query($sql2) === FALSE) {
                        echo "Error: " . $conn->error;
                    }
                }
             }
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('you shared $pshr with $pus2');</script>";
                }
                else {
                    echo "Error: " . $conn->error;
                    }
                }
                else{
                    echo "<script>alert('you already shared $pshr with $pus2');</script>";
                }
            }
     }

     if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['likpl'])) {
        if (empty($_POST["Dpname"])|| empty($_POST['user2'])) {
          echo "<script>alert('You have to write the name of playlist and user');</script>";
        } 
        else {
            $pshr = test_input($_POST["Dpname"]);
            $pus2=test_input($_POST["user2"]);
            $date2=date("Y/m/d");
            $nn="SELECT EXISTS(SELECT username FROM Playlist WHERE pName='".$pshr."' AND username='".$user."')";
            $re = $conn->query($nn);
            $r = $re->fetch_array();
            if($r[0]==0){
            //$sql = "INSERT INTO `SharedPlaylist` (`pName`,`mainUsername`, `addUsername` ) VALUES ('$pshr','$user', '$pus2' )";
            $msnme="SELECT Mname FROM Playlist WHERE pName='".$pshr."' AND username='".$pus2."' ";
            $msnres = $conn->query($msnme);
            while($mnsps = $msnres->fetch_array()) {
                $mpAn="SELECT ArtName FROM Music WHERE Mname='".$mnsps[0]."'";
                $apsres = $conn->query($mpAn);
                while($rps = $apsres->fetch_array()) { 
                    $sql2 = "INSERT INTO `Playlist` (`pName`, `username`, `Mname`,`addDate`, `ArtName` ) VALUES ('$pshr' ,'$user','$mnsps[0]' ,'$date2' ,'$rps[0]'  )";
                }
             }
                if ($conn->query($sql2) === TRUE) {
                    echo "<script>alert('you liked $pshr');</script>";
                }
                else {
                    echo "Error: " . $conn->error;
                    }
                }
                else{
                    echo "<script>alert('you already liked $pshr');</script>";
                }
            }
     }

?>
</form>
</div>

</body>
</html>